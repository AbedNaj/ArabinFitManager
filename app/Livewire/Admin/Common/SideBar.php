<?php

namespace App\Livewire\Admin\Common;

use App\Models\Tenants\Gym;
use Livewire\Component;

class SideBar extends Component
{

    public  $owner_name, $name;

    public function mount()
    {
        $info = Gym::select('name', 'owner_name')->first();
        $this->owner_name = $info->owner_name;
        $this->name = $info->name;
    }
    public function render()
    {
        return view('livewire.admin.common.side-bar');
    }
}
