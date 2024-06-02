<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<div class="form-group">
	    <input type="submit" id="uploadSubmit" value="Upload" class="btn btn-info" />
        <p id="#data"></p>
	</div>
<script type="text/javascript">
   $(document).ready(function (){

    $(window).on("load", function () {
         $.ajax({
            url : "export.php",
            type : "POST",
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success : function(data){
               $.each(data.result, function(i,post){
					    //  $("#product_name").append(post.product_name); 
              //  $("#product_id").append(post.product_price); 

              var newRow =  "<div class='row update_price'>"
                    +"<div class='col-12 col-sm-12 col-md-2 text-center'>"
                            +"<img class='img-responsive' src='"+post.product_img+"' alt='prewiew' width='50' height='auto'>"
                            +"</div>"
                            +"<div class='col-12 text-sm-center col-sm-12 text-md-left col-md-6'>"
                            +"<h5 class='product-name text-secondary'><strong>"+post.product_name+"</strong></h4>"
                            + "<h5>"
                            +"<small>"+post.product_desc+"</small>"
                            +"</h4>"
                            +"</div>"
                  
                            +"<div class='col-12 col-sm-12 text-sm-center col-md-4 text-md-right  row'>"
                            +"<div class='col-3 col-sm-3 col-md-6 text-md-right' style='padding-top: 5px'>"
                            +"<h5 id='product_price' class='font-weight-bold'><span>"+post.product_price+"</span></h5>"
                            +"</div>"
                            +"<div class='col-4 col-sm-4 col-md-4'>"
                            +"<div class='quantity'>"
                            +"<input type='number'  step='1' max='99' min='1' id='"+post.product_id+"' value='"+post.product_qty+"' title='Qty' class='qty' size='4'>"    
                            +"</div>"
                            +"</div>"
                            +"<div class='col-2 col-sm-2 col-md-2 text-right'>"
                            +"<button type='button' id='.$row['product_id'].' class='btn btn-outline-danger btn-xs delete_cart'>"
                            +"<i class='fa fa-trash' aria-hidden='true'></i>"
                            +"</button>"
                            +"</div>"
                        +"</div>"
                        +"</div>"
                        +"<hr>";
                 
                        $('#data').append(newRow);
                
				});
            } 
          });
     });
    });    
</script>     