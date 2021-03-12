<?php

namespace App\Entity;

use App\Repository\LiensRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LiensRepository::class)
 */
class Liens
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToOne(targetEntity=Group::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $TP;

    /**
     * @ORM\ManyToOne(targetEntity=group::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $TD;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTP(): ?Group
    {
        return $this->TP;
    }

    public function setTP(Group $TP): self
    {
        $this->TP = $TP;

        return $this;
    }

    public function getTD(): ?group
    {
        return $this->TD;
    }

    public function setTD(?group $TD): self
    {
        $this->TD = $TD;

        return $this;
    }
}
