<?php
namespace NoInc\SimpleStorefront\ApiBundle\Listener;

use Doctrine\ORM\Event\LifecycleEventArgs;
use NoInc\SimpleStorefront\ApiBundle\Entity\Product;

class ProductListener
{
    public function preUpdate(PreUpdateEventArgs $eventArgs)
    {
        if($eventArgs->hasChangedField('quantity')) {
            $product = $eventArgs->getEntity();
            $oldQty = $eventArgs->getOldValue('quantity');
            $newQty = $eventArgs->getNewValue('quantity');
            $itemsUsed = $newQty - $oldQty;
            if($newQty < 0) {
                throw new Exception('There are no products in stock.');
            }
            if($newQty < $oldQty){
                return; // we are selling an item, so no need to check stock
            }
            foreach ($product->$recipe->getRecipeIngredients() as $recipeIngredient) {
                $ingredient = $recipeIngredient->getIngredient();
                if($ingredient->getStock() < 1) {
                    throw new Exception('Not enough ingredients');
                }
            }
        }
    }


    public function prePersist(LifecycleEventArgs $args)
    {
        /** @var \NoInc\SimpleStorefront\ApiBundle\Entity\RecipeIngredient $recipeIngredient **/
        $recipeIngredient = null;

        $entity = $args->getEntity();

        // Only act on a Product entity
        if (! $entity instanceof Product) {
            return;
        }

        // Set the createdAt timestamp
        $entity->setCreatedAt(new \DateTime("now"));

        // Get the Recipe for the product
        $recipe = $entity->getRecipe();

        // Reduce the Ingredient stocks based on the RecipeIngredient quantities
        foreach ($recipe->getRecipeIngredients() as $recipeIngredient) {
            $ingredient = $recipeIngredient->getIngredient();

            // Determine current stock value
            $stock = $ingredient->getStock();

            // Alter stock value
            $stock -= $recipeIngredient->getQuantity();

            // Set new, altered stock value
            $ingredient->setStock($stock);
        }
    }
}