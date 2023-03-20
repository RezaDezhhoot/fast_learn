<?php

namespace App\Http\Controllers\FormBuilder;

class FormBuilder
{
    public function isVisible($form, $item)
    {
        foreach ($item['conditions'] as $condition) {
            foreach ($form as $formItem) {
                if ($formItem['name'] == $condition['value'] &&
                    $formItem['value'] == $condition['target'] &&
                    $condition['visibility'] == 'hide'){
                    return false;
                }
            }
        }

        return true;
    }

    public function formPrice($form)
    {
        $form = collect($form);

        return $form->reduce(function ($total, $item) {
            return $total + ($item['price'] ?? 0);
        }, 0);
    }
}