<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'email',
            ])
            ->add('password', PasswordType::class, [
                'label' => 'password',
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un mot de passe',
                    ]),
                    new Regex([
                        'pattern' => '/(?=.*[A-Z])/',
                        'message' => 'Votre mot de passe doit contenir au moins une lettre majuscule']),
                    new Regex([
                        'pattern' => '/(?=.*[a-z])/',
                        'message' => 'Votre mot de passe doit contenir au moins une lettre minuscule']),
                    new Regex([
                        'pattern' => '/(?=.*\d)/',
                        'message' => 'Votre mot de passe doit contenir au moins un chiffre']),
                    new Regex([
                        'pattern' => '/(?=.*[@$!%*?&])/',
                        'message' => 'Votre mot de passe doit contenir au moins un caractère spécial ( @ $ ! % * ? & )']),
                ],
            ])
            ->add('firstname', TextType::class, [
                'label' => 'firstname',
            ])
            ->add('lastname', TextType::class, [
                'label' => 'lastname',
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
