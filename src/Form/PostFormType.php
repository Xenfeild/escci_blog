<?php

namespace App\Form;

use App\Entity\Post;
use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType as TypeTextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TypeTextType::class, [
                'attr'  => [
                    'class' => 'form',
                ]

            ])
            ->add('content', TextareaType::class, [
                'attr'  => [
                    'class' => 'form',
                ]
            ])
            ->add('url_img', TypeTextType::class, [
                'attr'  => [
                    'class' => 'form',
                ]
            ])
            // ->add('created_at')
            // ->add('updated_at')
            ->add('author', TypeTextType::class, [
                'attr'  => [
                    'class' => 'form',
                ]
            ])
            ->add('category', TypeTextType::class, [
                'attr'  => [
                    'class' => 'form',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
