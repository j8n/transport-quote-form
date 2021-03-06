<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\HasHashIdModel;

class SubmissionObject extends Model
{
    use HasHashIdModel;

    protected $table = 'submission_objects';
    
    public function submission()
    {
        return $this->belongsTo('App\Models\Submission');
    }

}
