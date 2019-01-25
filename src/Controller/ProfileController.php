<?php

namespace App\Controller;

use App\Entity\Entreprise;
use App\Entity\UserGroupe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Groupe;
use App\Entity\User;
use App\Entity\Event;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\UserRepository;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use App\Entity\Echange;

use App\Entity\Objet;

/**
 * @Route("/profile")
 */
class ProfileController extends Controller
{


    /**
     * @Route("/show", name="profile_show")
     */
    public function showAction()
    {


        $User = $this->getUser();
        $formUser = $this->getForm($User);
        $entityManager = $this->getDoctrine()->getManager();
//        $eventUser = $entityManager->getRepository(Event::class)->findBy(array('useradd' => $this->getUser()->getId()), null, 5);
//        $nbUser = $this->statUser($User, $entityManager);

        $demandeByVendeur = $this->getDoctrine()->getRepository(Echange::class)->findBy(array('userVendeur'=> $User, 'statue' => 2));



        $demandeByUser = $this->getDoctrine()->getRepository(Echange::class)->findBy(array('userAcheteur'=> $User, 'statue' => 2));



        return $this->render('profile/index.html.twig', array(
            'histTrocPropo' => $demandeByVendeur,
            'histTrocDemande' => $demandeByUser,
//   'User' => $User,
//            'eventUser' => $eventUser,
            'formUser' => $formUser->createView(),
//            'nbEvent' => $nbUser,
        ));
    }


    /**
     * @Route("/update", name="profile_update")
     */
    public function updateAction(Request $request)
    {
        $User = $this->getUser();
        $formUser = $this->getForm($User);
        $formUser->handleRequest($request);
        if ($formUser->isSubmitted()) {

            $UpdateUser = $formUser->getData();
            $User->setUsername($UpdateUser->getUsername());
            $User->setEmail($UpdateUser->getEmail());

            /* ---------- */

            $file = $UpdateUser->getPhoto();
            $someNewFilename = 'p_' . $User->getId() . '.' . $file->getExtension();
            $directory = $this->getParameter('path_photo_profil');
            $file->move($directory, $someNewFilename);
            $User->setNamePhoto($someNewFilename);


            /* ---------- */
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($User);
            $entityManager->flush();
            return $this->redirect($this->generateUrl('profile_show'));



        }

        return $this->render('Profile/index.html.twig', array(
//   'User' => $User,
//            'eventUser' => $eventUser,
            'formUser' => $formUser->createView(),
//            'nbEvent' => $nbUser,
        ));


    }




    public function getForm($User)
    {
        $form = $this->createFormBuilder($User, array(
            'action' => $this->generateUrl('profile_update'),
            'method' => 'POST',
        ));
        $form->add("email", TextType::class,
            array(
                'label' => 'Modifier mon adresse e-mail',
                'attr' => array(
                    'class' => 'form-control'
                )
            )
        )
            ->add('photo', FileType::class,
                array(
                    'label' => 'Modifier ma photo de profil',
                    'attr' => array(
                        'class' => 'form-control input-b2'
                    )
                )
            )
            ->add('submit', SubmitType::class,
                array(
                    'label' => 'Valider',
                    'attr' => array(
                        'class' => 'btn btn-primary btn-round waves-effect p-3 mt-3'))
            );
        return $form->getForm();
    }


    /**
     * @Route("/amis/{user}", name="profile_amis_detail")
    */
    public function showAmisAction(User $user)
    {

        $userObjet = $this->getDoctrine()->getRepository(Objet::class)->findBy(array('user'=>  $user->getId()));

        $userObjet = $this->getDoctrine()->getRepository(Objet::class)->findBy(array('user'=>  $user->getId()));

        return $this->render('profile/detail.html.twig', array(
            'user' => $user,
            'allObjet' => $userObjet
        ));
    }




//    private function statUser($User, $entityManager)
//    {
//        $eventUsercount = $entityManager->getRepository(Event::class)->findBy(array('useradd' => $this->getUser()->getId()));
//        $nbUser = count($eventUsercount);
//        return $nbUser;
//    }
}