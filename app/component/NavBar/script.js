let templateFile = await fetch("./component/NavBar/template.html");
let template = await templateFile.text();

let NavBar = {};

NavBar.format = function (hAbout, hProfile, profiles) {
  let html = template;
  html = html.replace("{{hAbout}}", hAbout);
  html = html.replace("{{handler}}", hProfile);

  let profile = "";
  for (let i = 0; i < profiles.length; i++) {
    let p = profiles[i];
    profile += `<option value="${p.nom}" data-img="${p.image}" data-dob="${p.date_naissance}">${p.nom}</option>`;
  }

  let image = profiles[0]?.image || "";
  html = html.replace("{{profile}}", profile);
  html = html.replace("{{image}}", image);

  return html;
};

export { NavBar };

