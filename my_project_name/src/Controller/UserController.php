<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Security;

class UserController extends AbstractController
{

    /**
     * @Route("/user", name="app_user")
     */
    public function load_main(): Response
    {
        return $this->render('user/user.html.twig');
    }
}