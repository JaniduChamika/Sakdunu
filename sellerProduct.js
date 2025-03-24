function addProdcutModel() {
    var addproductModelID = document.getElementById("addproductModelID");
    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            addproductModelID.innerHTML = text;

        }
    };
    req.open("POST", "selladdproModel.php", true);
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req.send();
}

function updateProdcutModel(pid) {
    var proupmodelcontentID = document.getElementById("proupmodelcontentID");

    var form = new FormData();
    form.append("pid", pid);
    form.append("from", "table");
    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text)

            proupmodelcontentID.innerHTML = text;



        }
    };
    req.open("POST", "selupproModel.php", true);
    req.send(form);
}

function updateProdcutModelview(pid) {
    var proupviewModelconID = document.getElementById("proupviewModelconID");

    var form = new FormData();
    form.append("pid", pid);
    form.append("from", "view");

    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text)

            proupviewModelconID.innerHTML = text;

        }
    };
    req.open("POST", "selupproModel.php", true);
    req.send(form);
}
var mod;

function shownewStockModal(pid) {
    var newstock = document.getElementById("addnewStockMadal");
    mod = new bootstrap.Modal(newstock);
    mod.show();

    var newStockaddbtn = document.getElementById("newStockaddbtn");
    newStockaddbtn.setAttribute("onclick", "addnewStock(" + pid + ")");
}



function addnewStock(pid) {
    var qty = document.getElementById("Nstockqtyup");
    var price = document.getElementById("Nstockpriceup");
    var exdate = document.getElementById("Nstockexdate");
    var form = new FormData();
    form.append("pid", pid);
    form.append("qty", qty.value);
    form.append("price", price.value);
    form.append("exdate", exdate.value);

    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text);
            if (text == "success") {
                qty.value = "";
                price.value = "";
                exdate.value =
                    mod.hide();
                tost('New stock added successfull');

            } else {
                tostdangerpro('' + text + '');

            }

        }
    };
    req.open("POST", "addNewStock.php", true);
    req.send(form);
}

function shownewStockModalveiw(pid) {
    var newstock = document.getElementById("addnewStockMadal2");
    mod = new bootstrap.Modal(newstock);
    mod.show();

    var newStockaddbtn = document.getElementById("newStockaddbtn2");
    newStockaddbtn.setAttribute("onclick", "addnewStock2(" + pid + ")");
}

function addnewStock2(pid) {
    var qty = document.getElementById("Nstockqtyup2");
    var price = document.getElementById("Nstockpriceup2");
    var exdate = document.getElementById("Nstockexdate2");
    var form = new FormData();
    form.append("pid", pid);
    form.append("qty", qty.value);
    form.append("price", price.value);
    form.append("exdate", exdate.value);

    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text);
            if (text == "success") {
                qty.value = "";
                price.value = "";
                exdate.value = "";
                mod.hide();
                tost('New stock added successfull');

            } else {
                tostdangerpro('' + text + '');

            }

        }
    };
    req.open("POST", "addNewStock.php", true);
    req.send(form);
}

function permentdeletModal(pid) {
    var delpropermentModal = document.getElementById("delpropermentModal");
    var permanetdeleteBtn = document.getElementById("permanetdeleteBtn")
    mod = new bootstrap.Modal(delpropermentModal);
    mod.show();
    permanetdeleteBtn.setAttribute("onclick", "permentDelete(" + pid + ")");
}

function permentDelete(pid) {
    var form = new FormData();

    form.append("pid", pid);

    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text);
            if (text == "success") {
                mod.hide();

                recyclebin(1);
            } else {
                mod.hide();

                tostdangerpro('' + text + '');
            }

        }
    };
    req.open("POST", "productDelete.php", true);
    req.send(form);
}

function exdateupdateModal(pid) {
    var exdatModal = document.getElementById("exdatechangeModal");
    mod = new bootstrap.Modal(exdatModal)
    mod.show();
    var exdateBtn = document.getElementById("exdateBtn");
    exdateBtn.setAttribute("onclick", "exdateUpdate(" + pid + ")");

}

function exdateUpdate(pid) {
    var updateexdateID = document.getElementById("updateexdateID");

    var form = new FormData();
    form.append("pid", pid);
    form.append("exdate", updateexdateID.value);

    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text);
            if (text == "success") {
                updateexdateID.value = "";
                mod.hide();
                expiredpro(1);
                tost('New stock added successfull');

            } else {
                tostdangerpro('' + text + '');

            }

        }
    };
    req.open("POST", "exdatechange.php", true);
    req.send(form);

}

function getbrandfortavle(what) {

    var sel
    if (what == "table") {
        cater = document.getElementById("cateproid");

        sel = document.getElementById("sel");

    } else {
        cater = document.getElementById("cateproid2");

        sel = document.getElementById("sel2");

    }
    sel.value = "All"
    var form = new FormData();
    form.append("c", cater.value);


    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            sel.innerHTML = text;

        }
    };
    req.open("POST", "getBrandfortable.php", true);
    req.send(form);
}

function tostdangerpro(content) {

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

function tost(content) {

    var boxnoteID = document.getElementById("boxnoteID");

    var mdiv = document.createElement("div");
    mdiv.className = "toast liveToast text-white bg-primary border-0";
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