<?php

namespace App\Livewire;

use FilippoToso\PdfWatermarker\Facades\TextWatermarker;
use Livewire\Component;
use setasign\Fpdi\Fpdi;

class ShowFile extends Component
{
    public $file_path;
    public $template_detail;
    public $cWidth = 500;

    public function set_cHeight($cHeight) {
        $this->template_detail['cHeight'] = $cHeight;
        $this->dispatch('template_detail', $this->template_detail);
    }

    public function mount()
    {
        $this->file_path = 'storage/resume-boat.pdf';

        $pdf = new Fpdi();
        $pdf->AddPage();
        $pdf->setSourceFile($this->file_path );
        $tplIdx = $pdf->importPage(1);
        $template_size = $pdf->getTemplateSize($tplIdx);

        $tWidth = $template_size['width'];
        $tHeight = $template_size['height'];

        $this->template_detail = [
            'tWidth' => $tWidth,
            'tHeight' => $tHeight,
            'cWidth' => $this->cWidth,
        ];

        $this->dispatch('template_detail', $this->template_detail);
    }
    public function render()
    {
        return view('livewire.show-file');
    }
}
