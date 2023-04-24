<?php

namespace App\Controller;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailController extends AbstractController
{
    private PHPmailer $mail;

    private function validateConnexion(): bool
    {
        $this->mail->IsSMTP();
        $this->mail->Host = 'smtp.free.fr';                    //Adresse IP ou DNS du serveur SMTP
        $this->mail->Port = 465;                               //Port TCP du serveur SMTP
        $this->mail->SMTPAuth = true;                          //Utiliser l'identification
        $this->mail->CharSet = 'UTF-8';
        $this->mail->SMTPSecure = 'ssl';                        //Protocole de sécurisation des échanges avec le SMTP
        $this->mail->Username   =  'skoeniguer@free.fr';        //Adresse email à utiliser
        $this->mail->Password   =  'stephane';                  //Mot de passe de l'adresse email à utiliser

        if ($this->mail->smtpConnect()) {                       // Test la connection
            return true;
        } else {
            return false;
        }
    }

    public function mail(): string
    {
        $errors = [];
        $data = array_map('trim', $_GET);
        $this->mail = new PHPmailer();
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && $this->validateConnexion()) {
            if (!isset($data['name']) || empty($data['name'])) {
                $errors[] = "Veuillez saisir un nom";
            }
            if (!isset($data['email']) || empty($data['email']) || !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Veuillez saisir un email valide";
            }
            if (!isset($data['content']) || empty($data['content'])) {
                $errors[] = "Veuillez saisir votre message";
            }

            if (empty($errors)) {
                $this->mail->From = trim($data['email']);
                $this->mail->AddAddress('skoeniguer@free.fr');                  //email du destinataire
                $this->mail->Subject = ("Formulaire de contact Stras'Help");    //Le sujet du mail
                $this->mail->WordWrap = 50;                                     //Retour a la ligne automatique
                $this->mail->AltBody = $data['content'];                        //Texte brut
                $this->mail->IsHTML(false);                                     //Il faut utiliser le texte brut
                $this->mail->MsgHTML($data['content']);                         //Forcer le contenu

                if (!$this->mail->send()) {
                    $errors[] = $this->mail->ErrorInfo;
                } else {
                    header('location: /contact');
                }
            }
        } else {
            $errors[] = $this->mail->ErrorInfo;
        }
        return $this->twig->render('component/_popUpMessage.html.twig');
    }
}
