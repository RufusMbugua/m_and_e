<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Departments
 *
 * @Table(name="departments")
 * @Entity
 */
class Departments
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
     * @Column(name="name", type="string", length=45, nullable=true)
     */
    private $name;


}

