// Load js if HTML is done
document.addEventListener('DOMContentLoaded', function(){
    console.log("HTML is done");

    // variables
    const addmenuform = document.getElementById("addMenu");

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