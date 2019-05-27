<?php
/**
*
* @package Site Logo Extension
* @copyright (c) 2014 david63
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace david63\sitelogo\acp;

class sitelogo_info
{
	function module()
	{
		return array(
			'filename'	=> '\david63\sitelogo\acp\sitelogo_module',
			'title'		=> 'SITE_LOGO_MANAGE',
			'modes'		=> array(
				'manage'	=> array('title' => 'SITE_LOGO_MANAGE', 'auth' => 'ext_david63/sitelogo && acl_a_board', 'cat' => array('SITE_LOGO')),
			),
		);
	}
}
