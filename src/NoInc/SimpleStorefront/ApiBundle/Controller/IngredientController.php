<?php
namespace NoInc\SimpleStorefront\ApiBundle\Controller;

use ApiPlatform\Core\Annotation\ApiResource;
use NoInc\SimpleStorefront\ApiBundle\Entity\Ingredient;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Annotation\Groups;

class IngredientController extends Controller
{
    /**
     * @Route(path="/ingredients/{id}/purchase.{_format}", name="put_ingredient_purchase",defaults = {
     *          "_api_resource_class" = Ingredient::class,
     *          "_api_collection_operation_name" = "put_ingredient_purchase",
     *
     *     })
     * @Method("PUT")
     * @Groups({"set_ingredient"})
     */
    public function putPurchaseAction(Request $request, Ingredient $ingredient)
    {
        $stock = $ingredient->getStock();
        $stock++;
        $ingredient->setStock($stock);
        #var_dump($ingredient);
        # return $ingredient;
        return new JsonResponse($ingredient);
    }
}
