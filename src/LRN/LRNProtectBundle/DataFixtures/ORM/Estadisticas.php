<?php
/**
 * Created by PhpStorm.
 * User: Ramon
 * Date: 19/04/2015
 * Time: 17:11
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
use LRN\LRNProtectBundle\Entity\Estadisticas;

/**
 * Fixtures de la entidad Paso.
 * Crea pasos de prueba con información muy realista.
 */
//la siguiente se pone si se quiere ordenado

//class MisNoticias implements FixtureInterface, ContainerAwareInterface
class MisEstadisticas extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    // Si se quiere ordenado
    public function getOrder()
    {
        return 60;
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

        $categorias = [
            'Usuarios',
            'Acceso y utilización',
            'Acceso y utilización',
            'Frecuencia de utilización',
            'Frecuencia de utilización',
            'Dispositivos de conexión',
            'Frecuencia de utilización',
            'Preferencia',
            'Preferencia',
            'Preferencia',
            'Actividades',
            'Actividades',
            'Actividades',
            'Actividades',
            'Infracciones',
            'Infracciones'
//            'ANALITIKA','ANALITIKA',
//            'ANALITIKA','ANALITIKA','ANALITIKA','otro','otro','otro','otro','otro','iab', 'iab', 'iab', 'iab', 'iab',
//            'iab', 'iab', 'iab','ANALITIKA','ANALITIKA','ANALITIKA','ANALITIKA','ANALITIKA','ANALITIKA','otro'
        ];
        $nombre = [
            "Descripción de la tipología del usuario de redes sociales.",
            "Nivel de acceso y utilización de redes sociales",
            "Nivel de acceso y utilización de redes sociales según la cantidad de cuentas por usuario.",
            "Nivel de frecuencia de utilización de redes sociales por días/semana.",
            "Nivel de frecuencia de utilización de redes sociales por cuota de tiempo.",
            "Nivel de utilización de redes sociales según dispositivos de conexión.",
            "Nivel de frecuencia de utilización de redes sociales según dispositivos de conexión.",
            "Nivel de prioridad de redes sociales más utilizadas/visitadas.",
            "Nivel de valoración y preferencia de redes sociales.",
            "Fundamentos del nivel de valoración y preferencia de redes sociales.",
            "Principales actividades realizadas en redes sociales",
            "Nivel de preferencia de actividades realizadas en redes sociales.",
            "Nivel de anuencia sobre actividades realizadas en redes sociales",
            "Nivel de renuencia sobre actividades realizadas en redes sociales.",
            "Nivel de infracciones generales realizadas en redes sociales.",
            'Nivel de infracciones específicas realizadas en redes sociales.'

//            "Motivaciones de seguimiento de marca.",
//            "Redes y sectores de seguimiento.",
//            "Publicidad de marcas en las RRSS.",
//            "Penetración del e-comerce en RRSS.",
//            "Comparativa adolescentes vs resto población",
//            "Facebook... La red social con más uso",
//            "¿Qué redes utilizan los hombres y mujeres?",
//            "Muchas las llamadas, pocas las escogidas",
//            "Estadísticos de la red social preferida (2014).",
//            "Análisis de ANACOR, red social preferida (2014).",
//            "Red social preferida (2014).",
//            "Actividades que realizan los que prefieren Facebook",
//            "Actividades que realizan los que prefieren Twitter",
//            "Actividades que realizan los que prefieren YouTube",
//            "Actividades que realizan los que prefieren Instagram",
//            "Actividades que realizan los que prefieren Pinterest",
//            "Perfil del internauta según análisis cluster (segmentación)",
//            "Dispositivos que se usan para acceder a redes sociales.",
//            "Intención de voto.",
//            "Política y redes sociales.",
//            "¿Qué red otorga mayor ventaja en política?",
//            "Cómo proteger tu cuenta de facebook.",
//            "Usuarios globales de redes sociales y aplicaciones en el tercer trimestre de 2014.",
//            "21 amazing social media stats and facts.",
//            'Estadísticas redes sociales.',


        ];
        //$rutas = ['1.jpg', '2.jpg', '3.jpg'];

        for ($i=0; $i<16; $i++)
        {
            $estadisticas = new Estadisticas();

            $estadisticas->setCategoria($categorias[$i]);
            $estadisticas->setNombre($nombre[$i]);
            $estadisticas->setRutaImagen(($i+1).'.jpg');

            $manager->persist($estadisticas);
        }

        $manager->flush();
    }
}
