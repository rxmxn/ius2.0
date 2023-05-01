<?php

namespace LRN\LRNProtectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Tutorial
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="LRN\LRNProtectBundle\Entity\TutorialRepository")
 */
class Tutorial
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
     * @ORM\Column(name="nombreRedSocial", type="string", length=255)
     */
    private $nombreRedSocial;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="text")
     */
    private $descripcion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaPublicacion", type="date")
     * @Assert\Type("\DateTime")
     */
    private $fechaPublicacion;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $rutaImagen;

    /**
     *@Assert\Image(maxSize="500k",maxSizeMessage="La imagen seleccionada excede los 500kb")
     */
    private $imagen;

    /**
     * @ORM\Column(type="string")
     */
    private $rutaPDF;

    /**
     *@Assert\File(maxSize = "5M", mimeTypes = {"application/pdf", "application/x-pdf"})
     */
    private $pdf;

    /**
     * @ORM\OneToMany(targetEntity="LRN\LRNProtectBundle\Entity\Paso", mappedBy="tutorial")
     */
    private $pasos;

    public function __construct()
    {
        $this->pasos = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function addPasos(\LRN\LRNProtectBundle\Entity\Paso $paso)
    {
        $this->pasos[] = $paso;
    }

    public function getPasos()
    {
        return $this->pasos;
    }

    public function RemovePaso(\LRN\LRNProtectBundle\Entity\Paso $paso)
    {
        $this->pasos->removeElement($paso);
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
     * Set nombreRedSocial
     *
     * @param string $nombreRedSocial
     * @return Tutorial
     */
    public function setNombreRedSocial($nombreRedSocial)
    {
        $this->nombreRedSocial = $nombreRedSocial;
    
        return $this;
    }

    /**
     * Get nombreRedSocial
     *
     * @return string 
     */
    public function getNombreRedSocial()
    {
        return $this->nombreRedSocial;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     * @return Tutorial
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    
        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string 
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set fechaPublicacion
     *
     * @param \DateTime $fechaPublicacion
     * @return Tutorial
     */
    public function setFechaPublicacion($fechaPublicacion)
    {
        $this->fechaPublicacion = $fechaPublicacion;
    
        return $this;
    }

    /**
     * Get fechaPublicacion
     *
     * @return \DateTime 
     */
    public function getFechaPublicacion()
    {
        return $this->fechaPublicacion;
    }

    //A esto se le llama metodo magico, y es como se vera la Entidad como texto, cuando me quiera referir a ella
    //__ significa que se esta modificando el metodo toString() para esta clase en especifico
    public function __toString()
    {
        return $this->getNombreRedSocial();
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

    /**
     * Set pdf
     *
     *@param UploadedFile $pdf
     */
    public function setPDF(UploadedFile $pdf)
    {
        $this->pdf = $pdf;
    }

    /**
     * Get pdf
     *
     * @return UploadedFile
     */
    public function getPDF()
    {
        return $this->pdf;
    }

    public function subirPDF()
    {
        if(null===$this->pdf)
        {
            return;
        }
        $directorioDestino= __DIR__.'/../../../../web/uploads/tutoriales';
        //$nombreArchivo=uniqid('LRN').'-foto1.jpg';
        $nombreArchivo=$this->pdf->getClientOriginalName();

        $this->getPDF()->move($directorioDestino,$nombreArchivo);
        $this->setRutaPDF($nombreArchivo);
    }

    public function setRutaPDF($rutaPDF)
    {
        $this->rutaPDF=$rutaPDF;
    }

    public function getRutaPDF()
    {
        return $this->rutaPDF;

    }
}
