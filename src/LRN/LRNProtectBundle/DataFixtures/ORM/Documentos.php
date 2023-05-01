<?php
/**
 * Created by PhpStorm.
 * User: Ramon
 * Date: 19/04/2015
 * Time: 17:08
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
use LRN\LRNProtectBundle\Entity\Documentos;

/**
 * Fixtures de la entidad Paso.
 * Crea pasos de prueba con información muy realista.
 */
//la siguiente se pone si se quiere ordenado

//class MisNoticias implements FixtureInterface, ContainerAwareInterface
class MisDocumentos extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    // Si se quiere ordenado
    public function getOrder()
    {
        return 50;
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

        /* Temas Relacionados
         * 'Derecho de los consumidores'
         * 'Tecnologías de la información y las comunicaciones'
         * 'Protección de los derechos de los consumidores'
         * 'Internet'
         * 'Redes Sociales'
         * 'Protección de derechos en las Redes Sociales'
         * 'Protección de datos'
         * 'Protección de la seguridad de la información'
         * 'Protección de derechos en el Comercio Electrónico'
         * 'Protección de los menores de edad'
         * */

        $temaRelacionado = [
            'Tecnologías de la información y las comunicaciones',
            'Protección de los derechos de los consumidores',
            'Internet',
            'Redes Sociales',
            'Protección de la seguridad de la información',
            'Internet',
            'Internet',
            'Protección de datos',
            'Protección de la seguridad de la información',
            'Protección de derechos en las Redes Sociales',
            'Protección de derechos en el Comercio Electrónico',
            'Protección de derechos en el Comercio Electrónico',
            'Protección de derechos en el Comercio Electrónico',
            'Redes Sociales',
            'Tecnologías de la información y las comunicaciones',
            'Protección de la seguridad de la información',
            'Protección de derechos en las Redes Sociales',
            'Protección de datos',
            'Internet',
            'Tecnologías de la información y las comunicaciones',
            'Protección de datos',
            'Protección de los menores de edad',
            'Protección de la seguridad de la información',
            'Protección de los menores de edad',
            'Protección de los menores de edad',
            'Protección de derechos en las Redes Sociales',
            'Tecnologías de la información y las comunicaciones',
            'Protección de la seguridad de la información',
            'Protección de datos',
            'Protección de derechos en el Comercio Electrónico',
            'Protección de derechos en el Comercio Electrónico',
            'Protección de derechos en el Comercio Electrónico',
            'Protección de derechos en el Comercio Electrónico',
            'Protección de derechos en las Redes Sociales',
            'Protección de la seguridad de la información',
            'Protección de derechos en las Redes Sociales',
            'Protección de datos',
            'Internet',
            'Internet',
            'Protección de derechos en el Comercio Electrónico',
            'Protección de la seguridad de la información',
            ];
        $nombre = [
            "Compendio de Normatividad sobre el uso de Tecnologías de Información en el Perú.",
            "Defensa del consumidor. Análisis Comparado de los casos de Argentina, Brasil, Chile y Uruguay.",
            "RIESGOS Y AMENAZAS EN CLOUD COMPUTING",
            "SEGURIDAD EN SITIOS WEB.",
            "Estudio sobre la seguridad de la información y la e-confianza de los hogares españoles.",
            "Estudio sobre el fraude a través de Internet (2012).",
            "Estudio sobre el fraude a través de Internet (2011).",
            "Estudio sobre la protección de datos en las empresas españolas.",
            "Estudio sobre seguridad en dispositivos móviles y smartphones.",
            "Estudio sobre la percepción de los usuarios acerca de su privacidad en Internet.",
            "Guía sobre almacenamiento y borrado seguro de información.",
            "COMERCIO ELECTRÓNICO Y ECONFIANZA.",
            "Guía sobre seguridad y privacidad en el Comercio Electrónico.",
            "Guía de introducción a la Web 2.0: aspectos de privacidad y seguridad en las plataformas colaborativas.",
            "EDUCANDO EN SEGURIDAD TI.",
            "GESTIÓN DE FUGA DE INFORMACIÓN.",
            "PROTECCIÓN DEL DERECHO AL HONOR, A LA INTIMIDAD Y A LA PROPIA IMAGEN EN INTERNET ",
            "PROTECCIÓN DE DATOS DE CARÁCTER PERSONAL",
            "LA PRIVACIDAD EN INTERNET.",
            "PRIVACIDAD Y SECRETO EN LAS TELECOMUNICACIONES",
            "Guía para entidades locales: cómo adaptarse a la normativa sobre protección de datos.",
            "REDES SOCIALES, MENORES DE EDAD Y PRIVACIDAD EN LA RED.",
            "LA RESPUESTA JURÍDICA FRENTE A LOS ATAQUES CONTRA LA SEGURIDAD DE LA INFORMACIÓN.",
            "PROTECCIÓN LEGAL DE LOS MENORES EN EL USO DE INTERNET",
            "Guía sobre adolescencia y sexting: qué es y cómo prevenirlo.",
            "Guíasobre seguridad y privacidad de las herramientas de geolocalización.",
            "UTILIZACIÓN DE LAS TECNOLOGÍAS DE LA INFORMACIÓN EN EL ÁMBITO LABORAL.",
            "Guía sobre las tecnologías biométricas aplicadas a la seguridad.",
            "Guía sobre videovigilancia y protección de datos personales.",
            "Guía sobre contratación pública electrónica.",
            "Estudio sobre las tecnologías biométricas aplicadas a la seguridad.",
            "La PRoTECCIóN DE los INTEREsEs ColECTIVos o DIFUsos EN VENEzUElA.",
            "Adecuación a la Ley de Servicios de la Sociedad de la Información y de Comercio Electrónico.",
            "ALGUNAS OBRAS DIGITALES Y SU PROTECCIÓN JURÍDICA.",
            "Resumen ejecutivo del Estudio sobre seguridad en dispositivos móviles y smartphones.",
            "Resumen ejecutivo del Estudio sobre la seguridad de la información y la e-confianza de los hogares españoles.",
            "Resumen ejecutivo del Estudio sobre la protección de datos en las empresas españolas.",
            "Resumen ejecutivo del Estudio sobre el fraude a través de Internet (2012).",
            "Resumen ejecutivo del Estudio sobre el fraude a través de Internet (2011).",
            "Resumen ejecutivo de la Guía sobre contratación pública electrónica",
            "Smart Grid Security."
        ];
        //$rutasPDF = ['2779-proteccion-intereses-difusos.pdf', '05458.pdf', 'derechos.pdf'];

        for ($i=0; $i<41; $i++)
        {
            $documentos = new Documentos();

            $documentos->setTemaRelacionado($temaRelacionado[$i]);
            $documentos->setNombre($nombre[$i]);
            $documentos->setRutaPDF(($i+1).'.pdf');
            $documentos->setRutaImagen(($i+1).'.jpg');

            $manager->persist($documentos);
        }

        $manager->flush();
    }
}
