<?php
defined('_JEXEC') or die('Restricted access');
JToolBarHelper::title(JText::_('Rescue Groups - Animal Database'), 'generic.png');
JToolBarHelper::cancel( 'cancel', 'Close');
?>
<form id="adminForm" action="<?php echo JRoute::_( 'index.php' );?>" method="post" name="adminForm">
<h1>Update Database</h1>
<p>Animals Updated: <?php echo $this->updated; ?></p>

<div id="petDesc">
<h1> UPDATING DESCRIPTIONS - DO NOT LEAVE THIS PAGE! </h1>
<p class="descUpdated">Descriptions Updated: <span class="descNum">0</span></p>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
<script>
jQuery(document).ready(function($) {
	$(document).bind('ajaxCall', function() {
		$.ajax('index.php?option=com_rescuegroups&view=update&task=updateDesc&controller=rescuegroups',{
			success: function (data) {
				descDone = parseInt($('.descNum').text()) + parseInt(data);
				$('.descNum').text(descDone);
				if (data!='0') {
					$(document).trigger('ajaxCall');
				} else {
					$('.petDesc h1').text('Update Descriptions');
					alert ("DONE!");
				}
			}
		});
	});
	
	$(document).trigger('ajaxCall');
});
</script>

<input type="hidden" name="option" value="com_rescuegroups" />
<input type="hidden" name="task" value="" />
</form>