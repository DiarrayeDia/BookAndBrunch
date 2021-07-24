<?php

namespace App\Form;

use App\Entity\Events;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, [
                'label' => "Titre de l'événement"
            ])
            ->add('date', DateType::class, [
                'label' => "Date",
                'format' => 'dd-MM-yyyy',
            ])
            ->add('link', UrlType::class, [
                'label' => "Lien d'inscription",
            ])

            ->add('image', FileType::class, [
                'label' => "Illustration",
            ])
            ->add('creator', TextType::class, [
                'label' => "Créatrice de l'évènement",
            ])
            /*       ->add('participant', TextareaType::class, [
                'label' => "Participant.e.s",
            ]) */

            ->add('Valider', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Events::class,
        ]);
    }
}
