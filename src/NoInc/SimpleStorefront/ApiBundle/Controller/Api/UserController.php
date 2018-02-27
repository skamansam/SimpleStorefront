<?php
namespace NoInc\SimpleStorefront\ApiBundle\Controller\Api;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class UserController extends Controller
{
    /**
     * @Route("/users/current", name="get_user_current")
     * @Method("GET")
     */
    public function currentAction(Request $request)
    {
        $result = [];
        
        $user = $this->getUser();
        if ( $user ) {
            $result ['id'] = $user->getId();
        }

        return new JsonResponse($result);
    }
}