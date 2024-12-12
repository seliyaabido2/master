
<?php $__env->startSection('title', 'Create Admin User'); ?>
<?php $__env->startSection('content'); ?>

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Create Employee User</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('employees.index')); ?>"><i class="fas fa-home"></i></a>
                </li>
                <li class="breadcrumb-item">
                    <a href="<?php echo e(route('employees.index')); ?>">Admin Users</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Create Employee User</li>
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

                        <?php echo Form::open(array("route" => array('employees.store'), 'method' => 'POST','id'=>'create_employee_user','autocomplete' =>'off','enctype'=>'multipart/form-data' )); ?>

                            <?php echo $__env->make('employees.form',['form'=>'Create'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php echo Form::close(); ?>

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
        $('.dropify').dropify();
    
        $.validator.addMethod('filesize', function (value, element, param) {
            return this.optional(element) || (element.files[0].size <= param);
        });
    
        $.validator.addMethod("onlyalphabetic", function(value, element) {
            return this.optional(element) || /^[a-zA-Z ]*$/i.test(value);
        }, "Only letters are allowed.");
    
        $.validator.addMethod("onlynumeric", function(value, element) {
            return this.optional(element) || /^[0-9]*$/i.test(value);
        }, "Only numbers are allowed.");
    
        $('#create_employee_user').validate({
            rules: {
                first_name: {
                    required: true,
                    maxlength: 50,
                    onlyalphabetic: true
                },
                last_name: {
                    required: true,
                    maxlength: 50,
                    onlyalphabetic: true
                },
                email: {
                    required: true,
                    email: true,
                    maxlength: 100
                },
                mobile: {
                    required: true,
                    maxlength: 15,
                    onlynumeric: true
                },
                country_code: {
                    maxlength: 5,
                    onlynumeric: true
                },
                address: {
                    maxlength: 255
                },
                gender: {
                    required: true
                },
                hobby: {
                    maxlength: 100
                },
                photo: {
                    required: true,
                    extension: "jpeg|jpg|png",
                    filesize: 2097152
                }
            },
            messages: {
                first_name: {
                    required: "Please enter the first name.",
                    maxlength: "First name cannot exceed 50 characters."
                },
                last_name: {
                    required: "Please enter the last name.",
                    maxlength: "Last name cannot exceed 50 characters."
                },
                email: {
                    required: "Please enter an email address.",
                    email: "Please enter a valid email address.",
                    maxlength: "Email cannot exceed 100 characters.",
                    remote: "This email is already registered."
                },
                mobile: {
                    required: "Please enter a mobile number.",
                    maxlength: "Mobile number cannot exceed 15 characters.",
                    onlynumeric: "Please enter only numbers."
                },
                country_code: {
                    maxlength: "Country code cannot exceed 5 characters.",
                    onlynumeric: "Please enter only numbers."
                },
                address: {
                    maxlength: "Address cannot exceed 255 characters."
                },
                gender: {
                    required: "Please select a gender."
                },
                hobby: {
                    maxlength: "Hobby cannot exceed 100 characters."
                },
                photo: {
                    required: "Please upload a photo.",
                    extension: "Please upload a valid image (JPEG, JPG, PNG).",
                    filesize: "Photo size cannot exceed 2MB."
                }
            }
        });
    </script>
    
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\AEIPL_laravel\resources\views/employees/create.blade.php ENDPATH**/ ?>