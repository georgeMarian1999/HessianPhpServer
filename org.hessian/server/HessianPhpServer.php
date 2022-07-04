<?php
include 'HessianPHP/src/HessianService.php';
include 'org.hessian/inter/HessianServerInterface.php';
include 'org.hessian/repo/AuthorRepo.php';
include 'org.hessian/repo/BookRepo.php';

class HessianPhpServer implements HessianServerInterface
{


    public function ping()
    {
        return "PHP Hessian Serv " . $_SERVER["SERVER_NAME"]." (".gethostbyname($_SERVER["SERVER_NAME"]).":".$_SERVER["SERVER_PORT"]."), ".date("Y.m.d H:i:s");
    }

    public function getAuthorById($id)
    {
        return AuthorRepo::getAuthorById($id);
    }

    public function getAllAuthors()
    {

        return AuthorRepo::getAllAuthors();

    }


    public function getAuthorsBySearch($keyword)
    {

        return AuthorRepo::getAuthorsBySearch($keyword);
    }

    public function addAuthor($name, $age)
    {
        AuthorRepo::addAuthor($name, $age);
    }

    public function deleteAuthor($id)
    {
       AuthorRepo::deleteAuthor($id);
    }

    public function editAuthor($id, $name, $age)
    {
        AuthorRepo::editAuthor($id, $name, $age);
    }

    public function getBookById($id)
    {
        return BookRepo::getBookById($id);
    }

    public function getAllBooks()
    {
       return BookRepo::getAllBooks();
    }

    public function getBooksBySearch($keyword)
    {
        return BookRepo::getBooksBySearch($keyword);
    }

    public function getBooksByAuthor($id)
    {
    }

    public function addBook($title, $description, $year, $authorId)
    {
        BookRepo::addBook($title, $description, $year, $authorId);
    }

    public function deleteBook($id)
    {
        BookRepo::deleteBook($id);
    }

    public function editBook($id, $title, $description, $year, $authorId)
    {
        BookRepo::editBook($id, $title, $description, $year, $authorId);
    }
}