<?php

namespace App\Form;

use App\Entity\BeverageCategory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class BeverageCategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('beverageCategoryName', TextType::class, [
                'label' => 'beverageCategoryName',
                'required' => true,
                'constraints' => [
                    new Length([
                        'min' => 3,
                        'max' => 35,
                        'minMessage' => 'La catégorie de boisson doit comporter au moins {{ limit }} caractères.',
                        'maxMessage' => 'La catégorie de boisson ne peut pas dépasser {{ limit }} caractères.',
                    ]),
                    new NotBlank([
                        'message' => 'La catégorie de boisson est obligatoire',
                    ]),
                ],
            ])
            ->add('isActiv', CheckboxType::class, [
                'label' => 'Catégorie de boisson active ?',
                'required' => false,
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BeverageCategory::class,
        ]);
    }
}
