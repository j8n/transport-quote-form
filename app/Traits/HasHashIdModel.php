<?php

namespace App\Traits;
use Illuminate\Support\Facades\Log;
use Hashids\Hashids;

trait HasHashIdModel {

    private static function createHashId($v){
        Log::info(self::class);
        $hashids = new Hashids(self::class . "_" . env('HASHIDS_SALT'), 16);
        return $hashids->encode($v);
    }
    
    public function createAndSaveHashId(){
        if(!is_null($this->hashId)){
            return;
        }
        Log::info(get_class($this));
        
        $this->hashId = get_class($this)::createHashId($this->id);
        $this->save();
        return $this->hashId;
    }

}