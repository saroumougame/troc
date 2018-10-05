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

use App\Form\TrocDemandeForm;
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
 * @Route("/objet")
 */
class ObjetController extends AbstractController
{

    /**
     * @Route("/detail/{objet}", name="objet_detail")
     */
    public function indexAction(Request $request, Objet $objet){


        $formDemandeTroc = $this->getForm($objet->getId());
        $formDemandeTroc->handleRequest($request);
        if ($formDemandeTroc->isSubmitted() && $formDemandeTroc->isValid()){
            $data = $formDemandeTroc->getData();
             $ObjetAcheteur = $data->getId();
            $echange = new Echange();
            $echange->setUserAcheteur($ObjetAcheteur->getUser());
            $echange->setObjectAchteur($ObjetAcheteur);
            $echange->setUserVendeur($objet->getUser());
            $echange->setObjectVendeur($objet);
            $echange->setStatue(1);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($echange);
            $entityManager->flush();

            return $this->redirect($this->generateUrl('home'));
        }

        return $this->render('objet/detailObjet.html.twig', array(
            'objet' => $objet,
            'formDemandeTroc'=> $formDemandeTroc->createView()
        ));


}


    public function getForm($objetVendeur)
    {

        $objetAcheteur = new Objet();

        $form = $this->createFormBuilder($objetAcheteur, array(
            'action' => $this->generateUrl('objet_detail',array('objet' => $objetVendeur)),
            'method' => 'POST',

        ));
        $form->add('id', EntityType::class, array(
            'class' => Objet::class,
            'query_builder' => function (EntityRepository $repository) {
                return $repository->createQueryBuilder('o')
                    ->select('o')
                    ->where('o.user = '.$this->getUser()->getId())
                    ->orderBy('o.nom', 'ASC');
            },
            'attr' => array('class' => 'form-control show-tick', 'data-live-search' => 'true'),
        ))

            ->add('submit', SubmitType::class,
                array(
                    'label' => 'Valider',
                    'attr' => array(
                        'class' => 'btn btn-primary btn-round waves-effect p-3 mt-3'))

            );

        return $form->getForm();
    }









}