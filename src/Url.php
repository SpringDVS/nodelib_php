<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace SpringDvs;

/**
 * The representation of a URL
 */
class Url {
	private $staticRoute;
	private $gtn;
	private $glq;
	private $res;
	private $query;
	
	public function __construct($url = '') {
		$staticRoute = array();
		if($url == "") return;
		
		if(substr($url, 0, 9) != 'spring://')
			throw new Exception ("Malformed URL");
		
		$a = explode('?', substr($url,9), 2);
		if(isset($a[1])) {
			$this->query = $a[1];
		}
		
		$b = explode('/', $a[0]);
		if(isset($b[1])) {
			$this->res = array_slice($b, 1);
		}
		
		$c = explode(':', $b[0]);
		if(isset($c[1])) {
			$this->glq = $c[1];
		}

		$d = explode('.', $c[0]);
		
		$last = count($d) - 1;
		switch($d[$last]) {
		case "uk":
			$this->gtn = $d[$last];
			break;
		
		default:
			$this->gtn = "";
		}
		
		$this->staticRoute = $d;
	}
	
	public function &route() {
		return $this->staticRoute;
	}
	
	public function gtn() {
		return $this->gtn;
	}
	
	public function glq() {
		return $this->glq;
	}
	
	public function query() {
		return $this->query;
	}
	
	public function res() {
		return $this->res;
	}
	
	public function toString() {
		$url = "spring://";
		
		$last = count($this->staticRoute) - 1;
		foreach($this->staticRoute as $i => $r) {
			$url .= $r;
			if($i < $last)
				$url .= '.';
		}
		
		if(!empty($this->glq)) {
			$url .= ":{$this->glq}";
		}

		if(!empty($this->res)) {
			$url .= "/{$this->res}";
		}

		if(!empty($this->query)) {
			$url .= "?{$this->query}";
		}
		
		return $url;
	}
	
	public function pop() {
		array_pop($this->staticRoute);
	}
}
