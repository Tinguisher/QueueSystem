// Load js if HTML is done
document.addEventListener('DOMContentLoaded', function(){
    console.log("HTML is done");

    // variables
    const addmenuform = document.getElementById("addMenu");
    const addgenreform = document.getElementById("addGenre");

    // if there is submit on addgenreform
    addgenreform.addEventListener('submit', (ev) =>{
        // prevent the site from loading
        ev.preventDefault();

        // create an object to pass as json
        const genreobject = {
            input_genre: document.querySelector('input[name="input_genre"]').value
        }

        // make a request to addgenreprocess.php
        fetch ('../contexts/addgenreprocess.php', {
            method: "POST",
            headers: {
                // state as a json type
                'Content-Type': 'application/json; charset=utf-8'
            },
            // convert js object to json
            body: JSON.stringify(genreobject)
        })
        
        // get response as json
        .then (response => response.json())
            // get objects from fetch
            .then (data => {
                console.log (data); 
            })

        // error checker
        .catch (error => console.error(error));


    });

    // if there is submit on addmenuform
    addmenuform.addEventListener('submit', (ev) =>{
        ev.preventDefault();    // prevent the site from loading
        
        const addmenu = new FormData(addmenuform);

        fetch ('../contexts/addmenuprocess.php', {
            method: "POST",
            body: addmenu
        })

        // get response as json
        .then ( response => response.json() )
            // get objects from fetch
            .then (data => {
                console.log(data);
                // redirect to dashboard if success
                if (data.status == "success"){
                }
            })
        
        // error checker
        .catch ( error => console.error(error) );

    });

});