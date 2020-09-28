<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ShopRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *  normalizationContext={"groups"={"shops_read"}},
 * )
 * @ORM\Entity(repositoryClass=ShopRepository::class)
 */
class Shop
{
    /**
     * @Groups({"address_read","promotions_read","shops_read", "shop_category_read","shop_reviews_read"})
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"address_read","promotions_read","shops_read", "shop_category_read","shop_reviews_read"})
     * @ORM\Column(type="string", length=255)
     */
    private $shopName;

    /**
     * @Groups("shops_read")
     * @ORM\OneToMany(targetEntity=ShopReviews::class, mappedBy="shop")
     */
    private $shopReviews;

    /**
     * @Groups("shops_read")
     * @ORM\ManyToOne(targetEntity=ShopCategory::class, inversedBy="shop")
     */
    private $shopCategory;

    /**
     * @Groups("shops_read")
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @Groups("shops_read")
     * @ORM\Column(type="string", length=255)
     */
    private $slug;

    /**
     * @Groups("shops_read")
     * @ORM\OneToMany(targetEntity=Address::class, mappedBy="shop")
     */
    private $addresses;

    /**
     * @Groups("shops_read")
     * @ORM\OneToMany(targetEntity=OpeningTime::class, mappedBy="shop")
     */
    private $openingTime;

    /**
     * @Groups("shops_read")
     * @ORM\OneToMany(targetEntity=Promotion::class, mappedBy="shop")
     */
    private $promotions;

    public function __construct()
    {
        $this->shopReviews = new ArrayCollection();
        $this->addresses = new ArrayCollection();
        $this->openingTime = new ArrayCollection();
        $this->promotions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getShopName(): ?string
    {
        return $this->shopName;
    }

    public function setShopName(string $shopName): self
    {
        $this->shopName = $shopName;

        return $this;
    }

    /**
     * @return Collection|ShopReviews[]
     */
    public function getShopReviews(): Collection
    {
        return $this->shopReviews;
    }

    public function addShopReview(ShopReviews $shopReview): self
    {
        if (!$this->shopReviews->contains($shopReview)) {
            $this->shopReviews[] = $shopReview;
            $shopReview->setShop($this);
        }

        return $this;
    }

    public function removeShopReview(ShopReviews $shopReview): self
    {
        if ($this->shopReviews->contains($shopReview)) {
            $this->shopReviews->removeElement($shopReview);
            // set the owning side to null (unless already changed)
            if ($shopReview->getShop() === $this) {
                $shopReview->setShop(null);
            }
        }

        return $this;
    }

    public function getShopCategory(): ?ShopCategory
    {
        return $this->shopCategory;
    }

    public function setShopCategory(?ShopCategory $shopCategory): self
    {
        $this->shopCategory = $shopCategory;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return Collection|Address[]
     */
    public function getAddresses(): Collection
    {
        return $this->addresses;
    }

    public function addAddress(Address $address): self
    {
        if (!$this->addresses->contains($address)) {
            $this->addresses[] = $address;
            $address->setShop($this);
        }

        return $this;
    }

    public function removeAddress(Address $address): self
    {
        if ($this->addresses->contains($address)) {
            $this->addresses->removeElement($address);
            // set the owning side to null (unless already changed)
            if ($address->getShop() === $this) {
                $address->setShop(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|OpeningTime[]
     */
    public function getOpeningTime(): Collection
    {
        return $this->openingTime;
    }

    public function addOpeningTime(OpeningTime $openingTime): self
    {
        if (!$this->openingTime->contains($openingTime)) {
            $this->openingTime[] = $openingTime;
            $openingTime->setShop($this);
        }

        return $this;
    }

    public function removeOpeningTime(OpeningTime $openingTime): self
    {
        if ($this->openingTime->contains($openingTime)) {
            $this->openingTime->removeElement($openingTime);
            // set the owning side to null (unless already changed)
            if ($openingTime->getShop() === $this) {
                $openingTime->setShop(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Promotion[]
     */
    public function getPromotions(): Collection
    {
        return $this->promotions;
    }

    public function addPromotion(Promotion $promotion): self
    {
        if (!$this->promotions->contains($promotion)) {
            $this->promotions[] = $promotion;
            $promotion->setShop($this);
        }

        return $this;
    }

    public function removePromotion(Promotion $promotion): self
    {
        if ($this->promotions->contains($promotion)) {
            $this->promotions->removeElement($promotion);
            // set the owning side to null (unless already changed)
            if ($promotion->getShop() === $this) {
                $promotion->setShop(null);
            }
        }

        return $this;
    }
}
