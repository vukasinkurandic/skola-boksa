/*========================================================
                    TINY SLIDER
========================================================*/
var slider = tns({
    container: ".my-slider",
    items: 1,
    slideBy: "page",
    autoplay: false,
    mouseDrag: true,
    speed: 400,
    // controlsContainer: "#customize-controls",
    // nav: false,
    // autoplayButtonOutput: false,
});

/*========================================================
                        AOS
========================================================*/
AOS.init({
    duration: 800,
    easing: "ease",
    mirror: true,
});

/*========================================================
                   SCROLL SPY
========================================================*/

// $("body").scrollspy({ target: "#navbar-wrapper" });

/*========================================================
              ZATVARANJE SIDEBARA NA KLIK
========================================================*/
$(function() {
    $(".menu ul li a").on("click touch", function() {
        $(".toggler").click();
    });
});

/*========================================================
              SIDEBAR TOGGLE CLASS
========================================================*/
const toggle = document.querySelector(".toggler");
const menu = document.querySelector(".menu");

toggle.addEventListener("click", function() {
    if (menu.classList.contains("menu--open")) {
        menu.classList.remove("menu--open");
        menu.classList.add("menu--closed");
        toggle.classList.remove("open");
    } else {
        menu.classList.remove("menu--closed");
        toggle.classList.add("open");
        menu.classList.add("menu--open");
    }
});

/*========================================================
                          GOOGLE MAP
========================================================*/
function mapa() {
    var mapProp = {
        center: new google.maps.LatLng(44.8210739, 20.4631098),
        zoom: 5,
    };
    var mapa = new google.maps.Map(document.getElementById("googleMap"), mapProp);
    // var marker = new google.maps.Marker({ position: myCenter });

    // marker.setMap(map);
}

/*========================================================
                      MAGNIFIC POPUP
========================================================*/