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

    /**
     * @param int $id
     * @return Book
     */
    public function findOneById(int $id) {

        $statement = $this->pdo->prepare('SELECT * FROM book WHERE id = :id');
        $statement->execute(['id' => $id]);
        $book = $statement->fetch(PDO::FETCH_ASSOC);

        $bookObject = $this->arrayToObject($book);
        
        return $bookObject;

    }

    public function findByField(string $field, string $value) {

        $query = "SELECT * FROM book WHERE " . $field . " LIKE :value";
        $statement = $this->pdo->prepare($query);
        $statement->execute([
            'value' => '%'.$value.'%'
            ]);

        $books = $statement->fetchAll(PDO::FETCH_ASSOC);
        $booksObjects = [];

        foreach ($books as $book) {
            $booksObjects[] = $this->arrayToObject($book);
        }

        return $booksObjects;
    }

    public function update(Book $book) : void {
        $statement = $this->pdo->prepare('
            UPDATE book
            SET title = :title, author = :author, summary = :summary, rating = :rating
            WHERE id = :id
        ');
        $statement->execute([
            'title'     => $book->getTitle(),
            'author'    => $book->getAuthor(),
            'summary'   => $book->getSummary(),
            'rating'    => $book->getRating(),
            'id'        => $book->getId(),
        ]);
    }

}