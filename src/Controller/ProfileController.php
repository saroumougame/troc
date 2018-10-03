<?php
/**
 * Created by PhpStorm.
 * User: sridar
 * Date: 03/10/2018
 * Time: 10:54
 */

namespace App\Controller;


use App\Form\ObjetType;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Objet;
use Symfony\Component\HttpFoundation\Request;


/**
 * @Route("/profile")
 */
class ProfileController extends AbstractController
{



    /**
     * @Route("/", name="profile")
     */
    public function indexAction(){



}





    /**
     * @Route("/object/add", name="add_object")
     */
    public function addObjetAction(Request $request){


        $objet = new Objet();

        $form = $this->createForm(ObjetType::class, $objet,array(
            'action' => $this->generateUrl('add_object'),
            'method' => 'POST',

        ));


        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $user = $this->getUser();
            $formData = $form->getData();
             $entityManager = $this->getDoctrine()->getManager();
             $formData->setUser($user);
             $entityManager->persist($formData);
             $entityManager->flush();
        }


        return $this->render('profile/addObject.html.twig', array(
            'form' => $form->createView()

        ));

    }

    /**
     * @Route("/object/show", name="show_object")
     */
    public function showAction(){


       $userObjet = $this->getDoctrine()->getRepository(Objet::class)->findBy(array('user'=>1));

        dump($userObjet);


        return $this->render('profile/showObject.html.twig', array(
            'userObjet' => $userObjet,

        ));

    }


    /**
     * @Route("/object/detail/{objet}", name="detail_object")
     */
    public function detailAction(Objet $objet){


        return $this->render('profile/detailObject.html.twig', array(
            'objet' => $objet,

        ));

    }

    /**
     * @Route("/object/edit/{objet}", name="edit_object")
     */
    public function edit(Request $request, Objet $objet){

        $form = $this->createForm(ObjetType::class, $objet,array(
            'action' => $this->generateUrl('edit_object',array('objet' => $objet->getId())),
            'method' => 'POST',

        ));


        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $formData = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($formData);
            $entityManager->flush();
        }


        return $this->render('profile/editObject.html.twig', array(
            'form' => $form->createView()

        ));

    }


    /**
     * @Route("/object/delete/{objet}", name="delete_object")
     */
    public function deleteAction(Objet $objet){



        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($objet);
        $entityManager->flush();



    }






}