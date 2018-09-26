function nayta() {
  if (document.getElementById("piilo_ikkuna").style.display == "none"){
  document.getElementById("piilo_ikkuna").style.display = "block"}
  else {document.getElementById("piilo_ikkuna").style.display = "none"}
}
function nayta2() {
    if (document.getElementById("piilo_ikkuna2").style.display == "none"){
    document.getElementById("piilo_ikkuna2").style.display = "block"}
    else {document.getElementById("piilo_ikkuna2").style.display = "none"}
}
function nayta3() {
  if (document.getElementById("piilo_ikkuna3").style.display == "none"){
  document.getElementById("piilo_ikkuna3").style.display = "block"}
  else {document.getElementById("piilo_ikkuna3").style.display = "none"}
}
function loadXMLDoc(page) {
  var xhttp;
  if (window.XMLHttpRequest) {
    // code for modern browsers
    xhttp = new XMLHttpRequest();
    } else {
    // code for IE6, IE5
    xhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("content").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", page, true);
    xhttp.send();
  }
