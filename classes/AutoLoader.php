<?php 
spl_autoload_register(function ($class) {
	if (substr($class, -10) === 'Controller')
		@include BASEDIR.'controllers/'.$class.'.php';
	else if (substr($class, -5) === 'Model')
		@include BASEDIR.'models/'.$class.'.php';
	else
		@include BASEDIR.'classes/'.$class.'.php';
});