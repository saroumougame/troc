<?php
/**
 * Created by PhpStorm.
 * User: sridar
 * Date: 01/10/2018
 * Time: 16:07
 */


namespace App\Controller;

use App\Entity\Objet;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Echange;



class indexController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function home()
    {


        $allObjet = $this->getDoctrine()->getRepository(Objet::class)->findAll();

        return $this->render('home/index.html.twig',
            array('allObjet' => $allObjet)
        );
    }


}


