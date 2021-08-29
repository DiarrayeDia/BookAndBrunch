<?php

namespace App\Form;

use App\Entity\Book;
use App\Entity\User;
use App\Entity\Comment;
use App\Form\DataTransformer\UserToEmailTransformer;
use App\Repository\UserRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Security\Core\Security;

class CommentType extends AbstractType
{
    private $security;
    
    public function __construct(Security $security)
    {
        $this->security =$security;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
 /*            ->add('createdAt', DateTimeType::class, [
                'label'=> 'Date',
            ]) */

            ->add('writtenBy', EntityType::class, [
                'label' => 'Email',
                'class' => User::class,
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

          /*   ->add('isPublished', RadioType::class, [
                'label' => "Publier",
            ]) */

            ->add('Envoyer', SubmitType::class)
            ;
        
      
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Comment::class,
        ]);
    }
}
