<?php
    $srole = DB::table('users')->where('user_id', Auth::id())->first();
 ?>
<aside class="left-side sidebar-offcanvas">
    <section class="sidebar ">
      <div class="page-sidebar  sidebar-nav">
        <div class="clearfix"></div>
        <!-- BEGIN SIDEBAR MENU -->
        <ul class="page-sidebar-menu" id="menu">
          <li class="active"> <a href="/dashboard"><i><img src="/img/dashboard.jpg" width="20" alt="dashboard" style="margin-right:10px;"></i> <span class="title">Dashboard</span> </a> </li>
          <?php if($srole->role == 0 || $srole->role == 1){ ?>
          <li> <a href="/addclient"><i><img src="/img/new-client-icon.png" width="20" alt="new-client" style="margin-right:10px;"></i> <span class="title">New Client</span> </a> </li>
          <?php } ?>
          <li> <a href="/search"><i><img src="/img/search-icon-dashboard.png" width="20" alt="search" style="margin-right:10px;"></i> <span class="title">Search</span> </a> </li>
          <?php if($srole->role == 0){ ?>
          <li  > <a href="/users"><i><img src="img/user-icon-dashboard.png" width="20" alt="search" style="margin-right:10px;"></i> <span class="title">Users</span> </a> </li>
          <li  > <a href="/facilities"><i><img src="img/facility-icon-dashboard.png" width="20" alt="search" style="margin-right:10px;"></i> <span class="title">Facilities</span> </a> </li>
          <li  class="active"> <a href="/labs"><i><img src="img/lab-icon-dashboard.png" width="20" alt="search" style="margin-right:10px;"></i> <span class="title">Labs</span> </a> </li>
          <?php } ?>
        </ul>
        <!-- END SIDEBAR MENU -->
      </div>
    </section>
    <!-- /.sidebar -->
  </aside>
