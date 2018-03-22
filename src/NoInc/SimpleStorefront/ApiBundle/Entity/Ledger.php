<?php

declare(strict_types=1);

namespace NoInc\SimpleStorefront\ApiBundle\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ApiResource(iri="http://schema.org/Thing", collectionOperations={"get"={"normalization_context"={"groups"={"get_ledger"}}, "denormalization_context"={"groups"={"set_ledger"}}, "method"="GET"}}, itemOperations={"get"={"normalization_context"={"groups"={"get_ledger"}}, "denormalization_context"={"groups"={"set_ledger"}}, "method"="GET"}})
 * The most generic type of item.
 *
 * @see http://schema.org/Thing Documentation on Schema.org
 */
class Ledger
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @Groups({"output"})
     *
     * @var int|null
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="NoInc\SimpleStorefront\ApiBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"get_ledger", "set_ledger"})
     *
     * @var User|null
     */
    protected $user;

    /**
     * @ORM\ManyToOne(targetEntity="NoInc\SimpleStorefront\ApiBundle\Entity\Product")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"get_ledger", "set_ledger"})
     *
     * @var Product|null
     */
    protected $product;

    /**
     * @ORM\Column(nullable=false)
     * @Groups({"get_ledger", "set_ledger"})
     *
     * @var \DateTimeInterface
     *
     * @Assert\Date
     * @Assert\NotNull
     */
    protected $purchased_at;

    /**
     * @ORM\Column(nullable=false)
     * @Groups({"get_ledger", "set_ledger"})
     *
     * @var int
     *
     * @Assert\NotNull
     */
    protected $purchase_price_cent;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setProduct(?Product $product): self
    {
        $this->product = $product;

        return $this;
    }

    public function getProduct(): ?Product
    {
        return $this->product;
    }

    public function setPurchased_at(\DateTimeInterface $purchased_at): self
    {
        $this->purchased_at = $purchased_at;

        return $this;
    }

    public function getPurchased_at(): \DateTimeInterface
    {
        return $this->purchased_at;
    }

    public function setPurchase_price_cent(int $purchase_price_cent): self
    {
        $this->purchase_price_cent = $purchase_price_cent;

        return $this;
    }

    public function getPurchase_price_cent(): int
    {
        return $this->purchase_price_cent;
    }
}
