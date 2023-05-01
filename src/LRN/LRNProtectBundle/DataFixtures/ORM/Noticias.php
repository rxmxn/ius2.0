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
use LRN\LRNProtectBundle\Entity\Noticias;

/**
 * Fixtures de la entidad Noticias.
 * Crea noticias de prueba con información muy realista.
 */
//la siguiente se pone si se quiere ordenado

//class MisNoticias implements FixtureInterface, ContainerAwareInterface
class MisNoticias extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    // Si se quiere ordenado
    public function getOrder()
    {
        return 10;
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

        $titulos = [
            'Las redes sociales: peligros y potencialidades.',
            'Un estudio de McAfee alerta de los riesgos para la privacidad derivados de las rupturas de pareja.',
            'El ciberbullying sucede más entre antiguos amigos y novios, afirma un estudio.',
            'Generaciones Interactivas en Brasil: niños, niñas y adolescentes ante las pantallas.',
            'La cara oculta de las páginas de citas online.',
            'Menores de 13 años en Redes Sociales aumentan peligros de agresión y acoso.',
            'Un niño es víctima de Bullying ¿qué hago?',
            'Investigación señala que se debe permitir que los niños “descubran la red”.',
            'Facebook nos engancha a base de dopamina.'];
        $autores = [
            'www.tintaroja.es, Carlos Casado',
            'www.riesgosinternet.wordpress.com',
            'www.riesgosinternet.wordpress.com',
            'www.riesgosinternet.wordpress.com',
            'es.sos-internet.com',
            'www.protecciononline.com',
            'www.protecciononline.com',
            'www.protecciononline.com',
            'www.riesgosinternet.com'];
        $categorias = [
            'Riesgos en Internet',
            'Riesgos en Internet',
            'Ciberbullying',
            'Riesgos en Internet',
            'Riesgos en Internet',
            'Menores de edad',
            'Menores de edad',
            'Menores de edad',
            'Redes Sociales'];
        $textos = [
            "
            <p style='text-align: justify;'>
                Las redes sociales son hoy una parte importante en la vida social de la juventud. Es poco frecuente
                que un joven no haga uso de una de estas redes. Se da además la circunstancia de que es cada vez
                mayor el tiempo que la juventud pasa sumergida en ellas y, por tanto, menor el tiempo que dedica
                a otros aspectos de la vida.<br>
                Las  redes  sociales  son  tanto  un  espacio  para  la  vida  militante  como  para  el  desarrollo  de las
                relaciones personales, y tanto para la una como para la otra, las redes entrañan peligros y a la vez
                oportunidades.<br>
                Existen  numerosas  y  recientes  estadísticas  que  muestran  cómo  la  juventud reduce el tiempo
                empleado  en  actividades  deportivas,  lúdico-festivas,  culturales,  viajes,  etc.,  mientras que
                aumenta el tiempo empleado en las redes sociales. Sin embargo, estas estadísticas no muestran un
                desinterés de la juventud por estas actividades, sino una falta de medios para llevarlos a cabo. La
                juventud sí está interesada en el deporte, en la cultura, en conocer mundo y demás actividades
                enriquecedoras, prueba de ello son las páginas visitadas en Internet o los temas que se tratan en
                las redes sociales (mostrados también en múltiples artículos de investigación).<br>
                Como  hemos  dicho,  es  la  falta  de  medios  el  principal  factor  que  empuja  a  la  juventud a la
                pasividad y la resignación de buscar en las redes sociales lo que el capital y su crisis no permite
                realizar en la vida real.<br>
                Cuando la juventud es condenada al paro, a la escasez y la precariedad, su futuro se vuelve aún
                más incierto, y ya no es sólo que le sea materialmente difícil viajar, ir al teatro, hacer deporte, o
                incluso desplazarse para su militancia política, sino que moralmente se va minando las ganas y el
                interés por llevar estas actividades a cabo, arrojando a la juventud a la frustración.
                Por  otro  lado,  la  necesidad  infundada  por  el  capital  del  uso  de  las  redes  sociales, con la falsa
                sentencia que afirma que &quot;sin redes sociales te quedas aislado&quot;, hace de profecía auto cumplida, y
                termina sumiendo a la juventud en un interminable ciclo de introducción y actualización de sus
                redes sociales (del Tuenti al Facebook, del Twiter al WhatsApp). Una vez más, el capital creando
                necesidades  ficticias  que  son  percibidas  por  los  jóvenes  como  una  necesidad  real,  presente
                constantemente en sus vidas.<br>
                Teniendo esto presente, los comunistas debemos saber ver la potencialidad de estos espacios, ya
                que suponen una extensa red social en la que tienen presencia sectores trabajadores y populares,
                de nuestras compañeras y compañeros de estudios y de trabajo. Y no sólo de los nuestros, de los
                cercanos,  sino  de  aquellos  que  ni  si  quiera  conocemos  y  que  no  interactúan  con  nosotros en
                nuestros aún limitados espacios de intervención. De esta forma, y sabiendo darle buen uso, la red
                social  nos  permite  lanzar  nuestro  mensaje  y  nuestras  consignas  a  una amplísima cantidad de
                trabajadoras y trabajadores y de estudiantes, incluso, en el plano internacional.<br>
                Por  tanto,  la  red  social  es  para  los  comunistas  un  medio  más  de agitación y propaganda, de
                difusión de información y de ideología. De la misma forma que lanzamos información, también la
                percibimos, pudiendo estar al tanto de lo que acontece en nuestro entorno de manera rápida y,
                por su puesto, sin grandes costes económicos.<br>
                Sin embargo, pese a estas potencialidades, las redes sociales suponen un riesgo y un peligro para
                sus usuarios, tanto en su vida privada revelación de datos personales y de su vida íntima, acosos,
                etc.) como para su vida militante.<br>
                En este segundo caso, los jóvenes que expresen en este medio sus inquietudes políticas, más aun
                los comunistas, deben estar precavidos, y tratar con mucha cautela la información y el uso que
                hacen dentro de sus redes sociales. Por todos es ya sabido la facilidad y frecuencia con la que la
                policía accede a nuestros perfiles personales y las consecuencias legales que puede llegar a tener
                expresar tal o cual opinión en un espacio de este tipo.
                Pero no es solo la represión policial la que debe mantener alerta a la juventud, sino también el uso
                que  pueden  hacer  y  hacen  los  grupos  fascistas.  Estos  mamporreros  del capital pueden tener
                acceso  a  nuestros  perfiles  con  facilidad  y  utilizarlos  para  atacar  a  la  juventud  consciente y
                combativa. Ante esto, los jóvenes tenemos que tenerlo claro: no facilitemos ni un solo dato a los
                enemigos de la clase trabajadora y de sus hijas e hijos.
                Por otro lado, debemos saber darle un buen uso a las redes sociales, y para ello debemos tener
                algunas cosas más presentes, tales como: saber tratar con cautela la información recibida, ya que
                como es sabido, en las redes sociales es muy sencillo y frecuente distorsionar la realidad (cuántas
                veces nos han matado a Fidel, o cuántos &quot;me gusta&quot; en Internet y qué poquitos en las calles, etc.).
                Esto nos lleva a otro mal uso militante de las redes. Y ese no es otro que el de la
                &quot;cibermilitancia&quot;.<br>
                El uso militante de las redes no debe ser otro que el reflejo de la vida y el trabajo en la vida real. De
                nada sirve magnificar la presencia o los discursos en Internet si los hechos no los respaldan.
                En este mismo orden de cosas, se debe situar la cautela a la hora de gestionar un perfil personal y
                tener presente que pese a ser personal, la imagen de un militante va ligada a la de su partido, la
                imagen de un comunista va ligada a la del comunismo, y sus palabras o las imágenes que circulen
                por las redes irán vinculadas a las de su proyecto político.<br>
                Teniendo  siempre  presente  los  peligros  y  las  potencialidades  de  las redes sociales, la juventud
                obrera y popular debe saber usarla conforme sus intereses y sus objetivos, teniendo siempre en
                cuenta que es un medio de información, difusión, de entretenimiento, pero sólo un medio más,
                entre muchos otros quizás no tan amplios y rápidos, pero sí más productivos y enriquecedores.
            </p>
            ",
            "
            <p style='text-align: justify;'>
                Con motivo del día de San Valentín, el 36% de las personas tenía previsto
                enviar una foto atrevidaa su parejaa través de un mensaje de texto, correo
                electrónico o red social, según una encuesta acerca del fabricante
                estadounidense de antivirus McAfee que fue publicada la pasada semana.
                Según el estudio, una de cada 10 personas implicadas en una ruptura
                sentimental amenazó con publicar online una foto reveladora de su
                expareja y el 60% cumplió dicha amenaza.<br>
                Se descubrió que más del 50% de los encuestados compartió su
                contraseña con una pareja.<br>
                Mucha gente considera equivocadamente que compartir sus contraseñas con
                su pareja en una muestra de amor, pero cuando la relación termina mal es
                necesario cambiarlas de inmediato, advierten desde McAfee.<br>
                Más del 56% de los encuestados había espiado los perfiles en las redes
                sociales e incluso las cuentas bancarias de sus parejas y el 48,8% había
                revisado sus correos electrónicos.<br>
                El hábito de espiar en línea va más allá de las parejas actuales. Los
                encuestados reconocieron haber espiado también a sus exparejas, así como a
                las exparejas de sus actuales novios, en sitios como Facebook y Twitter.<br>
                En la encuesta se descubrió que los hombres son más propensos que las
                mujeresa revisar subrepticiamente las cuentas personales de sus parejas y a
                vigilar a sus exparejas en redes sociales.<br>
                Erika Holiday, psicóloga clínica especialista en temas de pareja recomienda
                abstenerse de compartir este tipo de información personal “hasta que de
                verdad conozcas a una persona. Y eso lleva años, incluso décadas. Lleva mucho,
                mucho tiempo”.<br>
                La prevenciónes la única forma de protegerte realmente y hay algunas
                medidas de seguridad prácticas que deberían ser universales.
                Empieza por bloquear con contraseña tus dispositivos móviles y tu
                computadora. Cuando te sientas cómodo en una relación, puedes ser más
                flexible con la seguridad. Se recomienda ponerle contraseña a los smartphones
                sin importar el estatus de la relación.<br>
                También es recomendable instalar software antivirusen tus dispositivos
                electrónicos, especialmente en los teléfonos y tablets, para proteger mejor
                cualquier información confidencial que tengas guardada. También instala
                software de rastreo que permita borrar a distancia la información de un
                dispositivo perdido o robado.<br>
                Con respecto a enviar fotos de sextingo compartir contraseñas el consejo es
                claro: simplemente no hacerlo. No hay que sentirse en ningún caso obligado
                a hacerlo y eso no significa que estés ocultando algo.<br>
                Una vez que se comparte una foto o un vídeo a través de un mensaje de texto
                o de un correo electrónico, el creador pierde el control sobre lo que ocurre
                con ese material. Para sacar de circulación un contenido como ese, el receptor
                tendría que aceptar borrar todas las copias de ese material de su teléfono o
                cuenta de correo electrónico. Pero confiar en que alguien hará esto es más
                difícil si la relación terminó mal. Y si la otra persona lo compartió aunque sea
                solamente con una más, será imposible controlar que tus fotos personales se
                divulguen.<br>
                Después de una ruptura tus opciones son limitadas. Cambia de inmediato tus
                contraseñaspara proteger tu información personal. Si tu ex tiene fotos o
                datos comprometedores, puedes intentar razonar con él o ella y pedirle que
                borre esos archivos.<br>
                En el estudio de McAfee, algunos encuestados dijeron que sí publicarían
                datos privados de sus parejassi estas:<br>
                <ul style='text-align: justify;'>
                    <li>Les mienten (45%).</li>
                    <li>Los engañan con otras personas (40%).</li>
                    <li>Terminaran con ellos (26%).</li>
                    <li>O cancelaran su boda (14%).</li>
                </ul>
                <p style='text-align: left;'>Fuente: CNN México.</p>
            </p>
            ",
            "
            <p style='text-align: justify;'>
                Según un estudio acerca de la cyber-aggressionpublicado por la Universidad
                pública de Pensilvania y la Universidad de California, el ciberbullying ocurre
                mayormente entre amigos, ex-amigos y compañeros de clase, pero no es
                habitual entre desconocidos. También ocurre entre ex-novios y ex-novias.<br>
                Los homosexuales también tienen más posibilidades de acabar siendo
                víctimas, como ya habían mostrado anteriores estudios, y es también más
                común que quien acabe siendo victima sea relativamente popular, mientras
                que las personas más marginadas y menos populares no sufren tanto
                ciberacoso (por el hecho de tener menos amigos/conocidos, y por tanto
                menos probabilidades de ser hostigado).<br>
                La relación de amistad mencionada en el estudio no tiene por qué ser reciente
                (no tienen por qué ser actualmente amigos), pero ha debido de existir una
                relación de amistad anterior ya que de ahí sale el conocimiento de cómo
                hacer daño a la víctima, indica este estudio.<br>
                <p style='text-align: left;'>Fuente: News Track India.</p>
            </p>
            ",
            "
            <p style='text-align: justify;'>
                ¿Cómo utilizan la tecnología los niños, niñas y adolescentes brasileños?<br>
                ¿Cual es la influencia que tienen estos dispositivos y servicios en su
                comportamiento, aprendizaje y su capacidad de socialización?<br>
                Estas son cuestiones abordadas por la investigación que la
                Fundación Telefónica Vivo, en colaboración con el Foro Generaciones Interactivas,
                Ibope y la Escuela del Futuro (USP) han llevado a cabo. En el
                estudio se entrevistó a 18.000 niños, niñas y adolescentes
                de edades comprendidas entre los 6 y los 18 años. Estos menores son
                estudiantes de escuelas públicas y privadas, tanto de zonas urbanas como de
                zonas rurales de cinco regiones del país. “Con esta muestra, creemos tener
                una imagen bastante representativa de la generación futura, quienes ya están
                utilizando tecnologías punteras”, dijo Antonio Carlos Valente, presidente del
                Grupo Telefónica en Brasil.<br>
                En su opinión, además de ser un instrumento de mejora, la investigación tiene
                la función de proporcionar subvenciones para el desarrollo de acciones
                relacionadas con la innovación educativa:“Cuanto más conocemos a los niños y
                jóvenes que han nacido conectados, los llamados nativos digitales, podremos
                hacer mejoresplanes de aprendizaje y promover el uso responsable de las
                pantallas digitales”.<br><br>
                Algunas de las Estadísticas del estudio.<br>
                <ul style='text-align: justify;'>
                    <li>Brasil cuenta con un 45% de hogares con computador, y hasta un 38% de
                    hogares conectados a Internet. El grado de penetración de las nuevas
                    tecnologías es mayor en el sur que en el norte. En zonas rurales, hasta un
                    90% de los hogares no cuentan con conexión a Internet.</li>
                    <li>
                    Para qué usan Internet : las actividades más practicadas por los
                    internautas brasileños son, por orden descendiente de importancia:
                        <ul>
                            <li>Comunicación (91%).</li>
                            <li>Búsqueda de información (86%).</li>
                            <li>Ocio (85%).</li>
                            <li>Educación (67%).</li>
                            <li>Consultas de precios de productos y / o servicios (59%).</li>
                            <li>E-government (31%).</li>
                            <li>Servicios financieros (24%).</li>
                            <li>Y la divulgación o venta de cualquier producto y / o servicio a través
                            de Internet (7%).</li>
                        </ul>
                    </li>
                    <li>En el ámbito de las actividades de comunicación, las más comunes son:
                        <ul>
                            <li>Enviar y recibir correo electrónico (78%).</li>
                            <li>Enviar mensajes instantáneos (72%).</li>
                            <li>Participar en redes sociales como Facebook, Orkut y Linkedin (69%).</li>
                            <li>El chat de voz a través de programas como Skype (23%).</li>
                            <li>Usar microblogs como Twitter (22%).</li>
                            <li>Creación o actualización de sitios como blogs (15%).</li>
                            <li>Unirse a las listas de correo o foros (14%).</li>
                        </ul>
                    </li>
                    <li>Teléfonos celulares:
                        <ul>
                            <li>Penetración de los teléfonos móviles: en 2011, esta proporción
                            alcanzó el 87%, siendo la penetración más importante en las zonas
                            urbanas (91%) que en las rurales (69%).</li>
                            <li>Un 66,9% de los niños usa el teléfono para jugar frente a un 56,1% y
                            un 23,4 que lo utiliza para hablar y para publicar. Tan solo lo utiliza
                            para navegar un 11,1%.</li>
                            <li>Los adolescentes sin embargo utilizan el teléfono un 89,5% para
                            hablar, un 60,8% para enviar mensajes y un 49,2% para jugar.
                            <li>El 28,4% de los padres compraron un teléfono móvil a sus hijos
                            cuando éstos lo pidieron.</li>
                            <li>Un 16,4% de los niños y un 15,4% de las niñas tuvieron su primer
                            teléfono a los 8 años o menos. Un 70,4% de los niños y el 73,7% de las
                            niñas llegaron a tenerlo con 12 o menos.</li>
                        </ul>
                    </li>
                    <li>Videojuegos:
                        <ul>
                            <li>En la industria del entretenimiento, la industria de los juegos es el de
                            más rápido crecimiento en Brasil desde mediados de la década
                            pasada, siguiendo una tendencia mundial similar. A finales de 2011 se
                            estimaba que había 35 millones de usuarios de videojuegos en Brasil,
                            lo que equivale al 75,1% de la población activa en Internet (de 10 a 65
                            años). Los usuarios de los videojuegos en Brasil juegan 10,7 horas
                            semanales, casi equivalente al doble del tiempo que pasan viendo
                            televisión: 5.5 horas a la semana.</li>
                            <li>Juegan 19,2 millones de hombres- o el 83% de la población activa
                            masculina en la Internet – y 15,8 millones de mujeres – o el 69% de la
                            población activa femenina en la red. La comunidad de jugadores está
                            compuesta por jugadores de todo el mundo que juegan tanto en
                            pdfcrowd.com open in browser PRO version Are you a developer? Try out the HTML to PDF API
                            consolas de videojuegos como en ordenadores.</li>
                            <li>Un 59,5% de los adolescentes juega online; un 70,6% de los chicos
                            frente a un 49,9% de las chicas.</li>
                            <li>En su mayoría, los hombres juegan a juegos de carreras de coches (un
                            36,9%) seguido por algunos juegos de deportes (fútbol) 32,1%. Las
                            mujeres juegan a videojuegos sociales en comunidades virtuales
                            como The Sims (17,3%).</li>
                            <li>Es de destacar que la gran mayoría de los jóvenes que utilizan las
                            consolas en Brasil lo hacen con una generación de consolas anterior
                            (Wii, Playstation 2, Gameboy …) y por lo tanto están participando
                            menos en el juego online.</li>
                            <li>Tanto hombres como mujeres acostumbran a jugar solos (42 y 37%,
                            respectivamente), pero un 37,6% reconoce que es más divertido jugar
                            acompañado.</li>
                            <li>Durante el fin de semana, un 28,1% de los chicos juega más de dos
                            horas.</li>
                            <li>Un 43,4% tiene un juego pirata y un 31,3% los descarga de Internet.
                            El 61% de los padres deja que los adolescentes jueguen a cualquier
                            juego.</li>
                        </ul>
                    </li>
                    <li>Ubicación del ordenador: el 37,6% de los niños y niñas lo tienen en su
                        habitación, y el 23,3% en el salón. Entre los adolescentes, el 39,3% lo tiene
                      en su habitación y el 25,5% en el salón.</li>
                    <li>Tener un antiviruses común entre el 77,5% de los adolescentes (80% las
                        mujeres, y 75% los hombres).</li>
                    <li>Tan solo un 11,2% de los niños utiliza Internet para enviar y recibir
                        correos electrónicos. Sin embargo, el correo electrónico es el servicio más
                        utilizado por los adolescentes (55%).</li>
                    <li>Un 31,8% de los adolescentes utilizan Internet por más de dos horas
                        58,6% de los niños usa Internet sin compañía. Sólo alrededor del 20% lo
                        utiliza con su madre o con su padre. Los adolescentes navegan solos
                        normalmente (76,5%).</li>
                    <li>69,6% buscacontenidos musicalesy 61,3% videojuegos.</li>
                    <li>82,2% de los adolescentes utiliza las redes sociales, y al igual que en
                        otras regiones, lo utilizan más las mujeres que los hombres.</li>
                    <li>Orkutsigue siendo el rey de las redes sociales con un 93,5% de uso,
                        frente al 28,4% de Facebook.</li>
                    <li>Un 51,1% de los adolescentes reconoce usar la cámara webde vez en
                        cuando a la hora de chatear.</li>
                    <li>Ciberadicción:
                        <ul>
                            <li>Un 35% sufre de ansiedad e irritación cuando no puede navegar.</li>
                            <li>El 74,6% de las discusiones relacionadas con Internet que tienen con
                            los padres suele ser debido al excesivo tiempo que los adolescentes
                            están conectados.</li>
                            <li>Nomofobia: un 29,1% reconoce que lo pasaría mal si no tuviera
                            acceso al móvil por dos semanas.</li>
                            <li>Un 57% de los adolescentes desconecta el móvil en clase, y un 20% al
                            dormir. Hay un 35% que nunca lo desconecta.</li>
                            <li>Un 47,2% suele recibir mensajes por la noche cuando duermen y esto
                            pueden alterar su descanso.</li>
                        </ul>
                    </li>
                    <li>Entre Internet y el móvil, los adolescentes prefieren Internet (61% varones
                        y 56% mujeres).</li>
                    <li>Grooming:
                        <ul>
                            <li>Un 30% llegó a conocer personalmente a amigos conocidos a través de internet.</li>
                            <li>A un 9,5% le parece divertido charlar con extraños en Internet.</li>
                            <li>Un 5.2% recibió mensajes obscenos o de personas desconocidas.</li>
                        </ul>
                    </li>
                    <li>Cyberbullying: Un 12,7% utiliza el móvil para enviar mensajes, fotos o
                        vídeos ofensivos contra alguien.</li>
                    <li>Privacidad: Los padres de los niños, niñas y adolescentes encuestados
                        suelen prohibir o aconsejar que no se dé información personal (52,0%) o
                        que no se hagan compras online (50,6%).</li>
                </ul>
                <p style='text-align: justify;'>Fuente: Estudio “Brasil Generaciones Interactivas: Los niños, niñas y
                    adolescentes frente a las pantallas” (PDF) y la Fundación Telefónica Vivo.</p>
            </p>
            ",
            "
            <p style='text-align: justify;'>
            Desde Sos Internet, preocupados con la gran cantidad de personas estafadas por páginas de citas,
            se comunican con la Fundación Protección Online para compartir informaciones útiles y recomendaciones
            antes de crearse un perfil en una página de citas. Buscar pareja en internet es una opción cada día más
            común: el mercado de las páginas web está totalmente asentado en nuestra sociedad y en pleno crecimiento.
            <br><br>

            Esto lo afirma el sitio <i>Pew Research Center</i>, donde sostienen que 1 de cada 3 usuarios de estos
            servicios han sido clientes de páginas de citas de pago y el 54% de estos usuarios no han estado contentos
            con el resultado.<br><br>Según estadísticas de Alexa.com y mywot.com, el sector de las páginas de citas
            online es una industria que no conoce la crisis: el mercado de las web de citas está estimado en 1,3 miliar
            de dólares (2,8% de crecimiento anual).<br><br>Cualquiera puede crear una página de citas en una hora,
            sin poder asegurar además que detrás de estos perfiles haya usuarios reales. Esta situación hace de las
            páginas de encuentros uno de los negocios más fructíferos en la actualidad. Su modelo económico se repite
            en cada nueva página que se crea, y está basado en las siguientes tres premisas:<br>
            <ul>
            <li>ABONOS MENSUALES: Entre 25 y 78€.</li>
            <li>RENOVACIÓN AUTOMÁTICA.</li>
            <li>DIFICULTAD DE RESCISIÓN: Retención de la clientela.</li>
            </ul>
            Pero, ¿quién está dispuesto a abonar 50€ mensuales aproximadamente para encontrar a su media naranja?
            La respuesta es NADIE. Las páginas de citas inscriben a sus usuarios a estos abonos de pago con
            diferentes engaños.
            <br><br>

            <b>ENGAÑOS COMUNES QUE DEBÉS CONOCER</b><br><br>

            <ol>
            <li>Proponen una oferta de ensayo a un bajo precio, que se transformará en un abono mensual a un precio
            bastante superior, y renovable automáticamente al final del contrato.</li>
            <li>Piden al usuario demostrar su mayoría de edad mediante la introducción de los datos bancarios,
            procediendo acto seguido a la inscripción.</li>
            </ol>
            Estas páginas aprovechan que los usuarios NO LEEN
            los « Términos y Condiciones de uso », donde están especificados los términos de subscripción. Además,
            los internautas confían en estos sitios, cegados por la publicidad: 100% gratuito o sin compromiso.<br><br>

            Igualmente, la poca claridad con la que estos datos son obtenidos, los usuarios se encuentran con un
            problema más serio: no poder darse de baja.Los links de desuscripción están escondidos o bien no existen,
            y la única manera de saber cómo proceder a la cancelación del servicio es leer los términos y condiciones,
            que a veces imponen vías tan improbables de darse de baja como el envío de faxes.<br><br>Por ello, para
            reconocer una página de citas deshonesta, se recomienda seguir estos consejos:<br><br>
            <ol>
            <li>Busque, antes de inscribirse, los “Términos y Condiciones de uso”: si este archivo no está o no
            está traducido, no confíe en la página. Es práctica habitual de grandes corporaciones cuyo sistema de
            negocio no es claro o está basado en el engaño, el no dar toda la información necesaria a sus clientes.</li>
            <li>Razón social de la empresa: si buscando en las “Condiciones generales de utilización” o en la “Política
            de Privacidad” se percata que la razón social de la empresa es difícil de encontrar, no está especificada,
            o no puede subrayar el nombre porque se trata de una imagen, dude de la intencionalidad de la empresa.</li>
            <li>Tarjeta de crédito como garantía: si la página web le pide sus datos bancarios como garantía de su
            mayoría de edad, para probar su identidad o bien para pagar una oferta por un corto periodo de tiempo,
            dude de la veracidad de estas afirmaciones.</li>
            <li>Fotografías muy atrayentes: si en la página de
            inscripción nos encontramos con fotografías de personas excepcionalmente atractivas, o solamente nos
            encontramos con perfiles femeninos, puede dudar seriamente de la veracidad del contenido. Pregúntese
            a sí mismo, ¿cómo es posible que la página web sepa que usted es un hombre?</li>
            <li>Contacto casi instantáneo por chat: si, cuando ni siquiera ha terminado de rellenar su perfil o
            de confirmar su cuenta, ya hay usuarios que intentan contactarle por el chat de la página, y para
            contestar debe pagar, desconfíe, pues lo más probable es que se trate de programas instalados en la
            página: perfiles falsos para convencer al usuario.</li><li>Link de desuscripción: Una vez se haya
            inscrito, compruebe dónde está el link para darse de baja. Si no lo encuentra o no puede hacer click
            sobre él, lo más recomendable es que proceda a darse de baja: probablemente se trata de una página
            malintencionada.</li></ol>Si tenés problemas para darte de baja, la sociedad
            <a rel='nofollow' target='_blank' href='http:es.sos-internet.com'>Sos Internet</a> se encarga de
            acompañar a los usuarios en el proceso de darse de baja, eliminación de datos personales y cancelación
            de perfiles.<br>
            </p>
            ",
            "
            <p style='text-align: justify;'>
            Las Redes Sociales virtuales presentan un entorno ideal para interactuar, hacer amigos y conocer a otras
            personas, compartir ideas, fotografías, videos y mucho más. Esta plataforma se caracteriza por su aspecto
            tanto positivo como negativo según el uso que se le brinde y los cuidados que se tenga a la hora de
            compartir datos personales y saber con quiénes lo estamos compartiendo.<br><br>

            La corta edad con las que los niños acceden a las Redes Sociales y crean cuenta en plataformas como en
            Facebook resulta alarmante. La gran mayoría de las Redes Sociales deben tener cumplido 1 3 años como
            política de las condiciones de uso, esto, en la práctica, no se tiene en cuenta por la may oría de los
            menores que ingresan datos falsos para crearse una cuenta. Esta acción se presta a que los menores accedan
            sin los cuidados ni recomendaciones necesarias y pueden ser víctimas de Cyberbulling, Sexting, Grooming y
            cualquier tipo de pornografía infantil por parte de pedófilos que, así como ellos, podrían no ser tan
            sinceros con sus datos y presentándose como un niño o niña de su misma edad.
            <i>¿Cómo notarían la diferencia?</i><br><br>

            Lo alarmante del caso sobresale de un estudio realizado en Reino Unido por el ente regulador de las
            Comunicaciones de Reino Unido y recientemente fue publicado por el sitio de y ahoonoticias. En estos datos
            se resalta la poca privacidad de los menores que comparten informaciones con cualquier usuario que se
            encuentra en Facebook, gran parte de los menores ni llegan al mínimo de edad requerido y en su may oría,
            los padres de estos menores no están enterados que sus hijos cuentan con un perfil en estas paltaformas
            sociales.<br><br>Otros datos: <br>
            <ul>
            <li>El 17% de los niños británicos que usan redes sociales no
            protegen su privacidad.</li>
            <li>Uno de cada cuatro menores de entre 8 y 1 2 años tiene perfiles en las
            redes sociales Facebook o My Space, aunque la edad mínima para inscribirse en dichos webs es
            de 13 años.</li>
            <li>El 17% de estos menores tenía configurada la privacidad de tal manera que otros usuarios podían ver
            sus detalles personales. Sólo el 4% tenía perfiles completamente privados.</li><li>El 17% de sus padres no
            tenían conocimiento de estos perfiles. De los que sí lo sabían, el 10% no controlaba qué hacían sus hijos
            en dichas redes.</li><li>El 37% de los menores internautas de entre 5 y 7 años habían
            visitado Facebook.</li>
            <li>El 70% de los usuarios más jóvenes creían todo o casi todo lo que leían en webs como la Wikipedia o
            los blogs.<br></li>
            </ul>
            </p>
            ",
            "
            <p style='text-align: justify;'>
            Sucede muchas veces que nos topamos con casos de violencia escolar, pero ¿qué hacemos si somos testigo de
            este tipo de bullying? Tal vez algunos se armen de valor y lo comenten con algún compañero, profesora o
            padre, quizás muchos no sepan cómo afrontarlo y prefieran callarlo, te recordamos que mientras calles
            estarías siendo parte de este abuso. Hoy queremos compartir algunas recomendaciones para afrontar el acoso
            escolar.<br><br>

            Si la violencia está siendo ejercida por un maestro o algún otro personal de la institución
            educativa:<br>
            <ul>
            <li>Generalmente niñas o niños que son víctimas de violencia en sus escuelas, buscarán
            respaldo en las personas que representan para ellos redes de apoyo. Esta persona tiene la responsabilidad
            de prestar atención a los comentarios que el niño o niña refiera, buscando identificar la magnitud de la
            situación de violencia.</li>
            <li>La forma en como se establece la comunicación con el niño es básica, se le
            debe hacer saber que creen en su palabra, dejar que cuente de forma libre lo que suceda, sin interrupciones
            ni presiones.</li>
            <li>Es importante que frente al niño no muestres angustia o enojo excesivo por la
            situación de violencia que el niño le narre, esto puede incrementar la angustia del niño.</li>
            <li>Es importante que le hagas saber al niño que tú lo vas a proteger.</li>
            <li>Finalmente pregúntale al niño cómo se siente, qué quisiera hacer él para sentirse más seguro
            en su escuela.</li>
            <li>Tomar en cuenta lo que el niño o la niña opina es indispensable para que la situación de violencia
            pueda resolverse de tal forma que le afecte lo menos posible.
            Es importante que le trasmita al niño o niña que nadie tiene derecho a lastimarlo y que él o ella tampoco
            tiene derecho de lastimar a otros. Intenta explicarle el niño o niña, en un lenguaje sencillo, que para
            poder protegerlo es necesario que juntos le cuenten a las autoridades competentes para que lo protejan de
            su agresor. <br></li><li>Realizar acciones para frenar y sancionar, acciones que puedes realizar para que
            se detenga y se castigue la violencia escolar contra un niño pueden variar dependiendo del papel que tu
            desempeñas frente al niño, niña o adolescente.</li>
            </ul>
            </p>
            ",
            "
            <p style='text-align: justify;'>
            En lugar de restringir o controlar el uso de <i>Internet</i>, los padres deberían permitir que sus
            hijos descubran la red, tanto lo bueno como lo malo que encontremos allí, esto revela el informe
            elaborado por<i> Oxford Internet Institute</i> and <i>Parent Zone suggests</i>, luego de haber encuestado
            a más de 2 mil niños de 14 a 17 años en el Reino Unido. <br><br>

            Los niños de Reino Unido se encuentran
            entre los más controlados en Europa, con la mayoría de los grandes proveedores de Internet que ofrecen
            los controles parentales. Pero esto no es un sustituto de una buena crianza, concluye el informe. <br><br>

            La investigación llegó a tres conclusiones principales: <br><br>

            <ul>
            <li>Los niños que tienen relaciones <i>offline </i>positivas con sus padres son más propensos a navegar
            por la web de una manera segura.</li>
            <li>La crianza de los hijos permitiendo el uso de internet, tiene
            un impacto más positivo que si se restringe.</li>
            <li>Los adolescentes que dejan de regular el uso de
            <i>Internet </i>y el uso de medios sociales son más propensos a aprender por sí mismos nuevas habilidades
            en línea y mantener relaciones positivas en línea.</li>
            </ul>

            El Dr Andrew Przbylski, investigador del Instituto de Internet de Oxford y autor principal del informe,
            señaló que “Nuestros resultados indican que la buena crianza de los hijos permite que los niños todavía,
            aun corriendo riesgos, puedan desarrollar estrategias de resistencia a los peligros en la web”.<br><br>

            Los padres tienen que estar de acuerdo con los límites apropiados para su edad. No vamos a dejar que un
            niño de cuatro años juegue solo en el parque, y es totalmente sensato si se tiene un niño muy chico,
            también es razonable que para él se filtren algunos contenidos. Pero los niños mayores se les deben
            permitir “asumir riesgos”. Añadió Vicki Shotbolt. <br><br>La investigación fue presentada en la conferencia
            inaugural de Familia digital en Londres, que se verá en el efecto del <i>Internet </i>
            en la vida familiar.<br><br>

            <b>Cyberbullying.</b>
            <br><br>

            Cada año, <i>Ofcom </i>publica un informe que estudia el uso de los niños de los servicios digitales.
            El más reciente, publicado en este mes de octubre, encuestó a 1.600 niños de 5 a 15 años. De ellos, el
            71% tenía acceso a un equipo Tablet PC en casa y el 88% accede a Internet a través de un
            PC o portátil.<br><br>

            Entre los jóvenes de 12 a 15 años entrevistados por <i>Ofcom</i>:<br>
            <ul>
            <li>El tiempo medio de permanencia en línea era más de 17 horas a la semana.</li>
            <li>Casi un tercio de las niñas había sido intimidada en línea.</li>
            <li>22% de los niños había sido intimidado en línea.</li>
            <li>33% sobre alguien que sabían se comunicaban en línea o a través de mensaje de texto.</li>
            <li>14% había experimentado fotos embarazosas de alguien que conocían y fueron compartidas.</li>
            </ul>

            De los padres entrevistados por <i>Ofcom</i>, el 32 % utiliza algunos filtros de contenido – ya sea
            desde su ISP o de vendedores de <i>software </i>como <i>Net Nanny</i>.<br><br>

            De los padres de niños de
            8 a 11 años de edad, el 89% tenían reglas o restricciones para el uso de internet.
            Para los padres de niños de entre 12 y 15 años de edad, esta proporción se redujo al 72%.
            </p>
            ",
            "
            <p style='text-align: justify;'>
            Según publicó la pasada semana el web Mashable, las adicciones a Internet —especialmente a las redes 
            sociales— han sido ampliamente documentadas. En el caso de Facebook el mecanismo adictivo funcionaría 
            de la siguiente manera: cada vez que recibimos y vemos una notificación nueva recibimos un chute de 
            dopamina, neurotrasmisor químico asociado con la motivación y la recompensa. Es la droga de la novedad, 
            que también actúa cuando se consumen drogas o se mantienen relaciones sexuales. Y las redes sociales 
            podrían estar provocando el mismo efecto adictivo.<br><br>
            En países como China, Taiwán y Corea del
            Surla adicción a Internetya está aceptada a nivel de diagnóstico psicológico. En los EE.UU. se prevé
            incluirla en la nueva edición del manual de referencia, llamado la bibliade la psiquiatría: el Diagnostic
            and Statistical Manual for Mental Disorders, aunque se advertirá de que el tema requiere de un mayor
            estudio.<br><br>

            Incluso hay quienes hablan de un desorden específico relacionado con tener múltiples perfiles en
            las redes sociales: el <i>multiple profile disorder</i>.<br><br>

            Al parecer cuanto más tiempo transcurre uno online, más se atrofian las partes del cerebro encargadas
            del habla, memoría, control motor, emociones… De hecho la capacidad de atención ha disminuido un 40%
            en los últimos 10 años.<br><br>En los países donde la adicción a Internet se considera ya una patología
            se han cuantificado un 30% de adictos a las redes sociales o los videojuegos.<br><br>

            La adicción a Internet se caracteriza en el <i>Diagnostic and Statistical Manual for Mental Disorderspor</i>
            los siguientes síntomas:<br>
            <ul>
            <li>Preocupación por internet y el juego online: pensar constantemente en
            lo que se hizo online o se va a hacer después.</li>
            <li>Síntomas de dependencia (síndrome de abstinencia) cuando no hay Internet.</li>
            <li>Aumento del umbral de tolerancia: tener que invertir más tiempo para conseguir la misma
            satisfacción.</li>
            <li>Pérdida de otros intereses.</li>
            <li>Intentos fallidos por controlar el uso.</li>
            <li>Uso de internet para escapar de estados de ánimos tristes, ansiedad o inquietud.</li>
            </ul>
            </p>
            "
        ];
//        $rutas = ['1.jpg', '2.jpg', '3.jpg'];
//        $fechas = ['13-1-2015', '12-1-2012', '30-11-2012'];

        $fechas = new \ArrayObject();
        $fecha1 = new \DateTime();
        $fecha2 = new \DateTime();
        $fecha3 = new \DateTime();
        $fecha4 = new \DateTime();
        $fecha5 = new \DateTime();
        $fecha6 = new \DateTime();
        $fecha7 = new \DateTime();
        $fecha8 = new \DateTime();
        $fecha9 = new \DateTime();

        //Las redes sociales: peligros y potencialidades.
        $fecha1->setDate(2014,1,20);
        $fechas->append($fecha1);

        //Un estudio de McAfee alerta de los riesgos para la privacidad derivados de las rupturas de pareja.
        $fecha2->setDate(2013,2,18);
        $fechas->append($fecha2);

        //El ciberbullying sucede más entre antiguos amigos y novios, afirma un estudio.
        $fecha3->setDate(2013,1,23);
        $fechas->append($fecha3);

        //Generaciones Interactivas en Brasil: niños, niñas y adolescentes ante las pantallas.
        $fecha4->setDate(2012,11,29);
        $fechas->append($fecha4);

        //La cara oculta de las páginas de citas online.
        $fecha5->setDate(2015,1,26);
        $fechas->append($fecha5);

        //Menores de 13 años en Redes Sociales aumentan peligros de agresión y acoso.
        $fecha6->setDate(2015,1,26);
        $fechas->append($fecha6);

        //Un niño es víctima de Bullying ¿qué hago?
        $fecha7->setDate(2015,1,26);
        $fechas->append($fecha7);

        //Investigación señala que se debe permitir que los niños “descubran la red”.
        $fecha8->setDate(2015,1,26);
        $fechas->append($fecha8);

        //Facebook nos engancha a base de dopamina.
        $fecha9->setDate(2012,11,9);
        $fechas->append($fecha9);

        for ($i=0; $i<9; $i++) {
            $noticias = new Noticias();

            $noticias->setTitular($titulos[$i]);
            $noticias->setNombreAutor($autores[$i]);
            $noticias->setCategoria($categorias[$i]);
            $noticias->setFechaArticulo($fechas[$i]);
            $noticias->setTexto($textos[$i]);
            $noticias->setResumen(substr($textos[$i],0,20));
            $noticias->setRutaFoto(($i+1).'.jpg');

            $manager->persist($noticias);
        }

        $manager->flush();
    }
}
