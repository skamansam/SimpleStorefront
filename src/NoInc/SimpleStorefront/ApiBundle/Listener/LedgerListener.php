<?php
namespace NoInc\SimpleStorefront\ApiBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use NoInc\SimpleStorefront\ApiBundle\Entity\Product;

class LedgerListener
{
    /**
     * @var SecurityContext
     */
    protected $context;

    /**
     * @param SecurityContext $context
     */
    public function __construct($context)
    {
        $this->context = $context;
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $ledger = $args->getEntity();

        // Only act on a Product entity
        if (! $ledger instanceof Ledger) {
            return;
        }
        $ledger->setPurchasedAt(new \DateTime("now"));
        $ledger->setUser($this->context->getUser());

        $product = $ledger->getProduct();
        $product->setQuantity($product->getQuantity() - 1)

    }
}