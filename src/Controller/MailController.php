<?php

namespace App\Controller;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailController extends AbstractController
{
    private PHPmailer $mail;
    private array $errors;

    /**
     * Validate connexion serveur SMTP
     */

    private function validateConnexion(): bool
    {
        $this->mail->IsSMTP();
        $this->mail->Host = 'smtp.gmail.com';
        $this->mail->Port = 465;
        $this->mail->SMTPAuth = true;
        $this->mail->CharSet = 'UTF-8';
        $this->mail->SMTPSecure = 'ssl';
        $this->mail->Username   =  'associationstrashelp@gmail.com';                 //Adresse email à utiliser
        $this->mail->Password   =  '';                          //Mot de passe de l'adresse email à utiliser

        if ($this->mail->smtpConnect()) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Send mail
     */
    public function mail(): string
    {
        $data = array_map('trim', $_GET);
        $this->mail = new PHPmailer();
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && $this->validateConnexion() && $this->isValide($data)) {
                $this->mail->From = $data['email'];
                $this->mail->AddAddress('');                                   //email du destinataire
                $this->mail->Subject = ("Formulaire de contact Stras'Help");
                $this->mail->WordWrap = 50;
                $this->mail->AltBody = $data['content'];
                $this->mail->IsHTML(false);
                $this->mail->MsgHTML($data['content']);

            if (!$this->mail->send()) {
                $this->errors[] = $this->mail->ErrorInfo;
            } else {
                header('location: /contact');
            }
        } else {
            $this->errors[] = $this->mail->ErrorInfo;
        }
        return $this->twig->render('Home/index.html.twig');
    }

    /**
     * Check if data
     */
    private function isValide(array $data): bool
    {
        $this->errors[] = '';
        if (!isset($data['name']) || empty($data['name'])) {
            $this->errors[] = "Veuillez saisir un nom";
        }
        if (!isset($data['email']) || empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = "Veuillez saisir un email valide";
        }
        if (!isset($data['content']) || empty($data['content'])) {
            $this->errors[] = "Veuillez saisir votre message";
        }

        $this->errors = array_filter($this->errors);

        if (!empty($this->errors)) {
            return false;
        } else {
            return true;
        }
    }
}
