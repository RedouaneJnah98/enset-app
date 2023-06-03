<?php

namespace App\Controller;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use SymfonyCasts\Bundle\VerifyEmail\VerifyEmailHelperInterface;

class SecurityController extends AbstractController
{
    private $verifyEmailHelper;
    private $mailer;
    private Security $security;

    public function __construct(VerifyEmailHelperInterface $verifyEmailHelper, MailerInterface $mailer, Security $security)
    {
        $this->verifyEmailHelper = $verifyEmailHelper;
        $this->mailer = $mailer;
        $this->security = $security;
    }

    #[Route('/login', name: 'app_login')]
    public function login(): Response
    {
        return $this->render('security/login.html.twig');
    }

    #[Route('/email_confirmation', name: 'app_email_confirmation')]
    public function confirmationEmail(): Response
    {
        return $this->render('two_factor.html.twig');
    }

    #[Route('/verify', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request)
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();

        // Do not get the User's Id or Email Address from the Request object
        try {
            $this->verifyEmailHelper->validateEmailConfirmation($request->getUri(), $user->getId(), $user->getEmail());
        } catch (VerifyEmailExceptionInterface $e) {
            $this->addFlash('verify_email_error', $e->getReason());

            return $this->redirectToRoute('app_login');
        }

        $this->addFlash('success', 'Your e-mail address has been verified.');

        return $this->redirectToRoute('app_dashboard');
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout()
    {
        throw new \Exception("Logout action doesn't work!");
    }
}
