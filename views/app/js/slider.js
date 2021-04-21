function slide1(){
    document.getElementById("id").src = "./views/app/src/img01.png";
    setTimeout("slide2()", 5000);
}

function slide2(){
    document.getElementById("id").src = "./views/app/src/img2.png";
    setTimeout("slide3()", 5000);
}

function slide3(){
    document.getElementById("id").src = "./views/app/src/img3.jpg";
    setTimeout("slide4()", 5000);
}

function slide4(){
    document.getElementById("id").src = "./views/app/src/img4.jpg";
    setTimeout("slide5()", 5000);
}

function slide5(){
    document.getElementById("id").src = "./views/app/src/img5.webp";
    setTimeout("slide1()", 5000);
}

function abrirMenu() {
  document.getElementById("menuMobile").style.width = "250px";
}

function fecharMenu() {
  document.getElementById("menuMobile").style.width = "0";
}