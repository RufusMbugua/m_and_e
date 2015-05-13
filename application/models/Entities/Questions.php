<?php


namespace models\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Questions
 *
 * @Table(name="questions", indexes={@Index(name="que_sub_cat_idx", columns={"sub_category_id"})})
 * @Entity
 */
class Questions
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
     * @Column(name="description", type="text", length=65535, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @Column(name="options", type="string", length=45, nullable=true)
     */
    private $options;

    /**
     * @var \SubCategories
     *
     * @ManyToOne(targetEntity="SubCategories")
     * @JoinColumns({
     *   @JoinColumn(name="sub_category_id", referencedColumnName="id")
     * })
     */
    private $subCategory;


}
