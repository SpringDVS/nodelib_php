<?php

namespace SpringDvs;

class Config {
	public static $spec = array(
		'hostname' => "Default",
		'springname' => 'Dft',
		'testing' => false,
	);
	
	public static $net = array (
		'master' => "127.0.0.1",
		'hostname' => "default.hst",
		'service' => "http",
	);
	
};


function nodereg_from_config() {
	return Config::$spec['springname'] . "," . Config::$spec['hostname'];
}