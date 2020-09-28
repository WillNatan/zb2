<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ShopReviewsRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *  normalizationContext={"groups"={"shop_reviews_read"}},
 * )
 * @ORM\Entity(repositoryClass=ShopReviewsRepository::class)
 */
class ShopReviews
{
    /**
     * @ORM\Id()
     * @Groups({"shop_reviews_read","shops_read"})
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"shop_reviews_read","shops_read"})
     * @ORM\Column(type="text")
     */
    private $reviewBody;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="shopReviews")
     */
    private $user;

    /**
     * @Groups({"shop_reviews_read"})
     * @ORM\ManyToOne(targetEntity=Shop::class, inversedBy="shopReviews")
     */
    private $shop;

    /**
     * @Groups({"shop_read","shop_reviews_read","shops_read"})
     * @ORM\Column(type="integer")
     */
    private $stars;

    /**
     * @Groups({"shop_read","shop_reviews_read","shops_read"})
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Groups({"shop_read","shop_reviews_read","shops_read"})
     * @ORM\Column(type="string", length=255)
     */
    private $email;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReviewBody(): ?string
    {
        return $this->reviewBody;
    }

    public function setReviewBody(string $reviewBody): self
    {
        $this->reviewBody = $reviewBody;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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

    public function getStars(): ?int
    {
        return $this->stars;
    }

    public function setStars(int $stars): self
    {
        $this->stars = $stars;

        return $this;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }
}
