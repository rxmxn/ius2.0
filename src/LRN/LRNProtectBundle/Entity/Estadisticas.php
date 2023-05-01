<?php
/**
 * Created by PhpStorm.
 * User: Ramon
 * Date: 19/04/2015
 * Time: 10:37
 */

namespace LRN\LRNProtectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Estadisticas
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="LRN\LRNProtectBundle\Entity\EstadisticasRepository")
 */
class Estadisticas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="categoria", type="string", length=255)
     */
    private $categoria;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="rutaImagen", type="string", length=255, nullable=true)
     */
    private $rutaImagen;

    /**
     *@Assert\Image(maxSize="500k",maxSizeMessage="La imagen seleccionada excede los 500kb")
     */
    private $imagen;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set categoria
     *
     * @param string $categoria
     * @return Estadisticas
     */
    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * Get categoria
     *
     * @return string
     */
    public function getCategoria()
    {
        return $this->categoria;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Estadisticas
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set rutaImagen
     *
     * @param string $rutaImagen
     * @return Estadisticas
     */
    public function setRutaImagen($rutaImagen)
    {
        $this->rutaImagen = $rutaImagen;

        return $this;
    }

    /**
     * Get rutaImagen
     *
     * @return string
     */
    public function getRutaImagen()
    {
        return $this->rutaImagen;
    }

    /**
     * Set imagen
     *
     *@param UploadedFile $imagen
     */
    public function setImagen(UploadedFile $imagen)
    {
        $this->imagen = $imagen;
    }

    /**
     * Get imagen
     *
     * @return UploadedFile
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    public function subirImagen()
    {
        if(null===$this->imagen)
        {
            return;
        }
        $directorioDestino= __DIR__.'/../../../../web/uploads/estadisticas';
        //$nombreArchivo=uniqid('LRN').'-foto1.jpg';
        $nombreArchivo=$this->imagen->getClientOriginalName();

        $this->getImagen()->move($directorioDestino,$nombreArchivo);
        $this->setRutaImagen($nombreArchivo);

        //$this->foto->move($directorioDestino,$nombreArchivo);
        //$this->setFoto("$nombreArchivo");
    }

    public function __toString()
    {
        return $this->getNombre();
    }
}
