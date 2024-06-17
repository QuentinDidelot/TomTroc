<?php 
/**
 * Contrôleur de la partie utilisateur.
 */
 
class UserController {

        /**
         * Affiche le profil public d'un utilisateur avec ses livres paginés.
         * @return void
         */
        public function showPublicAccount(): void
        {
            if (isset($_GET['userId'])) {
                $userId = intval($_GET['userId']);
                $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
                $limit = 5; // Nombre de livres par page
                $offset = ($page - 1) * $limit;
    
                // Assurez-vous que $db est votre connexion à la base de données
                $userManager = new UserManager(); 
                $user = $userManager->getUserById($userId);
    
                if ($user) {
                    // Récupérer les livres de l'utilisateur avec pagination
                    $bookManager = new BookManager();
                    $books = $bookManager->getBooksByUserIdPaginated($userId, $limit, $offset);
                    $totalBooks = $bookManager->countBooksByUserId($userId);
                    $totalPages = ceil($totalBooks / $limit);
    
                    // Passer les données à la vue
                    $view = new View("Profil public de l'utilisateur");
                    $view->render("publicAccount", [
                        'user' => $user,
                        'books' => $books,
                        'totalBooks' => $totalBooks, // Passer le nombre total de livres
                        'currentPage' => $page,
                        'totalPages' => $totalPages
                    ]);
                } else {
                    echo "Utilisateur non trouvé.";
                }
            }
        }
    }
    