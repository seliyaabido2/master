<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Http\Requests\UpdateRequest;
use App\Models\Employee;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('employees.index');
    }

    /**
     * Display a listing of the Dtatable.
     */
    public function getEmployerData(Request $request){

        $employees = Employee::query();

        return DataTables::of($employees)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {

                 $btn = '<a href="' . route('employees.edit', $row->id) . '" class="btn btn-primary" data-toggle="tooltip" title="Edit" data-original-title="Edit"><i class="far fa-edit"></i></a>';
                 
                 $btn .= '<a href="javascript:void(0)" id="' . $row->id . '" class="btn btn-danger deleteEmployeUser ml-2" data-toggle="tooltip" title="Delete" data-original-title="Delete"><i class="fas fa-trash fa-fw"></i></a>';

                return $btn;
            })
            ->editColumn('photo', function($row){
                if($row->photo){
                    return '<img src="'.asset('uploads/employee/'.$row->photo).'" width="50" height="50">';
                } else {
                    return '<img src="'. asset('admin/dist/img/default.png') .'" width="50" height="50">';
                }
            })
            ->rawColumns(['action','photo'])
            ->make(true);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $input = $request->all();

        // Ensure hobby is an array and convert to JSON format
        if (!empty($input['hobby']) && is_array($input['hobby'])) {
            $input['hobby'] = json_encode($input['hobby']);
        }

        // Handle file upload for photo
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $filepath = 'uploads/employee';
            $file->move($filepath, $filename);
            $input['photo'] = $filename;
        }

        // Save employee details
        $employee = new Employee();
        $employee->first_name = $input['first_name'];
        $employee->last_name = $input['last_name'];
        $employee->email = strtolower(trim($input['email']));
        $employee->mobile = $input['mobile'];
        $employee->country_code = $input['country_code'];
        $employee->address = $input['address'];
        $employee->gender = $input['gender'];
        $employee->hobby = $input['hobby']; // Store hobbies as JSON
        $employee->photo = $input['photo'] ?? null;
        $employee->save();

        if ($employee) {  
            return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
        } else {
            return redirect()->route('employees.index')->with('error', 'Failed to create employee.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Find the employee by id
        $employee = Employee::find($id);
    
        // Check if employee exists
        if ($employee) {
            // Pass the employee data to the view
            return view('employees.edit', compact('employee'));
        } else {
            // If employee not found, redirect with an error message
            return redirect('employees.index')->with('error', 'Employee not found.');
        }
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, $id)
    {
        // Get the request input
        $input = $request->all();
    
        // Find the employee by id
        $employee = Employee::find($id);
    
        // Check if employee exists
        if (!empty($employee)) {
            
            // Handle hobby field - Ensure it's an array and convert it to JSON
            if (!empty($input['hobby']) && is_array($input['hobby'])) {
                $input['hobby'] = json_encode($input['hobby']);
            }
    
            // Handle file upload for photo (if new file is uploaded)
            if ($request->has('photo')) {
                // Delete the old file if it exists
                $old_file_array = explode('/', $employee->getAttributes()['photo']);
                $old_file_name = last($old_file_array);
                $old_file = public_path('uploads/employee/' . $old_file_name);
                if (File::exists($old_file)) {
                    File::delete($old_file);
                }
    
                // Upload the new file
                $file = $request->file('photo');
                $filename = time() . '.' . $file->getClientOriginalExtension();
                $filepath = 'uploads/employee';
                $file->move($filepath, $filename);
                $input['photo'] = $filename;
            } else {
                // If no new file, retain the old file name
                $input['photo'] = $employee->photo;
            }
    
            // Update the employee fields
            $employee->first_name = $input['first_name'];
            $employee->last_name = $input['last_name'];
            $employee->email = strtolower(trim($input['email']));
            $employee->mobile = $input['mobile'];
            $employee->country_code = $input['country_code'];
            $employee->address = $input['address'];
            $employee->gender = $input['gender'];
            $employee->hobby = $input['hobby']; // Update hobby field as JSON
            $employee->photo = $input['photo']; // Update photo field
            $employee->save();
    
            return redirect('employees')->with('success', 'Employee updated successfully.');
        }
    
        return redirect('employees.index')->with('error', 'Something went wrong.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Find the employee by ID
        $employee = Employee::find($id);
    
        if ($employee) {
            // Check if the employee has an associated photo
            if (!empty($employee->photo)) {
                // Extract the file name from the image path
                $old_file_array = explode('/', $employee->photo);
                $old_file_name = last($old_file_array);
                $old_file = public_path('uploads/employee/' . $old_file_name);
    
                // Check if the file exists before attempting to delete it
                if (File::exists($old_file)) {
                    File::delete($old_file);
                }
            }
    
            // Delete the employee
            $employee->delete();
    
            // Flash success message to session
            Session::flash('success', 'Employee deleted successfully.');
    
            return response()->json(['success' => true]);
        } else {
            // Flash error message if the employee was not found
            Session::flash('error', 'Employee not found.');
    
            return response()->json(['success' => false, 'message' => 'Employee not found.']);
        }
    }
    
}
