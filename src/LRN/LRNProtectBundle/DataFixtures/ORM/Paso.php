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
use LRN\LRNProtectBundle\Entity\Paso;

/**
 * Fixtures de la entidad Paso.
 * Crea pasos de prueba con información muy realista.
 */
//la siguiente se pone si se quiere ordenado

//class MisNoticias implements FixtureInterface, ContainerAwareInterface
class MisPasos extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    // Si se quiere ordenado
    public function getOrder()
    {
        return 30;
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
        $tutoriales = $manager->getRepository('LRNProtectBundle:Tutorial')->findAll();

        $titulos = '';
        $explicaciones = '';
//        $rutas = ['4_1.jpg', '5.jpg', '9.jpg'];

        //Facebook
        $this->newPaso($manager, 21, 0, $titulos, $explicaciones, 'fb', $tutoriales);

        //flickr
        $this->newPaso($manager, 15, 1, $titulos, $explicaciones, 'fl', $tutoriales);

        //hi5
        $this->newPaso($manager, 16, 2, $titulos, $explicaciones, 'hi', $tutoriales);

        //last.fm
        $this->newPaso($manager, 13, 3, $titulos, $explicaciones, 'fm', $tutoriales);

        //LinkedIn
        $this->newPaso($manager, 19, 4, $titulos, $explicaciones, 'in', $tutoriales);

        //myspace
        $this->newPaso($manager, 18, 5, $titulos, $explicaciones, 'my', $tutoriales);

        //orkut
        $this->newPaso($manager, 16, 6, $titulos, $explicaciones, 'or', $tutoriales);

        //tuenti
        $this->newPaso($manager, 20, 7, $titulos, $explicaciones, 'ti', $tutoriales);

        //twitter
        $this->newPaso($manager, 19, 8, $titulos, $explicaciones, 'tw', $tutoriales);

        //YouTube
        $this->newPaso($manager, 17, 9, $titulos, $explicaciones, 'yt', $tutoriales);

        $manager->flush();
    }

    public function newPaso(ObjectManager $manager, $cant_pasos, $numTutorial,
                            $titulos, $explicaciones, $prefijo_ruta, $tutoriales)
    {
        for ($i=0; $i<$cant_pasos; $i++)
        {
            $pasos = new Paso();

            $pasos->setNumero($i+1);
            $pasos->setTitulo($i+1);
            $pasos->setExplicacion($explicaciones);
            $pasos->setRutaImagen($prefijo_ruta.($i+1).'.jpg');
            $pasos->setTutorial($tutoriales[$numTutorial]);

            $manager->persist($pasos);
        }
    }
}
