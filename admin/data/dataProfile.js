// URL où se trouve le répertoire "server" sur mmi.unilim.fr
let HOST_URL = "https://mmi.unilim.fr/~pradeau49/SAE2.03-starter-project";

let DataProfile = {};

DataProfile.add = async function (fdata) {
    let config = {
      method: "POST", 
      body: fdata, 
    };
    let answer = await fetch(
      HOST_URL + "/server/script.php?todo=addProfile",
      config
    );
    let data = await answer.json();
    return data;
  };

  DataProfile.update = async function (fdata) {
    let config = {
      method: "POST", 
      body: fdata, 
    };
    let answer = await fetch(
      HOST_URL + "/server/script.php?todo=modifyProfile",
      config
    );
    let data = await answer.json();
    return data;
  };

  DataProfile.readProfile = async function () {
    let answer = await fetch(
      HOST_URL + "/server/script.php?todo=readProfile"
    );
    let data = await answer.json();
    return data;
  };
// On exporte la fonction DataProfile.requestProfiles
export { DataProfile };

