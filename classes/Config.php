<?php
class Config{
	public static function get($path = null){
		$config = $GLOBALS['config'];
		$path = explode('/', $path);
		if ($path) {
			foreach ($path as $bit) {
				if (isset($config[$bit])) {
					$config = $config[$bit];
				}
			}
			return $config;
		}
		return false;
	}
}