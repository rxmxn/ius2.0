<?php
/**
 * Created by PhpStorm.
 * User: Ramon
 * Date: 16/04/2015
 * Time: 19:56
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
use LRN\BackendBundle\Form\DocumentosType;
use LRN\LRNProtectBundle\Entity\Documentos;;
use Symfony\Component\Filesystem\Filesystem;

class DocumentosController extends Controller
{
    public function documentoCrearAction(Request $peticion)
    {
        $documento = new Documentos();
        //poner los valores que se desean por defecto
        //$documento->setPermiteEmail(true);
        //$documento->setFechaNacimiento(new \DateTime('today - 18 years'));

        $formulario = $this->createForm(new DocumentosType(), $documento);

        if($peticion->getMethod() == 'POST')
        {
            $formulario->handleRequest($peticion);

            if ($formulario->isValid())
            {
                $documento->subirPDF();
                $documento->subirImagen();

                $em = $this->getDoctrine()->getManager();

                $em->persist($documento);
                $em->flush();

                return $this->redirect($this->generateUrl('backend_documento_listar'));
                //$this->get('session')->getFlashBag()->add('notaBuena','Se ha introducido un nuevo '.$nivel);
            }
        }

        return $this->render(
            'BackendBundle:Documentos:documento_create.html.twig',
            array('formulario' => $formulario->createView())
        );
    }

    public function documentoEditarAction(Request $peticion, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $documento = $em->getRepository('LRNProtectBundle:Documentos')->findOneById($id);

        if (!$documento) {
            throw $this->createNotFoundException('Unable to find Documentos entity.');
        }

        $formulario = $this->createForm(new DocumentosType(), $documento);

        $rutaPdfOriginal=$formulario->getData()->getRutaPDF();
        $rutaImagenOriginal=$formulario->getData()->getRutaImagen();

        if ($peticion->getMethod() == 'POST')
        {
            $formulario->handleRequest($peticion);

            if ($formulario->isValid())
            {
                if(null==$documento->getPDF()){
                    $documento->setRutaPDF($rutaPdfOriginal);
                }else{
                    $documento->subirPDF();
                    if(!empty($rutaPdfOriginal)){
                        $fs=new Filesystem();
                        $fs->remove($rutaPdfOriginal);
                    }
                }

                if(null==$documento->getImagen()){
                    $documento->setRutaImagen($rutaImagenOriginal);
                }else{
                    $documento->subirImagen();
                    if(!empty($rutaImagenOriginal)){
                        $fs=new Filesystem();
                        $fs->remove($rutaImagenOriginal);
                    }
                }

                // actualizar el documento
                $em->persist($documento);
                $em->flush();

                $this->get('session')->getFlashBag()->add('notaBuena','Se ha modificado el documento');

                //Si _todo sale bien, se envia el documento para la portada.
                return $this->redirect($this->generateUrl('backend_documento_listar'));
            }
        }

        return $this->render('BackendBundle:Documentos:documento_editar.html.twig', array(
            'documento' => $documento,
            'formulario' => $formulario->createView()
        ));
    }

    public function documentoBorrarAction(Request $peticion, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $documento = $em->getRepository('LRNProtectBundle:Documentos')->findOneById($id);

        if ($peticion->getMethod() == 'POST')
        {
            // borrar el documento
            $em->remove($documento);
            $em->flush();

            return $this->redirect($this->generateUrl('backend_documento_listar'));
        }

        return $this->render('BackendBundle:Documentos:documento_borrar.html.twig', array( 'documento' => $documento ));
    }

    public function documentoListarAction()
    {
        $em = $this->getDoctrine()->getManager();

        $documentos = $em->getRepository('LRNProtectBundle:Documentos')->findAll();

        return $this->render('BackendBundle:Documentos:documento_listar.html.twig', array(
            'documentos' => $documentos
        ));
    }
}
