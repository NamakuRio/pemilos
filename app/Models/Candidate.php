<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    public function candidateDetails()
    {
        return $this->hasMany(CandidateDetail::class);
    }

    public function calculations()
    {
        return $this->hasMany(Calculation::class);
    }
}
