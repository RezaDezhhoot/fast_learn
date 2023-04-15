<?php

namespace App\Http\Controllers\Admin\Groups;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\GroupRepositoryInterface;
use App\Repositories\Interfaces\OrderDetailRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class StoreGroup extends BaseComponent
{
    use WithPagination;

    public $group , $title , $course , $description , $header , $users = [] ,  $placeholder = 'دانش اموز';

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->groupRepository = app(GroupRepositoryInterface::class);
        $this->courseRepository = app(CourseRepositoryInterface::class);
        $this->orderDetailRepository = app(OrderDetailRepositoryInterface::class);
    }

    public function mount($action , $id = null)
    {
        $this->set_mode($action);
        $this->authorizing('show_groups');
        if ($this->mode == self::UPDATE_MODE) {
            $this->group = $this->groupRepository->findOrFail($id);
            $this->title = $this->group->title;
            $this->description = $this->group->description;
            $this->course = $this->group->course_id;
            $this->header = $this->title;
            $this->users = $this->group->users->pluck('id');
        } elseif ($this->mode == self::CREATE_MODE) {
            $this->header = 'گروه جدید';
        } else abort(404);

        $this->data['course'] = $this->courseRepository->getAll()->pluck('title','id');
    }

    public function store()
    {
        $this->authorizing('edit_groups');
        if ($this->mode == self::UPDATE_MODE) {
            $this->saveInDataBase($this->group);
        } else {
            $this->saveInDataBase($this->groupRepository::getNewModel());
            $this->reset(['title','course','description','course']);
        }
    }

    private function saveInDataBase($model)
    {
        $this->users = array_filter($this->users);
        $this->validate([
            'title' => ['required','string','max:250'],
            'course' => ['required','exists:courses,id'],
            'description' => ['nullable','string','max:1000'],
            'users' => ['nullable','array'],
            'users.*' => ['exists:users,id'],
        ],[],[
            'title' => 'عنوان',
            'course' => 'دوره آموزشی',
            'description' => 'توضیحات',
            'users' => 'کاربران'
        ]);
        $model->title = $this->title;
        $model->course_id = $this->course;
        $model->description = $this->description;
        try {
            DB::beginTransaction();
            $model = $this->groupRepository->save($model);
            if ($this->mode == self::UPDATE_MODE) {
                $this->groupRepository->syncUser($model , $this->users);
            } else {
                $this->groupRepository->attachUser($model , $this->users);
            }
            DB::commit();
            $this->emitNotify('اطلاعات با موفقیت ذخیره شد');
        } catch (\Exception $e) {
            DB::rollBack();
            report($e);
            $this->emitNotify('مشکل در ذعیره اطلاعات','warning');
        }
    }

    public function deleteItem()
    {
        $this->authorizing('delete_groups');
        $this->groupRepository->destroy($this->group->id);
        return redirect()->route('admin.group');
    }

    public function render()
    {
        $details = [];
        if (isset($this->course)) {
            $details = $this->orderDetailRepository->getAllByCourse($this->course,$this->search,$this->per_page);
        }
        return view('admin.groups.store-group',get_defined_vars())->extends('admin.layouts.admin');
    }
}
