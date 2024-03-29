CREATE TABLE IF NOT EXISTS`#__rescuegroups` (
 `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
 `orgID` int(11) DEFAULT NULL,
 `animalID` int(11) NOT NULL,
 `status` varchar(15) NOT NULL,
 `lastUpdated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 `rescueID` varchar(25) DEFAULT NULL,
 `name` varchar(50) DEFAULT NULL,
 `summary` varchar(200) DEFAULT NULL,
 `species` varchar(15) DEFAULT NULL,
 `breed` varchar(250) DEFAULT NULL,
 `primaryBreed` text,
 `secondaryBreed` text,
 `sex` varchar(6) DEFAULT NULL,
 `mixed` varchar(3) DEFAULT NULL,
 `dogs` varchar(10) DEFAULT NULL,
 `cats` varchar(10) DEFAULT NULL,
 `kids` varchar(10) DEFAULT NULL,
 `declawed` varchar(10) DEFAULT NULL,
 `housetrained` varchar(10) DEFAULT NULL,
 `age` varchar(45) DEFAULT NULL,
 `specialNeeds` varchar(3) DEFAULT NULL,
 `altered` varchar(3) DEFAULT NULL,
 `size` varchar(10) DEFAULT NULL,
 `uptodate` varchar(3) DEFAULT NULL,
 `color` varchar(200) DEFAULT NULL,
 `coatLength` varchar(20) DEFAULT NULL,
 `pattern` varchar(50) DEFAULT NULL,
 `courtesy` varchar(3) DEFAULT NULL,
 `found` varchar(3) DEFAULT NULL,
 `foundDate` date DEFAULT NULL,
 `foundZipcode` varchar(10) DEFAULT NULL,
 `locationZipcode` varchar(10) DEFAULT NULL,
 `killDate` date DEFAULT NULL,
 `killReason` varchar(45) DEFAULT NULL,
 `description` text,
 `oKWithAdults` text,
 `obedienceTraining` text,
 `ownerExperience` text,
 `exerciseNeeds` text,
 `energyLevel` text,
 `activityLevel` text,
 `earType` text,
 `eyeColor` text,
 `tailType` text,
 `groomingNeeds` text,
 `yardRequired` text,
 `fence` text,
 `shedding` text,
 `newPeople` text,
 `vocal` text,
 `olderKidsOnly` text,
 `noSmallDogs` text,
 `noLargeDogs` text,
 `noFemaleDogs` text,
 `noMaleDogs` text,
 `oKForSeniors` text,
 `hypoallergenic` text,
 `goodInCar` text,
 `leashtrained` text,
 `cratetrained` text,
 `fetches` text,
 `playsToys` text,
 `swims` text,
 `lap` text,
 `oKWithLivestock` text,
 `drools` text,
 `apartment` text,
 `noHeat` text,
 `noCold` text,
 `protective` text,
 `escapes` text,
 `predatory` text,
 `hasAllergies` text,
 `specialDiet` text,
 `ongoingMedical` text,
 `hearingImpaired` text,
 `sightImpaired` text,
 `obedient` text,
 `playful` text,
 `timid` text,
 `skidish` text,
 `independent` text,
 `affectionate` text,
 `eagerToPlease` text,
 `intelligent` text,
 `eventempered` text,
 `gentle` text,
 `goofy` text,
 `pic1` varchar(1000) DEFAULT NULL,
 `pictmn1` varchar(1000) DEFAULT NULL,
 `pic2` varchar(1000) DEFAULT NULL,
 `pictmn2` varchar(1000) DEFAULT NULL,
 `pic3` varchar(1000) DEFAULT NULL,
 `pictmn3` varchar(1000) DEFAULT NULL,
 `pic4` varchar(1000) DEFAULT NULL,
 `pictmn4` varchar(1000) DEFAULT NULL,
 `video1` varchar(1000) DEFAULT NULL,
 `videoUrl1` varchar(1000) DEFAULT NULL,
 `contactName` varchar(50) DEFAULT NULL,
 `contactEmail` varchar(50) DEFAULT NULL,
 `contactCellPhone` varchar(14) DEFAULT NULL,
 `contactHomePhone` varchar(14) DEFAULT NULL,
 `petUrl` varchar(1000) DEFAULT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8