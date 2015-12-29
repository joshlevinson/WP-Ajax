<?php

require_once 'WP-Ajax/wp-ajax.php';

use TenUp\WP_Ajax as Ajax;

/**
 * @return Ajax\Handler
 */
function get_json_handler() {
	return new Ajax\Handler( new Ajax\Responder\JSON );
}

get_json_handler()
	->add_process(
		'bounceback',
		function ( $data ) {
			return $data;
		}
	)->add_requirement( new Ajax\Requirement\Nonce( 'nonce' ) )->add_requirement( new Ajax\Requirement\Capability( 'lol' ) );

get_json_handler()->add_process(
	'random',
	function ( $data ) {
		if( random_boolean() ) {
			throw new Exception( 'Failed!' );
		}
		return 'Goodbye, world';
	},
	$args = [
		'require_login' => false,
	]
);
function random_boolean() {
	return (bool) rand( 0, 1 );
}