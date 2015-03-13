<?php
class View {
	private $viewfile;
	private $vars = array();

	function __construct($name) {
		global $config;
		$this->viewfile = $config['view_path'].$name.'.tpl.php';
	}

	function assign($var_name, $value) {
		$this->vars[$var_name] = $value;
	} 

	function show() {
		if (!file_exists($this->viewfile)) {
			echo "View file \"{$this->viewfile}\" not found";
			return;
		}

		foreach ($this->vars as $var => $value) {
			${$var} = $value;
		}

		include $this->viewfile;
	}
}