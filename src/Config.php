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
	$res = Config::$spec['resource'] == "" ? "" : "/".Config::$spec['resource'];
	return Config::$spec['springname'] . "," . Config::$spec['hostname'].$res;
}

function nodeurl_from_config() {
	return Config::$spec['springname'] . "." . Config::$net['geosub'] . "." . Config::$net['geotop'];
}

function hostres_from_config() {
	return Config::$net['hostname'] . "/" . Config::$net['hostres'];
}