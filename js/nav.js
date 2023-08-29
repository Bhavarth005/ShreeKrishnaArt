let ul = document.querySelector('nav ul');
let links = document.querySelectorAll('.page-links');
let close_btn = document.getElementById('close-btn');
let search_bar = document.getElementById('search');
let menu_bars = document.querySelectorAll('.bar');
let menu_status = false;
let desk_search_btn = document.querySelector("#desktop-search-btn");

let search_status = false;

function open_search(){
    if(search_status){
        search_form.submit();
        return;
    }
    search_status = true;
    links.forEach(element => {
        element.style.display = "none";
    });

    close_btn.style.height = "30px";
    close_btn.style.marginLeft = "20px";

    search_bar.style.display = "block";
}

function close_search(){
    search_status = false;
    links.forEach(element => {
        element.style.display = "block";
    });

    close_btn.style.height = "0px";
    close_btn.style.margin = "0px";

    desk_search_btn.onclick = open_search;

    search_bar.style.display = "none";
}

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