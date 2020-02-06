<?php

class Container {

    private $configuration;
    private $pdo;


    public function __construct(array $configuration) {
        $this->configuration = $configuration;
    }

    /**
     * @return PDO
     */
    public function getPdo() {

        if ($this->pdo === null) {

            $dsn = sprintf("mysql:host=%s;dbname=%s;port=%s",
                            $this->configuration['DB_HOST'],
                            $this->configuration['DB_NAME'],
                            $this->configuration['DB_PORT']);

            $pdo = new PDO( $dsn,
                            $this->configuration['DB_USER'],
                            $this->configuration['DB_PSWD']);

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo = $pdo;
        }

        return $this->pdo;
    }

    /**
     * @return BookLoader
     */
    public function getBookManager() {

        return new BookManager( $this->getPdo() );

    }
}