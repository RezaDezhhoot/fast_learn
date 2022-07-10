<?php


namespace App\Repositories\Interfaces;


use App\Models\Transcript;
use App\Models\User;

interface TranscriptRepositoryInterface
{
    public function getAllAdmin($search , $result , $per_page);

    public function find($id , User $user = null);

    public function destroy($id);

    public function save(Transcript $transcript);

    public function create(array $data);

    public function get(array $where);

    public function attachAnswer(Transcript $transcript,$question_id ,  $data);

    public function deleteAnswer(Transcript $transcript,$question_id = []);

    public function count();
}
