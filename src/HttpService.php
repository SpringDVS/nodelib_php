<?php

/* Notice:  Copyright 2016, The Care Connections Initiative c.i.c.
 * Authors: Charlie Fyvie-Gauld <cfg@zunautica.org>
 * License: Apache License, Version 2 (http://www.apache.org/licenses/LICENSE-2.0)
 */

namespace SpringDvs;

class HttpService {
	/**
	 * Send a Dvsp Message
	 * @param \SpringDvs\Message $frame
	 * @param string $address
	 * @return DvspPacket
	 */
	static public function sendPacket(Message $msg, $address, $host) {
				
		$ch = curl_init($host.'/spring/');

		//curl_setopt($ch, CURLOPT_URL,            $address);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt($ch, CURLOPT_POST,           1 );
		curl_setopt($ch, CURLOPT_USERAGENT,           "WebSpringDvs" );
		curl_setopt($ch, CURLOPT_POSTFIELDS,      $msg->toStr());
		curl_setopt($ch, CURLOPT_HTTPHEADER,     array(
													'Content-Type: text/plain', 
													'User-Agent: WebSpringDvs/0.2')); 
		$response = curl_exec($ch);

		try {
			return Message::fromStr($response);
		} catch(\Exception $e) {
			return false;
		}
	
	}
	
	static public function jsonEncodePacket(Message $msg) {
		return $msg->toJsonArray();
	}
}

