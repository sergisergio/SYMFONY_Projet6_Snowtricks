<?php

namespace App\Entities;
class VideosEntity
{
    private $id;

    /**
     * VideosEntity constructor.
     * @param $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }


}