<?php

/* Notice:  Copyright 2016, The Care Connections Initiative c.i.c.
 * Author:  Charlie Fyvie-Gauld <cfg@zunautica.org>
 * License: Apache License, Version 2 (http://www.apache.org/licenses/LICENSE-2.0)
 */

namespace SpringDvs;

class HttpService {
	/**
	 * Send a Dvsp packet via HTTP
	 * @param \SpringDvs\DvspPacket $frame
	 * @param string $address
	 * @return DvspPacket
	 */
	static public function sendPacket(DvspPacket $frame, $address) {
		
		$ch = curl_init();
		$serial = $frame->serialise();

		curl_setopt($ch, CURLOPT_URL,            $address);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
		curl_setopt($ch, CURLOPT_POST,           1 );
		curl_setopt($ch, CURLOPT_POSTFIELDS,      bin2hex($serial));
		curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Content-Type: application/octet-stream')); 

		$hex = curl_exec($ch);
		$bytes = \SpringDvs\hex_to_bin($hex);
		return DvspPacket::deserialise($bytes);
	}
	
	/**
	 * Receive a Packet from HTTP connection
	 * 
	 * @return SpringDvs\DvspPacket The packet that is sent
	 */
	static public function recvPacket() {
		$bytes = HttpService::recvRaw();
		return DvspPacket::deserialise($bytes);
	}
	
	static public function recvRaw() {
		return file_get_contents('php://input');
	}
	
	static public function jsonEncodePacket(\SpringDvs\DvspPacket &$packet) {
		
		switch($packet->header()->type) {
			case DvspMsgType::gsn_response:
				return $packet->jsonEncode(\SpringDvs\FrameResponse::contentType());
			case DvspMsgType::gsn_registration:
				return $packet->jsonEncode(\SpringDvs\FrameRegistration::contentType());
			case DvspMsgType::gsn_resolution:
				return $packet->jsonEncode(\SpringDvs\FrameResolution::contentType());
			case DvspMsgType::gsn_state:
				return $packet->jsonEncode(FrameStateUpdate::contentType());
			case DvspMsgType::gsn_area:
				return $packet->jsonEncode();
			case DvspMsgType::gsn_node_info:
				return $packet->jsonEncode(FrameNodeRequest::contentType());
			case DvspMsgType::gsn_node_status:
				return $packet->jsonEncode(FrameNodeStatus::contentType());
			case DvspMsgType::gsn_request:
				return $packet->jsonEncode(FrameRequest::contentType());
			case DvspMsgType::gsn_type_request:
				return $packet->jsonEncode(FrameTypeRequest::contentType());
			case DvspMsgType::gsn_response_node_info:
				return $packet->jsonEncode(FrameNodeInfo::contentType());
			case DvspMsgType::gsn_response_network:
				$packet->jsonEncode(FrameNetwork::contentType());
			case DvspMsgType::gsn_response_high:
				$packet->jsonEncode(FrameRequest::contentType());
			case DvspMsgType::gtn_registration:
				$packet->jsonEncode(FrameGtnRegistration::contentType());

			default: return "{}";
		}
	}
}

