// Load js if HTML is done
document.addEventListener('DOMContentLoaded', function () {

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
    if (loggedin) {
        // change the text to logout
        sessiontext.textContent = "Logout";

        // if there is click on logoutbutton
        sessionbutton.addEventListener('click', (ev) => {
            // prevent loading of website
            ev.preventDefault();

            // go to logout
            fetch('../contexts/logout.php')
                .then(response => response.json())
                // get objects from fetch
                .then(data => {
                    // if the status is success
                    if (data.status == "success") {
                        // reload the website
                        window.location.reload();
                    }
                })
                // error checker
                .catch(error => console.error(error));
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


});


// pop out after clicking cart in cards
function pop() {
    const papapapoppop = document.querySelector('.papapapoppop')
    if (papapapoppop.style.opacity == '1') {
        papapapoppop.style.opacity = '0';
        papapapoppop.style.visibility = 'hidden';
        return;
    }
    papapapoppop.style.opacity = '1';
    papapapoppop.style.visibility = 'visible';
}


var number1 = 0;
const numberDisplay1 = document.getElementById('numberDisplay1');

// increment number during carts
function increment1() {
    if (number1 > 98) return;
    number1++;
    numberDisplay1.textContent = number1;
}
// decrement number during carts
function decrement1() {
    if (number1 < 1) return;
    number1--;
    numberDisplay1.textContent = number1;
}


// const wrapper = document.querySelector(".wrapper");
// const carousel = document.querySelector(".carousel");
// const firstCardWidth = carousel.querySelector(".card").offsetWidth;
// const arrowBtns = document.querySelectorAll(".wrapper i");
// const carouselChildrens = [...carousel.children];

// let isDragging = false,
//     isAutoPlay = true,
//     startX, startScrollLeft, timeoutId;

// // Get the number of cards that can fit in the carousel at once
// let cardPerView = Math.round(carousel.offsetWidth / firstCardWidth);

// // Insert copies of the last few cards to beginning of carousel for infinite scrolling
// carouselChildrens.slice(-cardPerView).reverse().forEach(card => {
//     carousel.insertAdjacentHTML("afterbegin", card.outerHTML);
// });

// // Insert copies of the first few cards to end of carousel for infinite scrolling
// carouselChildrens.slice(0, cardPerView).forEach(card => {
//     carousel.insertAdjacentHTML("beforeend", card.outerHTML);
// });

// // Scroll the carousel at appropriate postition to hide first few duplicate cards on Firefox
// carousel.classList.add("no-transition");
// carousel.scrollLeft = carousel.offsetWidth;
// carousel.classList.remove("no-transition");

// // Add event listeners for the arrow buttons to scroll the carousel left and right
// arrowBtns.forEach(btn => {
//     btn.addEventListener("click", () => {
//         carousel.scrollLeft += btn.id == "left" ? -firstCardWidth : firstCardWidth;
//     });
// });

// const dragStart = (e) => {
//     isDragging = true;
//     carousel.classList.add("dragging");
//     // Records the initial cursor and scroll position of the carousel
//     startX = e.pageX;
//     startScrollLeft = carousel.scrollLeft;
// }

// const dragging = (e) => {
//     if (!isDragging) return; // if isDragging is false return from here
//     // Updates the scroll position of the carousel based on the cursor movement
//     carousel.scrollLeft = startScrollLeft - (e.pageX - startX);
// }

// const dragStop = () => {
//     isDragging = false;
//     carousel.classList.remove("dragging");
// }

// const infiniteScroll = () => {
//     // If the carousel is at the beginning, scroll to the end
//     if (carousel.scrollLeft === 0) {
//         carousel.classList.add("no-transition");
//         carousel.scrollLeft = carousel.scrollWidth - (2 * carousel.offsetWidth);
//         carousel.classList.remove("no-transition");
//     }
//     // If the carousel is at the end, scroll to the beginning
//     else if (Math.ceil(carousel.scrollLeft) === carousel.scrollWidth - carousel.offsetWidth) {
//         carousel.classList.add("no-transition");
//         carousel.scrollLeft = carousel.offsetWidth;
//         carousel.classList.remove("no-transition");
//     }

//     // Clear existing timeout & start autoplay if mouse is not hovering over carousel
//     clearTimeout(timeoutId);
//     if (!wrapper.matches(":hover")) autoPlay();
// }

// const autoPlay = () => {
//     if (window.innerWidth < 800 || !isAutoPlay) return; // Return if window is smaller than 800 or isAutoPlay is false
//     // Autoplay the carousel after every 2500 ms
//     timeoutId = setTimeout(() => carousel.scrollLeft += firstCardWidth, 2500);
// }
// autoPlay();

// carousel.addEventListener("mousedown", dragStart);
// carousel.addEventListener("mousemove", dragging);
// document.addEventListener("mouseup", dragStop);
// carousel.addEventListener("scroll", infiniteScroll);
// wrapper.addEventListener("mouseenter", () => clearTimeout(timeoutId));
// wrapper.addEventListener("mouseleave", autoPlay);



// const plus = document.querySelector(".plus"),
//     minus = document.querySelector(".minus"),
//     num = document.querySelector(".num");
// let a = 1;
// plus.addEventListener("click", () => {
//     a++;
//     a = (a < 10) ? "0" + a : a;
//     num.innerText = a;
// });
// minus.addEventListener("click", () => {
//     if (a > 1) {
//         a--;
//         a = (a < 10) ? "0" + a : a;
//         num.innerText = a;
//     }
// });