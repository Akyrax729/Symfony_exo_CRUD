<?php

namespace App\Form;

use App\Entity\Pizza;
use App\Entity\Pate;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PizzaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Pizza')
            ->add('Ingredient_secret')
            ->add('Type_pate', ChoiceType::class, [
                'choices' => [
                    'Fine' =>       1,
                    'Epaisse' =>    2,
                    'Mixte' =>      3,
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pizza::class,
        ]);
    }
}
