<?php
/**
 * Created by PhpStorm.
 * User: brvchnko
 * Date: 7/1/18
 * Time: 8:32 PM
 */

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

class Team
{
    /**
     * @var integer $id
     */
    private $id;
    /**
     * @var string $name
     */
    private $name;
    /**
     * @var string $strip
     */
    private $strip;
    /**
     * @var integer $league
     * @ORM\ManyToOne(targetEntity="App\Entity\League")
     */
    private $league;

    /**
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getStrip()
    {
        return $this->strip;
    }

    /**
     * @return string
     */
    public function getLeague()
    {
        return $this->league;
    }

    /**
     * @param integer $league
     * @Assert\NotBlank(message="League cannot be empty")
     * @return Team
     */
    public function setLeague($league)
    {
        $this->league = $league;

        return $this;
    }

    /**
     * @param string $name
     * @Assert\NotBlank(message="Football team Name cannot be blank")
     * @return Team
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string $strip
     * @Assert\NotBlank(message="Strip cannot be blank")
     * @return Team
     */
    public function setStrip($strip)
    {
        $this->strip = $strip;

        return $this;
    }
}