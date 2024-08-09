// Load js if HTML is done
document.addEventListener('DOMContentLoaded', function () {
    // get the variables from profile-ad.php
    const updateUserForm = document.getElementById("updateUserForm");

    // if there is submit on update user form
    updateUserForm.addEventListener('submit', (ev) => {
        // prevent the website from loading
        ev.preventDefault();

        // get the data from the form
        const update = new FormData(updateUserForm);

        // create object for each data in updateUserForm
        const payload = Object.fromEntries(update);

        // make a request to LoginProcess.php
        fetch('../contexts/UpdateUserProcess.php', {
            method: "POST",
            headers: {
                // state as a json type
                'Content-Type': 'application/json; charset=utf-8'
            },
            // convert js object to json
            body: JSON.stringify(payload)
        })

            // get response as json
            .then(response => response.json())

            // get objects from fetch
            .then(data => {
                // if update user is success
                if (data.status == "success") {
                    console.log(data.message);
                }

                // if status is not success
                else {
                    console.error(data.message);
                }
            })

            // error checker
            .catch(error => console.error(error));
    })

});