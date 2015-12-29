<?php

namespace TenUp\WP_Ajax\Requirement;

class Nonce implements Requirement {

	private $action;
	private $arg;

	function __construct( $action = -1, $arg = 'nonce' ) {
		$this->action = $action;
		$this->arg = $arg;
	}

	function check( $data ) {
		return wp_verify_nonce( $data[ $this->arg ], $this->action );
	}

}