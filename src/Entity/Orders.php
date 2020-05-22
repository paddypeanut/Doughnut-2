<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrdersRepository")
 */
class Orders
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $order_contents;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $total_price;

    /**
     * @ORM\Column(type="string",length=255)
     */
    private $user_id;

    /**
     * @ORM\Column(type="string",length=255)
     */
    private $del_address;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $phone_number;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $delivered_by;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $order_date;

   


    public function getOrderDate(): ?string
    {
        return $this->order_date;
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getDeliveredBy(): ?string
    {
        return $this->id;
    }

    public function getPhoneNumber(): ?string
    {
        return $this->phone_number;
    }

    public function getOrderContents(): ?string
    {
        return $this->order_contents;
    }

    public function getDelAddress(): ?string
    {
        return $this->del_address;
    }

    public function setOrderContents(string $order_contents): self
    {
        $this->order_contents = $order_contents;

        return $this;
    }

    public function setDeliveredBy(string $delivered_by): self
    {
        $this->delivered_by = $delivered_by;

        return $this;
    }

    public function setPhoneNumber(string $phone_number): self
    {
        $this->phone_number = $phone_number;

        return $this;
    }

    public function setDelAddress(string $del_address): self
    {
        $this->del_address = $del_address;

        return $this;
    }

    public function getTotalPrice(): ?string
    {
        return $this->total_price;
    }

    public function setTotalPrice(string $total_price): self
    {
        $this->total_price = $total_price;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(string $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }
    public function setOrderDate(string $order_date): self
    {
        $this->order_date = $order_date;

        return $this;
    }
}
