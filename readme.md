# Gestionnaire de Contacts en CLI

## Description
Ce projet est un gestionnaire de contacts accessible via une interface en ligne de commande (CLI). Il permet d'ajouter, modifier, supprimer et afficher des contacts. Il a été réalisé dans le cadre d'un exercice du parcours **OpenClassrooms**.

## Fonctionnalités principales
- Ajouter un nouveau contact.
- Modifier un contact existant.
- Supprimer un contact.
- Afficher la liste des contacts.
- Gérer les données via une base de données.

## Technologies utilisées
- **PHP** : langage principal pour la logique de l'application.
- **PDO** : pour la gestion de la connexion à la base de données.
- **CLI** : interface en ligne de commande.

## Structure du projet
```
.
├── command.php          # Gestion des commandes CLI
├── config.php           # Configuration de la connexion à la BDD
├── contact.php          # Modèle Contact
├── contactManager.php   # Gestionnaire des opérations sur les contacts
├── db-connect.php       # Classe pour la connexion à la base de données
├── main.php             # Point d'entrée principal du projet
└── .gitignore           # Fichier pour exclure certains fichiers du suivi Git
```

## Instructions d'installation

### Prérequis
- **PHP** (version 7.4 ou supérieure).
- **MySQL** ou un autre système de gestion de base de données compatible PDO.

### Étapes d'installation
1. Clonez le projet :
   ```bash
   git clone <lien-du-repository>
   cd carnet_adresse
   ```

2. Configurez votre base de données :
   - Mettez à jour le fichier `config.php` avec vos informations de connexion :
     ```php
     define('DB_HOST', 'localhost');
     define('DB_NAME', 'nom_de_votre_bdd');
     define('DB_USER', 'votre_utilisateur');
     define('DB_PASS', 'votre_mot_de_passe');
     ```

3. Lancez le projet depuis la console :
   ```bash
   php main.php
   ```

## Crédits
Projet réalisé dans le cadre du parcours Développeur d'application PHP Symfony **OpenClassrooms**.

## Licence
Ce projet est sous licence MIT. Vous êtes libre de l'utiliser et de le modifier.
