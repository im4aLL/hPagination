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
	require_once(&amp;#039;hPagination.class.php&amp;#039;);
	
	// Initialize the class
	$paginator = new hPagination;
	
	// Setting class variables
	$paginator-&amp;gt;page_url 		= &amp;#039;http://localhost/members/&amp;#039;;								// full page url
	$paginator-&amp;gt;rows_per_page 	= 10;														// Defining rows per page				
	$paginator-&amp;gt;total_rows 		= 100;														// Give total number of rows
	$paginator-&amp;gt;current_page 	= (intval($_GET[&amp;#039;pg&amp;#039;])&amp;lt;1)?1:intval($_GET[&amp;#039;pg&amp;#039;]);			// Pass current requested page number (Never let pass 0) always &amp;gt; 1
	$paginator-&amp;gt;seourl			= false;													// if you are running seo URL then apply true/false
	$paginator-&amp;gt;parameter		= &amp;#039;pg&amp;#039;;														// http://localhost/member/[parameter]/2 | http://localhost/member/?[parameter]=2
	
	// Add at last in query str
	$paginator-&amp;gt;limit()
	
	// Display
	$paginator-&amp;gt;display_pagination();
@
@	=======
@ 	enjoy :)
*/
</pre>