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


function getMovie($ageLimit = null){
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);

    if ($ageLimit !== null) {
        $sql = "SELECT id, name, image FROM Movie WHERE min_age <= :ageLimit";
        $stmt = $cnx->prepare($sql);
        $stmt->bindParam(':ageLimit', $ageLimit, PDO::PARAM_INT);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_OBJ);
        
        return $res;
    
    } else {
        $sql = "SELECT id, name, image FROM Movie";
        $answer = $cnx->query($sql);
        $res = $answer->fetchAll(PDO::FETCH_OBJ);
        
        return $res;
    }
}

    function readProfile() {
        // Connexion à la base de données
        $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
        // Requête SQL pour récupérer le menu avec des paramètres
        $sql = "select id, nom, image , date_naissance from Profile";
        // Prépare la requête SQL
        $stmt = $cnx->prepare($sql);
        // Exécute la requête SQL
        $stmt->execute();
        // Récupère les résultats de la requête sous forme d'objets
        $res = $stmt->fetchAll(PDO::FETCH_OBJ);
        // Retourne les résultats
        return $res;
}

function getMovieByAge($age) {
    // Connexion à la base de données
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);

    // Requête SQL pour récupérer les films en fonction de l'âge
    $sql = "SELECT id, name, image, min_age
            FROM Movie
            WHERE min_age <= :age";  // Filtre les films dont la restriction d'âge est <= à l'âge de l'utilisateur

    $stmt = $cnx->prepare($sql);
    $stmt->bindParam(':age', $age, PDO::PARAM_INT);
    $stmt->execute();

    // Récupère les résultats sous forme d'objets
    $res = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $res;  // Retourne les résultats
}



//test
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

function getMoviecategorie($categorie) {
    // Connexion à la base de données
    $cnx = new PDO("mysql:host=".HOST.";dbname=".DBNAME, DBLOGIN, DBPWD);
    // Requête SQL pour récupérer les informations du film en fonction du nom
    $sql = "SELECT Movie.id, Movie.name, image 
            FROM Movie 
            INNER JOIN Category ON Movie.id_category = Category.id 
            WHERE LOWER(Category.name) = LOWER(:categorie)
";

    // Préparation de la requête SQL
    $stmt = $cnx->prepare($sql);
    // Liaison du paramètre :id avec la variable $categorie){
    $stmt->bindParam(':categorie', $categorie   , PDO::PARAM_STR);
    // Exécution de la requête
    $stmt->execute(); 
    // Conversion des lignes récupérées en tableau d'objets (chaque ligne devient un objet)
    $res = $stmt->fetchAll(PDO::FETCH_OBJ);
    return $res; // Retourne les résultats
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
