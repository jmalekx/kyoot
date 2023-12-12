<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="css/reset.css" />
    <link rel="stylesheet" type="text/css" href="css/homepage.css" />

    <!--google fonts-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Comfortaa:wght@300;400;700&family=Rajdhani:wght@300;500;700&display=swap"
        rel="stylesheet" />
</head>

<body>
    <div class="container">
        <div class="nav-wrapper">
            <div class="logo">
                <a href="homepage.html">
                    <img src="images/kyootLogo.png" alt="logo" style="width: 100px; height: auto" /></a>
            </div>

            <nav class="primary-navigation">
                <ul class="nav-list fw-bold fs-500">
                    <li><a href="myProfile.html">My Kyoot</a></li>
                    <!-- <li><a href="settings.html">Settings</a></li> -->
                    <li><a href="homepage.html">Home</a></li>
                    <!-- <li><a href="signup.html">Sign up</a></li>
            <li><a href="login.html">Login</a></li> -->
                </ul>
            </nav>
        </div>
    </div>

    <!-- change css settings -->

    <div class="dropdown">
        <button onclick="myFunction()" class="dropbtn">Settings</button>
        <div id="myDropdown" class="dropdown-content">
            <p id="dropDownHeading">Appearance</p>
            <a href="myProfile.html">Default</a>
            <a href="myProfileRed.html">Red</a>
            </ul>
            </li>
        </div>
    </div>

    <main>
        <div class="container">
            <div class="even-columns myProjects">
                <div>
                    <h1 class="myProfileHeading fw-bold fs-800">My Projects</h1>
                </div>
                <!-- <div>
                    <a href="php/addEntry.php">Go to blog</a>
                </div> -->
                <div>
                    <h2>GALLERY</h2>
                </div>
                <!-- <div>
          <label for="image_input">+ Add Project</label>
          <input type="file" name="" style="visibility:hidden;" id="image_input" accept="image/png, image/jpg">
          <a href="#inside project">
            <div id="display_image"></div>
          </a>

        </div> -->
            </div>
        </div>

        <!-- ------------------------------------------- -->

        <section>
            <div class="container">
                <div class="even-columns myPosts">
                    <h2 class="fs-secondary-heading fw-bold center "> My posts: </h2>
                    <div class="grid-layout-blogs">

                        <div class="tempPostBox">
                            <img src="images/orangeMug.jpg" alt="orange mug here" class="postImage"
                                style="width: 200px; height: auto">
                            <div class="gap">
                                <p class="fw-bold fs-500 ">Copper Mug Hug</p>
                            </div>
                            <div class="gap">
                                <a href="#" class="text-decoration viewBtn">View</a>
                            </div>

                        </div>
                        <div class="tempPostBox">
                            <img src="images/sheepMug.jpg" alt="sheep mug" class="postImage"
                                style="width: 200px; height: auto">
                            <div class="gap">
                                <p class="fw-bold fs-500 ">mug cosy</p>
                            </div>
                            <div class="gap"><a href="#" class="text-decoration viewBtn">View</a></div>



                        </div>
                        <div class="tempPostBox">
                            <img src="images/wineCover.jpg" alt="sheep mug" class="postImage"
                                style="width: 200px; height: auto">
                            <div class="gap">
                                <p class="fw-bold fs-500 ">Chardonnay Wine Bottle Cozy</p>
                            </div>
                            <div class="gap">
                                <a href="#" class="text-decoration viewBtn">View</a>
                            </div>

                        </div>
                    </div>

                    <div class="grid-layout-blogs">

                        <?php
                        // backend
                        // connects to a MySQL database and selects all the data from the "data" table. 
                        $conn = mysqli_connect("localhost", "root", "", "kyoot_db");
                        $sql = "SELECT * FROM blogs";
                        //parameters - connection, sql query string
                        $query = mysqli_query($conn, $sql);

                        //// If the request parameter "new_post" is set, it inserts a new post into the "data" table
                        //  using the title and content values from the form, and then redirects the user to the
                        //  homepage with a message indicating that a post has been added.
                        if (isset($_REQUEST["new_post"])) {
                            $title = $_REQUEST["title"];
                            $content = $_REQUEST["content"];
                            $imagePicture = $_REQUEST["imagePicture"];
                            $linkURL = $_REQUEST["linkURL"];

                            $sql = "INSERT INTO blogs(title, content) VALUES ('$title', '$content', '$imagePicture', '$linkURL')";
                            mysqli_query($conn, $sql);

                            header("Location: ../homepage.php?info=added");
                            exit();
                        }



                        // sorting the array of results by the time_stamp column in descending order
                        
                        // retrieves all rows from a MySQLi query result and stores them in an array of associative arrays. 
                        //parameters are, reslut, result type - the type of array that should be produced
                        //The keys in each associative array correspond to the column names of the retrieved rows.
                        $results_array = mysqli_fetch_all($query, MYSQLI_ASSOC);

                        //array_column extracts a column of data from the $results_array array and stores it in a new array called $time_stamps
                        // the first argument is the input array, the second argument is the name or index of the column that you want to extract the values from
                        //$time_stamps = array_column($results_array, 'time_stamp');
                        
                        // sorts the $results_array array based on the values in the $time_stamps array.
                        //sorting will be based on the values in the $time_stamps array, and the corresponding values in the $results_array array will be rearranged according to the sort order of the $time_stamps array.
                        // The SORT_DESC constant specifies that the sorting should be in descending order.
                        //array_multisort($time_stamps, SORT_DESC, $results_array);
                        
                        // displaying the sorted results
                        foreach ($results_array as $q) {
                            ?>
                        <div>
                            <div>
                                <div class="blog_posts tempPostBox">
                                    <h1 class="fs-primary-heading fw-bold">
                                        <?php echo $q['title']; ?>
                                    </h1>

                                    <!-- limit the content of the blog post to the first 100 characters, so it doesnt take up too much space -->
                                    <p>
                                        <?php echo substr($q['content'], 0, 100); ?>
                                    </p>

                                    <!-- Debugging: Output the image path -->
                                    <!-- <p>Image Path:
                                        <img src="../uploads.kyootLogo.png" alt="BOOM">
                                        <?php //echo $q['imagePicture']; ?>
                                    </p> -->

                                    <!-- 
                    <p>
                      <?php //echo substr($q['linkURL'], 0, 100); ?>
                    </p> -->

                                </div>
                            </div>
                        </div>
                        <?php } ?>

                        <div>
                            <button class="dropbtn"><a href="php/addEntry.php" class="text-decoration">Add another
                                    post</a></button>
                        </div>




                    </div>

                </div>
            </div>
        </section>


    </main>


    <script>
    /* When the user clicks on the button, 
                                            toggle between hiding and showing the dropdown content */
    function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(event) {
        if (!event.target.matches(".dropbtn")) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains("show")) {
                    openDropdown.classList.remove("show");
                }
            }
        }
    };

    // image js
    const image_input = document.querySelector("#image_input")
    var uploaded_image = "";

    image_input.addEventListener("change", function() {
        //console.log(image_input.value);

        //to read what file user selected:
        const reader = new FileReader();
        reader.addEventListener("load", () => {
            uploaded_image = reader
                .result; //once impage is uploaded we store it in this variable and we are gna read file using reader object
            document.querySelector("#display_image").style.backgroundImage = `url(${uploaded_image})`;

        });
        reader.readAsDataURL(this.files[0]);
    })
    </script>

</body>

<footer>Kyoot 2023 &copy;</footer>

</html>