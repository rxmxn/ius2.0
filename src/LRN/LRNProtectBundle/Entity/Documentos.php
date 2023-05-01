<?php

namespace LRN\LRNProtectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Documentos
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="LRN\LRNProtectBundle\Entity\DocumentosRepository")
 */
class Documentos
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
     * @ORM\Column(name="tema_relacionado", type="string", length=255)
     */
    private $temaRelacionado;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string")
     */
    private $rutaPDF;

    /**
     *@Assert\File(maxSize = "5M", mimeTypes = {"application/pdf", "application/x-pdf"})
     */
    private $pdf;

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
     * Set temaRelacionado
     *
     * @param string $temaRelacionado
     * @return Documentos
     */
    public function setTemaRelacionado($temaRelacionado)
    {
        $this->temaRelacionado = $temaRelacionado;
    
        return $this;
    }

    /**
     * Get temaRelacionado
     *
     * @return string 
     */
    public function getTemaRelacionado()
    {
        return $this->temaRelacionado;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     * @return Documentos
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
        $directorioDestino= __DIR__.'/../../../../web/uploads/pdfs';
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

    public function __toString()
    {
        return $this->getNombre();
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
        $directorioDestino= __DIR__.'/../../../../web/uploads/pdfs';
        //$nombreArchivo=uniqid('LRN').'-foto1.jpg';
        $nombreArchivo=$this->imagen->getClientOriginalName();

        $this->getImagen()->move($directorioDestino,$nombreArchivo);
        $this->setRutaImagen($nombreArchivo);

        //$this->foto->move($directorioDestino,$nombreArchivo);
        //$this->setFoto("$nombreArchivo");
    }
}
