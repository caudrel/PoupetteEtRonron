<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class SendContactEmailType extends AbstractType
{
    public function buildForm(
        FormBuilderInterface $builder,
        array $options)
    {

        $builder
            ->add('firstname', TextType::class, [
                'label' => 'firstname',
                'required' => true,
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'max' => 35,
                        'minMessage' => 'Le prénom doit comporter au moins {{ limit }} caractères.',
                        'maxMessage' => 'Le prénom ne peut pas dépasser {{ limit }} caractères.',
                    ]),
                    new NotBlank([
                        'message' => 'Le prénom doit être renseigné pour vous répondre au mieux.',
                    ]),
                ],
            ])
            ->add('lastname', TextType::class, [
                'label' => 'lastname',
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'max' => 35,
                        'minMessage' => 'Le nom doit comporter au moins {{ limit }} caractères.',
                        'maxMessage' => 'Le nom ne peut pas dépasser {{ limit }} caractères.',
                    ]),
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => 'email',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'L\'adresse e-mail ne peut pas être vide.',
                    ]),
                    new Length([
                        'min' => 7,
                        'minMessage' => "L'email doit comporter au moins {{ limit }} caractères.",
                    ]),
                ],
            ])
            ->add('subject', ChoiceType::class, [
                'choices' => $options['subjects'],
                'label' => 'subject',
                'required' => true,
            ])
            ->add('message', TextareaType::class, [
                'label' => 'message',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Afin de vous répondre au mieux, merci de préciser votre demande.',
                    ]),
                    new Length([
                        'min' => 50,
                        'minMessage' => "Le message doit comporter au moins {{ limit }} caractères.",
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'subjects' => [],// Configurez ici les options du formulaire si nécessaire...
        ]);
    }

}