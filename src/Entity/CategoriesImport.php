<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CategoriesImport
 *
 * @ORM\Table(name="categories_import", indexes={@ORM\Index(name="fk_categories_import_1_idx", columns={"categorie_id"}), @ORM\Index(name="fk_categories_import_2_idx", columns={"import_id"})})
 * @ORM\Entity
 */
class CategoriesImport
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
     * @ORM\Column(name="label", type="text", length=0, nullable=true)
     */
    private $label;

    /**
     * @var \Categorie
     *
     * @ORM\ManyToOne(targetEntity="Categorie")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="categorie_id", referencedColumnName="id")
     * })
     */
    private $categorie;

    /**
     * @var \Import
     *
     * @ORM\ManyToOne(targetEntity="Import")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="import_id", referencedColumnName="id")
     * })
     */
    private $import;

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

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getImport(): ?Import
    {
        return $this->import;
    }

    public function setImport(?Import $import): self
    {
        $this->import = $import;

        return $this;
    }




}
