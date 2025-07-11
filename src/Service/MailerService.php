<?php
namespace App\Service;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailerService
{
    public function __construct(private readonly MailerInterface $mailer) {}

    public function send(string $to, string $subject, string $body): void
    {
        $email = (new Email())
            ->from('noreply@votre-domaine.com')
            ->to($to)
            ->subject($subject)
            ->html($body);

        $this->mailer->send($email);
    }
}
