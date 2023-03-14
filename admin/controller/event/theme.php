<?php
class ControllerEventTheme extends Controller {
	public function index(&$view, &$data) {
		if (substr($view, -3) == 'tpl') {
			$view = substr($view, 0, -3);
		}
	}
}
