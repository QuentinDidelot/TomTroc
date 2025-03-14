<?php

/**
 * Classe qui gère les livres 
 */
class BookManager extends AbstractEntityManager{

    /**
     * Récupère tous les livres avec leur propriétaire.
     * @return array : un tableau d'objets Book.
     */
    public function getAllBookWithOwner() : array
    {
        $sql = "SELECT 
                    book.*, user.pseudo
                FROM book

                LEFT JOIN 
                    user ON user.id = book.user_id

                WHERE book.availability = 'Disponible'";

        $result = $this->db->getPDO()->prepare($sql);
        $books = [];
    
        $result->execute();
        return $result->fetchAll();
    }

    /**
     * Récupère un livre par son id.
     * @param int $id : l'id du livre.
     * @return Book|null : un objet Book ou null si le livre n'existe pas.
     */
    public function getBookById(int $id) : ?array
    {
        if ($id <= 0) {
            throw new InvalidArgumentException("ID de livre invalide.");
        }
    
        $sql = "SELECT book.id as book_id, book.*, user.pseudo, user.profile_image 
                FROM book 
                LEFT JOIN user ON user.id = book.user_id 
                WHERE book.id = :id";
    
        $result = $this->db->getPDO()->prepare($sql);
        $result->bindValue(':id', $id, PDO::PARAM_INT);
        $result->execute();
        $book = $result->fetch(PDO::FETCH_ASSOC);
    
        if ($book) {
            return $book;
        }
        return null;
    }
    
    

    /**
     * Récupère les livres avec leur propriétaire en fonction du titre recherché.
     * @param string $titleSearch : Le titre à rechercher.
     * @return array : Un tableau d'objets Book.
     */
    public function getBooksByTitle(string $titleSearch) : array
    {
        $sql = "SELECT 
                    book.*, user.pseudo 
                FROM book

                LEFT JOIN 
                    user ON user.id = book.user_id
                    
                WHERE book.availability = 'Disponible'
                AND book.title LIKE :titleSearch";

        $result = $this->db->getPDO()->prepare($sql);
        $result->bindValue(':titleSearch', '%' . $titleSearch . '%', PDO::PARAM_STR);

        $result->execute();
        return $result->fetchAll();
    }

    /**
     * Récupère les trois derniers livres ajoutés avec leur propriétaire.
     * @return array : Un tableau d'objets Book.
     */
    public function getLastFourBooks() : array
    {
        $sql = "SELECT 
                    book.*, user.pseudo 
                FROM book
                LEFT JOIN user ON user.id = book.user_id
                WHERE book.availability = 'Disponible'
                ORDER BY book.id DESC
                LIMIT 4";

        $result = $this->db->getPDO()->prepare($sql);

        $result->execute();
        return $result->fetchAll();
    }

    /**
     * Récupère tous les livres avec leurs utilisateurs
     * @return array 
     */
    public function getAllBooksByUser($userId) : array 
    {
        $sql = "SELECT book.id as book_id, book.*, user.pseudo
                FROM book
                LEFT JOIN user ON user.id = book.user_id
                WHERE user_id = :userId";
                
        $result = $this->db->getPDO()->prepare($sql);
        $result->bindParam(':userId', $userId, PDO::PARAM_INT);
    
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * Récupère les livres d'un seul utilisateur
     * @return array 
     */
    public function getBooksByUserId(int $userId): array {
        $sql = "SELECT * FROM book WHERE user_id = :user_id";
        $result = $this->db->getPDO()->prepare($sql);
        $result->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * Met à jour les informations d'un livre.
     * @param int $id : ID du livre à mettre à jour.
     * @param string $title : Nouveau titre du livre.
     * @param string $author : Nouvel auteur du livre.
     * @param string $description : Nouveau commentaire du livre.
     * @param string $availability : Nouvelle disponibilité du livre.
     * @return void
     */
    public function updateBook(int $id, string $title, string $author, string $description, string $availability) : void
    {
        $sql = "UPDATE book 
                SET title = :title, author = :author, description = :description, availability = :availability 
                WHERE id = :id";
        
        $result = $this->db->getPDO()->prepare($sql);
        $result->bindParam(':title', $title, PDO::PARAM_STR);
        $result->bindParam(':author', $author, PDO::PARAM_STR);
        $result->bindParam(':description', $description, PDO::PARAM_STR);
        $result->bindParam(':availability', $availability, PDO::PARAM_STR);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        
        $result->execute();
    }

    /**
     * Met à jour la photo d'un livre.
     * @param int $id : ID du livre à mettre à jour.
     * @param string $filePath : Chemin de la nouvelle photo de couverture.
     * @return void
     */
    public function updateBookPhoto(int $id, string $filePath) : void
    {
        $sql = "UPDATE book 
                SET image = :image 
                WHERE id = :id";
        
        $result = $this->db->getPDO()->prepare($sql);
        $result->bindParam(':image', $filePath, PDO::PARAM_STR);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        
        $result->execute();
    }

    /**
     * Ajouter un livre
     * @return void
     */
    public function addBook(string $title, string $author, string $description, string $availability, ?string $imagePath) : void
    {
        $sql = "INSERT INTO book (title, author, description, availability, image, user_id) 
                VALUES (:title, :author, :description, :availability, :image, :user_id)";
        
        $result = $this->db->getPDO()->prepare($sql);
        $result->bindParam(':title', $title, PDO::PARAM_STR);
        $result->bindParam(':author', $author, PDO::PARAM_STR);
        $result->bindParam(':description', $description, PDO::PARAM_STR);
        $result->bindParam(':availability', $availability, PDO::PARAM_STR);
        $result->bindParam(':image', $imagePath, PDO::PARAM_STR);
        $result->bindParam(':user_id', $_SESSION['user_id'], PDO::PARAM_INT);
        
        $result->execute();
    }
    


    /**
     * Supprimer un livre
     * @return void
     */
    public function deleteBook(int $bookId): void
    {

        $sql = "DELETE FROM book 
                WHERE id = :id";
        $result = $this->db->getPDO()->prepare($sql);
        $result->bindValue(':id', $bookId, PDO::PARAM_INT);
        $result->execute();
    }

    
    /**
     * Récupère les livres d'un utilisateur avec pagination.
     * @param int $userId
     * @param int $limit
     * @param int $offset
     * @return array
     */
    public function getBooksByUserIdPaginated(int $userId, int $limit, int $offset): array {
        $sql = "SELECT * FROM book 
                WHERE user_id = :user_id 
                AND availability = 'Disponible'
                LIMIT :limit OFFSET :offset";

        $result = $this->db->getPDO()->prepare($sql);
        $result->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $result->bindValue(':limit', $limit, PDO::PARAM_INT);
        $result->bindValue(':offset', $offset, PDO::PARAM_INT);
        $result->execute();
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Compte le nombre total de livres d'un utilisateur.
     * @param int $userId
     * @return int
     */
    public function countBooksByUserId(int $userId): int {
        $sql = "SELECT COUNT(*) 
                FROM book 
                WHERE user_id = :user_id
                AND availability = 'Disponible'";

        $result = $this->db->getPDO()->prepare($sql);
        $result->bindValue(':user_id', $userId, PDO::PARAM_INT);
        $result->execute();
        return (int)$result->fetchColumn();
    }
}
