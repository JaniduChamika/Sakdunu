function openNav() {
    var side = document.getElementById("mySidenav");
    var buttn = document.getElementById("bton");
    // var menubtn = document.getElementById("menuicon");
    if (side.style.width == "300px") {
        side.style.width = "0px";
        buttn.innerHTML = "<i class='icofont-filter'></i>Filter";

    } else {
        side.style.width = "300px";
        buttn.innerHTML = "<i class='icofont-circled-right'></i>";


    }
}




// function brandfilter(x) {
// alert(x);
// }

function mainfilter(n, x) {


    var minz;
    var maxz;
    // alert(max)
    var mintag = document.getElementById("minin");
    var maxtag = document.getElementById("maxin");
    var btn = document.getElementById("pricesubbtn");

    var radiobtn1 = document.getElementById("1R");
    var radiobtn2 = document.getElementById("2R");
    var radiobtn3 = document.getElementById("3R");
    var radiobtn4 = document.getElementById("4R");
    var radiobtn5 = document.getElementById("5R");

    var radiobtn7 = document.getElementById("7R");



    if (radiobtn1.checked == true) {
        minz = radiobtn1.min;
        maxz = radiobtn1.max;


    }
    if (radiobtn2.checked == true) {
        minz = radiobtn2.min;
        maxz = radiobtn2.max;


    }
    if (radiobtn3.checked == true) {
        minz = radiobtn3.min;
        maxz = radiobtn3.max;


    }
    if (radiobtn4.checked == true) {
        minz = radiobtn4.min;
        maxz = radiobtn4.max;


    }
    if (radiobtn5.checked == true) {
        minz = radiobtn5.min;
        maxz = radiobtn5.max;
    }

    if (radiobtn7.checked == true) {
        mintag.disabled = false;
        maxtag.disabled = false;
        btn.disabled = false;
        // alert(mintag.value.length)
        if (mintag.value.length == 0) {
            minz = mintag.min;

        } else {
            minz = mintag.value;


        }
        if (maxtag.value.length == 0) {
            maxz = maxtag.max;


        } else {
            maxz = maxtag.value;

        }
        minz = mintag.value;
    } else {
        mintag.disabled = true;
        maxtag.disabled = true;
        btn.disabled = true;

    }
    var main = document.getElementById("mainheadID");
    // var radiobtn = document.getElementById("1R");
    // radiobtn.checked = true;
    var subtag = document.getElementById("filtersubID");
    sub = subtag.value;

    var brandtag = document.getElementById("filterbrandID");
    brand = brandtag.value;
    if (n == 1) {
        filtermain = document.getElementById("filtermainID");
        var filsel = main.value;
        filtermain.value = filsel;
    }
    if (n == 2) {
        filtermain = document.getElementById("filtermainID");
        var filsel = filtermain.value;
        main.value = filsel;
    }
    var shophere = document.getElementById("shophearID");
    var headsherch = document.getElementById("mainserchtypeID");
    var filltype = headsherch.value;
    var filtermain = main.value;
    // alert(filtermain)
    // var minz = 0;
    // var maxz = "All";

    var f = new FormData();
    f.append("main", filtermain);
    f.append("t", filltype);
    f.append("s", sub);
    f.append("b", brand);
    f.append("min", minz);
    f.append("max", maxz);
    f.append("n", n);
    f.append("page", x)


    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            shophere.innerHTML = text;
        }
    };
    req.open("POST", "mainsherch.php", true);

    req.send(f);

}

function emptyknow() {
    var headsherch = document.getElementById("mainserchtypeID");
    var filltype = headsherch.value;
    if (filltype == "") {
        mainfilter(1, 1);
    }
}

function gethome() {
    var homesel = document.getElementById("homeselID");
    var homein = document.getElementById("homeinID");
    var filltype = homesel.innerHTML;
    var filtermain = homein.innerHTML;
    var headsherch = document.getElementById("mainserchtypeID");
    var main = document.getElementById("mainheadID");

    main.value = filltype;
    headsherch.value = filtermain;
    mainfilter(1, 1);

    homein.innerHTML = "";
    homesel.innerHTML = "All";



}

function getsub(x) {


    var maintag = document.getElementById("filtermainID");
    var subtag = document.getElementById("filtersubID");
    var brand = document.getElementById("filterbrandID");

    var main = maintag.value;

    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {

            var text = req.responseText;
            subtag.innerHTML = text;
            brand.value = "All";
            if (x == "s") {
                mainfilter(2, 1)

            }
        }
    };
    req.open("POST", "getsub.php", true);
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req.send("m=" + main);

}

function getbrand(x) {


    var brandtag = document.getElementById("filterbrandID");
    var subtag = document.getElementById("filtersubID");


    var sub = subtag.value;

    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {

            var text = req.responseText;
            brandtag.innerHTML = text;
            if (x == "s") {

                mainfilter('no', 1);
            }
        }
    };
    req.open("POST", "getbrand.php", true);
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req.send("m=" + sub);

}
// uda nav bar eka saha filter sidebar eekava position change karai scroll ekkka
var prevScrollpos = window.pageYOffset;
window.onscroll = function() {
        var scree = window.matchMedia("(max-width: 768px)")

        var currentScrollPos = window.pageYOffset;
        if (prevScrollpos > currentScrollPos) {
            document.getElementById("navbarmy").style.top = "0";
            document.getElementById("menuicon").style.top = "20px";
            if (scree.matches) { // If media query matches
                document.getElementById("mySidenav").style.paddingTop = "150px";

            } else {
                document.getElementById("mySidenav").style.paddingTop = "100px";

            }


        } else {
            document.getElementById("navbarmy").style.top = "-100px";
            document.getElementById("menuicon").style.top = "-60px";
            if (scree.matches) {
                document.getElementById("mySidenav").style.paddingTop = "80px";
            } else {
                document.getElementById("mySidenav").style.paddingTop = "30px";

            }
        }

        prevScrollpos = currentScrollPos;
    }
    // rightsude fileter eke padding top change karai 
function myFunction(x) {
    if (x.matches) { // If media query matches
        document.getElementById("mySidenav").style.paddingTop = "150px";
    } else {
        document.getElementById("mySidenav").style.paddingTop = "100px";
    }
}

var x = window.matchMedia("(max-width: 768px)")
myFunction(x) // Call listener function at run time
x.addListener(myFunction) // Attach listener function on state changes