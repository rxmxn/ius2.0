<?php

namespace LRN\LRNProtectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Paso
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="LRN\LRNProtectBundle\Entity\PasoRepository")
 */
class Paso
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
     * @var float
     *
     * @ORM\Column(name="numero", type="decimal")
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="titulo", type="string", length=255)
     */
    private $titulo;

    /**
     * @var string
     *
     * @ORM\Column(name="explicacion", type="text")
     */
    private $explicacion;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $rutaImagen;

    /**
     *@Assert\Image(maxSize="500k",maxSizeMessage="La imagen seleccionada excede los 500kb")
     */
    private $imagen;

    /**
     * @ORM\ManyToOne(targetEntity="LRN\LRNProtectBundle\Entity\Tutorial", inversedBy="pasos")
     * @ORM\JoinColumn(name="tutorial_id", referencedColumnName="id")
     */
    private $tutorial;

    public function setTutorial(\LRN\LRNProtectBundle\Entity\Tutorial $tutorial)
    {
        $this->tutorial = $tutorial;
    }

    public function getTutorial()
    {
        return $this->tutorial;
    }

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
     * Set numero
     *
     * @param float $numero
     * @return Paso
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    
        return $this;
    }

    /**
     * Get numero
     *
     * @return float 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set titulo
     *
     * @param string $titulo
     * @return Paso
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    
        return $this;
    }

    /**
     * Get titulo
     *
     * @return string 
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * Set explicacion
     *
     * @param string $explicacion
     * @return Paso
     */
    public function setExplicacion($explicacion)
    {
        $this->explicacion = $explicacion;

        return $this;
    }

    /**
     * Get explicacion
     *
     * @return string
     */
    public function getExplicacion()
    {
        return $this->explicacion;
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
        $directorioDestino= __DIR__.'/../../../../web/uploads/tutoriales';
        //$nombreArchivo=uniqid('LRN').'-foto1.jpg';
        $nombreArchivo=$this->imagen->getClientOriginalName();

        $this->getImagen()->move($directorioDestino,$nombreArchivo);
        $this->setRutaImagen($nombreArchivo);

        //$this->foto->move($directorioDestino,$nombreArchivo);
        //$this->setFoto("$nombreArchivo");
    }


    public function setRutaImagen($rutaImagen)
    {
        $this->rutaImagen=$rutaImagen;
    }

    public function getRutaImagen()
    {
        return $this->rutaImagen;

    }

    public function __toString()
    {
        return $this->getTitulo();
    }
}
