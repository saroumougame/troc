<?php

/**
 * Created by PhpStorm.
 * User: skumb
 * Date: 23/01/2019
 * Time: 16:20
 */



namespace App\Service;



use App\Entity\Echange;
use App\Entity\User;

class MailService
{

    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {

        $this->mailer = $mailer;

    }


    public function GetMessageEchange($statue,$echange){

        if ($statue === false){

            $msg = 'Bonjour, '.$echange->getUserVendeur()->getUsername().' a refuser votre proposition d\'echanger
            '. $echange->getObjectVendeur()->getNom().'.';

        }else{

            $msg = 'Bonjour, '.$echange->getUserVendeur()->getUsername().' a accepter votre proposition d\'echanger
            '. $echange->getObjectVendeur()->getNom().'.';
        }



        return $msg;



    }



    public function notificationMail($statue,$echange){


        $msg = $this->GetMessageEchange($statue, $echange);




        $mail = $echange->getUserAcheteur()->getEmail();

        $mailTo = $echange->getUserVendeur()->getEmail();



        $message = (new \Swift_Message('Troc notification'))
            ->setFrom('troc@troc.com')
            ->setTo($mail)
            ->addPart(
                $msg.$mailTo
            );



        return $this->mailer->send($message) > 0;



    }


}