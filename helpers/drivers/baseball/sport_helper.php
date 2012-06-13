<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *	SPORT HELPER.
 *	A helper that defines the specific types of data for each specific sport.
 *
 *
 * 	@sport 		Baseball
 *	@author		Jeff Fox <jfox@gmail.com>
 *
 */
 /*
	Copyright (c)  Jeff Fox

	Permission is hereby grantedfree of chargeto any person obtaining a copy
	of this software and associated documentation files (the "Software")to deal
	in the Software without restrictionincluding without limitation the rights
	to usecopymodifymergepublishdistributesublicenseand/or sell
	copies of the Softwareand to permit persons to whom the Software is
	furnished to do sosubject to the following conditions:

	The above copyright notice and this permission notice shall be included in
	all copies or substantial portions of the Software.

	THE SOFTWARE IS PROVIDED "AS IS"WITHOUT WARRANTY OF ANY KINDEXPRESS OR
	IMPLIEDINCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIMDAMAGES OR OTHER
	LIABILITYWHETHER IN AN ACTION OF CONTRACTTORT OR OTHERWISEARISING FROM,
	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
	THE SOFTWARE.
*/

//---------------------------------------------------------------

/**
 *	STAT LIST.
 *	This function returns an array that defines the stat categories broekn down by the 
 * category type (offensedefense and speciality).
 *
 *	@return		Array	Stat Categories offensedefense and specilty types
 */
if(!function_exists('stat_list')) 
{
	function stat_list() 
	{
		$stats = array(
            'offense'=>
                array(
                    "GS"  => array('lang' => "GS"),
                    "PA"  => array('lang' => "PA"),
                    "AB"  => array('lang' => "AB"),
                    "H"  => array('lang' => "H"),
                    "SO"  => array('lang' => "SO"),
                    "TB"  => array('lang' => "TB"),
                    "2B"  => array('lang' => "2B"),
                    "3B"  => array('lang' => "3B"),
                    "HR"  => array('lang' => "HR"),
                    "SB"  => array('lang' => "SB"),
                    "RBI" => array('lang' => "RBI"),
                    "R" => array('lang' => "R"),
                    "BB" => array('lang' => "BB"),
                    "IBB" => array('lang' => "IBB"),
                    "HBP" => array('lang' => "HBP"),
                    "SH" => array('lang' => "SH"),
                    "SF" => array('lang' => "SF"),
                    "XBH" => array('lang' => "XBH"),
                    "AVG" => array('lang' => "AVG"),
                    "OBP" => array('lang' => "OBP"),
                    "SLG" => array('lang' => "SLG"),
                    "RC" => array('lang' => "RC"),
                    "RC_27" => array('lang' => "RC_27"),
                    "ISO" => array('lang' => "ISO"),
                    "WOBA" => array('lang' => "WOBA"),
                    "TAVG" => array('lang' => "TAVG"),
                    "OPS" => array('lang' => "OPS"),
                    "VORP" => array('lang' => "VORP"),
                    "GIDP" => array('lang' => "GIDP"),
                    "RISP" => array('lang' => "RISP") ,
                    "WIFF" => array('lang' => "WIFF"),
                    "WALK" => array('lang' => "WALK")
                ),
			'specialty' =>
                array(
                    "G" => array('lang' => "G"),
                    "GS" => array('lang' => "GS"),
                    "W" => array('lang' => "W"),
                    "L" => array('lang' => "L"),
                    "Win%" => array('lang' => "Win%"),
                    "SV" => array('lang' => "SV"),
                    "HLD" => array('lang' => "HLD"),
                    "IP" => array('lang' => "IPI"),
                    "BF" => array('lang' => "BF"),
                    "HRA" => array('lang' => "HRA"),
                    "BB" => array('lang' => "BB"),
                    "SO" => array('lang' => "SO"),
                    "WP" => array('lang' => "WP"),
                    "ERA" => array('lang' => "ERA"),
                    "BABIP" => array('lang' => "BABIP"),
                    "WHIP" => array('lang' => "WHIP"),
                    "SO_BB" => array('lang' => "SO_BB"),
                    "RA_IP" => array('lang' => "RA_9IP"),
                    "HR_IP" => array('lang' => "HR_9IP"),
                    "H_IP" => array('lang' => "H_9IP"),
                    "BB_IP" => array('lang' => "BB_9IP"),
                    "SO_IP" => array('lang' => "SO_9IP"),
                    "VORP" => array('lang' => "VORP"),
                    "RA" => array('lang' => "RA"),
                    "GF" => array('lang' => "GF"),
                    "QS" => array('lang' => "QS"),
                    "QS%" => array('lang' => "QS%"),
                    "CG" => array('lang' => "CG"),
                    "CG%" => array('lang' => "CG%"),
                    "SHO" => array('lang' => "SHO"),
                    "SHO%" => array('lang' => "SHO%"),
                    "CS" => array('lang' => "CS"),
                    "HA" => array('lang' => "HA"),
                    "BS" => array('lang' => "BS"),
                    "SVO" => array('lang' => "SVO"),
                    "ER" => array('lang' => "ER"),
                    "IPF" => array('lang' => "IPIF"),
                    "IR" => array('lang' => "IR"),
                    "IRA" => array('lang' => "IRA"),
                    "BK" => array('lang' => "BK"),
                    "HB" => array('lang' => "HB"),
                    "OBA" => array('lang' => "OBA", 'formula' => 'if([OPERATOR](ab)=0,0,[OPERATOR](ha)/[OPERATOR](ab)) as oavg'),
                ),
			"defense"=>
                array(
                    "TC" => array('lang' => 'TC'),
                    "A" => array('lang' => 'A'),
                    "PO" => array('lang' => 'PO'),
                    "ER" => array('lang' => 'ER'),
                    "IP" => array('lang' => 'IPL'),
                    "G" => array('lang' => 'G'),
                    "GS" => array('lang' => 'GS'),
                    "E" => array('lang' => 'E'),
                    "DP" => array('lang' => 'DP'),
                    "TP" => array('lang' => 'TC'),
                    "PB" => array('lang' => 'PB'),
                    "SBA" => array('lang' => 'SBA'),
                    "RTO" => array('lang' => 'RTO'),
                    "IPF" => array('lang' => 'IPLF'),
                    "PLAYS" => array('lang' => 'PLAYS'),
                    "PLAYS_BASE" => array('lang' => 'PLAYS_BASE'),
                    "ROE" => array('lang' => 'ROE'),
                    "FP" => array('lang' => 'FP'),
                    "RF" => array('lang' => 'RF'),
                ),
            "injury"=>
                array(
                    "I" => array('lang' => 'INJURY'),
                    "DTD" => array('lang' => 'DTD_INJURY'),
                    "CE" => array('lang' => 'CE'),
                    "DL" => array('lang' => 'DL'),
                    "DAYS" => array('lang' => 'DAYS'),
                    "ID" => array('lang' => 'ID')
                )
		);
		return $stats;
	} // END function
} // END if

//---------------------------------------------------------------

/**
 *	Get Stats Class.
 *	Accepts the player type ans stats class (and custom field defs) and builds a SQL query.
 *	@param		$stat_type	int				TYPE_OFFENSE, TYPE_DEFENSE or TYPE_SPECIALTY
 *	@param		$stats_class	int			The class of stats to use
 *	@return						Array		Array of stat definitions
 */
if(!function_exists('stats_class')) 
{
	function stats_class($stat_type = TYPE_OFFENSE, $stats_class = CLASS_STANDARD)
	{
		$fieldList = array();
		if ($stat_type == TYPE_OFFENSE) {
			// BATTERS
			switch ($stats_class) {
				case CLASS_COMPACT:
					$fieldList = array('AVG','R','HR','RBI','OPS');
					break;
				case CLASS_BASIC:
					$fieldList = array('AVG','R','H','HR','RBI','SB','OBP','OPS');
					break;
				case CLASS_COMPLETE:
					$fieldList = array('AVG','G','AB','R','H','2B','3B','HR','RBI','BB','SO','SB','OBP','SLG','OPS');
					break;
				case CLASS_EXPANDED:
					$fieldList = array('AVG','G','AB','R','H','2B','3B','HR','RBI','BB','SO','SB','CS','OBP','SLG','OPS','wOBA','XBH','OPSPLUS');
					break;
				case CLASS_EXTENDED:
					$fieldList = array('AVG','G','PA','HP','SF','ISO','TB');
					break;
				case CLASS_STANDARD:
				default:
					$fieldList = array('AVG','AB','R','H','HR','RBI','BB','SO','SB','OBP','SLG','OPS');
					break;
			} // END switch
		} else if ($stat_type == TYPE_SPECIALTY){
			switch ($stats_class) {
				case CLASS_COMPACT:
					$fieldList = array('W','L','ERA','BB','SO');
					break;
				case CLASS_BASIC:
					$fieldList = array('W','L','SV','ERA','IP','BB','SO','WHIP');
					break;
				case CLASS_COMPLETE:
					$fieldList = array('W','L','SV','ERA','G','GS','IP','CG','SHO','HA','RA','ER','HRA','BB','SO','WHIP');
					break;
				case CLASS_EXPANDED:
					$fieldList = array('W','L','SV','ERA','G','GS','IP','CG','SHO','HA','RA','ER','BB','SO','HRA','BB_9','K_9','HR_9','WHIP','BIFP','ERAPLUS');
					break;
				case CLASS_EXTENDED:
					$fieldList = array('IR','IRA','SO','BS','QS','QS%','CG%','SHO%','GF');
					break;
				case CLASS_STANDARD:
				default:
					$fieldList = array('W','L','SV','ERA','IP','SHO','HA','ER','HRA','BB','SO','WHIP');
					break;
			} // END switch
		} else if ($stat_type == TYPE_DEFENSE){
			switch ($stats_class) {
				case CLASS_COMPACT:
					$fieldList = array("TC","A","PO","E","FP");
					break;
				default:
					$fieldList = array("TC","A","PO","ER","IP","E","DP","TP","PB","SBA","RTO","ROE","FP");
					break;
			} // END switch
		}  else if ($stat_type == TYPE_INJURY){
			switch ($stats_class) {
				default:
					$fieldList = array("I","DTD","CE","DL","DAYS","ID");
					break;
			} // END switch
		} // END if
		return $fieldList;
	} // END function
} // END if