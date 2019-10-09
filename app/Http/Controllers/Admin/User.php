<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User as AppUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class User extends Controller
{
    public function index()
    {
        return view('admin.user.index');
    }

    public function create()
    {
        return view('admin.user.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username'    => 'required|unique:users,username',
            'name'   => 'required',
            'email'  => 'required|unique:users,email|email',
        ]);

        $user = AppUser::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt('12345678'),
            'api_token' => bcrypt($request->email),
            'code' => rand(1000, 9999),
        ]);

        $user->assignRole('member');

        if($user) {
            $return = '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Sukses!</strong> Data User Berhasil ditambahkan.
                </div>
                ';
        } else {
            $return = '
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Sukses!</strong> Data User Gagal ditambahkan.
                </div>
                ';
        }

        return $return;
    }

    public function destroy(Request $request)
    {
        $candidate = AppUser::destroy($request->id);

        if($candidate) {
            $return = '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Sukses!</strong> Data User Berhasil dihapus.
            </div>
            ';
        } else {
            $return = '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal!</strong> Data User Gagal dihapus.
            </div>
            ';
        }
        return $return;
    }

    public function getCode(Request $request)
    {
        $user = AppUser::find($request->id_code);

        if(Hash::check($request->password, $user->password)) {
            $return = '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Sukses!</strong> Berikut Code dari '.$user->name.'.
            </div>
            <input type="text" value="'.$user->code.'" class="form-control" readonly />
            ';
        } else {
            $return = '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal!</strong> Password yang Anda masukkan salah.
            </div>
            ';
        }

        return $return;
    }

    public function getUser()
    {
        $users = AppUser::get()->all();

        return DataTables::of($users)
                            ->editColumn('code', function($user) {
                                $code = "";
                                $code = '<a href="javascript:void(0)" data-id="'. $user->id .'" onclick="code_modal(this)">[Lihat Code]</a>';

                                return $code;
                            })
                            ->addColumn('action', function($user) {
                                $button = "";
                                if(auth()->user()->can("user.update")) $button .= '<a href="'.route("admin.user.edit", ['user' => $user]).'" class="btn btn-xs btn-outline-primary btn-rounded" >Edit</a> ';
                                if(auth()->user()->can("user.delete")) $button .= '<a href="javascript:void(0)" class="btn btn-xs btn-outline-danger btn-rounded" data-id="'. $user->id .'" onclick="delete_modal(this)">Hapus</a>';
                                return $button;
                            })
                            ->escapeColumns([])
                            ->make(true);
    }
}
