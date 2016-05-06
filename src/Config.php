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
	 * - token => Node's registration token
	 * - testing => Toggle whether node is in testing mode
	 * 
	 */
	public static $spec = array(
		'hostname' => "Default",
		'springname' => 'Dft',
		'token' => '897316929176464ebc9ad085f31e7284',
		'testing' => false,
		'password' => "pass"
	);
	
	/**
	 * Network configuration
	 * 
	 * Keys:
	 * 
	 * - master => Master root address
	 * - hostname => Hostname of the root node
	 * - hostres => Hostname service resource
	 * - service => The service protocol of the root node
	 * - geosub => The geosub the node is connected to
	 * - geotop => The geotop the node GSN is a part of
	 */
	public static $net = array (
		'master' => "127.0.0.1",
		'hostname' => "default.hst",
		'hostres' => "res",
		'service' => "http",
		'geosub' => "gsndft",
		'geotop' => "gtndft,"
	);
	
};


function nodereg_from_config() {
	return Config::$spec['springname'] . "," . Config::$spec['hostname'];
}

function nodeurl_from_config() {
	return Config::$spec['springname'] . "." . Config::$net['geosub'] . "." . Config::$net['geotop'];
}

function hostres_from_config() {
	return Config::$net['hostname'] . "/" . Config::$net['hostres'];
}