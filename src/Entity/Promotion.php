<?php

namespace App\Entity;

use App\Entity\Product;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PromotionRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=PromotionRepository::class)
 * @ApiResource(
 *  normalizationContext={"groups"={"promotions_read"}},
 * )
 */
class Promotion
{
    /**
     * @ORM\Id()
     * @Groups({"promotions_read"})
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"promotions_read"})
     * @ORM\Column(type="string", length=255)
     */
    private $type;

    /**
     * @Groups({"promotions_read","products_read", "shops_read"})
     * @ORM\Column(type="integer", nullable=true)
     */
    private $percentage;

    /**
     * @Groups({"promotions_read", "shops_read"})
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="promotions")
     */
    private $product;

    /**
     * @Groups({"promotions_read","products_read", "shops_read"})
     * @ORM\Column(type="date", nullable=true)
     */
    private $launchDate;

    /**
     * @Groups({"promotions_read","products_read", "shops_read"})
     * @ORM\Column(type="date", nullable=true)
     */
    private $finishDate;

    /**
     * @Groups({"promotions_read","products_read", "shops_read"})
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $details;

    /**
     * @Groups({"promotions_read"})
     * @ORM\ManyToOne(targetEntity=Shop::class, inversedBy="promotions")
     */
    private $shop;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getPercentage(): ?int
    {
        return $this->percentage;
    }

    public function setPercentage(int $percentage): self
    {
        $this->percentage = $percentage;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getLaunchDate(): ?\DateTimeInterface
    {
        return $this->launchDate;
    }

    public function setLaunchDate(\DateTimeInterface $launchDate): self
    {
        $this->launchDate = $launchDate;

        return $this;
    }

    public function getFinishDate(): ?\DateTimeInterface
    {
        return $this->finishDate;
    }

    public function setFinishDate(\DateTimeInterface $finishDate): self
    {
        $this->finishDate = $finishDate;

        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(?string $details): self
    {
        $this->details = $details;

        return $this;
    }

    public function getShop(): ?Shop
    {
        return $this->shop;
    }

    public function setShop(?Shop $shop): self
    {
        $this->shop = $shop;

        return $this;
    }
}
