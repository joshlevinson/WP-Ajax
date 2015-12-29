<?php

namespace TenUp\WP_Ajax\Requirement;

class Check {

	/**
	 * @var Requirement[]
	 */
	private $requirements = [];

	function add( Requirement $requirement ) {
		$this->requirements[ $this->key( $requirement ) ] = $requirement;
	}

	function remove( Requirement $requirement ){
		$key = $this->key( $requirement );
		if ( isset ( $this->requirements[ $key ] ) ) {
			unset( $this->requirements[ $key ] );
			return true;
		}
		return false;
	}

	function key( Requirement $requirement ) {
		return md5( serialize( $requirement ) );
	}

	/**
	 * TODO: Implement error messages from requirement check failure
	 *
	 * @return bool
	 */
	function check_all( $data = null ) {
		foreach( $this->requirements as $requirement ) {
			if( ! $requirement->check( $data ) ) {
				return false;
			}
		}
		return true;
	}

}