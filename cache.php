<?php

/*
Copyright 2015 Vasileios Lapatas

Licensed under the Apache License, Version 2.0 (the "License");
you may not use this file except in compliance with the License.
You may obtain a copy of the License at

	http://www.apache.org/licenses/LICENSE-2.0

	Unless required by applicable law or agreed to in writing, software
	distributed under the License is distributed on an "AS IS" BASIS,
	WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
	See the License for the specific language governing permissions and
	limitations under the License.
*/

require_once("settings.php");

/*

Caches requests/responses.

public methods:
	get: args-> request
		returns cache entry for request. False if not found
	insert: args-> request, response
		stores a request and response to the cache (deletes previous entry if existed)
	delete: args-> request
		deletes the entry for a specific request

settings:
	TIMEZONE:   the timezone to use
	CACHE_FILE: the JSON file to store the cache
	CACHE_TIME: time limit for invalidation of a cache entry

*/


class Cache {

	private $entries = array();

	public function __construct() {
		date_default_timezone_set(TIMEZONE);
	}

	public function get($req) {
		$this->entries = json_decode(file_get_contents(CACHE_FILE), True);

		if(!$this->entries) {
			return False;
		}

		$cache_limit = new DateTime();
		$cache_limit->modify("-".CACHE_TIME);

		$i = 0;
		foreach ($this->entries as $item) {
			if($item['req'] == $req) {
				$ts = new DateTime($item['ts']);
				if ($cache_limit > $ts) {
					$this->delete_idx($i);
					return False;
				} else {
					return json_encode($item['resp']);
				}
			}
			$i++;
		}
		return False;
	}

	public function insert($req, $resp) {
		$this->entries = json_decode(file_get_contents(CACHE_FILE), True);
		$this->delete($req);

		$date = new DateTime();

		$json = "{\"ts\": \"" . $date->format('Y-m-d H:i:s') . "\", \"req\": \"" . $req . "\", \"resp\": " . $resp . "}";
		$item = json_decode($json, True);

		if($this->entries) {
			array_push($this->entries, $item);
		} else {
			$this->entries[0] =  $item;
		}
		$this->write_file();
	}

	public function delete($req) {
		$this->entries = json_decode(file_get_contents(CACHE_FILE), True);
		$i = 0;
		foreach ($this->entries as $item) {
			if($item['req'] == $req) {
				$this->delete_idx($i);
			}
			$i++;
		}
	}

	private function delete_idx($idx)  {
		array_splice($this->entries, $idx, 1);
		$this->write_file();
	}

	private function write_file() {
		file_put_contents(CACHE_FILE, json_encode($this->entries));
	}

}

?>
