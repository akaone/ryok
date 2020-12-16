<?php


namespace App\Repositories\Web;


use App\Models\CarrierMessage;

class StaffMessagesRepository
{

    public function pendingMessages()
    {
        return CarrierMessage::where('state', CarrierMessage::$PENDING)->orderBy('id', 'DESC')->get();
    }


    public function treatedMessages()
    {
        return CarrierMessage::where('state', CarrierMessage::$TREATED)->orderBy('updated_at', 'ASC')->get();
    }



}
