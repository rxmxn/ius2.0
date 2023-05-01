<?php
/**
 * Created by PhpStorm.
 * User: Ramon
 * Date: 14/04/2015
 * Time: 19:02
 */

namespace LRN\BackendBundle\Controller;

use Symfony\Component\Security\Acl\Domain\ObjectIdentity,
    Symfony\Component\Security\Acl\Domain\UserSecurityIdentity,
    Symfony\Component\Security\Acl\Permission\MaskBuilder;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use LRN\BackendBundle\Form\PasoType;
use LRN\LRNProtectBundle\Entity\Paso;
use LRN\LRNProtectBundle\Entity\ReadMore;
use Symfony\Component\Filesystem\Filesystem;

class PasoController extends Controller
{
    public function pasoCrearAction(Request $peticion, $tutorial_id)
    {
        $paso = new Paso();
        //poner los valores que se desean por defecto
        //$paso->setPermiteEmail(true);
        //$paso->setFechaNacimiento(new \DateTime('today - 18 years'));

        $formulario = $this->createForm(new PasoType(), $paso);

        if($peticion->getMethod() == 'POST')
        {
            $formulario->handleRequest($peticion);

            if ($formulario->isValid())
            {
                $paso->subirImagen();

                $em = $this->getDoctrine()->getManager();

                $tutorial = $em->getRepository('LRNProtectBundle:Tutorial')->findOneById($tutorial_id);
                $paso->setTutorial($tutorial);

                $em->persist($paso);
                $em->flush();

                return $this->redirect($this->generateUrl('backend_tutorial_listar'));
                //$this->get('session')->getFlashBag()->add('notaBuena','Se ha introducido un nuevo '.$nivel);
            }
        }

        return $this->render(
            'BackendBundle:Pasos:paso_create.html.twig',
            array('formulario' => $formulario->createView(), 'tutorial_id' => $tutorial_id)
        );
    }

    public function pasoEditarAction(Request $peticion, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $paso = $em->getRepository('LRNProtectBundle:Paso')->findOneById($id);

        if (!$paso) {
            throw $this->createNotFoundException('Unable to find Paso entity.');
        }

        $formulario = $this->createForm(new PasoType(), $paso);

        $rutaImagenOriginal=$formulario->getData()->getRutaImagen();

        if ($peticion->getMethod() == 'POST')
        {
            $formulario->handleRequest($peticion);

            if ($formulario->isValid())
            {
                if(null==$paso->getImagen()){
                    $paso->setRutaImagen($rutaImagenOriginal);
                }else{
                    $paso->subirImagen();
                    if(!empty($rutaImagenOriginal)){
                        $fs=new Filesystem();
                        $fs->remove($rutaImagenOriginal);
                    }
                }

                // actualizar el paso
                $em->persist($paso);
                $em->flush();

                $this->get('session')->getFlashBag()->add('notaBuena','Se ha modificado el paso');

                //Si _todo sale bien, se envia el paso para la portada.
                return $this->redirect($this->generateUrl('backend_tutorial_mostrar',
                    array('id'=>$paso->getTutorial()->getId())));
            }
        }

        return $this->render('BackendBundle:Pasos:paso_editar.html.twig', array(
            'paso' => $paso,
            'formulario' => $formulario->createView()
        ));
    }

    public function pasoBorrarAction(Request $peticion, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $paso = $em->getRepository('LRNProtectBundle:Paso')->findOneById($id);

        if ($peticion->getMethod() == 'POST')
        {
            // borrar el paso
            $em->remove($paso);
            $em->flush();

            return $this->redirect($this->generateUrl('backend_paso_listar'));
        }

        return $this->render('BackendBundle:Pasos:paso_borrar.html.twig', array( 'paso' => $paso ));
    }

    public function pasoListarAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pasos = $em->getRepository('LRNProtectBundle:Paso')->findAll();

        return $this->render('BackendBundle:Pasos:paso_listar.html.twig', array(
            'pasos' => $pasos
        ));
    }

    public function pasoMostrarAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $paso = $em->getRepository('LRNProtectBundle:Paso')->findOneById($id);

        return $this->render('BackendBundle:Pasos:paso_mostrar.html.twig', array( 'paso' => $paso ));
    }
}
