// URL où se trouve le répertoire "server" sur mmi.unilim.fr
let HOST_URL = "..";

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

DataMovie.add = async function (fdata) {
    let config = {
      method: "POST", 
      body: fdata, 
    };
    let answer = await fetch(
      HOST_URL + "/server/script.php?todo=addMovie",
      config
    );
    let data = await answer.json();
    return data;
  };
// On exporte la fonction DataMovie.requestMovies
export { DataMovie };

