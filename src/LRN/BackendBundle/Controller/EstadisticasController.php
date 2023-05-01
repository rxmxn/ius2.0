<?php
/**
 * Created by PhpStorm.
 * User: Ramon
 * Date: 19/04/2015
 * Time: 10:42
 */

namespace LRN\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use LRN\BackendBundle\Form\EstadisticasType;
use LRN\LRNProtectBundle\Entity\Estadisticas;
use Symfony\Component\Filesystem\Filesystem;

class EstadisticasController extends Controller
{
    public function estadisticasCrearAction(Request $peticion)
    {
        $estadisticas = new Estadisticas();
        //poner los valores que se desean por defecto
        //$estadisticas->setPermiteEmail(true);
        //$estadisticas->setFechaNacimiento(new \DateTime('today - 18 years'));

        $formulario = $this->createForm(new EstadisticasType(), $estadisticas);

        if($peticion->getMethod() == 'POST')
        {
            $formulario->handleRequest($peticion);

            if ($formulario->isValid())
            {
                $estadisticas->subirImagen();

                $em = $this->getDoctrine()->getManager();

                $em->persist($estadisticas);
                $em->flush();

                return $this->redirect($this->generateUrl('backend_estadisticas_listar'));
                //$this->get('session')->getFlashBag()->add('notaBuena','Se ha introducido un nuevo '.$nivel);
            }
        }

        return $this->render(
            'BackendBundle:Estadisticas:estadisticas_create.html.twig',
            array('formulario' => $formulario->createView())
        );
    }

    public function estadisticasEditarAction(Request $peticion, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $estadisticas = $em->getRepository('LRNProtectBundle:Estadisticas')->findOneById($id);

        if (!$estadisticas) {
            throw $this->createNotFoundException('Unable to find Estadisticas entity.');
        }

        $formulario = $this->createForm(new EstadisticasType(), $estadisticas);

        $rutaImagenOriginal=$formulario->getData()->getRutaImagen();

        if ($peticion->getMethod() == 'POST')
        {
            $formulario->handleRequest($peticion);

            if ($formulario->isValid())
            {
                if(null==$estadisticas->getImagen()){
                    $estadisticas->setRutaImagen($rutaImagenOriginal);
                }else{
                    $estadisticas->subirImagen();
                    if(!empty($rutaImagenOriginal)){
                        $fs=new Filesystem();
                        $fs->remove($rutaImagenOriginal);
                    }
                }

                // actualizar el estadisticas
                $em->persist($estadisticas);
                $em->flush();

                $this->get('session')->getFlashBag()->add('notaBuena','Se ha modificado el estadisticas');

                //Si _todo sale bien, se envia el estadisticas para la portada.
                return $this->redirect($this->generateUrl('backend_estadisticas_listar'));
            }
        }

        return $this->render('BackendBundle:Estadisticas:estadisticas_editar.html.twig', array(
            'estadisticas' => $estadisticas,
            'formulario' => $formulario->createView()
        ));
    }

    public function estadisticasBorrarAction(Request $peticion, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $estadisticas = $em->getRepository('LRNProtectBundle:Estadisticas')->findOneById($id);

        if ($peticion->getMethod() == 'POST')
        {
            // borrar el estadisticas
            $em->remove($estadisticas);
            $em->flush();

            return $this->redirect($this->generateUrl('backend_estadisticas_listar'));
        }

        return $this->render('BackendBundle:Estadisticas:estadisticas_borrar.html.twig', array( 'estadisticas' => $estadisticas ));
    }

    public function estadisticasListarAction()
    {
        $em = $this->getDoctrine()->getManager();

        $estadisticas = $em->getRepository('LRNProtectBundle:Estadisticas')->findAll();

        return $this->render('BackendBundle:Estadisticas:estadisticas_listar.html.twig', array(
            'estadisticas' => $estadisticas
        ));
    }

    public function estadisticasMostrarAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $estadisticas = $em->getRepository('LRNProtectBundle:Estadisticas')->findOneById($id);

        return $this->render('BackendBundle:Estadisticas:estadisticas_mostrar.html.twig', array( 'estadisticas' => $estadisticas ));
    }
}
