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
use LRN\LRNProtectBundle\Entity\Tutorial;
use LRN\BackendBundle\Form\TutorialType;
use LRN\LRNProtectBundle\Entity\Paso;

class TutorialController extends Controller
{
    public function tutorialCrearAction(Request $peticion)
    {
        $tutorial = new Tutorial();
        //poner los valores que se desean por defecto
        //$tutorial->setPermiteEmail(true);
        //$tutorial->setFechaNacimiento(new \DateTime('today - 18 years'));

        $formulario = $this->createForm(new TutorialType(), $tutorial);

        if($peticion->getMethod() == 'POST')
        {
            $formulario->handleRequest($peticion);

            if ($formulario->isValid())
            {
                $em = $this->getDoctrine()->getManager();

                $tutorial->subirPDF();
                $tutorial->subirImagen();

                $em->persist($tutorial);
                $em->flush();

                return $this->redirect($this->generateUrl('backend_tutorial_listar'));
                //$this->get('session')->getFlashBag()->add('notaBuena','Se ha introducido un nuevo '.$nivel);
            }
        }

        return $this->render(
            'BackendBundle:Tutorial:tutorial_create.html.twig',
            array('formulario' => $formulario->createView())
        );
    }

    public function tutorialEditarAction(Request $peticion, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $tutorial = $em->getRepository('LRNProtectBundle:Tutorial')->findOneById($id);

        $formulario = $this->createForm(new TutorialType(), $tutorial);

        $rutaPdfOriginal=$formulario->getData()->getRutaPDF();
        $rutaImagenOriginal=$formulario->getData()->getRutaImagen();

        if ($peticion->getMethod() == 'POST')
        {
            $formulario->handleRequest($peticion);

            if ($formulario->isValid())
            {
                if(null==$tutorial->getPDF()){
                    $tutorial->setRutaPDF($rutaPdfOriginal);
                }else{
                    $tutorial->subirPDF();
                    if(!empty($rutaPdfOriginal)){
                        $fs=new Filesystem();
                        $fs->remove($rutaPdfOriginal);
                    }
                }

                if(null==$tutorial->getImagen()){
                    $tutorial->setRutaImagen($rutaImagenOriginal);
                }else{
                    $tutorial->subirImagen();
                    if(!empty($rutaImagenOriginal)){
                        $fs=new Filesystem();
                        $fs->remove($rutaImagenOriginal);
                    }
                }

                // actualizar el tutorial
                $em->persist($tutorial);
                $em->flush();

                $this->get('session')->getFlashBag()->add('notaBuena','Se ha modificado el tutorial');

                //Si _todo sale bien, se envia el tutorial para la portada.
                return $this->redirect($this->generateUrl('backend_tutorial_listar'));
            }
        }

        return $this->render('BackendBundle:Tutorial:tutorial_edit.html.twig', array(
            'tutorial' => $tutorial,
            'formulario' => $formulario->createView()
        ));
    }

    public function tutorialBorrarAction(Request $peticion, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $tutorial = $em->getRepository('LRNProtectBundle:Tutorial')->findOneById($id);

        if ($peticion->getMethod() == 'POST')
        {
            // borrar el tutorial
            $em->remove($tutorial);
            $em->flush();

            return $this->redirect($this->generateUrl('backend_tutorial_listar'));
        }

        return $this->render('BackendBundle:tutorial:tutorial_borrar.html.twig', array( 'tutorial' => $tutorial ));
    }

    public function tutorialListarAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tutoriales = $em->getRepository('LRNProtectBundle:Tutorial')->findAll();

        return $this->render('BackendBundle:Tutorial:tutorial_listar.html.twig', array(
            'tutoriales' => $tutoriales
        ));
    }

    public function tutorialMostrarAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $tutorial = $em->getRepository('LRNProtectBundle:Tutorial')->findOneById($id);

        return $this->render('BackendBundle:Tutorial:tutorial_mostrar.html.twig', array( 'tutorial' => $tutorial ));
    }

    //En estos momentos addPaso no se esta usando. Para agregar pasos se esta usando createPaso del controlador de Pasos.
    public function addPasoAction($id, $paso_id)
    {
        $em = $this->getDoctrine()->getManager();
        $tutorial = $em->getRepository('LRNProtectBundle:Tutorial')->findOneById($id);

        $paso = $em->getRepository('LRNProtectBundle:Tutorial')->findOneById($paso_id);

        $paso->setTutorial($tutorial);

        $em->persist($paso);

        $em->flush();

        return $this->render('BackendBundle:Tutorial:tutorial_mostrar.html.twig', array( 'tutorial' => $tutorial ));
    }

    public function deletePasoAction(Request $request, $id, $paso_id)
    {
        $em = $this->getDoctrine()->getManager();

        $paso = $em->getRepository('LRNProtectBundle:Paso')->findOneById($paso_id);

        if ($request->getMethod() == 'POST')
        {
            // borrar el paso
            $em->remove($paso);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('backend_tutorial_mostrar', array('id' => $id)));
    }
}
