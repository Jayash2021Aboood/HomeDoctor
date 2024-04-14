<?php
  session_start();
  include('../../includes/lib.php');
  include_once('../../includes/issue.php');
  include_once('../../includes/book.php');
  include_once('../../includes/student.php');
  include_once('../../includes/issue_manager.php');
  checkEmployeeSession();

  $pageTitle = lang("Issues");
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
                            <?php echo lang("Issue List"); ?>
                        </h1>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="create.php">
                            <i class="me-1" data-feather="plus"></i>
                            <?php echo lang("Create New"); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <?php $all = getAllIssues(); ?>
    <div class="container-fluid px-4">
        <div class="card">
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th><?php echo lang("ID"); ?></th>
                            <th><?php echo lang("Book"); ?></th>
                            <th><?php echo lang("Student"); ?></th>
                            <th><?php echo lang("Issue Date"); ?></th>
                            <th><?php echo lang("Due Date"); ?></th>
                            <th><?php echo lang("Return Date"); ?></th>
                            <th><?php echo lang("Fine Per Day"); ?></th>
                            <th><?php echo lang("Total Fine"); ?></th>
                            <th><?php echo lang("Actions"); ?></th>
                        </tr>
                    </thead>
                    <!-- <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Book</th>
                                            <th>Student</th>
                                            <th>Issue Date</th>
                                            <th>Due Date</th>
                                            <th>Return Date</th>
                                            <th>Fine Per Day</th>
                                            <th>Total Fine</th>
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
                                                    data-bs-target="#editIssueModal"><i
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
                                    $Book = getBookById($row['book_id']) [0];
                                    echo$Book['name']; 
                                    ?>
                            </td>
                            <td> <?php
                                    $Student = getStudentById($row['student_id']) [0];
                                    echo $Student['name']; 
                                    ?>
                            </td>
                            <td> <?php echo($row['issue_date']); ?> </td>
                            <td> <?php echo($row['due_date']); ?> </td>
                            <td> <?php echo($row['return_date']); ?> </td>
                            <td> <?php echo($row['fine_per_day']); ?> </td>
                            <td> <?php echo($row['total_fine']); ?> </td>

                            <td>
                                <a class="btn btn-datatable btn-icon btn-transparent-dark"
                                    href="detail.php?id=<?php echo($row['id']); ?>">
                                    <i class="text-success" data-feather="eye"></i>
                                </a>
                                <?php if(!CheckIfIssueIsReturned($row)){ ?>

                                <a class="btn btn-datatable btn-icon btn-transparent-dark"
                                    href="return.php?id=<?php echo($row['id']); ?>">
                                    <i class="text-info" data-feather="refresh-ccw"></i>

                                </a>
                                <?php }?>
                            </td>
                        </tr>
                        <?php }?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Create Issue modal-->
    <div class="modal fade" id="createIssueModal" tabindex="-1" role="dialog" aria-labelledby="createIssueModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createIssueModalLabel">Create New Issue</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-0">
                            <label class="mb-1 small text-muted" for="formIssueName">Issue
                                Name</label>
                            <input class="form-control" id="formIssueName" type="text"
                                placeholder="Enter Issue name..." />
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger-soft text-danger" type="button"
                        data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary-soft text-primary" type="button">Create New
                        Issue</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Issue modal-->
    <div class="modal fade" id="editIssueModal" tabindex="-1" role="dialog" aria-labelledby="editIssueModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editIssueModalLabel">Edit Issue</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-0">
                            <label class="mb-1 small text-muted" for="formIssueName">Issue
                                Name</label>
                            <input class="form-control" id="formIssueName" type="text" placeholder="Enter Issue name..."
                                value="Sales" />
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