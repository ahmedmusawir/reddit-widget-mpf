<?php 

/**
* PLUGIN DEACTIVATION CLASS
*/
class Reddit_Json_MPF_Deactivate
{
	function __construct()
	{
		# code...
	}

	public static function deactivate() {

		flush_rewrite_rules();

	}

}
