<?php

namespace AppBundle\Entity;

use JsonSerializable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Vocabulary
 *
 * @ORM\Table(name="vocabulary")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VocabularyRepository")
 */
class Vocabulary implements JsonSerializable
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
     * @ORM\Column(name="word", type="string", length=50, nullable=false)
	 * @Assert\NotBlank()
	 * @Assert\Length(max=50)
     */
    private $word;

	/**
     * @var string
     *
     * @ORM\Column(name="translation", type="string", length=50, nullable=false)
     * @Assert\NotBlank()
	 * @Assert\Length(max=50)
     */
    private $translation;

	/**
     * @var string
     *
     * @ORM\Column(name="phonetic", type="string", length=80, nullable=true)
	 * @Assert\Length(max=80)
     */
    private $phonetic;




	// Linked Tables
	// -------------------------------------------------------------------------

    /**
     * @ORM\OneToOne(targetEntity="File", inversedBy="vocabulary", cascade={"persist"})
     * @ORM\JoinColumn(name="soundId", referencedColumnName="id", onDelete="CASCADE")
     */
    private $sound;

    /**
     * @ORM\OneToMany(targetEntity="Sentence", mappedBy="vocabulary")
     */
    private $examples;

    /**
     * @ORM\ManyToOne(targetEntity="Lesson", inversedBy="vocabularies", cascade={"persist"})
     * @ORM\JoinColumn(name="lessonId", referencedColumnName="id", nullable=false)
     */
    private $lesson;

    /**
     * @ORM\OneToOne(targetEntity="Photo", inversedBy="vocabulary", cascade={"persist"})
     * @ORM\JoinColumn(name="photoId", referencedColumnName="id", onDelete="CASCADE")
     */
    private $photo;

	// Custom methods
	// -------------------------------------------------------------------------

    public function jsonSerialize()
    {
        return array(
            'id' => $this->id,
            'word' => $this->word,
            'translation' => $this->getTranslation(),
            'phonetic' => $this->getPhonetic(),
            'sound' => $this->getSound() == null ? null : $this->getSound()->jsonSerialize(),
            'photo' => $this->getPhoto() == null ? null : $this->getPhoto()->jsonSerialize(),
            'examples' => $this->getExamples()->map(function($item){ return $item->jsonSerialize(); })->toArray()
        );
    }

	// Automatic methods
	// -------------------------------------------------------------------------


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->examples = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set word
     *
     * @param string $word
     *
     * @return Vocabulary
     */
    public function setWord($word)
    {
        $this->word = $word;

        return $this;
    }

    /**
     * Get word
     *
     * @return string
     */
    public function getWord()
    {
        return $this->word;
    }

    /**
     * Set translation
     *
     * @param string $translation
     *
     * @return Vocabulary
     */
    public function setTranslation($translation)
    {
        $this->translation = $translation;

        return $this;
    }

    /**
     * Get translation
     *
     * @return string
     */
    public function getTranslation()
    {
        return $this->translation;
    }

    /**
     * Set phonetic
     *
     * @param string $phonetic
     *
     * @return Vocabulary
     */
    public function setPhonetic($phonetic)
    {
        $this->phonetic = $phonetic;

        return $this;
    }

    /**
     * Get phonetic
     *
     * @return string
     */
    public function getPhonetic()
    {
        return $this->phonetic;
    }

    /**
     * Set sound
     *
     * @param \AppBundle\Entity\File $sound
     *
     * @return Vocabulary
     */
    public function setSound(\AppBundle\Entity\File $sound = null)
    {
        $this->sound = $sound;

        return $this;
    }

    /**
     * Get sound
     *
     * @return \AppBundle\Entity\File
     */
    public function getSound()
    {
        return $this->sound;
    }

    /**
     * Add example
     *
     * @param \AppBundle\Entity\Sentence $example
     *
     * @return Vocabulary
     */
    public function addExample(\AppBundle\Entity\Sentence $example)
    {
        $this->examples[] = $example;

        return $this;
    }

    /**
     * Remove example
     *
     * @param \AppBundle\Entity\Sentence $example
     */
    public function removeExample(\AppBundle\Entity\Sentence $example)
    {
        $this->examples->removeElement($example);
    }

    /**
     * Get examples
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getExamples()
    {
        return $this->examples;
    }

    /**
     * Set lesson
     *
     * @param \AppBundle\Entity\Lesson $lesson
     *
     * @return Vocabulary
     */
    public function setLesson(\AppBundle\Entity\Lesson $lesson)
    {
        $this->lesson = $lesson;

        return $this;
    }

    /**
     * Get lesson
     *
     * @return \AppBundle\Entity\Lesson
     */
    public function getLesson()
    {
        return $this->lesson;
    }

    /**
     * Set photos
     *
     * @param \AppBundle\Entity\Photo $photos
     *
     * @return Vocabulary
     */
    public function setPhotos(\AppBundle\Entity\Photo $photos = null)
    {
        $this->photos = $photos;

        return $this;
    }

    /**
     * Get photos
     *
     * @return \AppBundle\Entity\Photo
     */
    public function getPhotos()
    {
        return $this->photos;
    }

    /**
     * Set photo
     *
     * @param \AppBundle\Entity\Photo $photo
     *
     * @return Vocabulary
     */
    public function setPhoto(\AppBundle\Entity\Photo $photo = null)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return \AppBundle\Entity\Photo
     */
    public function getPhoto()
    {
        return $this->photo;
    }
}
