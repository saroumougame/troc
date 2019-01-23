<?php

/**
 * Created by PhpStorm.
 * User: skumb
 * Date: 23/01/2019
 * Time: 16:20
 */



namespace App\Service;



class MailService
{

    private $mailer;

    public function __construct(\Swift_Mailer $mailer)
    {

        $this->mailer = $mailer;

    }


    public function GetMessageEchange($statue,$echange){

        if ($statue === false){

            $msg = 'Bonjour, '.$echange->getUserVendeur()->getUsername().' a refuser votre proposition d\'echanger le objet';

        }else{


            $msg = 'Bonjour, '.$echange->getUserVendeur()->getUsername().' a accepter votre proposition d\'echanger le objet';

        }



        return $msg;



    }



    public function notificationMail($statue,$echange){


        $msg = $this->GetMessageEchange($statue, $echange);

        $message = (new \Swift_Message('Troc notification'))
            ->setFrom('troc@troc.com')
            ->setTo('sridar.aroumougame@gmail.com')
            ->addPart(
                $msg
            );



        return $this->mailer->send($message) > 0;



    }


}