<div>
    <div class="dashboard-menu-toggler btn theme-btn theme-btn-sm lh-28 theme-btn-transparent mb-4 ml-3"><i class="la la-bars mr-1"></i> منو</div>
    <div class="container-fluid">
        <div class="dashboard-heading mb-5">
            <h3 class="fs-22 font-weight-semi-bold">درخواست ثبت آموزشگاه</h3>
        </div>
        <div style="overflow-x:auto;" class="dashboard-cards mb-5">
            <livewire:site.forms.form :id="$model_id" loadHead="1" form_key="organ_request" />
        </div>
    </div>
</div>
