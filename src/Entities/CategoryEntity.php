<?php

namespace App\Entities;
class CategoryEntity
{
    private $id;
    private $category;

    /**
     * CategoryEntity constructor.
     * @param $id
     * @param $category
     */
    public function __construct($id, $category)
    {
        $this->id = $id;
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category): void
    {
        $this->category = $category;
    }




}