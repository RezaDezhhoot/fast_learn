<?php


namespace App\Repositories\Classes;

use App\Models\OrderNote;
use App\Repositories\Interfaces\OrderNoteRepositoryInterface;

class OrderNoteRepository implements OrderNoteRepositoryInterface
{
    public function create(array $data)
    {
        return OrderNote::create($data);
    }
}
