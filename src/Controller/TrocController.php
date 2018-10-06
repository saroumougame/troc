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

        $demandeByVendeur = $this->getDoctrine()->getRepository(Echange::class)->findBy(array('userVendeur'=> $user));

        return $this->render('echange/echangeByVendeur.html.twig', array(
            'demandeByVendeur' => $demandeByVendeur

        ));

    }



}
