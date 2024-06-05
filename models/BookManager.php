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
}