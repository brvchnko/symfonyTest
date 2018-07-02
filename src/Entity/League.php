<?php

namespace App\Entity;


use Symfony\Component\Validator\Constraints as Assert;

class League
{
    const ERROR_BLANK_NAME = "Name cannot be null";
    const ERROR_BLANK_ID = "ID cannot be null";
    const ERROR_REMOVE = "League with ID %d was not found";
    const SUCCESSFULLY_CREATE = "New League %s was created!";
    const SUCCESSFULLY_REMOVED = "League %s was removed!";

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