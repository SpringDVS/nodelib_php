<?php

namespace SpringDvs;

class Config {
	/**
	 * Node configuration
	 * 
	 * Keys:
	 * 
	 * - hostname => Node's hostname
	 * - springname => Node's springname
	 * - testing => Toggle whether node is in testing mode
	 * 
	 */
	public static $spec = array(
		'hostname' => "Default",
		'springname' => 'Dft',
		'testing' => false,
	);
	
	/**
	 * Network configuration
	 * 
	 * Keys:
	 * 
	 * - master => Master root address
	 * - hostname => Hostname of the root node
	 * - service => The service protocol of the root node
	 * - geosub => The geosub the node is connected to
	 */
	public static $net = array (
		'master' => "127.0.0.1",
		'hostname' => "default.hst",
		'service' => "http",
		'geosub' => "gsndft",
	);
	
};


function nodereg_from_config() {
	return Config::$spec['springname'] . "," . Config::$spec['hostname'];
}