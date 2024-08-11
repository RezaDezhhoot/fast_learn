<?php

namespace App\Http\Controllers\Admin\Bot;

use App\Http\Controllers\BaseComponent;
use App\Models\BotPlan;

class StorePlan extends BaseComponent
{
    public $header , $plan , $title , $description , $amount , $profit , $image;

    public function mount($action , $id = null)
    {
        $this->set_mode($action);

        if ($this->mode == self::UPDATE_MODE) {
            $this->plan = BotPlan::query()->findOrFail($id);
            $this->header = $this->plan->title;
            $this->title = $this->plan->title;
            $this->description = $this->plan->description;
            $this->amount = $this->plan->amount;
            $this->profit = $this->plan->profit;
            $this->image = $this->plan->image;
        } else {
            $this->header= 'پلن جدید';
        }
    }

    public function store()
    {
        if ($this->mode == self::UPDATE_MODE)
            $this->saveInDB($this->plan);
        elseif ($this->mode == self::CREATE_MODE) {
            $this->saveInDB(new BotPlan());
            redirect()->route('admin.bot-plan');
        }
    }
    private function saveInDB(BotPlan $plan)
    {
        $this->validate([
            'title' => ['required','string','max:150'],
            'description' => ['nullable','string','max:1500'],
            'image' => ['nullable','string','max:1500'],
            'amount' => ['required','integer','between:0,100000000000'],
            'profit' => ['required','integer','between:1,100000000000'],
        ] , [] , [
            'title' => 'عنوان',
            'description' => 'توضیحات',
            'image' => 'تصویر',
            'amount' => 'مبلغ',
            'profit' => 'درامد'
        ]);
        $data = [
            'title' => $this->title,
            'description' => $this->description,
            'image' => $this->image,
            'amount' => $this->amount,
            'profit' => $this->profit
        ];
        $plan->fill($data)->save();
        $this->emitNotify('اطلاعات با موفقیت ثبت شد');
    }

    public function render()
    {
        return view('admin.bot.store-plan')->extends('admin.layouts.admin');
    }
}
