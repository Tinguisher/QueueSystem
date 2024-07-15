// Load js if HTML is done
document.addEventListener('DOMContentLoaded', function(){

    // variables
    const logoutbutton = document.getElementById("logoutbutton");
    const dropdownBtnText = document.getElementById("drop-text");
    const list = document.getElementById("list");


    // if there is click on logoutbutton
    logoutbutton.addEventListener("click", (ev) => {
        // prevent loading of website
        ev.preventDefault();

        // go to logout
        fetch ('../contexts/logout.php')
        .then (response => response.json())
            // get objects from fetch
            .then (data => {
                console.log(data);
                if (data.status == "success"){
                    window.location = '../pages/home.php';
                }
            })
        // error checker
        .catch (error => console.error(error));

    });
    

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
            
    dropdownBtnText.onclick = function () {
    list.classList.toggle("show");
    };

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