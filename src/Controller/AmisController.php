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




}


