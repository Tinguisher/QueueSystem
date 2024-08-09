// Load js if HTML is done
document.addEventListener('DOMContentLoaded', function () {
    // get global variables
    const teamContainer = document.querySelector("[data-team-container]");

    // create a fetch to get the team
    fetch('../contexts/GetTeamProcess.php')
        // get response as json
        .then(response => response.json())

        // get objects from fetch
        .then(data => {
            console.log(data);

            // create rows per team
            createTeamRows(data.team)
        })

        // error checker
        .catch(error => {
            // output the error in console and container
            console.error(error);
            teamContainer.innerHTML = error;
        });

    // create team process
    createTeamRows = (teams) => {
        // clear the team container
        teamContainer.innerHTML = "";

        // loop to create row per team
        teams.forEach(team => {
            // get the element template from summary-ad.php
            const teamTemplate = document.querySelector("[data-team-template]");
            const row = teamTemplate.content.cloneNode(true).children[0];

            // get the template child that needs value to be displayed
            const userID = row.querySelector("[data-user-id]");
            const firstName = row.querySelector("[data-first-name]");
            const lastName = row.querySelector("[data-last-name]");
            const joinDate = row.querySelector("[data-join-date]");
            const station = row.querySelector("[data-station]");

            // place the variables got from fetch to the row
            userID.textContent = team.id;
            firstName.textContent = team.firstname;
            lastName.textContent = team.lastname;
            joinDate.textContent = team.joinDate;
            station.textContent = team.authtype;

            // put each row inside the container
            teamContainer.appendChild(row);
        });
    }
});