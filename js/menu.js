// Load js if HTML is done
document.addEventListener('DOMContentLoaded', function () {

    // variables
    const sessionbutton = document.getElementById("sessionbutton");
    const sessiontext = document.getElementById("sessiontext");
    const dropdownBtnText = document.getElementById("drop-text");
    const list = document.getElementById("list");
    const regularMenuCards = document.getElementById("regularMenuCards");
    var menuArray = [{}];

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


    // get all the menu
    fetch('../contexts/GetMenuProcess.php')
        // get response as json
        .then(response => response.json())
        // get objects from fetch
        .then(data => {
            // clear the values from regularMenuCards;
            regularMenuCards.innerHTML = "";

            // get the menu as a new array
            menuArray = data.menu.slice(0);

            // create menu cards
            menuArray.forEach(menu => {
                createMenuCards(menu);
            })

            // go to filtering and get the values
            const menuArrayFiltered = menuArray.filter(menuFiltering);

            function menuFiltering(menuArray) {
                return menuArray.categoryName == "Pizza";
            }
            console.log(menuArrayFiltered);
        })
        // error checker
        .catch(error => {
            // output the error in console
            console.error(error);
            // output the errors to html
            regularMenuCards.innerHTML = error;
        });


    // create cards for div regularMenuCards 
    createMenuCards = (menu) => {
        // create a div element
        const div = document.createElement('div');
        div.className = "men1";
        div.style = "margin-left: 36px; margin-top: 44px; display: inline-block";

        // put the div inside regularMenuCards
        regularMenuCards.appendChild(div);

        // create an img element
        const img = document.createElement('img');
        img.src = `../images/foodCategories/${menu.categoryName}/${menu.image}`
        img.style = "position: absolute; width: 200px; height: 221px";

        // put the img inside div
        div.appendChild(img);

        // create an input element //pls make this as p //pls make this as p //pls make this as p //pls make this as p
        const inputNew = document.createElement('input');
        inputNew.type = "text";
        inputNew.className = "new";
        inputNew.value = "";
        inputNew.readOnly = true;
        inputNew.style = "margin-top: 19px; margin-left: 214px;";

        // put the inputNew inside div
        div.appendChild(inputNew);

        // create an input element //pls make this as p //pls make this as p //pls make this as p //pls make this as p
        const foodName = document.createElement('input');
        foodName.type = "text";
        foodName.className = "menName";
        foodName.value = menu.foodName;
        foodName.readOnly = true;

        // put the foodName inside div
        div.appendChild(foodName);

        // create a p element
        const foodDescription = document.createElement('p');
        foodDescription.className = "men2";
        foodDescription.textContent = menu.description;

        // put the foodDescription inside div
        div.appendChild(foodDescription);

        // create an input element //pls make this as p //pls make this as p //pls make this as p //pls make this as p
        const foodPrice = document.createElement('input');
        foodPrice.type = "text";
        foodPrice.className = "dollar";
        foodPrice.value = `Php ${(Math.round(menu.price * 100) / 100).toFixed(2)}`; // convert into two decimal
        foodPrice.readOnly = true;

        // put the foodPrice inside div
        div.appendChild(foodPrice);

        // create an a element
        const a = document.createElement('a');
        a.className = "navcrcl";
        a.style = "margin-top: 160px; margin-left:480px";

        // put a inside div
        div.appendChild(a);

        // create a svg element
        const svg = document.createElementNS("http://www.w3.org/2000/svg", 'svg');
        svg.style = "margin-top: 10px; margin-left:10px;";
        svg.setAttribute('width', "30");
        svg.setAttribute('height', "30");
        svg.setAttribute('viewBox', "0 0 30 30");
        svg.setAttribute('fill', "none");

        // put the svg inside a
        a.appendChild(svg);

        // create a path element
        const path = document.createElementNS("http://www.w3.org/2000/svg", 'path');
        path.setAttribute('d', "M0 2.8125C0 2.56386 0.0987721 2.3254 0.274587 2.14959C0.450403 1.97377 0.68886 1.875 0.9375 1.875H3.75C3.95912 1.87506 4.16222 1.94503 4.327 2.0738C4.49177 2.20256 4.60877 2.38272 4.65937 2.58562L5.41875 5.625H27.1875C27.3252 5.62513 27.4611 5.65557 27.5857 5.71416C27.7102 5.77275 27.8204 5.85805 27.9082 5.96401C27.9961 6.06996 28.0596 6.19397 28.0941 6.32722C28.1287 6.46047 28.1335 6.59969 28.1081 6.735L25.2956 21.735C25.2554 21.9498 25.1414 22.1439 24.9733 22.2836C24.8052 22.4232 24.5936 22.4998 24.375 22.5H7.5C7.28144 22.4998 7.06981 22.4232 6.90171 22.2836C6.7336 22.1439 6.61959 21.9498 6.57938 21.735L3.76875 6.76313L3.01875 3.75H0.9375C0.68886 3.75 0.450403 3.65123 0.274587 3.47541C0.0987721 3.2996 0 3.06114 0 2.8125ZM5.81625 7.5L8.27812 20.625H23.5969L26.0588 7.5H5.81625ZM9.375 22.5C8.38044 22.5 7.42661 22.8951 6.72335 23.5984C6.02009 24.3016 5.625 25.2554 5.625 26.25C5.625 27.2446 6.02009 28.1984 6.72335 28.9016C7.42661 29.6049 8.38044 30 9.375 30C10.3696 30 11.3234 29.6049 12.0267 28.9016C12.7299 28.1984 13.125 27.2446 13.125 26.25C13.125 25.2554 12.7299 24.3016 12.0267 23.5984C11.3234 22.8951 10.3696 22.5 9.375 22.5ZM22.5 22.5C21.5054 22.5 20.5516 22.8951 19.8484 23.5984C19.1451 24.3016 18.75 25.2554 18.75 26.25C18.75 27.2446 19.1451 28.1984 19.8484 28.9016C20.5516 29.6049 21.5054 30 22.5 30C23.4946 30 24.4484 29.6049 25.1516 28.9016C25.8549 28.1984 26.25 27.2446 26.25 26.25C26.25 25.2554 25.8549 24.3016 25.1516 23.5984C24.4484 22.8951 23.4946 22.5 22.5 22.5ZM9.375 24.375C9.87228 24.375 10.3492 24.5725 10.7008 24.9242C11.0525 25.2758 11.25 25.7527 11.25 26.25C11.25 26.7473 11.0525 27.2242 10.7008 27.5758C10.3492 27.9275 9.87228 28.125 9.375 28.125C8.87772 28.125 8.40081 27.9275 8.04918 27.5758C7.69754 27.2242 7.5 26.7473 7.5 26.25C7.5 25.7527 7.69754 25.2758 8.04918 24.9242C8.40081 24.5725 8.87772 24.375 9.375 24.375ZM22.5 24.375C22.9973 24.375 23.4742 24.5725 23.8258 24.9242C24.1775 25.2758 24.375 25.7527 24.375 26.25C24.375 26.7473 24.1775 27.2242 23.8258 27.5758C23.4742 27.9275 22.9973 28.125 22.5 28.125C22.0027 28.125 21.5258 27.9275 21.1742 27.5758C20.8225 27.2242 20.625 26.7473 20.625 26.25C20.625 25.7527 20.8225 25.2758 21.1742 24.9242C21.5258 24.5725 22.0027 24.375 22.5 24.375Z");
        path.setAttribute('fill', "#FFFFFF");

        // put the path inside svg
        svg.appendChild(path);


        // create on click listener for each div
        div.addEventListener('click', (ev) => {
            // prevent loading of website
            ev.preventDefault();

            // create function to process the click
            menuOnClick(menu);

        });
    }

    // if there is click in individual menu cards
    function menuOnClick(menu) {
        console.log(menu.id);

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


const wrapper = document.querySelector(".wrapper");
const carousel = document.querySelector(".carousel");
const firstCardWidth = carousel.querySelector(".card").offsetWidth;
const arrowBtns = document.querySelectorAll(".wrapper i");
const carouselChildrens = [...carousel.children];

let isDragging = false,
    isAutoPlay = true,
    startX, startScrollLeft, timeoutId;

// Get the number of cards that can fit in the carousel at once
let cardPerView = Math.round(carousel.offsetWidth / firstCardWidth);

// Insert copies of the last few cards to beginning of carousel for infinite scrolling
carouselChildrens.slice(-cardPerView).reverse().forEach(card => {
    carousel.insertAdjacentHTML("afterbegin", card.outerHTML);
});

// Insert copies of the first few cards to end of carousel for infinite scrolling
carouselChildrens.slice(0, cardPerView).forEach(card => {
    carousel.insertAdjacentHTML("beforeend", card.outerHTML);
});

// Scroll the carousel at appropriate postition to hide first few duplicate cards on Firefox
carousel.classList.add("no-transition");
carousel.scrollLeft = carousel.offsetWidth;
carousel.classList.remove("no-transition");

// Add event listeners for the arrow buttons to scroll the carousel left and right
arrowBtns.forEach(btn => {
    btn.addEventListener("click", () => {
        carousel.scrollLeft += btn.id == "left" ? -firstCardWidth : firstCardWidth;
    });
});

const dragStart = (e) => {
    isDragging = true;
    carousel.classList.add("dragging");
    // Records the initial cursor and scroll position of the carousel
    startX = e.pageX;
    startScrollLeft = carousel.scrollLeft;
}

const dragging = (e) => {
    if (!isDragging) return; // if isDragging is false return from here
    // Updates the scroll position of the carousel based on the cursor movement
    carousel.scrollLeft = startScrollLeft - (e.pageX - startX);
}

const dragStop = () => {
    isDragging = false;
    carousel.classList.remove("dragging");
}

const infiniteScroll = () => {
    // If the carousel is at the beginning, scroll to the end
    if (carousel.scrollLeft === 0) {
        carousel.classList.add("no-transition");
        carousel.scrollLeft = carousel.scrollWidth - (2 * carousel.offsetWidth);
        carousel.classList.remove("no-transition");
    }
    // If the carousel is at the end, scroll to the beginning
    else if (Math.ceil(carousel.scrollLeft) === carousel.scrollWidth - carousel.offsetWidth) {
        carousel.classList.add("no-transition");
        carousel.scrollLeft = carousel.offsetWidth;
        carousel.classList.remove("no-transition");
    }

    // Clear existing timeout & start autoplay if mouse is not hovering over carousel
    clearTimeout(timeoutId);
    if (!wrapper.matches(":hover")) autoPlay();
}

const autoPlay = () => {
    if (window.innerWidth < 800 || !isAutoPlay) return; // Return if window is smaller than 800 or isAutoPlay is false
    // Autoplay the carousel after every 2500 ms
    timeoutId = setTimeout(() => carousel.scrollLeft += firstCardWidth, 2500);
}
autoPlay();

carousel.addEventListener("mousedown", dragStart);
carousel.addEventListener("mousemove", dragging);
document.addEventListener("mouseup", dragStop);
carousel.addEventListener("scroll", infiniteScroll);
wrapper.addEventListener("mouseenter", () => clearTimeout(timeoutId));
wrapper.addEventListener("mouseleave", autoPlay);



const plus = document.querySelector(".plus"),
    minus = document.querySelector(".minus"),
    num = document.querySelector(".num");
let a = 1;
plus.addEventListener("click", () => {
    a++;
    a = (a < 10) ? "0" + a : a;
    num.innerText = a;
});
minus.addEventListener("click", () => {
    if (a > 1) {
        a--;
        a = (a < 10) ? "0" + a : a;
        num.innerText = a;
    }
});