<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Historique
 *
 * @ORM\Table(name="historique", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_EDBFD5EC381CDA7C", columns={"old_post_id"})}, indexes={@ORM\Index(name="IDX_EDBFD5ECA76ED395", columns={"user_id"}), @ORM\Index(name="IDX_EDBFD5ECA77FBEAF", columns={"blog_post_id"})})
 * @ORM\Entity
 */
class Historique
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
     * @ORM\Column(name="action", type="string", length=255, nullable=false)
     */
    private $action;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="action_date", type="datetime", nullable=false)
     */
    private $actionDate;

    /**
     * @var \OldPost
     *
     * @ORM\ManyToOne(targetEntity="OldPost")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="old_post_id", referencedColumnName="id")
     * })
     */
    private $oldPost;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     * })
     */
    private $user;

    /**
     * @var \BlogPost
     *
     * @ORM\ManyToOne(targetEntity="BlogPost")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="blog_post_id", referencedColumnName="id")
     * })
     */
    private $blogPost;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAction(): ?string
    {
        return $this->action;
    }

    public function setAction(string $action): self
    {
        $this->action = $action;

        return $this;
    }

    public function getActionDate(): ?\DateTimeInterface
    {
        return $this->actionDate;
    }

    public function setActionDate(\DateTimeInterface $actionDate): self
    {
        $this->actionDate = $actionDate;

        return $this;
    }

    public function getOldPost(): ?OldPost
    {
        return $this->oldPost;
    }

    public function setOldPost(?OldPost $oldPost): self
    {
        $this->oldPost = $oldPost;

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

    public function getBlogPost(): ?BlogPost
    {
        return $this->blogPost;
    }

    public function setBlogPost(?BlogPost $blogPost): self
    {
        $this->blogPost = $blogPost;

        return $this;
    }


}
