<?php

namespace LRN\LRNProtectBundle\Controller;

use LRN\LRNProtectBundle\Entity\ReadMore;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use LRN\LRNProtectBundle\Entity\Noticias;
use LRN\LRNProtectBundle\Form\NoticiasType;
use LRN\LRNProtectBundle\Form\NoticiasNombreType;

/**
 * Noticias controller.
 *
 * @Route("/noticias")
 */
class NoticiasController extends Controller
{
    public function paginadorAction($pagina)
    {
        $em=$this->getDoctrine()->getManager();
        $entity=$em->getRepository('LRNProtectBundle:Noticias')->FindPagina($pagina);

        $noticia=new Noticias();
        $form= $this->createNombreForm($noticia);

        $categorias=$em->getRepository('LRNProtectBundle:Noticias')->FindAllCat();

        if (!$entity)
        {
            throw $this->createNotFoundException('No hay noticias nuevas');
        }

        $cantidad=$em->getRepository('LRNProtectBundle:Noticias')->CantidadDatos();

        $temp= floor($cantidad/2);

        if(($cantidad%2)!=0)
        {$temp=$temp+1;}

        $tutoriales=$em->getRepository('LRNProtectBundle:Tutorial')->FindAllTutoriales();

        return $this->render('LRNProtectBundle:Default:noticias.html.twig',array(
            'entities'=>$entity,
            'entity'=>$noticia,
            'form'=>$form->createView(),
            'categoria'=>$categorias,
            'cantidad'=>$temp,
            'tutoriales' => $tutoriales
        )) ;

    }

    public function FindCategoriaAction($categoria)
    {
        $noticia=new Noticias();
        $em=$this->getDoctrine()->getManager();
        $form= $this->createNombreForm($noticia);
        $entity=$em->getRepository('LRNProtectBundle:Noticias')->FindCat($categoria);

        $categorias=$em->getRepository('LRNProtectBundle:Noticias')->FindAllCat();
        $tutoriales=$em->getRepository('LRNProtectBundle:Tutorial')->FindAllTutoriales();

//        $cantidad=$em->getRepository('LRNProtectBundle:Noticias')->CantidadDatos();

        $temp= 0;  //se utiliza como bandera para que no salga el paginador

        return $this->render('LRNProtectBundle:Default:noticias.html.twig', array(
            'entities'=>$entity,
            'entity'=>$noticia,
            'form'=>$form->createView(),
            'categoria'=>$categorias,
            'cantidad'=>$temp,
            'tutoriales' => $tutoriales));
    }

    /**
     * Lists all Noticias entities.
     *
     * @Route("/", name="lrn_noticias")
     * @Template("LRNProtectBundle:Default:noticias.html.twig")
     */
    public function noticiasAction()
    {
        $noticia=new Noticias();
        $form= $this->createNombreForm($noticia);
        $em=$this->getDoctrine()->getManager();

        $categorias=$em->getRepository('LRNProtectBundle:Noticias')->FindAllCat();
        $entity=$em->getRepository('LRNProtectBundle:Noticias')->FindUltimasNews(2);
        $cantidad=$em->getRepository('LRNProtectBundle:Noticias')->CantidadDatos();

        $tutoriales=$em->getRepository('LRNProtectBundle:Tutorial')->FindAllTutoriales();

        if (!$entity)
        {
            throw $this->createNotFoundException('No hay noticias nuevas');
        }

        $temp=floor($cantidad/2);

        if(($cantidad%2)!=0)
        {$temp=$temp+1;}

        return array(
          'entities'=>$entity,
            'entity'=>$noticia,
            'form'=>$form->createView(),
            'categoria'=>$categorias,
            'tutoriales' => $tutoriales,
            'cantidad'=>$temp
        );

    }

    /**
     * Find a Sala by Name.
     *
     * @Route("/", name="noticias_nombrePost")
     * @Method("POST")
     * @Template("LRNProtectBundle:Default:noticias.html.twig")
     */
    public function nombrePostAction(Request $request)
    {
        $noticia = new Noticias();
        $form = $this->createNombreForm($noticia);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $categorias=$em->getRepository('LRNProtectBundle:Noticias')->FindAllCat();
        $entity = $em->getRepository('LRNProtectBundle:Noticias')->FindNombreNoticia($noticia);
        $tutoriales=$em->getRepository('LRNProtectBundle:Tutorial')->FindAllTutoriales();

        if(!$entity)
        {
            throw $this->createNotFoundException('No hay Noticias bajo el nombre '.$noticia->getNombreAutor());
        }
        return array(
            'entities' => $entity,
            'form'   => $form->createView(),
            'categoria'=>$categorias,
            'entity'=>$noticia,
            'tutoriales' => $tutoriales,
        );
    }

    private function createNombreForm(Noticias $noticias)
    {
        $form = $this->createForm(new NoticiasNombreType(), $noticias, array(
            'action' => $this->generateUrl('noticias_nombrePost'),
            'method' => 'POST',
        ));

        return $form;
    }

    /**
     * Finds and displays a Noticias entity.
     *
     * @Route("/{id}", name="noticias_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $obj=new ReadMore();
        $obj->setLimite(70);
        $obj->setRomper(' ');
        $em = $this->getDoctrine()->getManager();
//
        $noticias=$em->getRepository('LRNProtectBundle:Noticias')->FindUltimasNews(3);

        foreach($noticias as $noticia)
        {
            $obj->setTexto($noticia->getTexto());
            $noticia->setTexto($obj->myTruncate());
        }

        $entity = $em->getRepository('LRNProtectBundle:Noticias')->findOneById($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Noticias entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        //$entity = new Noticias();
        return $this->render('LRNProtectBundle:Noticias:show.html.twig',array('entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
            'entities' => $noticias));
//        return array(
//            'entity'      => $entity,
//            'delete_form' => $deleteForm->createView(),
//            'entities' => $entity,
//        );
    }
}
