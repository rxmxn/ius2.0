<?php

namespace LRN\LRNProtectBundle\Controller;

use LRN\LRNProtectBundle\Entity\Estadisticas;
use LRN\LRNProtectBundle\Entity\Tutorial;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use LRN\LRNProtectBundle\Entity\ReadMore;

class DefaultController extends Controller
{
    public function inicioAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tutoriales=$em->getRepository('LRNProtectBundle:Tutorial')->FindAllTutoriales();

        return $this->render('LRNProtectBundle:Default:index.html.twig', array(
            'tutoriales' => $tutoriales));
    }

//    public function noticiasAction()
//    {
//        return $this->render('HPTDefaultBundle:Default:noticias.html.twig');
//    }

    public function documentosAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tutoriales=$em->getRepository('LRNProtectBundle:Tutorial')->FindAllTutoriales();

        $documentos=$em->getRepository('LRNProtectBundle:Documentos')->FindAllDocumentos();
        $categorias=$em->getRepository('LRNProtectBundle:Documentos')->FindAllCat();
//        $documentos=$em->getRepository('LRNProtectBundle:Documentos')->findAll();

        return $this->render('LRNProtectBundle:Default:documentos.html.twig', array(
            'categorias'=>$categorias, 'tutoriales' => $tutoriales, 'documentos' => $documentos));
    }

    public function documentosCategoriaAction($categoria)
    {
        $em=$this->getDoctrine()->getManager();
        $documentos=$em->getRepository('LRNProtectBundle:Documentos')->FindCat($categoria);

        $categorias=$em->getRepository('LRNProtectBundle:Documentos')->FindAllCat();
        $tutoriales=$em->getRepository('LRNProtectBundle:Tutorial')->FindAllTutoriales();

        return $this->render('LRNProtectBundle:Default:documentos.html.twig', array(
            'documentos'=>$documentos,
            'categorias'=>$categorias,
            'tutoriales' => $tutoriales));
    }

    public function tutorialMostrarAction($nombreRedSocial)
    {
        $em = $this->getDoctrine()->getManager();

        $tutorial = $em->getRepository('LRNProtectBundle:Tutorial')->findOneByNombreRedSocial($nombreRedSocial);

        $tutoriales=$em->getRepository('LRNProtectBundle:Tutorial')->FindAllTutoriales();

        return $this->render('LRNProtectBundle:Default:tutorial.html.twig', array('tutorial' => $tutorial,
            'tutoriales' => $tutoriales));
    }

    public function tutorialIndexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tutoriales=$em->getRepository('LRNProtectBundle:Tutorial')->FindAllTutoriales();

        return $this->render('LRNProtectBundle:Default:tutorial_index.html.twig', array(
            'tutoriales' => $tutoriales));
    }

    public function FindTutorialAction($nombreTutorial)
    {
        $em=$this->getDoctrine()->getManager();
        $tutorial=$em->getRepository('LRNProtectBundle:Tutorial')->findOneByNombreRedSocial($nombreTutorial);

        $tutoriales=$em->getRepository('LRNProtectBundle:Tutorial')->FindAllTutoriales();

        return $this->render('LRNProtectBundle:Default:tutorial.html.twig', array('tutorial' => $tutorial,
            'tutoriales' => $tutoriales));
    }

    public function conceptosAction()
    {
        $em = $this->getDoctrine()->getManager();

        //Ordenado alfabeticamente por subtitulos
//        $conceptos=$em->getRepository('LRNProtectBundle:Conceptos')->FindAllConceptos();
        //Ordenado por ids
        $conceptos=$em->getRepository('LRNProtectBundle:Conceptos')->findAll();
        $tutoriales=$em->getRepository('LRNProtectBundle:Tutorial')->FindAllTutoriales();

        return $this->render('LRNProtectBundle:Default:conceptos.html.twig', array(
            'tutoriales' => $tutoriales, 'conceptos' => $conceptos));
    }

    public function conceptosMostrarAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $concepto = $em->getRepository('LRNProtectBundle:Conceptos')->findOneById($id);
//        $conceptos=$em->getRepository('LRNProtectBundle:Conceptos')->FindAllConceptos();
        $conceptos=$em->getRepository('LRNProtectBundle:Conceptos')->findAll();
        $tutoriales=$em->getRepository('LRNProtectBundle:Tutorial')->FindAllTutoriales();

        return $this->render('LRNProtectBundle:Default:conceptos_mostrar.html.twig', array(
            'concepto' => $concepto, 'conceptos' => $conceptos, 'tutoriales' => $tutoriales));
    }

    public function estadisticasAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tutoriales=$em->getRepository('LRNProtectBundle:Tutorial')->FindAllTutoriales();  //para el menu

        //$estadisticas=$em->getRepository('LRNProtectBundle:Estadisticas')->findAll();  //ordenando como Anexos
        //ordenando por categorias (alfabeticamente)
        $estadisticas=$em->getRepository('LRNProtectBundle:Estadisticas')->FindAllEstadisticas();
        $categorias=$em->getRepository('LRNProtectBundle:Estadisticas')->FindAllCat();

        return $this->render('LRNProtectBundle:Default:estadisticas.html.twig', array(
            'categorias'=>$categorias, 'tutoriales' => $tutoriales, 'estadisticas' => $estadisticas));
    }

    public function estadisticasCategoriaAction($categoria)
    {
        $em=$this->getDoctrine()->getManager();
        $estadisticas=$em->getRepository('LRNProtectBundle:Estadisticas')->FindCat($categoria);

        $categorias=$em->getRepository('LRNProtectBundle:Estadisticas')->FindAllCat();
        $tutoriales=$em->getRepository('LRNProtectBundle:Tutorial')->FindAllTutoriales();

        return $this->render('LRNProtectBundle:Default:estadisticas.html.twig', array(
            'estadisticas'=>$estadisticas,
            'categorias'=>$categorias,
            'tutoriales' => $tutoriales));
    }

    public function videosAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tutoriales=$em->getRepository('LRNProtectBundle:Tutorial')->FindAllTutoriales();
        $videos=$em->getRepository('LRNProtectBundle:Videos')->findAll();
        $categorias=$em->getRepository('LRNProtectBundle:Noticias')->FindAllCat();

        return $this->render('LRNProtectBundle:Default:videos.html.twig', array(
            'tutoriales' => $tutoriales, 'categoria'=>$categorias,  'videos' => $videos));
    }
}
