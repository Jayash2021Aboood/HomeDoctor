<?php
  session_start();

  include('../../includes/lib.php');
  include_once('../../includes/book.php');
  include_once('../../includes/author.php');
  include_once('../../includes/publisher.php');
  include_once('../../includes/section.php');
  include_once('../../includes/language.php');
  checkAdminSession();

  $pageTitle = lang("Edit Book");
  //$row = new Book(null);
   $id =  $name =  $number_copies =  $publish_date =  $detail =  $book_image = $book_image_old =  $book_file = $book_file_old =  $author_id =  $publisher_id =  $section_id =  $language_id = "";
  //$id = $name = $manager = $managerPhone = $agent = $agentPhone = $kindergarten = $earlyChildhood = $elementary = $intermediate = $secondary = $active = "";
  include('../../template/header.php'); 
  $errors = array();


  if ($_SERVER['REQUEST_METHOD'] === 'GET') 
  {
    if(isset($_GET['id']))
    {
      $_SESSION["message"] = '';
      $id = $_GET['id'];
      $result = getBookById($id);

      if( count( $result ) > 0)
      {
        $row = $result[0];
        $id = $row['id'];
        $name = $row['name'];
        $number_copies = $row['number_copies'];
        $publish_date = $row['publish_date'];
        $detail = $row['detail'];
        $book_image = $row['book_image'];
        $book_file = $row['book_file'];
        $author_id = $row['author_id'];
        $publisher_id = $row['publisher_id'];
        $section_id = $row['section_id'];
        $language_id = $row['language_id'];
      }
      else
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
    if(isset($_POST['updateBook']))
    {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $number_copies = $_POST['number_copies'];
        $publish_date = $_POST['publish_date'];
        $detail = $_POST['detail'];
      $book_image_old = $_POST['book_image_old'];
      $book_image = uploadImage('book_image', DIR_PHOTOES, $book_image_old);
      $book_file_old = $_POST['book_file_old'];
      $book_file = uploadImage('book_file', DIR_PHOTOES, $book_file_old);
        $author_id = $_POST['author_id'];
        $publisher_id = $_POST['publisher_id'];
        $section_id = $_POST['section_id'];
        $language_id = $_POST['language_id'];
      if( empty($name)){
        $errors[] = "<li>" . lang("Name is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Name is requierd") . "</li>";
        }
      if( empty($number_copies)){
        $errors[] = "<li>" . lang("Number Copies is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Number Copies is requierd") . "</li>";
        }
      if( empty($publish_date)){
        $errors[] = "<li>" . lang("Publish Date is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Publish Date is requierd") . "</li>";
        }
      if( empty($author_id)){
        $errors[] = "<li>" . lang("Author is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Author is requierd") . "</li>";
        }
      if( empty($publisher_id)){
        $errors[] = "<li>" . lang("Publisher is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Publisher is requierd") . "</li>";
        }
      if( empty($section_id)){
        $errors[] = "<li>" . lang("Section is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Section is requierd") . "</li>";
        }
      if( empty($language_id)){
        $errors[] = "<li>" . lang("Language is requierd") . "</li>";
        $_SESSION["fail"] .= "<li>" . lang("Language is requierd") . "</li>";
        }
      
      if(count($errors) == 0)
      {

        $result = getBookById($id);
        if( count( $result ) > 0)
          $row = $result[0];
        
        $update = updateBook( $id,  $name,  $number_copies,  $publish_date,  $detail,  $book_image,  $book_file,  $author_id,  $publisher_id,  $section_id,  $language_id, );
        if($update ==  true)
        {
  
          $_SESSION["message"] = lang("Book Updated successfuly!");
          $_SESSION["success"] = lang("Book Updated successfuly!");
          header('Location:'. $PATH_ADMIN_BOOK .'index.php');
          exit();
        }
        else
        {
          $_SESSION["message"] = lang("Error when Update Data");
          $_SESSION["fail"] = lang("Error when Update Data");
          $errors[] = lang("Error when Update Data");
        }
        
      }
      else
      {
      }
  
    }
  }
?>

<?php include('../../template/startNavbar.php'); ?>


<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-xl px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i class="fa fa-school"></i></div>
                            <?php echo lang("Edit Book"); ?>
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
                    <div class="card-header"><?php echo lang("Book Details"); ?></div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <!-- Form Row-->
                            <div class="row gx-3 mb-3">
                                <input type="hidden" name="id" id="id" value="<?php echo $id;?>" />
                                <!-- Form Group (name)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="name"><?php echo lang("Name"); ?></label>
                                    <input class="form-control" id="name" name="name" type="text" placeholder="<?php echo lang("Name"); ?>"
                                        value="<?php echo $name;?>" required />
                                </div>
                                <!-- Form Group (number_copies)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="number_copies"><?php echo lang("Number Copies"); ?></label>
                                    <input class="form-control" id="number_copies" name="number_copies" type="text" placeholder="<?php echo lang("Number Copies"); ?>"
                                        value="<?php echo $number_copies;?>" required />
                                </div>
                                <!-- Form Group (publish_date)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="publish_date"><?php echo lang("Publish Date"); ?></label>
                                    <input class="form-control" id="publish_date" name="publish_date" type="date" placeholder="<?php echo lang("Publish Date"); ?>"
                                        value="<?php echo $publish_date;?>" required />
                                </div>
                                <!-- Form Group (detail)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="detail"><?php echo lang("Detail"); ?></label>
                                    <input class="form-control" id="detail" name="detail" type="text" placeholder="<?php echo lang("Detail"); ?>"
                                        value="<?php echo $detail;?>"  />
                                </div>
                                <!-- Form Group (book_image)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="book_image"><?php echo lang("Book Image"); ?></label>
                                    <input id="book_image_old" name="book_image_old" type="hidden" value="<?php echo $book_image;?>" />
                                    <input class="form-control" id="book_image" name="book_image" type="file" placeholder="<?php echo lang("Book Image"); ?>"
                                        value="<?php echo $book_image;?>"  />
                                </div>
                                <!-- Form Group (book_file)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="book_file"><?php echo lang("Book File"); ?></label>
                                    <input id="book_file_old" name="book_file_old" type="hidden" value="<?php echo $book_file;?>" />
                                    <input class="form-control" id="book_file" name="book_file" type="file" placeholder="<?php echo lang("Book File"); ?>"
                                        value="<?php echo $book_file;?>"  />
                                </div>
                                <!-- Form Group (author_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="author_id"><?php echo lang("Author"); ?></label>
                                    <select class="form-select" name="author_id" id="author_id" required>
                                        <option disabled value=""><?php echo lang("Select a Author"); ?>:</option>
                                        <?php foreach(getAllAuthors() as $Author) { ?>
                                        <option <?php if($author_id == $Author['id']) echo "selected" ?> value="<?php echo $Author['id']; ?>"> <?php echo $Author['name']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>
                                <!-- Form Group (publisher_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="publisher_id"><?php echo lang("Publisher"); ?></label>
                                    <select class="form-select" name="publisher_id" id="publisher_id" required>
                                        <option disabled value=""><?php echo lang("Select a Publisher"); ?>:</option>
                                        <?php foreach(getAllPublishers() as $Publisher) { ?>
                                        <option <?php if($publisher_id == $Publisher['id']) echo "selected" ?> value="<?php echo $Publisher['id']; ?>"> <?php echo $Publisher['name']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>
                                <!-- Form Group (section_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="section_id"><?php echo lang("Section"); ?></label>
                                    <select class="form-select" name="section_id" id="section_id" required>
                                        <option disabled value=""><?php echo lang("Select a Section"); ?>:</option>
                                        <?php foreach(getAllSections() as $Section) { ?>
                                        <option <?php if($section_id == $Section['id']) echo "selected" ?> value="<?php echo $Section['id']; ?>"> <?php echo $Section['name']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>
                                <!-- Form Group (language_id)-->
                                <div class="col-md-4 mb-3">
                                    <label class="small mb-1" for="language_id"><?php echo lang("Language"); ?></label>
                                    <select class="form-select" name="language_id" id="language_id" required>
                                        <option disabled value=""><?php echo lang("Select a Language"); ?>:</option>
                                        <?php foreach(getAllLanguages() as $Language) { ?>
                                        <option <?php if($language_id == $Language['id']) echo "selected" ?> value="<?php echo $Language['id']; ?>"> <?php echo $Language['name']; ?>
                                        </option>
                                        <?php }?>
                                    </select>
                                </div>
 
                            </div>
                            <!-- Submit button-->
                            <button name="updateBook" class="btn btn-success" type="submit"><?php echo lang("Save"); ?></button>
                            <a href="index.php" class="btn btn-danger" type="button"><?php echo lang("Back To List"); ?></a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>


<?php include('../../template/footer.php'); ?>

