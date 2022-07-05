<?php

namespace App\Http\Controllers\Admin\Certificates;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CertificateRepositoryInterface;
use Livewire\WithPagination;

class IndexCertificate extends BaseComponent
{
    use WithPagination;
    public string $placeholder = 'عنوان';

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->certificateRepository = app(CertificateRepositoryInterface::class);
    }

    public function render()
    {
        $this->authorizing('show_certificates');
        $certificates = $this->certificateRepository->getAllAdmin($this->search,$this->per_page);
        return view('admin.certificates.index-certificate',['certificates' => $certificates])->extends('admin.layouts.admin');
    }

    public function delete($id)
    {
        $this->authorizing('delete_certificates');
        $this->certificateRepository->destroy($id);
    }
}
