<?php 
 class FunctionCommon {
 	public function redirectPage($action){
 		header("Location:$action");
 	}

 	public function slug($str) {
 		// replace non letter or digits by -
		$str = preg_replace('~[^\pL\d]+~u', '-', $str);

		// transliterate
		$str = iconv('utf-8', 'us-ascii//TRANSLIT', $str);

		// remove unwanted characters
		$str = preg_replace('~[^-\w]+~', '', $str);

		// trim
		$str = trim($str, '-');

		// remove duplicate -
		$str = preg_replace('~-+~', '-', $str);

		// lowercase
		$str = strtolower($str);

		if (empty($str)) {
			return 'n-a';
		}

		return $str;
 	}

 }
?>