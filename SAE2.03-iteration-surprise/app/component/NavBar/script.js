let templateFile = await fetch("./component/NavBar/template.html");
let template = await templateFile.text();

let NavBar = {};

NavBar.format = function (hAbout, hProfile, profiles, hFavoris, barrecherche) {
  let html = template;
  html = html.replace("{{hAbout}}", hAbout);
  html = html.replace("{{handler}}", hProfile);
  html = html.replace("{{hFavoris}}", hFavoris);

  let profile = "";
  for (let i = 0; i < profiles.length; i++) {
    let p = profiles[i];
    console.log(p.id, p.image, p.nom);
    profile += `<option value="${p.id}" data-img="${p.image}" data-dob="${p.date_naissance}">${p.nom}</option>`;
  }

  let image = profiles[0]?.image || "";
  html = html.replace("{{profile}}", profile);
  html = html.replace("{{image}}", image);
  html = html.replace("{{barrecherche}}", barrecherche);

  return html;
};

export { NavBar };

