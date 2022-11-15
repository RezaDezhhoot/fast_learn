<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class LastActivitiesEnum extends Enum
{
   const COURSES = [
       'icon' => 'fab fa-product-hunt',
       'update_title' => 'بروزرسانی دوره ',
       'new_title' => 'تعریف دوره جدید '
   ];

   const EPISODES = [
       'icon' => 'flaticon2-open-text-book',
       'update_title' => 'بروزرسانی درس ',
       'new_title' => 'تعریف درس جدید '
   ];

   const SAMPLES = [
       'icon' => 'fa fa-question',
       'update_title' => 'بروزرسانی نمونه سوال ',
       'new_title' => 'تعریف نمونه سوال '
   ];

   const COMMENTS = [
       'icon' => 'fa fa-comment-alt',
       'update_title' => '',
       'new_title' =>  'پاسخ جدید به کامنت کاربر'
   ];

   const BILLS = [
       'icon' => 'fab fa-cc-amazon-pay',
       'update_title' => '',
       'new_title' => 'درخواست تسویه حساب '
   ];

   const BANk_ACCOUNTS = [
       'icon' => 'fa fa-piggy-bank',
       'update_title' => '',
       'new_title' => 'تعریف حساب بانکی جدید '
   ];

   public static function appendTitle($activity,$event,$value): string
   {
       return $activity[$event.'_title'].' '.$value;
   }
}
