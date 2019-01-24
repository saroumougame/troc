<?php
/**
 * Created by PhpStorm.
 * User: sridar
 * Date: 04/10/2018
 * Time: 09:58
 */

namespace App\Controller;



use App\Entity\Echange;
use App\Form\ObjetType;

use Symfony\Component\ExpressionLanguage\Tests\Node\Obj;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Objet;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Form\EchangeType;
use Doctrine\ORM\UserRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Service\MailService;



/**
 * @Route("/troc")
 */
class TrocController extends AbstractController
{


    /**
     * @Route("/demande", name="troc_echange")
     */
    public function EchangeByUserAction(){

    $user =  $this->getUser();

    $demandeByUser = $this->getDoctrine()->getRepository(Echange::class)->findBy(array('userAcheteur'=> $user));



        return $this->render('echange/echangeByUser.html.twig', array(
            'demandeByUser' => $demandeByUser

        ));

    }


    /**
     * @Route("/proposition", name="troc_proposition")
     */
    public function EchangeByVendeurAction(){

        $user =  $this->getUser();

        $demandeByVendeur = $this->getDoctrine()->getRepository(Echange::class)->findBy(array('userVendeur'=> $user, 'statue' => 1));



        return $this->render('echange/echangeByVendeur.html.twig', array(
            'demandeByVendeur' => $demandeByVendeur

        ));

    }



    /**
     * @Route("/accepter/{echange}", name="accepter_proposition")
     *
     */
    public function accepterEchangeAction(Echange $echange, MailService $mailService){
        dump($echange);

        $echange->setStatue(2);
        $em = $this->getDoctrine()->getManager();

        $em->merge($echange);
        $em->flush();

        $mailService->notificationMail(true, $echange);

        $mailService->notificationMail(true, $echange);


       return $this->redirectToRoute('troc_proposition');

    }


    /**
     * @Route("/refuser/{echange}", name="refuser_proposition")
     *
     */
    public function refuserEchangeAction(Echange $echange, MailService $mailService){

        $em = $this->getDoctrine()->getManager();

        $em->remove($echange);
        $em->flush();

        $mailService->notificationMail(false, $echange);


        return $this->redirectToRoute('troc_proposition');

    }




}
