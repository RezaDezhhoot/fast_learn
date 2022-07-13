<?php

namespace App\Repositories\Interfaces;

use App\Models\Event;

interface EventRepositoryInterface
{

    public function getAllAdmin($status , $search , $per_page);

    public function destroy();

    public function find($id);

    public function findOrFail($id);

    public function save(Event $event): Event;

    public function create($data);

    public function update(Event $event,$data): bool;

    public static function observe();
}
