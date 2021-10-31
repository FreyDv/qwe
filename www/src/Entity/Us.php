<?php

namespace App\Entity;

use App\Repository\UsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UsRepository::class)
 */
class Us
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $age;

    /**
     * @ORM\Column(type="integer")
     */
    private $zp;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getAge(): ?int
    {
        return $this->age;
    }

    public function setAge(int $age): self
    {
        $this->age = $age;

        return $this;
    }

    public function getZp(): ?int
    {
        return $this->zp;
    }

    public function setZp(int $zp): self
    {
        $this->zp = $zp;

        return $this;
    }

    public function __construct($name,$age,$zp){
        $this->setName($name);
        $this->setAge($age);
        $this->setZp($zp);
    }
}
