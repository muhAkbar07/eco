<?php

namespace App\Livewire;

use Stripe\Stripe;
use Stripe\Checkout\Session;
use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\Attributes\Title;

#[Title('Success - Ecommerce')]
class SuccessPage extends Component {

    #[Url]
    public $session_id;
    
    public function render() {
        
        $latest_order = Order::with('address')->where('user_id', auth()->user()->id)->latest()->first();
        
        if ($this->session_id) {
            // Set Stripe API key
            Stripe::setApiKey(env('STRIPE_SECRET'));
            
            $session_info = Session::retrieve($this->session_id);

            if ($session_info->payment_status == 'paid') {
                $latest_order->payment_status = 'paid';  // Mengubah status menjadi 'paid' jika pembayaran berhasil
                $latest_order->save();
            } else {
                $latest_order->payment_status = 'failed';  // Mengubah status menjadi 'failed' jika pembayaran gagal
                $latest_order->save();
                return redirect()->route('cancel');
            }
        }
        
        return view('livewire.success-page', [
            'order' => $latest_order,
        ]);
    }
}