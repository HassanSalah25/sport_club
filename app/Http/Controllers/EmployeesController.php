<?php

namespace App\Http\Controllers;

use App\Models\Branchs;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use  App\Models\User;
use Illuminate\Support\Facades\File;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('is_trainer','0')->latest('id')->get();
//        dd($roles);
        return view('Dashboard.Employees.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions  = Permission::get();
        $roles  = Role::get();
        $branches  = Branchs::get();
        return view('Dashboard.Employees.create',compact('branches','permissions','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $fileNamePath="";
        if($request->hasFile('image')){
            $objFile =$request->image;
            $fileName = time() . $objFile->getClientOriginalName();
            $pathFile = public_path("storage/employee/images");
            $objFile->move($pathFile, $fileName);
            $fileNamePath = "storage/employee/images" . '/' . $fileName;
        }

        $admin = User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => bcrypt("$request->password"),
            "password_unhash" =>$request->password,
            "birth_day" => $request->birth_day,
            "national_id" => $request->national_id,
            "degree" => $request->degree,
            "military_status" => $request->military_status,
            "image" => $fileNamePath,
            "personal_image" => $request->personal_image,
            "national_image" => $request->national_image,
            "birth_certificate" => $request->birth_certificate,
            "degree_certificate" => $request->degree_certificate,
            "army_certificate" => $request->army_certificate,
            "feish" => $request->feish,
            "department" => $request->role,

        ]);
        $admin->branches()->sync($request->branch_id);
        if($request->role == "Administrator"){
            $admin->attachRole($request->role);
        } else
        {
            $admin->attachRole('User');
            if($request->permession){
                $admin->attachPermissions($request->permession);
            }
        }



        return redirect()->route('employee.index')->with('message','تم اضافه المؤظف بنجاح ');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user=User::find($id);
        $branches  = Branchs::get();
        return view('Dashboard.Employees.edit',compact('user','branches'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $admin = User::find($id);
        $admin->name =  $request->name;
        $admin->email =  $request->email;
        $admin->birth_day =  $request->birth_day;
        $admin->national_id =  $request->national_id;
        $admin->degree =  $request->degree;
        $admin->military_status =  $request->military_status;
        $admin->personal_image =  $request->personal_image;
        $admin->national_image =  $request->national_image;
        $admin->birth_certificate =  $request->birth_certificate;
        $admin->degree_certificate =  $request->degree_certificate;
        $admin->army_certificate =  $request->army_certificate;
        $admin->feish =  $request->feish;
        $admin->department =  $request->role;

        $fileNamePath="";
        if($request->hasFile('image')){
        File::delete($admin->image);

            $objFile =$request->image;
            $fileName = time() . $objFile->getClientOriginalName();
            $pathFile = public_path("storage/employee/images");
            $objFile->move($pathFile, $fileName);
            $fileNamePath = "storage/employee/images" . '/' . $fileName;
            $admin->image =  $fileNamePath;

        }

        if($request->password){
            $admin->password =  bcrypt("$request->password");
            $admin->password_unhash = $request->password;
        }
        if($request->role =="Administrator"){
            $per = \DB::table('permission_user')->where('user_id',$id)->delete();
            $role = \DB::table('role_user')->where('user_id',$id)->delete();
            $admin->attachRole($request->role);
        } else{
            $role = \DB::table('role_user')->where('user_id',$id)->delete();
            $per = \DB::table('permission_user')->where('user_id',$id)->delete();
            $admin->attachRole("User");
            if($request->permession) {

                $admin->attachPermissions($request->permession);
            }
        }
        $admin->save();

        $admin->branches()->sync($request->branch_id);
        return redirect()->route('employee.index')->with('message','تم تعديل المؤظف بنجاح ');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = \DB::table('role_user')->where('user_id',$id)->delete();
        $per = \DB::table('permission_user')->where('user_id',$id)->delete();
        $admin = User::find($id);
$admin->delete();
        return redirect()->route('employee.index')->with('error','تم حذف المؤظف بنجاح ');



    }
}
