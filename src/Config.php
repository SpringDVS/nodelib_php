<?php

namespace SpringDvs;

class Config {
	/**
	 * Node configuration
	 * 
	 * Keys:
	 * 
	 * - hostname => Node's hostname
	 * - resource => Service access resource (usually `spring/`)
	 * - springname => Node's springname
	 * - password => Password for node administrator
	 * - token => Node's registration token
	 * - testing => Toggle whether node is in testing mode
	 */
	public static $spec = array(
		'hostname' => "Default",
		'resource' => "spring/",
		'springname' => 'Dft',
		'token' => '3858f62230ac3c915f300c664312c63f',
		'testing' => false,
		'password' => "pass"
	);
	
	/**
	 * Network configuration
	 * 
	 * Keys:
	 * 
	 * - primary => Primary hub address
	 * - hostname => Hostname of the primary node
	 * - service => The service protocol of the primary node
	 * - geosub => The geosub the node is connected to
	 * - geotop => The geotop the node GSN is a part of
	 */
	public static $net = array (
		'primary' => "127.0.0.1",
		'hostname' => "default.hst",
		'service' => "http",
		'geosub' => "gsndft",
		'geotop' => "gtndft,"
	);
	
	/**
	 * System configuration
	 * 
	 * Keys:
	 * 
	 * - store => The path to the stores (outside public_html/)
	 * - store_live => The path to the live production stores
	 * - store_test => The path to the testing stores
	 */
	public static $sys = array (
		'store' => './',
		'store_live' => './live',
		'store_test' => './test',
	);
	
};


function nodedouble_from_config() {
	return Config::$spec['springname'] . "," . Config::$spec['hostname'];
}

function nodeurl_from_config() {
	return Config::$spec['springname'] . "." . Config::$net['geosub'] . "." . Config::$net['geotop'];
}

function hostres_from_config() {
	return Config::$net['hostname'];
}