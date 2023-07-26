<?php

namespace App\Form;

use App\Entity\Food;
use App\Entity\FoodCategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FoodType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('foodCategory', EntityType::class, [
                'class' => FoodCategory::class,
                'choice_label' => 'foodCategoryName',
                'multiple' => false,
                'expanded' => false,
            ])
            ->add('foodName', TextType::class)
            ->add('description', TextType::class)
            ->add('isVegetarian', CheckboxType::class, [
                'label' => 'Plat végétarien ?',
                'required' => false,
            ])
            ->add('isActiv', CheckboxType::class, [
                'label' => 'Plat disponible ?',
                'required' => false,
            ])
            ->add('price', NumberType::class, [
                'label' => 'Prix du plat',
                'required' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Food::class,
        ]);
    }
}
