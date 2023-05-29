<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use SymfonyCasts\Bundle\VerifyEmail\VerifyEmailHelperInterface;

class SecurityController extends AbstractController
{
//    private $verifyEmailHelper;
//    private $mailer;
//    private Security $security;
//
//    public function __construct(VerifyEmailHelperInterface $verifyEmailHelper, MailerInterface $mailer, Security $security)
//    {
//        $this->verifyEmailHelper = $verifyEmailHelper;
//        $this->mailer = $mailer;
//        $this->security = $security;
//    }

    #[Route('/login', name: 'app_login')]
    public function login(): Response
    {
        return $this->render('security/login.html.twig');
    }

    #[Route('/email_confirmation', name: 'app_email_confirmation')]
    public function confirmationEmail(): Response
    {
        return $this->render('security/confirmation_email.html.twig');
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout()
    {
        throw new \Exception("Logout action doesn't work!");
    }
}
