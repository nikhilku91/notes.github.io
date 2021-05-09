<?php include 'includes/connection.php';?>
<?php include 'includes/header.php';?>
<?php include 'includes/navbar.php';?>

<br><br>
<link rel="stylesheet" type="text/css" href="styles.css" media="all" />
    <link rel="stylesheet" type="text/css" href="demo.css" media="all" />
	<style>
	body {
        margin: 0px;
        padding: 0px;
        background: url('images/bg.jpg');
		background-repeat: no-repeat;
    }
	</style>

    <!-- jQuery -->
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <!-- FlexSlider -->
    <script type="text/javascript" src="js/jquery.flexslider-min.js"></script>
    <script type="text/javascript" charset="utf-8">
    var $ = jQuery.noConflict();
    $(window).load(function() {
    $('.flexslider').flexslider({
          animation: "fade"
    });
	
	$(function() {
		$('.show_menu').click(function(){
				$('.menu').fadeIn();
				$('.show_menu').fadeOut();
				$('.hide_menu').fadeIn();
		});
		$('.hide_menu').click(function(){
				$('.menu').fadeOut();
				$('.show_menu').fadeIn();
				$('.hide_menu').fadeOut();
		});
	});
  });
</script>
<body>

     <div class="slider_container">
		<div class="flexslider">
	      <ul class="slides">
	    	<li>
	    		<a href="#"><img src="images/slider/1.jpg" alt="" title=""/></a>
	    	</li>
	    	<li>
	    		<a href="#"><img src="images/slider/2.jpg" alt="" title=""/></a>
	    	</li>
	    	<li>
	    		<a href="#"><img src="images/slider/3.jpg" alt="" title=""/></a>
	    	</li>
	    	<li>
	    		<a href="#"><img src="images/slider/4.jpg" alt="" title=""/></a>
	    	</li>
	    </ul>
	  </div>
   </div>
    </div>  
</div>

</body>
</html>









































<?php include 'includes/footer.php';?>

        