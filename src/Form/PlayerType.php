<?php

namespace App\Form;

use App\Entity\Player;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;


class PlayerType extends AbstractType
{

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => Player::class,]);

    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name')
            ->add('roles')
            ->addEventListener( FormEvents::PRE_SET_DATA,
                array($this, 'onPreSetData') )
            ->getForm();
    }

    public function onPreSetData(FormEvent $event){
        $player = $event->getData();
        $form = $event->getForm();

        if ($player->getId() !== null){
            $form->remove('name');
            $form->add('money',
                null,
                [
                    'mapped' => false
                ]
                );
            $form->add('experience',
                null,
                [
                    'mapped' => false,
                ]
                );
        }

        $form->add('save', SubmitType::class, array('label' => 'Créer'));
    }



}