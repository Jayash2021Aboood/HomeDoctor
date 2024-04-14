<?php
  session_start();
  include('../../includes/lib.php');
  include_once('../../includes/book.php');

  checkAdminSession();

  $pageTitle = lang("Delete Book");
  $row = new Book(null);
  include('../../template/header.php');


  if ($_SERVER['REQUEST_METHOD'] === 'GET') 
  {

    if(isset($_GET['id']))
    {
      $_SESSION["message"] = lang('Are You Sure Want to Delete?');
      $id = $_GET['id'];
      $result = getBookById($id);

      if( count( $result ) > 0)
        $row = $result[0];

      if($row == null)
      {
          $_SESSION["message"] = lang('There is No data for this id');
          $_SESSION["fail"] = lang('There is No data for this id');
      }

    }
    else
    {
      $_SESSION["message"] = lang('No data for display');
      $_SESSION["fail"] = lang('No data for display');
    }

  }

  if ($_SERVER['REQUEST_METHOD'] === 'POST') 
  {
    if(isset($_POST['deleteBook']))
    {
      if(isset($_GET['id']))
      {
        $id = $_POST['id'];
        $delete = deleteBook($id);
        if($delete ==  true)
        {
  
          $_SESSION["message"] = lang("Book Deleted successfuly!");          
          $_SESSION["success"] = lang("Book Deleted successfuly!");          
          header('Location:'. $PATH_ADMIN_BOOK .'index.php');
          exit();
        }
        else
        {
          $_SESSION["message"] = lang("Error when Delete Data");
          $_SESSION["fail"] = lang("Error when Delete Data");

          $errors[] = lang("Error when Delete Data");
        }
      }
      else
      {
        $_SESSION["message"] = lang('No data for Delete');
        $_SESSION["fail"] = lang('No data for Delete');
      }
    }
    else
    {
      $_SESSION["message"] = lang('No data for Delete');
      $_SESSION["fail"] = lang('No data for Delete');
    }

  }

?>

<?php include('../../template/startNavbar.php'); ?>

<!-- Content -->
<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i class="fa fa-school"></i></div>
                            <?php echo lang("Delete Book"); ?>
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="index.php">
                            <i class="me-1" data-feather="arrow-left"></i>
                            <?php echo lang("Back to Books List"); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-xl px-4 mt-4">
        <div class="row">
            <div class="col-xl-12">
                <!-- Book details card-->
                <div class="card mb-4">
                    <div class="card-header"><?php echo lang("Book Details"); ?> <span
                            class="text-danger"><?php echo $_SESSION['message']; ?></span> </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <input type="hidden" name="id" id="id" value="<?php echo $row['id'];?>" readonly />
                                <!-- Form Group (name)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="name"><?php echo lang("Name"); ?></label>
                                    <input class="form-control" id="name" name="name" type="text" placeholder="<?php echo lang("Name"); ?>"
                                        value="<?php echo $row['name'];?>" readonly />
                                </div>
                                <!-- Form Group (number_copies)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="number_copies"><?php echo lang("Number Copies"); ?></label>
                                    <input class="form-control" id="number_copies" name="number_copies" type="text" placeholder="<?php echo lang("Number Copies"); ?>"
                                        value="<?php echo $row['number_copies'];?>" readonly />
                                </div>
                                <!-- Form Group (publish_date)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="publish_date"><?php echo lang("Publish Date"); ?></label>
                                    <input class="form-control" id="publish_date" name="publish_date" type="text" placeholder="<?php echo lang("Publish Date"); ?>"
                                        value="<?php echo $row['publish_date'];?>" readonly />
                                </div>
                                <!-- Form Group (detail)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="detail"><?php echo lang("Detail"); ?></label>
                                    <input class="form-control" id="detail" name="detail" type="text" placeholder="<?php echo lang("Detail"); ?>"
                                        value="<?php echo $row['detail'];?>" readonly />
                                </div>
                                <!-- Form Group (book_image)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="book_image"><?php echo lang("Book Image"); ?></label>
                                    <input class="form-control" id="book_image" name="book_image" type="text" placeholder="<?php echo lang("Book Image"); ?>"
                                        value="<?php echo $row['book_image'];?>" readonly />
                                </div>
                                <!-- Form Group (book_file)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="book_file"><?php echo lang("Book File"); ?></label>
                                    <input class="form-control" id="book_file" name="book_file" type="text" placeholder="<?php echo lang("Book File"); ?>"
                                        value="<?php echo $row['book_file'];?>" readonly />
                                </div>
                                <!-- Form Group (author_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="author_id"><?php echo lang("Author"); ?></label>
                                    <input class="form-control" id="author_id" name="author_id" type="text" placeholder="<?php echo lang("Author"); ?>"
                                        value="<?php echo $row['author_id'];?>" readonly />
                                </div>
                                <!-- Form Group (publisher_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="publisher_id"><?php echo lang("Publisher"); ?></label>
                                    <input class="form-control" id="publisher_id" name="publisher_id" type="text" placeholder="<?php echo lang("Publisher"); ?>"
                                        value="<?php echo $row['publisher_id'];?>" readonly />
                                </div>
                                <!-- Form Group (section_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="section_id"><?php echo lang("Section"); ?></label>
                                    <input class="form-control" id="section_id" name="section_id" type="text" placeholder="<?php echo lang("Section"); ?>"
                                        value="<?php echo $row['section_id'];?>" readonly />
                                </div>
                                <!-- Form Group (language_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="language_id"><?php echo lang("Language"); ?></label>
                                    <input class="form-control" id="language_id" name="language_id" type="text" placeholder="<?php echo lang("Language"); ?>"
                                        value="<?php echo $row['language_id'];?>" readonly />
                                </div>
 
                            </div>
                            <!-- Submit button-->
                            <button name="deleteBook" class="btn btn-danger" type="submit"><?php echo lang("Delete"); ?></button>
                            <a href="index.php" class="btn btn-primary" type="button"><?php echo lang("Back To List"); ?></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Footer -->

<?php include('../../template/footer.php'); ?>
