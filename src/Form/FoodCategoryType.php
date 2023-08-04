<?php

namespace App\Form;

use App\Entity\FoodCategory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class FoodCategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('foodCategoryName', TextType::class, [
                'label' => 'foodCategoryName',
                'required' => true,
                'constraints' => [
                    new Length([
                        'min' => 3,
                        'max' => 35,
                        'minMessage' => 'La catégorie de plat doit comporter au moins {{ limit }} caractères.',
                        'maxMessage' => 'La catégorie de plat ne peut pas dépasser {{ limit }} caractères.',
                    ]),
                    new NotBlank([
                        'message' => 'La catégorie de plat est obligatoire',
                    ]),
                ],
            ])
            ->add('isActiv', CheckboxType::class, [
                'label' => 'Catégorie de plat active ?',
                'required' => false,
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FoodCategory::class,
        ]);
    }
}
