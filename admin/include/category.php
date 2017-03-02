
<?php
//for categories
include ('../include/connectdb.php');  

if (isset($_POST['category1'])){
    $addCat = addslashes(strip_tags($_POST['addCat']));
    
    $ifexist = mysql_query ("SELECT * FROM category WHERE cat_name='$addCat'");
    if (mysql_num_rows($ifexist)==0){
        $addC = mysql_query ("INSERT INTO category VALUES ('', '$addCat')");
        echo '<div class="alert alert-success">Successfully added</div>';
    }
    else{
         echo '<div class="alert alert-error">Category Already Exist</div>';
    }
}
?>

<h2>Category</h2>
<div class="row col-lg-12 pull-right">
    <div class="form-group col-lg-12">
<form id="contact-form" class="wufoo topLabel page"  method="post"
action="">
  <label for="Field6">Category name</label>
  <input type="text" name="addCat" class="form-control" placeholder="Add category name" size="30" />
  </div>

    <div class="form-group col-lg-12">
	<input id="register" name="category1" value="Add Category" class="btn btn-primary" type="submit"  />
  </div>
  <hr />
</div>
<h2>Author</h2>
</form>
<?php
//for categories

if (isset($_POST['brand'])){
    $pcategory = addslashes(strip_tags($_POST['pcategory']));
	 $bname = addslashes(strip_tags($_POST['bname']));
    
    $ifexist = mysql_query ("SELECT * FROM brand WHERE brand='$bname'");
    if (mysql_num_rows($ifexist)==0){
        $addC = mysql_query ("INSERT INTO brand VALUES ('', '$bname' ,'$pcategory')");
        echo '<div class="alert alert-success">Successfully added</div>';
    }
    else{
         echo '<div class="alert alert-error">Category Already Exist</div>';
    }
}
?>
<div class="row col-lg-12 pull-right">

    <div class="form-group col-lg-12">
    <form id="contact-form" class="wufoo topLabel page"  method="post"
action="">
      <label for="exampleInputPassword">Category</label>
    	 <select class="form-control" name="pcategory" id="slct1" onchange="populate(this.id,'slct2')">
         	<?php
                                        $cat_query = mysql_query("SELECT * FROM category");

                                        while($row = mysql_fetch_array($cat_query))
                                        {
                                            $cat_name = $row['cat_name'];
                                            $cat_id = $row['cat_id'];

                                            echo '<option value='.$cat_id.'>'.$cat_name.'</option>';
                                        }
               ?>
          </select>                     
    </div>
    <div class="form-group col-lg-12">

  <label for="Field6">Author</label>
  <input type="text" name="bname" class="form-control" placeholder="Add Brand name" size="30" />
  </div>

    <div class="form-group col-lg-12">
	<input id="register" name="brand" value="Add Category" class="btn btn-primary" type="submit"  />
  </div>
</div>
</form>

