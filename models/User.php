<?php   

/**
 * Entité User : un "user" est défini par son id, un pseudo, un email, un mot de passe, une image de profil et sa date d'inscription
 */

 class User extends AbstractEntity {

    private string $pseudo;
    private string $email;
    private string $password;
    private ?string $profileImage;
    private DateTime $registrationDate;

 }
