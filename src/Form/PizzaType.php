<?php

namespace App\Form;

use App\Entity\Pate;
use App\Entity\Pizza;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class PizzaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Pizza')
            ->add('Ingredient_secret')
            ->add('Type_pate', EntityType::class, [
                'class' => Pate::class,
                'choice_label' => 'label',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pizza::class,
        ]);
    }
}
