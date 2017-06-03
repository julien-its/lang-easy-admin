<?php

namespace AppBundle\Entity;

use JsonSerializable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Lesson
 *
 * @ORM\Table(name="lesson")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LessonRepository")
 */
class Lesson implements JsonSerializable
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
     * @ORM\Column(name="number", type="smallint", nullable=false)
	 * @Assert\NotBlank()
     */
    private $number;

	/**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=50, nullable=true)
	 * @Assert\Length(max=50)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="difficulty", type="smallint", nullable=false)
	 * @Assert\NotBlank()
     */
    private $difficulty;


	// Linked Tables
	// -------------------------------------------------------------------------

    /**
     * @ORM\OneToMany(targetEntity="Vocabulary", mappedBy="lesson", cascade={"persist"})
     */
    private $vocabularies;


	// Custom methods
	// -------------------------------------------------------------------------

    public function jsonSerialize()
    {
        return array(
            'title' => $this->title,
            'number' => $this->number,
            'difficulty' => $this->title,
            'vocabularies' => $this->getVocabularies()->map(function($item){ return $item->jsonSerialize(); })->toArray()

        );
    }

	// Automatic methods
	// -------------------------------------------------------------------------


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->vocabularies = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set number
     *
     * @param integer $number
     *
     * @return Lesson
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return integer
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Lesson
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set difficulty
     *
     * @param integer $difficulty
     *
     * @return Lesson
     */
    public function setDifficulty($difficulty)
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    /**
     * Get difficulty
     *
     * @return integer
     */
    public function getDifficulty()
    {
        return $this->difficulty;
    }

    /**
     * Add vocabulary
     *
     * @param \AppBundle\Entity\Vocabulary $vocabulary
     *
     * @return Lesson
     */
    public function addVocabulary(\AppBundle\Entity\Vocabulary $vocabulary)
    {
        $this->vocabularies[] = $vocabulary;

        return $this;
    }

    /**
     * Remove vocabulary
     *
     * @param \AppBundle\Entity\Vocabulary $vocabulary
     */
    public function removeVocabulary(\AppBundle\Entity\Vocabulary $vocabulary)
    {
        $this->vocabularies->removeElement($vocabulary);
    }

    /**
     * Get vocabularies
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVocabularies()
    {
        return $this->vocabularies;
    }
}
