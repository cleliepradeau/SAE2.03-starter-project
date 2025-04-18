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
    const category = movie.category ?? "Inconnu";

    card += `
      <div class="mea__card" onclick="C.handlerDetail(${movie.id})" style="--i:${index + 1}">
        <div class="mea__img">
          <img class="mea__image" src="../server/images/${image}" alt="${name}" />
        </div>
          <div class="mea__overlay">
            <h3 class="mea__name">${name}</h3>
            <p class="mea__cat">${category}</p>
          </div>
        
      </div>`;
  }

  return template.replace("{{card}}", card);
};

export { MovieMiseenavant };