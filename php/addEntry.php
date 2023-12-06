<?php 
session_start();

include "addPost.php";
    

 ?>
<!DOCTYPE html>
<html>
    <head>
          

            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>My Website</title>
            <link rel="stylesheet" href="../css/reset.css">
            <link rel="stylesheet" type="text/css" href="../css/homepage.css" />
          
            <!-- google fonts -->
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@300;500;700&display=swap" rel="stylesheet">
            
        </head>


<body class="background-image">
    <header class="primary-header">
      <div class="container">
          <div class="nav-wrapper">
              <a href="#"><img src="../images/shrek-logo.png" alt="logo" width="200"></a> 
              <!-- <button class="mobile-nav-toggle" aria-controls="primary-navigation">  aria controls - identifies the element (or elements) whose contents or presence are controlled by the element on which the attribute is set -->
                  <!-- <img class="icon-menu" src="./images/menu-icon.svg" alt="" width="15"> 
                  <img class="icon-close" src="./images/close-icon.png" alt="" width="15">
                  <span class="visually-hidden">Menu</span> 
              </button>  -->
              <nav class="primary-navigation">
                  <ul class="nav-list" id="primary-navigation">
                      <li><a href="../homepage.php">Home</a></li>
                      
                  </ul>
              </nav> 
              <a href="../blog.html" class="link-button"><button class="button">Blog</button></a>
          </div>
      </div>

      
      </header>


        <!-- BLOG FORM HERE  -->

            <main class="">
        


        <section class="padding-block-900 ">
            
            <div class="container">
            <div class="even-columns">
                <div>
                    <p class="fs-secondary-heading fw-bold">Hello </p>
                </div>
                <div>
                    <a href="logout.php" class="logout_button fw-bold">Logout</a>
                </div>
                
            </div>
            
                <div class="container-blog ">
                    <div>
                    <h1 class="fs-primary-heading fw-bold">Welcome to Blog!</h1>
                    </div>

                        <div class="blog-main ">
                            <h2 class="fs-secondary-heading fw-bold">Blog</h2>

                            <form id="add_blog_form" method="GET" onsubmit="return check_blank()">
                            <fieldset>
                                <div class="blog-input">
                                    <div>
                                        <!-- <input type="text" name="title" id="title" placeholder="Title"/> -->
                                        <input type="text" name="title" id="title" placeholder="Title" value="<?php echo $_GET['title'] ?? ''; ?>"/>
                                    </div>
                                    <div>
                                        <!-- name attribute used as a reference when the data is submitted- so we can access the data inside the input tags-->
                                        

                                        <!-- This code checks if the title and content parameters are present in the query string using the null coalescing operator (??). 
                                        If they are present, the values are used to pre-populate the corresponding form inputs using the value attribute for the title 
                                        input and the text between the opening and closing tags for the content textarea. If they are not present, 
                                        the inputs are left blank. -->
                                        <textarea name="content" id="content" placeholder="Enter your text here"><?php echo $_GET['content'] ?? ''; ?></textarea>
                                    </div>
                                </div>
                                <div class="blog-button-flex">
                                    <div>
                                    <input type="submit" name="new_post" value="Submit" class="blog-button-style fw-bold button"/>
                                    </div>
                                    <div>
                                        <button class="blog-button-style fw-bold button" onclick="clear_button()">Clear</button>
                                    </div>
                                    
                                </div>  
                            </fieldset>
                            </form>

                            <section id="preview_section" class="padding-block-900">
                            
                            <!-- <a href="_poeditst.php" <?php echo $q["id"]; ?> >Preview</a> -->
                            <button class="blog-button-style fw-bold button" onclick="preview_post()">Preview</button>
                            </div>
                        
                                
                            </div>
                            
                            </section>

                        

                            <script>

                                function clear_button() {
                                    document.getElementById("title").value = "";
                                    document.getElementById("content").value = "";
                                }



                               
                                
                                // in the event that the blog has not been filled out fully
                                function check_blank() {
                                    if(document.getElementById('title').value == ""){
                                        document.getElementById('title').style.borderColor = "red";
                                        // pause form from submitting
                                       return false; 
                                    } if(document.getElementById('content').value == ""){
                                        document.getElementById('content').style.borderColor = "red";
                                       return false; 
                                    } if(document.getElementById('title').value == "" && document.getElementById('content').value == ""){
                                        document.getElementById('title').style.borderColor = "red";
                                        document.getElementById('content').style.borderColor = "red";
                                       return false; 
                                    }
                                }

                                function preview_post() {
                                    
                                    // Get the title and content values from the form
                                    var title = document.getElementById("title").value;
                                    var content = document.getElementById("content").value;

                                    if (title.trim() !== "" && content.trim() !== "") {
                                    

                                     // URL encode the content and title for use in the query string
                                    var encodedTitle = encodeURIComponent(title);
                                    var encodedContent = encodeURIComponent(content);

                                    // Redirect the user to preview.php - content and title as query parameters
                                    window.location.href = "preview.php?title=" + encodedTitle + "&content=" + encodedContent;

                                    } else {
                                        document.getElementById('title').style.borderColor = "red";
                                        document.getElementById('content').style.borderColor = "red";
                                    }
                                }

                                
                                                        

                                
                                
                                

                            </script>
                           
                            
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