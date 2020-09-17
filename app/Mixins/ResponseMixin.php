<?php

namespace App\Mixins;

class ResponseMixin {
	public function customResponse() {
		return function($status, $data, $message = 'Default succes message') {
            return [
                'success' => $status,
                'data' => $data,
                'message' => $message
            ];
        };
	}
}