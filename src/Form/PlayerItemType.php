<?php
/**
 * Created by PhpStorm.
 * User: florian.flahaut
 * Date: 20/11/17
 * Time: 14:34
 */

namespace App\Form;


use App\Entity\PlayerItem;
use Doctrine\DBAL\Types\FloatType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;

class PlayerItemType extends AbstractType
{
    private $nbItem;

    /**
     * PlayerItemType constructor.
     */
    public function __construct($nbItem)
    {
        $this->nbItem = intval($nbItem);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => PlayerItem::class,]);

    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $data = [];
        for ($i = 1; $i <= $this->nbItem; $i++) {
            $data[$i] = $i;
        }

        $builder->add('player')
            ->add('item')
            ->add('position', ChoiceType::class, ["choices" => $data])
            ->add('created_at', DateType::class)
            ->add('save', SubmitType::class, array('label' => 'Créer'))
            ->getForm();
    }
}