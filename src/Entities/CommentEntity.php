<?php

namespace App\Entities;
/**
 * Class CommentEntity
 */
class CommentEntity
{
    private $id;
    private $content;
    private $author;
    private $creationDate;
    private $avatar;

    /**
     * CommentEntity constructor.
     * @param $id
     * @param $content
     * @param $author
     * @param $creationDate
     * @param $avatar
     */
    public function __construct($id, $content, $author, $creationDate, $avatar)
    {
        $this->id = $id;
        $this->content = $content;
        $this->author = $author;
        $this->creationDate = $creationDate;
        $this->avatar = $avatar;
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
    public function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    public function setContent($content): void
    {
        $this->content = $content;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author): void
    {
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * @param mixed $creationDate
     */
    public function setCreationDate($creationDate): void
    {
        $this->creationDate = $creationDate;
    }

    /**
     * @return mixed
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * @param mixed $avatar
     */
    public function setAvatar($avatar): void
    {
        $this->avatar = $avatar;
    }




}