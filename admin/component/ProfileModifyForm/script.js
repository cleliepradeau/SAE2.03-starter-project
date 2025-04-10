let templateFile = await fetch('./component/ProfileModifyForm/template.html');
let template = await templateFile.text();


let ProfileModifyForm = {};

ProfileModifyForm.format = function(handler){
    let html= template;
    html = html.replace('{{handler}}', handler);
    return html;
}


export {ProfileModifyForm};
