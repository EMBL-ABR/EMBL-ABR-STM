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

Class Limit {
    public function get_limit() {
      $entries = json_decode(file_get_contents(LIMIT_FILE), True);
      return $entries['limit'];
    }

    public function increment_limit() {
      $limit = $this->get_limit();
      $this->set_limit($limit + 1);
    }

    private function set_limit($limit) {
      $d = array('limit' => $limit);
      file_put_contents(LIMIT_FILE, json_encode($d));
      if($limit > 94) {
        $to      = 'madisonflannery93@gmail.com';
        $subject = 'STM limit reached';
        $message = 'STM limit has been reached.';
        $headers = 'From: stm-no-reply@embl-abr.org.au' . "\r\n" .
            'Reply-To: contact@embl-abr.org.au' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);
      }
    }
}

?>
