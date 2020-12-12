<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Submission;

class FormSubmitCompany extends Mailable
{
    use Queueable, SerializesModels;

    public $title;
    public $subId;
    public $contactInfo;
    public $addressFrom;
    public $addressTo;
    public $extraAddresses;
    public $userObjects;
    public $submission;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subId, $contactInfo, $addressFrom, $addressTo, $extraAddresses, $userObjects)
    {
        $this->subject('New request for quote');
        $this->title = 'New request for quote';
        $this->subId = $subId;
        $this->contactInfo = $contactInfo;
        $this->addressFrom = $addressFrom;
        $this->addressTo = $addressTo;
        $this->extraAddresses = $extraAddresses;
        $this->userObjects = $userObjects;
        $this->submission = Submission::find($subId);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.formSubmitCompany')
            ->attach($this->submission->getContactInfoCsvPath(), ['mime' => 'text/csv'])
            ->attach($this->submission->getAddressesCsvPath(), ['mime' => 'text/csv'])
            ->attach($this->submission->getObjectsCsvPath(), ['mime' => 'text/csv']);
    }

}




