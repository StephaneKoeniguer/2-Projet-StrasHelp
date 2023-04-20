<?php

namespace App\Controller;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailController
{
    private PHPmailer $mail;

    public function __construct()
    {
        $this->mail = new PHPmailer();
    }

    private function validateConnexion(): bool
    {
        $this->mail->IsSMTP();
        $this->mail->Host = '';                    //(A compléter !!) //Adresse IP ou DNS du serveur SMTP
        $this->mail->Port = 465;                  //(A compléter) (int) !!) //Port TCP du serveur SMTP
        $this->mail->SMTPAuth = true;                                  //Utiliser l'identification
        $this->mail->CharSet = 'UTF-8';
        $this->mail->SMTPSecure = 'ssl';                        //Protocole de sécurisation des échanges avec le SMTP
        $this->mail->Username   =  '';       //(A compléter !!) //Adresse email à utiliser
        $this->mail->Password   =  '';       //(A compléter !!) //Mot de passe de l'adresse email à utiliser

        if ($this->mail->smtpConnect()) {                             // Test la connecxion
            return true;
        } else {
            return false;
        }
    }


    public function mail(): void
    {
        $errors = [];
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && $this->validateConnexion()) {
            if (!isset($_GET['name']) || empty($_GET['name'])) {
                $errors[] = "Veuillez saisir un nom";
            }
            if (!isset($_GET['email']) || empty($_GET['email']) || !filter_var($_GET['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Veuillez saisir un email valide";
            }
            if (!isset($_GET['content']) || empty($_GET['content'])) {
                $errors[] = "Veuillez saisir votre message";
            }

            if (empty($errors)) {
                $this->mail->From = trim($_GET['email']);
                $this->mail->AddAddress('yavuz.kutuk@wildcodeschool.com');
                $this->mail->Subject = ("Formulaire de contact Stras'Help");      //Le sujet du mail
                $this->mail->WordWrap = 50;                                     //Retour a la ligne automatique
                $this->mail->AltBody = $_GET['content'];                        //Texte brut
                $this->mail->IsHTML(false);                                     //Il faut utiliser le texte brut
                $this->mail->MsgHTML($_GET['content']);                         //Forcer le contenu

                if (!$this->mail->send()) {
                    echo $this->mail->ErrorInfo;
                } else {
                    echo 'Message bien envoyé';
                }
            }
        }
        header('location: /');
    }
}
