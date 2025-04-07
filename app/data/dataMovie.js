// URL où se trouve le répertoire "server" sur mmi.unilim.fr
let HOST_URL = "https://mmi.unilim.fr/~pradeau49/SAE2.03-starter-project/";

let DataMovie = {};

// DataMovie.requestMovies = async function () {
//   // Récupération des films
//   let answer = await fetch(HOST_URL + "server/script.php?todo=getMovie");
//   let movies = await answer.json();
//   return movies;
// };

DataMovie.requestMovies = async function () {
  let answer = await fetch(HOST_URL + "/server/script.php?todo=getMovie");
  let movies = await answer.json();
  return movies;
};

DataMovie.requestMovieDetails = async function (id){
  // Récupération des films
  let answer = await fetch(HOST_URL + "server/script.php?todo=getMovieDetails&id=" + id);
  let movies = await answer.json();
  return movies;
}

DataMovie.requestMovieCategorie = async function (){
  // Récupération des films
  let answer = await fetch(HOST_URL + "server/script.php?todo=getMovieCategories");
  let categorie = await answer.json();
  return categorie;
}


// On exporte la fonction DataMovie.requestMovies
export { DataMovie };


