<?php

class View
{

	static function generate($content_view, $data = null)
	{
		if(is_array($data)) {
			
			extract($data);
		}

		include $content_view;
	}
}