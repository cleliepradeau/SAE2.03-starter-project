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


// On exporte la fonction DataProfile.read
export { DataProfile };


