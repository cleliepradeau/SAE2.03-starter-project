let templateFile = await fetch("./component/Movie/template.html");
let template = await templateFile.text();

let Movie = {};

Movie.format = function (movies) {
  let html = "";
  if (movies.length === 0) {
    return "<p>Aucun film trouvé</p>";
  }
  for (const movie of movies) {
    let movieHtml = template;
    movieHtml = movieHtml.replace("{{id}}", movie.id);
    movieHtml = movieHtml.replace("{{titre}}", movie.name);
    movieHtml = movieHtml.replace("{{image}}", movie.image);
    html += movieHtml;
  }
  return html;
};

export { Movie };