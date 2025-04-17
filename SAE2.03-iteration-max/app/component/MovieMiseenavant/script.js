// let templateFile = await fetch("./component/MovieMiseenavant/template.html");
// let template = await templateFile.text();

// let Moviemiseenavant = {};

// Moviemiseenavant.format = function (movies) {
//   let html = "";
//   movies.forEach((movie) => {
//     let movieHtml = template;
//     movieHtml = movieHtml.replace("{{titre}}", movie.name);
//     movieHtml = movieHtml.replace("{{image}}", movie.image);
//     movieHtml = movieHtml.replace("{{desc}}", movie.description);
  
//     html += movieHtml;
//   });
//   return html;
// };

// export { Moviemiseenavant };

let MovieMiseenavant = {};

async function loadTemplate() {
  let templateFile = await fetch("./component/MovieMiseenavant/template.html");
  return await templateFile.text();
}

MovieMiseenavant.format = async function (movies) {
  if (!movies.length) return "";

  let template = await loadTemplate(); 
  let card = "";

  for (let index = 0; index < movies.length; index++) {
    const movie = movies[index];
    const image = movie.image ?? "placeholder.jpg";
    const name = movie.name ?? "Sans titre";
    const age = movie.min_age ?? "N.C";
    const year = movie.year ?? "????";
    const category = movie.category_name ?? "Inconnu";
    const description = movie.description ?? "Aucune description disponible.";

    card += `
      <div class="mea__card" onclick="C.handlerDetail(${movie.id})" style="--i:${index + 1}">
        <div class="mea__img">
          <img class="mea__image" src="https://mmi.unilim.fr/~pradeau49/SAE2.03-PRADEAU/SAE2.03-iteration-max/server/images/${image}" alt="${name}" />
          <div class="mea__overlay">
            <h3 class="mea__name">${name}</h3>
            <p class="mea__desc">${description}</p>
          </div>
        </div>
      </div>`;
  }

  return template.replace("{{card}}", card);
};

export { MovieMiseenavant };