
<?php $__env->startSection('title', 'Employer Users'); ?>
<?php $__env->startSection('content'); ?>


<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h3 class="float-left">Employer Users</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="<?php echo e(route('employees.index')); ?>"><i class="fas fa-home"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Employer Users</li>
                </ol>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-primary">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                            </div>
                            <div class="col-sm-6">
                                <h3 class="text-white float-right">
                                    <a type="button" href="<?php echo e(route('employees.create')); ?>" class="btn btn-primary">
                                        Add Employee User
                                    </a>
                                </h3>
                            </div>
                        </div>

                        <?php if(count($errors) > 0): ?>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="alert alert-danger alert-dismissible show fade">
                                    <div class="alert-body">
                                        <button class="close" data-dismiss="alert">
                                        <span>&times;</span>
                                        </button>
                                        <?php echo e($error); ?>

                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>

                        <div class="table-responsive table-responsive-data2">
                            <table class="table table-top-campaign" style="width: 100% !important" id="employeeTable">
                                <thead>
                                    <tr class="text-center">
                                        <th>ID</th>
                                        <th>Image</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Mobile</th>
                                        <th>Country Code</th>
                                        <th>Gender</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('js'); ?>
    <script type="text/javascript" src="<?php echo e(asset('admin/js/jquery.validate.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('admin/js/additional-methods.min.js')); ?>"></script>
    <script>
        $(function(){
            var oTable = $('#employeeTable').DataTable({
                processing: true,
                serverSide: true,
                searching: true,
                ajax:{
                    url:"<?php echo e(route('employees.get-employees-data')); ?>",
                    type:"POST",
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: function(d){
                        console.log(d);
                    }
                },
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'photo', name: 'photo'},
                    {data: 'first_name', name: 'first_name'},
                    {data: 'last_name', name: 'last_name'},
                    {data: 'email', name: 'email'},
                    {data: 'mobile', name: 'mobile'},
                    {data: 'country_code', name: 'country_code'},
                    {data: 'gender', name: 'gender'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

            $(document).on("click", ".deleteEmployeUser", function () {
                var delete_id = $(this).attr('id'); // Get the employee ID from the button

                // Show confirmation alert using SweetAlert
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Make AJAX request to delete employee
                        $.ajax({
                            url: '<?php echo e(URL::to('employees')); ?>' + '/' + delete_id, 
                            type: 'DELETE',
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content') 
                            },
                            success: function(result) {
                                Swal.fire(
                                    'Deleted!',
                                    'Employee record has been deleted.',
                                    'success'
                                );
                                
                                oTable.draw(true); 
                            },
                            error: function(error) {
                                Swal.fire(
                                    'Error!',
                                    'There was an issue deleting the employee.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });

        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\AEIPL_laravel\resources\views/employees/index.blade.php ENDPATH**/ ?>