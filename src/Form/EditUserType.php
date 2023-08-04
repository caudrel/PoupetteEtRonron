<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class EditUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'email',
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => "L'adresse e-mail de l'utilisateur ne peut pas être vide.",
                    ]),
                    new Length([
                        'min' => 7,
                        'minMessage' => "L'email doit comporter au moins {{ limit }} caractères.",
                    ]),
                ],
            ])
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
                        'message' => 'Le prénom est obligatoire.',
                    ]),
                ],
            ])
            ->add('lastname', TextType::class, [
                'label' => 'lastname',
                'required' => true,
                'constraints' => [
                    new Length([
                        'min' => 2,
                        'max' => 35,
                        'minMessage' => 'Le nom doit comporter au moins {{ limit }} caractères.',
                        'maxMessage' => 'Le nom ne peut pas dépasser {{ limit }} caractères.',
                    ]),
                    new NotBlank([
                        'message' => 'Le nom est obligatoire',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
