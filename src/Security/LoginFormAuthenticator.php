<?php

namespace App\Security;

use App\Repository\UserRepository;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use SymfonyCasts\Bundle\VerifyEmail\VerifyEmailHelperInterface;

class LoginFormAuthenticator extends AbstractLoginFormAuthenticator
{
    private RouterInterface $router;
    private UserRepository $userRepository;
    private VerifyEmailHelperInterface $verifyEmailHelper;
    private MailerInterface $mailer;
    private Security $security;

    public function __construct(RouterInterface $router, UserRepository $userRepository, VerifyEmailHelperInterface $verifyEmailHelper, MailerInterface $mailer, Security $security)
    {
        $this->router = $router;
        $this->userRepository = $userRepository;
        $this->verifyEmailHelper = $verifyEmailHelper;
        $this->mailer = $mailer;
        $this->security = $security;
    }

    public function authenticate(Request $request): Passport
    {
        $username = $request->get('username');
        $password = $request->get('password');


        return new Passport(
            new UserBadge($username),
            new PasswordCredentials($password),
            [
                new CsrfTokenBadge(
                    'authenticate',
                    $request->request->get('_csrf_token')
                ),
            ]
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        $user = $this->security->getUser();

        $signatureComponents = $this->verifyEmailHelper->generateSignature(
            'app_email_confirmation',
            $user->getId(),
            $user->getEmail()
        );

        $email = new TemplatedEmail();
        $email->from('send@example.com');
        $email->to($user->getEmail());
        $email->htmlTemplate('security/confirmation_email.html.twig');
        $email->context(['signedUrl' => $signatureComponents->getSignedUrl()]);

        $this->mailer->send($email);

        return new RedirectResponse(
            $this->router->generate('app_dashboard')
        );
    }


    public function start(Request $request, AuthenticationException $authException = null): Response
    {
        return new RedirectResponse(
            $this->router->generate('app_login')
        );
    }

    protected function getLoginUrl(Request $request): string
    {
        return $this->router->generate('app_login');
    }
}
