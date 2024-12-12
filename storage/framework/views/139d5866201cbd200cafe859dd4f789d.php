<div class="row">
    <!-- First Name -->
    <div class="form-group col-md-6">
        <label class="form-control-label">First Name<span class="vali">*</span></label>
        <input type="hidden" name="id" value="<?php echo e(isset($employer) ? $employer->id : null); ?>">
        <?php echo Form::text('first_name', null, ['placeholder' => 'First Name', 'class' => 'form-control', 'id' => 'first_name', 'required' => true]); ?>

    </div>

    <!-- Last Name -->
    <div class="form-group col-md-6">
        <label class="form-control-label">Last Name<span class="vali">*</span></label>
        <?php echo Form::text('last_name', null, ['placeholder' => 'Last Name', 'class' => 'form-control', 'id' => 'last_name', 'required' => true]); ?>

    </div>

    <!-- Email -->
    <div class="form-group col-md-6">
        <label class="form-control-label">Email<span class="vali">*</span></label>
        <?php echo Form::email('email', null, ['placeholder' => 'Email', 'class' => 'form-control', 'id' => 'email', 'required' => true]); ?>

    </div>

    <!-- Country Code -->
    <div class="form-group col-md-6">
        <label class="form-control-label">Country Code<span class="vali">*</span></label>
        <?php echo Form::text('country_code', null, ['placeholder' => 'Country Code', 'class' => 'form-control', 'id' => 'country_code', 'required' => true]); ?>

    </div>

    <!-- Mobile -->
    <div class="form-group col-md-6">
        <label class="form-control-label">Mobile<span class="vali">*</span></label>
        <?php echo Form::text('mobile', null, ['placeholder' => 'Mobile', 'class' => 'form-control', 'id' => 'mobile', 'required' => true]); ?>

    </div>
   
    <!-- Address -->
    <div class="form-group col-md-6">
        <label class="form-control-label">Address<span class="vali">*</span></label>
        <?php echo Form::textarea('address', null, ['placeholder' => 'Address', 'class' => 'form-control', 'id' => 'address', 'rows' => 3, 'required' => true]); ?>

    </div>

    <!-- Gender -->
    <div class="form-group col-md-6">
        <label class="form-control-label">Gender<span class="vali">*</span></label>
        <?php echo Form::select('gender', ['Male' => 'Male', 'Female' => 'Female', 'Other' => 'Other'], null, ['placeholder' => 'Select Gender', 'class' => 'form-control', 'id' => 'gender', 'required' => true]); ?>

    </div>

    <!-- Hobby -->
    <div class="form-group col-md-6">
        <label class="form-control-label">Hobby<span class="vali">*</span></label>
        <?php echo Form::select('hobby[]', 
            ['Reading' => 'Reading', 'Traveling' => 'Traveling', 'Sports' => 'Sports', 'Music' => 'Music'], 
            isset($employee->hobby) ? json_decode($employee->hobby) : [], 
            ['class' => 'form-control', 'id' => 'hobby', 'multiple' => 'multiple', 'required' => true]); ?>

    </div>
    

    <!-- Photo -->
    <div class="form-group col-md-6">
        <label class="form-control-label">Photo<span class="vali">*</span></label>
        <?php echo Form::file('photo', [
            'class' => 'dropify',
            'id' => 'input-file-max-fs',
            'data-default-file' => isset($employee) && !empty($employee->photo) 
                ? asset('uploads/employee/' . $employee->photo) 
                : asset('admin/dist/img/default.png'), // Default image path if no photo
            'data-errors-position' => 'outside',
            'data-show-remove' => 'false',
            'data-show-errors' => 'false',
            'required' => true
        ]); ?>

        <label id="input-file-max-fs-error" class="error" for="input-file-max-fs"></label>
    </div>
    
    
</div>

<div class="row">
    <button class="btn btn-primary mr-1" type="submit">Submit</button>
    <a href="<?php echo e(route('employees.index')); ?>" class="btn btn-danger">Cancel</a>
</div>
<?php /**PATH C:\xampp\htdocs\AEIPL_laravel\resources\views/employees/form.blade.php ENDPATH**/ ?>