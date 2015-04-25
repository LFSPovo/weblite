<?php
class URL {
	#
	#	Returns a HTTP link to $item in the assets directory
	#
	static function asset($item) {
		global $config;
		return $config['site_url'] . 'assets/' . $item;
	}

	#
	#	Returns a HTTP link to $page
	#
	static function link($page) {
		global $config;
		return $config['site_url'] . $page;
	}

	#
	#	Returns an anchor link to $page with $title
	#
	static function anchor($page, $title) {
		global $config;
		return "<a href='" . $config['site_url'] . $page . "'>$title</a>";
	}
}