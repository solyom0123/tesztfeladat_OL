<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Security;

class AdminController extends AbstractController
{

    /**
     * @Route("/admin", name="app_admin")
     */
    public function load_main(): Response
    {
        return $this->render('admin/admin.html.twig');
    }
}