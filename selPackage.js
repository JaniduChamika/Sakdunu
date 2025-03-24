function goPackageTab() {
    var packagetab = document.getElementById("packageTabBoxID");
    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            packagetab.innerHTML = text;

        }
    };
    req.open("POST", "sellPackageTab.php", true);
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req.send();
}


function addPackage(x) {
    var packaddbtn = document.getElementById("packaddbtn" + x);


    if (packaddbtn.classList[5] != "addedpack") {


        var req = new XMLHttpRequest();
        req.onreadystatechange = function() {
            if (req.readyState == 4) {
                var text = req.responseText;
                // alert(text)
                if (text == "success") {
                    packaddbtn.innerHTML = '<i class="icofont-check-circled"></i>';
                    packaddbtn.classList.remove("bluco");

                    packaddbtn.classList.add("addedpack");
                    // countSelect();

                } else {
                    // alert(text)
                    tostdanger('' + text + '');
                }

            }
        };
        req.open("GET", "selAddRemovePackProduct.php?pid=" + x + "&for=save" + "&pack=" + packaddbtn.value, true);
        req.send();

    } else {



        var req = new XMLHttpRequest();
        req.onreadystatechange = function() {
            if (req.readyState == 4) {
                var text = req.responseText;
                // alert(text)
                if (text == "success") {
                    packaddbtn.innerHTML = '<i class="icofont-plus"></i>';
                    packaddbtn.classList.remove("addedpack");
                    packaddbtn.classList.add("bluco");

                    // countSelect();

                } else {
                    // alert(text)
                    tostdanger('' + text + '');

                }
            }
        };
        req.open("GET", "selAddRemovePackProduct.php?pid=" + x + "&for=remove" + "&pack=" + packaddbtn.value, true);
        req.send();
    }

}

function removeProductPack(x) {
    var packaddbtn = document.getElementById("PackProductID" + x);
    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            if (text == "success") {
                VeiwOffcanvasPackage(packaddbtn.value);

            } else {
                // alert(text);
                tostdanger('' + text + '');

            }
        }
    };
    req.open("GET", "selAddRemovePackProduct.php?pid=" + x + "&for=remove" + "&pack=" + packaddbtn.value, true);
    req.send();
}
// change count selected
// function countSelect() {
// var clsgetSeleced = document.getElementsByClassName("addedpack");
// selectedTag.innerHTML = "Selected &nbsp;(" + clsgetSeleced.length + ")";
// }



function createPackage() {
    var packNameID = document.getElementById("packNameID");
    var packStartDate = document.getElementById("packStartDate");
    var packEndDate = document.getElementById("packEndDate");
    var packDiscount = document.getElementById("packDiscount");
    var imagepackID = document.getElementById("imagepackID");

    var form = new FormData();
    form.append("name", packNameID.value);
    form.append("start", packStartDate.value);
    form.append("end", packEndDate.value);
    form.append("dis", packDiscount.value);
    form.append("img", imagepackID.files[0]);
    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;

            if (text == "success") {
                packNameID.value = "";
                packStartDate.value = "";
                packEndDate.value = "";
                packDiscount.value = "";
                goPackageTab();
                tost('Package created successfull');

            } else {
                // alert(text);
                tostdanger('' + text + '');

            }
        }
    };
    req.open("POST", "selCreatePackage.php", true);
    req.send(form);
}

function imgveiwpackage() {

    $('input[type="file"]').each(function() {

        var $file = $(this),
            $label = $file.next('label'),
            $labelText = $label.find('span'),
            labelDefault = $labelText.text();


        var fileName = $file.val().split('\\').pop(),
            tmppath = URL.createObjectURL(event.target.files[0]);

        if (fileName) {
            $label
                .addClass('file-ok')
                .css('background-image', 'url(' + tmppath + ')');
            // $labelText.text(fileName);
        } else {
            $label.removeClass('file-ok');
            $labelText.text(labelDefault);
        }


    });

}

function packageGet() {
    var packageCardBoxID = document.getElementById("packageCardBoxID");
    var form = new FormData();
    form.append("what", "view")
    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            packageCardBoxID.innerHTML = text;
        }
    };
    req.open("POST", "selPackageCardGet.php", true);
    req.send(form);
}

function clearField() {
    var creatPackBtnID = document.getElementById("creatPackBtnID");
    var updatePackBtnID = document.getElementById("updatePackBtnID");
    var labelpImagepack = document.getElementById("labelpImagepack");
    var packNameID = document.getElementById("packNameID");
    var packStartDate = document.getElementById("packStartDate");
    var packEndDate = document.getElementById("packEndDate");
    var packDiscount = document.getElementById("packDiscount");
    packNameID.value = "";
    packStartDate.value = "";
    packEndDate.value = "";
    packDiscount.value = "";
    labelpImagepack.style.backgroundImage = "url('cssfile//appimg//default2.jpg')";
    creatPackBtnID.classList.remove("d-none");
    updatePackBtnID.classList.add("d-none");
}

function getPackageDetails(x) {
    var creatPackBtnID = document.getElementById("creatPackBtnID");
    var updatePackBtnID = document.getElementById("updatePackBtnID");


    var packNameID = document.getElementById("packNameID");
    var packStartDate = document.getElementById("packStartDate");
    var packEndDate = document.getElementById("packEndDate");
    var packDiscount = document.getElementById("packDiscount");
    var labelpImagepack = document.getElementById("labelpImagepack");
    var form = new FormData();
    form.append("what", "getvalue");
    form.append("packID", x);

    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {

            var text = req.responseText;
            // alert(text);

            var j = JSON.parse(text);

            packNameID.value = j["pack_name"];
            packStartDate.value = j["strat_date"];
            packEndDate.value = j["end_date"];
            packDiscount.value = j["discount"];
            labelpImagepack.style.backgroundImage = "url('" + j["img"] + "')";
            // alert(j.i)
            // alert(labelpImagepack.style.backgroundImage);


            updatePackBtnID.setAttribute('onclick', 'UpdatePackage(' + x + ')')
            updatePackBtnID.classList.remove("d-none");
            creatPackBtnID.classList.add("d-none");

        }
    };
    req.open("POST", "selPackageCardGet.php", true);
    req.send(form);
}

function UpdatePackage(x) {

    // alert(x)
    var packNameID = document.getElementById("packNameID");
    var packStartDate = document.getElementById("packStartDate");
    var packEndDate = document.getElementById("packEndDate");
    var packDiscount = document.getElementById("packDiscount");
    var imagepackID = document.getElementById("imagepackID");

    var form = new FormData();
    form.append("packID", x);

    form.append("name", packNameID.value);
    form.append("start", packStartDate.value);
    form.append("end", packEndDate.value);
    form.append("dis", packDiscount.value);
    form.append("img", imagepackID.files[0]);
    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;

            if (text == "success") {
                packNameID.value = "";
                packStartDate.value = "";
                packEndDate.value = "";
                packDiscount.value = "";
                imagepackID.value = "";
                goPackageTab();
                // alert(text);
                tost('Package updated successfull');

            } else {
                // alert(text);
                tostdanger('' + text + '');

            }
        }
    };
    req.open("POST", "selUpdatePackage.php", true);
    req.send(form);

}
// modal view and get
function addPackageModel(x) {


    var myModal = new bootstrap.Modal(document.getElementById('addProductPackageModel'))
    myModal.show();
    // countSelect();


}
var bsOffcanvas;

function VeiwOffcanvasPackage(x) {


    var offcanvasToppackage = document.getElementById("offcanvasToppackage");
    var form = new FormData();
    form.append("packId", x);
    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {

            var text = req.responseText;
            if (text == "Something Wrong") {

            } else {
                offcanvasToppackage.innerHTML = text;
                var myOffcanvas = document.getElementById('offcanvasToppackage')
                bsOffcanvas = new bootstrap.Offcanvas(myOffcanvas)
                bsOffcanvas.show();
            }

        }
    };
    req.open("POST", "selPackageOffcanvce.php", true);
    req.send(form);

}

function closeOffacnvas() {
    bsOffcanvas.hide();
    goPackageTab();

}

function getPackProduct(page, id) {

    var prodcutViewPackage = document.getElementById("prodcutViewPackage");
    // var prosearchFroPackBtn = document.getElementById("prosearchFroPackBtn");
    var cate = document.getElementById("categoryselectID");
    var titletag = document.getElementById("titletag");
    var form = new FormData();
    form.append("page", page);
    form.append("c", cate.value);
    form.append("t", titletag.value);
    form.append("packId", id);

    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {

            var text = req.responseText;
            if (text == "Something Wrong") {

            } else {
                prodcutViewPackage.innerHTML = text;
            }

        }
    };
    req.open("POST", "selPackAddProductGet.php", true);
    req.send(form);
}

function sizechange() {
    var packDiscount = document.getElementById("packDiscount");

    if (packDiscount.value < 0) {
        packDiscount.value = 0;
    }

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