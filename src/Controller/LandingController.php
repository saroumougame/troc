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



class LandingController extends AbstractController
{
    /**
     * @Route("/", name="landing")
     */
    public function indexAction()
    {


        return $this->render('Landing/index.html.twig', array('msg' => 'lol'));
    }


}


