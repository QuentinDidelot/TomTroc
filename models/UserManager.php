<?php

class UserManager extends AbstractEntityManager {

    public function inscriptionUser(string $pseudo, string $email, string $password): array {
        // Validation des données
        if (empty($pseudo) || empty($email) || empty($password)) {
            return ['status' => 'error', 'message' => 'Tous les champs sont requis.'];
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return ['status' => 'error', 'message' => 'Adresse e-mail invalide.'];
        }

        // Vérifier si l'utilisateur ou l'email existe déjà
        $stmt = $this->db->getPDO()->prepare("SELECT * FROM user WHERE pseudo = :pseudo OR email = :email");
        $stmt->execute(['pseudo' => $pseudo, 'email' => $email]);
        if ($stmt->rowCount() > 0) {
            return ['status' => 'error', 'message' => 'Le nom d\'utilisateur ou l\'email existe déjà.'];
        }

        // Hachage du mot de passe
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);


        // Insertion dans la base de données
        $stmt = $this->db->getPDO()->prepare("INSERT INTO user (pseudo, email, password) VALUES (:pseudo, :email, :password)");
        $result = $stmt->execute([
            'pseudo' => $pseudo,
            'email' => $email,
            'password' => $hashedPassword,
        ]);

        if ($result) {
            return ['status' => 'success', 'message' => 'Inscription réussie.'];
        } else {
            return ['status' => 'error', 'message' => 'Une erreur est survenue. Veuillez réessayer.'];
        }
    }

    /**
     * Récupère un utilisateur par son adresse mail.
     * @param string $email
     * @return ?User
     */
    public function getUserByEmail(string $email) : ?User 
    {
        $sql = "SELECT * FROM user WHERE email = :email";
        $result = $this->db->query($sql, ['email' => $email]);
        $user = $result->fetch();
        if ($user) {
            return new User($user);
        }
        return null;
    }

    /**
     * Récupère les informations de l'utilisateur et les livres qui lui appartiennent 
     */
    public function getUserById(int $id) : ?User
    {
        $sql = "SELECT * FROM user WHERE id = :id";
        
        $result = $this->db->getPDO()->prepare($sql);
        $result->bindValue(':id', $id, PDO::PARAM_INT);
        $result->execute();
        
        $userData = $result->fetch(PDO::FETCH_ASSOC);
        
        if ($userData) {
            // Pour s'assurer que la méthode de mappage de données est correcte
            return $this->mapDataToUser($userData);
        }
        return null;
    }

    /**
     * Mappe les données de la base de données à un objet User
     * @param array $data : les données de l'utilisateur
     * @return User : un objet User
     */
    private function mapDataToUser(array $data) : User
    {
        // Pour s'assurer que l'objet User et ses méthodes existent et fonctionnent correctement
        $user = new User();
        $user->setId($data['id']);
        $user->setEmail($data['email']);
        $user->setPassword($data['password']);

        return $user;
    }
}
