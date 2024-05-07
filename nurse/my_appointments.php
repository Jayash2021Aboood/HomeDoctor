<?php
  session_start();
  include('../includes/lib.php');
  include_once('../includes/appointment.php');
  include_once('../includes/patient.php');
  include_once('../includes/nurse.php');
  include_once('../includes/nurse.php');
  checkNurseSession();

  $pageTitle = lang("My Appointments");
?>

<?php include('../template/header.php'); ?>
<?php include('../template/startNavbar.php'); ?>


<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-fluid px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i data-feather="users"></i></div>
                            <?php echo lang("My Appointments"); ?>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <?php $all = getAllAppointments(); ?>
    <div class="container-fluid px-4">
        <div class="card">
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th><?php echo lang("ID"); ?></th>
                            <th><?php echo lang("Detail"); ?></th>
                            <th><?php echo lang("Patient"); ?></th>
                            <th class="d-none"><?php echo lang("Nurse"); ?></th>
                            <th class="d-none"><?php echo lang("Nurse"); ?></th>
                            <th><?php echo lang("Appointment Date"); ?></th>
                            <th><?php echo lang("Appointment Time"); ?></th>
                            <th><?php echo lang("Price"); ?></th>
                            <th><?php echo lang("State"); ?></th>
                            <th><?php echo lang("Created Date"); ?></th>
                            <th><?php echo lang("Actions"); ?></th>
                        </tr>
                    </thead>
                    <!-- <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Detail</th>
                                            <th>Patient</th>
                                            <th>Nurse</th>
                                            <th>Nurse</th>
                                            <th>Appointment Date</th>
                                            <th>Appointment Time</th>
                                            <th>Price</th>
                                            <th>State</th>
                                            <th>Created Date</th>
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
                                                    data-bs-target="#editAppointmentModal"><i
                                                        data-feather="edit"></i></button>
                                                <a class="btn btn-datatable btn-icon btn-transparent-dark" href="#!"><i
                                                        data-feather="trash-2"></i></a>
                                            </td>
                                        </tr> -->
                        <?php
                                        foreach($all as $row)
                                        {
                                            if($_SESSION['userID'] != $row['nurse_id']) continue;
                                        ?>

                        <tr>
                                <td> <?php echo($row['id']); ?> </td>
                                  <td> <?php echo($row['detail']); ?> </td>
                                  <td> <?php
                                        $Patient = getPatientById($row['patient_id']) [0];
                                        echo$Patient['first_name']; 
                                    ?>
                            </td>
                                <td class="d-none"> <?php
                                if(!is_null($row['nurse_id'])){
                                    $Nurse = getNurseById($row['nurse_id']) [0];
                                    echo$Nurse['first_name']; 
                                }
                                    ?>
                            </td>
                                <td class="d-none"> <?php
                                if(!is_null($row['nurse_id'])){
                                    $Nurse = getNurseById($row['nurse_id']) [0];
                                    echo$Nurse['first_name']; 
                                }
                                    ?>
                            </td>
                                <td> <?php echo($row['appointment_date']); ?> </td>
                                  <td> <?php echo($row['appointment_time']); ?> </td>
                                  <td> <?php echo($row['price']); ?> </td>
                                  <td> <?php echo($row['state']); ?> </td>
                                  <td> <?php echo($row['created_date']); ?> </td>
  
                            <td>
                                
                                <a class="btn btn-datatable btn-icon btn-transparent-dark"
                                    href="edit.php?id=<?php echo($row['id']); ?>">
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
    <!-- Create Appointment modal-->
    <div class="modal fade" id="createAppointmentModal" tabindex="-1" role="dialog" aria-labelledby="createAppointmentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createAppointmentModalLabel">Create New Appointment</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-0">
                            <label class="mb-1 small text-muted" for="formAppointmentName">Appointment
                                Name</label>
                            <input class="form-control" id="formAppointmentName" type="text"
                                placeholder="Enter Appointment name..." />
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger-soft text-danger" type="button"
                        data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary-soft text-primary" type="button">Create New
                        Appointment</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Appointment modal-->
    <div class="modal fade" id="editAppointmentModal" tabindex="-1" role="dialog" aria-labelledby="editAppointmentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editAppointmentModalLabel">Edit Appointment</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-0">
                            <label class="mb-1 small text-muted" for="formAppointmentName">Appointment
                                Name</label>
                            <input class="form-control" id="formAppointmentName" type="text"
                                placeholder="Enter Appointment name..." value="Sales" />
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




<?php include('../template/footer.php'); ?>


