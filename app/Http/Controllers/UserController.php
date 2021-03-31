<?php

namespace App\Http\Controllers;

use App\Exports\UserExport;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    public function index() {
        $total_users = DB::table('users')->count();

        return view('user.index', compact('total_users'));
    }
    
    public function all() {

        if (request()->ajax()) {
            $data = User::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" data-uuid="' .$row->uuid. '" class="edit btn btn-success btn-sm edit-data">Edit</a> <a href="javascript:void(0)" data-uuid="' . $row->uuid . '" data-nama_user="' . $row->name . '" class="delete btn btn-danger btn-sm delete-data">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function create(Request $request) {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'], 
            'profile_picture' => ['nullable', 'image'], 
        ]);
        
        $password = $this->randPass();

        $user = User::create([ 
            'name' => $validatedData['name'], 
            'email' => $validatedData['email'],
            'password' => $password,
        ]);
        $user->encrypted()->create(['encrypted_password' => Crypt::encrypt($password)]);

        $user->sendEmailVerificationNotification();

        return response()->json($user);
    }

    public function update(Request $request) {
        
        $user = User::where('uuid', $request->uuid)->firstOrFail();
        
        return response()->json($request->all());

        $validatedData = $request->validate([
            'name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)], 
            'password' => ['nullable', 'string', 'min:8'], 
            'profile_picture' => ['nullable', 'image'], 
        ]);

        if($request->hasFile('profile_picture')) {
            $path = explode('/', $user->profile_picture);
            if(end($path) != 'No_Image_Available.jpg') {
                unlink(public_path('storage/profile_pictures') . '/' . end($path));
            }
            $file = $request->file('profile_picture');
            $filename = time() . $file->getClientOriginalName();
            $file->storeAs('/public/profile_pictures', $filename);
            $user->profile_picture = URL::asset('storage/profile_pictures/' . $filename);
        }
        
        foreach(array_filter($validatedData) as $key => $value) {
            if($key != 'profile_picture') {
                if ($key == 'password') {
                    $user->password = Hash::make($value);
                } else {
                    $user->{$key} = $value;
                }
            } 
        }
        $user->save();

        return response()->json($user);
    }

    public function edit($uuid) 
    {
        $user = User::where('uuid', $uuid)->firstOrFail();
        
        if( request()->wantsJson() ) {
            return response()->json($user);
        }
    }

    public function delete($uuid) 
    {
        $user = User::where('uuid', $uuid)->firstOrFail();

        $path = explode('/', $user->profile_picture);
        if(end($path) != 'No_Image_Available.jpg') {
            unlink(public_path('storage/profile_pictures') . '/' . end($path));
        }
        $user->delete();

        return response()->json($user);
    }

    private function randPass()
    {
        $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890!$%^&!$%^&');
        return substr($random, 0, 10);
    }

    public function exportExcel() {
        return Excel::download(new UserExport, 'users.xlsx');
    }

}
