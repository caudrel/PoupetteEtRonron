<?php

namespace App\Form;

use App\Entity\ContactForm;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ContactSubjectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('subject', TextType::class, [
                'label' => 'Sujet de contact',
                'required' => true,
                'constraints' => [
                    new Length([
                        'min' => 5,
                        'max' => 60,
                        'minMessage' => 'Le sujet de contact doit comporter au moins {{ limit }} caractères.',
                        'maxMessage' => 'Le sujet de contact ne peut pas dépasser {{ limit }} caractères.',
                    ]),
                    new NotBlank([
                        'message' => 'Le sujet de contact est obligatoire',
                    ]),
                ],
            ])
            ->add('isValid', CheckboxType::class, [
                'label' => 'Sujet visible ?',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ContactForm::class,
        ]);
    }
}
