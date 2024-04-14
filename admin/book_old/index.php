<?php
  session_start();
  include('../../includes/lib.php');
  include_once('../../includes/book.php');
  include_once('../../includes/author.php');
  include_once('../../includes/publisher.php');
  include_once('../../includes/section.php');
  include_once('../../includes/language.php');
  checkAdminSession();

  $pageTitle = "Books";
?>

<?php include('../../template/header.php'); ?>
<?php include('../../template/startNavbar.php'); ?>


<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-fluid px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="users"></i></div>
                            Book List
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="user-management-list.html">
                            <i class="me-1" data-feather="user"></i>
                            Manage Users
                        </a>
                        <button class="btn btn-sm btn-light text-primary" type="button" data-bs-toggle="modal"
                            data-bs-target="#createBookModal">
                            <i class="me-1" data-feather="plus"></i>
                            Create New Book
                        </button>
                        <a class="btn btn-sm btn-light text-primary" href="create.php">
                            <i class="me-1" data-feather="plus"></i>
                            Create New Book
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <?php $all = getAllBooks(); ?>
    <div class="container-fluid px-4">
        <div class="card">
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Number Copies</th>
                            <th>Publish Date</th>
                            <th>Detail</th>
                            <th>Book Image</th>
                            <th>Book File</th>
                            <th>Author</th>
                            <th>Publisher</th>
                            <th>Section</th>
                            <th>Language</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <!-- <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Number Copies</th>
                                            <th>Publish Date</th>
                                            <th>Detail</th>
                                            <th>Book Image</th>
                                            <th>Book File</th>
                                            <th>Author</th>
                                            <th>Publisher</th>
                                            <th>Section</th>
                                            <th>Language</th>
                                            <th>Actions</th>
                                        </tr>
                                    </tfoot> -->
                    <tbody>

                        <!-- <tr> 
                                            <td>Name</td>
                                            <td>Mananger</td>
                                            <td>Mananger Phone</td>
                                            <td>Agent</td>
                                            <td>Agent Phone</td>
                                            <td>Active</td>
                                            <td>
                                                <button class="btn btn-datatable btn-icon btn-transparent-dark me-2"
                                                    type="button" data-bs-toggle="modal"
                                                    data-bs-target="#editBookModal"><i
                                                        data-feather="edit"></i></button>
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark" href="#!"><i
                                                        data-feather="trash-2"></i></a>
                                            </td>
                                        </tr> -->
                        <?php
                                        foreach($all as $row)
                                        {

                                        ?>

                        <tr>
                                <td> <?php echo($row['id']); ?> </td>
                                  <td> <?php echo($row['name']); ?> </td>
                                  <td> <?php echo($row['number_copies']); ?> </td>
                                  <td> <?php echo($row['publish_date']); ?> </td>
                                  <td> <?php echo($row['detail']); ?> </td>
                                  <td> <?php if(!empty($row['book_image'])){ ?> <a href="<?php echo($PATH_PHOTOES  . $row['book_image']); ?>"
                                    target="_blank">View</a>
                                 <?php }?>
                            </td>
                                <td> <?php if(!empty($row['book_file'])){ ?> <a href="<?php echo($PATH_PHOTOES  . $row['book_file']); ?>"
                                    target="_blank">View</a>
                                 <?php }?>
                            </td>
                                <td> <?php
                                    $Author = getAuthorById($row['author_id']) [0];
                                    echo$Author['name']; 
                                    ?>
                            </td>
                                <td> <?php
                                    $Publisher = getPublisherById($row['publisher_id']) [0];
                                    echo$Publisher['name']; 
                                    ?>
                            </td>
                                <td> <?php
                                    $Section = getSectionById($row['section_id']) [0];
                                    echo$Section['name']; 
                                    ?>
                            </td>
                                <td> <?php
                                    $Language = getLanguageById($row['language_id']) [0];
                                    echo$Language['name']; 
                                    ?>
                            </td>

                            <td>
                                <a class="btn btn-datatable btn-icon btn-transparent-dark me-2"
                                    href="edit.php?id=<?php echo($row['id']); ?>">
                                    <i class="text-primary" data-feather="edit"></i>
                                </a>
                                <a class="btn btn-datatable btn-icon btn-transparent-dark"
                                    href="delete.php?id=<?php echo($row['id']); ?>">
                                    <i class="text-danger" data-feather="trash-2"></i>
                                </a>
                                <a class="btn btn-datatable btn-icon btn-transparent-dark"
                                    href="detail.php?id=<?php echo($row['id']); ?>">
                                    <i class="text-success" data-feather="eye"></i>
                                </a>
                            </td>
                        </tr>
                        <?php }?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Create Book modal-->
    <div class="modal fade" id="createBookModal" tabindex="-1" role="dialog" aria-labelledby="createBookModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createBookModalLabel">Create New Book</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-0">
                            <label class="mb-1 small text-muted" for="formBookName">Book
                                Name</label>
                            <input class="form-control" id="formBookName" type="text"
                                placeholder="Enter Book name..." />
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger-soft text-danger" type="button"
                        data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary-soft text-primary" type="button">Create New
                        Book</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Book modal-->
    <div class="modal fade" id="editBookModal" tabindex="-1" role="dialog" aria-labelledby="editBookModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editBookModalLabel">Edit Book</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-0">
                            <label class="mb-1 small text-muted" for="formBookName">Book
                                Name</label>
                            <input class="form-control" id="formBookName" type="text"
                                placeholder="Enter Book name..." value="Sales" />
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger-soft text-danger" type="button"
                        data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary-soft text-primary" type="button">Save
                        Changes</button>
                </div>
            </div>
        </div>
    </div>
</main>




<?php include('../../template/footer.php'); ?>


