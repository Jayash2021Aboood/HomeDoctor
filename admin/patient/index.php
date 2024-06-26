<?php
  session_start();
  include('../../includes/lib.php');
  include_once('../../includes/patient.php');
  checkAdminSession();

  $pageTitle = lang("Patients");
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
                            <?php echo lang("Patient List"); ?>
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
    <?php $all = getAllPatients(); ?>
    <div class="container-fluid px-4">
        <div class="card">
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th><?php echo lang("ID"); ?></th>
                            <th><?php echo lang("First Name"); ?></th>
                            <th><?php echo lang("Last Name"); ?></th>
                            <th><?php echo lang("Phone"); ?></th>
                            <th><?php echo lang("Email"); ?></th>
                            <th><?php echo lang("Password"); ?></th>
                            <th><?php echo lang("Location"); ?></th>
                            <th><?php echo lang("Date of Birth"); ?></th>
                            <th><?php echo lang("Height"); ?></th>
                            <th><?php echo lang("Weight"); ?></th>
                            <th><?php echo lang("Has Chronic Disease"); ?></th>
                            <th><?php echo lang("What Are Diseases"); ?></th>
                            <th><?php echo lang("Has Allergic To Anything"); ?></th>
                            <th><?php echo lang("What Are Things"); ?></th>
                            <th><?php echo lang("Actions"); ?></th>
                        </tr>
                    </thead>
                    <!-- <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>First Name</th>
                                            <th>Last Name</th>
                                            <th>Phone</th>
                                            <th>Email</th>
                                            <th>Password</th>
                                            <th>Location</th>
                                            <th>Date of Birth</th>
                                            <th>Height</th>
                                            <th>Weight</th>
                                            <th>Has Chronic Disease</th>
                                            <th>What Are Diseases</th>
                                            <th>Has Allergic To Anything</th>
                                            <th>What Are Things</th>
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
                                                    data-bs-target="#editPatientModal"><i
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
                                  <td> <?php echo($row['first_name']); ?> </td>
                                  <td> <?php echo($row['last_name']); ?> </td>
                                  <td> <?php echo($row['phone']); ?> </td>
                                  <td> <?php echo($row['email']); ?> </td>
                                  <td> <?php echo($row['password']); ?> </td>
                                  <td> <?php echo($row['location']); ?> </td>
                                  <td> <?php echo($row['date_of_birth']); ?> </td>
                                  <td> <?php echo($row['height']); ?> </td>
                                  <td> <?php echo($row['weight']); ?> </td>
                                  <td> <input type="checkbox" <?php if ($row['has_chronic_disease'] == 1) echo 'checked'; ?>> </td>
                                    <td> <?php echo($row['what_are_diseases']); ?> </td>
                                  <td> <input type="checkbox" <?php if ($row['has_allergic_to_anything'] == 1) echo 'checked'; ?>> </td>
                                    <td> <?php echo($row['what_are_things']); ?> </td>
  
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
    <!-- Create Patient modal-->
    <div class="modal fade" id="createPatientModal" tabindex="-1" role="dialog" aria-labelledby="createPatientModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createPatientModalLabel">Create New Patient</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-0">
                            <label class="mb-1 small text-muted" for="formPatientName">Patient
                                Name</label>
                            <input class="form-control" id="formPatientName" type="text"
                                placeholder="Enter Patient name..." />
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger-soft text-danger" type="button"
                        data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary-soft text-primary" type="button">Create New
                        Patient</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Patient modal-->
    <div class="modal fade" id="editPatientModal" tabindex="-1" role="dialog" aria-labelledby="editPatientModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPatientModalLabel">Edit Patient</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-0">
                            <label class="mb-1 small text-muted" for="formPatientName">Patient
                                Name</label>
                            <input class="form-control" id="formPatientName" type="text"
                                placeholder="Enter Patient name..." value="Sales" />
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


