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


// On exporte la fonction DataMovie.requestMovies
export { DataMovie };


