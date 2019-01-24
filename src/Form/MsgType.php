<?php


namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;




class MsgType extends AbstractType {

    /**
     * Chaque champ devant figurer dans l'interface web est défini ici.
     */
    public function buildForm(FormBuilderInterface $builder, array $options) {

        $builder
            ->add('description', TextareaType::class,array('label' => false))
            ->add('submit', SubmitType::class, array('label' => "Envoyer le message")
            );
    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'App\Entity\Msg',
        ));
    }





}