<?php
namespace App\Mixins;

use Illuminate\Support\Collection;

class ResponseMixin {
    //?includes=posts.comment

    // relation yo'q bo'sa olinishi kerak
    // relation uchun transformer
    
    // nestes relation uchun ishloshi kerak user.post.comment.likedUsers.posts
	public function get() {
        return function($status, $data, $message = 'Default succes message') {
            
            return [
                'success' => $status,
                'data' => $data,
                'message' => $message
            ];
        };
	}

    
}