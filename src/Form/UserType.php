<?php

namespace App\Form;

use App\Entity\Post;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'Nickname',
                TextType::class,
            [
                'required' => true,
                'attr' => [
                    'placeholder' => 'Username',
                    'class' => 'text-xs w-full mb-2 rounded border bg-gray-100 border-gray-300 px-2 py-2 focus:outline-none focus:border-gray-400 active:outline-none',
                    'id' => 'email'],
                'constraints' => array(
                    new NotBlank(),
                    new NotNull(),
                    new Length(['min' => 3, 'max' => 100]),
                )
                ]
            )
            ->add('Password',
                PasswordType::class,
                [
                    'required' => true,
                    'attr' => [
                        'placeholder' => 'Password',
                        'class' => 'text-xs w-full mb-2 rounded border bg-gray-100 border-gray-300 px-2 py-2 focus:outline-none focus:border-gray-400 active:outline-none',
                        'id' => 'email']
                ]
            )
            ->add('Email',
                EmailType::class,
                [
                    'required' => true,
                    'attr' => [
                        'placeholder' => 'Email',
                        'class' => 'text-xs w-full mb-2 rounded border bg-gray-100 border-gray-300 px-2 py-2 focus:outline-none focus:border-gray-400 active:outline-none',
                        'id' => 'email'],
                    'constraints' => array(
                        new NotBlank(),
                        new NotNull(),
                        new Email()
                    )
                ])
            ->add('Biography',
                TextType::class,
                [
                    'required' => false,
                    'attr' => [
                        'placeholder' => 'Enter biography',
                        'class' => 'text-xs w-full mb-2 rounded border bg-gray-100 border-gray-300 px-2 py-2 focus:outline-none focus:border-gray-400 active:outline-none',
                        'id' => 'email']
                ])
            ->add('ProfilePicture',
                TextType::class,
                [
                    'required' => false,
                    'attr' => [
                        'placeholder' => 'Profile picture',
                        'class' => 'truncate text-xs w-full mb-2 rounded border bg-gray-100 border-gray-300 px-2 py-2 focus:outline-none focus:border-gray-400 active:outline-none',
                        'id' => 'email']
                ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
