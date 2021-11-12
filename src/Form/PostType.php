<?php

namespace App\Form;

use App\Entity\Post;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\NotNull;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Picture',
                TextType::class,
                [
                    'required' => true,
                    'attr' => [
                        'placeholder' => 'Picture',
                        'class' => 'text-xs w-full mb-2 rounded border bg-gray-100 border-gray-300 px-2 py-2 focus:outline-none focus:border-gray-400 active:outline-none',
                        'id' => 'picture'],
                    'constraints' => array(
                        new NotBlank(),
                        new NotNull()
                    )
                ])
            ->add('Likes',
                TextType::class,
                [
                    'required' => true,
                    'attr' => [
                        'placeholder' => 'Likes',
                        'class' => 'text-xs w-full mb-2 rounded border bg-gray-100 border-gray-300 px-2 py-2 focus:outline-none focus:border-gray-400 active:outline-none',
                        'id' => 'likes'],
                    'constraints' => array(
                        new NotBlank(),
                        new NotNull()
                    )
                ])
            ->add('Date',
                DateType::class,
                [
                    'required' => true,
                    'attr' => [
                        'class' => 'text-xs w-full mb-2 rounded border bg-gray-100 border-gray-300 px-2 py-2 focus:outline-none focus:border-gray-400 active:outline-none',
                        'id' => 'description']
                ]
            )
            ->add('description',
                TextType::class,
                [
                    'required' => true,
                    'attr' => [
                        'placeholder' => 'Description',
                        'class' => 'text-xs w-full mb-2 rounded border bg-gray-100 border-gray-300 px-2 py-2 focus:outline-none focus:border-gray-400 active:outline-none',
                        'id' => 'description'],
                    'constraints' => array(
                        new NotBlank(),
                        new NotNull()
                    )
                ])
            ->add('Localisation',
                TextType::class,
                [
                    'required' => true,
                    'attr' => [
                        'placeholder' => 'Localisation',
                        'class' => 'text-xs w-full mb-2 rounded border bg-gray-100 border-gray-300 px-2 py-2 focus:outline-none focus:border-gray-400 active:outline-none',
                        'id' => 'localisation'],
                    'constraints' => array(
                        new NotBlank(),
                        new NotNull()
                    )
                ]);
        $builder->add('author', EntityType::class, [
            // looks for choices from this entity
            'class' => User::class,
            'required' => true,
            'attr' => [
                'class' => 'text-xs w-full mb-2 rounded border bg-gray-100 border-gray-300 px-2 py-2 focus:outline-none focus:border-gray-400 active:outline-none',
            ],

            // uses the User.username property as the visible option string
            'choice_label' => 'nickname',

            // used to render a select box, check boxes or radios
            // 'multiple' => true,
            // 'expanded' => true,
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
