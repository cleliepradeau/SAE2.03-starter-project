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


function getMovie($age = 0) {
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    
    // Filtrer les films en fonction de l'âge
    if ($age > 0) {
        $sql = "SELECT id, name, image FROM Movie WHERE min_age <= :age";
        $stmt = $cnx->prepare($sql);
        $stmt->bindParam(':age', $age, PDO::PARAM_INT);
    } else {
        $sql = "SELECT id, name, image FROM Movie";
        $stmt = $cnx->prepare($sql);
    }

    $stmt->execute();
    $movies = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $movies;
}
function isFavorisExists($id_movie, $id_profile) {
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    $sql = "SELECT COUNT(*) FROM Favoris WHERE id_movie = :id_movie AND id_profile = :id_profile";
    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':id_movie', $id_movie, PDO::PARAM_INT);
    $stmt->bindParam(':id_profile', $id_profile, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchColumn() > 0;
}


function calculateAge($birthDate) {
    $birthDate = new DateTime($birthDate);
    $today = new DateTime('today');
    return $birthDate->diff($today)->y;
}

function readProfile() {
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    $sql = "SELECT id, nom, image, date_naissance FROM Profile";
    $stmt = $cnx->prepare($sql);
    $stmt->execute();
    $profiles = $stmt->fetchAll(PDO::FETCH_OBJ);

    // Remplacer la boucle foreach par une boucle for
    for ($i = 0; $i < count($profiles); $i++) {
        $profiles[$i]->age = calculateAge($profiles[$i]->date_naissance);
    }

    return $profiles;
}

function addMovie($titre, $realisateur, $annee, $duree, $description, $categorie, $image, $url, $restriction) {
    // Connexion à la base de données
    
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    // Requête SQL pour mettre à jour le menu avec des paramètres
    $sql = "INSERT INTO Movie (name, director, year, length, description, id_category, image, trailer, min_age) 
            VALUES (:titre, :realisateur, :annee, :duree, :description, :categorie, :image, :url, :restriction)";
    // Prépare la requête SQL
    $stmt = $cnx->prepare($sql);
    // Exécute la requête SQL avec les paramètres
    $stmt->bindParam(':titre', $titre);
    $stmt->bindParam(':realisateur', $realisateur);
    $stmt->bindParam(':annee', $annee);
    $stmt->bindParam(':duree', $duree);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':categorie', $categorie);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':url', $url);
    $stmt->bindParam(':restriction', $restriction);
    $stmt->execute();
    // Récupère le nombre de lignes affectées par la requête
    $res = $stmt->rowCount(); 
    return $res; // Retourne le nombre de lignes affectées
}


function addProfile($nom, $image, $date_naissance) {
    // Connexion à la base de données
    
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    // Requête SQL pour mettre à jour le menu avec des paramètres
    $sql = "INSERT INTO Profile (nom, image, date_naissance) 
            VALUES (:nom, :image, :date_naissance)";
    // Prépare la requête SQL
    $stmt = $cnx->prepare($sql);
    // Exécute la requête SQL avec les paramètres
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':date_naissance', $date_naissance);
    $stmt->execute();
    // Récupère le nombre de lignes affectées par la requête
    $res = $stmt->rowCount(); 
    return $res; // Retourne le nombre de lignes affectées
}
function profileExists($nom) {
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    $sql = "SELECT COUNT(*) FROM Profile WHERE nom = :nom";
    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':nom', $nom);
    $stmt->execute();
    return $stmt->fetchColumn() > 0;
}


function modifyProfile($nom, $image, $date_naissance, $id) {
    // Connexion à la base de données
    
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    // Requête SQL pour mettre à jour le menu avec des paramètres
    $sql = "UPDATE Profile 
            SET nom = :nom, image = :image, date_naissance = :date_naissance 
            WHERE id = :id";
    // Prépare la requête SQL
    $stmt = $cnx->prepare($sql);
    // Exécute la requête SQL avec les paramètres
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':date_naissance', $date_naissance);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    // Récupère le nombre de lignes affectées par la requête
    $res = $stmt->rowCount(); 
    return $res; // Retourne le nombre de lignes affectées
}



function getMoviedetails($id){
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    $sql = "SELECT Movie.id, Movie.name, image, description, director, year, length, Category.name AS category_name, min_age, trailer 
            FROM Movie 
            INNER JOIN Category ON Movie.id_category = Category.id 
            WHERE Movie.id = :id
";
    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_STR);
    $stmt->execute(); 
    $res = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $res; 
}

function getMoviecategorie($categorie, $age = 0) {
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    
    if ($age > 0) {
        $sql = "SELECT Movie.id, Movie.name, image 
                FROM Movie 
                INNER JOIN Category ON Movie.id_category = Category.id 
                WHERE LOWER(Category.name) = LOWER(:categorie)
                AND min_age <= :age";
        $stmt = $cnx->prepare($sql);
        $stmt->bindParam(':categorie', $categorie, PDO::PARAM_STR);
        $stmt->bindParam(':age', $age, PDO::PARAM_INT);
    } else {
        $sql = "SELECT Movie.id, Movie.name, image 
                FROM Movie 
                INNER JOIN Category ON Movie.id_category = Category.id 
                WHERE LOWER(Category.name) = LOWER(:categorie)";
        $stmt = $cnx->prepare($sql);
        $stmt->bindParam(':categorie', $categorie, PDO::PARAM_STR);
    }

    $stmt->execute(); 
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}


function getAllCategories() {
    // Connexion à la base de données
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    // Requête SQL pour récupérer les noms de toutes les catégories
    $sql = "SELECT name FROM Category";
    $stmt = $cnx->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $res;
}

function getFavoris($id_profile){
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    $sql = "
        SELECT m.*
        FROM Favoris f
        JOIN Movie m ON f.id_movie = m.id
        WHERE f.id_profile = :id_profile
    ";
    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':id_profile', $id_profile, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}


function addFavoris($id_movie, $id_profile) {
    if (isFavorisExists($id_movie, $id_profile)) {
        return false; // Film déjà en favoris
    }

    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    $sql = "INSERT INTO Favoris (id_movie, id_profile) VALUES (:id_movie, :id_profile)";
    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':id_movie', $id_movie, PDO::PARAM_INT);
    $stmt->bindParam(':id_profile', $id_profile, PDO::PARAM_INT);
    return $stmt->execute();
}
