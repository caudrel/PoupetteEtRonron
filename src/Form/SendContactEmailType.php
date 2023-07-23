<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SendContactEmailType extends AbstractType
{
    public function buildForm(
        FormBuilderInterface $builder,
        array $options)
    {

        $builder
            ->add('firstname', TextType::class, [
                'label' => 'firstname',
            ])
            ->add('lastname', TextType::class, [
                'label' => 'lastname',
            ])
            ->add('email', EmailType::class, [
                'label' => 'email',
            ])
            ->add('subject', ChoiceType::class, [
                'choices' => $options['subjects'],
                'label' => 'subject',
            ])
            ->add('message', TextareaType::class, [
                'label' => 'message',
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