@extends('layout')
@section('title', 'Edit Employer User')
@section('content')

<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Edit Employer User</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item">
                        <a href="{{ route('employees.index') }}"><i class="fas fa-home"></i></a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('employees.index') }}">Employer Users</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Edit Employer User</li>
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
                        @if (count($errors) > 0)
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger alert-dismissible show fade">
                                    <div class="alert-body">
                                        <button class="close" data-dismiss="alert">
                                            <span>&times;</span>
                                        </button>
                                        {{ $error }}
                                    </div>
                                </div>
                            @endforeach
                        @endif
                        
                        {!! Form::model($employee, ['method' => 'PATCH', 'route' => ['employees.update', $employee->id], 'id' => 'edit_employer_user', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data']) !!}
                            @include('employees.form', ['form' => 'Edit'])
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@push('js')
<script type="text/javascript" src="{{ asset('admin/js/jquery.validate.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('admin/js/additional-methods.min.js') }}"></script>

<script>
    // Initialize dropify for image uploads
    $('.dropify').dropify();

    // Validation rules for the edit form
    $('#edit_employer_user').validate({
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
                extension: "Please upload a valid image (JPEG, JPG, PNG).",
                filesize: "Photo size cannot exceed 2MB."
            }
        }
    });
</script>
@endpush
