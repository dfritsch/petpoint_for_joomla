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

// Import Joomla! libraries
jimport('joomla.application.component.model');

class RescuegroupsModelUpdate extends JModel {
    function __construct() {
		parent::__construct();
		
		global $mainframe, $option;
		
    }
	
	function crawl_animals($url) {
		$updated = 0;
		$ids = array();
		
		$db =& JFactory::getDBO();
		$dom = new DOMDocument('1.0');
		@$dom->loadHTMLFile($url);
		
		$finder = new DomXPath($dom);
		$classname="list-item";
		$nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");
		
		foreach ($nodes as $count=>$item) {
						
			$newdoc = new DOMDocument();
			$cloned = $item->cloneNode(TRUE);
			$newdoc->appendChild($newdoc->importNode($cloned,TRUE));
			
			$animal = new DomXPath($newdoc);
			$info = array();
			
			$info['name'] = $this->classQuery($animal, 'list-animal-name');
			$info['id'] = $this->classQuery($animal, 'list-animal-id');
			$info['species'] = $this->classQuery($animal, 'list-anima-species');
			$info['sexSN'] = $this->classQuery($animal, 'list-animal-sexSN');
			$info['breed'] = $this->classQuery($animal, 'list-animal-breed');
			$info['age'] = $this->classQuery($animal, 'list-animal-age');
			
			$anchors = $newdoc->getElementsByTagName('a');
			
			foreach ($anchors as $a) {
				$info['url'] = str_replace('\')', '', str_replace('javascript:poptastic(\'', 'http://www.petango.com/webservices/adoptablesearch/', $a->getAttribute('href')));
			}
			
			$pics = $newdoc->getElementsByTagName('img');
			
			foreach ($pics as $key => $p) {
				$info['pic'][] = $p->getAttribute('src');
			}
			
			$query = "SELECT id FROM #__rescuegroups WHERE animalID=".$db->quote($info['id']);
			$db->setQuery($query);
			$exists= $db->loadAssocList();
			
			$query = '';
			
			if ($exists) {
				$query = "UPDATE";
				$where = ' WHERE id='.$db->quote($exists[0]['id']);
				$ids[] = $exists[0]['id'];
				$insertid = false;
			} else {
				$query = "INSERT INTO";
				$where = '';
				$insertid = true;
			}
			
			$query .= " #__rescuegroups SET name=".$db->quote($info['name']).", animalID=".$db->quote($info['id']).", species=".$db->quote($info['species']).", sex=".$db->quote($info['sexSN']).", breed=".$db->quote($info['breed']).", age=".$db->quote($info['age']).", description=".$db->quote($info['desc']).", petUrl=".$db->quote($info['url']).", status='Available'";
			
			foreach ($info['pic'] as $key => $pic) {
				if ($key>3) {
					break;
				}
				$query .= ', pic'.($key+1).'='.$db->quote($pic);
			}
			$query .= $where;
			//echo $query;
			$db->setQuery($query);
			$result = $db->query();
			if ($insertid) {
				$ids[] = $db->insertid();
			}
			
			$updated++;
		}
		
		$query = "UPDATE #__rescuegroups SET status='Unknown' WHERE id NOT IN (".implode(',',$ids) . ") AND status='Available'";
		$db->setQuery($query);
		$dummy = $db->query();
		
		return $updated;
	}
	
	function classQuery($domxpath, $classname, $type='value') {
		$query = $domxpath->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");
		
		foreach ($query as $count=>$i) {
			if ($count==0) {
				//var_dump($item);
				if ($type=='html') {
					$newdoc = new DOMDocument();
					$cloned = $i->cloneNode(TRUE);
					$newdoc->appendChild($newdoc->importNode($cloned,TRUE));
					$string = $newdoc->saveHTML();
				} else {
					$string = $i->nodeValue;
				}
			}
		}
		return $string;
	}
	
	function getUpdate() {

		$url = "http://www.petango.com/webservices/adoptablesearch/wsAdoptableAnimals.aspx?species=Cat&sex=A&agegroup=All&location=shelter&site=&onhold=N&orderby=Random&colnum=1&css=http://sms.petpoint.com/WebServices/adoptablesearch/css/styles.css&authkey=olu7f2to8a3fyhfwvei2ousjhrrh8ghlslmpytmd0wytxohkw4&recAmount=&detailsInPopup=Yes&featuredPet=Include&stageID=";
		
		$updated = $this->crawl_animals($url);
		
		return $updated;
		
	}
	
	function getUpdateDesc() {
		$updated = 0;
		$db =& JFactory::getDBO();
		$query = "SELECT * FROM #__rescuegroups WHERE status='Available' AND petUrl != '' LIMIT 25";
		$db->setQuery($query);
		$urls = $db->loadAssocList();
		
		foreach ($urls as $url) {
			$dom = new DOMDocument('1.0');
			@$dom->loadHTMLFile($url['petUrl']);
			
			$finder = new DomXPath($dom);
			$info['desc'] = $this->classQuery($finder, 'detail-animal-desc', 'html');
			
			$query = "UPDATE #__rescuegroups SET description=".$db->quote($info['desc']).", petUrl='' WHERE id=".$db->quote($url['id']);
			
			//echo $query;
			$db->setQuery($query);
			$result = $db->query();
			$updated++;
		}
		return $updated;
	}
}
?>