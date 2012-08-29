<?php
/**
 * Joomla! 1.5 component Rescue Groups
 *
 * @version $Id: view.html.php 2011-06-03 14:15:09 svn $
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

// Import Joomla! libraries
jimport( 'joomla.application.component.view');
class RescuegroupsViewUpdate extends JView {
    function display($tpl = null) {
		
		if (JRequest::getVar('task') =='updateDesc') {
			$updated =& $this->get('UpdateDesc');
			echo $updated;
			exit();
		} else {
			$updated =& $this->get('Update');
		}
		
		$this->assignRef( 'updated', $updated );
		
        parent::display($tpl);
    }
}
?>