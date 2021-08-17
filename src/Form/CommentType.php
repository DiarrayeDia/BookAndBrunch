<?php

namespace App\Form;

use App\Entity\Book;
use App\Entity\User;
use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CommentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('createdAt', DateTimeType::class, [
                'label'=> 'Date',
            ])

            ->add('written_by', EntityType::class, [
                'class' => User::class,
                'label' => 'Email',
                'mapped' => false,
                ])
                
            ->add('nickname', TextType::class, [
                'label'=> 'Pseudo',
            ])

            ->add('content', TextType::class, [
                'label' => 'Message',
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('parentid', HiddenType::class, [
                'mapped' => false
            ])

            ->add('isPublished', RadioType::class, [
                'label' => "Publier",
            ])

            ->add('Valider', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
