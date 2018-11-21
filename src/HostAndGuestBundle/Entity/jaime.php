<?php

namespace HostAndGuestBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * jaime
 *
 * @ORM\Table(name="jaime")
 * @ORM\Entity(repositoryClass="HostAndGuestBundle\Repository\jaimeRepository")
 */
class jaime
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
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;


    /**
     * @ORM\ManyToOne(targetEntity="experience")
     * @ORM\JoinColumn(name="experience_id", referencedColumnName="id")
     */
    private $experience;





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
     * Set user
     *
     * @param \HostAndGuestBundle\Entity\User $user
     *
     * @return jaime
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
     * Set experience
     *
     * @param \HostAndGuestBundle\Entity\experience $experience
     *
     * @return jaime
     */
    public function setExperience(\HostAndGuestBundle\Entity\experience $experience = null)
    {
        $this->experience = $experience;

        return $this;
    }

    /**
     * Get experience
     *
     * @return \HostAndGuestBundle\Entity\experience
     */
    public function getExperience()
    {
        return $this->experience;
    }
}
