<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CandidateDetail extends Model
{

    protected $fillable = ['candidate_id', 'name', 'class', 'majors', 'gender', 'picture', 'type'];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class);
    }
}
