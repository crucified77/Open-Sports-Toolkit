<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *	LEAGUES MODEL CLASS.
 *
 *	The Leagues model is designed to act as the interface for a collection of teams in a league. Right now, the 
 * 	league is defined as a top level organization. Sub leagues (LIke American and National Legaues) are considered 
 * 	to be seperate from this type of object.
 *
 *	@author			Jeff Fox <jfox015 (at) gmail (dot) com>
 *  @copyright   	(c)2009-12 Jeff Fox/Aeolian Digital Studios
 *	@version		1.0.3
 */
/*
	Copyright (c) 2012 Jeff Fox.

	Permission is hereby granted, free of charge, to any person obtaining a copy
	of this software and associated documentation files (the "Software"), to deal
	in the Software without restriction, including without limitation the rights
	to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
	copies of the Software, and to permit persons to whom the Software is
	furnished to do so, subject to the following conditions:

	The above copyright notice and this permission notice shall be included in
	all copies or substantial portions of the Software.

	THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
	IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
	FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
	AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
	LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
	OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
	THE SOFTWARE.
*/
require_once(dirname(dirname(__FILE__)).'/models/base_ootp_model.php');
class Leagues_model extends Base_ootp_model 
{

	protected $table		= 'leagues';
	protected $key			= 'league_id';
	protected $soft_deletes	= false;
	protected $date_format	= 'datetime';
	protected $set_created	= false;
	protected $set_modified = false;
	
	/*--------------------------------------
	/	GENERAL LEAGUE INFORMATION
	/-------------------------------------*/
	/**
	 *	Get Leagues.
	 *	Returns a list of all public leagues. This function is an alias for the Bonfire BasebModel find_all() method. 
	 *	@return		Object	List of Leagues
	 */
	public function get_leagues()
	{
		return $this->find_all();
	}
	/**
	 *	Get Leagues Array.
	 *	Returns a list of all public leagues in array, not object format
	 *	@return		Array	Array of Leagues
	 */
	public function get_leagues_array()
	{
		$leagues = array();
		$query = $this->db->get($this->table);
		if ($query->num_rows() > 0) 
		{
			$leagues = $query->result();
		}
		return $leagues;
	}
	/**
	 *	Get League Count.
	 *	Returns a count of the number of leagues in the database.
	 *	@return		Int	league Count
	 */
	public function get_league_count()
	{
		return $this->db->count_all_results($this->table);
	}
	
	/*--------------------------------------
	/	SEASON SPECIFIC INFORMATION
	/-------------------------------------*/
	/**
	 *	In Season.
	 *	Returns a list of public leagues.
	 *	@param	$league_id	Defaults to 100
	 *	@return	TRUE or FALSE
	 */
	public function in_season($league_id = 100) {
		
		if($this->db->table_exists($this->table))
        {
            $this->db->select('league_state')
                     ->where('league_id',$league_id);
            $query = $this->db->get($this->table);
            if ($query->num_rows() > 0) {
                $row = $query->result();
                if ($row->league_state > 1 && $row->league_state < 4) {
                    return true;
                } else {
                    return false;
                }
            }  else {
                return false;
            }
            $query->free_result();
		} else {
			return 'Required database tables have not been loaded.';
		}
	}
	/**
	 *	Resolve Stats Season.
	 *	Returns the latest sensible year to display stats. For example if the current league date is less than the league start date,
	 *	this function sends back the previous season.
	 *	@param	$league_id	Defaults to 100
	 *	@return				Int		year value
	 */
	public function resolve_stats_season($league_id = 100) {
		$currDate = strtotime($this->get_league_date('current',$league_id));
		$startDate = strtotime($this->get_league_date('start',$league_id));
		if ($currDate <= $startDate) 
		{
			$years = $this->get_all_seasons($league_id);
            $league_year = (intval($years[0]));
		}
		else 
		{
			$league_year = date('Y',$currDate);
		}
		return $league_year;
	}
	/**
	 *	Get All Season.
	 *	Returns a list of years as found in the players stats tables.
	 *	@param	$league_id	int		Defaults to 100
	 *	@return				array	Array of year values
	 */
	public function get_all_seasons($league_id = 100) {
		$years = array();
		if (!$this->use_prefix) $this->db->dbprefix = '';
		$sql="SELECT DISTINCT year FROM players_career_batting_stats WHERE league_id=".$league_id." GROUP BY year ORDER BY year DESC;";
		$query = $this->db->query($sql);
		if ($query->num_rows() > 0) {
			foreach($query->result_array() as $row) {
			   array_push($years,$row['year']);
			}
		}
		$query->free_result();
		if (!$this->use_prefix) $this->db->dbprefix = $this->dbprefix;
		return $years;
	}
	/**
	 *	Returns a string with the state of the league.
	 *	@return	String
	 */
	public function get_league_date($date_type = false, $league_id = 100) 
	{
		$league = $this->find_by('league_id',$league_id);
		if (isset($league) && is_array($league) && count($league))
		{
            $date = '';
			switch($date_type) 
			{
				case 'current_year':
					$date = date('Y', strtotime($league[0]['current_date']));
					break;
				case 'current':
					$date = $league[0]['current_date'];
					break;
				case 'start':
					$date = $league[0]['start_date'];
					break;
			}
			return $date;
		}
		else
		{
			return false;
		}
	}
	/**
	 *	GET SUBLEAGUES INFO.
		Returns an array of sub league IDs and names.
	 *	@return	Array $subleagues
	 */
	public function get_subleague_info($league_id = 100, $select_list = false) {
		$subleagues = array();
        if (!$this->use_prefix) $this->db->dbprefix = '';
        $this->db->select('sub_league_id,name, abbr')
				 ->where('league_id',intval($league_id))
				 ->order_by('sub_league_id');
		$query = $this->db->get('sub_leagues');
        if ($query->num_rows() > 0) {
            if ($select_list === true) {
                foreach($query->result_array() as $row) {
                    $subleagues = $subleagues + array($row['sub_league_id'] => $row['abbr']);
                }
            } else {
                $subleagues = $query->result_array();
            }
        }
		$query->free_result();
        //echo($this->db->last_query()."<br />");
        if (!$this->use_prefix) $this->db->dbprefix = $this->dbprefix;
        return $subleagues;
	}
	/**
	 *	Returns a string with the state of the league.
	 *	@return	String
	 */
	public function get_league_state($league_id = 100) {
		
		$state = '';
		
		$league = $this->find_all_by('league_id',$league_id);
		
		if (isset($league) && is_array($league) && count($league)) {
			switch ($league->league_state) {
				case 4:
					$state = "Off Season";
					break;
				case 3:
					$state = "Playoffs";
					break;
				case 2:
					$state = "Regular Season";
					break;
				case 1:
					$state = "Spring Training";
					break;
				case 0:
					$state = "Preseason";
					break;
			}
		} else {
			$state = 'Required OOTP database tables have not been loaded.';
		}
		return $state;
	}	
}
/* End of leagues_model.php */
/* Location: ./open_sports_toolkit/models/leagues_model.php */