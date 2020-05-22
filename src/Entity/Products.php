<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductsRepository")
 */
class Products
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $p_title;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $p_price;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPTitle(): ?string
    {
        return $this->p_title;
    }

    public function setPTitle(?string $p_title): self
    {
        $this->p_title = $p_title;

        return $this;
    }

    public function getPPrice(): ?string
    {
        return $this->p_price;
    }

    public function setPPrice(?string $p_price): self
    {
        $this->p_price = $p_price;

        return $this;
    }
}
