<?php

namespace App\Http\Controllers\Organ\Settings;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\OrganRepositoryInterface;
use Livewire\WithPagination;

class Organs extends BaseComponent
{
    use WithPagination;

    public $placeholder = 'عنوان';

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->organRepository = app(OrganRepositoryInterface::class);
    }

    public function render()
    {
        $items = $this->organRepository->getMyOrgans($this->search,$this->per_page);
        return view('organ.settings.organs',get_defined_vars())->extends('organ.layouts.organ');
    }
}
