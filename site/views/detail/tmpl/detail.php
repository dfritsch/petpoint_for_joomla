<?php defined('_JEXEC') or die('Restricted access');

$params = &JComponentHelper::getParams( 'com_rescuegroups' );
$path = JURI::root() . "components/com_rescuegroups/assets/css/";
JHTML::stylesheet('detail.css', $path);
?>


<?php if ($params->get('show_page_title')==1) : ?>
<h1><?php echo $params->get( 'page_title' ); ?></h1>
<?php endif; ?>
<p style="float:right; display:none;">Return to ...</p>


<?php

for ($i=0, $n=count( $this->items ); $i < $n; $i++)
	{
		$row = &$this->items[$i];
		//$checked 	= JHTML::_('grid.id',   $i, $row->id );
		//$link 		= JRoute::_( 'index.php?option=com_rescuegroups&controller=dewplayer&task=edit&cid[]='. $row->id );
		//$link = $baselink . $row->id;
		$document = JFactory::getDocument();
		$title = $document->getTitle();
		$document->setTitle( $row->name . ' - ' . $title );
		?>
		<div class="animal_detail">
				<h1 class="animal_name"><?php echo html_entity_decode($row->name); ?></h1>
            <div class="animalID" style="display:none;">
				ID: <span class="animal_data"><?php echo html_entity_decode($row->animalID); ?></span>
			</div>
			<div class="animal_picture">
				<img src="<?php echo html_entity_decode($row->pic1); ?>" width="300px" />
			</div>
            <div class="animal_breed">
				Breed: <span class="animal_data"><?php echo html_entity_decode(html_entity_decode($row->breed)); ?></span>
			</div>
            <div class="animal_sex">
				Species / Sex: <span class="animal_data"><?php echo html_entity_decode(html_entity_decode($row->species)); ?> / <?php echo html_entity_decode(html_entity_decode($row->sex)); ?></span>
			</div>
            <div class="animal_status">
				Status: <span class="animal_data"><?php echo html_entity_decode($row->status); ?></span>
            </div>
            <div class="animal_age">
            	Age: <span class="animal_data"><?php echo html_entity_decode($row->age); ?></span>
            </div>
		    <div class="animal_description">
				<span class="animal_data">
				<?php echo html_entity_decode($row->description); ?>
                </span>
            </div>
			
            <h2>Additional Information</h2>
            <ul class="animal_attributes">
            <?php
            if ($dogs=$row->dogs) { echo html_entity_decode("<li>Good with Dogs: $dogs</li>"); }
			if ($cats=$row->cats) { echo html_entity_decode("<li>Good with Cats: $cats</li>"); }
			if ($kids=$row->kids) { echo html_entity_decode("<li>Good with Kids: $kids</li>"); }
			if ($declawed=$row->declawed) { echo html_entity_decode("<li>Declawed: $declawed</li>"); }
			if ($housetrained=$row->housetrained) { echo html_entity_decode("<li>Housetrained: $housetrained</li>"); }
			if ($specialNeeds=$row->specialNeeds) { echo html_entity_decode("<li>Special Needs: $specialNeeds</li>"); }
			if ($altered=$row->altered) { echo html_entity_decode("<li>Spay/Neutered: $altered</li>"); }
			if ($size=$row->size) { echo html_entity_decode("<li>Size: $size</li>"); }
			if ($uptodate=$row->uptodate) { echo html_entity_decode("<li>Up To Date on Vaccines: $uptodate</li>"); }
			if ($color=$row->color) { echo html_entity_decode("<li>Color: ".html_entity_decode($color)."</li>"); }
			if ($coatLength=$row->coatLength) { echo html_entity_decode("<li>Coat Length: $coatLength</li>"); }
			if ($pattern=$row->pattern) { echo html_entity_decode("<li>Pattern: $pattern</li>"); }
			//if ($courtesy=$row->courtesy) { echo html_entity_decode("<li>Courteous: $courtesy</li>"); }
			if ($oKWithAdults=$row->oKWithAdults) { echo html_entity_decode("<li>OK With Adults: $oKWithAdults</li>"); }
			if ($obedienceTraining=$row->obedienceTraining) { echo html_entity_decode("<li>Obedience Training: $obedienceTraining</li>"); }
			if ($ownerExperience=$row->ownerExperience) { echo html_entity_decode("<li>Owner Experience: $ownerExperience</li>"); }
			if ($exerciseNeeds=$row->exerciseNeeds) { echo html_entity_decode("<li>Exercise Needs: $exerciseNeeds</li>"); }
			if ($energyLevel=$row->energyLevel) { echo html_entity_decode("<li>Energy Level: $energyLevel</li>"); }
			if ($activityLevel=$row->activityLevel) { echo html_entity_decode("<li>Activity Level: $activityLevel</li>"); }
			if ($earType=$row->earType) { echo html_entity_decode("<li>Ear Type: $earType</li>"); }
			if ($eyeColor=$row->eyeColor) { echo html_entity_decode("<li>Eye Color: $eyeColor</li>"); }
			if ($tailType=$row->tailType) { echo html_entity_decode("<li>Tail Type: $tailType</li>"); }
			if ($groomingNeeds=$row->groomingNeeds) { echo html_entity_decode("<li>Grooming Needs: $groomingNeeds</li>"); }
			if ($yardRequired=$row->yardRequired) { echo html_entity_decode("<li>Yard Required: $yardRequired</li>"); }
			if ($fence=$row->fence) { echo html_entity_decode("<li>Fence Required: $fence</li>"); }
			if ($shedding=$row->shedding) { echo html_entity_decode("<li>Shedding: $shedding</li>"); }
			if ($newPeople=$row->newPeople) { echo html_entity_decode("<li>Good with New People: $newPeople</li>"); }
			if ($vocal=$row->vocal) { echo html_entity_decode("<li>Vocal: $vocal</li>"); }
			if ($olderKidsOnly=$row->olderKidsOnly) { echo html_entity_decode("<li>Older Kids Only: $olderKidsOnly</li>"); }
			if ($noSmallDogs=$row->noSmallDogs) { echo html_entity_decode("<li>No Small Dogs: $noSmallDogs</li>"); }
			if ($noLargeDogs=$row->noLargeDogs) { echo html_entity_decode("<li>No Large Dogs: $noLargeDogs</li>"); }
			if ($noFemaleDogs=$row->noFemaleDogs) { echo html_entity_decode("<li>No Female Dogs: $noFemaleDogs</li>"); }
			if ($noMaleDogs=$row->noMaleDogs) { echo html_entity_decode("<li>No Male Dogs: $noMaleDogs</li>"); }
			if ($oKForSeniors=$row->oKForSeniors) { echo html_entity_decode("<li>OK For Seniors: $oKForSeniors</li>"); }
			if ($hypoallergenic=$row->hypoallergenic) { echo html_entity_decode("<li>Hypoallergenic: $hypoallergenic</li>"); }
			if ($goodInCar=$row->goodInCar) { echo html_entity_decode("<li>Good In Car: $goodInCar</li>"); }
			if ($leashtrained=$row->leashtrained) { echo html_entity_decode("<li>Leash Trained: $leashtrained</li>"); }
			if ($cratetrained=$row->cratetrained) { echo html_entity_decode("<li>Crate Trained: $cratetrained</li>"); }
			if ($fetches=$row->fetches) { echo html_entity_decode("<li>Fetches: $fetches</li>"); }
			if ($playsToys=$row->playsToys) { echo html_entity_decode("<li>Plays With Toys: $playsToys</li>"); }
			if ($swims=$row->swims) { echo html_entity_decode("<li>Swims: $swims</li>"); }
			if ($lap=$row->lap) { echo html_entity_decode("<li>Lap: $lap</li>"); }
			if ($oKWithLivestock=$row->oKWithLivestock) { echo html_entity_decode("<li>OK With Livestock: $oKWithLivestock</li>"); }
			if ($drools=$row->drools) { echo html_entity_decode("<li>Drools: $drools</li>"); }
			if ($apartment=$row->apartment) { echo html_entity_decode("<li>Apartment: $apartment</li>"); }
			if ($noHeat=$row->noHeat) { echo html_entity_decode("<li>Heat Sensitive: $noHeat</li>"); }
			if ($noCold=$row->noCold) { echo html_entity_decode("<li>Cold Sensitive: $noCold</li>"); }
			if ($protective=$row->protective) { echo html_entity_decode("<li>Protective: $protective</li>"); }
			if ($escapes=$row->escapes) { echo html_entity_decode("<li>Escapes: $escapes</li>"); }
			if ($predatory=$row->predatory) { echo html_entity_decode("<li>Predatory: $predatory</li>"); }
			if ($hasAllergies=$row->hasAllergies) { echo html_entity_decode("<li>Has Allergies: $hasAllergies</li>"); }
			if ($specialDiet=$row->specialDiet) { echo html_entity_decode("<li>Special Diet: $specialDiet</li>"); }
			if ($ongoingMedical=$row->ongoingMedical) { echo html_entity_decode("<li>Ongoing Medical Issues: $ongoingMedical</li>"); }
			if ($hearingImpaired=$row->hearingImpaired) { echo html_entity_decode("<li>Hearing Impaired: $hearingImpaired</li>"); }
			if ($sightImpaired=$row->sightImpaired) { echo html_entity_decode("<li>Sight Impaired: $sightImpaired</li>"); }
			if ($obedient=$row->obedient) { echo html_entity_decode("<li>Obedient: $obedient</li>"); }
			if ($playful=$row->playful) { echo html_entity_decode("<li>Playful: $playful</li>"); }
			if ($timid=$row->timid) { echo html_entity_decode("<li>Timid: $timid</li>"); }
			if ($skidish=$row->skidish) { echo html_entity_decode("<li>Skittish: $skidish</li>"); }
			if ($independent=$row->independent) { echo html_entity_decode("<li>Independent: $independent</li>"); }
			if ($affectionate=$row->affectionate) { echo html_entity_decode("<li>Affectionate: $affectionate</li>"); }
			if ($eagerToPlease=$row->eagerToPlease) { echo html_entity_decode("<li>Eager To Please: $eagerToPlease</li>"); }
			if ($intelligent=$row->intelligent) { echo html_entity_decode("<li>Intelligent: $intelligent</li>"); }
			if ($eventempered=$row->eventempered) { echo html_entity_decode("<li>Even-tempered: $eventempered</li>"); }
			if ($gentle=$row->gentle) { echo html_entity_decode("<li>Gentle: $gentle</li>"); }
			if ($goofy=$row->goofy) { echo html_entity_decode("<li>Goofy: $goofy</li>"); }
						
			?>
			</ul>
            
            <?php
			if ($pic2thumb=$row->pictmn2|$pic3thumb=$row->pictmn3|$pic4thumb=$row->pictmn4) {
				echo html_entity_decode('<div class="animal_additional_pics"><h2>Additional Pictures</h2>');
				if ($pic2thumb) {echo html_entity_decode('<img src="'.$pic2thumb.'" />');}
				if ($pic3thumb) {echo html_entity_decode('<img src="'.$pic3thumb.'" />');}
				if ($pic4thumb) {echo html_entity_decode('<img src="'.$pic4thumb.'" />');}
				echo '</div>';
			}
            ?>

		</div>
		<?php
	}
	?>
