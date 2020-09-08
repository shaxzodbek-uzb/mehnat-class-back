<?php

namespace App\Mixins;

class ResponseMixin {
	public function successResponse() {
		return function($data, $message = 'Default succes message') {
            return [
                'success' => true,
                'data' => $data,
                'message' => $message
            ];
        };
	}
}