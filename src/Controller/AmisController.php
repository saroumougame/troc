<?php
/**
 * Created by PhpStorm.
 * User: sridar
 * Date: 01/10/2018
 * Time: 16:07
 */


namespace App\Controller;

use App\Entity\Amies;
use App\Entity\Objet;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Echange;


/**
 * @Route("/amis")
 */
class AmisController extends AbstractController
{
    /**
     * @Route("/show", name="amis_show")
     */
    public function home()
    {

      $user = $this->getUser();

      $amis  = $this->getDoctrine()->getRepository(Amis::class)->findAll();


        dump($amis);
//        return $this->render('home/index.html.twig',
//            array('allObjet' => $allObjet)
//        );
    }




}


