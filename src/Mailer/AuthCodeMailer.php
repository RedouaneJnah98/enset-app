<?php

namespace App\Mailer;

use Scheb\TwoFactorBundle\Mailer\AuthCodeMailerInterface;
use Scheb\TwoFactorBundle\Model\Email\TwoFactorInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class AuthCodeMailer implements AuthCodeMailerInterface
{

    private MailerInterface $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function sendAuthCode(TwoFactorInterface $user): void
    {
        $authCode = $user->getEmailAuthCode();

        $email = new TemplatedEmail();
        $email->from('send@example.com');
        $email->to($user->getEmail());
//        $email->htmlTemplate('security/two_factor.html.twig');
//        $email->context(['signedUrl' => $signatureComponents->getSignedUrl()]);

        $this->mailer->send($email);
    }
}