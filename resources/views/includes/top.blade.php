<header class="header">
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <div class="menu-sec"> <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
      <div class="responsive_nav"></div>
      </a> </div>
    <div class="text-center main-title">
      <?php

        if(Auth::user()->role == 1){
            $facility = DB::table("facilities")->where('facility_id', Auth::user()->facility_id)->first();
            echo $facility->facility_name;
        }else if(Auth::user()->role == 2){
          $lab = DB::table("lab")->where('lab_id', Auth::user()->lab_id)->first();
          echo $lab->lab_name;
        }else {
          echo 'Admin';
        }
        ?>
    </div>
    <div class="log"><a href="/logout">Logout</a></div>
  </nav>
</header>
