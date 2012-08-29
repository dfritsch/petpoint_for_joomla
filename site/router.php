<?php

/**

 * Joomla! 1.5 component Rescue Groups

 *

 * @version $Id: router.php 2011-06-03 14:15:09 svn $

 * @author Fritsch Services

 * @package Joomla

 * @subpackage Rescue Groups

 * @license GNU/GPL

 *

 * A Joomla component to display animals from RescueGroups.org's Database. It can be configured to show all animals or specifically for a shelter or organization.

 *

 * This component file was created using the Joomla Component Creator by Not Web Design

 * http://www.notwebdesign.com/joomla_component_creator/

 *

 */



// no direct access

defined('_JEXEC') or die('Restricted access');



/*

 * Function to convert a system URL to a SEF URL

 */

function RescuegroupsBuildRoute(&$query) {
	
	$segments = array();
	if(isset( $query['view'] ) && $query['view']!='rescuegroups')
	{
			$segments[] = $query['view'];
			if(isset( $query['layout'] )) {
				if ($query['view']!=$query['layout']) {
					$segments[] = $query['layout'];
				}
				unset( $query['layout'] );
			}
	};
	if( isset($query['id']) )
	{
			$segments[] = $query['id'];
			unset( $query['id'] );
	};
	unset( $query['view'] );
	return $segments;
}

/*

 * Function to convert a SEF URL back to a system URL

 */

function RescuegroupsParseRoute($segments) {

	$vars = array();
	$app =& JFactory::getApplication();
	$menu =& $app->getMenu();
	$item =& $menu->getActive();
	// Count segments
	$count = count( $segments );
	//print_r($item);
	//print_r($count);
	//Handle View and Identifier
	switch( $item->query['view'] )
	{
		case 'rescuegroups':
			$vars['view'] = $segments[0];
			if($count == 1) {
				   $vars['layout'] = $segments[0];
			}
			if($count == 2) {
				   $vars['layout'] = $segments[1];
			}
			break;
		case 'browse':
			$vars['view'] = 'browse';
			$vars['layout'] = 'browse';
			break;
		case 'search':
			$vars['view'] = 'search';
			$vars['layout'] = 'search';
			break;
		case 'detail':
			$vars['view'] = $segments[0];
			if($count == 2) {
				   $vars['layout'] = $segments[0];
			}
			if($count == 3) {
				   $vars['layout'] = $segments[1];
			}
			$id   = explode( ':', $segments[$count-1] );
			$vars['id']   = (int) $id[0];
			break;
		case 'category':
				   $id   = explode( ':', $segments[$count-1] );
				   $vars['id']   = (int) $id[0];
				   $vars['view'] = 'article';
				   break;
	}
	//print_r($vars);
	return $vars;

}

?>