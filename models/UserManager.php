<?php

class UserManager extends AbstractEntityManager {

    public function inscriptionUser(string $pseudo, string $email, string $password, ?string $profileImage = null): array {
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
        $stmt = $this->db->getPDO()->prepare("INSERT INTO user (pseudo, email, password, profile_image) VALUES (:pseudo, :email, :password, :profile_image)");
        $result = $stmt->execute([
            'pseudo' => $pseudo,
            'email' => $email,
            'password' => $hashedPassword,
            'profile_image' => $profileImage,
        ]);

        if ($result) {
            return ['status' => 'success', 'message' => 'Inscription réussie.'];
        } else {
            return ['status' => 'error', 'message' => 'Une erreur est survenue. Veuillez réessayer.'];
        }
    }

    /**
     * Vérifie si un e-mail est déjà utilisé par un utilisateur enregistré.
     * @param string $email L'adresse e-mail à vérifier.
     * @return bool True si l'e-mail existe déjà, false sinon.
     */
    public function emailExists(string $email): bool
    {
        $sql = "SELECT COUNT(*) FROM user WHERE email = :email";
        $result = $this->db->getPDO()->prepare($sql);
        $result->bindValue(':email', $email, PDO::PARAM_STR);
        $result->execute();
        $count = $result->fetchColumn();
        return $count > 0;
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
        $userData = $result->fetch(PDO::FETCH_ASSOC);
    
        if (!$userData) {
            return null;
        }
    
        // Création d'un objet User avec les données récupérées
        $user = new User();
        $user->setId($userData['id']);
        $user->setPseudo($userData['pseudo']);
        $user->setEmail($userData['email']);
        $user->setPassword($userData['password']);
        $user->setProfileImage($userData['profile_image']);
        $user->setRegistrationDate($userData['registration_date']);
    
        return $user;
    }


    public function getUserById(int $userId) : ?User
    {
        $sql = "SELECT id, pseudo, email, password, profile_image, registration_date FROM user WHERE id = :id";
        $result = $this->db->getPDO()->prepare($sql);
        $result->bindValue(':id', $userId, PDO::PARAM_INT);
        $result->execute();
        $userData = $result->fetch(PDO::FETCH_ASSOC);

        if (!$userData) {
            return null;
        }

        $user = new User();
        $user->setId($userData['id']);
        $user->setPseudo($userData['pseudo']);
        $user->setEmail($userData['email']);
        $user->setPassword($userData['password']);
        $user->setProfileImage($userData['profile_image']);
        $user->setRegistrationDate($userData['registration_date']);

        return $user;
    }



    public function updateProfileImage(int $userId, string $profileImage): bool {
        $sql = "UPDATE `user` SET `profile_image` = :profile_image WHERE `id` = :user_id";
        $result = $this->db->getPDO()->prepare($sql);
        return $result->execute(['profile_image' => $profileImage, 'user_id' => $userId]);
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
