<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Hashids\Hashids;

class SubmissionObject extends Model
{
    protected $table = 'submission_objects';

    private static function createHashId($v)
    {
        $hashids = new Hashids(self::class . "_" . env('HASHIDS_SALT'), 16);
        return $hashids->encode($v);
    }

    public function createAndSaveHashId()
    {
        $this->hashId = SubmissionObject::createHashId($this->id);
        $this->save();
        return $this->hashId;
    }

    public function submission()
    {
        return $this->belongsTo('App\Models\Submission');
    }
    
}
