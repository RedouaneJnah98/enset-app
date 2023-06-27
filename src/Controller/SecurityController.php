<?php

namespace App\Controller;

use Exception;
use http\Client\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username or email entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
//            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }

    /**
     * @throws Exception
     */
    #[Route('/logout', name: 'app_logout')]
    public function logout()
    {
        throw new Exception("Logout action doesn't work!");
    }
}
