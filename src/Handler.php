<?php

namespace TenUp\WP_Ajax;

class Handler {

	/**
	 * @var bool|Requirement\Check
	 */
	private $check = false;
	var $responder;

	function __construct( Responder\Responder $r ) {
		$this->responder = $r;
	}

	function add_process( $action, $process, $args ) {

		$args = wp_parse_args( $args, [
			'method' => 'POST',
			'nopriv' => false,
		] );


		$privs = [ 'wp_ajax_'];
		if ( $args['nopriv'] ) {
			$privs[] = 'wp_ajax_nopriv_';
		}

		foreach ( $privs as $priv ) {
			add_action( $priv . $action, function() use ( $action, $process, $args ){
				$this->handle( $action, $process, $args );
			} );
		}

		return $this;

	}

	function handle( $action, $process, $args ) {

		//arbitrary, poorly done
		unset( $_REQUEST['action'] );

		//@todo: consider adding a "success/failure" interface for requirements–one that could utilize exceptions as flow control, or WP_Errors
		try {
			$this->maybe_check_requirements( $_REQUEST );
			$result = $process( $_REQUEST );
		} catch ( \Exception $e ) {
			$this->responder->send_failure( $e->getMessage() );
			return false;
		}

		if ( $result ) {
			$this->responder->send_success( $result );
			return true;
		}

		$this->responder->send_failure( $result );
		return false;

	}

	function maybe_check_requirements( $data ) {
		if ( $this->check && ! $this->check->check_all( $data ) ) {
			throw new \Exception( 'Failed requirements check.' );
		}
	}

	function add_requirement( Requirement\Requirement $r ) {
		if ( ! $this->check ) {
			$this->check = new Requirement\Check;
		}

		$this->check->add( $r );

	}

}