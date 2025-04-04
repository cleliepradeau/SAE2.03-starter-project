<?php
/**
 * Ce fichier contient toutes les fonctions qui réalisent des opérations
 * sur la base de données, telles que les requêtes SQL pour insérer, 
 * mettre à jour, supprimer ou récupérer des données.
 */

/**
 * Définition des constantes de connexion à la base de données.
 *
 * HOST : Nom d'hôte du serveur de base de données, ici "localhost".
 * DBNAME : Nom de la base de données
 * DBLOGIN : Nom d'utilisateur pour se connecter à la base de données.
 * DBPWD : Mot de passe pour se connecter à la base de données.
 */
define("HOST", "localhost");
define("DBNAME", "pradeau49");
define("DBLOGIN", "pradeau49");
define("DBPWD", "pradeau49");


function getMovie() {
        // Connexion à la base de données
        $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
        // Requête SQL pour récupérer le menu avec des paramètres
        $sql = "select id, name, image from Movie";
        // Prépare la requête SQL
        $stmt = $cnx->prepare($sql);
        // Exécute la requête SQL
        $stmt->execute();
        // Récupère les résultats de la requête sous forme d'objets
        $res = $stmt->fetchAll(PDO::FETCH_OBJ);
        return $res; // Retourne les résultats
    }
//test
function updateMovie($titre, $realisateur, $annee, $duree, $description, $categorie, $image, $url, $restriction) {
    // Connexion à la base de données
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    // Requête SQL pour mettre à jour le menu avec des paramètres
    $sql = "INSERT INTO Movie (name, director, year, duration, description, category, image, url, restriction) 
            VALUES (:titre, :realisateur, :annee, :duree, :description, :categorie, :image, :url, :restriction)";
    // Prépare la requête SQL
    $stmt = $cnx->prepare($sql);
    // Exécute la requête SQL avec les paramètres
    $stmt->execute(array(
        ':titre' => $titre,
        ':realisateur' => $realisateur,
        ':annee' => $annee,
        ':duree' => $duree,
        ':description' => $description,
        ':categorie' => $categorie,
        ':image' => $image,
        ':url' => $url,
        ':restriction' => $restriction
    ));
    return $stmt->rowCount(); // Retourne le nombre de lignes affectées par la mise à jour
}