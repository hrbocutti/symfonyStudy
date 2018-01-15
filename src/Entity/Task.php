<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TaskRepository")
 */
class Task
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    // add your own fields

    /**
     * @var String
     * @ORM\Column(name="title", type="string")
     *
     */
    private $title = "";

    /**
     * @var String
     * @ORM\Column(name="description", type="string")
     */
    private $description = "";

    /**
     * @var String
     * @ORM\Column(name="time_spent", type="integer")
     */
    private $time_spent = 0;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return String
     */
    public function getTitle(): String
    {
        return $this->title;
    }

    /**
     * @param String $title
     */
    public function setTitle(String $title): void
    {
        $this->title = $title;
    }

    /**
     * @return String
     */
    public function getDescription(): String
    {
        return $this->description;
    }

    /**
     * @param String $description
     */
    public function setDescription(String $description): void
    {
        $this->description = $description;
    }

    /**
     * @return String
     */
    public function getTimeSpent(): String
    {
        return $this->time_spent;
    }

    /**
     * @param String $time_spent
     */
    public function setTimeSpent(String $time_spent): void
    {
        $this->time_spent = $time_spent;
    }

}
