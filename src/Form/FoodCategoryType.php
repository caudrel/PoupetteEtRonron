<?php

namespace App\Form;

use App\Entity\FoodCategory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FoodCategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('foodCategoryName', TextType::class, [
                'label' => 'foodCategoryName',
            ])
            ->add('isActiv', CheckboxType::class, [
                'label' => 'Catégorie de plat active ?',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FoodCategory::class,
        ]);
    }
}
