<?php

namespace App\Repositories\Web;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Webpatser\Uuid\Uuid;
use Carbon\Carbon;
use App\Models\Carrier;
use App\Models\CarrierUssd;

class StaffCarriersRepository
{
    /**
     *  Get all available carriers on the platform
     */
    public function carriersList()
    {
        return Carrier::all();
    }


    /**
     * Add new carrier
     */
    public function createCarrier(
        $carrierName, $country, $ibm, $phoneRegex,
        $clientUssdFormat, $clientUssdAmountRegex, $clientUssdTransfertIdRegex,
        $merchantUssdFormat, $merchantUssdAmountRegex, $merchantUssdTransfertIdRegex,
        $receivedSmsAmountRegex, $receivedSmsTransfertIdRegex) {

        $carrier = Carrier::create([
            'name' => $carrierName,
            'ibm' => $ibm,
            'country' => $country,
            'phone_regex' => $phoneRegex,
            'state' => 'ACTIVATED'
        ]);

        $carrierUssd = CarrierUssd::create([
            'carrier_id' => $carrier->id,

            'client_ussd_format' => $clientUssdFormat,
            'client_ussd_amount_regex' => $clientUssdAmountRegex,
            'client_ussd_reference_regex' => $clientUssdTransfertIdRegex,

            'merchant_ussd_format' => $merchantUssdFormat,
            'merchant_ussd_amount_regex' => $merchantUssdAmountRegex,
            'merchant_ussd_reference_regex' => $merchantUssdTransfertIdRegex,

            'received_transfert_sms_amount_regex' => $receivedSmsAmountRegex,
            'received_transfert_sms_reference_regex' => $receivedSmsTransfertIdRegex,
        ]);

    }


    /**
     * Check if mmc-mnc alerady exist
     */
    public function ibmAlreadyExist($ibm)
    {
        return Carrier::whereIbm($ibm)->exists();
    }

    /**
     * Get available carriers list
     */
    public function activeCarriersList()
    {
        return Carrier::whereState("ACTIVATED")
            ->select(['id', 'ibm', 'name', 'country'])
            ->get()
        ;
    }



}
