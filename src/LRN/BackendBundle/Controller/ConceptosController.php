<?php
/**
 * Created by PhpStorm.
 * User: Ramon
 * Date: 14/04/2015
 * Time: 19:02
 */

namespace LRN\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use LRN\BackendBundle\Form\ConceptosType;
use LRN\LRNProtectBundle\Entity\Conceptos;
use Symfony\Component\Filesystem\Filesystem;

class ConceptosController extends Controller
{
    public function conceptosCrearAction(Request $peticion)
    {
        $conceptos = new Conceptos();
        //poner los valores que se desean por defecto
        //$conceptos->setPermiteEmail(true);
        //$conceptos->setFechaNacimiento(new \DateTime('today - 18 years'));

        $formulario = $this->createForm(new ConceptosType(), $conceptos);

        if($peticion->getMethod() == 'POST')
        {
            $formulario->handleRequest($peticion);

            if ($formulario->isValid())
            {
                $conceptos->subirImagen();

                $em = $this->getDoctrine()->getManager();

                $em->persist($conceptos);
                $em->flush();

                return $this->redirect($this->generateUrl('backend_conceptos_listar'));
                //$this->get('session')->getFlashBag()->add('notaBuena','Se ha introducido un nuevo '.$nivel);
            }
        }

        return $this->render(
            'BackendBundle:Conceptos:conceptos_create.html.twig',
            array('formulario' => $formulario->createView())
        );
    }

    public function conceptosEditarAction(Request $peticion, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $conceptos = $em->getRepository('LRNProtectBundle:Conceptos')->findOneById($id);

        if (!$conceptos) {
            throw $this->createNotFoundException('Unable to find Conceptos entity.');
        }

        $formulario = $this->createForm(new ConceptosType(), $conceptos);

        $rutaImagenOriginal=$formulario->getData()->getRutaImagen();

        if ($peticion->getMethod() == 'POST')
        {
            $formulario->handleRequest($peticion);

            if ($formulario->isValid())
            {
                if(null==$conceptos->getImagen()){
                    $conceptos->setRutaImagen($rutaImagenOriginal);
                }else{
                    $conceptos->subirImagen();
                    if(!empty($rutaImagenOriginal)){
                        $fs=new Filesystem();
                        $fs->remove($rutaImagenOriginal);
                    }
                }

                // actualizar el conceptos
                $em->persist($conceptos);
                $em->flush();

                $this->get('session')->getFlashBag()->add('notaBuena','Se ha modificado el conceptos');

                //Si _todo sale bien, se envia el conceptos para la portada.
                return $this->redirect($this->generateUrl('backend_conceptos_listar'));
            }
        }

        return $this->render('BackendBundle:Conceptos:conceptos_editar.html.twig', array(
            'conceptos' => $conceptos,
            'formulario' => $formulario->createView()
        ));
    }

    public function conceptosBorrarAction(Request $peticion, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $conceptos = $em->getRepository('LRNProtectBundle:Conceptos')->findOneById($id);

        if ($peticion->getMethod() == 'POST')
        {
            // borrar el conceptos
            $em->remove($conceptos);
            $em->flush();

            return $this->redirect($this->generateUrl('backend_conceptos_listar'));
        }

        return $this->render('BackendBundle:Conceptos:conceptos_borrar.html.twig', array( 'conceptos' => $conceptos ));
    }

    public function conceptosListarAction()
    {
        $em = $this->getDoctrine()->getManager();

        $conceptos = $em->getRepository('LRNProtectBundle:Conceptos')->findAll();

        return $this->render('BackendBundle:Conceptos:conceptos_listar.html.twig', array(
            'conceptos' => $conceptos
        ));
    }

    public function conceptosMostrarAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $conceptos = $em->getRepository('LRNProtectBundle:Conceptos')->findOneById($id);

        return $this->render('BackendBundle:Conceptos:conceptos_mostrar.html.twig', array( 'conceptos' => $conceptos ));
    }
}
