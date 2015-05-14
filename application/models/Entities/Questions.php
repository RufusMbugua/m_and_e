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
     * Set description
     *
     * @param string $description
     *
     * @return Questions
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set options
     *
     * @param string $options
     *
     * @return Questions
     */
    public function setOptions($options)
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Get options
     *
     * @return string
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Set subCategory
     *
     * @param \SubCategories $subCategory
     *
     * @return Questions
     */
    public function setSubCategory(\SubCategories $subCategory = null)
    {
        $this->subCategory = $subCategory;

        return $this;
    }

    /**
     * Get subCategory
     *
     * @return \SubCategories
     */
    public function getSubCategory()
    {
        return $this->subCategory;
    }
}
