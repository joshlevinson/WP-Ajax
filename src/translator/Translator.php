<?php

namespace TenUp\WP_Ajax\Translator;

interface Translator {

	function decode( $data );

	function encode( $data );

}