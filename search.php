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

require_once("cache.php");
require_once("limit.php");

class Search {

	private $cache;
	private $google_url;
	private $response;
	private $limit;

	public function __construct() {
		$this->cache      = new Cache();
		$this->google_url = "https://www.googleapis.com/customsearch/v1?key=".GSEARCH_API_KEY;
		$this->response   = False;
		$this->is_windows = PHP_OS == "WINNT" || PHP_OS == "WIN32";
		$this->limit = new Limit();

	}

	public function search($q) {
		$req = $this->google_url."&q=".$q;
		$this->response = $this->get_results($req);
		$this->response = $this->get_files($this->response);

		//$this->prepare_next_req($req);


		if($this->response == "null") {
			$d = array('limit' => 'reached');
			return json_encode($d);
		}
		return $this->response;
	}

	private function get_results($req) {
		//file_put_contents("madi.txt", $req, FILE_APPEND);
		$response = $this->cache_search($req);
		//file_put_contents("madi2.txt", $response);
		if($this->limit->get_limit() < 95) {
			if(!$response) {
				//file_put_contents("madi3.txt", "1", FILE_APPEND);
				$response = $this->google_search($req);
				$this->limit->increment_limit();
			}
		}

		return $response;

	}

	private function prepare_next_req($url) {
		$jres = json_decode($this->response);
		if(!stripos($url, "start")) {
			$url = $url."&start=".$jres->queries->nextPage[0]->startIndex;
		} else {
			$url = preg_replace('/\&start=(\d+)/i', "&start=".$jres->queries->nextPage[0]->startIndex, $url);
		}

		$response = $this->get_results($url);
		$response = $this->get_files($response);

	}

	private function cache_search($req) {
		return $this->cache->get($req);
	}

	private function google_search($req) {
		$response = @file_get_contents($req);
		$this->cache->insert($req, $response);
		return $response;
	}

	private function get_files($resp) {
		$jres = json_decode($resp);
		if($jres->items) {
			foreach($jres->items as $item) {
				$files = json_decode($this->cache_search($item->link));
				if(!$files) {
					$this->call_robit($item->link);
					$files = json_decode('{"files": false}');
				}
				$item->files = $files->files;
			}
		}

		$resp = json_encode($jres);

		return $resp;
	}

	private function parse_html($url) {
		$html = @file_get_contents($url);

		$dom = new DOMDocument();

		@$dom -> loadHTML($html);

		$links = $dom->getElementsByTagName('a');

		$json = "{\"files\": [";
		foreach ($links as $link){
			$href = $link->getAttribute("href");
			if($this->ends_with($href, ".pdf") || $this->ends_with($href, ".ppt") || $this->ends_with($href, ".zip")) {
				if (trim($link->nodeValue) == "") {
					$link->nodeValue = "Untitled";
				}
				$json .= "{\"flink\": \"". $href . "\", \"fname\": \"" . $link->nodeValue . "\"},";
			}
		}

		$json = rtrim($json, ",");

		$json .= "]}";

		$this->cache->insert($url, $json);


		return $json;
	}

	private function ends_with($haystack, $needle) {
		return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
	}

	private function call_robit($url) {
		$call = 'php robit.php '.$url;
		if($this->is_windows) {
			pclose(popen('start /b '.$call.'', 'r'));
		} else {
			pclose(popen($call.' > /dev/null &', 'r'));
		}
		return true;
	}
}
?>
