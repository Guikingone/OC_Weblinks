<?php
/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 08/04/2016
 * Time: 09:08
 */

namespace WebLinks\Domain;

use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{

    /**
     * User id
     *
     * @var integer
     */
    private $id;

    /**
     * User name
     *
     * @var string
     */
    private $name;

    /**
     * User password
     *
     * @var string
     */
    private $password;

    /**
     * Originally used to encrypt the password
     *
     * @var string
     */
    private $salt;

    /**
     * Roles
     * Value : ROLE_USER or ROLE_ADMIN
     *
     * @var string
     */
    private $role;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @inheritDoc
     * @return string
     */
    public function getUsername()
    {
        return $this->name;
    }

    /**
     * @param $name
     */
    public function setUsername($name)
    {
        $this->name = $name;
    }

    /**
     * @inheritDoc
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @inheritDoc
     * @return string
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @param $salt
     */
    public function setSalt($salt)
    {
        $this->salt = $salt;
    }

    /**
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }

    /**
     * @inheritDoc
     * @return array
     */
    public function getRoles()
    {
        return array($this->getRoles());
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
        // Nothing to do here
    }
}
