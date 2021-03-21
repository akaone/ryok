<?php

namespace App\Http\Livewire\StaffCarriers;

use Livewire\Component;
use App\Models\Country;
use App\Repositories\Web\StaffCarriersRepository;
use App\Exceptions\UserAccessLevelException;

class StaffCarriersCreate extends Component
{
    public $countryList;
    public $carrierName;
    public $country;
    public $mmc;
    public $mnc;
    public $startWith;

    public $clientUssdFormat;
    public $clientUssdAmountRegex;
    public $clientUssdTransfertIdRegex;

    public $merchantUssdFormat;
    public $merchantUssdAmountRegex;
    public $merchantUssdTransfertIdRegex;

    public $receivedSmsAmountRegex;
    public $receivedSmsTransfertIdRegex;

    public function createCarrier(StaffCarriersRepository $staffCarriersRep) {

        $this->validate([
            'carrierName' => 'required|string|min:3',
            'country' => ['required'],
            'mmc' => 'required|string|min:2',
            'mnc' => 'required|string|min:2',
            'startWith' => ["required", "string"],

            'clientUssdFormat' => 'required|string',
            'clientUssdAmountRegex' => 'required|string',
            'clientUssdTransfertIdRegex' => 'required|string',

            'merchantUssdFormat' => 'required|string',
            'merchantUssdAmountRegex' => 'required|string',
            'merchantUssdTransfertIdRegex' => 'required|string',

            'receivedSmsAmountRegex' => 'required|string',
            'receivedSmsTransfertIdRegex' => 'required|string',
        ]);

        $ibm = "{$this->mmc}-{$this->mnc}";
        if($staffCarriersRep->ibmAlreadyExist($ibm)) {
            $this->addError('mmc', trans('validation.staff-carriers-create.mnc-mmc-exist'));
            $this->addError('mnc', trans('validation.staff-carriers-create.mnc-mmc-exist'));
        } else {
            $formatted = str_replace(",", "|", $this->startWith);
            $phoneRegex = "^{$formatted}";

            $staffCarriersRep->createCarrier(
                $this->carrierName, $this->country, $ibm, $phoneRegex,
                $this->clientUssdFormat, $this->clientUssdAmountRegex, $this->clientUssdTransfertIdRegex,
                $this->merchantUssdFormat, $this->merchantUssdAmountRegex, $this->merchantUssdTransfertIdRegex,
                $this->receivedSmsAmountRegex, $this->receivedSmsTransfertIdRegex
            );

            session()->flash('success', trans('carriers.staff-carriers-create.carrier-created-success'));
            redirect()->route('dashboard.carriers.index');
        }
    }

    public function mount()
    {
        $this->countryList = Country::all();
    }

    public function render()
    {

        if(!auth()->user()->fresh()->hasPermissionTo('carriers-create')) {
            throw new UserAccessLevelException;
        }
        return view('staff-carriers.staff-carriers-create')
            ->extends('layouts.no-modal')
            ->section('body');
    }
}
