<?php

/**
 * Cette classe permet de gérer les interactions avec la table contact. C'est elle qui s'occupe
 * d'écrire les requêtes à la base de données Mysql, mais aussi de transformer les résultats en objets Contact.
 */
class ContactManager
{
    private PDO $db;

    /**
     * Le constructeur de la classe. Il permet d'initialiser la propriété $db
     * Cette propriété contient une classe PDO, fournie par php, et qui pemet d'intéragir avec la base de données
     */
    public function __construct()
    {
        // On récupère l'instance de PDO
        $this->db = DBConnect::getInstance()->getPDO();
    }

    /**
     * Méthode permettant de récupérer tous les contacts de la base de données
     * @return array : un tableau d'objets Contact
     */
    public function findAll(): array
    {
        $statement  = $this->db->prepare("SELECT * FROM contact");
        $statement->execute();
        $results = $statement->fetchAll();

        $contacts = [];
        foreach ($results as $row) {
            $contacts[] = new Contact($row['id'], $row['name'], $row['email'], $row['phone']);
        }
        return $contacts;
    }

    /**
     * Méthode permettant de récupérer un contact par son id
     * @param int $id : l'id du contact à récupérer
     * @return Contact|null : le contact correspondant à l'id, ou null si aucun contact n'est trouvé
     */
    public function findById(int $id): ?Contact
    {
        $statement = $this->db->prepare("SELECT * FROM contact WHERE id = :id");
        $statement->execute(["id" => $id]);
        $contact = $statement->fetch();
        if (!$contact) {
            return null;
        }
        $contact = new Contact($contact['id'], $contact['name'], $contact['email'], $contact['phone']);;
        return $contact;
    }

    /**
     * Méthode permettant de créer un contact dans la base de données
     * @param string $name : le nom du contact
     * @param string $email : l'email du contact
     * @param string $telephone : le téléphone du contact
     * @return Contact : le contact qui vient d'être créé
     */
    public function create(string $name, string $email, string $phone): Contact
    {
        // Insert le contact dans la BDD
        $statement = $this->db->prepare("INSERT INTO contact (name, email, phone) VALUE (:name, :email, :phone)");
        $statement->execute(["name" => $name, "email" => $email, "phone" => $phone]);

        // Récupère le dernier id ajouter
        $id = $this->db->lastInsertId();
        // Retourne le contact créé
        return $this->findById($id);
    }

    /**
     * Méthode permettant de supprimer un contact de la base de données
     * @param int $id : l'id du contact à supprimer
     */
    public function delete(int $id): void
    {
        $statement = $this->db->prepare("DELETE FROM contact WHERE id = :id");
        $statement->execute([":id" => $id]);
    }

    public function modify(int $id, string $name, string $email, string $phone): Contact
    {
        $statement = $this->db->prepare("UPDATE contact SET name = :name, email = :email, phone =  :phone WHERE id = :id");
        $statement->execute(["name" => $name, "email" => $email, "phone" => $phone, "id" => $id]);

        return $this->findById($id);
    }
}
