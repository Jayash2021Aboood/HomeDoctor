<?php
  session_start();
  include('../includes/lib.php');
  include_once('../includes/appointment.php');
  include_once('../includes/patient.php');
  include_once('../includes/doctor.php');
  include_once('../includes/nurse.php');
  checkPatientSession();

  $pageTitle = lang("My Appointments");

  $state = "";
  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if(isset($_GET['state']) && !empty($_GET['state'])){
        $state = $_GET['state'];
    }
  }

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
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="create_appointment.php">
                            <i class="me-1" data-feather="plus"></i>
                            <?php echo lang("Create New"); ?>
                        </a>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="my_appointments.php?state=">
                            <?php echo lang("All"); ?>
                        </a>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="my_appointments.php?state=request">
                            <?php echo lang("Pending Appointments"); ?>
                        </a>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="my_appointments.php?state=reject">
                            <?php echo lang("Rejected Appointments"); ?>
                        </a>
                    </div>
                    <div class="col-12 col-xl-auto mb-3">
                        <a class="btn btn-sm btn-light text-primary" href="my_appointments.php?state=accept">
                            <?php echo lang("Accepted Appointments"); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <?php 
        if(!empty($state)){
            $all = select("SELECT * FROM appointment WHERE state like '$state'");
        }
        else{
            $all = getAllAppointments(); 
        }
    ?>
    <div class="container-fluid px-4">
        <div class="card">
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th><?php echo lang("ID"); ?></th>
                            <th><?php echo lang("Detail"); ?></th>
                            <th class="d-none"><?php echo lang("Patient"); ?></th>
                            <th><?php echo lang("Doctor"); ?></th>
                            <th><?php echo lang("Nurse"); ?></th>
                            <th><?php echo lang("Appointment Date"); ?></th>
                            <th><?php echo lang("Appointment Time"); ?></th>
                            <th><?php echo lang("Price"); ?></th>
                            <th><?php echo lang("State"); ?></th>
                            <th><?php echo lang("Created Date"); ?></th>
                        </tr>
                    </thead>
                    <!-- <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Detail</th>
                                            <th>Patient</th>
                                            <th>Doctor</th>
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
                                            if($_SESSION['userID'] != $row['patient_id']) continue;
                                        ?>

                        <tr>
                                <td> <?php echo($row['id']); ?> </td>
                                  <td> <?php echo($row['detail']); ?> </td>
                                  <td class="d-none"> <?php
                                        $Patient = getPatientById($row['patient_id']) [0];
                                        echo$Patient['first_name']; 
                                    ?>
                            </td>
                                <td> <?php
                                if(!is_null($row['doctor_id'])){
                                    $Doctor = getDoctorById($row['doctor_id']) [0];
                                    echo$Doctor['first_name']; 
                                }
                                    ?>
                            </td>
                                <td> <?php
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


