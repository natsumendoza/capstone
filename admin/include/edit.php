<?php
include ('../include/connectdb.php');
$stock1="";
if (isset($_GET['id'])) {
	$targetID = $_GET['id'];
    $sql = mysql_query("SELECT * FROM products WHERE id='$targetID' LIMIT 1");
    $productCount = mysql_num_rows($sql); // count the output amount
    if ($productCount > 0) {
	    while($row = mysql_fetch_array($sql)){ 
             
			$prod_title = $row["product_name"];
			 $price = $row["price"];
			 $price = $row["price"];
			  $prod_desc  = $row["details"];
			  $category = $row["category"];
			  $sub_category = $row["sub_category"];
			    $stock1 = $row["stock"];
			  
			
			 $date_added = strftime("%b %d, %Y", strtotime($row["date_added"]));
			  $ext = $row["ext"]; 
        }
    } else {
	    echo "<div id='error'>Invalid Id</div>";
		
    }
}

?>


<?php

if (isset($_FILES['edit']))

{
        $pid = addslashes(strip_tags($_POST['id']));
		$product_name = addslashes(strip_tags($_POST['prod_title']));
        $prod_desc = $_POST['tinyeditor'];
		$entity_elm1 = htmlentities($prod_desc);
		$entity_elm1 = mysql_real_escape_string($entity_elm1);
		$price = addslashes(strip_tags($_POST['price']));
		$category1= addslashes(strip_tags($_POST['category1']));
        //$category2= addslashes(strip_tags($_POST['category2']));
		$brand= addslashes(strip_tags($_POST['brandname']));
	$image_name = $_FILES['edit']['name'];
	$image_size = $_FILES['edit']['size'];
	$image_temp = $_FILES['edit']['tmp_name'];
	$allowed_ext = array ('jpg', 'jpeg', 'png', 'gif');
        $image_ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));
  
  
       $errors = array();
	    if ($image_name&&$product_name&&$price)
		{
				if(!preg_replace('#[^A-Za-z]#i', '',$product_name))
					{
					
					$errors[] = '<div class="alert alert-success">The <strong>Product name</strong> contains invalid characters</div>';
				
					}
					
					if(!preg_replace('#[^0-9]#i', '',$price))
					{
					
					$errors[] = "<div class='alert alert-success'>The <strong>Price</strong> contains invalid characters</div>";
				
					}
						
					 if (in_array($image_ext, $allowed_ext ) === false)
				
						{
								$errors[] = "<div class='alert alert-success'>File type not allowed</div>";			
						}
					if ($image_size > 9097152)
						{
                            $errors[] = "<div class='alert alert-success'>Maximum file size is 2mb</div>";	
                        }
						
								if (!empty($errors)) 
									{
										foreach ($errors as $error) 
										{
											echo $error, '<br/>';
										}
									}
				else{
							unlink('../img/product_image/'.$pid.'.'.$image_ext);
							//unlink('inc/uploads/thumbs/'.$pid.'.'.$image_ext);
							include ('../include/thumb.php');   
					
mysql_query("UPDATE products SET product_name='$product_name',price='$price',details='$prod_desc',category='$category1',sub_category='$brand',timestamp=now(),ext='$image_ext' WHERE id='$pid'");
                           
	
                            if ($image_name&&$image_size&&$image_temp!= "") { 
						   
                            $image_file = "$pid".'.'.$image_ext;
                            move_uploaded_file($image_temp, '../img/product_image/'.$image_file);
							 //create_thumb('../img/product_image/', $image_file, '../img/product_image/');
						  }
                            
                            echo "<div class='alert alert-success'>Updated succesfully</div>";			
					}				
			
		}
		else
		{
			 echo "<h4 class='alert_warning'>Please fill in all fields</h4>";
		}
    
}
?>
  <fieldset> 
      <form id="imageform" method="post" enctype="multipart/form-data" action='' style="clear:both">    
           
   <div class="form-group col-lg-12">
      <label for="exampleInputPassword">Book Title</label>
      <input type="text" class="form-control" name="prod_title" id="prod_title" placeholder="Product name" value="<?php echo $prod_title?>">
    </div>
   <div class="form-group col-lg-12">
      <label for="exampleInputPassword">Category</label>
    	 <select class="form-control" name="category1" id="slct1">
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
      <select  class="form-control" name="brandname" id="slct2">
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
   <textarea name="tinyeditor" class="form-control" style="width: 400px; height: 200px" ><?php echo $prod_desc?></textarea>
    </div>
    <div class="row col-lg-12">
    <div class="form-group col-lg-5">
      <label for="exampleInputPassword">In Stock</label>
     <input type="number" class="form-control" readonly="readonly" name="price" id="price" placeholder="Price" value="<?php echo $stock1?>">
    </div>
     </div>
   <div class="row col-lg-12">
   <div class="form-group col-lg-5">
      <label for="exampleInputPassword">Price</label>
     PHP <input type="text" class="form-control" name="price" id="price" placeholder="Price" value="<?php echo $price?>">
    </div>
  </div>
     <div class="form-group col-lg-12">
  
     <label for="exampleInputFile">Add Image</label>
<div id='imageloadstatus' style='display:none'><img src="loader.gif" alt="Uploading...."/></div>
<div id='imageloadbutton'>
<input type="file" name="edit" class="form-control" required="required" id="photoimg" multiple />
</div>

  <div class="modal-footer">
  <input name="id" type="hidden" value="<?php echo $targetID; ?>" />
         <input type="submit" name="submit" class="btn btn-primary btn-lg pull-left" value="Update Product">
        </div>
</div>
</form>
  </fieldset>
<script>
var editor = new TINY.editor.edit('editor', {
	id: 'tinyeditor',
	width: 650,
	height: 175,
	cssclass: 'tinyeditor',
	controlclass: 'tinyeditor-control',
	rowclass: 'tinyeditor-header',
	dividerclass: 'tinyeditor-divider',
	controls: ['bold', 'italic', 'underline', 'strikethrough', '|', 'subscript', 'superscript', '|',
		'orderedlist', 'unorderedlist', '|', 'outdent', 'indent', '|', 'leftalign',
		'centeralign', 'rightalign', 'blockjustify', '|', 'unformat', '|', 'undo', 'redo', 'n',
		'font', 'size', 'style', '|', 'image', 'hr', 'link', 'unlink', '|', 'print'],
	footer: true,
	fonts: ['Verdana','Arial','Georgia','Trebuchet MS'],
	xhtml: true,
	cssfile: 'custom.css',
	bodyid: 'editor',
	footerclass: 'tinyeditor-footer',
	toggle: {text: 'source', activetext: 'wysiwyg', cssclass: 'toggle'},
	resize: {cssclass: 'resize'}
});
</script>