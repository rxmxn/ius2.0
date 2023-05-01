<?php

namespace LRN\LRNProtectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Noticias
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="LRN\LRNProtectBundle\Entity\NoticiasRepository")
 */
class Noticias
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
     * @ORM\Column(name="titular", type="string", length=255)
     */
    private $titular;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $rutaFoto;
    /**
     *@Assert\Image(maxSize="500k",maxSizeMessage="La foto seleccionada excede los 500kb")
     */
    private $foto;

    /**
     * @var string
     *
     * @ORM\Column(name="texto", type="text")
     */
    private $texto;

    /**
     * @var string
     *
     * @ORM\Column(name="resumen", type="string",length=250 )
     */
    private $resumen;

    /**
     * @var string
     *
     * @ORM\Column(name="nombreAutor", type="string", length=255)
     */
    private $nombreAutor;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fechaArticulo", type="date")
     *
     * @Assert\NotBlank()
     * @Assert\Type("\DateTime")
     */
    private $fechaArticulo;

    /**
     * @var \string
     *
     * @ORM\Column(name="Categoria", type="string", length=255)
     *
     * @Assert\NotBlank()
     */
    private $categoria;

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
     * Set categoria
     *
     * @param string $categoria
     * @return Noticias
     */
    public function setCategoria($categoria)
    {
        $this->categoria=$categoria;
        return $this;
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
     * Set titular
     *
     * @param string $titular
     * @return Noticias
     */
    public function setTitular($titular)
    {
        $this->titular = $titular;
    
        return $this;
    }

    /**
     * Get titular
     *
     * @return string 
     */
    public function getTitular()
    {
        return $this->titular;
    }

    /**
     * Set foto
     *
     *@param UploadedFile $foto
     */
    public function setFoto(UploadedFile $foto)
    {
        $this->foto = $foto;
    }

    /**
     * Get foto
     *
     * @return UploadedFile
     */
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * Set texto
     *
     * @param string $texto
     * @return Noticias
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

    public function setResumen($resumen)
    {
        $this->resumen = $resumen;

        return $this;
    }

    public function getResumen()
    {
        return $this->texto;
    }

    /**
     * Set nombreAutor
     *
     * @param string $nombreAutor
     * @return Noticias
     */
    public function setNombreAutor($nombreAutor)
    {
        $this->nombreAutor = $nombreAutor;
    
        return $this;
    }

    /**
     * Get nombreAutor
     *
     * @return string 
     */
    public function getNombreAutor()
    {
        return $this->nombreAutor;
    }

    /**
     * Set fechaArticulo
     *
     * @param \DateTime $fechaArticulo
     * @return Noticias
     */
    public function setFechaArticulo($fechaArticulo)
    {
        $this->fechaArticulo = $fechaArticulo;
    
        return $this;
    }

    /**
     * Get fechaArticulo
     *
     * @return \DateTime 
     */
    public function getFechaArticulo()
    {
        return $this->fechaArticulo;
    }

    public function subirFoto()
    {
        if(null===$this->foto)
        {
            return;
        }
        $directorioDestino= __DIR__.'/../../../../web/uploads/images';
        //$nombreArchivo=uniqid('LRN').'-foto1.jpg';
        $nombreArchivo=$this->foto->getClientOriginalName();

        $this->getFoto()->move($directorioDestino,$nombreArchivo);
        $this->setRutaFoto($nombreArchivo);

        //$this->foto->move($directorioDestino,$nombreArchivo);
        //$this->setFoto("$nombreArchivo");
    }


    public function setRutaFoto($rutaFoto)
    {
        $this->rutaFoto=$rutaFoto;
    }

    public function getRutaFoto()
    {
        return $this->rutaFoto;

    }

    public function __toString()
    {
        return $this->getTitular();
    }
}
