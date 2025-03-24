function pay(x) {
    // alert(text);

    var qty = document.getElementById("qty");
    // var fname = document.getElementById("fnameID");
    // var lname = document.getElementById("lnameID");

    var mobile = document.getElementById("mobile");
    var addno = document.getElementById("add_no");
    var addline1 = document.getElementById("addline1");
    var addline2 = document.getElementById("addline2");
    var city = document.getElementById("cityID");
    var postcode = document.getElementById("postcodeID");

    var form = new FormData();
    form.append("pid", x);
    // form.append("fname", fname.value);
    // form.append("lname", lname.value);
    form.append("qty", qty.value);
    form.append("an", addno.value);
    form.append("a1", addline1.value);
    form.append("a2", addline2.value);
    form.append("ac", city.value);
    form.append("postal", postcode.value);
    form.append("mobile", mobile.value);

    // form.append("postal", postcode.value);
    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text);
            var uid;
            var amount;
            var qtyv;

            if (text == "Please Login First") {
                tostdanger('' + text + '');

            } else if (text == "Product doesn't exist") {
                tostdanger('' + text + '');


            } else if (text == "Plase set Quintity") {
                tostdanger('' + text + '');


            }
            // else if (text == "Please enter first name") {
            //     alert(text);

            // } else if (text == "Please enter last name") {
            //     alert(text);

            // } 
            else if (text == "Please enter mobile number") {
                tostdanger('' + text + '');


            } else if (text == "Invalid mobile number") {
                tostdanger('' + text + '');


            } else if (text == "Please enter address no") {
                tostdanger('' + text + '');


            } else if (text == "Please enter address line 1") {
                tostdanger('' + text + '');


            } else if (text == "Please enter address line 2") {
                tostdanger('' + text + '');


            } else if (text == "Please select district") {
                tostdanger('' + text + '');


            } else if (text == "Please enter  postal code") {
                tostdanger('' + text + '');


            } else if (text == "delivery not available for your district") {
                tostdanger('Sorry,' + text + '');


            } else if (text == "This quantity not available at this moment") {
                tostdanger('Sorry,' + text + '');


            } else if (text == "This Product is not available at this moment") {
                tostdanger('Sorry,' + text + '');

            } else {
                j = JSON.parse(text);

                uid = j["uid"];
                amount = j["total"];
                qtyv = j["qty"];
                // cheackoutInsert(j["orderid"], x, qtyv, uid, j)
                //  testing

                // Called when user completed the payment. It can be a successful payment or failure
                payhere.onCompleted = function onCompleted(orderId) {
                    // console.log("Payment completed. OrderID:" + orderId);
                    cheackoutInsert(orderId, x, qtyv, uid, j)

                    //Note: validate the payment and show success or failure page to the customer
                };

                // Called when user closes the payment without completing
                payhere.onDismissed = function onDismissed() {
                    //Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Called when error happens when initializing payment such as invalid parameters
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1217877", // Replace your Merchant ID
                    "return_url": undefined, // Important
                    "cancel_url": undefined, // Important
                    "notify_url": "notify.php",
                    "order_id": j["orderid"],
                    "items": j["proname"],
                    "amount": j["total"] + ".00",
                    // "item_name_1": j["proname"],
                    // "amount_1": "100.00",
                    // "quantity_1": "2",

                    "currency": "LKR",
                    "first_name": j["fname"],
                    "last_name": j["lname"],
                    "email": j["uemail"],
                    "phone": j["mobile"],
                    "address": j["adno"] + "," + j["adline1"],
                    "city": j["adline2"],
                    "country": "Sri Lanka",
                    "delivery_address": j["adno"] + "," + j["adline1"],
                    "delivery_city": j["adline2"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };
                payhere.startPayment(payment);


            }


        }
    };

    req.open("POST", "checkoutcheack.php", true);

    req.send(form);
}

function cheackoutInsert(orderId, x, qty, id, j) {
    // alert(j);


    var form = new FormData();
    form.append("pid", x);
    form.append("qty", qty);
    form.append("orderid", orderId);
    form.append("uid", id);

    form.append("mobile", j["mobile"]);
    form.append("an", j["adno"]);
    form.append("a1", j["adline1"]);
    form.append("a2", j["adline2"]);
    form.append("ac", j["dis_id"]);
    form.append("postal", j["postalcode"]);
    // form.append("uid", id);



    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text);
            if (text == "succes") {
                window.location = "invoice.php?id=" + orderId;
            } else {
                // alert(text);

            }
        }
    };
    req.open("POST", "checkoutOrderinsert.php", true);
    req.send(form);

}

// function payBefore(x) {
//     var qty = document.getElementById("qty");
//     var form = new FormData();
//     form.append("pid", x);
//     form.append("qty", qty);
//     var req = new XMLHttpRequest();
//     req.onreadystatechange = function() {
//         if (req.readyState == 4) {
//             var text = req.responseText;
//             // alert(text);
//             if (text == "succes") {
//                 pay(x)
//             } else {
//                 alert(text);

//             }
//         }
//     };

//     req.open("POST", "payBefore.php", true);
//     req.send(form);

// }


function qtyChange(x) {
    var qty = document.getElementById("qty");
    var qtyview = document.getElementById("qtyview");
    var dselect = document.getElementById("cityID");

    var totalPriceBoxID = document.getElementById("totalPriceBoxID");
    if (qty.value < 1) {
        qty.value = 1;
    }
    qtyview.innerHTML = qty.value;

    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text);
            totalPriceBoxID.innerHTML = text;
        }
    };
    req.open("POST", "checkoutTotal.php", true);
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req.send("pid=" + x + "&qty=" + qty.value + "&dis=" + dselect.value);
}

function qtyChangeCart(x) {
    var qty = document.getElementById("qty" + x);
    var qtyview = document.getElementById("qtyview" + x);
    var totalpriceboxID = document.getElementById("totalpriceboxID");
    var dselect = document.getElementById("cityID");

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
    req.open("POST", "cheackoutTotalCart.php", true);
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req.send("pid=" + x + "&qty=" + qty.value + "&dis=" + dselect.value);
}

function payCart() {
    // alert(text);
    var mobile = document.getElementById("mobile");
    var addno = document.getElementById("add_no");
    var addline1 = document.getElementById("addline1");
    var addline2 = document.getElementById("addline2");
    var city = document.getElementById("cityID");
    var postcode = document.getElementById("postcodeID");

    var form = new FormData();


    form.append("an", addno.value);
    form.append("a1", addline1.value);
    form.append("a2", addline2.value);
    form.append("ac", city.value);
    form.append("postal", postcode.value);
    form.append("mobile", mobile.value);


    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text);
            var uid;
            var amount;


            if (text == "Please Login First") {
                tostdanger('' + text + '');

            } else if (text == "Product doesn't exist in Cart") {
                tostdanger('' + text + '');


            }
            //  else if (text == "Plase set Quintity") {
            //     alert(text);

            // }
            // else if (text == "Please enter first name") {
            //     alert(text);

            // } else if (text == "Please enter last name") {
            //     alert(text);

            // } 
            else if (text == "Please enter mobile number") {
                tostdanger('' + text + '');


            } else if (text == "Invalid mobile number") {
                tostdanger('' + text + '');


            } else if (text == "This quintity not available in stock") {
                tostdanger('Sorry,' + text + '');


            } else if (text == "Please enter address no") {
                tostdanger('' + text + '');


            } else if (text == "Please enter address line 1") {
                tostdanger('' + text + '');


            } else if (text == "Please enter address line 2") {
                tostdanger('' + text + '');


            } else if (text == "Please select district") {
                tostdanger('' + text + '');


            } else if (text == "Please enter  postal code") {
                tostdanger('' + text + '');


            } else if (text == "delivery not available for your district") {
                tostdanger('Sorry,' + text + '');


            } else if (text == "Some of the products in the cart are not available at this time") {
                tostdanger('Sorry,' + text + '');

            } else {
                j = JSON.parse(text);

                uid = j["uid"];
                amount = j["total"];

                // cheackoutInsertCart(j["orderid"], uid, j);


                // Called when user completed the payment. It can be a successful payment or failure
                payhere.onCompleted = function onCompleted(orderId) {
                    // console.log("Payment completed. OrderID:" + orderId);
                    cheackoutInsertCart(orderId, uid, j);

                    //Note: validate the payment and show success or failure page to the customer
                };

                // Called when user closes the payment without completing
                payhere.onDismissed = function onDismissed() {
                    //Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Called when error happens when initializing payment such as invalid parameters
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1217877", // Replace your Merchant ID
                    "return_url": undefined, // Important
                    "cancel_url": undefined, // Important
                    "notify_url": "notify.php",
                    "order_id": j["orderid"],
                    "items": j["proname"],
                    "amount": j["total"] + ".00",
                    // "item_name_1": j["proname"],
                    // "amount_1": "100.00",
                    // "quantity_1": "2",

                    "currency": "LKR",
                    "first_name": j["fname"],
                    "last_name": j["lname"],
                    "email": j["uemail"],
                    "phone": j["mobile"],
                    "address": j["adno"] + "," + j["adline1"],
                    "city": j["adline2"],
                    "country": "Sri Lanka",
                    "delivery_address": j["adno"] + "," + j["adline1"],
                    "delivery_city": j["adline2"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };
                payhere.startPayment(payment);


            }


        }
    };

    req.open("POST", "checkoutcheackCart.php", true);

    req.send(form);
}


function cheackoutInsertCart(orderId, id, j) {
    // alert(j);


    var form = new FormData();
    form.append("orderid", orderId);
    form.append("uid", id);

    form.append("mobile", j["mobile"]);
    form.append("an", j["adno"]);
    form.append("a1", j["adline1"]);
    form.append("a2", j["adline2"]);
    form.append("ac", j["dis_id"]);
    form.append("postal", j["postalcode"]);
    // form.append("uid", id);



    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text);
            if (text == "succes") {
                window.location = "invoice.php?id=" + orderId;
            } else {
                // alert(text);

            }
        }
    };
    req.open("POST", "checkoutOrderinsertCart.php", true);
    req.send(form);

}

function payPackage(id) {
    var mobile = document.getElementById("mobile");
    var addno = document.getElementById("add_no");
    var addline1 = document.getElementById("addline1");
    var addline2 = document.getElementById("addline2");
    var city = document.getElementById("cityID");
    var postcode = document.getElementById("postcodeID");

    var form = new FormData();


    form.append("an", addno.value);
    form.append("a1", addline1.value);
    form.append("a2", addline2.value);
    form.append("ac", city.value);
    form.append("postal", postcode.value);
    form.append("mobile", mobile.value);
    form.append("pid", id);


    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text);
            var uid;
            var amount;


            if (text == "Please Login First") {
                tostdanger('' + text + '');

            } else if (text == "Product doesn't exist in Cart") {
                tostdanger('' + text + '');


            }
            //  else if (text == "Plase set Quintity") {
            //     alert(text);

            // }
            // else if (text == "Please enter first name") {
            //     alert(text);

            // } else if (text == "Please enter last name") {
            //     alert(text);

            // } 
            else if (text == "Please enter mobile number") {
                tostdanger('' + text + '');


            } else if (text == "Invalid mobile number") {
                tostdanger('' + text + '');


            } else if (text == "This quintity not available in stock") {
                tostdanger('Sorry,' + text + '');


            } else if (text == "Please enter address no") {
                tostdanger('' + text + '');


            } else if (text == "Please enter address line 1") {
                tostdanger('' + text + '');


            } else if (text == "Please enter address line 2") {
                tostdanger('' + text + '');


            } else if (text == "Please select district") {
                tostdanger('' + text + '');


            } else if (text == "Please enter  postal code") {
                tostdanger('' + text + '');


            } else if (text == "delivery not available for your district") {
                tostdanger('Sorry,' + text + '');


            } else if (text == "Some of the products are not available at this time") {
                tostdanger('Sorry,' + text + '');

            } else if (text == "This Package Not Available") {
                tostdanger('Sorry,' + text + ' in this time');

            } else {
                j = JSON.parse(text);

                uid = j["uid"];
                amount = j["total"];

                // cheackoutInsertPackage(j["orderid"], uid, j, id);


                // Called when user completed the payment. It can be a successful payment or failure
                payhere.onCompleted = function onCompleted(orderId) {
                    // console.log("Payment completed. OrderID:" + orderId);
                    cheackoutInsertPackage(orderId, uid, j, id);

                    //Note: validate the payment and show success or failure page to the customer
                };

                // Called when user closes the payment without completing
                payhere.onDismissed = function onDismissed() {
                    //Note: Prompt user to pay again or show an error page
                    console.log("Payment dismissed");
                };

                // Called when error happens when initializing payment such as invalid parameters
                payhere.onError = function onError(error) {
                    // Note: show an error page
                    console.log("Error:" + error);
                };

                // Put the payment variables here
                var payment = {
                    "sandbox": true,
                    "merchant_id": "1217877", // Replace your Merchant ID
                    "return_url": undefined, // Important
                    "cancel_url": undefined, // Important
                    "notify_url": "notify.php",
                    "order_id": j["orderid"],
                    "items": j["proname"],
                    "amount": j["total"] + ".00",
                    // "item_name_1": j["proname"],
                    // "amount_1": "100.00",
                    // "quantity_1": "2",

                    "currency": "LKR",
                    "first_name": j["fname"],
                    "last_name": j["lname"],
                    "email": j["uemail"],
                    "phone": j["mobile"],
                    "address": j["adno"] + "," + j["adline1"],
                    "city": j["adline2"],
                    "country": "Sri Lanka",
                    "delivery_address": j["adno"] + "," + j["adline1"],
                    "delivery_city": j["adline2"],
                    "delivery_country": "Sri Lanka",
                    "custom_1": "",
                    "custom_2": ""
                };
                payhere.startPayment(payment);


            }


        }
    };

    req.open("POST", "checkoutcheackPackage.php", true);

    req.send(form);
}

function cheackoutInsertPackage(orderId, uid, j, id) {
    var form = new FormData();
    form.append("orderid", orderId);
    form.append("uid", uid);

    form.append("mobile", j["mobile"]);
    form.append("an", j["adno"]);
    form.append("a1", j["adline1"]);
    form.append("a2", j["adline2"]);
    form.append("ac", j["dis_id"]);
    form.append("postal", j["postalcode"]);
    form.append("pid", id);



    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text);
            if (text == "succes") {
                window.location = "invoice.php?id=" + orderId;
            } else {
                // alert(text);

            }
        }
    };
    req.open("POST", "checkoutOrderinsertPackage.php", true);
    req.send(form);
}

function dFeechange(pid) {
    var dselect = document.getElementById("cityID");
    var qty = document.getElementById("qty");
    var totalPriceBoxID = document.getElementById("totalPriceBoxID");
    var form = new FormData();
    form.append("dis", dselect.value);
    form.append("qty", qty.value);
    form.append("pid", pid);

    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text);
            totalPriceBoxID.innerHTML = text;
        }
    };
    req.open("POST", "cheackoutChangedis.php", true);
    req.send(form);
}

function dFeechangeCart() {
    var dselect = document.getElementById("cityID");

    var totalpriceboxID = document.getElementById("totalpriceboxID");
    var form = new FormData();
    form.append("dis", dselect.value);



    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text);
            totalpriceboxID.innerHTML = text;
        }
    };
    req.open("POST", "cheakoutchangedisCart.php", true);
    req.send(form);
}

function dFeechangePackage(id) {
    var dselect = document.getElementById("cityID");

    var totalpriceboxID = document.getElementById("totalpriceboxID");
    var form = new FormData();
    form.append("dis", dselect.value);
    form.append("pid", id);



    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text);
            totalpriceboxID.innerHTML = text;
        }
    };
    req.open("POST", "cheakoutchangedisPackage.php", true);
    req.send(form);
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