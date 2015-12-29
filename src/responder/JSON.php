<?php

namespace TenUp\WP_Ajax\Responder;

class JSON implements Responder {

	function send_failure( $data ) {
		wp_send_json_error( $data );
	}

	function send_success( $data ) {
		wp_send_json_success( $data );
	}

}