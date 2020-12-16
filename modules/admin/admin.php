<?php
session_start();
if (!isset($_SESSION['login'])) {
  header("Location: login.php");
}
?>
<div class="row mt-4 pt-4">
  <nav class="col-md-2 d-none d-md-block bg-light sidebar">
    <div class="sidebar-sticky">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link active" id="dashboard" href="javascript:void(0);">
            <i class="fas fa-home title-icon"></i> Dashboard <span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" id="cari" href="javascript:void(0);">
            <i class="fas fa-search title-icon"></i> Cari Data <span class="sr-only">(current)</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" id="logout" href="javascript:void(0);">
            <i class="fas fa-sign-out-alt title-icon"></i> Logout <span class="sr-only">(current)</span>
          </a>
        </li>
      </ul>
    </div>
  </nav>
  <main id="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  </main>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    // $('#pengunjungHariIni').DataTable();
    $('#main').load('modules/admin/dashboard.php');
  });

  $('.nav-link').click(function() {
    // membuat variabel untuk menampung nama id dari class 'menu' yang diklik
    var link = $(this).attr('id');
    // jika id = beranda, maka load halaman view beranda
    if (link == "dashboard") {
      $('#main').load('modules/admin/dashboard.php');
    }
    // jika id = pelanggan, maka load halaman view pelanggan
    else if (link == "cari") {
      $('#main').load('modules/admin/caridata.php');
    } else if (link == "logout") {
      $('#main').load('modules/admin/logout.php');
    }
  });

  $('#logout').click(function() {
    $('.content').load('modules/admin/logout.php');
  });
</script>