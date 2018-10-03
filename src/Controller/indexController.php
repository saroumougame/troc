<?php
/**
 * Created by PhpStorm.
 * User: sridar
 * Date: 01/10/2018
 * Time: 16:07
 */


namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class indexController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function home()
    {







        return $this->render('home/index.html.twig', array('id' => 'lol'));
    }


}


