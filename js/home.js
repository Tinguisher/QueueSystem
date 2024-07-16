// Load js if HTML is done
document.addEventListener('DOMContentLoaded', function(){

    // variables
    const sessionbutton = document.getElementById("sessionbutton");
    const sessiontext = document.getElementById("sessiontext");
    const dropdownBtnText = document.getElementById("drop-text");
    const list = document.getElementById("list");

    // if dropdown is clicked
    dropdownBtnText.onclick = function () {
        list.classList.toggle("show");
    };
    
    // if the user is logged in
    if (loggedin){
        // change the text to logout
        sessiontext.textContent = "Logout";

        // if there is click on logoutbutton
        sessionbutton.addEventListener('click', (ev) => {
            // prevent loading of website
            ev.preventDefault();

            // go to logout
            fetch ('../contexts/logout.php')
            .then (response => response.json())
                // get objects from fetch
                .then (data => {
                    // if the status is success
                    if (data.status == "success"){
                        // reload the website
                        window.location.reload();
                    }
                })
            // error checker
            .catch (error => console.error(error));
        });
    }

    // if there is no logged in
    else {
        // change the text to sign in
        sessiontext.textContent = "Sign in";

        // if there is click on logoutbutton
        sessionbutton.addEventListener('click', (ev) => {
            // prevent loading of website
            ev.preventDefault();

            // change the location to login
            window.location = '../pages/login.php';
        });
    }

    // get the menu for the popular
    fetch ('../contexts/HomePopularMenu.php')
    // get response as json
    .then (response => response.json())
        // get objects from fetch
        .then (data => {
            console.log (data);
            
        })
    // document.getElementById("men1").addEventListener('click', (ev) => {
    //     ev.preventDefault();
    //     console.log("tite")
    // });

    var counter = 1;

    setInterval(function(){
        document.getElementById('radio' + counter).checked = true;
        counter++;
        if(counter > 4){
        counter = 1;
        }
        
    }, 5000);
            
    

    var slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
        showSlides(slideIndex += n);
    }

    function showSlides(n) {
        var i = 0;
        
        var slides = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("dot");
        
        if (n > slides.length) { slideIndex = 1 }
        
        if (n < 1) { slideIndex = slides.length }
        
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
        }
        
        for (i = 0; i < dots.length; i++) {
            dots[i].className = dots[i].className.replace(" active", "");
        }
    }

    var slideIndex = 0;
    showSlides();
    function showSlides() {
        var i;  

        var slides = document.getElementsByClassName("mySlides");
        for (i = 0; i < slides.length; i++) {
            slides[i].style.display = "none";
            
        }
        slideIndex++;
        if (slideIndex > slides.length){ slideIndex = 1 }
        setTimeout(showSlides, 2000); 
    }
});