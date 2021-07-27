<?php

namespace App\Form;

use App\Entity\Book;
use App\Entity\Author;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class BookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => "Titre du livre"
            ])
            ->add('year', IntegerType::class, [
                'label' => "Année de parution"
            ])

            ->add('summary', TextareaType::class, [
                'label' => "Résumé du livre"
            ])
            ->add('cover', FileType::class, [
                'label' => "Couverture du livre"
            ])
            ->add(
                'translation',
                CheckboxType::class,
                [
                    'label' => "Traduit en Français"
                ],
                ['choix' => [
                    'Oui' => true,
                    'Non' => false,
                ], 'expanded' => true,]
            )
            ->add('authors', EntityType::class, [
                'class' => Author::class,
                'multiple' => true,
                'label' => "Auteur.e"
            ])
            ->add('bookshelf', IntegerType::class, [
                'label' => "Etagère"
            ])

            ->add('genres', TextType::class, [
                'label' => "Genre"
            ])
            ->add('areas', TextType::class, [
                'label' => "Continent / Région"
            ])
            ->add('Valider', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Book::class,
        ]);
    }
}
