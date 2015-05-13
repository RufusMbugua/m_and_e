<?php



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


}
