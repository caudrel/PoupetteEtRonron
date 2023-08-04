<?php

namespace App\Form;

use App\Entity\User;
use Doctrine\DBAL\Types\BooleanType;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProfileType extends AbstractType
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
            ])
            ->add('roles', CollectionType::class)
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'ROLE_ADMIN' => 'ROLE_ADMIN',
                    'ROLE_USER' => 'ROLE_USER',
                    'ROLE_SUPER_ADMIN' => 'ROLE_SUPER_ADMIN',
                ],
                'multiple' => true,
                'expanded' => true, // Affiche les choix sous forme de cases à cocher
            ])
            ->add('isActiv', CheckboxType::class, [
                'label' => 'Utilisateur actif ?',
                'required' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
