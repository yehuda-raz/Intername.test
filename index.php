
<!DOCTYPE html>
<html>
 <head>
	<title>Yehuda Raz - Intername Test</title>  
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<!-- Latest compiled and minified CSS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/open-iconic/1.1.1/font/css/open-iconic-bootstrap.min.css" />

	<link rel="stylesheet" href="css/style.css" />
	<script src="js/script.js"></script>


	
 </head>

 <body>
 	 <header>
	    <h1>Yehuda Raz - Intername.test</h1>
	 </header>



	
	<main>

		<?php include './lib/_cookie.php'; 
		$sendName = intername_getCookie('send');

		if(!is_null($sendName)):
			?>
			<div class="alert alert-success alert-dismissible fade show" role="alert">
		  		<strong><?php echo $sendName ;?></strong> Thank you for submitting this post
		  		<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
			<?php

			intername_setCookie('send','',-100);

		endif;

		?>
		<div class="container">
	  		<div class="form-container">
	    
	    		<?php include './lib/_init.php'; ?>

				<form id="add_post"class="row" method="post">
				
					<?php $Err = draw_massage($add_post_massage, 'name');?>
					<div class="form-group col-md-6" >
							<label class="col-form-label">User name</label>
							<input type="text" name="name" value="<?php echo $data['name']; ?>" class="form-control <?php echo $Err['valid'] ?> " data-validator='notempty' data-name='name' placeholder="Enter your name" >
							<div class="feedback <?php echo $Err['feedback'] ?>"><?php echo $Err['msg'] ?>.</div>
					</div>
	 
	 				<?php $Err = draw_massage($add_post_massage, 'email'); ?>		
					<div class="form-group col-md-6">
							<label class="col-form-label">User email</label>
							<input type="text" name="email" value="<?php echo $data['email']; ?>" class="form-control <?php echo $Err['valid'] ?>" data-validator='email' data-name='email' placeholder="Enter your Email address" >
							<div class="feedback <?php echo $Err['feedback'] ?>"><?php echo $Err['msg'] ?>.</div>
					</div>

					<?php $Err = draw_massage($add_post_massage, 'title'); ?>	
					<div class="form-group">
							<label class="col-form-label">Post title</label>
							<input type="text" name="title" value="<?php echo $data['title']; ?>" class="form-control <?php echo $Err['valid'] ?>" data-validator='notempty'  data-name='title' placeholder="Add new category" >
							<div class="feedback <?php echo $Err['feedback'] ?>"><?php echo $Err['msg'] ?>.</div>
					</div>

					<?php $Err = draw_massage($add_post_massage, 'body'); ?>		
					<div class="form-group">
							<label class="col-form-label">Post body</label>
							<textarea name="body" value="<?php echo $data['body']; ?>" class="form-control <?php echo $Err['valid'] ?>" data-validator='notempty' data-name='body' rows="4" cols="50"></textarea>
							<div class="feedback <?php echo $Err['feedback'] ?>"><?php echo $Err['msg'] ?>.</div>
					</div>

					<div class="form-group">
				 		<input type="submit" class="action-button signup-button" value="submit"/>
                  	</div>

				</form>

			   
			 </div>
		</div>
	</main>

	 <footer>
	  	<div class="content"><p>Developed by <a href="mailto:yodda23@gmail.com">yodda23@gmail.com</a></p></div>
	</footer>



</body>
</html>
