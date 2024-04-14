<?php
  session_start();
  include('../includes/lib.php');
  include('../includes/service.php');
  include('../includes/engineer.php');
  include('../includes/service_type.php');
  include('../includes/booking.php');
  
  checkEngineerSession();

  $pageTitle = "My Bookings";
  ?>

<?php include('../template/header.php'); ?>

<?php include('../template/startNavbar.php'); ?>

<!-- محتوى الصفحة -->
<?php $all = getAllBookingsWithDetailsByEngineer($_SESSION['userID']); ?>
<main>
    <header class="page-header page-header-compact page-header-light border-bottom bg-white mb-4">
        <div class="container-fluid px-4">
            <div class="page-header-content">
                <div class="row align-items-center justify-content-between pt-3">
                    <div class="col-auto mb-3">
                        <h1 class="page-header-title">
                            <div class="page-header-icon"><i class="fa-light fa-user"></i></div>
                            My Bookings
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Main page content-->
    <div class="container-fluid px-4">
        <div class="card">
            <div class="card-body">
                <table id="datatablesSimple">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Service</th>
                            <th>Customer</th>
                            <th>State</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Booking ID</th>
                            <th>Service</th>
                            <th>Engineer</th>
                            <th>State</th>
                            <th>Date</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php foreach($all as $row) {?>
                        <tr>
                            <td>
                                <a class="btn btn-datatable btn-icon btn-transparent-dark"
                                    href="booking_details.php?id=<?php echo($row['id']); ?>"><i
                                        data-feather="eye"></i></a>
                                <?php echo($row['id']); ?>
                            </td>
                            <td> <?php echo($row['service']); ?> </td>
                            <td> <?php echo($row['customer']); ?> </td>
                            <td>
                                <?php
                                    if($row['state'] == 'request')
                                        echo /*html*/'<span class="badge bg-light text-dark">'.$row['state'].'</span>';
                                    else if($row['state'] == 'reject')
                                        echo /*html*/'<span class="badge bg-red-soft text-red">'.$row['state'].'</span>';
                                    else if($row['state'] == 'working')
                                        echo /*html*/'<span class="badge bg-purple-soft text-purple">'.$row['state'].'</span>';
                                    else if($row['state'] == 'ready')
                                        echo /*html*/'<span class="badge bg-blue-soft text-blue">'.$row['state'].'</span>';
                                    else if($row['state'] == 'done')
                                        echo /*html*/'<span class="badge bg-green-soft text-green">'.$row['state'].'</span>';
                                    else if($row['state'] == 'paid')
                                        echo /*html*/'<span class="badge bg-yellow-soft text-yellow">'.$row['state'].'</span>';
                                    else if($row['state'] == 'canceled')
                                        echo /*html*/'<span class="badge bg-red-soft text-red">'.$row['state'].'</span>';
                                 ?>
                            </td>
                            <td><?php echo($row['booking_date']); ?></td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>


<?php include('../template/footer.php') ?>