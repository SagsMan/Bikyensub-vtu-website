<?php
require_once '../inc/user_session.inc.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
<script src="bootstrap/jquery/jquery-3-2.js"></script>
<script src="assets/tablePaginate/jquery-3.5.1.js"></script>
<script src="assets/tablePaginate/jquery.dataTables.min.js"></script>

<link rel="stylesheet" href="assets/tablePaginate/jquery.dataTables.min.css" media="screen" title="no title">
<?php
$PAGE_TITLE   = 'Manage Url';
$URL_NAME     = 'manage-url';
require_once("../inc/accessbility_controller.inc.php"); 
require_once '../layout/dashboard-header-layout-property.php';
?>
</head>
<body class="ttr-opened-sidebar ttr-pinned-sidebar">
    
<?php
require_once '../layout/dashboard-header.php';
require_once '../layout/dashboard-sidebar.php';

?>

    <!--Main container start -->
    <main class="ttr-wrapper">
        <div class="container-fluid">
            
<?php
require_once '../layout/dashboard-header-bottom.php';


?>








 <div class="table-responsive">
      
<table class="example table table-bordered" class="display">
  <thead>
  <tr>
    <th>#</th>
    
    <th>Url Link</th>
    <th>Url Name</th>
    <th>Admin Role</th>
    <th>Has Sub-Link</th>
    <th>Link Icon</th>
    <th>Action</th>
  </tr>
</thead>

<tbody>
    <?php
if($links = $AdminTask->Get_All_Url_Link($Auth->admin_role)){
foreach ($links as $link) {

?>
 <tr>
<td><?= $link->id ?></td>
<td><?= $link->link ?></td>
<td><?= $link->link_name ?></td>
<td><?= $link->link_name ?></td>
<td><?= $link->has_sub == 1 ? 'has sub link' : 'no' ?></td>
<td><i class="<?= $link->link_icon ?>"></i></td>
<td><button class="btn btn-success">add</button></td>
  </tr>


  <?php
}
}
  ?>
</tbody>

</table>
</div>
















</div>
    </main>


<script type="text/javascript">
  $(document).ready(function() {
    $('.example').DataTable( {
        "pagingType": "full_numbers"
    } );
} );
</script>


    
<?php
require_once '../layout/dashboard-footer-layout-property.php';
?>


</html>


