$("input").on("keyup", function() {
    var id = $(this).attr("id");
    var regEmail = /^[a-z0-9]+(\.[a-z0-9]+)*\@[a-z]+(\.[a-z]+)+$/;
    var regpassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{6,}$/;
    var regTitle = /^[A-Za-z\s?]+$/;
    var regName = /^[A-Z]{1}[a-z]{2,9}(\s[A-Z]{1}[a-z]{2,9})+$/;
    var regUser = /^[A-Z]{1}[a-z0-9]{2,9}$/;
    if(id=="email"){
        var email = document.getElementById(id).value;
        if(regEmail.test(email)){
            document.getElementById(id).style.borderColor = "green";
        }
        else {
            document.getElementById(id).style.borderColor = "red";
            
        }
    }
    if(id=="password"){
        var password = document.getElementById(id).value;
        if(regpassword.test(password)){
            document.getElementById(id).style.borderColor = "green";
        }
        else {
            document.getElementById(id).style.borderColor = "red";
            
        }
    }
    if(id=="title"){
        var title = document.getElementById(id).value;
        if(regTitle.test(title)){
            document.getElementById(id).style.borderColor = "green";
        }
        else {
            document.getElementById(id).style.borderColor = "red";
            
        }
    }
    if(id=="namesurname"){
        var namesurname = document.getElementById(id).value;
        if(regName.test(namesurname)){
            document.getElementById(id).style.borderColor = "green";
        }
        else {
            document.getElementById(id).style.borderColor = "red";
            
        }
    }
    if(id=="username"){
        var username = document.getElementById(id).value;
        if(regUser.test(username)){
            document.getElementById(id).style.borderColor = "green";
        }
        else {
            document.getElementById(id).style.borderColor = "red";
            
        }
    }

});

