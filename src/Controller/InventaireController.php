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
 * @Route("/inventaire")
 */
class InventaireController extends AbstractController
{

    /**
     * @Route("/object/add", name="add_object")
     */
    public function addObjetAction(Request $request)
    {

        $objet = new Objet();
        $form = $this->createForm(ObjetType::class, $objet, array(
            'action' => $this->generateUrl('add_object'),
            'method' => 'POST',

        ));

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $formData = $form->getData();
            /* PHOTO */
            $file = $formData->getPhoto();
            $someNewFilename = 'p_' . $formData->getId() . '_' . $file->getClientOriginalName();
            $directory = $this->getParameter('path_photo_objet');
            $file->move($directory, $someNewFilename);
            $formData->setNamePhoto($someNewFilename);
            /* END PHOTO */
            $entityManager = $this->getDoctrine()->getManager();
            $formData->setUser($user);
            $entityManager->persist($formData);
            $entityManager->flush();

            return $this->redirectToRoute('show_object');

        }

        return $this->render('inventaire/addObject.html.twig', array(
            'form' => $form->createView()

        ));

    }

    /**
     * @Route("/object/show", name="show_object")
     */
    public function showAction()
    {

        $user = $this->getUser();
        $userObjet = $this->getDoctrine()->getRepository(Objet::class)->findBy(array('user' => $user->getId(), 'delete' => null));

        return $this->render('inventaire/showObject.html.twig', array(
            'userObjet' => $userObjet,

        ));

    }


    /**
     * @Route("/object/detail/{objet}", name="detail_object")
     */
    public function detailAction(Objet $objet)
    {
        return $this->render('inventaire/detailObject.html.twig', array(
            'objet' => $objet,

        ));
    }

    /**
     * @Route("/object/edit/{objet}", name="edit_object")
     */
    public function edit(Request $request, Objet $objet)
    {
        $form = $this->createForm(ObjetType::class, $objet, array(
            'action' => $this->generateUrl('edit_object', array('objet' => $objet->getId())),
            'method' => 'POST',

        ));


        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($formData);
            $entityManager->flush();
        }

        return $this->render('inventaire/editObject.html.twig', array(
            'form' => $form->createView()

        ));

    }


    /**
     * @Route("/object/delete/{objet}", name="delete_object")
     */
    public function deleteAction(Objet $objet)
    {

        $entityManager = $this->getDoctrine()->getManager();
        $objet->removeAt();
        $entityManager->flush($objet);
        return $this->redirectToRoute('show_object');
    }


}