<?php

namespace HostAndGuestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * experience
 *
 * @ORM\Table(name="experience")
 * @ORM\Entity(repositoryClass="HostAndGuestBundle\Repository\experienceRepository")
 */
class experience
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
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu", type="string", length=255)
     */
    private $lieu;

    /**
     * @var string
     *
     * @ORM\Column(name="prix", type="string", length=255)
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="categorie", type="string", length=255)
     */
    private $categorie;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="images", type="string", length=255)
     */
    private $images;


    /**
     * @var int
     *
     * @ORM\Column(name="nb", type="integer", nullable=true)
     */
    private $nb;


    /**
     * @var int
     *
     * @ORM\Column(name="capacité", type="integer", nullable=true)
     */
    private $capacitegroupe;


    /**
     * @var string
     *
     * @ORM\Column(name="critere", type="string", length=255)
     */
    private $critere;

    /**
     * @var string
     *
     * @ORM\Column(name="rencontre", type="string", length=255)
     */
    private $rencontrelieu;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datecreation", type="date")
     */
    private $datecreation;






    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return experience
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
     * Set titre
     *
     * @param string $titre
     *
     * @return experience
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return experience
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set lieu
     *
     * @param string $lieu
     *
     * @return experience
     */
    public function setLieu($lieu)
    {
        $this->lieu = $lieu;

        return $this;
    }

    /**
     * Get lieu
     *
     * @return string
     */
    public function getLieu()
    {
        return $this->lieu;
    }

    /**
     * Set prix
     *
     * @param string $prix
     *
     * @return experience
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return string
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set categorie
     *
     * @param string $categorie
     *
     * @return experience
     */
    public function setCategorie($categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return string
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set user
     *
     * @param \HostAndGuestBundle\Entity\User $user
     *
     * @return experience
     */
    public function setUser(\HostAndGuestBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \HostAndGuestBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set images
     *
     * @param string $images
     *
     * @return experience
     */
    public function setImages($images)
    {
        $this->images = $images;

        return $this;
    }

    /**
     * Get images
     *
     * @return string
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * Set nbjaime
     *
     * @param string $nbjaime
     *
     * @return experience
     */


    /**
     * Set nb
     *
     * @param integer $nb
     *
     * @return experience
     */
    public function setNb($nb)
    {
        $this->nb = $nb;

        return $this;
    }

    /**
     * Get nb
     *
     * @return integer
     */
    public function getNb()
    {
        return $this->nb;
    }



    /**
     * Set capacitegroupe
     *
     * @param integer $capacitegroupe
     *
     * @return experience
     */
    public function setCapacitegroupe($capacitegroupe)
    {
        $this->capacitegroupe = $capacitegroupe;

        return $this;
    }

    /**
     * Get capacitegroupe
     *
     * @return integer
     */
    public function getCapacitegroupe()
    {
        return $this->capacitegroupe;
    }

    /**
     * Set critere
     *
     * @param string $critere
     *
     * @return experience
     */
    public function setCritere($critere)
    {
        $this->critere = $critere;

        return $this;
    }

    /**
     * Get critere
     *
     * @return string
     */
    public function getCritere()
    {
        return $this->critere;
    }

    /**
     * Set rencontrelieu
     *
     * @param string $rencontrelieu
     *
     * @return experience
     */
    public function setRencontrelieu($rencontrelieu)
    {
        $this->rencontrelieu = $rencontrelieu;

        return $this;
    }

    /**
     * Get rencontrelieu
     *
     * @return string
     */
    public function getRencontrelieu()
    {
        return $this->rencontrelieu;
    }

    /**
     * Set datecreation
     *
     * @param \DateTime $datecreation
     *
     * @return experience
     */
    public function setDatecreation($datecreation)
    {
        $this->datecreation = $datecreation;

        return $this;
    }

    /**
     * Get datecreation
     *
     * @return \DateTime
     */
    public function getDatecreation()
    {
        return $this->datecreation;
    }
}
