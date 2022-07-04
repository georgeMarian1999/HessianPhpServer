<?php

interface HessianServerInterface
{
    public function ping();

    public function getAuthorById($id);
    public function getAllAuthors();
    public function getAuthorsBySearch($keyword);
    public function addAuthor($name, $age);
    public function deleteAuthor($id);
    public function editAuthor($id, $name, $age);

    public function getBookById($id);
    public function getAllBooks();
    public function getBooksBySearch($keyword);
    public function getBooksByAuthor($id);
    public function addBook($title, $description, $year, $authorId);
    public function deleteBook($id);
    public function editBook($id,$title, $description, $year, $authorId);
}