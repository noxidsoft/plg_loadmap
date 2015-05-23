<?php
/*------------------------------------------------------------------------
# plg_loadmap - Content - Load map
# ------------------------------------------------------------------------
# author    Noxidsoft
# copyright Copyright (C) 2012 Noxidsoft. All Rights Reserved.
# @license - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.noxidsoft.com
# Technical Support:  http://www.noxidsoft.com/
-------------------------------------------------------------------------*/

// no direct access
defined('_JEXEC') or die;

class plgContentLoadmap extends JPlugin
{	
	public function onContentPrepare($context, &$article, &$params, $page = 0)
	{
		// Don't run this plugin when the content is being indexed
		if ($context == 'com_finder.indexer') {
			return true;
		}
		
		// simple performance check to determine whether bot should process further
		if (strpos($article->text, 'loadmap') === false) {
			return true;
		}
		
		$mapMode 		= $this->params->def('mapMode', 0);
		$mapState 	= $this->params->def('mapState');
		$mapCountry = $this->params->def('mapCountry');
		
		$regex		= '/{loadmap\s+(.*?)}/i';
		preg_match_all($regex, $article->text, $matches, PREG_SET_ORDER);

		// No matches, skip this
		if ($matches) {
			foreach ($matches as $match) {
				
				$mapAddress = '';			// declare it to be safe
				
				if ($mapState != '') {
					$mapAddress .= ',+'.$mapState;
				}
				
				if ($mapCountry != '') {
					$mapAddress .= ',+'.$mapCountry;
				}
				
				// link icon only
				if ($mapMode == 0) {
					$output = $match[1].'<a href="http://maps.google.com.au/maps?q='.implode("+",explode(" ",$match[1])).$mapAddress.'" target="_blank"><img style="padding-left:5px;" src="plugins/content/loadmap/images/map.gif" alt="Map" /></a>';
				}
				
				// link text only
				if ($mapMode == 1) {
					$output = '<a href="http://maps.google.com.au/maps?q='.implode("+",explode(" ",$match[1])).$mapAddress.'" target="_blank">'.$match[1].'</a>';
				}
				
				// link both
				if ($mapMode == 2) {
					$output = '<a href="http://maps.google.com.au/maps?q='.implode("+",explode(" ",$match[1])).$mapAddress.'" target="_blank">'.$match[1].'<img style="padding-left:5px;" src="plugins/content/loadmap/images/map.gif" alt="Map" /></a>';
				}
				
				$article->text = preg_replace("|$match[0]|", addcslashes($output, '\\'), $article->text, 1);
				
			}
		}
	}
}
