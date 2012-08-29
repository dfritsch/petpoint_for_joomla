<?php
/**
 * Joomla! 1.5 component Rescue Groups
 *
 * @version $Id: rescuegroups.php 2011-06-03 14:15:09 svn $
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
 * Define constants for all pages
 */
define( 'COM_RESCUEGROUPS_DIR', 'images'.DS.'rescuegroups'.DS );
define( 'COM_RESCUEGROUPS_BASE', JPATH_ROOT.DS.COM_RESCUEGROUPS_DIR );
define( 'COM_RESCUEGROUPS_BASEURL', JURI::root().str_replace( DS, '/', COM_RESCUEGROUPS_DIR ));

// Require the base controller
require_once JPATH_COMPONENT.DS.'controller.php';

// Require the base controller
require_once JPATH_COMPONENT.DS.'helpers'.DS.'helper.php';

// Initialize the controller
$controller = new RescuegroupsController( );

// Perform the Request task
$controller->execute( JRequest::getCmd('task'));
$controller->redirect();
?>