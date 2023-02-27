<?php

namespace App\Observers;

use App\Models\Comment;

class CommentObserver
{
    /**
     * Handle the Comment "created" event.
     *
     * @param  \App\Models\Comment  $comment
     * @return void
     */
    public function created(Comment $comment)
    {
        $comment->update([
           'commentable_data' => [
               'id' => $comment->commentable->id,
               'title' => $comment->commentable->title,
           ]
        ]);
    }
}
