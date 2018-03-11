<?php
namespace NoInc\SimpleStorefront\ApiBundle\Controller;

use NoInc\SimpleStorefront\ApiBundle\Entity\Ingredient;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class IngredientController extends Controller
{
    /**
     * @Route("/recipes", name="list_recipes")
     * @Method("GET")
     */
    public function listRecipeAction(Request $request, Ingredient $ingredient)
    {
        $stock = $ingredient->getStock();
        $stock++;
        $ingredient->setStock($stock);

        return $ingredient;
    }
}