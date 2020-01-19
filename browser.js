function getBrowser()
	{
		var browser = '';

		// Do not change the order of these
		if (navigator.userAgent.indexOf('OPR') > -1)
		{
			return browser = 'Opera';
		}
		if (navigator.userAgent.indexOf('Maxthon') > -1)
		{
			return browser = 'Maxthon';
		}
		if (navigator.userAgent.indexOf('Edge') > -1)
		{
			return browser = 'Edge';
		}
		if(navigator.userAgent.indexOf('Chrome') > -1)
		{
			return browser = 'Chrome';
		}
		if (navigator.userAgent.indexOf('Firefox') > -1)
		{
			return browser = 'Firefox';
		}
		if (navigator.userAgent.indexOf('MSIE') > -1)
		{
			return browser = 'IE';
		}
		if (navigator.userAgent.indexOf('Trident') > -1)
		{
			return browser = 'IE-11';
		}
		if (navigator.userAgent.indexOf('Safari') > -1)
		{
			return browser = 'Safari';
		}
	}
	