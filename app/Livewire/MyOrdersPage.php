<?php

namespace App\Livewire;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('My Orders - Ecommerce')]
class MyOrdersPage extends Component {
    public function render() {
        $my_orders = Order::where('user_id', auth()->id())->latest()->paginate(5);
        return view('livewire.my-orders-page', [
            'orders' => $my_orders,
        ]);
    }
}