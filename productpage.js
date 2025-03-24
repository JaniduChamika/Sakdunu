function cheackout(x) {
    var qty = document.getElementById("qtyID").value;
    window.location = "cheackout.php?pid=" + x + "&q=" + qty;

}

function qtyChange() {
    var qty = document.getElementById("qtyID");

    if (qty.value < 1) {
        qty.value = 1;
    }

}

function addCart(x) {
    var qty = document.getElementById("qtyID");

    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text);

            if (text == "success") {
                msgtost('Product Added Successfull. See Your Cart');
                // window.location = "cart.php";
            } else {
                tostdanger('' + text + '');


            }
        }
    };
    req.open("POST", "addcart.php", true);
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req.send("pid=" + x + "&qty=" + qty.value);

}

function wishlist(x) {
    var wishicon = document.getElementById("wishicon");
    var status = wishicon.classList.toggle("wishactive");
    wishicon.classList.toggle("wishactive");
    // alert(status)

    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;


            if (text == "success") {
                wishicon.classList.toggle("wishactive");


            } else {
                tostdanger('' + text + '');

            }
        }
    };
    req.open("GET", "addWishlist.php?pid=" + x + "&status=" + status, true);
    req.send();


}

function tostdanger(content) {

    var boxnoteID = document.getElementById("boxnoteID");

    var mdiv = document.createElement("div");
    mdiv.className = "toast liveToast text-white bg-danger border-0";
    mdiv.setAttribute("role", "alert");
    mdiv.setAttribute("aria-live", "assertive");
    mdiv.setAttribute("aria-atomic", "true");
    mdiv.setAttribute("id", "liveToast");
    var div2 = document.createElement("div");
    div2.className = "d-flex";
    var divb = document.createElement("div");
    divb.className = "toast-body fs-6";
    divb.innerHTML = content;

    var btn = document.createElement("button");
    btn.innerHTML = '<i class="icofont-close-line"></i>';
    btn.className = "btn-close text-white d-flex me-2 m-auto";
    btn.setAttribute("type", "button");
    btn.setAttribute("data-bs-dismiss", "toast");
    btn.setAttribute("aria-label", "Close");

    div2.appendChild(divb);
    div2.appendChild(btn);
    mdiv.appendChild(div2);
    boxnoteID.appendChild(mdiv);

    var toastLiveExample2 = document.getElementsByClassName('liveToast')

    var c = toastLiveExample2.length;
    for (var x = 0; x < c; x++) {

        var toast = new bootstrap.Toast(toastLiveExample2[x])
        toast.show()

    }
    setTimeout(function() {
        document.getElementById("boxnoteID").firstElementChild.remove();
    }, 5000)


}


function msgtost(content) {

    var boxnoteID = document.getElementById("boxnoteID");

    var mdiv = document.createElement("div");
    mdiv.className = "toast liveToast me-2";
    mdiv.setAttribute("role", "alert");
    mdiv.setAttribute("aria-live", "assertive");
    mdiv.setAttribute("aria-atomic", "true");
    mdiv.setAttribute("id", "liveToast");


    var divh = document.createElement("div");
    divh.className = "toast-header mshmyhead p-1 ps-2 pe-2";

    var top = document.createElement("strong");
    top.className = "me-auto";
    top.innerHTML = "Sakdunu Super";
    var img = document.createElement("img");
    img.className = "me-2 msgclz";
    img.setAttribute("src", "cssfile//baclogoimg//logo2.png")
    var cbtn = document.createElement("button");
    cbtn.className = "btn-close p-0";
    cbtn.setAttribute("type", "button");
    cbtn.setAttribute("data-bs-dismiss", "toast");
    cbtn.setAttribute("aria-label", "Close");
    cbtn.innerHTML = '<i class="icofont-close"></i>';
    divb = document.createElement("div");
    divb.className = "toast-body bg-light bodyfon p-2 ";
    divb.innerHTML = content;
    var brak = document.createElement("br");
    var seebtn = document.createElement("a");
    seebtn.className = "btn btn-primary btn-sm";
    seebtn.innerHTML = "See Cart";
    seebtn.href = "cart.php";
    divb.appendChild(brak);

    divb.appendChild(seebtn);
    divh.appendChild(img);
    divh.appendChild(top);
    divh.appendChild(cbtn);
    mdiv.appendChild(divh);
    mdiv.appendChild(divb);

    boxnoteID.appendChild(mdiv);


    var toastLiveExample2 = document.getElementsByClassName('liveToast')

    var c = toastLiveExample2.length;
    for (var x = 0; x < c; x++) {

        var toast = new bootstrap.Toast(toastLiveExample2[x])
        toast.show()

    }
    setTimeout(function() {
        document.getElementById("boxnoteID").firstElementChild.remove();
    }, 5000)


}