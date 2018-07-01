<?php
/**
 * Created by PhpStorm.
 * User: brvchnko
 * Date: 7/1/18
 * Time: 8:32 PM
 */

namespace App\Entity;


use Symfony\Component\Validator\Constraints as Assert;

class Team
{

    private $id;
    private $name;
    private $strip;

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