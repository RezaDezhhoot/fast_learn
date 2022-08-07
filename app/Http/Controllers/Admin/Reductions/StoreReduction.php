<?php

namespace App\Http\Controllers\Admin\Reductions;

use App\Enums\ReductionEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\ReductionRepositoryInterface;
use App\Repositories\Interfaces\ReductionMetaRepositoryInterface;

class StoreReduction extends BaseComponent
{
    public $header;
    public $code, $description, $type, $amount, $starts_at, $expires_at , $reduction;
    public $minimum_amount, $maximum_amount, $product_ids, $exclude_product_ids, $exclude_sale_items,
        $category_ids, $exclude_category_ids, $usage_limit, $usage_limit_per_user,$value_limit,
        $organization_ids, $exclude_organization_ids;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->reductionRepository = app(ReductionRepositoryInterface::class);
        $this->reductionMetaRepository = app(ReductionMetaRepositoryInterface::class);
    }

    public function mount($action , $id = null)
    {
        $this->authorizing('show_reductions');
        $this->set_mode($action);
        if ($this->mode == self::UPDATE_MODE){
            $this->reduction = $this->reductionRepository->find($id);
            $this->header = $this->reduction->code;
            $meta = $this->reduction->metas;

            $this->code = $this->reduction->code;
            $this->description = $this->reduction->description;
            $this->type = $this->reduction->type;
            $this->amount = $this->reduction->amount;
            $this->starts_at =  $this->dateConverter($this->reduction->starts_at);
            $this->expires_at = $this->dateConverter($this->reduction->expires_at);
            $this->minimum_amount = $meta->where('name', 'minimum_amount')->first()->value ?? '';
            $this->maximum_amount = $meta->where('name', 'maximum_amount')->first()->value ?? '';
            $this->product_ids = $meta->where('name', 'product_ids')->first()->value ?? '';
            $this->exclude_product_ids = $meta->where('name', 'exclude_product_ids')->first()->value ?? '';
            $this->exclude_sale_items = $meta->where('name', 'exclude_sale_items')->first()->value ?? '';
            $this->category_ids = $meta->where('name', 'category_ids')->first()->value ?? '';
            $this->exclude_category_ids = $meta->where('name', 'exclude_category_ids')->first()->value ?? '';
            $this->usage_limit = $meta->where('name', 'usage_limit')->first()->value ?? '';
            $this->usage_limit_per_user = $meta->where('name', 'usage_limit_per_user')->first()->value ?? '';
            $this->value_limit =  $meta->where('name', 'value_limit')->first()->value ?? '';
            $this->organization_ids =  $meta->where('name', 'organization_ids')->first()->value ?? '';
            $this->exclude_organization_ids =  $meta->where('name', 'exclude_organization_ids')->first()->value ?? '';
        } elseif ($this->mode == self::CREATE_MODE)
            $this->header = 'کد جدید';
        else abort(404);

        $this->data['type'] = ReductionEnum::getType();
    }

    public function store()
    {
        $this->authorizing('edit_reductions');
        if ($this->mode == self::UPDATE_MODE) {
            $this->saveInDatabase( $this->reduction);
            $this->starts_at = $this->dateConverter($this->starts_at) ;
            $this->expires_at = $this->dateConverter($this->expires_at) ;
        }
        elseif ($this->mode == self::CREATE_MODE) {
            $this->saveInDatabase($this->reductionRepository->newReductionObject());
            $this->reset(['code','description','type','amount','starts_at','expires_at','minimum_amount','maximum_amount'
                ,'product_ids','exclude_product_ids','exclude_sale_items','category_ids','exclude_category_ids','usage_limit','usage_limit_per_user'
                ,'value_limit','organization_ids','exclude_organization_ids']);
        }
    }

    public function saveInDatabase($voucher)
    {
        $this->starts_at = $this->emptyToNull($this->starts_at);
        $this->expires_at = $this->emptyToNull($this->expires_at);

        $this->starts_at = $this->dateConverter($this->starts_at,'m') ;
        $this->expires_at = $this->dateConverter($this->expires_at,'m') ;

        $this->validate(
            [
                'code' => ['required', 'string', 'max:250', 'unique:reductions,code,' . ($this->reduction->id ?? 0)],
                'description' => ['nullable', 'string', 'max:250'],
                'type' => ['required', 'string', 'max:250','in:'.implode(',',array_keys(ReductionEnum::getType()))],
                'amount' => ['required', 'integer', 'min:0'],
                'starts_at' => ['nullable', 'date'],
                'expires_at' => ['nullable', 'date'],
                'minimum_amount' => ['nullable', 'integer', 'min:0'],
                'maximum_amount' => ['nullable', 'integer', 'min:0'],
                'product_ids' => ['nullable', 'string', 'max:250'],
                'exclude_product_ids' => ['nullable', 'string', 'max:250'],
                'exclude_sale_items' => ['nullable', 'boolean'],
                'category_ids' => ['nullable', 'string', 'max:250'],
                'exclude_category_ids' => ['nullable', 'string', 'max:250'],
                
                'organization_ids' => ['nullable', 'string', 'max:250'],
                'exclude_organization_ids' => ['nullable', 'string', 'max:250'],

                'usage_limit' => ['nullable', 'integer', 'min:0'],
                'usage_limit_per_user' => ['nullable', 'integer', 'min:0'],
                'value_limit' => ['nullable', 'integer', 'min:0'],
            ],
            [],
            [
                'code' => 'کد',
                'description' => 'توضیحات',
                'type' => 'نوع',
                'amount' => 'مقدار',
                'starts_at' => 'تاریخ شروع',
                'expires_at' => 'تاریخ انقضاء',
                'minimum_amount' => 'حداقل میزان خرید',
                'maximum_amount' => 'حداکثر میزان خرید',
                'product_ids' => 'محصولات مجاز',
                'exclude_product_ids' => 'محصولات غیرمجاز',
                'exclude_sale_items' => 'محصولات دارای تخفیف',
                'category_ids' => 'دسته بندی های مجاز',
                'exclude_category_ids' => 'دسته بندی های غیرمجاز',
                'usage_limit' => 'حداکثر استفاده',
                'usage_limit_per_user' => 'حداکثر استفاده برای کاربر',
                'value_limit' => 'حداکثر مقدار تخفیف ',

                'organization_ids' => 'سازمان های مجاز',
                'exclude_organization_ids' => 'سازمان های غیر مجاز',
            ]
        );

        $voucher->code = $this->code;
        $voucher->description = $this->description;
        $voucher->type = $this->type;
        $voucher->amount = $this->amount;
        $voucher->starts_at = $this->starts_at;
        $voucher->expires_at = $this->expires_at;
        $voucher = $this->reductionRepository->save($voucher);

        $meta = [
            'minimum_amount' => $this->minimum_amount,
            'maximum_amount' => $this->maximum_amount,
            'product_ids' => $this->product_ids,
            'exclude_product_ids' => $this->exclude_product_ids,
            'exclude_sale_items' => $this->exclude_sale_items,
            'category_ids' => $this->category_ids,
            'exclude_category_ids' => $this->exclude_category_ids,
            'usage_limit' => $this->usage_limit,
            'usage_limit_per_user' => $this->usage_limit_per_user,
            'value_limit' => $this->value_limit,
            'organization_ids' => $this->organization_ids,
            'exclude_organization_ids' => $this->exclude_organization_ids
        ];

        foreach ($meta as $key => $item) {
            if (is_null($item) || $item == '') {
                $this->reductionMetaRepository->delete([
                    ['reduction_id', $voucher->id],
                    ['name', $key],
                ]);
            } else {
                $this->reductionMetaRepository->updateOrCreate(
                    ['reduction_id' => $voucher->id, 'name' => $key],
                    ['value' => $item]
                );
            }
        }

        $this->emitNotify('اطلاعات با موفقیت ثبت شد');
    }

    public function deleteItem($id)
    {
        $this->authorizing('delete_reductions');
        $this->reductionRepository->destroy($this->reduction->id);
        return redirect()->route('admin.reduction');
    }


    public function render()
    {
        return view('admin.reductions.store-reduction')
            ->extends('admin.layouts.admin');
    }

}
