<mark>Updated version can be found here https://github.com/im4aLL/roolith-database</mark>

hPagination
===========

php Pagination class

<pre>
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
</pre>
