<?php


namespace AuthManao\Modules\Auth;

use AuthManao\Kernel\HttpException\HTTPNotFoundException;
use AuthManao\Kernel\Router\Request;
use AuthManao\Modules\User\UserModel;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class AuthController
{

    public function getAuthPage()
    {
        $loader = new FilesystemLoader(['src/Views', 'src/Views/Auth'], $_SERVER['DOCUMENT_ROOT']);
        $twig = new Environment($loader);

        return $twig->render('auth.twig');
    }

    public function auth(Request $request)
    {
        http_response_code(204);
        $userModel = new UserModel();
        $user = $userModel->find($request->body->login, $request->body->password);

        if (!$user) {
            throw new HTTPNotFoundException(json_encode(['error' => 'Incorrect data']));
        }

        session_start();
        $_SESSION['login'] = $user['login'];
        setcookie('login', $user['login'], time() + 3600, '/');
    }

}