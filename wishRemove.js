function wishremove(x) {
    var boxwishcard = document.getElementById("boxwishcard");

    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            boxwishcard.innerHTML = text


        }
    };
    req.open("POST", "wishRemove.php", true);
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req.send("pid=" + x);
}