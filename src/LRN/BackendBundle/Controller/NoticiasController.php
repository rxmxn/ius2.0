<?php

namespace LRN\BackendBundle\Controller;

use LRN\LRNProtectBundle\Entity\ReadMore;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use LRN\LRNProtectBundle\Entity\Noticias;
use LRN\BackendBundle\Form\NoticiasType;
use LRN\BackendBundle\Form\NoticiasNombreType;

/**
 * Noticias controller.
 *
 * @Route("/noticias")
 */
class NoticiasController extends Controller
{

    /**
     * Lists all Noticias entities.
     *
     * @Route("/", name="backend_noticias")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('LRNProtectBundle:Noticias')->findAll();

        if(!$entities)
        {
            throw $this->createNotFoundException('Unable to find Noticias entity.');
        }

        return array(
            'entities' => $entities,

        );
    }

    /**
     * Creates a new Noticias entity.
     *
     * @Route("/", name="backend_noticias_create")
     * @Method("POST")
     * @Template("BackendBundle:Noticias:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Noticias();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $entity->subirFoto();
            $resumen=substr($entity->getTexto(),0,20);
            $entity->setResumen($resumen);     //Para mostrar un resumen en la Pag. inicio
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('backend_noticias_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a Noticias entity.
    *
    * @param Noticias $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(Noticias $entity)
    {
        $form = $this->createForm(new NoticiasType(), $entity, array(
            'action' => $this->generateUrl('backend_noticias_create'),
            'method' => 'POST',
        ));

//        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Noticias entity.
     *
     * @Route("/new", name="backend_noticias_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Noticias();
        $entity->setFechaArticulo(new \DateTime('now'));
        $form   = $this->createCreateForm($entity);

        return $this->render('BackendBundle:Noticias:new.html.twig',
            array(
                'form' => $form->createView(),
                'entity'=>$entity,
            )
        );

    }

    /**
     * Finds and displays a Noticias entity.
     *
     * @Route("/{id}", name="backend_noticias_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LRNProtectBundle:Noticias')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Noticias entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Noticias entity.
     *
     * @Route("/{id}/edit", name="backend_noticias_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LRNProtectBundle:Noticias')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Noticias entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Noticias entity.
    *
    * @param Noticias $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Noticias $entity)
    {
        $form = $this->createForm(new NoticiasType(), $entity, array(
            'action' => $this->generateUrl('backend_noticias_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        //$form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Noticias entity.
     *
     * @Route("/{id}", name="backend_noticias_update")
     * @Method("PUT")
     * @Template("BackendBundle:Noticias:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('LRNProtectBundle:Noticias')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Noticias entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);

        $rutaFotoOriginal=$editForm->getData()->getRutaFoto();
        $editForm->handleRequest($request);



        if ($editForm->isValid()) {

            if(null==$entity->getFoto()){
                $entity->setRutaFoto($rutaFotoOriginal);
            }else{
                $entity->subirFoto();
                if(!empty($rutaFotoOriginal)){
                    $fs=new Filesystem();
                    $fs->remove($rutaFotoOriginal);
                }
            }
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('backend_homepage', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Noticias entity.
     *
     * @Route("/{id}", name="backend_noticias_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
//        $form = $this->createDeleteForm($id);
//        $form->handleRequest($request);

//        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('LRNProtectBundle:Noticias')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Noticias entity.');
            }

            $em->remove($entity);
            $em->flush();
//        }

        return $this->redirect($this->generateUrl('backend_homepage'));
    }

    /**
     * Creates a form to delete a Noticias entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('backend_noticias_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }

    /**
    * Find a Noticia by Name.
    *
    * @Route("/", name="backend_noticias_nombrePost")
    * @Method("POST")
    * @Template("BackendBundle:Noticias:index.html.twig.twig")
    */
    public function nombrePostAction(Request $request)
    {
        $noticia = new Noticias();
        $form = $this->createNombreForm($noticia);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('LRNProtectBundle:Noticias')->FindNombreNoticia($noticia);

        if(!$entity)
        {
            throw $this->createNotFoundException('No hay Noticias bajo el nombre '.$noticia->getNombreAutor());
        }
        return array(
            'entities' => $entity,
            'form'   => $form->createView(),
            'entity'=>$noticia,
        );
    }

    private function createNombreForm(Noticias $noticias)
    {
        $form = $this->createForm(new NoticiasNombreType(), $noticias, array(
            'action' => $this->generateUrl('backend_noticias_nombrePost'),
            'method' => 'POST',
        ));

        return $form;
    }
}
