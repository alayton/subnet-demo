<?php

namespace App\Entity;

use App\Repository\IpAddressRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=IpAddressRepository::class)
 */
class IpAddress
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
    private $ip;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $addressTag;

    /**
     * @ORM\ManyToOne(targetEntity=Subnet::class, inversedBy="ipAddresses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $subnet;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    public function getAddressTag(): ?string
    {
        return $this->addressTag;
    }

    public function setAddressTag(string $addressTag): self
    {
        $this->addressTag = $addressTag;

        return $this;
    }

    public function getSubnet(): ?Subnet
    {
        return $this->subnet;
    }

    public function setSubnet(?Subnet $subnet): self
    {
        $this->subnet = $subnet;

        return $this;
    }
}
