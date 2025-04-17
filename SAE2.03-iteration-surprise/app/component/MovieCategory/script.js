let templateFile = await fetch("./component/MovieCategory/template.html");
let template = await templateFile.text();

let MovieCategory = {};

MovieCategory.format = function (categories) {
  let listHTML = "";
  for (let i = 0; i < categories.length; i++) {
    let cat = categories[i];
    listHTML += `<li class="categorie__tag" data-name="${cat.name}">${cat.name}</li>`;
  }

  return `<ul class="categorie__list">${listHTML}</ul>`;
};



export { MovieCategory };