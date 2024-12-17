<?php

/**
 * Cette classe permet de gérer toutes les commandes tapées par l'utilisateur. 
 * En particulier, l'affichage de l'aide et la gestion des commandes list, create et delete
 */
class Command
{
    private $contactManager;

    /**
     * Le constructeur de la classe. Il permet d'initialiser le manager de Contact
     */
    public function __construct()
    {
        // Initialisation du contactManager
        $this->contactManager = new ContactManager();
    }

    /**
     * Commande "list" : affiche la liste des $contacts
     * @return void
     */
    public function list(): void
    {
        $contacts = $this->contactManager->findAll();
        if (empty($contacts)) {
            echo "Aucun contact trouvé.\n";
            return;
        }

        echo "Liste des contacts :\n";
        echo "id, nom, email, phone\n";
        foreach ($contacts as $contact) {
            echo $contact;
        }
    }

    /**
     * Commande "detail" : affiche le détail d'un contact
     * @param int $id L'id du contact à afficher
     * @return void
     */
    public function detail(int $id): void
    {
        $contact  = $this->contactManager->findById($id);
        if (!$contact) {
            echo "Contact non trouvé\n";
            return;
        }

        echo "contact $id\n";
        echo "id, nom, email, phone\n";
        echo $contact;
    }

    /**
     * Commande "create" : crée un contact
     * @param string $name Le nom du contact
     * @param string $email L'email du contact
     * @param string $telephone Le téléphone du contact
     * @return void
     */
    public function create(string $name, string $email, string $phone): void
    {
        $contact = $this->contactManager->create($name, $email, $phone);
        echo "contact créé: $contact";
    }

    /**
     * Commande "delete" : supprime un contact
     * @param int $id L'id du contact à supprimer
     * @return void
     */
    public function delete(int $id): void
    {
        $this->contactManager->delete($id);
        echo "Contact supprimé\n";
    }

    public function modify(int $id, string $name, string $email, string $phone): void
    {
        $contact = $this->contactManager->modify($id, $name, $email, $phone);

        if (!$contact) {
            echo "Contact non trouvé avec l'id: $id";
            return;
        }

        echo "Contact modifié: $contact";
    }

    /**
     * Commande "help" : affiche l'aide
     * @return void
     */
    public function help(): void
    {
        echo "help : affiche cette aide\n";
        echo "list : liste les contacts\n";
        echo "create [nom], [email], [telephone] : crée un contact\n";
        echo "delete [id] : supprime un contact\n";
        echo "quit : quitte le programme\n";
        echo "\n";
        echo "Attention à la syntaxe des commandes, les espaces, virgules et majuscules sont importantes.\n";
    }
}
