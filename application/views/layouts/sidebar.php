<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
  <div class="sidebar-brand-icon rotate-n-15">
    <i class="fas fa-laugh-wink"></i>
  </div>
  <div class="sidebar-brand-text mx-3">E-DATA <sup>2</sup></div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0">

<!-- Nav Item - Dashboard -->
<li class="nav-item active">
  <a class="nav-link" href="<?php echo base_url('/'); ?>">
    <i class="fas fa-fw fa-tachometer-alt"></i>
    <span>Dashboard</span></a>
</li>

<li class="nav-item active">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
  <i class="fas fa-file-invoice"></i>
    <span>Entry Data</span>
  </a>
  <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="<?php echo base_url('master-rig/index'); ?>">Nasabah</a>
      <a class="collapse-item" href="<?php echo base_url('master-perusahaan/index'); ?>">Perusahaan</a>
    </div>
  </div>
</li>

<?php if( $this->session->userdata('role') == '99' ): ?>
<!-- Divider -->
<hr class="sidebar-divider">
<!-- Heading -->
<div class="sidebar-heading">
  Admin Menu
</div>

<!-- Nav Item - Pages Collapse Menu -->
<li class="nav-item">
<a class="nav-link collapsed" href="<?php echo base_url('/'); ?>">
  <i class="fas fa-fw fa-cog"></i>
  <span>Log Activity</span>
</a>
  <!-- <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded"> -->
      <!-- <h6 class="collapse-header">Custom Components:</h6> -->
      <!-- <a class="collapse-item" href="buttons.html">Gudang</a> -->
      <!-- <a class="collapse-item" href="<?php // echo base_url('master-rig-trans/index'); ?>">RIG</a> -->
    <!-- </div>
  </div> -->
</li>
<?php endif; ?>

<!-- Nav Item - Utilities Collapse Menu -->
<!-- <li class="nav-item">
  <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
    <i class="fas fa-fw fa-wrench"></i>
    <span>Master Data</span>
  </a>
  <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
    <div class="bg-white py-2 collapse-inner rounded">
      <a class="collapse-item" href="<?php // echo base_url('master-status/index'); ?>">Master Posisi</a>
      <a class="collapse-item" href="<?php // echo base_url('master-jenis-item/index'); ?>">Master Tipe Barang</a>
      <a class="collapse-item" href="<?php // echo base_url('master-barang/index'); ?>">Master Barang</a>
      <a class="collapse-item" href="<?php // echo base_url('master-status-barang/index'); ?>">Master Status Barang</a>
      <a class="collapse-item" href="<?php /// echo base_url('master-rig/index'); ?>">Master RIG</a>
    </div>
  </div>
</li> -->

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Sidebar Toggler (Sidebar) -->
<div class="text-center d-none d-md-inline">
  <button class="rounded-circle border-0" id="sidebarToggle"></button>
</div>

</ul>
<!-- End of Sidebar -->