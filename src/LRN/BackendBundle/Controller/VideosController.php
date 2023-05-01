<?php
/**
 * Created by PhpStorm.
 * User: Ramon
 * Date: 26/04/2015
 * Time: 0:58
 */

namespace LRN\BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use LRN\BackendBundle\Form\VideosType;
use LRN\LRNProtectBundle\Entity\Videos;
use Symfony\Component\Filesystem\Filesystem;

class VideosController extends Controller
{
    public function videosCrearAction(Request $peticion)
    {
        $video = new Videos();
        //poner los valores que se desean por defecto
        //$videos->setPermiteEmail(true);
        //$videos->setFechaNacimiento(new \DateTime('today - 18 years'));

        $formulario = $this->createForm(new VideosType(), $video);

        if($peticion->getMethod() == 'POST')
        {
            $formulario->handleRequest($peticion);

            if ($formulario->isValid())
            {
                $video->subirVideo();

                $em = $this->getDoctrine()->getManager();

                $em->persist($video);
                $em->flush();

                return $this->redirect($this->generateUrl('backend_videos_listar'));
                //$this->get('session')->getFlashBag()->add('notaBuena','Se ha introducido un nuevo '.$nivel);
            }
        }

        return $this->render(
            'BackendBundle:Videos:videos_create.html.twig',
            array('formulario' => $formulario->createView())
        );
    }

    public function videosEditarAction(Request $peticion, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $video = $em->getRepository('LRNProtectBundle:Videos')->findOneById($id);

        if (!$video) {
            throw $this->createNotFoundException('Unable to find Videos entity.');
        }

        $formulario = $this->createForm(new VideosType(), $video);

        $rutaVideoOriginal=$formulario->getData()->getRutaVideo();

        if ($peticion->getMethod() == 'POST')
        {
            $formulario->handleRequest($peticion);

            if ($formulario->isValid())
            {
                if(null==$video->getVideo()){
                    $video->setRutaVideo($rutaVideoOriginal);
                }else{
                    $video->subirVideo();
                    if(!empty($rutaVideoOriginal)){
                        $fs=new Filesystem();
                        $fs->remove($rutaVideoOriginal);
                    }
                }

                // actualizar el videos
                $em->persist($video);
                $em->flush();

                $this->get('session')->getFlashBag()->add('notaBuena','Se ha modificado el videos');

                //Si _todo sale bien, se envia el videos para la portada.
                return $this->redirect($this->generateUrl('backend_videos_listar'));
            }
        }

        return $this->render('BackendBundle:Videos:videos_editar.html.twig', array(
            'video' => $video,
            'formulario' => $formulario->createView()
        ));
    }

    public function videosBorrarAction(Request $peticion, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $video = $em->getRepository('LRNProtectBundle:Videos')->findOneById($id);

        if ($peticion->getMethod() == 'POST')
        {
            // borrar el videos
            $em->remove($video);
            $em->flush();

            return $this->redirect($this->generateUrl('backend_videos_listar'));
        }

        return $this->render('BackendBundle:Videos:videos_borrar.html.twig', array( 'video' => $video ));
    }

    public function videosListarAction()
    {
        $em = $this->getDoctrine()->getManager();

        $videos = $em->getRepository('LRNProtectBundle:Videos')->findAll();

        return $this->render('BackendBundle:Videos:videos_listar.html.twig', array(
            'videos' => $videos
        ));
    }

    public function videosMostrarAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $video = $em->getRepository('LRNProtectBundle:Videos')->findOneById($id);

        return $this->render('BackendBundle:Videos:videos_mostrar.html.twig', array( 'video' => $video ));
    }
}
