<?php

/**
 * Cette classe permet de se connecter à la base de données et de récupérer l'objet PDO
 * Cette classe utilise le design pattern "Singleton". 
 * @link : https://openclassrooms.com/fr/courses/7415611-ecrivez-du-php-maintenable-avec-les-principes-solid-et-les-design-patterns/7420004-utilisez-les-design-patterns-creationnels
 * 
 * Comme cette classe est un singleton, il n'est pas possible de l'instancier directement. 
 * Pour l'utiliser vous devez appeler la méthode getInstance() qui retourne l'instance de la classe.
 * 
 */
class DBConnect
{
    private static $instance = null;
    private $pdo;

    /**
     * Constructeur de la classe DBConnect, il est privé pour empêcher l'instanciation directe de la classe
     */
    private function __construct()
    {
        $this->pdo = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
    }

    /**
     * Cette méthode permet de récupérer l'instance de la classe DBConnect. Comme l'instance est stockée
     * dans une propriété statique, c'est toujours la même instance qui sera retournée. 
     * Le premier appel instancie la classe et tous les suivants retourneront l'instance déjà créée.
     * @return DBConnect
     */
    public static function getInstance(): DBConnect
    {
        if (self::$instance == null) {
            self::$instance = new DBConnect();
        }
        return self::$instance;
    }

    /**
     * Cette méthode permet de récupérer l'objet PDO qui permet de faire des requêtes sur la base de données
     * @return PDO
     */
    public function getPDO(): PDO
    {
        return $this->pdo;
    }
}
