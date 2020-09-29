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
            $response = null;
            if (!($data instanceof Collection)) {               
                $response = $data->transformer();
            }else {
                $response = [];
                foreach ($data as $item){
                  $response[] = $item->transformer();
                }
            }
            return [
                'success' => $status,
                'data' => $response,
                'message' => $message
            ];
        };
	}

    
}