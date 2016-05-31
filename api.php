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

require_once('search.php');

include 'ChromePhp.php';
ChromePhp::log('Hello console!');
ChromePhp::log($_SERVER);
ChromePhp::warn('something went wrong!');

$q = $_GET['q'];

if($idx = strpos($q, '&')) {
	$query = substr($q, 0, $idx);
	$q     = substr($q, $idx);
	$q     = urlencode($query).$q;
} else {
	$q = urlencode($q);
}

$s = new Search();

echo $s->search($q);

?>
