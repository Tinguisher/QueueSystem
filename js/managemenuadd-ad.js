// Load js if HTML is done
document.addEventListener('DOMContentLoaded', function () {
    // get the form
    const addMenuForm = document.getElementById("addMenuForm");

    // if there is submit on addmenuform
    addMenuForm.addEventListener('submit', (ev) =>{
        // prevent the site from loading
        ev.preventDefault();
        
        // get the value from the form
        const addmenu = new FormData(addMenuForm);

        fetch ('../contexts/CreateMenuProcess.php', {
            method: "POST",
            body: addmenu
        })

        // get response as json
        .then ( response => response.json() )
            // get objects from fetch
            .then (data => {

                console.log(data);
            })
        
        // error checker
        .catch ( error => console.error(error) );
    });
});