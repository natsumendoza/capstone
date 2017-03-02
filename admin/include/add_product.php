<?php

include ('../include/connectdb.php');  
if (isset($_FILES['image']))
{
        $prod_title = addslashes(strip_tags($_POST['prod_title']));
        $prod_desc = $_POST['tinyeditor'];
		$entity_elm1 = htmlentities($prod_desc);
		$entity_elm1 = mysql_real_escape_string($entity_elm1);
		$price = addslashes(strip_tags($_POST['price']));
		$stock = addslashes(strip_tags($_POST['stock']));
		$category= addslashes(strip_tags($_POST['category']));
		//$category2= addslashes(strip_tags($_POST['category2']));
		$brand= addslashes(strip_tags($_POST['brandname']));
		$display= 'unactive';
        
	$image_name = $_FILES['image']['name'];
	$image_size = $_FILES['image']['size'];
	$image_temp = $_FILES['image']['tmp_name'];
	$allowed_ext = array ('jpg', 'jpeg', 'png', 'gif');
        $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
  
  
       $errors = array();
	    if ($image_name&&$prod_title&&$price&&$stock)
		{
				if(!preg_replace('#[^A-Za-z]#i', '',$prod_title))
					{
					
					$errors[] = '<div class="alert alert-error">The <strong>Product name</strong> contains invalid characters</div>';
				
					}
					if(!preg_replace('#[^0-9]#i', '',$price))
					{
					
					$errors[] = '<div class="alert alert-error">The <strong>Price</strong> contains invalid characters</div>';
				
					}
					if(!preg_replace('#[^0-9]#i', '',$stock))
					{
					
					$errors[] = '<div class="alert alert-error">The <strong>Stock</strong> contains invalid characters</div>';
				
					}	
						
					 if (in_array($image_ext, $allowed_ext ) === false)
				
						{
								$errors[] = "<div class='alert alert-error'>File type not allowed</div>";			
						}
					if ($image_size > 9097152)
						{
                            $errors[] = "<div class='alert alert-error'>Maximum file size is 2mb</div>";	
                        }
						
								if (!empty($errors)) 
									{
										foreach ($errors as $error) 
										{
											echo $error, '<br/>';
										}
									}
				else{
							include ('../include/thumb.php');   
					
                            mysql_query("INSERT INTO products VALUES('', '$prod_title', '$price','$prod_desc','$stock', '$category','$brand','$display', now() ,now(),'$image_ext')");
                            $imageid = mysql_insert_id();
                            $image_file = $imageid.'.'.$image_ext;
                       move_uploaded_file($image_temp, '../img/product_image/'.$image_file);
	
                            //create_thumb('../inc/uploads/', $image_file, '../inc/uploads/thumbs/');
                            
                            echo "<div class='alert alert-success'>Successfully added </div>";			
					}				
			
		}
		else
		{
			 echo "<div id='alert alert-error'>Please fill in all fields</div>";
		}
    
}
?>

  <fieldset> 
      <form id="imageform" method="post" enctype="multipart/form-data" action='' style="clear:both">    
           
   <div class="form-group col-lg-12">
      <label for="exampleInputPassword">Book title</label>
      <input type="text" class="form-control" name="prod_title" id="prod_title" placeholder="Product name">
    </div>
    <div class="form-group col-lg-12">
      <label for="exampleInputPassword">Category</label>
    	 <select class="form-control" name="category" id="slct1" onchange="populate(this.id,'slct2')">
         	<?php
                                        $cat_query = mysql_query("SELECT * FROM category");

                                        while($row = mysql_fetch_array($cat_query))
                                        {
                                            $cat_name = $row['cat_name'];
                                            $cat_id = $row['cat_id'];

                                             echo '<option value="'.$cat_id.'">'.$cat_name.'</option>';
                                        }
               ?>
          </select>                     
    </div>
 <div class="form-group col-lg-12">
  <label for="exampleInputPassword">Author</label>
      <select  class="form-control" name="brandname" id="slct2" onchange="populate(this.id,'slct2')">
         	<?php
                                        $cat_query = mysql_query("SELECT * FROM brand ");

                                        while($row = mysql_fetch_array($cat_query))
                                        {
                                            $bid = $row['id'];
                      						$brand = $row['brand'];
											$category = $row['category'];

                                            echo '<option value="'.$brand.'">'.$brand.'</option>';
                                        }
               ?>
          </select> 
    </div>

    <div class="form-group col-lg-12">
      <label for="exampleInputPassword">Description</label>
<textarea name="tinyeditor" class="form-control" style="width: 400px; height: 200px" ></textarea></div>
    
     <div class="row col-lg-12">
    <div class="form-group col-lg-5">
      <label for="exampleInputPassword">Price</label>
      <input type="number" class="form-control" name="price" id="price" placeholder="Price">
    </div>
    </div>
    
     <div class="row col-lg-12">
    <div class="form-group col-lg-5">
      <label for="exampleInputPassword">Stock</label>
      <input type="number" class="form-control" name="stock" id="stock" placeholder="Stock">
    </div>
     </div>
    <hr />
      <div class="form-group col-lg-12">
  
     <label for="exampleInputFile">Add Image</label>
<div id='imageloadstatus' style='display:none'><img src="loader.gif" alt="Uploading...."/></div>
<div id='imageloadbutton'>
<input type="file" name="image" class="form-control" required="required" id="photoimg" multiple />
</div>
<hr />
   <div class="form-group col-lg-12">
         <input type="submit" name="submit" class="btn btn-primary btn-lg pull-left" value="Add Product">
        </div>
</div>
</form>
  </fieldset>