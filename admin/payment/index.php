<?php
  session_start();
  include('../../includes/lib.php');
  include_once('../../includes/payment.php');
  include_once('../../includes/appointment.php');
  checkAdminSession();

  $pageTitle = lang("Payments");
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
                            <?php echo lang("Payment List"); ?>
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
    <?php $all = getAllPayments(); ?>
    <div class="container-fluid px-4">
        <div class="card">
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th><?php echo lang("ID"); ?></th>
                            <th><?php echo lang("Appointment"); ?></th>
                            <th><?php echo lang("Paid Price"); ?></th>
                            <th><?php echo lang("Payment Method"); ?></th>
                            <th><?php echo lang("Actions"); ?></th>
                        </tr>
                    </thead>
                    <!-- <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Appointment</th>
                                            <th>Paid Price</th>
                                            <th>Payment Method</th>
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
                                                    data-bs-target="#editPaymentModal"><i
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
                                    $Appointment = getAppointmentById($row['appointment_id ']) [0];
                                    echo$Appointment['detail']; 
                                    ?>
                            </td>
                                <td> <?php echo($row['paid_price']); ?> </td>
                                  <td> <?php echo($row['payment_method']); ?> </td>
  
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
    <!-- Create Payment modal-->
    <div class="modal fade" id="createPaymentModal" tabindex="-1" role="dialog" aria-labelledby="createPaymentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createPaymentModalLabel">Create New Payment</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-0">
                            <label class="mb-1 small text-muted" for="formPaymentName">Payment
                                Name</label>
                            <input class="form-control" id="formPaymentName" type="text"
                                placeholder="Enter Payment name..." />
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger-soft text-danger" type="button"
                        data-bs-dismiss="modal">Cancel</button>
                    <button class="btn btn-primary-soft text-primary" type="button">Create New
                        Payment</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Payment modal-->
    <div class="modal fade" id="editPaymentModal" tabindex="-1" role="dialog" aria-labelledby="editPaymentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editPaymentModalLabel">Edit Payment</h5>
                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-0">
                            <label class="mb-1 small text-muted" for="formPaymentName">Payment
                                Name</label>
                            <input class="form-control" id="formPaymentName" type="text"
                                placeholder="Enter Payment name..." value="Sales" />
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


