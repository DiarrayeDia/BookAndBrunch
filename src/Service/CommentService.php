<?php
namespace App\Service;

use App\Entity\Book;
use App\Entity\Comment;
use App\Entity\Post;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;

class CommentService
{
    private $manager;
    private $flash;

    public function __construct(EntityManagerInterface $manager, FlashBagInterface $flash)
    {
        $this->manager = $manager;
        $this->flash = $flash;
    }

    public function persistComment(Comment $comment, Book $book = null, Post $post = null)
    {
        $comment->setBook($book)
                ->setPost($post)
                ->setCreatedAt(new DateTime());
        
                $this->manager->persist($comment);
                $this->manager->flush();
                $this->flash->add('success', 'Votre commentaire a bien été soumis, il sera publié après validation');
    }

}