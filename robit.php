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


class Robit {

	public function __construct() {
		//nothing to do here
	}

	public function parse_html($url) {
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

		$cache = new Cache();
		$cache->insert($url, $json);
	}

	private function ends_with($haystack, $needle) {
		return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== FALSE);
	}

}

$r = new Robit();

if(!empty($argv[1])) {
	$r->parse_html($argv[1]);
}

?>
