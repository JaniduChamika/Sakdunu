function upbtn() {
    var fnTag = document.getElementById("fn");
    var lnTag = document.getElementById("ln");
    var emailTag = document.getElementById("email");
    var psTag = document.getElementById("pw");
    var cpwTag = document.getElementById("cpw");

    var mobiletag = document.getElementById("mobile");
    var gen = document.getElementById("genID");

    var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
    // var addno = document.getElementById("addno");
    // var addline1 = document.getElementById("addline1");
    // var addline2 = document.getElementById("addline2");
    // var addcity = document.getElementById("citysselID");



    var erro1 = document.getElementById("erro1");


    var FirstName = fnTag.value;
    var LastName = lnTag.value;
    var Email = emailTag.value;
    var Password = psTag.value;
    var ComfirmPassword = cpwTag.value;
    var gender = gen.value;
    var mobile = mobiletag.value;
    // var addressno = addno.value;
    // var addressline1 = addline1.value;
    // var addressline2 = addline2.value;
    // var addresscity = addcity.value;


    fnTag.style.borderBottomColor = "";
    lnTag.style.borderBottomColor = "";
    emailTag.style.borderBottomColor = "";
    psTag.style.borderBottomColor = "";
    mobiletag.style.borderBottomColor = "";
    cpwTag.style.borderBottomColor = "";
    gen.style.borderBottomColor = "";

    if (FirstName.length == 0) {

        erro1.innerHTML = "*Please Enter Your First Name";

        fnTag.style.borderBottomColor = "red";
    } else if (LastName.length == 0) {

        erro1.innerHTML = "*Please Enter Your First Name";

        lnTag.style.borderBottomColor = "red";
    } else if (mobiletag.value.length != 10) {
        mobiletag.style.borderBottomColor = "red";
        erro1.innerHTML = "*Enter Valid Mobile Number";

    } else if (emailTag.value.length == 0) {
        emailTag.style.borderBottomColor = "red";
        erro1.innerHTML = "*Enter Your Email Address";

    } else if (!emailTag.value.match(mailformat)) {
        emailTag.style.borderBottomColor = "red";
        erro1.innerHTML = "*Enter Valid Email Address";

    } else if (psTag.value.length == 0) {
        psTag.style.borderBottomColor = "red";
        erro1.innerHTML = "*Password Your Password";

    } else if (psTag.value.length < 8) {
        psTag.style.borderBottomColor = "red";
        erro1.innerHTML = "*Password must contains at least character 8";

    } else if (psTag.value != cpwTag.value) {
        psTag.style.borderBottomColor = "red";
        cpwTag.style.borderBottomColor = "red";
        erro1.innerHTML = "*Password Not Same";

    } else if (Password == ComfirmPassword) {


        var validation = new XMLHttpRequest();
        validation.onreadystatechange = function() {

            if (validation.readyState == 4) {

                erro1.style.backgroundImage = "none";

                var text = validation.responseText;

                erro1.innerHTML = text;

                // alert(text)

                if (text == "*Please Enter Your First Name") {
                    fnTag.style.borderBottomColor = "red";
                } else if (text == "*First name must be less than 50 characters") {
                    fnTag.style.borderBottomColor = "red";
                } else if (text == "*Please Enter Your Last Name") {
                    lnTag.style.borderBottomColor = "red";
                } else if (text == "*Last name must be less than 50 characters") {
                    lnTag.style.borderBottomColor = "red";
                } else if (text == "*Enter your working email address") {
                    emailTag.style.borderBottomColor = "red";


                } else if (text == "*Invalid Email Format") {
                    emailTag.style.borderBottomColor = "red";


                } else if (text == "*Don't forget to enter a password") {
                    psTag.style.borderBottomColor = "red";


                } else if (text == "*Password not same") {
                    psTag.style.borderBottomColor = "red";
                    cpwTag.style.borderBottomColor = "red";


                } else if (text == "*Enter your Mobile Number") {
                    mobiletag.style.borderBottomColor = "red";


                } else if (text == "*Invalid mobile number") {
                    mobiletag.style.borderBottomColor = "red";


                } else if (text == "*Password length must between 5 to 20") {
                    psTag.style.borderBottomColor = "red";


                } else if (text == "*Password must contains numbers") {
                    psTag.style.borderBottomColor = "red";
                } else if (text == "*Already Registerted Email") {
                    emailTag.style.borderBottomColor = "red";


                } else if (text == "*Something went wrong") {
                    gen.style.borderBottomColor = "red";


                } else if (text == "success") {
                    window.location = "login.php";
                }

            } else {

                erro1.innerHTML = "";
                erro1.style.backgroundImage = "url('cssfile//745.svg')";


            }
        };
        validation.open("POST", "signup_validation.php", true);
        validation.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        validation.send("fn=" + FirstName + "&ln=" + LastName + "&e=" + Email + "&mobile=" + mobile + "&p=" + Password + "&gen=" + gender + "&cpw=" + ComfirmPassword);

    } else {

        erro1.innerHTML = "*Please Enter Your First Name";

        cpwTag.style.borderBottomColor = "red";
        psTag.style.borderBottomColor = "red";

    }
}

var myModal;

function signinbt(setnowinLink) {
    // alert("ok");
    var emailTag = document.getElementById("email");
    var passwordTag = document.getElementById("pw");
    var emailerro = document.getElementById("error1");
    var passerro = document.getElementById("error2");
    var remem = document.getElementById("che").checked;
    var sellerVCode = document.getElementById("sellerVCode");
    // alert(remem)
    var Email = emailTag.value;
    var Password = passwordTag.value;
    if (Email.length != 0) {
        emailerro.innerHTML = "";
        emailTag.style.borderBottomColor = "";

    }
    if (Password.length != 0) {
        passerro.innerHTML = "";
        passwordTag.style.borderBottomColor = "";

    }
    if (Email.length == 0) {
        emailerro.innerHTML = "*Enter Your Email Adsress";
        emailTag.style.borderBottomColor = "red";
    } else if (Password.length == 0) {
        passerro.innerHTML = "*Enter Your Password";
        passwordTag.style.borderBottomColor = "red";
    } else {
        var Search = new XMLHttpRequest();
        Search.onreadystatechange = function() {

            if (Search.readyState == 4) {
                var load = document.getElementById("load");
                load.style.backgroundImage = "none";

                var text = Search.responseText;
                // alert(text)
                if (text == "*Enter Your Email Address") {
                    emailerro.innerHTML = text;
                    emailTag.style.borderBottomColor = "red";
                } else if (text == "*Enter Your Password") {
                    passerro.innerHTML = text;
                    passwordTag.style.borderBottomColor = "red";
                } else if (text == "*Not Registered Email Address") {
                    emailerro.innerHTML = text;
                    emailTag.style.borderBottomColor = "red";
                } else if (text == "*Password Incorrect") {
                    passerro.innerHTML = text;
                    passwordTag.style.borderBottomColor = "red";
                } else if (text == "*Invalid Email Address") {
                    emailerro.innerHTML = text;
                    emailTag.style.borderBottomColor = "red";
                } else if (text == "seller vc") {
                    /////
                    msgtost("Admin Verification Code Sent Successfull. Please check your inbox.");

                    setTimeout(adminlogModal, 3000);

                } else if (text == "Verification could not be sent") {
                    msgtost('' + text + '');

                } else if (text == "Verification could not be sent") {
                    emailerro.innerHTML = text;
                } else if (text == "Your Account was suspened") {
                    emailerro.innerHTML = text;
                } else if (text == "Sucess") {

                    if (setnowinLink != "") {
                        window.location = setnowinLink;
                        // alert(checkoutPID);
                    } else {
                        window.location = "index.php";

                    }
                } else {
                    msgtost('' + text + '');

                }



            } else {

                var load = document.getElementById("load");
                load.style.backgroundImage = "url('cssfile//745.svg')";

            }
        };
    }
    Search.open("POST", "signin_pro.php", true);
    Search.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    Search.send("email=" + Email + "&pw=" + Password + "&r=" + remem + "&selvc=" + sellerVCode.value);
}

function adminlogModal() {
    var sellerVCmodal = document.getElementById("sellerLoginCode");
    myModal = new bootstrap.Modal(sellerVCmodal);
    myModal.show();
}
// for signin call and cheack product chekout
// var setnowinLink = "";

// function asSeller(x) {
//     if (x != "") {
//         setnowinLink = x;
//     }
//     signinbt('asSeller');

// }

// function asUser(x) {
//     if (x != "") {
//         setnowinLink = x;
//     }
//     signinbt('asUser');
// }
// for signin call and cheack product chekout end

function gosignin() {
    window.location = "login.php";
}

function gohome() {
    window.location = "index.php";
}


function forgotPassword() {
    var email = document.getElementById("email");
    var emailerro = document.getElementById("error1");
    emailerro.innerHTML = "";
    email.style.borderBottomColor = "";

    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text);
            if (text == "success") {
                msgtost('Verification Code has been sent successfull. Please check your inbox.');
                setTimeout(openResetpwModel, 3000);

            } else if (text == "*Not Registered Email Address") {

                emailerro.innerHTML = text;
                email.style.borderBottomColor = "red";
            } else if (text == "*Enter Your Email Address") {
                emailerro.innerHTML = text;
                email.style.borderBottomColor = "red";
            } else {
                emailerro.innerHTML = text;
            }




        } else {

            var load = document.getElementById("load");
            load.style.backgroundImage = "url('cssfile//745.svg')";

        }
    };
    req.open("GET", "forgotPassword.php?e=" + email.value, true);
    req.send();
}

function openResetpwModel() {
    myModal = new bootstrap.Modal(document.getElementById('resetModelID'));
    myModal.show();
}

function resetPassword() {
    var email = document.getElementById("email");
    var resetpwsID = document.getElementById("resetpwsID");
    var resetpwsRetypeID = document.getElementById("resetpwsRetypeID");
    var vcodeID = document.getElementById("vcodeID");
    var emailerro = document.getElementById("error1");
    emailerro.innerHTML = "";
    var error1 = document.getElementById("erroresetpw");
    var error2 = document.getElementById("erroresetvc");
    error1.innerHTML = "";
    error2.innerHTML = "";
    email.style.borderBottomColor = "";


    var form = new FormData();
    form.append("pw", resetpwsID.value);
    form.append("repw", resetpwsRetypeID.value);
    form.append("vcode", vcodeID.value);
    form.append("email", email.value);


    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text);
            if (text == "success") {
                myModal.hide();
                msgtost("Password reset successfull.");

            } else if (text == "Please enter varification code") {
                error2.innerHTML = text;
            } else if (text == "Wrong varification code") {
                error2.innerHTML = text;

            } else if (text == "Please enter your email address") {
                emailerro.innerHTML = text;
                email.style.borderBottomColor = "red";

            } else {
                error1.innerHTML = text;

            }

        } else {

            var load = document.getElementById("load");
            load.style.backgroundImage = "url('cssfile//745.svg')";

        }
    };
    req.open("POST", "fResetPws.php", true);
    req.send(form);

}

function changetype() {
    var resetpwsID = document.getElementById("resetpwsID");
    var newpwsdtnID = document.getElementById("newpwsbtnID");
    if (newpwsdtnID.innerHTML == '<i class="icofont-eye"></i>') {
        resetpwsID.type = "text";
        newpwsdtnID.innerHTML = '<i class="icofont-eye-blocked"></i>';
    } else {
        resetpwsID.type = "password";
        newpwsdtnID.innerHTML = '<i class="icofont-eye"></i>';

    }
}

function changetype2() {
    var resetpwsID = document.getElementById("resetpwsRetypeID");
    var newpwsdtnID = document.getElementById("newpwsbtnID2");
    if (newpwsdtnID.innerHTML == '<i class="icofont-eye"></i>') {
        resetpwsID.type = "text";
        newpwsdtnID.innerHTML = '<i class="icofont-eye-blocked"></i>';
    } else {
        resetpwsID.type = "password";
        newpwsdtnID.innerHTML = '<i class="icofont-eye"></i>';

    }
}


// function msgTost(f) {


//     var boxnoteID = document.getElementById("boxnoteID");


//     var form = new FormData();
//     form.append("from", f)
//     var r = new XMLHttpRequest();
//     r.onreadystatechange = function() {
//         if (r.readyState == 4) {
//             var text = r.responseText;
//             var vv = boxnoteID.innerHTML;
//             boxnoteID.innerHTML = vv + text;
//             var toastLiveExample2 = document.getElementsByClassName('liveToast');
//             var c = toastLiveExample2.length;
//             for (var x = 0; x < c; x++) {

//                 var toast = new bootstrap.Toast(toastLiveExample2[x]);
//                 toast.show();
//             }
//             setTimeout(function() {
//                 document.getElementById("boxnoteID").firstElementChild.remove();
//             }, 6000);
//         }
//     };
//     r.open("POST", "massagetost.php", true);
//     r.send(form);

// }


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