let templateFile = await fetch("./component/MovieDetail/template.html");
let template = await templateFile.text();

let Moviedetail = {};

Moviedetail.format = function (movies, options = {}) {
  const { favorisIds = [], isLikesPage = false } = options;
  let html = "";

  movies.forEach((movie) => {
    let movieHtml = template;
    movieHtml = movieHtml.replace("{{titre}}", movie.name);
    movieHtml = movieHtml.replace("{{image}}", movie.image);
    movieHtml = movieHtml.replace("{{desc}}", movie.description);
    movieHtml = movieHtml.replace("{{realisateur}}", movie.director);
    movieHtml = movieHtml.replace("{{annee}}", movie.year);
    movieHtml = movieHtml.replace("{{duree}}", movie.length);
    movieHtml = movieHtml.replace("{{categorie}}", movie.category_name);
    movieHtml = movieHtml.replace("{{age}}", movie.min_age);
    movieHtml = movieHtml.replace("{{url}}", movie.trailer);
    movieHtml = movieHtml.replace("{{id}}", movie.id); 

    const isFavori = favorisIds.includes(movie.id.toString());
    const favoriClass = isFavori ? "favori-ajoute heart-liked" : "";
    movieHtml = movieHtml.replace("{{favoriClass}}", favoriClass);

    const deleteClass = isLikesPage ? "show-delete" : "hidden-delete";
    movieHtml = movieHtml.replace("{{deleteClass}}", deleteClass);

    html += movieHtml;
  });

  return html;
};

export { Moviedetail };
