<?php
/**
 * Created by PhpStorm.
 * User: florian.flahaut
 * Date: 20/11/17
 * Time: 14:34
 */

namespace App\Form;


use App\Entity\Inventory;
use App\Entity\Material;
use App\Entity\Personne;
use Doctrine\DBAL\Types\FloatType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;

class InventoryType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => Inventory::class,]);

    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('material')
            ->add('personne')
            ->add('number_of_item', IntegerType::class )
            ->add('save', SubmitType::class, array('label' => 'Créer'))
            ->getForm();
    }
}