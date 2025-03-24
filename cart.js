function qtyChangeCart(x) {
    var qty = document.getElementById("qty" + x);
    var qtyview = document.getElementById("qtyview" + x);
    var totalpriceboxID = document.getElementById("totalpriceboxID");
    if (qty.value < 1) {
        qty.value = 1;
    }
    qtyview.innerHTML = qty.value;
    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            totalpriceboxID.innerHTML = text;
        }
    };
    req.open("POST", "cartqtyChange.php", true);
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req.send("pid=" + x + "&qty=" + qty.value);
}

function removeFromCart(x) {
    var contetboxID = document.getElementById("contetboxID");
    var form = new FormData();

    form.append("pid", x);
    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;

            contetboxID.innerHTML = text;


        }
    };
    req.open("POST", "removecart.php", true);
    req.send(form);
}

function caheckoutcart(x) {
    // alert(x)
    var qty = document.getElementById("qty" + x).value;
    window.location = "cheackout.php?pid=" + x + "&q=" + qty;

}

function myFunction(x) {
    var bt = document.getElementsByClassName("wishbtn");

    if (x.matches) { // If media query matches


        for (var i = 0; i < bt.length; i++) {
            document.getElementById("wishbtnID" + i).innerHTML = '<i class="icofont-heart"></i> ';
            document.getElementById("removebtnID" + i).innerHTML = '<i class="icofont-bin"></i> ';
        }

        // document.body.style.backgroundColor = "yellow";
    } else {
        for (var i = 0; i < bt.length; i++) {

            document.getElementById("wishbtnID" + i).innerHTML = '<i class="icofont-heart"></i> Wishlist';
            document.getElementById("removebtnID" + i).innerHTML = '<i class="icofont-bin"></i> Remove';
            // document.body.style.backgroundColor = "pink";
        }
    }
}

var x = window.matchMedia("(max-width: 600px)")
myFunction(x) // Call listener function at run time
x.addListener(myFunction) // Attach listener function on state changes

function gocheackout() {
    window.location = "cheackoutCart.php";
}