<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\OpeningTimeRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *  normalizationContext={"groups"={"opening_times_read"}},
 * )
 * @ORM\Entity(repositoryClass=OpeningTimeRepository::class)
 */
class OpeningTime
{
    /**
     * @ORM\Id()
     * @Groups({"opening_times_read"})
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"shops_read", "opening_times_read"})
     * @ORM\Column(type="string", length=255)
     */
    private $day;

    /**
     * @Groups({"shops_read", "opening_times_read"})
     * @ORM\Column(type="time")
     */
    private $openTime;

    /**
     * @Groups({"shops_read", "opening_times_read"})
     * @ORM\Column(type="time")
     */
    private $closeTime;

    /**
     * @Groups({"opening_times_read"})
     * @ORM\ManyToOne(targetEntity=Shop::class, inversedBy="openingTime")
     */
    private $shop;

    public function __construct()
    {
        $this->shop = new ArrayCollection();
        $this->shops = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDay(): ?string
    {
        return $this->day;
    }

    public function setDay(string $day): self
    {
        $this->day = $day;

        return $this;
    }

    public function getOpenTime(): ?\DateTimeInterface
    {
        return $this->openTime;
    }

    public function setOpenTime(\DateTimeInterface $openTime): self
    {
        $this->openTime = $openTime;

        return $this;
    }

    public function getCloseTime(): ?\DateTimeInterface
    {
        return $this->closeTime;
    }

    public function setCloseTime(\DateTimeInterface $closeTime): self
    {
        $this->closeTime = $closeTime;

        return $this;
    }


    public function setShop(?Shop $shop): self
    {
        $this->shop = $shop;

        return $this;
    }

    /**
     * Get the value of shop
     */ 
    public function getShop()
    {
        return $this->shop;
    }
}
