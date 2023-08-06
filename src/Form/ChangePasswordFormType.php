<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Regex;

class ChangePasswordFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('password', RepeatedType::class, [
                'type' => PasswordType::class,
                'options' => ['attr' => ['class' => 'password-field']],
                'required' => true,
                'first_options' => ['label' => 'Mot de passe'],
                'constraints' => [
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
                'second_options' => ['label' => 'Répéter le mot de passe'],
                'invalid_message' => 'Les mots de passe doivent être identiques.',
                ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
