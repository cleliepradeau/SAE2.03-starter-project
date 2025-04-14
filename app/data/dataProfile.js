// URL où se trouve le répertoire "server" sur mmi.unilim.fr
let HOST_URL = "https://mmi.unilim.fr/~pradeau49/SAE2.03-starter-project/";

let DataProfile = {};

// DataProfile.read = async function () {
//   // Récupération des films
//   let answer = await fetch(HOST_URL + "server/script.php?todo=getProfile");
//   let Profiles = await answer.json();
//   return Profiles;
// };

DataProfile.read = async function () {
  let answer = await fetch(HOST_URL + "/server/script.php?todo=readProfile");
  let Profiles = await answer.json();
  return Profiles;
};

DataProfile.addFavori = async function (id_profile, id_movie) {
  let url = HOST_URL + "/server/script.php?todo=addFavoris";
  let body = new FormData();
  body.append("id_profile", id_profile);
  body.append("id_movie", id_movie);

  let response = await fetch(url, {
    method: "POST",
    body: body,
  });

  let result = await response.json();
  return result;
};

// On exporte la fonction DataProfile.read
export { DataProfile };


