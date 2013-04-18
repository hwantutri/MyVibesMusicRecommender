<?php //FILE WITH THE IMPORTANT MySQL INFO
 
 include "class/pgsql_db.class.php";

$conn = new pgsql_db();
error_reporting(0);	
//PAGE NUMBER, RESULTS PER PAGE, AND OFFSET OF THE SEARCH RESULTS
if($_GET["page"]){
    $pagenum = $_GET["page"];
} else {
    $pagenum = 1;
}

$rowsperpage = 3;
$offset = ($pagenum - 1) * $rowsperpage;

//SEPARATES THE ENTIRE SEARCH TERM INTO KEYWORDS
$t = trim(eregi_replace(" +", " ", $_GET["q"]));
$x = explode(" ", $t);

foreach($x as $z)
{
    $w++;
    if($w==1)
    {
    $u .= "firstname LIKE '%$z%'";
    }
    else
    {
    $u .= "OR firstname LIKE '%$z%'";
    }
}

//QUERY FOR THE PAGE OF RESULTS
$q = "SELECT COUNT (*) FROM profile WHERE $u";
$total_nums = $conn->get_var($q); //NUMBER OF RESULTS FOR THE PAGE

//QUERY FOR ALL RESULTS OF THE SEARCH
$sql = "SELECT * FROM profile WHERE $u ORDER BY id DESC LIMIT $offset, $rowsperpage";
$data = $conn->get_results($sql); //TOTAL NUMBER OF RESULTS
$total_pages = ceil($total_nums/$rowsperpage); //NUMBER OF PAGES

//IF THERE ARE RESULTS
if($total_nums)
{
    //PAGE NUMBER OUTSIDE OF RANGE, PAGE WILL REDIRECTS TO THE FIRST PAGE OF RESULTS
    if($pagenum<1||$pagenum>$total_pages)
    {
        header("location:results.php?q=$t");
    }
    
    //SHOWS THE RESULTS
	foreach($data as $obj){
	echo $obj->firstname;
	}
   /* while($r=pg_fetch_array($q))
    //{
       echo $r["firstname"];
    }
    */
    echo '<br>';
    $range = 2; //NUMBER OF PAGES TO BE SHOWN BEFORE AND AFTER THE CURRENT PAGE NUMBER IN THE NAVIGATION
    
    //IF NOT ON THE FIRST PAGE OF RESULTS
    if($pagenum>1)
    {
        $page = $pagenum - 1;
        $first = '<a class="page" id="1">First</a> ';
        $prev = '<a class="page" id="'.$page.'">Prev</a> ';
    }
    
    //IF NOT ON THE LAST PAGE OF RESULTS
    if($pagenum<$total_pages)
    {
        $page = $pagenum + 1;
        $next = '<a class="page" id="'.$page.'">Next</a> ';
        $last = '<a class="page" id="'.$total_pages.'">Last</a> ';
    }
    
    for($page=($pagenum-$range); $page<=($pagenum+$range); $page++)
    {
        //IF WITHIN THE FIRST AND LAST PAGES
        if($page>=1&&$page<=$total_pages)
        {
            if($total_pages>1)
            {
                if($page==$pagenum)
                {
                    $nav .= '<span class="pagenum">'.$page.'</span> ';
                }
                else
                {
                    $nav .= '<a class="page" id="'.$page.'">'.$page.'</a> ';
                }
            }
        }
    }
    
    //SHOWS PAGINATION IN HTML
    echo $first . $prev . $nav . $next. $last;
}
else
{
echo 'No results for <b>"'.$t.'"</b>';
}

?>