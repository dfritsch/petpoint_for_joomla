<?php
defined('_JEXEC') or die('Restricted access');
JToolBarHelper::title(JText::_('Rescue Groups - Animal Database'), 'generic.png');
JToolBarHelper::cancel( 'cancel', 'Close');
?>
<form id="adminForm" action="<?php echo JRoute::_( 'index.php' );?>" method="post" name="adminForm">
<h1>Update Database</h1>
<p>Animals Updated: <?php echo $this->updated; ?></p>

<input type="hidden" name="option" value="com_rescuegroups" />
<input type="hidden" name="task" value="" />
</form>