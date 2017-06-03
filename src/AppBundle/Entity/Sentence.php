<?php

namespace AppBundle\Entity;

use JsonSerializable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Sentence
 *
 * @ORM\Table(name="sentence")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SentenceRepository")
 */
class Sentence implements JsonSerializable
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
     * @ORM\Column(name="word", type="string", length=150, nullable=false)
	 * @Assert\NotBlank()
	 * @Assert\Length(max=150)
     */
    private $sentence;

	/**
     * @var string
     *
     * @ORM\Column(name="translation", type="string", length=150, nullable=false)
     * @Assert\NotBlank()
	 * @Assert\Length(max=150)
     */
    private $translation;

	/**
     * @var string
     *
     * @ORM\Column(name="phonetic", type="string", length=180, nullable=true)
	 * @Assert\Length(max=180)
     */
    private $phonetic;



	// Linked Tables
	// -------------------------------------------------------------------------

    /**
     * @ORM\OneToOne(targetEntity="File", inversedBy="sentence", cascade={"persist"})
     * @ORM\JoinColumn(name="soundId", referencedColumnName="id", onDelete="CASCADE")
     */
    private $sound;

    /**
     * @ORM\ManyToOne(targetEntity="Vocabulary", inversedBy="examples", cascade={"persist"})
     * @ORM\JoinColumn(name="vocabularyId", referencedColumnName="id", nullable=true)
     */
    private $vocabulary;

	// Custom methods
	// -------------------------------------------------------------------------

    public function jsonSerialize()
    {
        return array(
        );
    }

	// Automatic methods
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
     * Set sentence
     *
     * @param string $sentence
     *
     * @return Sentence
     */
    public function setSentence($sentence)
    {
        $this->sentence = $sentence;

        return $this;
    }

    /**
     * Get sentence
     *
     * @return string
     */
    public function getSentence()
    {
        return $this->sentence;
    }

    /**
     * Set translation
     *
     * @param string $translation
     *
     * @return Sentence
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
     * @return Sentence
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
     * @return Sentence
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
     * Set vocabulary
     *
     * @param \AppBundle\Entity\Vocabulary $vocabulary
     *
     * @return Sentence
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
