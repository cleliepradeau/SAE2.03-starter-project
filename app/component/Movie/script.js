let templateFile = await fetch("./component/Movie/template.html");
let template = await templateFile.text();

let Movie = {};

Movie.format = function (movies, isLikesPage = false, favorisIds = []) {
  let html = "";
  if (movies.length === 0) {
    return "<p>Aucun film trouvé</p>";
  }
  for (const movie of movies) {
    let movieHtml = template;
    movieHtml = movieHtml.replaceAll("{{id}}", movie.id);
    movieHtml = movieHtml.replace("{{titre}}", movie.name);
    movieHtml = movieHtml.replace("{{image}}", movie.image);

    // Favori ?
    const isFavori = favorisIds.includes(movie.id.toString());
    const favoriClass = isFavori ? "favori-ajoute" : "";

    movieHtml = movieHtml.replace("{{favoriClass}}", favoriClass);
    html += movieHtml;
  }
  return html;
};


export { Movie };