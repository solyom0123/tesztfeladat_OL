<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class MainController
{
    public function main(): Response
    {

        return new Response(
            '<html><body>Welcome!</body></html>'
        );
    }
}