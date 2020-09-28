<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ShopCategoryRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *  normalizationContext={"groups"={"shop_category_read"}},
 * )
 * @ORM\Entity(repositoryClass=ShopCategoryRepository::class)
 */
class ShopCategory
{
    /**
     * @Groups({"shop_category_read","shops_read"})
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @Groups({"shop_category_read","shops_read"})
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     *
     * @ORM\OneToMany(targetEntity=Shop::class, mappedBy="shopCategory")
     */
    private $shop;

    public function __construct()
    {
        $this->shop = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|Shop[]
     */
    public function getShop(): Collection
    {
        return $this->shop;
    }

    public function addShop(Shop $shop): self
    {
        if (!$this->shop->contains($shop)) {
            $this->shop[] = $shop;
            $shop->setShopCategory($this);
        }

        return $this;
    }

    public function removeShop(Shop $shop): self
    {
        if ($this->shop->contains($shop)) {
            $this->shop->removeElement($shop);
            // set the owning side to null (unless already changed)
            if ($shop->getShopCategory() === $this) {
                $shop->setShopCategory(null);
            }
        }

        return $this;
    }
}
