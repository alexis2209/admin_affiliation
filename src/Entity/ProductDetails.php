<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ProductDetails
 *
 * @ORM\Table(name="product_details", indexes={@ORM\Index(name="fk_detail_produit_1_idx", columns={"product_id"}), @ORM\Index(name="fk_detail_produit_2_idx", columns={"brand_id"})})
 * @ORM\Entity
 */
class ProductDetails
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="label", type="string", length=45, nullable=true)
     */
    private $label;

    /**
     * @var string|null
     *
     * @ORM\Column(name="content", type="string", length=45, nullable=true)
     */
    private $content;

    /**
     * @var string|null
     *
     * @ORM\Column(name="link", type="string", length=255, nullable=true)
     */
    private $link;

    /**
     * @var string|null
     *
     * @ORM\Column(name="price_base", type="string", length=45, nullable=true)
     */
    private $priceBase;

    /**
     * @var string|null
     *
     * @ORM\Column(name="price", type="string", length=45, nullable=true)
     */
    private $price;

    /**
     * @var \Product
     *
     * @ORM\ManyToOne(targetEntity="Product")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     * })
     */
    private $product;

    /**
     * @var \Brand
     *
     * @ORM\ManyToOne(targetEntity="Brand")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="brand_id", referencedColumnName="id")
     * })
     */
    private $brand;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(?string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getLink(): ?string
    {
        return $this->link;
    }

    public function setLink(?string $link): self
    {
        $this->link = $link;

        return $this;
    }

    public function getPriceBase(): ?string
    {
        return $this->priceBase;
    }

    public function setPriceBase(?string $priceBase): self
    {
        $this->priceBase = $priceBase;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(?string $price): self
    {
        $this->price = $price;

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

    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

    public function setBrand(?Brand $brand): self
    {
        $this->brand = $brand;

        return $this;
    }


}
