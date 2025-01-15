function getYear() {
    document.getElementById("year").innerHTML = new Date().getFullYear();//https://www.w3schools.com/jsref/jsref_getyear.asp
};
// I faced the problem of uninitialized variable so I found the solution here
// https://stackoverflow.com/questions/18239430/cannot-set-property-innerhtml-of-null
window.onload = function() {
    getYear();
}