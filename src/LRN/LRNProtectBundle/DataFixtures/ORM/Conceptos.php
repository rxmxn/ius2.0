<?php
/**
 * Created by PhpStorm.
 * User: Ramon
 * Date: 19/04/2015
 * Time: 17:03
 */

namespace LRN\LRNProtecttBundle\DataFixtures;

use Symfony\Component\CssSelector\XPath\Extension\HtmlExtension;
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
use LRN\LRNProtectBundle\Entity\Conceptos;
use Symfony\Component\Translation\Tests\String;

/**
 * Fixtures de la entidad Paso.
 * Crea pasos de prueba con información muy realista.
 */
//la siguiente se pone si se quiere ordenado

//class MisNoticias implements FixtureInterface, ContainerAwareInterface
class MisConceptos extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    // Si se quiere ordenado
    public function getOrder()
    {
        return 40;
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

        $subtitulo = [
            'Introducción',
            'Redes Sociales, Ciberespacio y sociedad de la información'
            ];

        //How to interpret HTML tags inside twig template:
        //  {{ word | raw }}
        //If you want to limit the tags allowed:
        //  {{ word | stripbags('<br>') | raw }}

        $texto = [
            "
            <span style='font-weight: bold'>¿En qué consiste la problemática entre las redes sociales y el Derecho?</span><br><br>La descontrolada interacción entre el avance de las tecnologías, el incremento de la accesibilidad y participación en el ciberespacio, la proliferación de las redes sociales, las deficiencias en sus políticas de utilización, la desinformación de los usuarios y las insuficiencias legislativas sobre estas materias, ha derivado en un estado de desprotección de los individuos, su información y los derechos que ostentan sobre ella en el marco de las redes sociales y el ciberespacio. <span><br><br>En este contexto, un tema controvertido que se impone en las lindes jurídicas contemporáneas es la reflexión en torno a las redes sociales y el Derecho, desde una visión holística orientada a analizar las vulnerabilidades de los derechos asociados a la información en el marco de las redes sociales y el ciberespacio; ya que estos aspectos jurídico-legales cobran especial importancia en la consolidación de una esfera de protección &nbsp;integradora que armonice las aristas de lo preventivo, lo correctivo y lo profiláctico.</span> <br><br>La desprotección de los individuos y su información en las redes sociales, espacios de intercambio a los que los usuarios acceden sin conocimiento de las políticas de utilización y privacidad, las garantías y niveles del uso de sus datos y las consecuencias de informatizarlos en detrimento de los derechos asociados a su información; viene de la mano de la carencia de mecanismos instructivos, legislativos y tecnológicos de control para el uso seguro de las redes sociales. <br><br><span>Esto ha traído consigo un incremento de conductas como la suplantación de identidad, las violaciones de confidencialidad, el fraude electrónico, el robo de información sensible y otras prácticas ilegales (HERCE RUIZ, 2012). En consecuencia, se ha afianzado una <span>preocupación por desarrollar y perfeccionar los medios y garantías protectivos de la seguridad en los procesos de gestión de información, privacidad del usuario y regulación de la exposición pública del individuo para atenuar las consecuencias negativas del uso de las redes sociales.<span style='font-weight: bold'> </span></span></span> Resulta ineludible, entonces, examinar el uso actual de las redes sociales en el ciberespacio, analizar los mecanismos de protección existentes en la materia, determinar los factores de riesgo y principales problemáticas y proponer medidas que tributen al afianzamiento de ese necesario ámbito de salvaguardia de los derechos de los usuarios y su información en las redes sociales.<br>
            ",
            "
            <span style='font-weight: bold'>¿Redes sociales, ciberespacio y sociedad de la información?</span><br><br> En este análisis, cabe partir de que las tecnologías se han imbricado en todas las aristas de la evolución humana, debido a que las relaciones establecidas históricamente por el hombre con sus semejantes, el mundo físico y su entorno, se han cimentado en esa capacidad adaptativa que lo condujo -por medio de su evolución- al desarrollo de tecnologías de caza y recolección, a una posterior revolución tecnológica de la agricultura y la metalurgia, a una transición hacia las tecnologías de la revolución industrial; para finalmente, colocarlo en ese punto de encuentro con las contemporáneas tecnologías de la información. <br><br>Estas premisas fundamentan la función propulsora de las tecnologías en los cambios sociales, políticos y económicos en la historia de la humanidad; a un punto que hoy se visualiza en una articulación de los avances tecnológicos dentro de la ampliación del acceso, producción y gestión de la información y, la consecuente redefinición de la sociedad y las relaciones humanas en el escenario del espacio virtual o ciberespacio. <br><br><span><span>El <i>Ciberespacio</i> constituye un escenario complejo en el que convergen sujetos capaces de entablar y desarrollar “plenamente” las relaciones humanas y sociales en todos los planos de la realidad regida por el paradigma tecnológico emergente. Se hace referencia, según Hakim Bey, a un “sitio inmaterial y real a un tiempo que, a través de la interconexión de máquinas, es un espacio de comunicación entre dispositivos automatizados administrados por personas. Un territorio de acción en el que se compra, se vende, se vota, se opina, se conspira, se pierde y se gana dinero...Se generan códigos e identidades, se estructuran movimientos sociales y se traslada el conjunto de la actividad social” (BEY, 1997). Este término alude a la construcción de un modelo de ficción fundamentado en operaciones intelectuales y algoritmos matemáticos bajo el dominio de la lógica binaria y la representación digital, que proyecta una recreación de los rasgos fundamentales de la realidad objetiva: las relaciones humanas, el poder hegemónico, la política, la economía, la cultura y la progresiva supremacía de la tecnología en la vida (BEY, 1997).</span>[1]<br><br></span>La consecuencia cardinal que ha tenido el afianzamiento del ciberespacio así concebido, ha sido la apertura hacia<span> la <i>Sociedad de la Información</i>, concepto hegemónico que designa a la sociedad postindustrial contemporánea y al modelo social integrador centrado en el individuo y orientado al desarrollo de mecanismos para crear, consultar, utilizar y compartir la información. Los teóricos de esta doctrina señalan que el incremento de la producción de información organizada, soportada y procesada digitalmente; la acentuación de la necesidad y capacidad de acceso, interacción, retroalimentación y gestión de la información en la dinámica social y el soporte de la infraestructura y la superestructura sociales en la información y las tecnologías, son algunas de sus características rectoras (GENTA, 2008). </span><span>Este trinomio contemporáneo de ciberespacio, sociedad de la información y evolución tecnológica tiene su referente en el establecimiento y desarrollo de la <i>Web 2.0</i> o web social por su enfoque colaborativo y de construcción social,[2] punto de partida para la adherencia de las redes sociales en <i>internet</i> y la mayor integración de estos medios a las actividades humanas.</span> <div><br><br> <div> [1]BEY sostiene que se puede afirmar que el ciberespacio es una representación o mediación entre el sujeto y lo real, ya que sustituye esa realidad objetiva por una realidad “ideacional” basada en la recreación imaginaria de lo real, la manipulación técnica y material de la realidad y su redefinición en un proceso social de comunicación: hoy lo real es la información. </div><br> <div> <span>[2]<span>El término Web 2.0 refiere al conjunto de aplicaciones y páginas de <i>internet</i> que utilizan la inteligencia colectiva para proporcionar servicios interactivos en red dando al usuario el control de sus datos, según “Conferencia el maravilloso mundo de la web 2.0: Redes Sociales”.</span></span> </div> </div> <br>
            "
        ];

        //$rutas = ['4_1-bw.jpg', '5-bw.jpg', '9-bw.jpg','4_1-bw.jpg', '5-bw.jpg', '9-bw.jpg'];

        for ($i=0; $i<2; $i++)
        {
            $conceptos = new Conceptos();

            $conceptos->setSubtitulo($subtitulo[$i]);
            $conceptos->setTexto($texto[$i]);
            $conceptos->setRutaImagen(($i+1).'.jpg');

            $manager->persist($conceptos);
        }

        $manager->flush();
    }
}
