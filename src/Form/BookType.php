<?php

namespace App\Form;

use App\Entity\Area;
use App\Entity\Book;
use App\Entity\Genre;
use App\Entity\Author;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
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
                'label' => "Couverture du livre",
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '2500k',
                        'mimeTypes' => [
                            'image/*',
                        ],
                        'mimeTypesMessage' => 'Merci de choisir un format d\'images valide',
                    ])
                ],
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
            // ->add('bookshelf', IntegerType::class, [
            //     'label' => "Etagère"
            // ])

            ->add('genres', EntityType::class, [
                'class' => Genre::class,
                'multiple' => true,
                'label' => "Genre"
            ])
            ->add('areas', EntityType::class, [
                'class' => Area::class,
                'multiple' => true,
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
