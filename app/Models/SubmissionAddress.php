<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasHashIdModel;

class SubmissionAddress extends Model
{
    use HasHashIdModel;

    protected $table = 'submission_addresses';

    public function submission()
    {
        return $this->belongsTo('App\Models\Submission');
    }

}
