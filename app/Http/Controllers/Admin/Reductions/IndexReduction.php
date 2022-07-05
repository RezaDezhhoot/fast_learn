<?php

namespace App\Http\Controllers\Admin\Reductions;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\ReductionRepositoryInterface;

class IndexReduction extends BaseComponent
{
    public ?string $placeholder = 'کد';

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->reductionRepository = app(ReductionRepositoryInterface::class);
    }

    public function render()
    {
        $this->authorizing('show_reductions');
        $reductions = $this->reductionRepository->getAllAdmin($this->search , $this->per_page);
        return view('admin.reductions.index-reduction',['reductions'=> $reductions])
            ->extends('admin.layouts.admin');
    }

    public function delete($id)
    {
        $this->authorizing('delete_reductions');
        $this->reductionRepository->destroy($id);
        $this->emitNotify('کد تخفیف با موفقیت حذف شد');
    }
}
