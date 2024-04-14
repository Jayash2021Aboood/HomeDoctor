<?php
  session_start();
  include('../../includes/lib.php');
  include_once('../../includes/fine.php');
  include_once('../../includes/issue.php');
  include_once('../../includes/student.php');
  checkEmployeeSession();

  $pageTitle = lang("Fines");
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
                            <?php echo lang("Fine List"); ?>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <?php $all = getAllFines(); ?>
    <div class="container-fluid px-4">
        <div class="card">
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th><?php echo lang("ID"); ?></th>
                            <th><?php echo lang("Issue"); ?></th>
                            <th><?php echo lang("Student"); ?></th>
                            <th><?php echo lang("TotalAmount"); ?></th>
                            <th><?php echo lang("State"); ?></th>
                        </tr>
                    </thead>
                    <!-- <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Issue</th>
                                            <th>Student</th>
                                            <th>TotalAmount</th>
                                            <th>State</th>
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
                                                    data-bs-target="#editFineModal"><i
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
                                    $Issue = getIssueById($row['issue_id']) [0];
                                    echo$Issue['id']; 
                                    ?>
                            </td>
                            <td> <?php
                                    $Student = getStudentById($row['student_id']) [0];
                                    echo$Student['name']; 
                                    ?>
                            </td>
                            <td> <?php echo($row['amount']); ?> </td>
                            <td>
                                <?php if($row['state'] == 'draft'){
                                ?>
                                <form action="../issue/issueManager.php" method="POST">
                                    <input type="hidden" name="id" id="id" value="<?php echo $row['id'] ;?>" />
                                    <button name="deportFine" class="btn btn-success btn-sm"
                                        type="submit"><?php echo lang("Paid"); ?></button>
                                    <button name="cancelFine" class="btn btn-danger btn-sm"
                                        type="submit"><?php echo lang("Cancel"); ?></button>
                                </form>
                                <?php
                                }
                                else{
                                echo($row['state']);
                                }
                                ?>
                            </td>
                        </tr>
                        <?php }?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Create Fine modal-->
    <div class="modal fade" id="createFineModal" tabindex="-1" role="dialog" aria-labelledby="createFineModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createFineModalLabel">Create New Fine</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-0">
                            <label class="mb-1 small text-muted" for="formFineName">Fine
                                Name</label>
                            <input class="form-control" id="formFineName" type="text"
                                placeholder="Enter Fine name..." />
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger-soft text-danger" type="button"
                        data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary-soft text-primary" type="button">Create New
                        Fine</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Fine modal-->
    <div class="modal fade" id="editFineModal" tabindex="-1" role="dialog" aria-labelledby="editFineModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editFineModalLabel">Edit Fine</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-0">
                            <label class="mb-1 small text-muted" for="formFineName">Fine
                                Name</label>
                            <input class="form-control" id="formFineName" type="text" placeholder="Enter Fine name..."
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