<?php


namespace App\Repositories\Interfaces;


use App\Models\Sample;

interface SampleRepositoryInterface
{
    public function findOrFail($id);

    public function destroy($id);

    public function getAllAdmin($search, $status, $course, $pagination);

    public function getNewObject();

    public function save(Sample $sample);

    public function getMySamples();

    public function download($id);

    public function getAllSite($search , $category , $perPage = 10);

    public function findBySlug($slug);

    public function getRelatedSamples(Sample $sample , $take = 3);

    public function getAllTeacher($search, $status, $course, $pagination);

    public function findOrFailTeacher($id);
}
