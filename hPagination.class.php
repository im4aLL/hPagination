<?php
/*
@	Author: Habib Hadi
@	Email: me@habibhadi.com
@	Verion: 2.0 beta
@ 	Licence: GNU General Public License (GPL) (open source)
@
@	Usage:
	======
	require_once('hPagination.class.php');
	
	// Initialize the class
	$paginator = new hPagination;
	
	// Setting class variables
	$paginator->page_url 		= 'http://localhost/members/';								// full page url
	$paginator->rows_per_page 	= 10;														// Defining rows per page				
	$paginator->total_rows 		= 100;														// Give total number of rows
	$paginator->current_page 	= (intval($_GET['pg'])<1)?1:intval($_GET['pg']);			// Pass current requested page number (Never let pass 0) always > 1
	$paginator->seourl			= false;													// if you are running seo URL then apply true/false
	$paginator->parameter		= 'pg';														// http://localhost/member/[parameter]/2 | http://localhost/member/?[parameter]=2
	
	// Add at last in query str
	$paginator->limit()
	
	// Display
	$paginator->display_pagination();
@
@	=======
@ 	enjoy :)
*/

class hPagination {
	var $page_url;
	var $rows_per_page = 20;
	var $total_rows;
	var $current_page;
	var $seourl = false;
	
	//parameter
	var $parameter = 'page';
	
	//class css
	var $class_page = 'paginator';
	var $class_button = 'button';
	
	//language
	var $LNG_FISRT = 'First';
	var $LNG_LAST = 'Last';
	var $LNG_PREV = 'Prev';
	var $LNG_NEXT = 'Next';
	

	function display_pagination(){
		echo '<div class="'.$this->class_page.'">';
		echo 'You are in Page: <strong>Pages: '.$this->current_page.' of '.$this->total_pages().'</strong> &nbsp;';
		
		// first
		if($this->seourl) $first_page_link = $this->page_url.$this->parameter.'/1/';
		else {
			$first_page_parse = parse_url($this->page_url);
			if( isset($first_page_parse['query']) && $first_page_parse['query']!=NULL) $first_page_link = $this->page_url.'&'.$this->parameter.'=1';	
			else $first_page_link = $this->page_url.'?'.$this->parameter.'=1';
		}
		echo "<a href='".$first_page_link."' class=".$this->class_button.">".$this->LNG_FISRT."</a>";
		// first
		
		// Prev
		$prev_page_num = $this->current_page-1;
		if($prev_page_num<1) $prev_page_num = 1;
		
		if($this->seourl) $prev_page_link = $this->page_url.$this->parameter.'/'.$prev_page_num.'/';
		else {
			$prev_page_p = parse_url($this->page_url);
			if( isset($prev_page_p['query']) && $prev_page_p['query']!=NULL) $prev_page_link = $this->page_url.'&'.$this->parameter.'='.$prev_page_num.'';	
			else $prev_page_link = $this->page_url.'?'.$this->parameter.'='.$prev_page_num.'';
		}
		echo "<a href='".$prev_page_link."' class=".$this->class_button.">".$this->LNG_PREV."</a>";
		// prev
		
		if($this->total_pages()>=15){
			$differ=7;
			if(($this->current_page-$differ)>0 && ($this->current_page+$differ)<=$this->total_pages()) {$start=$this->current_page-$differ; $end=$this->current_page+$differ;}
			elseif(($this->current_page-$differ)<=0 && ($this->current_page+$differ)<=$this->total_pages()) {$start=1; $end=($differ*2)+1;}
			elseif(($this->current_page-$differ)>0 && ($this->current_page+$differ)>$this->total_pages()) {$start=$this->total_pages()-($differ*2); $end=$this->total_pages();}
		}
		else { $start=1; $end=$this->total_pages(); }
		
		
		
		for($i=$start;$i<=$end;$i++)
			{
				if($this->seourl) $c_page_link = $this->page_url.$this->parameter.'/'.$i.'/';
				else {
					$c_page_p = parse_url($this->page_url);
					if( isset($c_page_p['query']) && $c_page_p['query']!=NULL) $c_page_link = $this->page_url.'&'.$this->parameter.'='.$i.'';	
					else $c_page_link = $this->page_url.'?'.$this->parameter.'='.$i.'';
				}
				echo "<a href='".$c_page_link."' class='".$this->class_button."'>$i</a>";
			}
		
		
		// Next
		$next_page_num = $this->current_page+1;
		if($next_page_num>$this->total_pages()) $next_page_num = $this->total_pages();
		
		if($this->seourl) $next_page_link = $this->page_url.$this->parameter.'/'.$next_page_num.'/';
		else {
			$next_page_p = parse_url($this->page_url);
			if( isset($next_page_p['query']) && $next_page_p['query']!=NULL) $next_page_link = $this->page_url.'&'.$this->parameter.'='.$next_page_num.'';	
			else $next_page_link = $this->page_url.'?'.$this->parameter.'='.$next_page_num.'';
		}
		echo "<a href='".$next_page_link."' class=".$this->class_button.">".$this->LNG_NEXT."</a>";
		// Next
		
		// Last
		if($this->seourl) $last_page_link = $this->page_url.$this->parameter.'/'.$this->total_pages().'/';
		else {
			$last_page_parse = parse_url($this->page_url);
			if( isset($last_page_parse['query']) && $last_page_parse['query']!=NULL) $last_page_link = $this->page_url.'&'.$this->parameter.'='.$this->total_pages();	
			else $last_page_link = $this->page_url.'?'.$this->parameter.'='.$this->total_pages();
		}
		echo "<a href='".$last_page_link."' class=".$this->class_button.">".$this->LNG_LAST."</a>";
		// Last
		
		echo '</div>';	
		
	}
	
	function PageNumbers(){
		
		if($this->total_pages()>=15){
			$differ=7;
			if(($this->current_page-$differ)>0 && ($this->current_page+$differ)<=$this->total_pages()) {$start=$this->current_page-$differ; $end=$this->current_page+$differ;}
			elseif(($this->current_page-$differ)<=0 && ($this->current_page+$differ)<=$this->total_pages()) {$start=1; $end=($differ*2)+1;}
			elseif(($this->current_page-$differ)>0 && ($this->current_page+$differ)>$this->total_pages()) {$start=$this->total_pages()-($differ*2); $end=$this->total_pages();}
		}
		else { $start=1; $end=$this->total_pages(); }
		
		
		
		for($i=$start;$i<=$end;$i++)
			{
				if($this->seourl) $c_page_link = $this->page_url.$this->parameter.'/'.$i.'/';
				else {
					$c_page_p = parse_url($this->page_url);
					if( isset($c_page_p['query']) && $c_page_p['query']!=NULL) $c_page_link = $this->page_url.'&'.$this->parameter.'='.$i.'';	
					else $c_page_link = $this->page_url.'?'.$this->parameter.'='.$i.'';
				}
				echo "<a href='".$c_page_link."' class=".$this->class_button.">$i</a>";
			}		
	}
	
	function PageFirst(){
		// first
		if($this->seourl) $first_page_link = $this->page_url.$this->parameter.'/1/';
		else {
			$first_page_parse = parse_url($this->page_url);
			if( isset($first_page_parse['query']) && $first_page_parse['query']!=NULL) $first_page_link = $this->page_url.'&'.$this->parameter.'=1';	
			else $first_page_link = $this->page_url.'?'.$this->parameter.'=1';
		}
		echo "<a href='".$first_page_link."' class=".$this->class_button.">".$this->LNG_FISRT."</a>";
		// first
	}


	function PagePrev(){	
		// Prev
		$prev_page_num = $this->current_page-1;
		if($prev_page_num<1) $prev_page_num = 1;
		
		if($this->seourl) $prev_page_link = $this->page_url.$this->parameter.'/'.$prev_page_num.'/';
		else {
			$prev_page_p = parse_url($this->page_url);
			if( isset($prev_page_p['query']) && $prev_page_p['query']!=NULL) $prev_page_link = $this->page_url.'&'.$this->parameter.'='.$prev_page_num.'';	
			else $prev_page_link = $this->page_url.'?'.$this->parameter.'='.$prev_page_num.'';
		}
		echo "<a href='".$prev_page_link."' class=".$this->class_button.">".$this->LNG_PREV."</a>";
		// prev
	}
	
	function PageNext(){
	// Next
		$next_page_num = $this->current_page+1;
		if($next_page_num>$this->total_pages()) $next_page_num = $this->total_pages();
		
		if($this->seourl) $next_page_link = $this->page_url.$this->parameter.'/'.$next_page_num.'/';
		else {
			$next_page_p = parse_url($this->page_url);
			if( isset($next_page_p['query']) && $next_page_p['query']!=NULL) $next_page_link = $this->page_url.'&'.$this->parameter.'='.$next_page_num.'';	
			else $next_page_link = $this->page_url.'?'.$this->parameter.'='.$next_page_num.'';
		}
		echo "<a href='".$next_page_link."' class=".$this->class_button.">".$this->LNG_NEXT."</a>";
	// Next
	}
	
	function PageLast(){
	// Last
	
		if($this->seourl) $last_page_link = $this->page_url.$this->parameter.'/'.$this->total_pages().'/';
		
		else {
			
			$last_page_parse = parse_url($this->page_url);
			if( isset($last_page_parse['query']) && $last_page_parse['query']!=NULL) $last_page_link = $this->page_url.'&'.$this->parameter.'='.$this->total_pages();	
			else $last_page_link = $this->page_url.'?'.$this->parameter.'='.$this->total_pages();
		
		}
		
		echo "<a href='".$last_page_link."' class=".$this->class_button.">".$this->LNG_LAST."</a>";
		
		// Last
	}
	
	function total_pages(){
		return ceil($this->total_rows/$this->rows_per_page);
	}
	
	function current_page(){
		
		return $this->current_page;
		
	}
	
	function limit($limit_text=true){
		$this->current_page = intval($this->current_page);
		if($this->current_page>1) $start = $this->rows_per_page * $this->current_page - $this->rows_per_page;
		else $start = 0;
		
		if($limit_text) return ' LIMIT '.$start.','.$this->rows_per_page;
		else return ' '.$start.','.$this->rows_per_page;
	}
}
?>