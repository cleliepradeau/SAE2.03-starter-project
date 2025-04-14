<?php

/** ARCHITECTURE PHP SERVEUR  : Rôle du fichier controller.php
 * 
 *  Dans ce fichier, on va définir les fonctions de contrôle qui vont traiter les requêtes HTTP.
 *  Les requêtes HTTP sont interprétées selon la valeur du paramètre 'todo' de la requête (voir script.php)
 *  Pour chaque valeur différente, on déclarera une fonction de contrôle différente.
 * 
 *  Les fonctions de contrôle vont éventuellement lire les paramètres additionnels de la requête, 
 *  les vérifier, puis appeler les fonctions du modèle (model.php) pour effectuer les opérations
 *  nécessaires sur la base de données.
 *  
 *  Si la fonction échoue à traiter la requête, elle retourne false (mauvais paramètres, erreur de connexion à la BDD, etc.)
 *  Sinon elle retourne le résultat de l'opération (des données ou un message) à includre dans la réponse HTTP.
 */

/** Inclusion du fichier model.php
 *  Pour pouvoir utiliser les fonctions qui y sont déclarées et qui permettent
 *  de faire des opérations sur les données stockées en base de données.
 */
require("model.php");

function readController() {
  $profileId = $_REQUEST['profileId'] ?? null;
  
  if ($profileId) {
    $profiles = readProfile();  // Cette fonction retourne un tableau d'objets de profils
    
    // Trouver le profil sélectionné par son ID en utilisant une boucle for
    $profile = null;
    for ($i = 0; $i < count($profiles); $i++) {
        if ($profiles[$i]->id == $profileId) {
            $profile = $profiles[$i];
            break;
        }
    }
    
    if ($profile) {
        $age = $profile->age;
    } else {
        $age = 0;  // Si aucun profil n'est sélectionné, âge = 0
    }
  } else {
    $age = 0;  // Si aucun profil n'est sélectionné, âge = 0
  }

  // Passer l'âge au modèle pour filtrer les films

  $movies = getMovie($age);  // Filtrage par âge
  return $movies;
}



function readControllerProfile(){
  $profiles = readProfile();
  return $profiles;
}

function addController(){
    /* Lecture des données de formulaire
      On ne vérifie pas si les données sont valides, on suppose (faudra pas toujours...) que le client les a déjà
      vérifiées avant de les envoyer 
    */
    $titre = $_REQUEST['titre'];
    $realisateur = $_REQUEST['realisateur'];
    $annee = $_REQUEST['annee'];
    $duree = $_REQUEST['duree'];
    $description = $_REQUEST['description'];
    $categorie = $_REQUEST['categorie'];
    $image = $_REQUEST['image'];
    $url = $_REQUEST['url'];
    $restriction = $_REQUEST['restriction'];

    // On vérifie que les champs obligatoires sont remplis
    if (empty($titre) || empty($realisateur) || empty($annee) || empty($duree) || empty($description) || empty($categorie) || empty($image) || empty($url) || empty($restriction)) {
        return "Tous les champs sont obligatoires.";
    }
    // Mise à jour du menu à l'aide de la fonction updateMenu décrite dans model.php
    $ok = addMovie($titre, $realisateur, $annee, $duree, $description, $categorie, $image, $url, $restriction);
    // $ok est le nombre de ligne affecté par l'opération de mise à jour dans la BDD (voir model.php)
    if ($ok!=0){
      return "Le film $titre a été mis à jour";
    }
    else{
      return "Aucun film n'a été ajouté";
    }
  }


  function addProfileController(){
    /* Lecture des données de formulaire
      On ne vérifie pas si les données sont valides, on suppose (faudra pas toujours...) que le client les a déjà
      vérifiées avant de les envoyer 
    */
    $nom = $_REQUEST['nom'];
    $image = $_REQUEST['image'];
    $date_naissance = $_REQUEST['date_naissance'];

    // On vérifie que les champs obligatoires sont remplis
    if (empty($nom) || empty($image) || empty($date_naissance)) {
        return "Tous les champs sont obligatoires.";
    }
    if (profileExists($nom)) {
      return "Un profil avec ce nom existe déjà.";
  }
    
    // Mise à jour du menu à l'aide de la fonction updateMenu décrite dans model.php
    $ok = addProfile($nom, $image, $date_naissance);
    // $ok est le nombre de ligne affecté par l'opération de mise à jour dans la BDD (voir model.php)
    if ($ok!=0){
      return "Le profil $nom a été ajoué";
    }
    else{
      return "Aucun profil n'a été ajouté";
    }
  }


  function modifyProfileController(){
    /* Lecture des données de formulaire
      On ne vérifie pas si les données sont valides, on suppose (faudra pas toujours...) que le client les a déjà
      vérifiées avant de les envoyer 
    */
    $nom = $_REQUEST['nom'];
    $image = $_REQUEST['image'];
    $date_naissance = $_REQUEST['date_naissance'];
    $id = $_REQUEST['id'];

    // On vérifie que les champs obligatoires sont remplis
    if (empty($nom) || empty($image) || empty($date_naissance) || empty($id)) {
        return "Tous les champs sont obligatoires.";
    }
    $ok = modifyProfile($nom, $image, $date_naissance, $id);
    // $ok est le nombre de ligne affecté par l'opération de mise à jour dans la BDD (voir model.php)
    if ($ok!=0){
      return "Le profil $nom a été mis à jour";
    }
    else{
      return "Aucun profil n'a été mis à jour";
    }
  }



  
function readControllerMovieDetails(){
  $id = $_REQUEST['id'] ?? null;
  if (empty($id)) {
      return "erreur";
  }
  return getMoviedetails($id);
}

  
function readControllerCategorie() {
  return getAllCategories();
}

function readControllerMovieCategorie(){
  $categorie = $_REQUEST['categorie'] ?? null;
  $profileId = $_REQUEST['profileId'] ?? null;

  if (empty($categorie)) {
      return "Erreur : Tous les champs doivent être remplis.";
  }

  $age = 0;

  if ($profileId) {
      $profiles = readProfile();
      for ($i = 0; $i < count($profiles); $i++) {
          if ($profiles[$i]->id == $profileId) {
              $age = $profiles[$i]->age;
              break;
          }
      }
  }

  return getMoviecategorie($categorie, $age);
}

function readControllerFavoris() {
  $id_profile = $_REQUEST['id_profile'] ?? null;

  if ($id_profile === null) {
    return false;
  }

  return getFavoris($id_profile);
}


function addControllerFavoris() {
  $id_profile = $_REQUEST['id_profile'] ?? null;
  $id_movie = $_REQUEST['id_movie'] ?? null;

  if ($id_profile === null || $id_movie === null) {
      return "Erreur : profil ou film manquant.";
  }

  if (isFavorisExists($id_movie, $id_profile)) {
      return "Ce film est déjà dans les favoris.";
  }

  $ok = addFavoris($id_movie, $id_profile);
  if ($ok) {
      return "Le film a été ajouté aux favoris.";
  } else {
      return "Erreur lors de l'ajout aux favoris.";
  }
}
