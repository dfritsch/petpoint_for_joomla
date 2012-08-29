<?php defined('_JEXEC') or die('Restricted access');



$params = &JComponentHelper::getParams( 'com_rescuegroups' );

$path = JURI::root() . "components/com_rescuegroups/assets/css/";

JHTML::stylesheet('search.css', $path);

?>





<?php if ($params->get('show_page_title')==1) : ?>

<h1><?php echo $params->get( 'page_title' ); ?></h1>

<?php endif; ?>





<form id="adminForm" action="<?php echo JRoute::_( 'index.php?view=browse&layout=browse&Itemid=26' );?>" method="post" name="adminForm">



<p><label for="name">Cat's Name: </label><input type="text" name="name" value="" /></p>

<!--<p><label for="color">Color Dropdown: </label><input type="text" name="color" value="" /></p>-->

<p><label for="primaryBreed">Breed Dropdown: </label><?php echo $this->breeds; ?></p>

<p><label for="coatLength">Fur Length Dropdown: </label><?php echo $this->coatLength; ?></p>

<p><label for="age">Age: </label><?php echo $this->age; ?></p>



<input type="submit" value="Search" name="submitSearch" id="animalSubmitSearch" />



<input type="hidden" name="search_vars" value="name,primaryBreed,coatLength,age" />

<!--<input type="hidden" name="Itemid" value="<?php echo JRequest::getVar('Itemid'); ?>" /-->

<input type="hidden" name="option" value="com_rescuegroups" />

<input type="hidden" name="referer" value="search" />

<input type="hidden" name="layout" value="browse" />

<input type="hidden" name="view" value="browse" />

<input type="hidden" name="task" value="search" />

<input type="hidden" name="boxchecked" value="0" />

</form>

