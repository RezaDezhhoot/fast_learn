<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\EpisodeRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Contracts\Filesystem\Filesystem;

class StorageController extends Controller
{
    private EpisodeRepositoryInterface $episodeRepository;

    public function __construct(EpisodeRepositoryInterface $episodeRepository)
    {
        $this->episodeRepository = $episodeRepository;
    }

    public function __invoke($episode,$type)
    {
        $episode = $this->episodeRepository->findOrFail($episode);
        if (!$episode->free && !$episode->chapter->course->price == 0) {
            if (\auth()->check()) {
                if ( !auth()->user()->hasCourse($episode->chapter->course->id) && !Auth::user()->hasPermissionTo('edit_courses'))
                    abort(404);
            } else {
                abort(404);
            }
        }


        return match ($type) {
            'video' => $this->getFile($episode->local_video , getDisk($episode->video_storage) ),
            'file' => $this->getFile($episode->file , getDisk($episode->file_storage) ) ,
            default => abort(404)
        };
    }

    private function getFile($path , Filesystem $filesystem)
    {
        set_time_limit(0);
        $fs = $filesystem->getDriver();

        $metaData = $filesystem->mimeType($path);
        $stream = $fs->readStream($path);


        if (ob_get_level()) ob_end_clean();

        return response()->stream(
            function() use($stream) {
                while(ob_get_level() > 0) ob_end_flush();
                fpassthru($stream);
            },
            200,
            [
                'Content-Type' => $metaData,
                'Content-disposition' => 'attachment; filename="' . basename($path) . '"',
            ]);
    }
}
