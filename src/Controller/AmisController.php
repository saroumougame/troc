<?php
/**
 * Created by PhpStorm.
 * User: sridar
 * Date: 01/10/2018
 * Time: 16:07
 */


namespace App\Controller;

use App\Entity\Amis;
use Doctrine\ORM\QueryBuilder;
use App\Entity\Msg;
use App\Entity\User;
use App\Entity\Objet;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Echange;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;




use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use App\Form\EchangeType;
use Doctrine\ORM\UserRepository;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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

      $amis  = $this->getDoctrine()->getRepository(Amis::class)->findBy(array('user'=> $user->getId()));


        return $this->render('amis/showAmis.html.twig',
            array('amis' => $amis)
        );



    }

    /**
     * @Route("/sendmessage/{user}", name="send_message")
     */
    public function sendMessage(Request $request, User $user)
    {

        $me = $this->getUser();

        $formDemandeMsg = $this->getMessageForm($user->getId());
        $formDemandeMsg->handleRequest($request);

        if ($formDemandeMsg->isSubmitted() && $formDemandeMsg->isValid()) {

            $data = $formDemandeMsg->getData();
            $message = new Msg();
            $message->setidSender($me);
            $message->setidReceiver($user);
            $message->setMessage($data->getMessage());
            $message->setupdatedAt(new \DateTime());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($message);
            $entityManager->flush();

            return $this->redirect($this->generateUrl('home'));
        }

        $me = $this->getUser();

        $repository = $em->getRepository(Msg::class);
        $messages = $repository->findAllMsg($user->getId(), $me->getId()); 

        return $this->render('amis/messageAmis.html.twig', array(
            'messages' => $messages,
            'me' => $this->getUser()->getId(),
            'him' => $user->getId()
        ));

    }

    /**
     * @Route("/getmessage/{user}", name="get_messages")
     */
    public function getMessages(User $user, EntityManagerInterface $em)
    {
        $me = $this->getUser();

        $repository = $em->getRepository(Msg::class);
        $messages = $repository->findAllMsg($user->getId(), $me->getId());

        $formMessage = $this->getMessageForm($user->getId());

        return $this->render('amis/messageAmis.html.twig', array(
            'messages' => $messages,
            'me' => $this->getUser()->getId(),
            'him' => $user->getId(),
            'formDemandeTroc' => $formMessage->createView()
        ));

    }

    public function getMessageForm($user)
    {
        $message = new Msg();

        $form = $this->createFormBuilder($message, array(
            'action' => $this->generateUrl('send_message', array('user' => $user)),
            'method' => 'POST',

        ));
        $form->add('message', TextareaType::class, array(
            'label' => 'Écrire un message',
            'attr' => array('class' => 'form-control w-100'),
        ))
        ->add('submit', SubmitType::class,
            array(
                'label' => 'Envoyer le message',
                'attr' => array(
                    'class' => 'btn btn-primary btn-round waves-effect p-3 mt-3'))

        );

        return $form->getForm();
    }





    public function searchAmis()
    {



        $amis = new User();
        $form = $this->getFormSearch($amis);


        return $this->render(
            'amis/searchAmis.html.twig',
            array('searchAmis' => $form->createView())
        );


    }


    public function AmisbySearch($searchAmis)
    {


        $entityManager = $this->getDoctrine()->getManager();
        $param = array('username' => $searchAmis);

        $objet = $entityManager->getRepository(User::class)->getUserBySearch($param);

        return $objet;


    }

//______

    public function getFormSearch($objet){



        $form = $this->createFormBuilder($objet, array(
            'action' => $this->generateUrl('amis_search'),
            'method' => 'POST',
        ));
        $form->add("username", TextType::class,
            array(
                'attr' => array(
                    'class' => ''
                )
            )
        )
            ->add('submit', SubmitType::class,
                array(
                    'label' => 'Valider',
                    'attr' => array(
                        'class' => ''))
            );
        return $form->getForm();
    }



    /**
     * @Route("/search/", name="amis_search")
     */
    public function searchAction(Request $request)
    {
        $amis = new User();
        $form = $this->getFormSearch($amis);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $info = $form->getData();
            $newobjet = $this->AmisBySearch($info->getUsername());

            return $this->render('amis/searchShow.html.twig', array(
                'amis' => $newobjet,
            ));
        }
    }


    /**
     * @Route("/add/{user}", name="amis_add")
     */
    public function setAmis(User $user){



        $em = $this->getDoctrine()->getManager();
        $userconnect = $this->getUser();
        $newAmis = new Amis();

        $newAmis->setUser($userconnect);
        $newAmis->setAmis($user);
        $em->persist($newAmis);

        $em->flush();

        return $this->redirectToRoute('amis_show');






    }





}


