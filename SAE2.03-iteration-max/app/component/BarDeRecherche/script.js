let templateFile = await fetch("./component/BarDeRecherche/template.html");
let template = await templateFile.text();

let BarDeRecherche = {};

BarDeRecherche.format = function () {
  return template;
};

export { BarDeRecherche };