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
	
	function getUpdate() {
		$db =& JFactory::getDBO();

		$startPage=1;
		$limit=10;
		$updated=0;
		
		$query = "SELECT max(lastupdated) FROM #__rescuegroups;";
		$db->setQuery($query);
		$lastupdated= $db->loadResult();
		$lastupdated=strtotime($lastupdated)+1;
		
		//echo $query;
		
		do {
			
			$get = "http://api.rescuegroups.org/rest/?key=A0ey0Ed1&status=adopted&type=animals&orgID=98&limit=".$limit."&startPage=".$startPage;
			if ($lastupdated!=1) {
				//$get.="&updatedAfter=".$lastupdated;
			}
			
			echo $get;
		
		$xml = file_get_contents($get);
		
		$query = "DESCRIBE #__rescuegroups;";
		$db->setQuery($query);
		$column= $db->loadResultArray();
		
		$myFile = "animals.xml";
		$fh = fopen($myFile, 'w');
		fwrite($fh, $xml);
		fclose($fh);
		
		$doc = new DOMDocument(); 
		$doc->load( $myFile ); 
		
		$recordcounttag = $doc->getElementsByTagName( "recordCount" ); 
		$recordcount = $recordcounttag->item(0)->nodeValue;
		$updated+=$recordcount;
		   
		$pets = $doc->getElementsByTagName( "pet" ); 
		foreach( $pets as $pet ) 
		{ 
			$i=1;
			$query="UPDATE #__rescuegroups SET ";
			while ($i<count($column)) {
				//echo $column[$i]."<br>";
				$tag = $pet->getElementsByTagName( $column[$i] );
				$value = $tag->item(0)->nodeValue;
				
				if ($column[$i]=='lastUpdated') {
					$value = strftime("%Y-%m-%d %H:%M:%S", $value);
				} elseif ($column[$i]=='description') {
					$w = "[\s\S]*?"; //ungreedy wildcard
					$value = preg_replace("/(\<a $w \/\>\<br \/\>|\<img $w \/\>|\<(span|SPAN) $w\>|\<\/*(span|SPAN|strong|STRONG)\>)/", "", $value);
					$value = strip_tags($value, '<p>');
					$value = str_replace("&amp;nbsp;", " ", $value);
				}
				
				$query.= "`" . $column[$i] . "`='" . mysql_real_escape_string($value) . "', ";
				
				if ($column[$i]=='animalID') {
					$where = "`animalID`='".$value."'";
				}
				
				$i++;
			}
			$query = substr($query, 0, -2);
			$querywhere = $query . " WHERE " . $where. ";";
			$db->setQuery($querywhere);
			$result = $db->query();
			
			$rows = $db->getAffectedRows();
			//echo "Rows: " . $rows . "<br>";
			//$error = $db->getErrorMsg();
			//echo "Error: " . $error . "<br>";
			
			if ($rows==0) {
				$query = str_replace("UPDATE", "INSERT INTO", $query);
				$db->setQuery($query);
				$result = $db->query();
			}
			
			$rows = $db->getAffectedRows();
			//echo "Rows: " . $rows . "<br>";
			//$error = $db->getErrorMsg();
			//echo "Error: " . $error . "<br>";
		} 
		
		//echo "Page: ".$startPage."<br>";
		//echo "Animals Updated: " . $updated . "<br>";
		
		$startPage++;
		
		} while($recordcount!=0);
		
		$query = "SELECT id FROM #__rescuegroups WHERE status!='Available' AND status!='Adopted'";
		$db->setQuery($query);
		$deleted= $db->loadResultArray();
		
		foreach($deleted as $delete) {
			$query = "DELETE FROM #__rescuegroups WHERE id='$delete'";
			$db->setQuery($query);
			$dummy = $db->query();
		}
		
		return $updated;
		
	}
}
?>