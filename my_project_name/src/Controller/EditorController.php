<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Security;

class EditorController extends AbstractController
{

    /**
     * @Route("/editor", name="app_editor")
     */
    public function load_main(): Response
    {
        return $this->render('editor/editor.html.twig');
    }
}