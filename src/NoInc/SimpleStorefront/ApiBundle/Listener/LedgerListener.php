<?php
namespace NoInc\SimpleStorefront\ApiBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use NoInc\SimpleStorefront\ApiBundle\Entity\Product;

class LedgerListener
{
    /**
     * @var SecurityContext
     */
    protected $token_storage;

    /**
     * @var User
     */
    protected $user;

    /**
     * @param SecurityContext $context
     */
    public function __construct($token_storage, $user)
    {
        $this->token_storage = $token_storage;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $ledger = $args->getEntity();

        // Only act on a Product entity
        if (! $ledger instanceof Ledger) {
            return;
        }
        $ledger->setPurchasedAt(new \DateTime("now"));
        $ledger->setUser($this->token_storage->getToken()->getUser());

        $product = $ledger->getProduct();
        $product->setQuantity($product->getQuantity() - 1)

    }
}