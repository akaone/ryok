<?php


namespace App\Repositories\Server;


use App\Models\CarrierMessage;

class CarriersSmsRepository
{
    public function storeNewSms($sender, $body, $carrierId)
    {
        return CarrierMessage::create([
            'body' => $body,
            'sender' => $sender,
            'carrier_id' => $carrierId
        ]);
    }
}
