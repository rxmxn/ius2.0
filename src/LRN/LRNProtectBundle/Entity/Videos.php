<?php

namespace LRN\LRNProtectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Videos
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="LRN\LRNProtectBundle\Entity\VideosRepository")
 */
class Videos
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
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $rutaVideo;

    /**
     *@Assert\File(maxSize = "30M", mimeTypes = {"video/mp4", "video/ogg", "video/webm"})
     */
    private $video;

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
     * Set nombre
     *
     * @param string $nombre
     * @return Videos
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

    //A esto se le llama metodo magico, y es como se vera la Entidad como texto, cuando me quiera referir a ella
    //__ significa que se esta modificando el metodo toString() para esta clase en especifico
    public function __toString()
    {
        return $this->getNombre();
    }

    /**
     * Set video
     *
     *@param UploadedFile $video
     */
    public function setVideo(UploadedFile $video)
    {
        $this->video = $video;
    }

    /**
     * Get video
     *
     * @return UploadedFile
     */
    public function getVideo()
    {
        return $this->video;
    }

    public function subirVideo()
    {
        if(null===$this->video)
        {
            return;
        }
        $directorioDestino= __DIR__.'/../../../../web/uploads/videos';
        //$nombreArchivo=uniqid('LRN').'-foto1.jpg';
        $nombreArchivo=$this->video->getClientOriginalName();

        $this->getVideo()->move($directorioDestino,$nombreArchivo);
        $this->setRutaVideo($nombreArchivo);
    }

    public function setRutaVideo($rutaVideo)
    {
        $this->rutaVideo=$rutaVideo;
    }

    public function getRutaVideo()
    {
        return $this->rutaVideo;
    }
}
