<?php
/**
 * Created by PhpStorm.
 * User: florian.flahaut
 * Date: 20/11/17
 * Time: 13:19
 */

namespace App\Form;


use App\Entity\Item;
use Doctrine\DBAL\Types\FloatType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;


class ItemType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => Item::class,]);

    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', TextType::class)
            ->add('typeItem', ChoiceType::class, array(
                'choices' => array(
                    'Bouclier' => 'shield',
                    'Armes' => 'weapon',
                    'Santé' => 'health',
                )))
            ->add('save', SubmitType::class, array('label' => 'Créer'))
            ->getForm();
    }
}