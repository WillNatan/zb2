<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProductReviewRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *  normalizationContext={"groups"={"product_reviews_read"}},
 * )
 * @ORM\Entity(repositoryClass=ProductReviewRepository::class)
 */
class ProductReview
{
    /**
     * @Groups({"products_read"})
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"products_read", "product_reviews_read"})
     * @ORM\Column(type="text")
     */
    private $reviewBody;

    /**
     * @Groups({"product_reviews_read"})
     * @ORM\ManyToOne(targetEntity=Product::class, inversedBy="productReviews")
     */
    private $product;

    /**
     * @Groups({"product_reviews_read"})
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="productReviews")
     */
    private $user;

    /**
     * @Groups({"products_read", "product_reviews_read"})
     * @ORM\Column(type="integer")
     */
    private $stars;

    /**
     * @Groups({"products_read", "product_reviews_read"})
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @Groups({"product_reviews_read"})
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

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

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
