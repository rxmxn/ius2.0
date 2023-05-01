<?php

namespace LRN\LRNProtectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Conceptos
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="LRN\LRNProtectBundle\Entity\ConceptosRepository")
 */
class Conceptos
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
     * @ORM\Column(name="subtitulo", type="string", length=255)
     */
    private $subtitulo;

    /**
     * @var string
     *
     * @ORM\Column(name="texto", type="text")
     */
    private $texto;

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

//    /**
//     * @var array
//     *
//     * @ORM\Column(name="parrafo", type="text")
//     */
//    private $parrafo;
//
//    public function __construct()
//    {
//        $this->parrafo = new \ArrayObject();
//    }
//
//    public function addParrafo(\LRN\LRNProtectBundle\Entity\Paso $paso)
//    {
//        $this->parrafo->append();
//    }
//
//    public function getParrafo()
//    {
//        return $this->parrafo;
//    }
//
//    public function RemoveParrafo(\LRN\LRNProtectBundle\Entity\Paso $paso)
//    {
//        $this->parrafo->removeElement($paso);
//    }

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
     * Set subtitulo
     *
     * @param string $subtitulo
     * @return Conceptos
     */
    public function setSubtitulo($subtitulo)
    {
        $this->subtitulo = $subtitulo;
    
        return $this;
    }

    /**
     * Get subtitulo
     *
     * @return string 
     */
    public function getSubtitulo()
    {
        return $this->subtitulo;
    }

    /**
     * Set texto
     *
     * @param string $texto
     * @return Conceptos
     */
    public function setTexto($texto)
    {
        $this->texto = $texto;
    
        return $this;
    }

    /**
     * Get texto
     *
     * @return string 
     */
    public function getTexto()
    {
        return $this->texto;
    }

    /**
     * Set rutaImagen
     *
     * @param string $rutaImagen
     * @return Conceptos
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
        $directorioDestino= __DIR__.'/../../../../web/uploads/conceptos';
        //$nombreArchivo=uniqid('LRN').'-foto1.jpg';
        $nombreArchivo=$this->imagen->getClientOriginalName();

        $this->getImagen()->move($directorioDestino,$nombreArchivo);
        $this->setRutaImagen($nombreArchivo);

        //$this->foto->move($directorioDestino,$nombreArchivo);
        //$this->setFoto("$nombreArchivo");
    }

    public function __toString()
    {
        return $this->getSubtitulo();
    }
}
