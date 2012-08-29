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

class RescuegroupsModelBrowse extends JModel {

	/**

     * Rescuegroups id

     *

     * @var in

     */

    var $_id = null;

	

	/**

	* Items total

	* @var integer

	*/

	var $_total = null;

	

	/**

	* Pagination object

	* @var object

	*/

	var $_pagination = null;

	

	/**

	* Database array

	* @var object

	*/

	var $_data;

	

    /**

	 * Constructor

	 */

	function __construct() {

		parent::__construct();

		global $mainframe, $option;

 

		// Get pagination request variables

		$limit = $mainframe->getUserStateFromRequest('global.list.limit', 'limit', $mainframe->getCfg('list_limit'), 'int');

		$limitstart = JRequest::getVar('limitstart', 0, '', 'int');

	 

		// In case limit has been changed, adjust it

		$limitstart = ($limit != 0 ? (floor($limitstart / $limit) * $limit) : 0);

	 

		$this->setState('limit', $limit);

		$this->setState('limitstart', $limitstart);

		

		$referer = JRequest::getVar('referer', 'browse');

		if ($referer == 'search') {

			$filter_order = 'name';

		} else {

			$filter_order = '';

		}

		

		//$filter_order     = $mainframe->getUserStateFromRequest(  $option.'filter_order', 'filter_order', 'name', 'cmd' );

		$filter_order_Dir = $mainframe->getUserStateFromRequest( $option.'filter_order_Dir', 'filter_order_Dir', 'asc', 'word' );

		

		$this->setState('filter_order', $filter_order);

		$this->setState('filter_order_Dir', $filter_order_Dir);

    }

	

	/**

     * Method to set the Browse identifier

     *

     * @access  public

     * @param   int Browse identifier

     * @return  void

     */

    function setId($id)

    {

        //-- Set id and wipe data

        $this->_id = $id;

        $this->_data = null;

    }//function

	

	

	/**

     * Method to set the orderby for SQL query

     *

     * @access  restricted

     * @param   none

     * @return  order by string

     */

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

        . ' FROM #__rescuegroups';
		
		
		$menuId = JRequest::getVar('Itemid');
		$menu =   &JSite::getMenu();
		$item = $menu->getItem($menuId);
		$params = new JParameter($item->params);
		$status = $params->get('animal_type');
		
		if ($status == 1) {
			$where = ' WHERE `status`="Available" AND ';
		} elseif ($status==2) {
			$where = ' WHERE `status`="Adopted" AND ';
		} elseif ($status==3) {
			$where = ' WHERE (`status`="Available" OR `status`="Pending" OR `status`="Adopted") AND ';
		} else {
			$where = ' WHERE (`status`="Available" OR `status`="Pending") AND ';
		}

		if ($searchvars = JRequest::getVar( 'search_vars', '', 'post' )) {

			$svars = explode(',', $searchvars);

			foreach ($svars as $svar) {

				if ($svalue = JRequest::getVar( $svar, '', 'post' )) {

					$where.='`'.$svar.'` LIKE \'%'.$svalue.'%\' AND ';

				}

			}

		}
		
		$where = substr($where, 0, -5);

		$query = $query.$where;

		

		$orderby = $this->_buildContentOrderBy();

		if(!empty($orderby)) {

			$query.=$orderby;

		}

		

		//echo $query;



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

	

	function getTotal() {

		// Load the content if it doesn't already exist

		if (empty($this->_total)) {

			$query = $this->_buildQuery();

			$this->_total = $this->_getListCount($query);	

		}

		return $this->_total;

	}

	

	function getPagination() {

		// Load the content if it doesn't already exist

		if (empty($this->_pagination)) {

			jimport('joomla.html.pagination');

			$this->_pagination = new JPagination($this->getTotal(), $this->getState('limitstart'), $this->getState('limit') );

		}

		return $this->_pagination;

	}

	

	function getAPIkey() {

		return "6taSaBRe";

	}

}

?>