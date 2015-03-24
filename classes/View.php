<?php
class View {
	private $viewfile;
	private $vars = array();

	#
	#	Creates a new view object from file $name
	#
	function __construct($name) {
		global $config;
		$this->viewfile = $config['view_path'].$name.'.tpl.php';
		$this->vars['site_url'] = $config['site_url'];
	}

	#
	#	Assigns a variable $var_name to $value in the view file.
	# 	e.g. assign('pi', 3.14) will create a variable called $pi which is 3.14
	#
	function assign($var_name, $value) {
		$this->vars[$var_name] = $value;
	} 

	#
	#	Build the template and view it.
	#
	function show() {
		# Show error for not found view.
		# TODO: Implement an error reporting system
		if (!file_exists($this->viewfile)) {
			echo "View file \"{$this->viewfile}\" not found";
			return;
		}

		# Assign each variable to the template.
		foreach ($this->vars as $var => $value) {
			${$var} = $value;
		}
		
		# Finally show this template
		include $this->viewfile;
	}
}