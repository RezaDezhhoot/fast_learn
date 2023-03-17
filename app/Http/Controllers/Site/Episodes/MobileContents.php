<?php

namespace App\Http\Controllers\Site\Episodes;

use App\Http\Controllers\BaseComponent;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class MobileContents extends BaseComponent
{
    public  $course_data , $chapter_data , $episode_data;

    public $chapters , $episodes = [];


    public $user;

    public $api_bucket , $episode_id , $local_video;

    public $recaptcha;

    public function mount($course , $chapter , $episode)
    {
        $this->episode_data = $episode;
        $this->course_data = $course;
        $this->chapter_data = $chapter;
        $this->user = auth()->user();
    }

    public function render()
    {
        return view('site.episodes.mobile-contents');
    }

    public function GoToEpisode($chapter,$episode)
    {
        $this->chapter_data = $this->course_data->chapters->where('id',$chapter)->first();
        $episode = $this->chapter_data->episodes->where('id',$episode)->first();
        if ((\auth()->check() && ($this->user->hasCourse($this->course_data->id))) || $episode->free) {
            return redirect()->route('episode',[
                $this->course_data->slug , $this->chapter_data->slug , $episode , $episode->title
            ]);
        }
    }

    public function loadEpisode($episode)
    {
        $this->set_content('local_video',$episode);
        $this->set_content('show_local_video',$episode);
    }

    public function set_content($type,$id)
    {
        $this->reset(['api_bucket']);

        $episode = $this->chapter_data->episodes->where('id',$id)->first();
        $this->episode_id = $episode->id;
        $user_has_episode = (\auth()->check() && ($this->user->hasCourse($this->course_data->id))) || $episode->free;

        try {
            switch ($type){
                case 'local_video':
                    if ( ( $this->course_data->price == 0 || $user_has_episode ) and $episode->downloadable_local_video ) {
                        if ($disk = getDisk($episode->video_storage))
                            return $disk->download($episode->local_video);
                    }
                    break;
                case 'show_local_video':
                    if (!is_null($episode->local_video) and $episode->allow_show_local_video and ($this->course_data->price == 0 || $user_has_episode)):
                        $this->local_video = route('storage',[$episode->id,'video']);
                        $this->emit('setVideo',['title' => '1','src' => $this->local_video]);
                    endif;
                    break;
                case 'file':
                    if ($disk = getDisk($episode->file_storage))
                        if ($disk->exists($episode->file) and (( $this->course_data->price == 0) || $user_has_episode))
                            return $disk->download($episode->file);
                    break;
                case 'link':
                    if (!is_null($episode->link) and ((  $this->course_data->price == 0) || $user_has_episode))
                        return redirect()->away($episode->link);
                    break;
            }
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}