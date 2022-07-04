<?php

class Author implements Serializable
{
    public $authorId;
    public $name;
    public $age;

    /**
     * @param $authorId
     * @param $name
     * @param $age
     */
    public function __construct($authorId, $name, $age)
    {
        $this->authorId = $authorId;
        $this->name = $name;
        $this->age = $age;
    }

    /**
     * @return mixed
     */
    public function getAuthorId()
    {
        return $this->authorId;
    }

    /**
     * @param mixed $authorId
     */
    public function setAuthorId($authorId)
    {
        $this->authorId = $authorId;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getAge()
    {
        return $this->age;
    }

    /**
     * @param mixed $age
     */
    public function setAge($age)
    {
        $this->age = $age;
    }


    public function serialize(){
        return serialize($this);
    }

    public function unserialize($data)
    {
        return unserialize($data);
    }
}