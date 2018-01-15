<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TodoRepository")
 */
class Todo
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="string")
     */
    private $name = "";

    /**
     * @var string
     * @ORM\Column(name="category", type="string")
     */
    private $category = "";

    /**
     * @var string
     * @ORM\Column(name="description", type="string")
     */
    private $description = "";

    /**
     * @var string
     * @ORM\Column(name="priority", type="string")
     */
    private $priority = "";

    /**
     * @var \DateTime
     * @ORM\Column(name="due_date", type="datetime")
     */
    private $due_date;

    /**
     * @var \DateTime
     * @ORM\Column(name="create_date", type="datetime")
     */
    private $create_date;

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
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @param string $category
     */
    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }


    /**
     * @return string
     */
    public function getPriority(): string
    {
        return $this->priority;
    }

    /**
     * @param string $priority
     */
    public function setPriority(string $priority): void
    {
        $this->priority = $priority;
    }

    /**
     * @return \DateTime
     */
    public function getDueDate(): \DateTime
    {
        return $this->due_date;
    }

    /**
     * @param \DateTime $due_date
     */
    public function setDueDate(\DateTime $due_date): void
    {
        $this->due_date = $due_date;
    }

    /**
     * @return \DateTime
     */
    public function getCreateDate(): \DateTime
    {
        return $this->create_date;
    }

    /**
     * @param \DateTime $create_date
     */
    public function setCreateDate(\DateTime $create_date): void
    {
        $this->create_date = $create_date;
    }

}
