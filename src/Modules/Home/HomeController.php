<?php

namespace AuthManao\Modules\Home;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class HomeController
{
    public function getHomePage($request)
    {

        $loader = new FilesystemLoader(['src/Views', 'src/Views/Home'], $_SERVER['DOCUMENT_ROOT']);
        $twig = new Environment($loader);

        return $twig->render('home.twig', ['name' => $request->body['name'] ?? null]);
    }

}

