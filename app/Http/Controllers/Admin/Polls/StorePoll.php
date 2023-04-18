<?php

namespace App\Http\Controllers\Admin\Polls;

use App\Http\Controllers\BaseComponent;
use App\Models\Poll;
use App\Models\PollItem;
use App\Models\PollItemChoice;
use Illuminate\Support\Facades\DB;

class StorePoll extends BaseComponent
{
    public $header , $title , $poll , $items = [];

    public function mount($action , $id = null)
    {
        $this->authorizing('edit_forms');
        self::set_mode($action);

        if ($this->mode == self::UPDATE_MODE) {
            $this->poll = Poll::query()->with(['items','items.items'])->findOrFail($id);
            $this->title = $this->poll->title;
            $this->header = $this->title;
            $this->items = $this->poll->items->toArray();
        } elseif ($this->mode == self::CREATE_MODE) {
            $this->header = 'فرم جدید';
        } else abort(404);
    }

    public function store()
    {
        if ($this->mode == self::UPDATE_MODE) {
            $this->saveInDataBase($this->poll);
        } else {
            $this->saveInDataBase(new Poll());
            $this->reset(['title']);
        }
    }

    private function saveInDataBase(Poll $poll)
    {
        $this->validate([
            'title' => ['required','string','max:250'],
            'items' => ['array','min:1'],
            'items.*.title' => ['required','string','max:250'],
            'items.*.items' => ['required','array','min:2'],
            'items.*.items.*.title' => ['required','string','max:250'],
        ],[],[
            'title' => 'عنوان',
            'items' => 'سوالات',
            'items.*.title' => 'متن سوال',
            'items.*.items' => 'گزینه ها',
            'items.*.items.*.title' => 'عنوان گزینه',
        ]);

        try {
            DB::beginTransaction();
            $poll->title = $this->title;
            $poll->save();

            foreach ($this->items as $item) {
                $item_model = null;
                if ($item['id'] == -1) {
                    $item_model = PollItem::query()->create([
                        'title' => $item['title'],
                        'poll_id' => $poll->id
                    ]);
                } else {
                    PollItem::query()->where('id',$item['id'])->update([
                        'title' => $item['title'],
                    ]);
                    $item_model = $item;
                }

                foreach ($item['items'] as $choice) {
                    if ($choice['id'] == -1) {
                        $choice = PollItemChoice::query()->create([
                            'title' => $choice['title'],
                            'poll_item_id' => $item_model['id']
                        ]);
                    } else {
                        PollItemChoice::query()->where('id',$choice['id'])->update([
                            'title' => $choice['title'],
                        ]);
                    }
                }

            }
            DB::commit();
            $this->emitNotify('اطلاعات با موفقیت ذخیره شد');
        } catch (\Exception $e) {
            DB::rollBack();
            report($e);
            $this->emitNotify('خظا در ذخیره سازی اطلاعات','warning');
//            $this->emitNotify($e->getMessage(),'warning');
        }



    }

    public function deleteItem()
    {
        Poll::destroy($this->poll->id);
        return redirect()->route('admin.poll');
    }

    public function addItem()
    {
        $this->items[] = [
            'id' => -1,
            'items' => []
        ];
    }

    public function addChoice($item)
    {
        $this->items[$item]['items'][] = [
            'id' => -1
        ];
    }

    public function deleteItems($key)
    {
        if ($this->items[$key]['id'] != -1) {
            PollItem::destroy($this->items[$key]['id']);
        }
        unset($this->items[$key]);
    }

    public function deleteChoice($item , $key)
    {
        if ($this->items[$item]['items'][$key]['id'] != -1) {
            PollItemChoice::destroy($this->items[$item]['items'][$key]['id']);
        }
        unset($this->items[$item]['items'][$key]);
    }

    public function render()
    {
        return view('admin.polls.store-poll')->extends('admin.layouts.admin');
    }
}
