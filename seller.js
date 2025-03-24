function addProduct() {
    var maintag = document.getElementById("maincoterid");
    var subtag = document.getElementById("subcaterId");

    var brandtag = document.getElementById("inbrand");
    var modeltag = document.getElementById("inmodel");
    var titletag = document.getElementById("intitle");

    var qtytag = document.getElementById("inqty");
    var descriptiontag = document.getElementById("indes");
    var pricetag = document.getElementById("inprice");
    var image = document.getElementById("pImage");
    var imageveiwtag = document.getElementById("labelpImage");
    var name = document.getElementById("filenameview");

    var ex = document.getElementById("exdate");
    // alert("ok");

    var form = new FormData();
    form.append("main", maintag.value);
    form.append("sub", subtag.value);
    form.append("b", brandtag.value);
    form.append("m", modeltag.value);
    form.append("t", titletag.value);

    form.append("q", qtytag.value);
    form.append("de", descriptiontag.value);
    form.append("p", pricetag.value);
    form.append("ex", ex.value);

    form.append("img", image.files[0]);

    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {

        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text);
            if (text == "succes") {
                brandtag.value = "none";
                modeltag.value = "";
                titletag.value = "";
                qtytag.value = "";
                descriptiontag.value = "";
                pricetag.value = "";
                image.value = "";
                imageveiwtag.style.backgroundImage = "url('cssfile//appimg//default2.jpg')";
                name.innerHTML = "";
                maintag.value = "none";
                subtag.value = "none";
                ex.value = "";
                searchtable(1);
                tost('Product Added Successfull');

            } else if (text == "m1") {

                maintag.style.border = "solid 2px red";
            } else if (text == "s2") {
                subtag.style.border = "solid 2px red";

            } else if (text == "b3") {
                brandtag.style.border = "solid 2px red";

            } else if (text == "mo4") {
                modeltag.style.border = "solid 2px red";

            } else if (text == "q5") {
                qtytag.style.border = "solid 2px red";

            } else if (text == "p6") {
                pricetag.style.border = "solid 2px red";

            } else if (text == "de7") {
                descriptiontag.style.border = "solid 2px red";

            } else if (text == "i8") {
                imageveiwtag.style.border = "solid 2px red";

            } else if (text == "title") {
                titletag.style.border = "solid 2px red";

            } else {
                tostdanger('' + text + '');
            }



        }
    };
    req.open("POST", "productAdd.php", true);
    req.send(form);
}



function imgveiw() {

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

function imgveiwupdate() {

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

function modeladdclose() {
    var maintag = document.getElementById("maincoterid");
    var subtag = document.getElementById("subcaterId");
    var brandtag = document.getElementById("inbrand");
    var modeltag = document.getElementById("inmodel");
    var qtytag = document.getElementById("inqty");
    var descriptiontag = document.getElementById("indes");
    var pricetag = document.getElementById("inprice");
    var image = document.getElementById("pImage");
    var imageveiwtag = document.getElementById("labelpImage");
    var name = document.getElementById("filenameview");
    brandtag.value = "none";
    modeltag.value = "";
    qtytag.value = "";
    descriptiontag.value = "";
    pricetag.value = "";
    image.value = "";
    imageveiwtag.src = "cssfile//appimg//default2.jpg";
    name.innerHTML = "";
    maintag.value = "none";
    subtag.value = "none";
}

function updateProduct(pid) {
    var maintag = document.getElementById("updatemaincoterid");
    var subtag = document.getElementById("updatesubcaterId");

    var brandtag = document.getElementById("updateinbrand");
    var modeltag = document.getElementById("modelup");
    var titletag = document.getElementById("titleup");

    var qtytag = document.getElementById("qtyup");
    var descriptiontag = document.getElementById("desup");
    var pricetag = document.getElementById("priceup");
    var image = document.getElementById("pImageupdate");
    var imageveiwtag = document.getElementById("labelpImageupdate");
    var name = document.getElementById("updatefilenameview");
    var exdate = document.getElementById("exdateupd");

    // cancel button 
    var cancelbtn = document.getElementById("updatecancel");

    // alert("ok");

    var imgsrc = imageveiwtag.src;



    var form = new FormData();
    form.append("main", maintag.value);
    form.append("sub", subtag.value);

    form.append("b", brandtag.value);
    form.append("m", modeltag.value);
    form.append("t", titletag.value);

    form.append("q", qtytag.value);
    form.append("de", descriptiontag.value);
    form.append("p", pricetag.value);
    form.append("img", image.files[0]);
    form.append("srcimag", imgsrc);
    form.append("pid", pid);
    form.append("exdate", exdate.value)

    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {

        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text)
            if (text == "succes") {
                maintag.value = "none";
                subtag.value = "none";
                brandtag.value = "none";
                modeltag.value = "";
                qtytag.value = "";
                descriptiontag.value = "";
                pricetag.value = "";
                image.value = "";
                imageveiwtag.style.backgroundImage = "url('cssfile//appimg//default2.jpg')";
                name.innerHTML = "";
                cancelbtn.click();
                searchtable(1);
                tost('Product Updated Successfull');

            } else if (text == "m1") {

                maintag.style.border = "solid 2px red";
            } else if (text == "s2") {
                subtag.style.border = "solid 2px red";

            } else if (text == "b3") {
                brandtag.style.border = "solid 2px red";

            } else if (text == "mo4") {
                modeltag.style.border = "solid 2px red";

            } else if (text == "q5") {
                qtytag.style.border = "solid 2px red";

            } else if (text == "p6") {
                pricetag.style.border = "solid 2px red";

            } else if (text == "de7") {
                descriptiontag.style.border = "solid 2px red";

            } else if (text == "title") {
                titletag.style.border = "solid 2px red";

            } else {
                tostdanger('' + text + '');
            }


        }
    };
    req.open("POST", "productupdate.php", true);
    req.send(form);
}

function updateProduct2(pid) {


    var maintag = document.getElementById("updatemaincoterid2");
    var subtag = document.getElementById("updatesubcaterId2");

    var brandtag = document.getElementById("updateinbrand2");
    var modeltag = document.getElementById("modelup2");
    var titletag = document.getElementById("titleup2");

    var qtytag = document.getElementById("qtyup2");
    var descriptiontag = document.getElementById("desup2");
    var pricetag = document.getElementById("priceup2");
    var image = document.getElementById("pImageupdate2");
    var imageveiwtag = document.getElementById("imgviewupdate2");
    var name = document.getElementById("updatefilenameview2");
    var exdate = document.getElementById("exdateupd2");

    // cancel button 
    var cancelbtn = document.getElementById("updatecancel2");

    // alert("ok");

    var imgsrc = imageveiwtag.src;

    var form = new FormData();
    form.append("main", maintag.value);
    form.append("sub", subtag.value);

    form.append("b", brandtag.value);
    form.append("m", modeltag.value);
    form.append("t", titletag.value);

    form.append("q", qtytag.value);
    form.append("de", descriptiontag.value);
    form.append("p", pricetag.value);
    form.append("img", image.files[0]);
    form.append("srcimag", imgsrc);
    form.append("pid", pid);
    form.append("exdate", exdate.value);



    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {

        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text)
            if (text == "succes") {
                maintag.value = "none";
                subtag.value = "none";
                brandtag.value = "none";
                modeltag.value = "";
                titletag.value = "";
                qtytag.value = "";
                descriptiontag.value = "";
                pricetag.value = "";
                image.value = "";
                imageveiwtag.style.backgroundImage = "url('cssfile//appimg//default2.jpg')";
                name.innerHTML = "";
                cancelbtn.click();
                searchtableveiw(1);
                tost('Product Updated Successfull');

            } else if (text == "m1") {

                maintag.style.border = "solid 2px red";
            } else if (text == "s2") {
                subtag.style.border = "solid 2px red";

            } else if (text == "b3") {
                brandtag.style.border = "solid 2px red";

            } else if (text == "mo4") {
                modeltag.style.border = "solid 2px red";

            } else if (text == "q5") {
                qtytag.style.border = "solid 2px red";

            } else if (text == "p6") {
                pricetag.style.border = "solid 2px red";

            } else if (text == "de7") {
                descriptiontag.style.border = "solid 2px red";

            } else if (text == "title") {
                titletag.style.border = "solid 2px red";

            } else {
                tostdanger('' + text + '');
            }


        }
    };
    req.open("POST", "productupdate.php", true);
    req.send(form);
}

function imgveiwupdate2() {

    var imageveiwtag = document.getElementById("imgviewupdate2");
    var image = document.getElementById("pImageupdate2");
    // var name = document.getElementById("updatefilenameview2");
    image.onchange = function() {
        var file = this.files[0];
        var url = window.URL.createObjectURL(file);
        imageveiwtag.style.backgroundImage = "url('" + url + "')";
    }


}

function errorclear(y) {
    var tag = document.getElementById(y);

    tag.style.border = "solid 1px rgba(72, 72, 72, 0.367)";

}

function errorclearupdate(y) {

    var maintag = document.getElementById("updatemaincoterid");
    var subtag = document.getElementById("updatesubcaterId");

    var brandtag = document.getElementById("updateinbrand");
    var modeltag = document.getElementById("modelup");
    var qtytag = document.getElementById("qtyup");
    var descriptiontag = document.getElementById("desup");
    var pricetag = document.getElementById("priceup");
    var imageveiwtag = document.getElementById("labelpImageupdate");

    if (y == 1) {
        maintag.style.border = "solid 1px rgba(72, 72, 72, 0.367)";
    }
    if (y == 2) {
        subtag.style.border = "solid 1px rgba(72, 72, 72, 0.367)";
    }
    if (y == 3) {
        brandtag.style.border = "solid 1px rgba(72, 72, 72, 0.367)";
    }
    if (y == 4) {
        modeltag.style.border = "solid 1px rgba(72, 72, 72, 0.367)";
    }
    if (y == 5) {
        qtytag.style.border = "solid 1px rgba(72, 72, 72, 0.367)";
    }
    if (y == 6) {
        pricetag.style.border = "solid 1px rgba(72, 72, 72, 0.367)";
    }
    if (y == 7) {
        descriptiontag.style.border = "solid 1px rgba(72, 72, 72, 0.367)";
    }
    if (y == 8) {
        imageveiwtag.style.border = "solid 1px rgba(72, 72, 72, 0.367)";
    }
}

function errorclearupdate2(y) {

    var maintag = document.getElementById("updatemaincoterid2");
    var subtag = document.getElementById("updatesubcaterId2");

    var brandtag = document.getElementById("updateinbrand2");
    var modeltag = document.getElementById("modelup2");
    var qtytag = document.getElementById("qtyup2");
    var descriptiontag = document.getElementById("desup2");
    var pricetag = document.getElementById("priceup2");
    var imageveiwtag = document.getElementById("imgviewupdate2");

    if (y == 1) {
        maintag.style.border = "solid 1px rgba(72, 72, 72, 0.367)";
    }
    if (y == 2) {
        subtag.style.border = "solid 1px rgba(72, 72, 72, 0.367)";
    }
    if (y == 3) {
        brandtag.style.border = "solid 1px rgba(72, 72, 72, 0.367)";
    }
    if (y == 4) {
        modeltag.style.border = "solid 1px rgba(72, 72, 72, 0.367)";
    }
    if (y == 5) {
        qtytag.style.border = "solid 1px rgba(72, 72, 72, 0.367)";
    }
    if (y == 6) {
        pricetag.style.border = "solid 1px rgba(72, 72, 72, 0.367)";
    }
    if (y == 7) {
        descriptiontag.style.border = "solid 1px rgba(72, 72, 72, 0.367)";
    }
    if (y == 8) {
        imageveiwtag.style.border = "solid 1px rgba(72, 72, 72, 0.367)";
    }
}

function searchtable(x) {

    var tablebox = document.getElementById("tablebox");
    var serchtag = document.getElementById("sech");
    var selecttag = document.getElementById("sel");
    var cater = document.getElementById("cateproid");
    var sortid = document.getElementById("sortid");

    var form = new FormData();
    form.append("s", serchtag.value);
    form.append("bid", selecttag.value);
    form.append("cate", cater.value);
    form.append("sort", sortid.value);


    form.append("p", x);

    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            tablebox.innerHTML = text;


        }
    };
    req.open("POST", "productsearch.php", true);
    req.send(form);
}


// function searchtableselect(x) {
//     var table = document.getElementById("veiwtable");
//     var selecttag = document.getElementById("sel");
//     search = selecttag.value;
//     var form = new FormData();
//     form.append("bid", search);
//     var req = new XMLHttpRequest();
//     req.onreadystatechange = function() {
//         if (req.readyState == 4) {
//             var text = req.responseText;
//             table.innerHTML = text;


//         }
//     };
//     req.open("POST", "productbrandselect.php", true);
//     req.send(form);
// }

function searchtableveiw(x) {
    // nextprv2 = x;
    var box = document.getElementById("cardviewboxID");
    var serchtag = document.getElementById("sech2");
    var selecttag = document.getElementById("sel2");
    var cateproid2 = document.getElementById("cateproid2");
    var sortid = document.getElementById("sortid2");

    var form = new FormData();
    form.append("s", serchtag.value);
    form.append("bid", selecttag.value);
    form.append("c", cateproid2.value);
    form.append("sort", sortid.value);

    form.append("p", x);

    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            box.innerHTML = text;


        }
    };
    req.open("POST", "productsearchview.php", true);
    req.send(form);
}

// function searchtableselectveiw(x) {
//     var table = document.getElementById("cardboxid");
//     var selecttag = document.getElementById("sel2");
//     search = selecttag.value;
//     var form = new FormData();
//     form.append("bid", search);
//     var req = new XMLHttpRequest();
//     req.onreadystatechange = function() {
//         if (req.readyState == 4) {
//             var text = req.responseText;
//             table.innerHTML = text;


//         }
//     };
//     req.open("POST", "productserchselcteview.php", true);
//     req.send(form);
// }

// function movebin(id) {
//     var combtn = document.getElementById("movebincomfirmId");
//     combtn.setAttribute('onclick', 'comfirmmovebin(' + id + ');');
// }

function comfirmmovebin(id) {
    var cancel = document.getElementById("cancelcomfimid");

    var form = new FormData();
    form.append("pid", id);
    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text);
            if (text == "succes") {
                searchtable(1);
                cancel.click();
            }


        }
    };
    req.open("POST", "productmovebin.php", true);
    req.send(form);
}

// function movebinveiw(id) {
//     var combtn = document.getElementById("movebincomfirmIdveiw");
//     combtn.setAttribute('onclick', 'comfirmmovebinview(' + id + ');');
// }

function comfirmmovebinview(id) {
    // alert(text);

    var cancel = document.getElementById("cancelcomfirmveiw");

    var form = new FormData();
    form.append("pid", id);
    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            if (text == "succes") {

                searchtableveiw(1);
                cancel.click();
            }


        }
    };
    req.open("POST", "productmovebin.php", true);
    req.send(form);
}

// catergory add input animation
var k = 0;
var z = 0;
var t = 0;

function addbtndis(y) {
    var divadd = document.getElementById("addsubcotergorydivID");
    var divadd2 = document.getElementById("addcotergorydivID");
    var divadd3 = document.getElementById("addbranddivID");
    divadd2.style.display = "none";
    divadd.style.display = "none";
    divadd3.style.display = "none";
    var inp1 = document.getElementById("newcatergoryID");
    var inp2 = document.getElementById("newsubcatergoryID");
    var inp3 = document.getElementById("newbrandID");
    sel = document.getElementById("selcatergoryID");

    inp1.value = "";
    inp2.value = "";
    inp3.value = "";
    inp1.style.border = "";
    inp2.style.border = "";
    inp3.style.border = "";
    sel.style.border = "";
    sel.value = "none";

    if (y == 2) {


        if (k % 2 == 0) {
            divadd.style.display = "flex";


        }
        k++;
        z = 0;
        t = 0;
    }
    if (y == 1) {


        if (z % 2 == 0) {
            divadd2.style.display = "flex";


        }
        z++;
        k = 0;
        t = 0;
    }
    if (y == 3) {


        if (t % 2 == 0) {
            divadd3.style.display = "flex";


        }
        t++;
        k = 0;
        z = 0;
    }
}

function addcater(nu) {


    var inp = document.getElementById("newcatergoryID");
    var img = document.getElementById("addcatermgID");
    var labelpImageAdva = document.getElementById("labelpImageAdva");
    labelpImageAdva.style.border = "";
    inp.style.border = "";

    var form = new FormData();
    form.append("inp", inp.value);
    form.append("n", nu);
    form.append("img", img.files[0]);

    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text);

            if (text == "succes") {
                inp.value = "";
                advanceview();
                tost('Category Added Successfull');


            } else if (text == "Please Type in text filed") {
                inp.style.border = "solid 2px red";

            } else if (text == "Please Select an Image") {

                labelpImageAdva.style.border = "solid 2px red";
            } else {
                tostdanger('' + text + '');

            }
        }
    };
    req.open("POST", "advanceseller.php", true);
    req.send(form);
}

function addsubcater(nu) {
    var inp = document.getElementById("newsubcatergoryID");
    var sel = document.getElementById("selcatergoryID");
    inp.style.border = "";
    sel.style.border = "";
    var form = new FormData();
    form.append("inp", inp.value);
    form.append("n", nu);
    form.append("sel", sel.value);
    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text);
            if (text == "succes") {
                inp.value = "";
                advanceview();

                tost('Sub Category Added Successfull');

            } else if (text == "Select Main Category") {
                sel.style.border = "solid 2px red";
            } else if (text == "Please Type in text filed") {
                inp.style.border = "solid 2px red";

            } else {
                tostdanger('' + text + '');

            }
        }
    };
    req.open("POST", "advanceseller.php", true);
    req.send(form);
}

function addbrand(nu) {
    var inp = document.getElementById("newbrandID");
    var selcatergoryrobrand = document.getElementById("selcatergoryrobrand");
    var box = document.getElementById("subcaterBox");
    inp.style.border = "";
    selcatergoryrobrand.style.border = "";
    box.style.border = "";

    var form = new FormData();

    var subchecked = document.getElementsByClassName("subchecked");
    var no = 0;

    if (selcatergoryrobrand.value != "none") {
        for (var i = 0; i < subchecked.length; i++) {
            if (subchecked[i].checked == true) {
                form.append("sub" + no, subchecked[i].value);
                no++

            }

        }
        // alert(no);

        form.append("inp", inp.value);
        form.append("n", nu);
        form.append("sel", selcatergoryrobrand.value);
        form.append("len", no);
        var req = new XMLHttpRequest();
        req.onreadystatechange = function() {
            if (req.readyState == 4) {
                var text = req.responseText;
                // alert(text);
                if (text == "succes") {
                    selcatergoryrobrand.value = "none";
                    inp.value = "";

                    advanceview();
                    tost('Brand Added Successfull');


                } else if (text == "Select Main Category") {
                    selcatergoryrobrand.style.border = "solid 2px red";
                } else if (text == "Please Type in text filed") {
                    inp.style.border = "solid 2px red";

                } else if (text == "Please Select sub category") {
                    box.style.border = "solid 2px red";
                } else {
                    tostdanger('' + text + '');

                }
            }
        };
        req.open("POST", "advanceseller.php", true);
        req.send(form);



    } else {
        selcatergoryrobrand.style.border = "solid 2px red";
    }

}




function invoproduct(x) {


    var productViewBoxID = document.getElementById("invoicoffcanves");
    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text)
            productViewBoxID.innerHTML = text;

        }
    };
    req.open("POST", "SeorderProductviwe.php", true);
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req.send("invoid=" + x);
}

function getCusinfo(x) {
    var contentcusID = document.getElementById("contentcusID");

    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text);

            contentcusID.innerHTML = text;
            var modelbox = document.getElementById("cusinfomodeID"); // relatedTarget
            var myModal = new bootstrap.Modal(document.getElementById('cusinfomodeID'));
            myModal.show(modelbox);

        }
    };
    req.open("POST", "secusinfo.php", true);
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req.send("uid=" + x);
}

function orderpage(x) {
    var box = document.getElementById("orderboxID")
    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text);
            box.innerHTML = text;

        }
    };
    req.open("POST", "sellerOrederPage.php", true);
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req.send("p=" + x + "&what=act");

}

function prevOrderpage(x) {
    var box = document.getElementById("orderboxID")
    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text);
            box.innerHTML = text;

        }
    };
    req.open("POST", "sellerOrederPage.php", true);
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req.send("p=" + x + "&what=prev");

}



function advanceview() {
    var box = document.getElementById("addvanceID")

    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text);
            box.innerHTML = text;

        }
    };
    req.open("POST", "advanceview.php", true);
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req.send();

}

// scroll div 
function doo(x) {
    // if (x == 1) {
    const slider = document.querySelector('.scroll' + x);
    // wheel scroll start

    const scrollContainer = document.querySelector(".scroll" + x);

    scrollContainer.addEventListener("wheel", (evt) => {
        evt.preventDefault();
        scrollContainer.scrollLeft += evt.deltaY;
    });
    // wheel scroll end

    let isDown = false;
    let startX;
    let scrollLeft;

    slider.addEventListener('mousedown', (e) => {
        isDown = true;
        startX = e.pageX - slider.offsetLeft;
        scrollLeft = slider.scrollLeft;
    });
    slider.addEventListener('mouseleave', () => {
        isDown = false;
    });
    slider.addEventListener('mouseup', () => {
        isDown = false;
    });
    slider.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - slider.offsetLeft;
        const walk = (x - startX) * 2; //scroll-fast
        slider.scrollLeft = scrollLeft - walk;
        console.log(walk);
    });

}

function recyclebin(x) {
    var binboxID = document.getElementById("binboxID");
    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            binboxID.innerHTML = text;

        }
    };
    req.open("POST", "sellerBinExpire.php", true);
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req.send("what=bin&page=" + x);
}

function expiredpro(x) {
    var binboxID = document.getElementById("binboxID");
    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            binboxID.innerHTML = text;
        }
    };
    req.open("POST", "sellerBinExpire.php", true);
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req.send("what=expire&page=" + x);
}

function reStore(x) {
    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text)
            if (text == "success") {
                recyclebin(1);
            }
        }
    };
    req.open("GET", "sellerRestoreproduct.php?pid=" + x, true);
    req.send();
}
// rename function 
function renamingmain(x) {

    var contentrenameId = document.getElementById("contentrenameId");
    var advanceRenameModelID = document.getElementById("advanceRenameModelID");

    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            contentrenameId.innerHTML = text

            var model = new bootstrap.Modal(advanceRenameModelID);
            model.show(advanceRenameModelID);
        }
    };
    req.open("POST", "seladvarenamegetmod.php", true);
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req.send("what=main&id=" + x);

}

function renamingsub(x) {

    var contentrenameId = document.getElementById("contentrenameId");
    var advanceRenameModelID = document.getElementById("advanceRenameModelID");

    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            contentrenameId.innerHTML = text

            var model = new bootstrap.Modal(advanceRenameModelID);
            model.show(advanceRenameModelID);
        }
    };
    req.open("POST", "seladvarenamegetmod.php", true);
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req.send("what=sub&id=" + x);

}
var modelrename;

function renamingbrand(x) {
    var advanceRenameModelID = document.getElementById("advanceRenameModelID");

    var contentrenameId = document.getElementById("contentrenameId");

    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            contentrenameId.innerHTML = text

            modelrename = new bootstrap.Modal(advanceRenameModelID);
            modelrename.show();

        }
    };
    req.open("POST", "seladvarenamegetmod.php", true);
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req.send("what=brand&id=" + x);

}
// model end 
// renameing save start
function renameSavemain(x) {

    var cancelbtnrenameID = document.getElementById("cancelbtnrenameID");
    var renameInputID = document.getElementById("renameInputID");
    var changeImgID = document.getElementById("changeImgID");

    var form = new FormData();
    form.append("rename", renameInputID.value);
    form.append("id", x);
    form.append("what", "main");
    form.append("img", changeImgID.files[0]);
    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text);

            if (text == "success") {

                cancelbtnrenameID.click();
                advanceview();
                tost('Category Renamed Successfull');


            } else {
                tostdanger('' + text + '');

            }
        }
    };
    req.open("POST", "seladvarename.php", true);
    req.send(form);
}

function renameSavesub(x) {

    var cancelbtnrenameID = document.getElementById("cancelbtnrenameID");
    var renameInputID = document.getElementById("renameInputID");
    var form = new FormData();
    form.append("rename", renameInputID.value);
    form.append("id", x);
    form.append("what", "sub");
    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;

            if (text == "success") {

                cancelbtnrenameID.click();
                advanceview();
                tost('Sub Category Renamed Successfull');


            } else {
                // alert(text);/
                tostdanger('' + text + '');

            }
        }
    };
    req.open("POST", "seladvarename.php", true);
    req.send(form);
}

function renameSavebrand(x) {

    var cancelbtnrenameID = document.getElementById("cancelbtnrenameID");
    var renameInputID = document.getElementById("renameInputID");

    var subcate = document.getElementsByClassName("subcheckedrename");
    var form = new FormData();
    var che = 0;
    var noche = 0;

    for (var i = 0; i < subcate.length; i++) {
        if (subcate[i].checked == true) {
            form.append("sub" + che, subcate[i].value);
            che++;

        } else {
            form.append("subun" + noche, subcate[i].value);
            noche++;
        }
    }
    form.append("lencheck", che);
    form.append("lenuncheck", noche);

    form.append("rename", renameInputID.value);
    form.append("id", x);
    form.append("what", "brand");
    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text);
            if (text == "success") {

                cancelbtnrenameID.click();
                advanceview();
                tost('Brand Renamed Successfull');


            } else {
                tostdanger('' + text + '');

            }
        }
    };
    req.open("POST", "seladvarename.php", true);
    req.send(form);
}
// renameing save end

// // delete adva start
function Deletemain(x) {

    var cancelbtnrenameID = document.getElementById("cancelbtnrenameID");
    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text);

            if (text == "success") {

                cancelbtnrenameID.click();
                advanceview();
                tost('Category Deleted Successfull');

            } else {
                tostdanger('' + text + '');

            }
        }
    };
    req.open("GET", "seladvaMSBdelete.php?id=" + x + "&what=main", true);
    req.send();
}

function Deletesub(x) {

    var cancelbtnrenameID = document.getElementById("cancelbtnrenameID");

    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text);

            if (text == "success") {

                cancelbtnrenameID.click();
                advanceview();
                tost('Sub Category Deleted Successfull');


            } else {
                tostdanger('' + text + '');

            }
        }
    };
    req.open("GET", "seladvaMSBdelete.php?id=" + x + "&what=sub", true);
    req.send();
}

function Deletebrand(x) {

    var cancelbtnrenameID = document.getElementById("cancelbtnrenameID");

    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text);

            if (text == "success") {

                cancelbtnrenameID.click();
                advanceview();
                tost('Brand Deleted Successfull');


            } else {
                tostdanger('' + text + '');


            }
        }
    };
    req.open("GET", "seladvaMSBdelete.php?id=" + x + "&what=brand", true);
    req.send();
}
// delete adva end

// adva image 
function AdvaImgveiw() {
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
            // $labelText.text(labelDefault);
        }


    });
}

function searchusertable(page) {
    var box = document.getElementById("usertabel");
    var searchuserID = document.getElementById("searchuserID");
    var f = new FormData();
    f.append("page", page);
    f.append("user", searchuserID.value);
    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text);
            box.innerHTML = text;

        }
    };
    req.open("POST", "sellerusertableget.php", true);
    req.send(f);
}

function BlockUserModal(id, bid, page) {
    //     alert(id)
    if (bid == 2) {
        var blockuserModal = document.getElementById("blockuserModal");
        mod = new bootstrap.Modal(blockuserModal);
        mod.show();
        var blockbtn = document.getElementById("blockbtn");
        blockbtn.setAttribute("onclick", "blockuser(" + id + "," + bid + "," + page + ")");
    } else {
        blockuser(id, bid, page);

    }

}

function blockuser(id, bid, page) {
    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text);
            if (text == "success") {
                mod.hide();
                searchusertable(page)
                if (bid == 1) {
                    tost('User Unblocked Successfull');

                } else {
                    tost('User blocked Successfull');

                }

            } else {
                tostdanger('' + text + '');

            }

        }
    };
    req.open("GET", "blockuserPro.php?uid=" + id + "&bid=" + bid, true);
    req.send();
}

function deliveryChange(inId) {
    // alert("ok")
    var DstatusID = document.getElementById("DstatusID");
    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text);
            if (text == "success") {
                orderpage(1);
                tost('Delivery Changed Successfull');

            } else {
                tostdanger('' + text + '');


            }

        }
    };
    req.open("GET", "deliveryChange.php?id=" + inId + "&did=" + DstatusID.value, true);
    req.send();
}



function getsubforBrand() {
    var selcatergoryrobrand = document.getElementById("selcatergoryrobrand");
    var subcaterBox = document.getElementById("subcaterBox");

    selcatergoryrobrand.style.border = "";

    var f = new FormData();
    f.append("m", selcatergoryrobrand.value);
    // f.append("for", "addpro");

    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text);
            subcaterBox.innerHTML = text;

        }
    };
    req.open("POST", "getsubforBrandAdd.php", true);
    req.send(f);
}

function getsubforBrandrename(bid) {
    var selcatergoryrobrand = document.getElementById("reselcatergoryrobrand");
    var subcaterBox = document.getElementById("subcaterBoxrename");


    var f = new FormData();
    f.append("m", selcatergoryrobrand.value);

    f.append("brand", bid);

    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text);
            subcaterBox.innerHTML = text;

        }
    };
    req.open("POST", "getsubforBrandAdd.php", true);
    req.send(f);
}

function setsubcategory() {
    var category = document.getElementById("maincoterid");
    var subcater = document.getElementById("subcaterId");
    // var brand = document.getElementById("inbrand");
    var f = new FormData();
    f.append("m", category.value);
    f.append("for", "addpro");

    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text);
            subcater.innerHTML = text;

        }
    };
    req.open("POST", "getsub.php", true);
    req.send(f);
}


function setbrand() {
    // var category = document.getElementById("maincoterid");
    var subcater = document.getElementById("subcaterId");
    var brand = document.getElementById("inbrand");
    var f = new FormData();
    f.append("s", subcater.value);
    f.append("for", "addpro");

    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text);
            brand.innerHTML = text;

        }
    };
    req.open("POST", "getbrandtoadd.php", true);
    req.send(f);
}

////update


function setsubcategoryupdate() {
    var category = document.getElementById("updatemaincoterid");
    var subcater = document.getElementById("updatesubcaterId");

    var f = new FormData();
    f.append("m", category.value);
    f.append("for", "addpro");

    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text);
            subcater.innerHTML = text;

        }
    };
    req.open("POST", "getsub.php", true);
    req.send(f);
}


function setbrandupdate() {
    // var category = document.getElementById("maincoterid");
    var subcater = document.getElementById("updatesubcaterId");
    var brand = document.getElementById("updateinbrand");
    var f = new FormData();
    f.append("s", subcater.value);
    f.append("for", "addpro");

    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text);
            brand.innerHTML = text;

        }
    };
    req.open("POST", "getbrandtoadd.php", true);
    req.send(f);
}

function searchinvoice(x) {
    var fromdateID = document.getElementById("fromdateID");
    var todateID = document.getElementById("todateID");
    var SearchinvoceID = document.getElementById("SearchinvoceID");

    var box = document.getElementById("orderboxID")
    var f = new FormData();
    f.append("p", x);
    f.append("what", "act");
    f.append("from", fromdateID.value);
    f.append("to", todateID.value);
    f.append("s", SearchinvoceID.value);



    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text);
            box.innerHTML = text;

        }
    };
    req.open("POST", "sellerOrederPage.php", true);
    req.send(f);

}

function searchinvoicePrev(x) {
    var fromdateID = document.getElementById("fromdateID");
    var todateID = document.getElementById("todateID");
    var SearchinvoceID = document.getElementById("SearchinvoceID");

    var box = document.getElementById("orderboxID")
    var f = new FormData();

    f.append("p", x);
    f.append("what", "prev");
    f.append("from", fromdateID.value);
    f.append("to", todateID.value);
    f.append("s", SearchinvoceID.value);

    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text);
            box.innerHTML = text;

        }
    };
    req.open("POST", "sellerOrederPage.php", true);
    req.send(f)
}

function addnotification() {
    var subjectID = document.getElementById("subjectID");
    var msgcontent = document.getElementById("msgContentID");

    var f = new FormData();
    f.append("s", subjectID.value);
    f.append("con", msgcontent.value);

    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text);
            if (text == "success") {
                subjectID.value = "";
                msgcontent.value = "";
                shownotofication();
                tost('Notification Added Successfull');

            } else {
                tostdanger('' + text + '');

            }
        }
    };
    req.open("POST", "addnotify.php", true);
    req.send(f);
}

function deletenotify(x) {

    var f = new FormData();
    f.append("x", x);


    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text);
            if (text == "success") {
                shownotofication();
                tost('Notification Deleted Successfull');
            } else {
                tostdanger('' + text + '');
            }
        }
    };
    req.open("POST", "deletenotify.php", true);
    req.send(f);
}

function shownotofication() {
    var notfibox = document.getElementById("notifybox");

    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;

            notfibox.innerHTML = text;
        }
    };
    req.open("POST", "shownotify.php", true);
    req.send();
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