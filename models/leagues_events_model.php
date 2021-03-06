<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 *	LEAGUE EVENTS MODEL CLASS.
 *	Interfaces with the OOTP league Events table to load league events.
 *
 *	@author			Jeff Fox <jfox015 (at) gmail (dot) com>
 *  @copyright   	(c)2009-12 Jeff Fox/Aeolian Digital Studios
 *	@version		1.0
 *
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
class Leagues_events_model extends Base_ootp_model {

	protected $table		= 'league_events';
	protected $key			= 'event_id';
	protected $soft_deletes	= false;
	protected $date_format	= 'datetime';
	protected $set_created	= false;
	protected $set_modified = false;
	
	/*--------------------------------------------------
	/
	/	PUBLIC FUNCTIONS
	/
	/-------------------------------------------------*/
	/**
	 *	Returns an array of upcoming league events.
	 *	@param	$limit	
	 *	@return	Array
	 */
	public function get_events($league_id = 100, $start_date = false, $limit = 3) {
		$events = array();
		if (!$this->use_prefix) $this->db->dbprefix = '';
		if ($this->db->table_exists($this->table)) {
            $this->db->select('start_date,name');
			$this->db->where('league_id',$league_id);
			$this->db->where('event_over',0);
			if ($start_date !== false) {
				$this->db->where('start_date >',date('Y-m-d',strtotime($start_date)));
			}
			$this->db->not_like('name','%nnounce%');
			$this->db->order_by('start_date','asc');
			$this->db->limit($limit,0);
			$query = $this->db->get($this->table);
            //print($this->db->last_query()."<br />");
			if ($query->num_rows() > 0) {
				$events = $query->result_array();
                /*foreach($query->result() as $row) {
					array_push($events,array('name'=>$row->name,'start_date'=>$row->start_date));
				}*/
			}
			$query->free_result();
		} else {
			$this->error = 'Required database table "league_events" has not been loaded. No events could be displayed at this time.';
		}
		if (!$this->use_prefix) $this->db->dbprefix = $this->dbprefix;
		return $events;
	}
	/*---------------------------------------
	/	PRIVATE/PROTECTED FUNCTIONS
	/--------------------------------------*/

}