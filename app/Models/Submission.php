<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;
use App\Traits\HasHashIdModel;

class Submission extends Model
{
    use HasHashIdModel;

    protected $table = 'submissions';

    public static function create($data)
    {
        $submission = new Submission();
        $submission->save();
        //$submission->contactInfo_name = $data['name'];
        //$submission->contactInfo_phone = $data['phone'];
        //$submission->contactInfo_email = $data['email'];
        //$submission->contactInfo_date = $data['date'];
        //$submission->save();
        $submission->createAndSaveHashId();

        // create storage folder
        if(!File::exists(storage_path('app/public/submissions/'. $submission->hashId))){
            File::makeDirectory(storage_path('app/public/submissions/'. $submission->hashId));
        }

        return $submission;
    }

    public function addresses()
    {
        return $this->hasMany('App\Models\SubmissionAddress');
    }

    public function objects()
    {
        return $this->hasMany('App\Models\SubmissionObject');
    }

    public function getFolder()
    {
        if(!File::exists(storage_path('app/public/submissions/'. $this->hashId))){
            return null;
        }

        return storage_path('app/public/submissions/'. $this->hashId);
    }

    public function getContactInfoCsvPath()
    {
        if(!File::exists(storage_path('app/public/submissions/'. $this->hashId))){
            return null;
        }

        return storage_path('app/public/submissions/'. $this->hashId.'/contactInfo.csv');
    }

    public function getAddressesCsvPath()
    {
        if(!File::exists(storage_path('app/public/submissions/'. $this->hashId))){
            return null;
        }

        return storage_path('app/public/submissions/'. $this->hashId.'/addresses.csv');
    }

    public function getObjectsCsvPath()
    {
        if(!File::exists(storage_path('app/public/submissions/'. $this->hashId))){
            return null;
        }

        return storage_path('app/public/submissions/'. $this->hashId.'/objects.csv');
    }

}
