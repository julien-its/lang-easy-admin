<?php

namespace AppBundle\Entity;

use JsonSerializable;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Photo
 *
 * @ORM\Table(name="photo")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PhotoRepository")
 */
class Photo implements JsonSerializable
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="filename", type="string", length=45, unique=true)
     */
    private $filename;

    /**
     * @var string
     *
     * @ORM\Column(name="path", type="string", length=50)
     */
    private $path;

    /**
     * @var string
     *
     * @ORM\Column(name="extension", type="string", length=4)
     */
    private $extension;


    // Linked table
    // ---------------------------------------------------------------

    /**
     * @ORM\OneToOne(targetEntity="Vocabulary", mappedBy="photo", cascade={"persist"})
     */
    private $vocabulary;


    // Custom methods
	// -------------------------------------------------------------------------

    public function jsonSerialize()
    {
        return array(
            'filename' => $this->filename,
            'path' => $this->path,
        );
    }
    public function __construct()
    {
        $this->products = new \Doctrine\Common\Collections\ArrayCollection();
    }

	public function getUploadRootDirectory()
    {
        return $this->getWebDirectory() . $this->getUploadDirectory();
    }

    public function getWebDirectory()
    {
        return realpath(__DIR__ . "/../../../web/").'/';
    }

    public function getUploadDirectory()
    {
        return "uploads/" . $this->getPath();
    }

    public function getFullPath()
    {
        return $this->getUploadRootDirectory().'/'.$this->getFileName();
    }

    public function getUrlPath()
    {
        return '/'.$this->getUploadDirectory().'/'.$this->getFileName();
    }

    public function getResizedFullPath($format)
    {
        if(!is_dir($this->getUploadRootDirectory().'/'.$format)){
            mkdir($this->getUploadRootDirectory().'/'.$format);
            chmod($this->getUploadRootDirectory().'/'.$format, 0777);
        }
        return $this->getUploadRootDirectory().'/'.$format.'/'.$this->getFileName();
    }



	// Auto generated methods
	// -------------------------------------------------------------------------



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
     * Set name
     *
     * @param string $name
     *
     * @return Photo
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set filename
     *
     * @param string $filename
     *
     * @return Photo
     */
    public function setFilename($filename)
    {
        $this->filename = $filename;

        return $this;
    }

    /**
     * Get filename
     *
     * @return string
     */
    public function getFilename()
    {
        return $this->filename;
    }

    /**
     * Set path
     *
     * @param string $path
     *
     * @return Photo
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set extension
     *
     * @param string $extension
     *
     * @return Photo
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * Get extension
     *
     * @return string
     */
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * Set vocabulary
     *
     * @param \AppBundle\Entity\Vocabulary $vocabulary
     *
     * @return Photo
     */
    public function setVocabulary(\AppBundle\Entity\Vocabulary $vocabulary = null)
    {
        $this->vocabulary = $vocabulary;

        return $this;
    }

    /**
     * Get vocabulary
     *
     * @return \AppBundle\Entity\Vocabulary
     */
    public function getVocabulary()
    {
        return $this->vocabulary;
    }
}
