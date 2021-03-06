arr = window.location.pathname.split("/");
baseUrl = window.location.protocol + "//" + window.location.host + "";
for (let i = 0; i < arr.length-1; i++){
    baseUrl += arr[i] + "/"
}

function changePassword(){
    let password1 = $("#password1").val();
    let password2 = $("#password2").val();

    let obj = {
        "password": password1
    };

    if (verifyPassword(password1, password2)){
        $.post(baseUrl + "change_password", obj,
            function (data) {
                $("#password1").val("");
                $("#password2").val("");
            }
        );
    }
}

function verifyPassword(password1, password2){
    if (password1 === password2){
        return true;
    }
    else
        return false;
}

function updateUser(){
    let name = $("#name").val();
    let surname = $("#surname").val();
    let email = $("#email").val();

    let obj = {
        "name": name,
        "surname": surname,
        "email": email
    };

    $.ajax({
        type: "POST",
        url: baseUrl + "update_user",
        data: obj,
        success: function (response) {
            location.reload();
        }
    });
}

function updateCustomer(){
    // posodobimo osebo
    updateUser();

    // zdaj pa še stranko
    let address = $("#address").val();
    let post_number = $("#post_number").val();
    let city = $("#city").val();

    let obj = {
        "address": address,
        "post_number": post_number,
        "city": city
    };

    $.ajax({
        type: "POST",
        url: baseUrl + "update_customer",
        data: obj,
        success: function (response) {
            console.log(response);
            location.reload();
        }
    });
}

$(document).ready(function () {
    $("#change_password").click(changePassword);
    $("#update_user").click(updateUser);
    $("#update_customer").click(updateCustomer);
});