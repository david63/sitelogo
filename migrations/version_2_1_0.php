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

class version_2_1_0 extends migration
{
	static public function depends_on()
	{
		return array('\david63\sitelogo\migrations\version_1_0_0');
	}

	public function update_data()
	{
		return array(
			array('config.add', array('site_logo_use_background', 0)),
			array('config.add', array('site_logo_background_image', 'styles/prosilver/theme/images/bg_header.gif')),
			array('config.add', array('site_logo_background_repeat', 0)),
			array('config.add', array('site_logo_banner_height', 100)),
			array('config.add', array('site_logo_banner_radius', 10)),
			array('config.add', array('site_logo_banner_url', '')),
			array('config.add', array('site_logo_header', 0)),
			array('config.add', array('site_logo_header_colour', '#12A3EB')),
			array('config.add', array('site_logo_logo_url', '')),
			array('config.add', array('site_logo_move_search', 0)),
			array('config.add', array('site_logo_override_colour', '#000000')),
			array('config.add', array('site_logo_remove_header', 0)),
			array('config.add', array('site_logo_responsive', 1)),
			array('config.add', array('site_logo_site_name_below', 0)),
			array('config.add', array('site_logo_header_solid', 0)),
			array('config.add', array('site_logo_use_banner', 0)),
			array('config.add', array('site_logo_use_extended_desc', 0)),
			array('config.add', array('site_logo_use_override_colour', 0)),

			array('config_text.add', array('site_logo_extended_site_description', '')),

			array('config.remove', array('version_sitelogo')),
		);
	}
}
