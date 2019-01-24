<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MsgRepository")
 */
class Msg
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $message;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="msgs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_sender;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="msgs")
     * @ORM\JoinColumn(nullable=false)
     */
    private $id_receiver;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getIdSender(): ?User
    {
        return $this->id_sender;
    }

    public function setIdSender(?User $id_sender): self
    {
        $this->id_sender = $id_sender;

        return $this;
    }

    public function getIdReceiver(): ?User
    {
        return $this->id_receiver;
    }

    public function setIdReceiver(?User $id_receiver): self
    {
        $this->id_receiver = $id_receiver;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
