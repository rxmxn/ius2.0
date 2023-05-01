<?php
/**
 * Created by PhpStorm.
 * User: Ramon
 * Date: 26/04/2015
 * Time: 21:20
 */

namespace LRN\LRNProtecttBundle\DataFixtures;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use LRN\LRNProtectBundle\Entity\Videos;

/**
 * Fixtures de la entidad Paso.
 * Crea pasos de prueba con información muy realista.
 */
//la siguiente se pone si se quiere ordenado

//class MisNoticias implements FixtureInterface, ContainerAwareInterface
class MisVideos extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    // Si se quiere ordenado
    public function getOrder()
    {
        return 70;
    }

    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $nombre = [
            "Sistemas de control en tiempo real y adquisición de datos",
            "Como los medios sociales pueden hacer historia",
            "Análisis de los videos de YouTube",
            "Importancia del uso correcto de los celulares",
            "Videoclases",
            "La guerra en Israel y redes sociales",
            "Revolución",
            "Programando aplicaciones desde edades tempranas",
            "Peligros de los datos en la red"
        ];

        $rutas = [
            "CarloRatti_2011.mp4",
            "Clay Shirky_2009.mp4",
            "KevinAllocca_2011.mp4",
            "NancyLublin_2012.mp4",
            "PeterNorvig_2012.mp4",
            "RonnyEdry_2012.mp4",
            "SteveKeil_2011.mp4",
            "ThomasSuarez_2011.mp4",
            "TimBernersLee_2010.mp4"
        ];

        for ($i=0; $i<9; $i++)
        {
            $videos = new Videos();

            $videos->setNombre($nombre[$i]);
            $videos->setRutaVideo($rutas[$i]);

            $manager->persist($videos);
        }

        $manager->flush();
    }
}
