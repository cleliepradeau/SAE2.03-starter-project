let templateFile = await fetch("./component/MovieDetail/template.html");
let template = await templateFile.text();

let Moviedetail = {};

Moviedetail.format = function (movies) {
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
    
    html += movieHtml;
  });
  return html;
};

export { Moviedetail };