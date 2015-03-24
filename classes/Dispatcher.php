<?php 
class Dispatcher {
	private $_controller;
	private $_method = 'index';
	private $_args = array();

	function run() {
		$this->get_controller();
		$this->get_method();

		$class = $this->_controller.'Controller';

		# Throw 404 if controller not found
		if (!class_exists($class, true))
			return $this->not_found_error();
		
		$controller = new $class();

		# Throw 404 if requested method is not found
		if (!method_exists($controller, $this->_method))
			return $this->not_found_error();

		# Run 'before' method if exists before any other code
		if (method_exists($controller, 'before'))
			$controller->before();

		# Finally call the controller method
		$controller->{$this->_method}();
	}

	private function not_found_error() {
		echo "<h1>Error 404 - Page not found!</h1>";
	}

	private function get_controller() {
		# Split up request URI, ignoring the first /
		$request = explode('/', substr($_SERVER['REQUEST_URI'], 1), 2);
		$this->_controller = ucfirst(strtolower($request[0]));
		
		# Get args
		if (count($request) > 1)
			$this->_args = explode('/', $request[1]);
		
		# Default controller
		if (empty($this->_controller))
			$this->_controller = 'Home';
	}

	private function get_method() {
		if (!empty($this->_args[0]))
			$this->_method = strtolower($this->_args[0]);
	}
}