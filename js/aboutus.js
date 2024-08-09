// Load js if HTML is done
document.addEventListener('DOMContentLoaded', function () {
    // get all id, class for global variable
    const searchInput = document.getElementById("searchInput");
    const dropdownBtnText = document.getElementById("drop-text");

    // if dropdown is clicked
    dropdownBtnText.onclick = function () {
        const list = document.getElementById("list");
        list.classList.toggle("show");
    };

    // logout process
    logout = () => {
        // go to logout.php
        fetch('../contexts/logout.php')
            // get response as json
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
    }

    // get the menu for the popular
    fetch('../contexts/GetMenuProcess.php')
        // get response as json
        .then(response => response.json())
        // get objects from fetch
        .then(data => {
            // get the data.menu as global variable for search
            menuArray = data.menu;

            // loop the menuArray to show at search
            menuSearch = menuArray.map(menu => {
                // get the dropdownsearch container
                const dropdownSearch = document.getElementById("dropdownSearch");

                // create a p element with menu name contexts
                const option = document.createElement('p');
                option.textContent = menu.foodName;
                option.style.display = "none";
                option.className = "searchleft";
                dropdownSearch.style = "display:none";

                // if there is click in option
                option.addEventListener('click', () => {
                    window.location = `./menu.php?menuID=${menu.id}`
                });

                // put the option from search to the div
                dropdownSearch.appendChild(option);

                // return the food element and name for filtering
                return {
                    foodName: menu.foodName,
                    element: option
                }
            });
        })

        // error checker
        .catch(error => {
            // output the error in console
            console.error(error);
        });

    // if there is an input of the search bar
    searchInput.addEventListener('input', () => {
        // loop the menu that will be used to search
        menuSearch.forEach(menu => {
            // check if foodName option should be visible or not
            const optionVisibility = searchInput.value ? menu.foodName.toLowerCase().includes(searchInput.value.toLowerCase()) : false;

            // if it is visible, block. If not then none
            menu.element.style.display = optionVisibility ? "block" : "none";
            searchInput.value ? dropdownSearch.style.display = "block": dropdownSearch.style.display = "none";
        });
    });
});