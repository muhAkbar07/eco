<?php

namespace App\Livewire;

use App\Models\Brand;
use Livewire\Component;
use App\Models\Category;
use Livewire\Attributes\Title;

#[Title('Home Page - Ecommerce')]
class HomePage extends Component{
    public function render()
    {
        $brands =Brand::where('is_active', 1)->get();
        $categories = Category::where('is_active', 1)->get();
        // dd($brands);
        return view('livewire.home-page', [
            'brands' => $brands,
            'categories' => $categories
        ]);
        
    }
}