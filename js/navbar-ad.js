/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
var dropdowns = document.getElementsByClassName("dropdown-content");
var i;
var openDropdown = dropdowns[i];
function myFunction() {
    document.getElementById("myDropdown").classList.toggle("show");
  }
  
  // Close the dropdown if the user clicks outside of it
  window.onclick = function(event) {
    if (!event.target.matches('.dropbtn')) {
      
      for (i = 0; i < dropdowns.length; i++) {
        if (openDropdown.classList.contains('show')) {
          openDropdown.classList.remove('show');
        }
      }
    }
  }