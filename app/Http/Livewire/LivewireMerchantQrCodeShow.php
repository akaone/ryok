<?php

namespace App\Http\Livewire;

use App\Repositories\Web\PaymentRequestRepository;
use Livewire\Component;

class LivewireMerchantQrCodeShow extends Component
{
    public $myId;
    public $link = "default";
    public $appImage = "https://via.placeholder.com/150/e2e8f0/000000&text=app+logo";


    public function render()
    {
        $repository = new PaymentRequestRepository();
        $operation = $repository->fetchOperationInfoForQrcode($this->myId);

        if($operation == null) {
            return view('merchant-qr-code.merchant-qr-code-no-operation', [
                'operation' => $operation,
            ]);
        }

        return view('livewire.livewire-merchant-qr-code-show', [
            'operation' => $operation,
        ]);
    }
}
