var i = 0;
var img = [];
var time = 1000;

img[0] = 'img/ui.jpg';
img[1] = 'img/logo_img.svg';
img[2] = 'img/ui.jpg';
img[3] = 'img/logo_img.svg';
img[4] = 'img/ui.jpg';
img[5] = 'img/logo_img.svg';

function change() {
    document.n = img[i];
    document.t.src  = img[i];

    if (i<img.length - 1) {
        i++;
    }else{
        i = 0
    }
    setTimeout("change()",time);

}
// change();
// window.onload = change;



