<?php
session_start();

include "addPost.php";


?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" type="text/css" href="../css/reset.css" />
    <link rel="stylesheet" type="text/css" href="../css/homepage.css" />

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
                    <li><a href="../homepage.html">Home</a></li>
                    <li><a href="../signup.html">Sign up</a></li>
                    <li><a href="../login.html">Login</a></li>
                </ul>
            </nav>
        </div>
    </div>


    <!-- BLOG FORM HERE  -->

    <main class="">



        <section class="padding-block-900 ">

            <div class="container">
                <div class="even-columns">



                    <div>
                        <div>
                            <h1 class="myPostHeading fw-bold fs-800">Create Post: </h1>
                        </div>

                        <div class="container-posts">

                            <form id="add_post_form" method="POST" enctype="multipart/form-data"
                                onsubmit="return check_blank()">
                                <fieldset>
                                    <div>
                                        <div class="blog-input">
                                            <!-- <input type="text" name="title" id="title" placeholder="Title"/> -->
                                            <input type="text" name="title" id="title" placeholder="Title"
                                                value="<?php echo $_GET['title'] ?? ''; ?>" />
                                        </div>
                                        <div class="blog-input">
                                            <!-- name attribute used as a reference when the data is submitted- so we can access the data inside the input tags-->


                                            <!-- This code checks if the title and content parameters are present in the query string using the null coalescing operator (??). 
                                        If they are present, the values are used to pre-populate the corresponding form inputs using the value attribute for the title 
                                        input and the text between the opening and closing tags for the content textarea. If they are not present, 
                                        the inputs are left blank. -->
                                            <textarea name="content" id="content"
                                                placeholder="Enter your text here"><?php echo $_GET['content'] ?? ''; ?></textarea>
                                        </div>
                                        <!-- <div class="blog-input">
                                            <label for="image_input">+ Add Picture</label>
                                            <input type="file" name="" style="visibility:hidden;" id="image_input"
                                                accept="image/png, image/jpg">
                                            <a href="#inside project">
                                                <div id="display_image">
                                                    <?php echo $_GET['imagePicture'] ?? ''; ?>
                                                </div>
                                            </a>
                                        </div> -->
                                        <div class="blog-input">
                                            <label for="image_input">+ Add Picture</label>
                                            <input type="file" name="imagePicture" id="image_input"
                                                accept="image/png, image/jpg">
                                            <a href="#inside project">
                                                <div id="display_image">
                                                    <?php echo isset($_GET['imagePicture']) ? '<img src="' . $_GET['imagePicture'] . '" alt="Preview">' : ''; ?>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="blog-input">
                                            <textarea name="linkURL" id="linkURL" cols="30" rows="10"
                                                placeholder="Enter a link here"><?php echo $_GET['linkURL'] ?? ''; ?></textarea>

                                        </div>
                                    </div>
                                    <div class="blog-button-flex">
                                        <div>
                                            <input type="submit" name="new_post" value="Submit"
                                                class="blog-button-style fw-bold button" />
                                            <a href="../myProfile.php">> Go back to my kyoot << /a>
                                        </div>
                                        <div>
                                            <button class="blog-button-style fw-bold button"
                                                onclick="clear_button()">Clear</button>
                                        </div>

                                    </div>
                                </fieldset>
                            </form>




                            <script>
                                function clear_button() {
                                    document.getElementById("title").value = "";
                                    document.getElementById("content").value = "";
                                }





                                // in the event that the blog has not been filled out fully
                                function check_blank() {
                                    if (document.getElementById('title').value == "") {
                                        document.getElementById('title').style.borderColor = "red";
                                        // pause form from submitting
                                        return false;
                                    }
                                    if (document.getElementById('content').value == "") {
                                        document.getElementById('content').style.borderColor = "red";
                                        return false;
                                    }
                                    if (document.getElementById('title').value == "" && document.getElementById('content')
                                        .value == "") {
                                        document.getElementById('title').style.borderColor = "red";
                                        document.getElementById('content').style.borderColor = "red";
                                        return false;
                                    }
                                }

                                function displayImagePreview(input) {
                                    var previewArea = document.getElementById('display_image');

                                    if (input.files && input.files[0]) {
                                        var reader = new FileReader();

                                        reader.onload = function (e) {
                                            // Create an image element and set the source to the selected file
                                            var imgElement = document.createElement('img');
                                            imgElement.src = e.target.result;
                                            imgElement.alt = 'Preview';

                                            // Remove any existing content in the preview area
                                            while (previewArea.firstChild) {
                                                previewArea.removeChild(previewArea.firstChild);
                                            }

                                            // Append the new image element to the preview area
                                            previewArea.appendChild(imgElement);
                                        };

                                        reader.readAsDataURL(input.files[0]);
                                    }
                                }



                                // function preview_post() {

                                //     // Get the title and content values from the form
                                //     var title = document.getElementById("title").value;
                                //     var content = document.getElementById("content").value;

                                //     if (title.trim() !== "" && content.trim() !== "") {


                                //         // URL encode the content and title for use in the query string
                                //         var encodedTitle = encodeURIComponent(title);
                                //         var encodedContent = encodeURIComponent(content);

                                //         // Redirect the user to preview.php - content and title as query parameters
                                //         window.location.href = "preview.php?title=" + encodedTitle + "&content=" +
                                //             encodedContent;

                                //     } else {
                                //         document.getElementById('title').style.borderColor = "red";
                                //         document.getElementById('content').style.borderColor = "red";
                                //     }
                                // }
                            </script>


                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
        <main></main>

        <footer class="padding-block-700 bg-primary-100 text-neutral-100">
            <section class="padding-block-900">
                <div class="container">
                    <div class="even-columns">
                        <div class="nav-list-footer">
                            <a href="../contact.html">Contact</a>
                        </div>
                        <div>
                            <p>Darena Gospodinova 2023 ©</p>
                        </div>

                    </div>
                </div>
            </section>
        </footer>




</body>

</html>

<?php
// checking whether a session is active
// If a session is active, the PHP code continues to render HTML code until the </html> closing tag.
// }else{
//      header("Location: index.php");
//      exit();
// }
?>