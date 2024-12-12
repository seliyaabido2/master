<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?php echo e(route('employees.index')); ?>" class="brand-link">
      <img src="<?php echo e(asset('admin/dist/img/AdminLogo.png')); ?>" alt="AdminLTE Logo" class="brand-image elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light" style="text-transform: uppercase"><b><?php echo e(env('APP_NAME')); ?></b></span>
    </a>

    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="<?php echo e(route('employees.index')); ?>" class="nav-link <?php echo e(request()->is('employees/*') ? 'active' : ''); ?>">
                        <i class="nav-icon far fa-circle text-info"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
  </aside>
<?php /**PATH C:\xampp\htdocs\AEIPL_laravel\resources\views/sidebar.blade.php ENDPATH**/ ?>