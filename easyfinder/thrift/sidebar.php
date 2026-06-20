<!-- sidebar -->
<nav class="sidebar sidebar-offcanvas" id="sidebar" style="z-index: 10000;">
  <ul class="nav">
  <li class="nav-item"> <a class="nav-link" href="profile.php"><i class="mdi mdi-account menu-icon"></i><span class="menu-title">Profile</span>
        </a></li>
<?php if( isset($_SESSION[APP_SESSION_NAME]["isAdmin"])  &&  $_SESSION[APP_SESSION_NAME]["isAdmin"] !=1){ /*sub menu item hide from admin*/ ?>
<li class="nav-item"> <a class="nav-link" href="dashboard_page.php"><i class="mdi mdi-mdi mdi-chart-bar menu-icon"></i><span class="menu-title">Dashboard</span>
        </a></li>
<?php } /*sub menu item hide from admin*/ ?>

<?php if(  isset($_SESSION[APP_SESSION_NAME]["isAdmin"])  &&  $_SESSION[APP_SESSION_NAME]["isAdmin"]==1){ /*menu item-1e*/ ?>
<li class="nav-item"> <a class="nav-link" href="admin_dashboard_page.php"><i class="mdi mdi-mdi mdi-chart-pie menu-icon"></i><span class="menu-title">Dashboard</span>
        </a></li>
<?php }/*menu item-1f*/  ?>

<?php if(  isset($_SESSION[APP_SESSION_NAME]["isAdmin"])  &&  $_SESSION[APP_SESSION_NAME]["isAdmin"]==1){ /*menu item-1e*/ ?>
<li class="nav-item"> <a class="nav-link" href="users_list_page.php"><i class="mdi mdi-mdi mdi-account-box menu-icon"></i><span class="menu-title">Users</span>
        </a></li>
<?php }/*menu item-1f*/  ?>

<?php if( isset($_SESSION[APP_SESSION_NAME]["isAdmin"])  &&  $_SESSION[APP_SESSION_NAME]["isAdmin"] !=1){ /*sub menu item hide from admin*/ ?>
<li class="nav-item"> <a class="nav-link" href="campaigns_list_page.php"><i class="mdi mdi-mdi mdi-target menu-icon"></i><span class="menu-title">Campaigns</span>
        </a></li>
<?php } /*sub menu item hide from admin*/ ?>

<?php if(  isset($_SESSION[APP_SESSION_NAME]["isAdmin"])  &&  $_SESSION[APP_SESSION_NAME]["isAdmin"]==1){ /*menu item-1e*/ ?>
<li class="nav-item"> <a class="nav-link" href="admin_campaigns_list_page.php"><i class="mdi mdi-mdi mdi-trophy-award menu-icon"></i><span class="menu-title">Campaigns</span>
        </a></li>
<?php }/*menu item-1f*/  ?>

<?php if( isset($_SESSION[APP_SESSION_NAME]["isAdmin"])  &&  $_SESSION[APP_SESSION_NAME]["isAdmin"] !=1){ /*sub menu item hide from admin*/ ?>
<li class="nav-item"> <a class="nav-link" href="donations_list_page.php"><i class="mdi mdi-mdi mdi-cash menu-icon"></i><span class="menu-title">Donations</span>
        </a></li>
<?php } /*sub menu item hide from admin*/ ?>

<?php if(  isset($_SESSION[APP_SESSION_NAME]["isAdmin"])  &&  $_SESSION[APP_SESSION_NAME]["isAdmin"]==1){ /*menu item-1e*/ ?>
<li class="nav-item"> <a class="nav-link" href="admin_donations_list_page.php"><i class="mdi mdi-mdi mdi-cash-multiple menu-icon"></i><span class="menu-title">Donations</span>
        </a></li>
<?php }/*menu item-1f*/  ?>

<?php if( isset($_SESSION[APP_SESSION_NAME]["isAdmin"])  &&  $_SESSION[APP_SESSION_NAME]["isAdmin"] !=1){ /*sub menu item hide from admin*/ ?>
<li class="nav-item"> <a class="nav-link" href="deposits_list_page.php"><i class="mdi mdi-mdi mdi-arrow-down-bold-circle menu-icon"></i><span class="menu-title">Deposits</span>
        </a></li>
<?php } /*sub menu item hide from admin*/ ?>

<?php if(  isset($_SESSION[APP_SESSION_NAME]["isAdmin"])  &&  $_SESSION[APP_SESSION_NAME]["isAdmin"]==1){ /*menu item-1e*/ ?>
<li class="nav-item"> <a class="nav-link" href="admin_deposits_list_page.php"><i class="mdi mdi-mdi mdi-arrow-down-bold-circle menu-icon"></i><span class="menu-title">Deposits</span>
        </a></li>
<?php }/*menu item-1f*/  ?>

<?php if( isset($_SESSION[APP_SESSION_NAME]["isAdmin"])  &&  $_SESSION[APP_SESSION_NAME]["isAdmin"] !=1){ /*sub menu item hide from admin*/ ?>
<li class="nav-item"> <a class="nav-link" href="withdrawals_list_page.php"><i class="mdi mdi-mdi mdi-arrow-up-bold-circle menu-icon"></i><span class="menu-title">Withdrawals</span>
        </a></li>
<?php } /*sub menu item hide from admin*/ ?>

<?php if(  isset($_SESSION[APP_SESSION_NAME]["isAdmin"])  &&  $_SESSION[APP_SESSION_NAME]["isAdmin"]==1){ /*menu item-1e*/ ?>
<li class="nav-item"> <a class="nav-link" href="admin_withdrawals_list_page.php"><i class="mdi mdi-mdi mdi-arrow-up-bold-circle menu-icon"></i><span class="menu-title">Withdrawals</span>
        </a></li>
<?php }/*menu item-1f*/  ?>
</ul>
</nav>
<!-- partial -->