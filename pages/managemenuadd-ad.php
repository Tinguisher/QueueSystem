<?php
// check if session is admin
include '../contexts/AdminSession.php';

// create sql to get food categories
$sql = "SELECT * FROM `food_categories`";

// try to get and catch if there is error
try {
    // prepare the statement
    $stmt = $mysqli->prepare($sql);

    // execute the statement
    $stmt->execute();

    // get the result from the statement
    $result = $stmt->get_result();

    // get all the values from the result
    $food_categories = $result->fetch_all(MYSQLI_ASSOC);

    // free data and close statement
    $result->free();
    $stmt->close();
}

// if there is error in query
catch (Exception $e) {
    // close the database
    $mysqli->close();

    // make an error response
    $response = [
        'status' => "error",
        'message' => "Error No: " . $e->getCode() . " - " . $e->getMessage()    // get error code and message
    ];

    print_r($response);
}

// close the database
$mysqli->close();

?>

<html>

<head>
    <link rel="stylesheet" href="../stylesheets/managemenuadd-ad.css">
    <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Roboto Slab' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Rhodium Libre' rel='stylesheet'>
    <link href='https://fonts.googleapis.com/css?family=Averia Serif Libre' rel='stylesheet'>

</head>

<body>
    <div class="pageadd">
        <div class="navbar">
            <div class="subnavbar1">SnapServe</div>
            <div class="subnavbar2">
                <ul>
                    <li><a href="./home-ad.php">Home</a></li>
                    <li><a href="./team-ad.php">Team</a></li>
                    <li><a href="./queueorder-ad.php">Queue Order</a></li>
                    <li><a href="./managemenu-ad.php"><span class="redtext">Manage Menu</span></a></li>
                    <li><a href="./history-ad.php">History</a></li>
                </ul>
            </div>
            <!--Profile and notif-->
            <div class="subnavbar3">
                <button class="dropbtn" onclick="myFunction()">
                    <div class="profile">
                        <div class="profileleft">
                            <img src="../images/weui_arrow-filled.svg">
                        </div>
                        <div class="profileright">
                            <img src="../images/iconamoon_profile.svg">
                        </div>
                    </div>
                    <div id="myDropdown" class="dropdown-content">
                        <a href="./profile-ad.php">Profile</a>
                        <a href="#logout">Logout</a>
                    </div>
                </button>
            </div>
            <!--Profile and notif end-->
        </div>
        <div class="managemenu-line"><a class="mm-line" href="./managemenu-ad.php">Manage Menu</a>> Add Menu</div>
        <form id="addMenuForm" class="forms">
            <div class="innerupperbox">
                <div class="upperboxone">
                    <div id="upperpic"></div><br><br>
                    <div class="upperchoosefile">
                        <label for="img">Choose File</label>
                        <input type="file" accept="image/*" name="input_image" class="invi" id="img" required />
                    </div>
                </div>

                <div class="upperboxtwo">
                    <label class="text" for="fname">Food Name</label><br>
                    <input class="textbox" type="text" id="fname" name="input_name" required>

                    <br><br><br>

                    <label class="text" for="price">Price</label><br>
                    <input class="textbox" type="number" id="price" name="input_price" required>

                    <br><br><br>
                    <div>
                        <label class="text" for="cuisine">Cusine:</label><br>
                        <select id="cuisine" name="input_category">
                            <?php
                            foreach ($food_categories as $food_category) {
                                echo '<option>' . $food_category['name'] . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="upperboxthree">
                    <label class="text" for="desc">Description</label><br>
                    <textarea class="textboxdesc" type="text" id="desc" name="input_description" maxlength="70" required></textarea>
                </div>
            </div>
            <div class="innerlowerbox">
                <div class="backbox">
                    <a href="./managemenu-ad.php">
                        <input type="button" value="Back">
                    </a>
                </div>
                <div class="subbox">
                    <input class="submission" type="submit">
                </div>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        var selDiv = "";
        var storedFiles = [];
        $(document).ready(function() {
            $("#img").on("change", handleFileSelect);
            selDiv = $("#upperpic");
        });

        function handleFileSelect(e) {
            var files = e.target.files;
            var filesArr = Array.prototype.slice.call(files);
            filesArr.forEach(function(f) {
                if (!f.type.match("image.*")) {
                    return;
                }
                storedFiles.push(f);

                var reader = new FileReader();
                reader.onload = function(e) {
                    var html =
                        '<img src="' +
                        e.target.result +
                        "\" data-file='" +
                        f.name +
                        "alt='Category Image' height='100%' width='100%'>";
                    selDiv.html(html);
                };
                reader.readAsDataURL(f);
            });
        }
    </script>

    <script src="../js/managemenuadd-ad.js"></script>

    <script src="../js/navbar-ad.js"></script>

</body>

</html>