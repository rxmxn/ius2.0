<?php
/**
 * Created by PhpStorm.
 * User: Ramon
 * Date: 08/04/2015
 * Time: 2:50
 */

namespace LRN\LRNProtecttBundle\DataFixtures;

use Symfony\Component\Security\Acl\Domain\ObjectIdentity,
    Symfony\Component\Security\Acl\Domain\UserSecurityIdentity,
    Symfony\Component\Security\Acl\Permission\MaskBuilder;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\SecurityContext;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use LRN\LRNProtectBundle\Entity\Tutorial;

/**
 * Fixtures de la entidad Paso.
 * Crea pasos de prueba con información muy realista.
 */
//la siguiente se pone si se quiere ordenado

//class MisNoticias implements FixtureInterface, ContainerAwareInterface
class MisTutoriales extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    // Si se quiere ordenado
    public function getOrder()
    {
        return 20;
    }

    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        // Obtener todas las ciudades de la base de datos
        //$ciudades = $manager->getRepository('CiudadBundle:Ciudad')->findAll();

        $redes = [
            'Facebook', 'flickr', 'hi5', 'last.fm',
            'LinkedIn', 'myspace', 'orkut', 'tuenti',
            'twitter', 'youtube'];
        $descripcion = "Guías de ayuda para la configuración de la privacidad y seguridad de las redes sociales.";
        $rutasPDF = ['guia_inteco_facebook', 'guia_inteco_flickr', 'guia_inteco_hi5', 'guia_inteco_lastfm',
        'guia_inteco_linkedin', 'guia_inteco_myspace', 'guia_inteco_orkut', 'guia_inteco_tuenti',
        'guia_inteco_twitter', 'guia_inteco_youtube'];
        $rutasIMG = ['fb1', 'fl1', 'hi1', 'fm1', 'in1', 'my1', 'or1', 'ti1', 'tw1', 'yt1'];

        for ($i=0; $i<10; $i++)
        {
            $tutoriales = new Tutorial();

            $tutoriales->setNombreRedSocial($redes[$i]);
            $tutoriales->setDescripcion($descripcion);
            $tutoriales->setFechaPublicacion(new \DateTime('now'));
            $tutoriales->setRutaImagen($rutasIMG[$i].'.jpg');
            $tutoriales->setRutaPDF($rutasPDF[$i].'.pdf');

            $manager->persist($tutoriales);
        }

        $manager->flush();
    }
}
