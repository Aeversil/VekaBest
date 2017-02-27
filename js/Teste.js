//AFBLIJVEN
//laat bepaalde text zie wanneer je op pagina drukt
//DEZE FUNCTIE LAAT ME DOOR DE PAGINA'S HEEN NAVIGEREN
 function openPage(paginanaam){
   paginanaam = paginanaam || "default";

    var i;
    var x = document.getElementsByClassName('pagina');
        for(i = 0; i < x.length; i++){
          x[i].style.display = "none";
        }
    if(paginanaam !== "default"){
      document.getElementById(paginanaam).style.display = "block";
    }
 }
 openPage();

//DIT IS DE FUNCTIE VOOR DROPDOWNMENU
 function dropdownmenu() {
   //DE TOGGLE IS ER VOOR SHOW OF HIDE
    document.getElementById("mydropdown").classList.toggle("show");
}
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {

    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
