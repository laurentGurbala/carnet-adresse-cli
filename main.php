<?php

require_once "db-connect.php";
require_once "contactManager.php";
require_once "contact.php";
require_once "command.php";

// Cette classe contient l'ensemble de toutes les commandes qui pourront être
// demandée par l'utilisateur. 
$commandClass = new Command();

// Coeur du programme. C'est une boucle infinie qui attend une commande de l'utilisateur
// et qui exécute la commande demandée. La boucle s'arrête quand l'utilisateur tape "quit"
while (true) {
    // Demande de commande à l'utilisateur
    $line = readline("Entrez votre commande (help, list, detail, create, delete, quit) : ");
    $line = strtolower(trim($line));
    // Commande "quit"
    // Cette commande quitte le programme
    if ($line === "quit") {
        // On sort de la boucle. Le programme s'arrête
        break;
    }

    // Commande "list"
    // Cette commande liste les contacts
    if ($line === "list") {
        $commandClass->list();
        continue;
    }

    // Commande "detail"
    // Cette commande affiche le détail d'un contact
    if (preg_match("/^detail\s+(\d+)$/", $line, $matches)) {
        $commandClass->detail($matches[1]);
        continue;
    }

    // Commande "create"
    // Cette commande crée un contact. 
    if (preg_match("/^create ([A-Za-zÀ-ÖØ-öø-ÿ]+(?: [A-Za-zÀ-ÖØ-öø-ÿ]+)+), ([A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}), ([0-9]{2}(?: [0-9]{2}){4})$/", $line, $matches)) {
        $name = $matches[1];
        $email = $matches[2];
        $phone = $matches[3];

        // Appeler une méthode pour créer le contact
        $commandClass->create($name, $email, $phone);
    }

    if (preg_match("/^modify\s+(\d+), ([A-Za-zÀ-ÖØ-öø-ÿ]+(?: [A-Za-zÀ-ÖØ-öø-ÿ]+)+), ([A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}), ([0-9]{2}(?: [0-9]{2}){4})$/", $line, $matches)) {
        $id = (int)$matches[1];
        $name = $matches[2];
        $email = $matches[3];
        $phone = $matches[4];

        $commandClass->modify($id, $name, $email, $phone);
        continue;
    }

    // Commande "delete"
    // Cette commande supprime un contact
    if (preg_match("/^delete\s+(\d+)$/", $line, $matches)) {
        $commandClass->delete((int)$matches[1]);
        continue;
    }

    // Commande "help"
    // Cette commande affiche l'aide. 
    if ($line == "help") {
        $commandClass->help();
        continue;
    }

    echo "Erreur: commande inconnue !\n";
}
