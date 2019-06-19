<?php
/**
*
* @package Site Logo Extension
* @copyright (c) 2014 david63
* @license GNU General Public License, version 2 (GPL-2.0)
*
*/

namespace david63\sitelogo\event;

/**
* @ignore
*/
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

use phpbb\config\config;
use phpbb\config\db_text;
use phpbb\template\template;
use phpbb\user;

/**
* Event listener
*/
class listener implements EventSubscriberInterface
{
	/** @var \phpbb\config\config */
	protected $config;

	/** @var \phpbb\config\db_text */
	protected $config_text;

	/** @var \phpbb\template\template */
	protected $template;

	/** @var \phpbb\user */
	protected $user;

	/** @var string phpBB root path */
	protected $root_path;

	/** @var string custom constants */
	protected $slconstants;

	/**
	* Constructor for listener
	*
	* @param \phpbb\config\config		$config			phpBB config
	* @param \phpbb\config\db_text		$config_text	Config text object
	* @param \phpbb\template\template	$template		phpBB template
	* @param \phpbb\user				$user			User object
	* @param string 					$root_path		phpBB root path
	* @param array						$slconstants	Constants
	*
	* @access public
	*/
	public function __construct(config $config, db_text $config_text, template $template, user $user, $root_path, $slconstants)
	{
		$this->config		= $config;
		$this->config_text 	= $config_text;
		$this->template		= $template;
		$this->user			= $user;
		$this->root_path	= $root_path;
		$this->constants	= $slconstants;
	}

	/**
	* Assign functions defined in this class to event listeners in the core
	*
	* @return array
	* @static
	* @access public
	*/
	static public function getSubscribedEvents()
	{
		return array(
			'core.page_header_after' => 'site_logo_header',
		);
	}

	/**
	* Update the template variables
	*
	* @param object $event The event object
	* @return null
	* @access public
	*/
	public function site_logo_header($event)
	{
		$site_logo_img		= $this->user->img('site_logo');
		$logo_corners 		= '0px 0px 0px 0px';
		$site_logo_img_new	= '';

		// No point processing this if it is not required
		if ($this->config['site_logo_image'] && !$this->config['site_logo_remove'])
		{
			$logo_path		= $this->set_site_logo_url($this->config['site_logo_image']);
			$logo_corners 	= ($this->config['site_logo_left']) ? $this->config['site_logo_pixels'] . 'px 0px 0px ' . $this->config['site_logo_pixels'] . 'px' : $logo_corners;
			$logo_corners 	= ($this->config['site_logo_right']) ? '0px ' . $this->config['site_logo_pixels'] . 'px ' . $this->config['site_logo_pixels'] . 'px 0px' : $logo_corners;
			$logo_corners 	= ($this->config['site_logo_left'] && $this->config['site_logo_right']) ? $this->config['site_logo_pixels'] . 'px ' . $this->config['site_logo_pixels'] . 'px ' . $this->config['site_logo_pixels'] . 'px ' . $this->config['site_logo_pixels'] . 'px' : $logo_corners;
			$site_logo_img	= '<img src=' . $logo_path . ' style="max-width: 100%; height:auto; height:' . $this->config['site_logo_height'] . 'px; width:' . $this->config['site_logo_width'] . 'px; -webkit-border-radius: ' . $logo_corners . '; -moz-border-radius: ' . $logo_corners . '; border-radius: ' . $logo_corners . ';">';
			$site_logo_img_new = 'url("'. $logo_path . '")';
		}

		if ($this->config['site_logo_use_extended_desc'])
		{
			$extended_site_description_data	= $this->config_text->get_array(array('site_logo_extended_site_description'));
			$this->config['site_desc']		= $extended_site_description_data['site_logo_extended_site_description'];
		}

		$this->template->assign_vars(array(
			'BANNER_HEIGHT'			=> $this->config['site_logo_banner_height'],
			'BORDER_RADIUS'			=> $this->config['site_logo_banner_radius'],

			'HEADER_COLOUR'			=> $this->config['site_logo_header_colour'],
			'HEADER_COLOUR_1'		=> $this->get_hex_colour($this->config['site_logo_header_colour'], 1),
			'HEADER_COLOUR_2'		=> $this->get_hex_colour($this->config['site_logo_header_colour'], 2),

			'LOGO_CORNERS'			=> $logo_corners,
			'LOGO_HEIGHT'			=> $this->config['site_logo_height'],
			'LOGO_WIDTH'			=> $this->config['site_logo_width'],

			'OVERRIDE_COLOUR'		=> $this->config['site_logo_override_colour'],

			'REMOVE_HEADER_BAR'		=> $this->config['site_logo_remove_header'],
			'REPEAT_BACKGROUND'		=> $this->config['site_logo_background_repeat'],

			'SEARCH_BELOW'			=> ((!$this->config['site_search_remove'] && $this->config['site_logo_site_name_below']) || $this->config['site_logo_move_search']) ? true : false,
			'SITE_DESCRIPTION'		=> $this->config['site_desc'],
			'SITE_LOGO_BACKGROUND'	=> $this->set_site_logo_url($this->config['site_logo_background_image']),
			'SITE_LOGO_BANNER'		=> $this->set_site_logo_url($this->config['site_logo_banner_url']),
			'SITE_LOGO_CENTRE'		=> ($this->config['site_logo_position'] == $this->constants['logo_position_center']) ? true : false,
			'SITE_LOGO_DESCRIPTION'	=> $this->config['site_desc'],
			'SITE_LOGO_IMG'			=> $site_logo_img,
			'SITE_LOGO_IMG_NEW'		=> $site_logo_img_new,
			'SITE_LOGO_LOGO_URL'	=> $this->set_site_logo_url($this->config['site_logo_logo_url']),
			'SITE_LOGO_REMOVE'		=> $this->config['site_logo_remove'],
			'SITE_LOGO_RESPONSIVE'	=> $this->config['site_logo_responsive'],
			'SITE_LOGO_RIGHT'		=> ($this->config['site_logo_position'] == $this->constants['logo_position_right']) ? true : false,
			'SITE_LOGO_SITENAME'	=> $this->config['sitename'],
			'SITE_NAME_BELOW'		=> $this->config['site_logo_site_name_below'],
			'SITENAME_SUPRESS'		=> ($this->config['site_name_supress'] || $this->config['site_logo_site_name_below']) ? true : false,
			'S_IN_SEARCH'			=> ($this->config['site_search_remove'] || $this->config['site_logo_site_name_below'] || $this->config['site_logo_move_search']) ? true : false,

			'USE_BACKGROUND'		=> ($this->config['site_logo_use_background'] && $this->config['site_logo_background_image']) ? true : false,
			'USE_BANNER'			=> ($this->config['site_logo_use_banner'] && $this->config['site_logo_banner_url']) ? true : false,
			'USE_HEADER_COLOUR'		=> ($this->config['site_logo_header']) ? true : false,
			'USE_LOGO_URL'			=> ($this->config['site_logo_logo_url']) ? true : false,
			'USE_OVERRIDE_COLOUR'	=> $this->config['site_logo_use_override_colour'],
		));
	}

	/**
	* Get the hex values for the gradient colours
	* This uses the same offsets as phpBB's prosilver where possible
	*
	* @return hex colour
	* @access protected
	*/
	protected function get_hex_colour($base_colour, $offset)
	{
		// If first character of hex colour is non numeric then gradient will not work so make all colours the same
		if ($this->config['site_logo_header_solid'] || (int) ord(substr($base_colour, 1, 1)) > 57 ) // a.k.a > 9
		{
			$offset_colour = $base_colour;
		}
		else
		{
			$base_colour 	= hexdec(ltrim($base_colour, '#'));
			$offset_colour	= '#' . dechex(($offset == 1) ? $base_colour + 5778196 : $base_colour - 1191226);
		}

		return $offset_colour;
	}

	/**
	* Set the remote or local url
	*
	* @return url
	* @access protected
	*/
	protected function set_site_logo_url($url)
	{
		return (strpos(strtolower($url), 'http') !== false) ? $url : append_sid($this->root_path . $url, false, false);
	}
}
