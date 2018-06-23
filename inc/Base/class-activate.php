<?php 

/**
* PLUGIN ACTIVATION CLASS
*/
class Reddit_Json_MPF_Activate
{
	function __construct()
	{
		# code...
	}

	public static function activate() {

		flush_rewrite_rules();
	}
}
