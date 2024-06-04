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


    /**
     * Getter pour le pseudo.
     * @return string
     */
    public function getpseudo() : string 
    {
        return $this->pseudo;
    }


    /**
     * Setter pour le pseudo.
     * @param string $pseudo
     */
    public function setpseudo(string $pseudo) : void 
    {
        $this->pseudo = $pseudo;
    }


    /**
     * Getter pour le mail.
     * @return string
     */
    public function getEmail() : string 
    {
        return $this->email;
    }

    /**
     * Setter pour le mail.
     * @param string $email
     */
    public function setEmail(string $email) : void 
    {
        $this->email = $email;
    }


    /**
     * Getter pour le password.
     * @return string
     */
    public function getPassword() : string 
    {
        return $this->password;
    }


    /**
     * Setter pour le password.
     * @param string $password
     */
    public function setPassword(string $password) : void 
    {
        $this->password = $password;
    }


    /**
     * Getter pour l'image de profil.
     * @return string
     */
    public function getProfileImage() : string 
    {
        return $this->profileImage;
    }


    /**
     * Setter pour l'image de profil.
     * @param string $profileImage
     */
    public function setProfileImage(?string $profileImage) : void 
    {
        $this->profileImage = $profileImage;
    }


    /**
     * Getter pour la date d'inscription.
     * @return DateTime
     */
    public function getRegistrationDate() : DateTime
    {
        return $this->registrationDate;
    }
 

    /**
     * Setter pour la date de création. 
     * Si la date est une string, on la convertit en DateTime.
     * @param string|DateTime $registrationDate
     * @param string $format : le format pour la convertion de la date si elle est une string.
     * Par défaut, c'est le format de date mysql qui est utilisé. 
     */
    public function setRegistrationDate(string|DateTime $registrationDate, string $format = 'Y-m-d H:i:s') : void 
    {
        if (is_string($registrationDate)) {
            $registrationDate = DateTime::createFromFormat($format, $registrationDate);
        }
        $this->registrationDate = $registrationDate;
    }
 }

 
