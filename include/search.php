<?php

$pageNum = "";
$prod = "";
include 'connectdb.php';
if (isset($_POST['searchP']))
{
	//$searchP = addslashes(strip_tags($_POST['searchP']));
	//$searchP2="";
	$searchP = preg_replace('#[^a-z 0-9?!]#i', '', $_POST['searchP']);
	//$searchP2="";
	//pages
	$per_page = 5;
	$music = 1;
	$pages_query = mysql_query("SELECT COUNT('id') FROM products WHERE product_name LIKE '%$searchP%' OR sub_category LIKE '%$searchP%'");
    $pages = ceil(mysql_result($pages_query, 0) / $per_page);
	$page = (isset($_GET['p'])) ? (int)$_GET['p'] : 1;
    $start = ($page - 1) * $per_page;
       
    if ($pages >=1 && $page <= $pages)
	{
		for($x=1; $x<=$pages; $x++) 
		{
			$disPage = ($x == $page) ? 
			'<li><a href="?p='.$x.'">'.$x.'</a><li>':'<li><a href="?p='.$x.'">'.$x.'</a></li>';
			$pageNum .= $disPage;
		}
	}
		echo '<div class="page-header"> <h5>SEARCH RESULT</h5></div></div>';		
	$prod_query = mysql_query ("SELECT * FROM products WHERE product_name LIKE '%$searchP%' OR sub_category LIKE '%$searchP%' ORDER BY ID DESC LIMIT $start, $per_page ");
	if (mysql_num_rows($prod_query)>0)
	{
	while ($row = mysql_fetch_assoc ($prod_query))
	{ $id = $row['id'];
			 $prod_title = $row["product_name"];
			 $stock = $row["stock"];
			 $price = $row["price"];
			  $sub_category = $row["sub_category"];
			 $prod_desc = $row["details"];
			 $ext = $row["ext"];
			 $date = strftime("%b %d, %Y", strtotime($row["timestamp"]));

		 echo' 
		 <div class="span11">
               <h4><a href="details.php?id='.$id.'">'.$prod_title.' ('.$sub_category.' ) Stock : '.$stock.'</a></h4>
            <p><br/><strong>Description </strong>:'.$prod_desc.'<br /><strong>Link :</strong> <a href="details.php?id='.$id.'">http://localhost/capstone504/details.php?id='.$id.'</a></p>
            <hr />
                 </div>';
	
	}
	}
	else
	{
		echo "<div class='alert alert-error'>Sorry no products match your query</div>";
	}
}
else
{
	
                
                $per_page = 15;
		
                $pages_query = mysql_query("SELECT COUNT('id') FROM products");
                $pages = ceil(mysql_result($pages_query, 0) / $per_page);

                    $page = (isset($_GET['p'])) ? (int)$_GET['p'] : 1;
                    $start = ($page - 1) * $per_page;
       
         
                 if ($pages >=1 && $page <= $pages)
				{
					
				for($x=1; $x<=$pages; $x++) 
				{
					$disPage = ($x == $page) ? '
					<li><a href="?p='.$x.'">'.$x.'</a><li>':'<li><a href="?p='.$x.'">'.$x.'</a></li>';
					$pageNum .= $disPage;
				}
				}
				
	
	$images_query = mysql_query ("SELECT * FROM products ORDER BY id DESC LIMIT $start, $per_page ");
	while ($row = mysql_fetch_assoc ($images_query))
	{
	 $id = $row['id'];
			 $prod_title = $row["product_name"];
			 $stock = $row["stock"];
			 $price = $row["price"];
			 $prod_desc = $row["details"];
			 $ext = $row["ext"];
			 $date = strftime("%b %d, %Y", strtotime($row["timestamp"]));
		
		 echo'<div class="span11">
               <h4><a href="#">'.$prod_title.' | Stock : '.$stock.'</a></h4>
            <p><strong>Description </strong>: '.$prod_desc.'<br /><strong>Link :</strong> <a href="details.php?id='.$id.'">http://localhost/capstone504/details.php?id='.$id.'</a></p>
            <hr />
                 </div>';
	}
			
              
}
/*echo '
<div class="span12"></div>
<div class="pagination pull-left">
 						 <ul>
  							 <li>
      						'.$pageNum.'
    						</li>
    						
    					</ul>
					</div>';*/
?>