
var nameError = document.getElementById('name-error');//id=name-error in <span></span> orders.php
var phoneError = document.getElementById('phone-error');//https://www.w3schools.com/jsref/met_document_getelementbyid.asp
var emailError = document.getElementById('email-error');
var addressError = document.getElementById('address-error');
var submitError = document.getElementById('submit-error');
const isBetween = (length, min, max) => length < min || length > max ? false : true;//arrow function https://www.w3schools.com/js/js_arrow_function.asp

function validateName(){
    var name = document.getElementById('contact-name').value;
    const min = 3, max = 15;
    if(name.length == 0){
        nameError.innerHTML = "Username cannot be blank";//https://www.w3schools.com/jsref/prop_html_innerhtml.asp
        return false;
    }
    if(!isBetween(name.length, min, max)){
        nameError.innerHTML = `Username must be between ${min} and ${max} characters`;
        return false;
    }
    //regex https://www.javascripttutorial.net/javascript-dom/javascript-form-validation/
    if(!name.match(/^[A-Za-z]*\s{1}[A-Za-z]*$/)){ //REGEX first character alfabet and 1 space after that any character a-z
        nameError.innerHTML = "Name must contain only letters";
        return false;
    }
    nameError.innerHTML = "<img src='images/check.png' width='30px' height='30px'>";
    return true;
}

function validatePhone(){
    var phone = document.getElementById('contact-phone').value.trim();
    if(phone.length == 0){
        phoneError.innerHTML = "Phone cannot be empty";
        return false;
    }
    if(phone.length !== 11){
        phoneError.innerHTML = "Phone must be 11 digits";
        return false;
    }
    if(!phone.match(/^[0-9]{11}$/)){
        phoneError.innerHTML = "only digits are allowed";
        return false;
    }
    phoneError.innerHTML = "<img src='images/check.png' width='30px' height='30px'>";
    return true;
}

function validateEmail(){
    var email = document.getElementById('contact-email').value.trim();
    if(email.length == 0){
        emailError.innerHTML = "email cannot be empty";
        return false;
    }
    if(!email.match(/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/)){
        emailError.innerHTML = "Invalid email";
        return false;
    }
    emailError.innerHTML = "<img src='images/check.png' width='30px' height='30px'>";
    return true;
}

function validateAddress(){
    var address = document.getElementById('contact-address').value;
    var addressRegex = /^([a-zA-Z0-9\s,'-]{2,}),\s([a-zA-Z\s]{2,}),\s([a-zA-Z\s]{2,})$/;
    if(!address.match(addressRegex)){
        addressError.innerHTML =  "Adress is not valid.";
        return false;
    }
    addressError.innerHTML = "<img src='images/check.png' width='30px' height='30px'>";
    return true;
}
function validateForm(){
    if(!validateName() || !validatePhone() || !validateEmail() ||  !validateAddress()){
        submitError.style.display = "block";//will be visible https://www.w3schools.com/jsref/prop_style_display.asp
        submitError.innerHTML = "Please fix the errors in the form and try again.";
        //https://www.w3schools.com/jsref/met_win_settimeout.asp
        setTimeout(function(){submitError.style.display = "none";} , 3000);//after 3 sec it will hide error messsaage please fix the errors in the form and try again.
        return false;
    } else{
        submitError.innerHTML = "Form submitted successfully!";
        return true;
    }
}