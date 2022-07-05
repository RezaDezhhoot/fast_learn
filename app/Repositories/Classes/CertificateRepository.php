<?php


namespace App\Repositories\Classes;


use App\Models\Certificate;
use App\Repositories\Interfaces\CertificateRepositoryInterface;

class CertificateRepository implements CertificateRepositoryInterface
{
    public function getAllAdmin($search, $per_page)
    {
        return Certificate::latest('id')->search($search)->paginate($per_page);
    }

    public function getDemo(Certificate $certificate)
    {
        return $certificate->users()->where('transcript_id',0)->first();
    }

    public function find($id)
    {
        return Certificate::findOrFail($id);
    }

    public function delete(Certificate $certificate)
    {
        return $certificate->delete();
    }

    public function save(Certificate $certificate)
    {
        $certificate->save();
        return $certificate;
    }

    public function destroy($id)
    {
        return Certificate::destroy($id);
    }

    public function newCertificateObject()
    {
        return new Certificate();
    }

    public function getAll()
    {
        return Certificate::all();
    }

    public function count()
    {
        return Certificate::count();
    }
}
