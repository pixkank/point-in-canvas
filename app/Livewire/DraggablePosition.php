<?php

namespace App\Livewire;

use Livewire\Component;

class DraggablePosition extends Component
{
    public $positionX,$positionY;

    public function set_position($x,$y){
        $this->positionX = $x;
        $this->positionY = $y;
    }

    public function render()
    {
        return view('livewire.draggable-position');
    }
}
