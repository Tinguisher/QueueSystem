// Load js if HTML is done
document.addEventListener('DOMContentLoaded', function(){

    // variables
    const sessionbutton = document.getElementById("sessionbutton");
    const sessiontext = document.getElementById("sessiontext");
    const dropdownBtnText = document.getElementById("drop-text");
    const list = document.getElementById("list");
    const popularmenu = document.getElementById("popularmenu");
    const menucard = document.getElementsByClassName("menucard");

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

            console.log (data.menu);

            let menuHTML = "";

            data.menu.forEach( menu => {
                menuHTML = menuHTML + `<div id="menu${menu.id}" class="menucard" margin-top: 526px; margin-left: 220px;">
                    <img src="../images/foods/${menu.categoryName}/${menu.image}" style="position: absolute;">
                    <input type="text" class="menName" value="${menu.foodName}" readonly>
                    <p id="men2">${menu.description}</p>
                    <input type="text" class="dollar" value="$${menu.price}" readonly>
                    <a href="menu.html" id="navcrcl" style="margin-top: 180px; margin-left:600px">
                        <svg style="margin-top: 10px; margin-left:10px" xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30" fill="none">
                            <path d="M0 2.8125C0 2.56386 0.0987721 2.3254 0.274587 2.14959C0.450403 1.97377 0.68886 1.875 0.9375 1.875H3.75C3.95912 1.87506 4.16222 1.94503 4.327 2.0738C4.49177 2.20256 4.60877 2.38272 4.65937 2.58562L5.41875 5.625H27.1875C27.3252 5.62513 27.4611 5.65557 27.5857 5.71416C27.7102 5.77275 27.8204 5.85805 27.9082 5.96401C27.9961 6.06996 28.0596 6.19397 28.0941 6.32722C28.1287 6.46047 28.1335 6.59969 28.1081 6.735L25.2956 21.735C25.2554 21.9498 25.1414 22.1439 24.9733 22.2836C24.8052 22.4232 24.5936 22.4998 24.375 22.5H7.5C7.28144 22.4998 7.06981 22.4232 6.90171 22.2836C6.7336 22.1439 6.61959 21.9498 6.57938 21.735L3.76875 6.76313L3.01875 3.75H0.9375C0.68886 3.75 0.450403 3.65123 0.274587 3.47541C0.0987721 3.2996 0 3.06114 0 2.8125ZM5.81625 7.5L8.27812 20.625H23.5969L26.0588 7.5H5.81625ZM9.375 22.5C8.38044 22.5 7.42661 22.8951 6.72335 23.5984C6.02009 24.3016 5.625 25.2554 5.625 26.25C5.625 27.2446 6.02009 28.1984 6.72335 28.9016C7.42661 29.6049 8.38044 30 9.375 30C10.3696 30 11.3234 29.6049 12.0267 28.9016C12.7299 28.1984 13.125 27.2446 13.125 26.25C13.125 25.2554 12.7299 24.3016 12.0267 23.5984C11.3234 22.8951 10.3696 22.5 9.375 22.5ZM22.5 22.5C21.5054 22.5 20.5516 22.8951 19.8484 23.5984C19.1451 24.3016 18.75 25.2554 18.75 26.25C18.75 27.2446 19.1451 28.1984 19.8484 28.9016C20.5516 29.6049 21.5054 30 22.5 30C23.4946 30 24.4484 29.6049 25.1516 28.9016C25.8549 28.1984 26.25 27.2446 26.25 26.25C26.25 25.2554 25.8549 24.3016 25.1516 23.5984C24.4484 22.8951 23.4946 22.5 22.5 22.5ZM9.375 24.375C9.87228 24.375 10.3492 24.5725 10.7008 24.9242C11.0525 25.2758 11.25 25.7527 11.25 26.25C11.25 26.7473 11.0525 27.2242 10.7008 27.5758C10.3492 27.9275 9.87228 28.125 9.375 28.125C8.87772 28.125 8.40081 27.9275 8.04918 27.5758C7.69754 27.2242 7.5 26.7473 7.5 26.25C7.5 25.7527 7.69754 25.2758 8.04918 24.9242C8.40081 24.5725 8.87772 24.375 9.375 24.375ZM22.5 24.375C22.9973 24.375 23.4742 24.5725 23.8258 24.9242C24.1775 25.2758 24.375 25.7527 24.375 26.25C24.375 26.7473 24.1775 27.2242 23.8258 27.5758C23.4742 27.9275 22.9973 28.125 22.5 28.125C22.0027 28.125 21.5258 27.9275 21.1742 27.5758C20.8225 27.2242 20.625 26.7473 20.625 26.25C20.625 25.7527 20.8225 25.2758 21.1742 24.9242C21.5258 24.5725 22.0027 24.375 22.5 24.375Z" fill="#FFFFFF"/>
                        </svg>
                    </a>
                </div>`;
            })

            // edit inner html of popularmenu
            popularmenu.innerHTML = menuHTML;
        })

    // error checker
    .catch ( error => console.error(error) );
    
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