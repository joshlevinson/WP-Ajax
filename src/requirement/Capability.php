<?php

namespace TenUp\WP_Ajax\Requirement;

class Capability implements Requirement {

	private $cap;

	function __construct( $cap ) {
		$this->cap = $cap;
	}

	function check( $data ) {
		return current_user_can( $this->cap );
	}

}