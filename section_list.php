<?php
  session_start();
  include('includes/lib.php');
  include('includes/section.php');
  $pageTitle = lang("Sections List");

  
function printNestedList($parent_id = 0, $level = 0) {
    // Connect to the database (replace the values with your own)
	global $localhost;
	global $DBusername;
	global $dbname ;
	global $pwd;

    $servername = $localhost;
    $username = $DBusername;
    $password = $pwd;
    $dbname = $dbname;
    // $conn = new mysqli($servername, $username, $password, $dbname);
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Set the character set to utf8mb4 and the collation to utf8mb4_unicode_ci
    mysqli_set_charset($conn, "utf8mb4");
    $conn->query("SET collation_connection = utf8mb4_unicode_ci");
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Retrieve the sections with the given parent_id from the database
    if(is_null($parent_id))
        $sql = "SELECT * FROM section WHERE parent_id is NULL ORDER BY number";
    else
        $sql = "SELECT * FROM section WHERE parent_id = $parent_id ORDER BY number";
    $result = $conn->query($sql);

    // Print the sections as a nested list
    if ($result->num_rows > 0) {
        echo str_repeat("\t", $level) . "<ul>\n";
        while($row = $result->fetch_assoc()) {
            echo str_repeat("\t", $level + 1) .
            '<li><a href="section.php?id=' . $row['id'] . '">' . $row['number'] . ' - ' . $row["name"];
            printNestedList($row["id"], $level + 1); // Recursively print the sub-sections
            echo "</a></li>\n";
        }
        echo str_repeat("\t", $level) . "</ul>\n";
    }

    // Close the database connection
    $conn->close();
}
  ?>

<?php include('template/header.php'); ?>


<?php include('template/startNavbar.php'); ?>

<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between mt-5">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title text-primary">
                            <?php echo lang('Library Sections'); ?>
                        </h1>
                    </div>
                    <div class="col-6 mb-3">
                        <form action="" method="GET">
                            <div class="input-group">
                                <input class="form-control" id="search_term" name="search_term" type="text"
                                    placeholder="<?php echo lang('Search in sections ...'); ?>"
                                    aria-label="<?php echo lang('Search for ...'); ?>" aria-describedby="button-search">
                                <button class="btn btn-primary" id="button-search" name="button-search"
                                    type="submit"><?php echo lang('Go'); ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl">
        <!-- Nested row for non-featured blog posts-->
        <div class="row">
            <?php
                if(isset($_GET['search_term']) && !empty($_GET['search_term']))
                    $all = getAllSectionsBySearch($_GET['search_term']);
                else
                    $all = getAllSectionsBySearch("");
                if(!(count($all) > 0)) echo /*html*/'<div class="col text-center"> <h2 class="text-danger" >No Sections Found To Display. </h2></div>'; 
                else{ 
                    if(isset($_GET['search_term']) && !empty($_GET['search_term'])){
                        // Here Print Without nested ul li 
                    foreach($all as  $row)
                    {

                            
            ?>
            <div class="col-12">
                <!-- Blog post-->
                <div class="card mb-4">
                    <div class="card-body">
                        <!-- <div class="small text-muted"><?php //echo $row['email']; ?></div> -->
                        <h2 class="card-title h4">
                            <div class="row">
                                <div class="col-md-9"><?php echo $row['number'] . ' - ' . $row['name']; ?></div>
                                <div class="col-md-3 text-md-end">
                                    <a class="btn btn-primary btn-sm"
                                        href="section.php?id=<?php echo $row['id'] ?>"><?php echo lang('Read more'); ?>
                                        →</a>
                                </div>
                            </div>
                        </h2>

                    </div>
                </div>
            </div>
            <?php 
                        }
                    }
                        else{

                            echo '<div class="col-12">';
                            printNestedList(null,0);
                            echo '</div>';
                        }
        } ?>
        </div>
    </div>
</main>


<?php include('template/footer.php') ?>