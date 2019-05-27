;(function($, document) {
	'use strict';

	$(document).ready(function ()
	{
		// Remove logo if using mobile device
		if ($(window).width() <= 700 && responsive == true)
		{
			$('span').removeClass('site_logo');
			$('#site-description p').remove();
			$('#site-description a').remove();
		}
		else
		{
			$('a .site_logo').css({
				'background-image': siteLogo,
				'background-repeat': 'no-repeat',
				'background-position': '0% 0%',
				'background-size': '100%',
				'max-width': '100%',
				'height': logoHeight + 'px',
				'width': logoWidth + 'px',
				'border-radius': logoCorners,
			});
		}

		var headBgColour	= '';
		var h1Colour		= '';
		var pColour			= '';
		var bgImage			= '';

		// Replicate the style colours and background image in the new site logo css
    	headBgColour	= $('.headerbar').css('background-color');
		h1Colour		= $('h1').css('color');
		pColour			= $('p').css('color');
		bgImage			= $('.headerbar').css('background-image');

		$('.sl-headerbar').css('background-color', headBgColour);
		$('#sl-new-desc h1').css('color', h1Colour);
		$('#sl-new-desc p').css('color', pColour);
		$('.sl-headerbar').css('background-image', bgImage);

		// Set the custom headerbar colours but not if the header bar is removed
		if (useHeaderColour == true && removeHeaderBar == false)
		{
			$('.headerbar').css({
				'background-color': headerColour,
				'background-image': 'linear-gradient(to bottom, ' + headerColour1 + ' 0%, ' + headerColour2 + ' 2px, ' + headerColour + ' 92px, ' +  headerColour + ' 100%)',
				'background-repeat': 'repeat-x',
			});
		}

		// Use the Site Logo banner
		if (useBanner == true)
		{
			$('.headerbar').css({
				'display': 'none !important',
				'background': 'url("' + siteLogoBanner + '") ' + 'no-repeat',
				'height': bannerHeight + 'px',
				'max-width': '100%',
				'width': $(window).width(),
				'text-align': 'center',
				'border-radius': borderRadius + 'px'
			});
    	}

		// Remove the header bar
		if (removeHeaderBar == true )
		{
			$('div').removeClass('headerbar');
		}

		// Use the override text colour to replace the default in the header
		if (useOverrideColour == true)
		{
			$('#site-description h1').css('color', overrideColour);
			$('#site-description p').css('color', overrideColour);
			$('#sl-new-desc h1').css('color', overrideColour);
			$('#sl-new-desc p').css('color', overrideColour);
    	}

		// Remove the site name and description
		if (siteNameSupress  == true)
		{
			// Don't remove the site name on a mobile device
			if ($(window).width() > 700 || responsive == false)
			{
				//$('#site-description h1').css('display', 'none');
				$('#site-description h1').remove();
			}
			//$('#site-description p').css('display', 'none');
			$('#site-description p').remove();
    	}

		// Use a different link for the logo than for breadcrumbs
		if (useLogoUrl == true )
		{
			$('#logo').attr('href', siteLogoUrl);
		}

		// Remove site logo
		if (siteLogoRemove == true )
		{
			$('span').removeClass('site_logo');
		}

		// Place the site logo (and text) in the centre
		if (siteLogoCentre == true)
		{
			$('#site-description').css({
				'padding-top': '10px',
				'text-align': 'center',
				'width': '100%'
			});

			$('#site-description .logo').css('float', 'none');

			$('.search-header').css('margin-top', '-40px');

			$('#sl-new-desc h1').css({
				'text-align': 'center',
				'width': '100%'
			});

			$('#sl-new-desc p').css({
				'text-align': 'center',
				'width': '100%'
			});
    	}

		// Place the site logo on the right
		if (siteLogoRight == true)
		{
			$('#site-description').css({
				'text-align': 'right',
				'width': '100%',
				'margin-left': '10px'
			});

			$('#site-description .logo').css({
				'float': 'right',
				'margin-right': '10px'
			});

			$('#sl-new-desc h1').css({
				'clear': 'both',
				'float': 'right',
				'margin-right': '10px'
			});

			$('#sl-new-desc p').css({
				'clear': 'both',
				'float': 'right',
				'margin-right': '10px'
			});

			if (searchBelow != true)
			{
				$('.search-header').css({
					'float': 'left',
					'margin-top': '-10px',
					'margin-left': '10px'
				});
			}
    	}

		// Move the search box to the top nav bar
		if (searchBelow == true)
		{
			$('.search-header').css({
				'float': 'right',
				'margin-top': '5px',
				'box-shadow': 'none'
			});
    	}

		// Use background image
		if (useBackground == true)
		{
			$('html, body').css({
				'background-position': 'center center',
				'background-image': 'url("' + backgroundImage + '")',
				'background-attachment': 'fixed',
				'background-repeat': 'repeat',
			});

			if (repeatBackground == false)
			{
				$('html, body').css({
					'background-repeat': 'no-repeat',
					'background-size': 'cover',
				});
			}
		}
	})

})(jQuery, document);
