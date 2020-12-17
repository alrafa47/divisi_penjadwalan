<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="index3.html" class="brand-link">
    <img src="<?= base_url() ?>assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">Divisi Kurikulum</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="<?= base_url() ?>assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block">ADMIN</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item has-treeview menu-open">
          <a href="<?= base_url('welcome') ?>" class="nav-link active">
            <i class="nav-icon fas fa-th"></i>
            <p>
              Dashboard</i>
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('Mapel') ?>" class="nav-link">
            <i class="fas fa-shield-alt"></i>
            <p>
              Data Mapel
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('Sesi') ?>" class="nav-link">
            <i class="fas fa-school"></i>
            <p>
              Data Sesi Jam
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('Penjadwalan') ?>" class="nav-link">
            <i class="fas fa-school"></i>
            <p>
              Data Penjadwalan
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="<?= base_url('Penilaian') ?>" class="nav-link">
            <i class="fas fa-list"></i>
            <p>
              Data Penilaian
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="" class="nav-link">
            <i class="fas fa-list"></i>
            <p>
              fitur blablabla
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="" class="nav-link">
            <i class="fas fa-tags"></i>
            <p>
              fitur blablabla
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="#" class="nav-link">
            <i class="fas fa-dollar-sign"></i>
            <p> fitur blablabla <i class="right fas fa-angle-left"></i></p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="" class="nav-link">
                <i class="fas fa-hand-holding-usd"></i>
                <p>
                  fitur blablabla
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link">
                <i class="fas fa-hand-holding-usd"></i>
                fitur blablabla
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="" class="nav-link">
                <i class="fas fa-hand-holding-usd"></i>
                <p> fitur blablabla</p>
              </a>
            </li>
          </ul>
        </li>

    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>