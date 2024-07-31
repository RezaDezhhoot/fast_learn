<div wire:init="initVideo">
    <div class="dashboard-menu-toggler btn theme-btn theme-btn-sm lh-28 theme-btn-transparent mb-4 ml-3"><i
            class="la la-bars mr-1"></i> منو
    </div>
    <div class="container-fluid">
        <div class="dashboard-heading mb-5">
            <h3 class="fs-22 font-weight-semi-bold"> معرفی </h3>
        </div>
        <div class="dashboard-cards mb-5">
            <div class="container-fluid" wire:ignore>

            </div>
        </div>
    </div>
    <div class="modal fade modal-container" id="shareModal" tabindex="-1" role="dialog" aria-labelledby="shareModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="    width: 100% !important;max-width: 100%;" role="document">
            <div class="modal-content">
                <div class="modal-header border-bottom-gray">
                    <h5 class="modal-title fs-19 font-weight-semi-bold" id="shareModalTitle">ویدئو معرفی
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="نزدیک">
                        <span aria-hidden="true" class="la la-times"></span>
                    </button>
                </div>
                <!-- end modal-header -->
                <div class="modal-body">
                    <div class="plyr wire:ignore plyr--video plyr--html5 plyr--fullscreen-enabled">
                        <video id="introVideo" class="player"  controls >
                        </video>
                    </div>
                    <!-- end copy-to-clipboard -->
                </div>
            </div>
            <!-- end modal-content-->
        </div>
        <!-- end modal-dialog -->
    </div>

</div>
@push('scripts')
    <script>
        Livewire.on('setVideo', data => {
            $('#shareModal').modal('show');
            const player = new Plyr('#introVideo','');

            window.player = player;
            player.source = {
                type: 'video',
                title: 'ویدئو معرفی',
                download: true,
                sources: [
                    {
                        src: data.src,
                        type: 'video/mp4',
                        size: 720,
                    }
                ]
            }
            player.on('ended', (event) => {
                @this.call('seenVideo')
            });
        })
    </script>
@endpush
