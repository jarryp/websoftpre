<?php 

class Views {

	function __construct(){

	}

	function render($controller,$view){
		$controllers = get_class($controller);
		require VIEWS.DFT."head.php";
		require VIEWS.DFT."menu_superior.php";
		require VIEWS.DFT."menu_lateral.php";
		require VIEWS.$controllers."/".$view.".php";
		require VIEWS.DFT."footer.php";

	}

	function render_popup($controller,$view){
		$controllers = get_class($controller);
		require VIEWS.DFT."head.php";
		require VIEWS.DFT."menu_superior.php";
		require VIEWS.$controllers."/".$view.".php";
		require VIEWS.DFT."footer.php";		
	}

	function render_section($controller,$view){
		$controllers = get_class($controller);
		require VIEWS.$controllers."/".$view.".php";

	}

	function renderLogin($controller,$view){
		$controllers = get_class($controller);
		require VIEWS.DFT."head.php";
		require VIEWS.$controllers."/".$view.".php";
		require VIEWS.DFT."footer.php";

	}

	

}

?>