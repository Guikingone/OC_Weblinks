<?php
/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 08/04/2016
 * Time: 09:20
 */

namespace WebLinks\DAO;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use WebLinks\Domain\User;

class UserDAO extends DAO implements UserProviderInterface
{

    /**
     * Returns a list of all users, sorted by role and name.
     *
     * @return array A list of all users.
     */
    public function findAll() {
        $sql = "select * from t_user order by user_role, user_name";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $entities = array();
        foreach ($result as $row) {
            $id = $row['usr_id'];
            $entities[$id] = $this->buildDomainObject($row);
        }
        return $entities;
    }

    /**
     * Return a user matchind the supplied id
     * @param integer $id the user id
     * @return \WebLinks\Domain\User | throws an exception if no mathcing user is found
     */
    public function find($id)
    {
        $sql = "SELECT * FROM t_user WHERE user_id = ?";
        $row = $this->getDB()->fetchAssoc($sql, array($id));
        if($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No user matching id", $id);
    }

    /**
     * {@inheritdoc}
     */
    public function loadUserByUsername($username)
    {
        $sql = "SELECT * FROM t_user WHERE user_name = ?";
        $row = $this->getDB()->fetchAssoc($sql, array($username));

        if($row)
            return $this->buildDomainObject($row);
        else
            throw new UsernameNotFoundException(sprintf('User "%s" not found.', $username));
    }

    /**
     * {@inheritdoc}
     */
    public function refreshUser(UserInterface $user)
    {
        $class = get_class($user);
        if(!$this->supportsClass($class)){
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $class));
        }
        return $this->loadUserByUsername($user->getUsername());
    }

    /**
     * {@inheritdoc}
     */
    public function supportsClass($class)
    {
        return 'Weblinks\Domain\User' === $class;
    }

    /**
     * Create a user object using the a DB row
     *
     * @param array $row the DB row containing User Data
     * @return \WebLinks\Domain\User
     */
    protected function buildDomainObject($row)
    {
        $user = new User();
        $user->setId($row['user_id']);
        $user->setUsername($row['user_name']);
        $user->setPassword($row['user_password']);
        $user->setSalt($row['user_salt']);
        $user->setRole($row['user_role']);
        return $user;
    }
}