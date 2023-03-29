<div class="row pb-3">
    <div class="form-group col-md-12 p-0 col-12">
        <div class="d-flex justify-content-between col-12">
            <div style="width: 50%;">
                <label for="search">جستجو :</label>
                <input id="search" type="text" class="form-control ml-1" placeholder="{{$placeholder}}" wire:model="search">
            </div>
            <div class="form-inline">
                <label for="per-page">تعداد :</label>
                <select id="per-page" class="form-control pr-3 ml-1" wire:model="per_page">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
        </div>
    </div>


</div>
