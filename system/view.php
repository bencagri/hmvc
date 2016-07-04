<?php
namespace View;

/**
 * Class View
 */
class View {


    private $pageVars = array();
	private $template;

	public function __construct($template, $vars = array())
	{
		$this->template = APP_DIR .'views/'. $template .'.php';
		$this->vars = $vars;
	}


    function render() {
        
        if (file_exists($this->template)) {
            extract($this->vars);
            ob_start();
            include ($this->template);
            $renderedView = ob_get_clean();
        }else{
            $renderedView = "View Dosyası Yok";
        }

        return $renderedView;
    }
	

	/*

	public function set($var, $val)
	{
		$this->pageVars[$var] = $val;
	}

	
	public function render()
	{
		extract($this->pageVars);

		ob_start();
		require($this->template);
		echo ob_get_clean();
	}
	*/


}

?>