function sendmessageModal(id) {
    var msgtxt = document.getElementById("msgtxt");
    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text)

            if (text == "Success") {
                msgtxt.value = "";
            } else {

            }
        }
    };
    req.open("GET", "massageInsert.php?u=" + id + "&msg=" + msgtxt.value, true);
    req.send();
}

var mod;
var userid;
var refreshID;

function massageUserModal(id) {
    userid = id;
    var context = document.getElementById("usermsgContentModal");
    var f = new FormData();
    f.append("uid", id)
    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            context.innerHTML = text;
            var msgmodal = document.getElementById("msgmodal");
            mod = new bootstrap.Modal(msgmodal);
            mod.show();

            refreshID = setInterval(refreshsellerMsg, 1000);
            seenStatusChange(id);
        }
    };
    req.open("POST", "customerMsgContent.php", true);
    req.send(f);


}

function clearInt() {
    clearInterval(refreshID);

}

function refreshsellerMsg() {
    // alert(userid)

    var f = new FormData();
    f.append("uid", userid)
    var chatrow = document.getElementById("chatrow");
    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            chatrow.innerHTML = text;


        }
    };
    req.open("POST", "MsgsellerContent.php", true);

    req.send(f);
}


function seenStatusChange(id) {

    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text);
            if (text == "success") {
                var largbadge = document.getElementById("largbadge");
                var smallbadge = document.getElementById("smalbadge");
                var sellerbadge = document.getElementById("sellerbadge" + id);
                largbadge.classList.add("d-lg-none");
                smallbadge.classList.add("d-none");
                sellerbadge.classList.add("d-none");
            }
        }
    };
    req.open("GET", "MsgSeenStatusChange.php?uid=" + id, true);

    req.send();
}


function openChatModal() {
    var msgmodal = document.getElementById("msgmodal");
    mod = new bootstrap.Modal(msgmodal);
    mod.show();
    setInterval(refreshcustomermMsg, 1000);
}

function refreshcustomermMsg() {
    var chatrow = document.getElementById("chatrow");
    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            chatrow.innerHTML = text;


        }
    };
    req.open("POST", "massageview.php", true);
    req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    req.send();
}

function sendMassagetoSeller() {
    var msgtxt = document.getElementById("msgtxt");
    var req = new XMLHttpRequest();
    req.onreadystatechange = function() {
        if (req.readyState == 4) {
            var text = req.responseText;
            // alert(text)

            if (text == "Success") {
                msgtxt.value = "";
            } else {

            }


        }
    };
    req.open("GET", "massageCustomerInsert.php?msg=" + msgtxt.value, true);
    req.send();
}

function sendMail() {
    var sub = document.getElementById("subjectID");
    var body = document.getElementById("bodyID");
    var btn = document.getElementById("sendmail")
    btn.href = "mailto:janchamika1@gmail.com?subject=" + sub.value + "&body=" + body.value;

}