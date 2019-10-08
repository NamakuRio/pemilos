<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidate as AppCandidate;
use App\Models\CandidateDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class Candidate extends Controller
{
    public function index()
    {
        return view('admin.candidate.index');
    }

    public function create()
    {
        return view('admin.candidate.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_ketua'    => 'required',
            'class_ketua'   => 'required',
            'majors_ketua'  => 'required',
            'gender_ketua'  => 'required',
            'picture_ketua' => 'required|file|max:2048|mimes:png,jpg,jpeg',
            'name_wakil'    => 'required',
            'class_wakil'   => 'required',
            'majors_wakil'  => 'required',
            'gender_wakil'  => 'required',
            'picture_wakil' => 'required|file|max:2048|mimes:png,jpg,jpeg',
            'visi'          => 'required',
            'misi'          => 'required'
        ]);

        $picture_ketua = $request->file('picture_ketua')->store('candidate/ketua');
        $picture_wakil = $request->file('picture_wakil')->store('candidate/wakil');

        $candidate = AppCandidate::create([
            'visi' => $request->visi,
            'misi' => $request->misi,
        ]);

        if($candidate) {
            $ketua = CandidateDetail::create([
                'candidate_id'  => $candidate->id,
                'name'          => $request->name_ketua,
                'class'         => $request->class_ketua,
                'majors'        => $request->majors_ketua,
                'gender'        => $request->gender_ketua,
                'picture'       => $picture_ketua,
                'type'          => 'ketua'
            ]);

            $wakil = CandidateDetail::create([
                'candidate_id'  => $candidate->id,
                'name'          => $request->name_wakil,
                'class'         => $request->class_wakil,
                'majors'        => $request->majors_wakil,
                'gender'        => $request->gender_wakil,
                'picture'       => $picture_wakil,
                'type'          => 'wakil'
            ]);

            if($ketua && $wakil) {
                $return = '
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Sukses!</strong> Data Kandidate Berhasil dihapus.
                    </div>
                    ';
            } else {
                $return = '
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Sukses!</strong> Data Kandidate Berhasil dihapus.
                    </div>
                    ';
            }
        } else {
            $return = '
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Sukses!</strong> Data Kandidate Berhasil dihapus.
                </div>
                ';
        }

        return $return;
    }

    public function edit(Request $request)
    {
        return view('admin.candidate.update');
    }

    public function update()
    {

    }

    public function destroy(Request $request)
    {
        $candidate_data = AppCandidate::find($request->id);
        Storage::delete($candidate_data->image);

        $candidate = AppCandidate::destroy($request->id);

        if($candidate) {
            $return = '
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Sukses!</strong> Data Kandidate Berhasil dihapus.
            </div>
            ';
        } else {
            $return = '
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Gagal!</strong> Data Kandidate Gagal dihapus.
            </div>
            ';
        }
        return $return;
    }

    public function getDetailCandidate(Request $request)
    {
        $candidate = AppCandidate::find($request->id);

        $detail = $request->detail;
        if($detail == 'ketua' || $detail == 'wakil') {
            $candidate = $candidate->candidateDetails->where('type', $detail)->first();

            $response = array('status' => 'success', 'msg' => 'berhasil mengambil detail', 'data' => $candidate, 'picture' => '<img src="'.asset('uploads/'.$candidate->picture).'" class="img-thumbnail" id="view-picture-ketua" alt="Responsive image">');
        } else {

            $response = array('status' => 'success', 'msg' => 'berhasil mengambil detail', 'data' => $candidate->$detail);
        }

        return response()->json($response);
    }

    public function getCandidate()
    {
        $candidates = AppCandidate::get()->all();

        return DataTables::of($candidates)
                            ->addColumn('ketua', function($candidate) {
                                $ketua = $candidate->candidateDetails->where('type', 'ketua')->first();

                                $getKetua = '<a href="javascript:void(0)" data-id="'. $candidate->id .'" onclick="ketua_modal(this)">'.$ketua->name.'</a>';

                                return $getKetua;
                            })
                            ->addColumn('wakil', function($candidate) {
                                $wakil = $candidate->candidateDetails->where('type', 'wakil')->first();

                                $getWakil = '<a href="javascript:void(0)" data-id="'. $candidate->id .'" onclick="wakil_modal(this)">'.$wakil->name.'</a>';

                                return $getWakil;
                            })
                            ->editColumn('visi', function($candidate) {
                                $visi = "";
                                $visi = '<a href="javascript:void(0)" data-id="'. $candidate->id .'" onclick="visi_modal(this)">[Visi]</a>';

                                return $visi;
                            })
                            ->editColumn('misi', function($candidate) {
                                $misi = "";
                                $misi = '<a href="javascript:void(0)" data-id="'. $candidate->id .'" onclick="misi_modal(this)">[Misi]</a>';

                                return $misi;
                            })
                            ->addColumn('action', function($candidate) {
                                $button = "";
                                if(auth()->user()->can("candidate.update")) $button .= '<a href="'.route("admin.candidate.edit", ['id' => $candidate->id]).'" class="btn btn-xs btn-outline-primary btn-rounded" >Edit</a> ';
                                if(auth()->user()->can("candidate.delete")) $button .= '<a href="javascript:void(0)" class="btn btn-xs btn-outline-danger btn-rounded" data-id="'. $candidate->id .'" onclick="delete_modal(this)">Hapus</a>';
                                return $button;
                            })
                            ->escapeColumns([])
                            ->make(true);
    }
}
