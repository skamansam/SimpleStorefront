<?php
namespace NoInc\SimpleStorefront\ApiBundle\DataFixtures\ORM;

use NoInc\SimpleStorefront\ApiBundle\Entity\User;
use NoInc\SimpleStorefront\ApiBundle\Entity\Ingredient;

class LoadIngredients extends AbstractLoadEntity
{

    protected function newEntity()
    {
        return new Ingredient();
    }

    protected function getData()
    {
        return [
            [
                'measure' => Ingredient::MEASURE_EACH,
                'name' => 'Lemon',
                'price' => 0.10,
                'stock' => 12
            ],
            [
                'measure' => Ingredient::MEASURE_CUP,
                'name' => 'Sugar',
                'price' => 0.10,
                'stock' => 6
            ],
            [
                'measure' => Ingredient::MEASURE_CUP,
                'name' => 'Water',
                'price' => 0.00,
                'stock' => 18
            ],
            [
                'measure' => Ingredient::MEASURE_CUP,
                'name' => 'Flour',
                'price' => 0.40,
                'stock' => 3
            ],
            [
                'measure' => Ingredient::MEASURE_TSP,
                'name' => 'Baking Soda',
                'price' => 0.20,
                'stock' => 3
            ],
            [
                'measure' => Ingredient::MEASURE_TSP,
                'name' => 'Baking Powder',
                'price' => 0.30,
                'stock' => 9
            ],
            [
                'measure' => Ingredient::MEASURE_CUP,
                'name' => 'Milk',
                'price' => 0.20,
                'stock' => 8
            ],
            [
                'measure' => Ingredient::MEASURE_EACH,
                'name' => 'Egg',
                'price' => 0.60,
                'stock' => 13
            ],
            [
                'measure' => Ingredient::MEASURE_TBSP,
                'name' => 'Butter',
                'price' => 0.20,
                'stock' => 20
            ],
        ];
    }

    protected function toString($entity)
    {
        return $entity->getName();
    }

}

?>