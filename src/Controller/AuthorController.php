<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AuthorController extends AbstractController
{
    #[Route('/author', name: 'app_author')]
    public function index(): Response
    {
        return $this->render('author/index.html.twig', [
            'controller_name' => 'AuthorController',
        ]);
    }
    #[Route('/Author/{name}', name: 'AuthorName')] 


    public function showAuthor(string $name): Response{
        return $this->render('author/showhtml.twig', [
            'name' => $name,
        ]);

    }
    #[Route('/authors', name: 'list_authors')]
    public function listAuthors (): Response{
    $authors = array(
        array('id' => 1, 'picture' => '/images/Victor-Hugo.jpg','username' => 'Victor Hugo', 'email' => 'victor.hugo@gmail.com ', 'nb_books' => 100),
        array('id' => 2, 'picture' => '/images/william-shakespeare.jpg','username' => ' William Shakespeare', 'email' =>  ' william.shakespeare@gmail.com', 'nb_books' => 200 ),
        array('id' => 3, 'picture' => '/images/Taha-Hussein.jpg','username' => 'Taha Hussein', 'email' => 'taha.hussein@gmail.com', 'nb_books' => 300),
        );
        $totalBooks = 0;
        foreach ($authors as $author) {
            $totalBooks += $author['nb_books'];
        }
        return $this->render('author/list.html.twig', [
            'authors' => $authors,
            'totalBooks' => $totalBooks,
        ]);

        

}
#[Route('/author_details/{id}', name: 'author_details')]
public function showAuthorDetails(int $id): Response {
    $authors = array(
        array('id' => 1, 'picture' => '/images/Victor-Hugo.jpg','username' => 'Victor Hugo', 'email' => 'victor.hugo@gmail.com ', 'nb_books' => 100),
        array('id' => 2, 'picture' => '/images/william-shakespeare.jpg','username' => ' William Shakespeare', 'email' =>  ' william.shakespeare@gmail.com', 'nb_books' => 200 ),
        array('id' => 3, 'picture' => '/images/Taha-Hussein.jpg','username' => 'Taha Hussein', 'email' => 'taha.hussein@gmail.com', 'nb_books' => 300),
        );
    $author = $authors[$id];
    return $this->render('author/details.html.twig', [
        'author' => $author,
    ]);
}
}