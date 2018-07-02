<?php

namespace App\Entity;


use Symfony\Component\Validator\Constraints as Assert;

class League
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
     * @param string $name
     * @Assert\NotBlank(message="League Name cannot be blank")
     * @return League
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
