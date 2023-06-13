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
                if (
                    !auth()->user()->hasCourse($episode->chapter->course->id) &&
                    !auth()->user()->hasRole('admin') &&
                    !auth()->user()->hasRole('super_admin') &&
                    !in_array($episode->chapter->course->id,\auth()->user()->teacher->courses->pluck('id')->toArray() )
                ) {
                    abort(404);
                }
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
        ini_set('memory_limit', '-1');
        if (!$filesystem->exists($path))
            abort(404);

        $file = $filesystem->get($path);

        $type = $filesystem->mimeType($path);
        $response = Response::make($file);
        $response->header("Content-Type", $type);
        $response->header("Content-Description", 'File Transfer');
        $response->header("Content-Transfer-Encoding", 'binary');
        $response->header("Expires", 0);
        $response->header("Cache-Control", 'must-revalidate, post-check=0, pre-check=0');
        $response->header("Pragma", 'public');
        $response->header("Content-Length", $filesystem->size($path));

        return $response;
    }
}
