<?php

namespace App\Exports;

use App\Candidate;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;

class CandidateExport implements FromView
{

    public function __construct($view, $data = "")
    {
        $this->view = $view;
        $this->data = $data;
    }
    /**
     * @inheritDoc
     */
    public function view(): View
    {
        return view($this->view, $this->data);
    }
}
