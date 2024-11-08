<?php    
include_once(__DIR__ . "/../model/Book.php");
include_once(__DIR__ . "/../model/Author.php");

class Model {
    private $dbConnection;

    public function __construct() {
        // З'єднання з базою даних PostgreSQL
        $dsn = 'pgsql:host=localhost;port=5432;dbname=books;';
        $user = 'postgres';
        $password = 'postgres';

        try {
            $this->dbConnection = new PDO($dsn, $user, $password);
            $this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->initializeDatabase();
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    private function initializeDatabase() {
        // Створення таблиці для авторів
        $query = 'CREATE TABLE IF NOT EXISTS authors (
                id SERIAL PRIMARY KEY,
                first_name TEXT NOT NULL,
                last_name TEXT NOT NULL,
                country TEXT NOT NULL
              )';
        $this->dbConnection->exec($query);

        // Створення таблиці для книг
        $query = 'CREATE TABLE IF NOT EXISTS books (
                id SERIAL PRIMARY KEY,
                title TEXT NOT NULL,
                description TEXT,
                publish_year INTEGER,
                page_count INTEGER,
                img TEXT,
                author_id INTEGER NOT NULL,
                FOREIGN KEY (author_id) REFERENCES authors(id) ON DELETE CASCADE
              )';
        $this->dbConnection->exec($query);

        // Перевірка, чи таблиці порожні, і вставка даних, якщо це так
        $authorCheckQuery = 'SELECT COUNT(*) FROM authors';
        $bookCheckQuery = 'SELECT COUNT(*) FROM books';

        $authorCount = $this->dbConnection->query($authorCheckQuery)->fetchColumn();
        $bookCount = $this->dbConnection->query($bookCheckQuery)->fetchColumn();

        if ($authorCount == 0 && $bookCount == 0) {
            // Вставка авторів
            $this->dbConnection->exec("INSERT INTO authors (first_name, last_name, country) VALUES ('William', 'Shakespeare', 'England')");
            $this->dbConnection->exec("INSERT INTO authors (first_name, last_name, country) VALUES ('Dante', 'Alighieri', 'Italy')");

            // Вставка книг
            $this->dbConnection->exec("INSERT INTO books (title, description, publish_year, page_count, img, author_id) VALUES ('Hamlet', 'A tragedy by William Shakespeare', 1603, 200, 'hamlet.jpg', 1)");
            $this->dbConnection->exec("INSERT INTO books (title, description, publish_year, page_count, img, author_id) VALUES ('Macbeth', 'A tragedy by William Shakespeare', 1606, 250, 'macbeth.jpg', 1)");
            $this->dbConnection->exec("INSERT INTO books (title, description, publish_year, page_count, img, author_id) VALUES ('Divine Comedy', 'An epic poem by Dante Alighieri', 1320, 500, 'divine_comedy.jpg', 2)");
        }
    }
    
    public function getBookList() {
        // Отримання списку книг разом з авторами
        $stmt = $this->dbConnection->query("
            SELECT books.id, books.title, books.description, CONCAT(authors.first_name, ' ', authors.last_name) AS author
            FROM books
            JOIN authors ON books.author_id = authors.id
        ");
        $books = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $author = new Author($row['author']);
            $books[$row['title']] = new Book($row['title'], $author->name, $row['description']);
        }

        return $books;
    }

    public function getBook($title) {
        // Пошук конкретної книги за її назвою
        $stmt = $this->dbConnection->prepare("
            SELECT books.id, books.title, books.description, CONCAT(authors.first_name, ' ', authors.last_name) AS author
            FROM books
            JOIN authors ON books.author_id = authors.id
            WHERE books.title = :title
        ");
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $author = new Author($row['author']);
            return new Book($row['title'], $author->name, $row['description']);
        }
        
        return null;
    }
    
    public function searchBooks($term) {
        // Пошук книг за назвою або автором
        $stmt = $this->dbConnection->prepare("
            SELECT books.id, books.title, books.description, CONCAT(authors.first_name, ' ', authors.last_name) AS author
                FROM books
                JOIN authors ON books.author_id = authors.id
                WHERE books.title ILIKE :term OR CONCAT(authors.first_name, ' ', authors.last_name) ILIKE :term
        ");
        $stmt->bindValue(':term', "%$term%", PDO::PARAM_STR);
        $stmt->execute();
        $books = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $author = new Author($row['author']);
            $books[$row['title']] = new Book($row['title'], $author->name, $row['description']);
        }

        return $books;
    }
}   
?> 