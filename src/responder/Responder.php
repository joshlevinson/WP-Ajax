<?php

namespace TenUp\WP_Ajax\Responder;

interface Responder {

	function send_failure( $data );

	function send_success( $data );

}