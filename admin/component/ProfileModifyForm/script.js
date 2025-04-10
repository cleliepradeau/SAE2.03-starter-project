let templateFile = await fetch('./component/ProfileModifyForm/template.html');
let template = await templateFile.text();


let ProfileModifyForm = {};

ProfileModifyForm.format = function(handler, profile) {
    let html= template;
    html = html.replace('{{handler}}', handler);
    html = html.replace('{{hProfile}}', profile);
    return html;
}


export {ProfileModifyForm};
