<?php

namespace App\Form;

use App\Entity\Beverage;
use App\Entity\BeverageCategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BeverageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('beverageCategory', EntityType::class, [
                'class' => BeverageCategory::class,
                'choice_label' => 'beverageCategoryName',
                'multiple' => false,
                'expanded' => false,
                'required' => true,
            ])
            ->add('beverageName', TextType::class, [
                'required' => false,
            ])
            ->add('description', TextType::class, [
                'label' => 'Description de la boisson',
                'required' => true,
            ])
            ->add('isActiv', CheckboxType::class, [
                'label' => 'Boisson disponible ?',
                'required' => false,
            ])
            ->add('price', NumberType::class, [
                'label' => 'Prix de la boisson',
                'required' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Beverage::class,
        ]);
    }
}
