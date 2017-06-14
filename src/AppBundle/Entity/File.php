<?php

namespace AppBundle\Entity;

use JsonSerializable;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Photo
 *
 * @ORM\Table(name="file")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\FileRepository")
 */
class File implements JsonSerializable
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
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     */
    private $description;

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
	// -------------------------------------------------------------------------

    /**
     * @ORM\OneToOne(targetEntity="Vocabulary", mappedBy="sound", cascade={"persist"})
     */
    private $vocabulary;

    /**
     * @ORM\OneToOne(targetEntity="Sentence", mappedBy="sound", cascade={"persist"})
     */
    private $sentence;


	// Custom methods
	// -------------------------------------------------------------------------

    public function jsonSerialize()
    {
        return array(
            'filename' => $this->filename,
            'path' => $this->path,
            'extension' => $this->extension,
        );
    }


	public function getAbsolutePath()
    {
        return null === $this->getPath()
            ? null
            : $this->getUploadRootDir().'/'.$this->getFilename();
    }

    public function getWebPath()
    {
        return null === $this->getPath()
            ? null
            : '/'.$this->getUploadDir().'/'.$this->getPath().'/'.$this->getFilename();
    }

    public function getUploadRootDir()
    {
        // the absolute directory path where uploaded documents should be saved
		return __DIR__.'/../../../web/'.$this->getUploadDir().'/'.$this->getPath();
    }

    protected function getUploadDir()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/files';
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
     * @return File
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
     * @return File
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
     * Set description
     *
     * @param string $description
     *
     * @return File
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set path
     *
     * @param string $path
     *
     * @return File
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
     * @return File
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
     * @return File
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

    /**
     * Set sentence
     *
     * @param \AppBundle\Entity\Sentence $sentence
     *
     * @return File
     */
    public function setSentence(\AppBundle\Entity\Sentence $sentence = null)
    {
        $this->sentence = $sentence;

        return $this;
    }

    /**
     * Get sentence
     *
     * @return \AppBundle\Entity\Sentence
     */
    public function getSentence()
    {
        return $this->sentence;
    }
}
