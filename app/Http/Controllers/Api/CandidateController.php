<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Calculation;
use App\Models\Candidate;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    public function getCandidate()
    {
        $candidates = Candidate::get();

        $response = array();

        foreach($candidates as $candidate) {
            $ketua = $candidate->candidateDetails->where('type', 'ketua')->first();
            $wakil = $candidate->candidateDetails->where('type', 'wakil')->first();

            $response[] = array(
                'id' => $candidate->id,
                'ketua_name' => $ketua->name,
                'ketua_class' => $ketua->class,
                'ketua_major' => $ketua->majors,
                'ketua_gender' => $ketua->gender,
                'ketua_picture' => $ketua->picture,
                'wakil_name' => $wakil->name,
                'wakil_class' => $wakil->class,
                'wakil_major' => $wakil->majors,
                'wakil_gender' => $wakil->gender,
                'wakil_picture' => $wakil->picture,
                'visi' => $candidate->visi,
                'misi' => $candidate->misi,
            );
        }

        return response()->json(['status' => 'success', 'msg' => 'berhasil mengambil data candidate', 'data' => $response]);
    }

    public function yourChoice(Request $request)
    {
        $candidate_id = $request->candidate_id;
        $user_id = $request->user_id;

        $calculation = Calculation::find(['candidate_id' => $candidate_id, 'user_id' => $user_id]);

        if($calculation->count() == 0) {
            $inserChoice = Calculation::create([
                'candidate_id' => $candidate_id,
                'user_id' => $user_id,
            ]);
            if($inserChoice){
                $response = array('status' => 'success', 'msg' => 'Terima kasih telah menggunakan suara Anda');
            } else {
                $response = array('status' => 'error', 'msg' => 'Maaf, sedang ada kendala, lakukan ulang');
            }
        } else {
            $response = array('status' => 'success', 'msg' => 'Anda udah nyoblos ya');
        }

        return response()->json($response);
    }
}
