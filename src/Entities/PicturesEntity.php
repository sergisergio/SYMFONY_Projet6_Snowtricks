<?php

namespace App\Entities;
/**
 * Class PicturesEntity
 */
class PicturesEntity
{
    private $id;
    private $extension;

    /**
     * PicturesEntity constructor.
     * @param $id
     * @param $extension
     */
    public function __construct($id, $extension)
    {
        $this->id = $id;
        $this->extension = $extension;
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
    public function getExtension()
    {
        return $this->extension;
    }

    /**
     * @param mixed $extension
     */
    public function setExtension($extension): void
    {
        $this->extension = $extension;
    }




}