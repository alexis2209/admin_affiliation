<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Import
 *
 * @ORM\Table(name="import", indexes={@ORM\Index(name="fk_import_1_idx", columns={"site_id"}), @ORM\Index(name="fk_import_2_idx", columns={"brand_id"})})
 * @ORM\Entity
 */
class Import
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
     * @var string
     *
     * @ORM\Column(name="url", type="text", length=0, nullable=false)
     */
    private $url;

    /**
     * @var string
     *
     * @ORM\Column(name="from", type="string", length=45, nullable=false)
     */
    private $from;

    /**
     * @var string|null
     *
     * @ORM\Column(name="filter", type="string", length=45, nullable=true)
     */
    private $filter;

    /**
     * @var int|null
     *
     * @ORM\Column(name="brand_id", type="integer", nullable=true)
     */
    private $brandId;

    /**
     * @var \Website
     *
     * @ORM\ManyToOne(targetEntity="Website")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="site_id", referencedColumnName="id")
     * })
     */
    private $site;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getFrom(): ?string
    {
        return $this->from;
    }

    public function setFrom(string $from): self
    {
        $this->from = $from;

        return $this;
    }

    public function getFilter(): ?string
    {
        return $this->filter;
    }

    public function setFilter(?string $filter): self
    {
        $this->filter = $filter;

        return $this;
    }

    public function getBrandId(): ?int
    {
        return $this->brandId;
    }

    public function setBrandId(?int $brandId): self
    {
        $this->brandId = $brandId;

        return $this;
    }

    public function getSite(): ?Website
    {
        return $this->site;
    }

    public function setSite(?Website $site): self
    {
        $this->site = $site;

        return $this;
    }


}
