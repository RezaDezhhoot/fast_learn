<?php


namespace App\Repositories\Interfaces;


use App\Models\Certificate;

interface CertificateRepositoryInterface
{
    public function getAllAdmin($search , $per_page);

    public function find($id);

    public function getDemo(Certificate $certificate);

    public function delete(Certificate $certificate);

    public function destroy($id);

    public function save(Certificate $certificate);

    public function newCertificateObject();

    public function getAll();

    public function count();
}
