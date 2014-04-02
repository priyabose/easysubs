<?php

class EasysubsControllerDefault extends FOFController

{
	public function getView($name = '', $type = '', $prefix = '', $config = array())
	{
		$config['linkbar_style'] = 'classic';

		return parent::getView($name, $type, $prefix, $config);
	}
}
