<?php
namespace System;

/**
 * Class View
 */
class View extends Core{


    private $pageVars = array();
	private $template;

	public function __construct($template, $vars = array())
	{
        parent::__construct();

	}


}

?>