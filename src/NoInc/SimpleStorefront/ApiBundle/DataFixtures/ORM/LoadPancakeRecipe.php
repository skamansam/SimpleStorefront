<?php
namespace NoInc\SimpleStorefront\ApiBundle\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use NoInc\SimpleStorefront\ApiBundle\Entity\Ingredient;
use NoInc\SimpleStorefront\ApiBundle\Entity\RecipeIngredient;
use NoInc\SimpleStorefront\ApiBundle\Entity\Recipe;

class LoadPancakeRecipe extends Fixture
{

    public function load(ObjectManager $manager)
    {
        $recipe = new Recipe();
        $recipe->setName('Pancake');
        $recipe->setPrice(3.00);

        $recipeIngredients = [
            [
                'ingredient' => $this->getReference(Ingredient::class . ':Milk'),
                'quantity' => 1
            ],
            [
                'ingredient' => $this->getReference(Ingredient::class . ':Egg'),
                'quantity' => 2
            ],
            [
                'ingredient' => $this->getReference(Ingredient::class . ':Butter'),
                'quantity' => 3.
            ],
            [
                'ingredient' => $this->getReference(Ingredient::class . ':Flour'),
                'quantity' => 1.25
            ],
            [
                'ingredient' => $this->getReference(Ingredient::class . ':Baking Soda'),
                'quantity' => 1
            ],
            [
                'ingredient' => $this->getReference(Ingredient::class . ':Baking Powder'),
                'quantity' => 1
            ],
            [
                'ingredient' => $this->getReference(Ingredient::class . ':Sugar'),
                'quantity' => 0.125
            ],
        ];

        foreach ( $recipeIngredients as $recipeIngredientData ) {
            $recipeIngredient = new RecipeIngredient();

            $recipeIngredient->setIngredient($recipeIngredientData['ingredient']);
            $recipeIngredient->setQuantity($recipeIngredientData['quantity']);

            $manager->persist($recipeIngredient);

            $recipe->addRecipeIngredient($recipeIngredient);
        }

        $manager->persist($recipe);
        $manager->flush();
    }

}

?>