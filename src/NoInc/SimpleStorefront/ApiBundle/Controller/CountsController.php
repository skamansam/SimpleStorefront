<?php
namespace NoInc\SimpleStorefront\ApiBundle\Controller;

use NoInc\SimpleStorefront\ApiBundle\Entity\Ingredient;
use NoInc\SimpleStorefront\ApiBundle\Entity\Recipe;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class CountsController extends Controller
{
    /**
     * @Route("/counts.{_format}", name="list_counts")
     * @Method("GET")
     */
    public function listCountsAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $ingredientCount = intval($em->createQueryBuilder('ingredient')
                    ->select('COUNT(i.id)')
                    ->from('NoInc\SimpleStorefront\ApiBundle\Entity\Ingredient', 'i')
                    ->getQuery()->getSingleScalarResult());

        $recipeCount = intval($em->createQueryBuilder('recipe')
                    ->select('COUNT(i.id)')
                    ->from('NoInc\SimpleStorefront\ApiBundle\Entity\Recipe', 'i')
                    ->getQuery()->getSingleScalarResult());

        $productCount = intval($em->createQueryBuilder('product')
                    ->select('COUNT(i.id)')
                    ->from('NoInc\SimpleStorefront\ApiBundle\Entity\Product', 'i')
                    ->getQuery()->getSingleScalarResult());

        $userCount = intval($em->createQueryBuilder('user')
                    ->select('COUNT(i.id)')
                    ->from('NoInc\SimpleStorefront\ApiBundle\Entity\User', 'i')
                    ->getQuery()->getSingleScalarResult());

        return new JsonResponse([
            'ingredients' => $ingredientCount,
            'recipes'    => $recipeCount,
            'products'  => $productCount,
            'users' => $userCount
        ]);
    }
}