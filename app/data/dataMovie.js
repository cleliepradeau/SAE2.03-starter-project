// URL où se trouve le répertoire "server" sur mmi.unilim.fr
let HOST_URL = "https://mmi.unilim.fr/~pradeau49/SAE2.03-starter-project/";

let DataMovie = {};

// DataMovie.requestMovies = async function () {
//   // Récupération des films
//   let answer = await fetch(HOST_URL + "server/script.php?todo=getMovie");
//   let movies = await answer.json();
//   return movies;
// };

DataMovie.requestMovies = async function (profileId) {
  let url = HOST_URL + "/server/script.php?todo=getMovie";
  if (profileId) {
    url += "&profileId=" + profileId;  // Ajoute l'ID du profil à la requête
  }
  let answer = await fetch(url);
  let movies = await answer.json();
  return movies;
};

DataMovie.requestMovieDetails = async function (id){
  // Récupération des films
  let answer = await fetch(HOST_URL + "server/script.php?todo=getMovieDetails&id=" + id);
  let movies = await answer.json();
  return movies;
}

DataMovie.requestCategories = async function () {
  let answer = await fetch(HOST_URL + "/server/script.php?todo=getCategories");
  let categories = await answer.json();
  return categories;
};

DataMovie.requestMoviecategorie = async function (categorie, profileId) {
  let url = HOST_URL + "/server/script.php?todo=getMovieCategories&categorie=" + categorie;
  if (profileId) {
    url += "&profileId=" + profileId;
  }
  let answer = await fetch(url);
  let movie = await answer.json();
  return movie;
};

DataMovie.requestFavoris = async function (profileId) {
  let url = HOST_URL + "/server/script.php?todo=getFavoris&id_profile=" + profileId;
  let answer = await fetch(url);
  let favoris = await answer.json();
  return favoris;
};

DataMovie.addFavori = async function (movieId, profileId) {
  let url = HOST_URL + "/server/script.php?todo=addFavori";
  let formData = new FormData();
  formData.append("id_movie", movieId);
  formData.append("id_profile", profileId);

  let response = await fetch(url, {
    method: "POST",
    body: formData,
  });

  let result = await response.json();
  return result;
};

DataMovie.deleteFavoris = async function (movieId, profileId) {
  let url = HOST_URL + "/server/script.php?todo=deleteFavoris";
  let formData = new FormData();
  formData.append("id_movie", movieId);
  formData.append("id_profile", profileId);

  // Envoi de la requête pour supprimer le film des favoris
  let response = await fetch(url, {
    method: "POST",
    body: formData,
  });

  // Attente du résultat et renvoi du résultat sous forme de JSON
  let result = await response.json();
  return result;
};



// On exporte la fonction DataMovie.requestMovies
export { DataMovie };


