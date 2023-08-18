let menu_bars = document.querySelectorAll('.bar');
let menu_status = false;
let close_btn = document.getElementById('close-btn');
let ul = document.querySelector('nav ul');

function toggle_menu(){
    if(!menu_status){
        menu_bars[0].style.transform = "translateY(-2px) rotate(45deg)";
        menu_bars[1].style.transform = "scaleX(0)";
        menu_bars[2].style.transform = "translateY(1px) rotate(-45deg)";
        ul.style.height = "355px";
    }else{
        menu_bars[0].style.transform = "none";
        menu_bars[1].style.transform = "none";
        menu_bars[2].style.transform = "none";
        ul.style.height = "0px";
    }

    menu_status = !menu_status;
}