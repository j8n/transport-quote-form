<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use App\Models\Submission;
use App\Models\SubmissionAddress;
use App\Models\SubmissionObject;
use App\Mail\FormSubmitCompany;
use App\Mail\FormSubmitUser;
use Mail;
use Keboola\Csv\CsvWriter;


class SubmitController extends Controller
{
    public function __construct(){

    }

    public function __invoke(Request $request){
        ///$data = array();

        if(App::environment() == 'production'){
            $request->validate([
                'contactInfo.name' => 'bail|required|alpha',
                'contactInfo.phone' => 'bail|required|numeric|digits:10',
                'contactInfo.email' => 'bail|required|email',
                //'contactInfo.date' => 'nullable|date',
            ]);
        }

        // set & get request data
        $data = $request->all();
        $data['errorMessage'] = "";

        // set contactInfo local variable
        $contactInfo = $data['contactInfo'];
        // set addressFrom local variable
        $addressFrom = $data['addressFrom'];
        // set addressTo local variable
        $addressTo = $data['addressTo'];
        // set extraAddresses. if not set, set as empty array
        $extraAddresses = isset($data['extraAddresses']) ? $data['extraAddresses'] : array();
        // set userObjects local variable
        $userObjects = $data['userObjects'];


        // create submission for storing in db
        $submission = Submission::create($contactInfo); 

        // sort objects based on category
        usort($userObjects, function($a, $b) {
            return $a['categoryName'] <=> $b['categoryName'];
        });
        // Log::info(print_r($userObjects, true));


        // create info csv
        $csvInfo = new CsvWriter($submission->getFolder().'/contactInfo.csv');
        $infoHeaderRow = ['Name', 'Phone', 'Εmail', 'Transport date'];
        $infoDataRow = array(
            $contactInfo["name"],
            $contactInfo["phone"],
            $contactInfo["email"],
            $contactInfo["date"],
        );  
        $csvInfo->writeRow($infoHeaderRow);
        $csvInfo->writeRow($infoDataRow);


        // create addresses csv
        $csvAddresses = new CsvWriter($submission->getFolder().'/addresses.csv');
        $addressesHeaderRow = ['Address', 'Number', 'City', 'Building type', 'Floor'];
        $csvAddresses->writeRow($addressesHeaderRow);
        $csvAddresses->writeRow($addressFrom);
        $csvAddresses->writeRow($addressTo);
        foreach ($extraAddresses as $key => $address) {
           $csvAddresses->writeRow($address);
        }


        // create objects csv
        $csvObjects = new CsvWriter($submission->getFolder().'/objects.csv');
        $objectsHeaderRow = ['Item', 'Category', 'Amount'];
        $csvObjects->writeRow($objectsHeaderRow);
        foreach ($userObjects as $key => $object) {
           $csvObjects->writeRow($object);
        }


        /***************************
            Send emails
        ***************************/
        // Mail::to($contactInfo['email'])->queue(new FormSubmitUser());
        // Mail::to(env('COMPANY_SUBMISSION_TO_EMAIL'))->queue(new FormSubmitCompany($submission->id, $contactInfo, $addressFrom, $addressTo, $extraAddresses, $userObjects));


        // set success to true
        $data['success'] = true;

        return response()->json($data);
    }

}
