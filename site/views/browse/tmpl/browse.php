<?php defined('_JEXEC') or die('Restricted access');

$params = &JComponentHelper::getParams( 'com_rescuegroups' );
$path = JURI::root() . "components/com_rescuegroups/assets/css/";
JHTML::stylesheet('browse.css', $path);

$baselink = "index.php?view=detail&layout=detail&Itemid=35&id=";

//print_r (JRequest::get( 'post' ));
?>


<?php if ($params->get('show_page_title')==1) : ?>
<h1><?php echo $params->get( 'page_title' ); ?></h1>
<?php endif; ?>

<form id="adminForm" action="<?php echo JRoute::_( 'index.php' );?>" method="post" name="adminForm">
<div id="browse_animals">
	<?php
	$k = 0;
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)
	{
		$row = &$this->items[$i];
		//$checked 	= JHTML::_('grid.id',   $i, $row->id );
		//$link 		= JRoute::_( 'index.php?option=com_rescuegroups&controller=dewplayer&task=edit&cid[]='. $row->id );
		$link = JRoute::_($baselink . $row->id . ":" . strtolower($row->name));
		?>
		<div class="<?php echo "row$k"; ?>">
        	<!--<div class="animalID">
				ID: <span class="animal_data"><?php echo $row->animalID; ?></span>
			</div>-->
        	<div class="animal_name">
				<a href="<?php echo $link; ?>"><h2 class="animal_data"><?php echo $row->name; ?></h2></a>
			</div>
			<div class="animal_picture">
				<img src="<?php echo $row->pic1; ?>" width="200" />
			</div>
            <div class="animal_breed">
				Breed: <span class="animal_data"><?php echo html_entity_decode($row->breed);?></span>
			</div>
            <div class="animal_sex">
				Species / Sex: <span class="animal_data"><?php echo html_entity_decode($row->species);?> / <?php echo html_entity_decode($row->sex);?></span>
			</div>
		    <div class="animal_description">
				<span class="animal_data">
				<?php 
					$description = $row->description;
					$length = 350;
					
					if (strlen($description)>$length) {
						$description = substr($description, 0, $length);
						$q=0;
						while (substr($description, -1)!=" ") {$description = substr($description,0,-1); $q++; if($q>20) {break;}}
						$description.= " ...";
					}
					
					echo $description;
				?>
                </span>
            </div>
            <div class="animal_read_more">
            	<a href="<?php echo $link; ?>"><p>Read More &raquo;</p></a>
            </div>
            <div class="clr"></div>
		</div>
		<?php
		$k = 1 - $k;
	}
	?>
	<div class="pagination">
      	<?php echo $this->pagination->getListFooter(); ?>
	</div>
</div>
<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
<input type="hidden" name="option" value="com_rescuegroups" />
<input type="hidden" name="view" value="browse" />
<input type="hidden" name="task" value="" />
<input type="hidden" name="boxchecked" value="0" />
</form>