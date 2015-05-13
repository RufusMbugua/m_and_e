<?php

namespace models\Entities;

/**
 * SubCategories
 */
class SubCategories
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var \models\Entities\Categories
     */
    private $category;


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
     * Set name
     *
     * @param string $name
     *
     * @return SubCategories
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set category
     *
     * @param \models\Entities\Categories $category
     *
     * @return SubCategories
     */
    public function setCategory(\models\Entities\Categories $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \models\Entities\Categories
     */
    public function getCategory()
    {
        return $this->category;
    }
}
