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



jimport('joomla.application.component.model');



/**

 * Rescue Groups Component Rescue Groups Model

 *

 * @author      notwebdesign

 * @package		Joomla

 * @subpackage	Rescue Groups

 * @since 1.5

 */

class RescuegroupsModelSearch extends JModel {

    /**

	 * Constructor

	 */

	function __construct() {

		parent::__construct();

	}

	

	function getAPIkey() {

		return "6taSaBRe";

	}

	

	function _buildSelect($data, $title) {

		$select = "<select name='$title' id='$title'><option value=''></option>";

		

		foreach ($data as $option) {

			if ($option) {

				$select .= "<option value='$option'>$option</option>";

			}

		}

		

		$select .= "</select>";

		

		return $select;

	}

	

	function getBreeds() {

		$breed_result = '';

		

		$query = 'SELECT DISTINCT(primaryBreed) '

        . ' FROM #__rescuegroups WHERE status="Available"';

		$this->_db->setQuery($query);

        $this->_breeddata = $this->_db->loadResultArray();

		

		$breed_result = $this->_buildSelect($this->_breeddata,'primaryBreed');

		

		return $breed_result;

	}

	

	function getCoatLength() {

		$coat_result = '';

		

		$query = 'SELECT DISTINCT(coatLength) '

        . ' FROM #__rescuegroups WHERE status="Available"';

		$this->_db->setQuery($query);

        $this->_coatdata = $this->_db->loadResultArray();

		

		$coat_result = $this->_buildSelect($this->_coatdata,'coatLength');

		

		return $coat_result;

	}

	

	function getAge() {

		$age_result = '';

		

		$query = 'SELECT DISTINCT(age) '

        . ' FROM #__rescuegroups WHERE status="Available"';

		$this->_db->setQuery($query);

        $this->_agedata = $this->_db->loadResultArray();

		

		$age_result = $this->_buildSelect($this->_agedata,'age');

		

		return $age_result;

	}

	

	function _buildContentOrderBy()

	{

	global $mainframe, $option;

 

		$orderby = '';

		$filter_order     = $this->getState('filter_order');

		$filter_order_Dir = $this->getState('filter_order_Dir');

 

		/* Error handling is never a bad thing*/

		if(!empty($filter_order) && !empty($filter_order_Dir) ){

			$orderby = ' ORDER BY '.$filter_order.' '.$filter_order_Dir;

		}

 

		return $orderby;

	}

	

	/**

     * Returns the query

     * @return string The query to be used to retrieve the rows from the database

     */

    function _buildQuery()

    {

        $query = 'SELECT * '

        . ' FROM #__rescuegroups WHERE status="Available"';

		

		

		$orderby = $this->_buildContentOrderBy();

		if(!empty($orderby)) {

			$query.=$orderby;

		}



        return $query;

    }

	

	function getData() {

		// if data hasn't already been obtained, load it

		if (empty($this->_data)) {

			$query = $this->_buildQuery();

			$this->_data = $this->_getList($query, $this->getState('limitstart'), $this->getState('limit'));	

		}

		return $this->_data;

	}

}

?>