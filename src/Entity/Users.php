<?php
/**
 * Created by PhpStorm.
 * User: brvchnko
 * Date: 7/1/18
 * Time: 8:32 PM
 */

namespace App\Entity;


class Users
{
    /**
     * @var integer $id
     */
    private $id;
    /**
     * @var string $login
     */
    private $login;
    /**
     * @var string $password
     */
    private $password;

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
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $login
     * @return Users
     */
    public function setLogin($login)
    {
        $this->login = $login;

        return $this;
    }

    /**
     * @param mixed $password
     * @return Users
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

}