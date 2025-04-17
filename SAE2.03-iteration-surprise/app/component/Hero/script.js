let templateFile = await fetch("./component/Hero/template.html");
let template = await templateFile.text();

let Hero = {};

Hero.format = function (movies) {
  let html = "";
  movies.forEach((movie) => {
    let movieHtml = template;
    movieHtml = movieHtml.replace("{{titre}}", movie.name);
    movieHtml = movieHtml.replace("{{image}}", movie.image);
    movieHtml = movieHtml.replace("{{desc}}", movie.description);
    html += movieHtml;
  });
  return html;
};

export { Hero };