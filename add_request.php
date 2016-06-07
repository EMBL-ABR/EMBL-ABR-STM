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

$email    = $_POST['email'];
$url      = $_POST['addurl'];
$reason   = $_POST['reason'];


$json = '{"email": "'.$email.'", "url": "'.$url.'", "reason: "'.$reason.'"}';

$requests = json_decode(file_get_contents('requests.json'), true);

array_push($requests, $json);

file_put_contents('requests.json', json_encode($requests));

echo $json;

?>
