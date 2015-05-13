<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Assessees
 *
 * @Table(name="assessees", indexes={@Index(name="assess_users_idx", columns={"user_id"}), @Index(name="assess_department_idx", columns={"department_id"})})
 * @Entity
 */
class Assessees
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
     * @Column(name="first_name", type="string", length=45, nullable=true)
     */
    private $firstName;

    /**
     * @var string
     *
     * @Column(name="last_name", type="string", length=45, nullable=true)
     */
    private $lastName;

    /**
     * @var \DateTime
     *
     * @Column(name="dob", type="datetime", nullable=true)
     */
    private $dob;

    /**
     * @var \Departments
     *
     * @ManyToOne(targetEntity="Departments")
     * @JoinColumns({
     *   @JoinColumn(name="department_id", referencedColumnName="id")
     * })
     */
    private $department;

    /**
     * @var \Users
     *
     * @ManyToOne(targetEntity="Users")
     * @JoinColumns({
     *   @JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;


}

