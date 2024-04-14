<?php
  session_start();
  include('../../includes/lib.php');
  include_once('../../includes/rating.php');
  include_once('../../includes/engineer.php');
  include_once('../../includes/customer.php');
  checkAdminSession();

  $pageTitle = "Ratings";
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
                            Rating List
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="user-management-list.html">
                            <i class="me-1" data-feather="user"></i>
                            Manage Users
                        </a>
                        <button class="btn btn-sm btn-light text-primary" type="button" data-bs-toggle="modal"
                            data-bs-target="#createRatingModal">
                            <i class="me-1" data-feather="plus"></i>
                            Create New Rating
                        </button>
                        <a class="btn btn-sm btn-light text-primary" href="create.php">
                            <i class="me-1" data-feather="plus"></i>
                            Create New Rating
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <?php $all = getAllRatings(); ?>
    <div class="container-fluid px-4">
        <div class="card">
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Engineer</th>
                            <th>Customer</th>
                            <th>Rate</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <!-- <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Engineer</th>
                                            <th>Customer</th>
                                            <th>Rate</th>
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
                                                    data-bs-target="#editRatingModal"><i
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
                                  <td> <?php
                                    $Engineer = getEngineerById($row['engineer_id']) [0];
                                    echo$Engineer['first_name']; 
                                    ?>
                            </td>
                                <td> <?php
                                    $Customer = getCustomerById($row['customer_id']) [0];
                                    echo$Customer['first_name']; 
                                    ?>
                            </td>
                                <td> <?php echo($row['rate']); ?> </td>
  
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
    <!-- Create Rating modal-->
    <div class="modal fade" id="createRatingModal" tabindex="-1" role="dialog" aria-labelledby="createRatingModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createRatingModalLabel">Create New Rating</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-0">
                            <label class="mb-1 small text-muted" for="formRatingName">Rating
                                Name</label>
                            <input class="form-control" id="formRatingName" type="text"
                                placeholder="Enter Rating name..." />
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger-soft text-danger" type="button"
                        data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary-soft text-primary" type="button">Create New
                        Rating</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Rating modal-->
    <div class="modal fade" id="editRatingModal" tabindex="-1" role="dialog" aria-labelledby="editRatingModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editRatingModalLabel">Edit Rating</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-0">
                            <label class="mb-1 small text-muted" for="formRatingName">Rating
                                Name</label>
                            <input class="form-control" id="formRatingName" type="text"
                                placeholder="Enter Rating name..." value="Sales" />
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


