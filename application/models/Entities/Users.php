<?php

namespace models\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Users
 *
 * @Table(name="users")
 * @Entity
 */
class Users
{
    /**
     * @var integer
     *
     * @Column(name="id", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @Column(name="username", type="string", length=45, nullable=true)
     */
    private $username;

    /**
     * @var string
     *
     * @Column(name="password", type="string", length=45, nullable=true)
     */
    private $password;

    /**
     * @var integer
     *
     * @Column(name="employee_id", type="integer", nullable=true)
     */
    private $employeeId;

    /**
     * @var string
     *
     * @Column(name="last_logged", type="string", length=45, nullable=true)
     */
    private $lastLogged;



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
     * Set username
     *
     * @param string $username
     *
     * @return Users
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Users
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set employeeId
     *
     * @param integer $employeeId
     *
     * @return Users
     */
    public function setEmployeeId($employeeId)
    {
        $this->employeeId = $employeeId;

        return $this;
    }

    /**
     * Get employeeId
     *
     * @return integer
     */
    public function getEmployeeId()
    {
        return $this->employeeId;
    }

    /**
     * Set lastLogged
     *
     * @param string $lastLogged
     *
     * @return Users
     */
    public function setLastLogged($lastLogged)
    {
        $this->lastLogged = $lastLogged;

        return $this;
    }

    /**
     * Get lastLogged
     *
     * @return string
     */
    public function getLastLogged()
    {
        return $this->lastLogged;
    }
}
