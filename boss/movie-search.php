<DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
<meta http-equiv="Content-Type" content="text/html;charset=iso-8859-1" />
<title>Movie Search</title>
<style type="text/css">
/* SIMPLE STYLING FOR SEARCH RESULTS */
body { font-family:arial; font-size:12px; }
div.result { margin-bottom:15px; background-color:#efefef; padding:10px; }
div.result a { font-size:18px; font-weight:bold; }
div.result div { float:left; font-size:30px; font-weight:bold; margin-right:10px; color:#c0c0c0; }
</style>
</head>
<body>
<h1>Movie Search</h1>
<form action="" method="get">
<?php
echo 'Search for <input type="text" name="movie" value="';

if(empty($_GET['movie']))
  $_GET['movie']="";

// Echo the query in the search text field 
$query = htmlentities($_GET['movie'], ENT_QUOTES, 'UTF-8');
echo $query . '" />   <input type="submit" value="Go" /></form>';

// If there is a query
if(!empty($_GET['movie']))
{
	echo '<hr />';
        $url="http://query.yahooapis.com/v1/public/yql?q=";
        $url= $url . urlencode("select * from search.web where query=@movie and sites='imdb.com,movies.yahoo.com,indiatimes.com'");
        $url= $url . "&movie=" . urlencode($_GET['movie']); 
        //var_dump($url);
	//$url="http://boss.yahooapis.com/ysearch/web/v1/".urlencode($_GET['q'])."?appid=ISGgKXfV34GhV6BXecPEg24VLNQCEpQ7df_.jdBruuJPirNxNsjpRIXKZbeC2hCbjJHDNQ--&sites=imdb.com,movies.yahoo.com,indiatimes.com&format=xml";
	$xml=simplexml_load_file($url);
        //var_dump($xml);
	foreach ($xml->results->result as $item) {
	 echo '<div class="result"><a href="'.$item->url.'">'.$item->title.'</a><br/>'.$item->abstract.'<br><font color="green">'.$item->dispurl.'</font></div>';
	}
}
?>

