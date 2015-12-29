<?php

namespace TenUp\WP_Ajax\Translator;

class JSON implements Translator {

	function decode( $data ) {
		return json_decode( $data );
	}

	function encode( $data ) {
		return wp_json_encode( $data );
	}
}