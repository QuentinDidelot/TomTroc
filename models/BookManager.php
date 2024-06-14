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
        
        $stmt = $this->db->getPDO()->prepare($sql);
        $stmt->bindParam(':title', $title, PDO::PARAM_STR);
        $stmt->bindParam(':author', $author, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        $stmt->bindParam(':availability', $availability, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        $stmt->execute();
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
        
        $stmt = $this->db->getPDO()->prepare($sql);
        $stmt->bindParam(':image', $filePath, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        
        $stmt->execute();
    }

    /**
     * Supprime un livre
     * @return void
     */
    public function deleteBook(int $bookId): void
    {
        // Préparez votre requête de suppression
        $sql = "DELETE FROM book WHERE id = :id";
        $stmt = $this->db->getPDO()->prepare($sql);
        $stmt->bindValue(':id', $bookId, PDO::PARAM_INT);
        $stmt->execute();
    }

    
}