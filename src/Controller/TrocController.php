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
     * @Route("/demande/{objetVendeur}", name="troc_demande")
     */
    public function demandeTrocAction(Objet $objetVendeur){

        dump($objetVendeur);

        $formDemandeTroc = $objetController->getForm($objetVendeur->getId());


    }


}
