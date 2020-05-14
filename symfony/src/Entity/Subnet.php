<?php

namespace App\Entity;

use App\Repository\SubnetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    /**
     * @ORM\OneToMany(targetEntity=IpAddress::class, mappedBy="subnet", fetch="EAGER")
     */
    private $ipAddresses;

    public function __construct()
    {
        $this->ipAddresses = new ArrayCollection();
    }

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

    /**
     * @return Collection|IpAddress[]
     */
    public function getIpAddresses(): Collection
    {
        return $this->ipAddresses;
    }

    public function addIpAddress(IpAddress $ipAddress): self
    {
        if (!$this->ipAddresses->contains($ipAddress)) {
            $this->ipAddresses[] = $ipAddress;
            $ipAddress->setSubnet($this);
        }

        return $this;
    }

    public function removeIpAddress(IpAddress $ipAddress): self
    {
        if ($this->ipAddresses->contains($ipAddress)) {
            $this->ipAddresses->removeElement($ipAddress);
            // set the owning side to null (unless already changed)
            if ($ipAddress->getSubnet() === $this) {
                $ipAddress->setSubnet(null);
            }
        }

        return $this;
    }
}
