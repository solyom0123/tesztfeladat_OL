<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Security;

class MainAdminController extends AbstractController
{
    public function __construct( )
    {
    }

    /**
     * @Route("/main", name="app_main")
     */
    public function load_main(): Response
    {
        $user = $this->security->getUser();
        $menus = array();
        for ($i = 0; $i < sizeof($user->getRoles()); $i++) {
            $unionMenus = array();
            if ($user->getRoles()[$i] == "ROLE_ADMIN") {
                array_push($unionMenus, "app_editor","app_user", "app_admin");
            } else if ($user->getRoles()[$i] == "ROLE_USER") {
                array_push( $unionMenus,"app_user");
            } else if ($user->getRoles()[$i] == "ROLE_EDITOR") {
                array_push($unionMenus,"app_editor");
            }
            $menus =array_merge($menus,array_diff($unionMenus,$menus));
           }
        $link = array();
        for ($i = 0; $i < sizeof($menus); $i++) {
            if ($menus[$i] == "app_editor") {
                $link[] = ['name' => "app_editor", 'desc' => "Tartalomszerkesztők aloldala"];
            } elseif ($menus[$i] == "app_user") {
                $link[] = ['name' => "app_user", 'desc' => "Bejelentkezettfelhasználók aloldala"];
            } elseif ($menus[$i] == "app_admin") {
                $link[] = ['name' => "app_admin", 'desc' => "Adminisztrátorok aloldala"];
            }

        }
        return $this->render('main/main.html.twig', ['lastLogin' => $user->getLastLogin()->format("Y-m-d H:i:s"), "menus" => $link]);
    }
}