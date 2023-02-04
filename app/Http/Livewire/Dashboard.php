<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Carbon\Carbon;
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.dashboard',[
            'all_customer' => User::where('level', 'customer')->count(),
            'customer_today' => User::where([
                ['level','customer'],
                ['created_at', '=', Carbon::today()]
            ])->count()
                   

        ]);
     
    }
}
