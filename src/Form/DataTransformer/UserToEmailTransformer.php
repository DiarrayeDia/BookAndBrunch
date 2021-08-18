<?php

namespace App\Form\DataTransformer;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class UserToEmailTransformer implements DataTransformerInterface
{
    private $entityManager;
    
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /** 
     * Transforms an object (user) to a string (email)
     * 
     * @param User|null $user
    */

    public function transform($user) : string
    {
        if (null === $user) {
            return '';
        }
        return $user->getEmail();
    }
     

    /** 
     * Transforms a string (email) to an object (user) 
     * 
     * @param string $userEmail
     * @throws TransformationFailedException if object user is not found
    */

    public function reverseTransform($userEmail)
    {
        $user = $this->entityManager
            ->getRepository(User::class)
            //query for the user with this email
            ->find($userEmail);

        if (null=== $user) {
            //causes a validation error 
            // invalid message not seen by the user
            throw new TransformationFailedException(sprintf(
                'Aucun utilisateur avec l\'email "%s" n\'existe!', $userEmail
            ));
        }
        return $user;
    }
}
