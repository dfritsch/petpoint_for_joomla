<?php defined('_JEXEC') or die('Restricted access');

$params = &JComponentHelper::getParams( 'com_rescuegroups' );

$browselink = JRoute::_( 'index.php?view=browse&layout=browse&Itemid=26' );
$searchlink = JRoute::_( 'index.php?view=search&layout=search' );
?>

<div class="mod_rescuegroups" style="float:right; margin: 0 2em;">
   <?php
   $document = &JFactory::getDocument();
   $document->addStyleSheet(JURI::base( true ).'/modules/mod_rescuegroups/css/rescuegroups.css');
   $db =& JFactory::getDBO();
   
   $query = 'SELECT * '
        . ' FROM #__rescuegroups'
		. ' ORDER BY RAND()'
		. ' LIMIT 1';
	
	//echo $query;
	
	$db->setQuery($query);
	$row = $db->loadAssoc();
	//print_r($row);
   
   			$baselink = "index.php?option=com_rescuegroups&view=detail&layout=detail&Itemid=35&id=";
            $link = JRoute::_($baselink . $row['id']);
			?>
            <a href="<?php echo $link; ?>">
    		<div class="mod_animal_name">
				<h2 class="animal_data"><?php echo $row['name']; ?></h2>
			</div>
			<div class="mod_animal_picture">
				<img src="<?php echo $row['pic1']; ?>" width="200" />
			</div>
            <div class="mod_animal_breed">
				<span class="animal_data"><?php echo html_entity_decode($row['breed']);?></span>
			</div>
            <div class="mod_animal_click">Click to see more info!</div>
            </a>
</div>
<?php if ($params->get('show_page_title')==1) : ?>
<h1><?php echo $params->get( 'page_title' ); ?></h1>
<?php endif; ?>
<div id="rescuegroups_overview"> 
	<p>There are currently <?php echo $this->available; ?> animals available for adoption.</p>
    
    <p><a href="<?php echo $browselink; ?>">Browse Available Animals.</a></p>
    
    <p><a href="<?php echo $searchlink; ?>">Search Available Animals.</a></p>
</div>
