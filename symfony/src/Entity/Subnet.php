<?php

namespace App\Entity;

use App\Repository\SubnetRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SubnetRepository::class)
 */
class Subnet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=16)
     */
    private $subnet;

    /**
     * @ORM\Column(type="smallint")
     */
    private $cidr;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubnet(): ?string
    {
        return $this->subnet;
    }

    public function setSubnet(string $subnet): self
    {
        $this->subnet = $subnet;

        return $this;
    }

    public function getCidr(): ?int
    {
        return $this->cidr;
    }

    public function setCidr(int $cidr): self
    {
        $this->cidr = $cidr;

        return $this;
    }
}
