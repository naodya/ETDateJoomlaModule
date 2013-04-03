<?php
/*------------------------------------------------------------------------
# mod_toetdate - Ethiopian Date Module
# ------------------------------------------------------------------------
# Author: Naod Yeheyes
# Copyright: Copyright (C) 2012 naodya.com. All Rights Reserved.
# License: - http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
# Websites: http://www.naodya.com
# Technical Support:  email:naodya@gmail.com
-------------------------------------------------------------------------*/

// no direct access
defined('_JEXEC') or die('Direct Access to this location is not allowed.');

class modToEtDateHelper
{

	
	function getEcDays()
	{	
		date_default_timezone_set('Africa/Addis_Ababa');//Sets the default timezone used by all date/time to Africa/Addis_Ababa
		
		$OFFSET=79372; //Offset is the number of days between 1/1/1970 (UNIX time) and the calendar beginning year in this case 1753
		
		$DAY=86400000; //1000*60*60*24 definition of one day in milliseconds
		
		$utcval= gmmktime(date('n'),date('j'),date('Y'))*1000; 
		
		return intval($OFFSET+($utcval/$DAY));
	}
	
	function getEtDate($dateformat)
	{		
		$days=modToEtDateHelper::getEcDays();
		$check=0;
		$eyear=1745; //Ethiopian calendary year equivalent of the beginng year 1753


		while ($check==0)
		{
			if ($eyear % 4 ==3)
			{
				if ($days>=366)
				{	
					$days-=366;
					$eyear++;
				}
				else $check=1;
			}
			else
			{
				if ($days>=365)
				{	
					$days-=365;
					$eyear++;
				}
				else $check=1;
			}
		}
		if (intval($days)==0)
		{
			$eyear-=1;
			$emonth=13;
			$eday=5 + (($eyear % 4 ==3)?1:0);
		}
		else
		{
			$emonth = ceil($days / 30);
			if ($days % 30 ==0)
				$eday = 30;
			else
				$eday=$days % 30;
		}
		return modToEtDateHelper::getDateFormat($eday, $emonth, $eyear, $dateformat);
	}
	

	//Returns formated Ethiopian date based on the date format parameters set at the back-end
	function getDateFormat($etday, $etmonth, $etyear, $dateformat)
	{
		switch($dateformat)
		{	
			case 0:
				$formatedate=modToEtDateHelper::getMonthName($etmonth)." ".$etday.", ".$etyear;
				break;
			case 1:
				$formatedate=modToEtDateHelper::getMonthName($etmonth)." ".$etday.", ".$etyear." ዓ.ም.";
				break;
			case 2:
				$formatedate=substr(modToEtDateHelper::getMonthName($etmonth),0,-3)." ".$etday.", ".$etyear;
				break;
			case 3:
				$formatedate=$etday."/".$etmonth."/".$etyear;
				break;
		}		
		return $formatedate;			
	}
	
	//Returns the Ethiopic equivalent month name
	function getMonthName($month)
	{
		switch ($month)
		{
			case 1:
				$month="መስከረም";
				break;
			case 2:
				$month="ጥቅምት";
				break;
			case 3:
				$month="ኅዳር";
				break;
			case 4:
				$month="ታህሣሥ";
				break;
			case 5:
				$month="ጥር";
				break;
			case 6:
				$month="የካቲት";
				break;
			case 7:
				$month="መጋቢት";
				break;
			case 8:
				$month="ሚያዝያ";
				break;				
			case 9:
				$month="ግንቦት";
				break;
			case 10:
				$month="ሰኔ";
				break;
			case 11:
				$month="ሐምሌ";
				break;
			case 12:
				$month="ነሐሴ";
				break;
			case 13:
				$month="ጳጉሜ";
				break;	
		}
		return $month;
	}
}
