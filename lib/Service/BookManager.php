<?php

class BookManager {

    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    /**
     * @param array
     * @return book
     */
    private function arrayToObject(array $array) : Book {
        $book = new Book();
        $book->setId($array['id']);
        $book->setTitle( $array['title'] );
        $book->setAuthor($array['author']);
        $book->setRating($array['rating']);
        $book->setSummary($array['summary']);

        return $book;
    }

    /**
     * @return Book[]
     */
    public function findAll() {

        $statement = $this->pdo->prepare('SELECT * FROM book');
        $statement->execute();
        $books = $statement->fetchAll(PDO::FETCH_ASSOC);

        $booksObjects = [];

        foreach($books as $book) {
            $booksObjects[] = $this->arrayToObject($book);
        }

        return $booksObjects;
    }

    public function findOneById(int $id) { 

    }

    public function findByField(string $field, string $value) { 

    }

}