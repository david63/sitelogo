<?php
/**
*
* @package Site Logo Extension
* @copyright (c) 2014 david63
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace david63\sitelogo\migrations;

use phpbb\db\migration\migration;

class version_1_0_0 extends migration
{
	public function update_data()
	{
		return array(
			array('config.add', array('site_logo_height', '')),
			array('config.add', array('site_logo_image', '')),
			array('config.add', array('site_logo_left', 0)),
			array('config.add', array('site_logo_pixels', 7)),
			array('config.add', array('site_logo_position', 0)),
			array('config.add', array('site_logo_remove', 0)),
			array('config.add', array('site_logo_right', 0)),
			array('config.add', array('site_logo_width', '')),
			array('config.add', array('site_name_supress', 0)),
			array('config.add', array('site_search_remove', '')),
			array('config.add', array('version_sitelogo', '1.0.0')),

			// Add the ACP module
			array('module.add', array('acp', 'ACP_CAT_DOT_MODS', 'SITE_LOGO')),

			array('module.add', array(
				'acp', 'SITE_LOGO', array(
					'module_basename'	=> '\david63\sitelogo\acp\sitelogo_module',
					'modes'				=> array('manage'),
				),
			)),
		);
	}
}
