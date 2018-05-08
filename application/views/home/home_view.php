<div class="row ">
	
	<div class="offset-md-4 col-md-4" >
		<div class="card">
		  <div class="card-header">
		    Login 
		  </div>
		<div class="card-body">
			<form id="login_form" class="form-horizontal" method="POST" action="<?php echo site_url('api/login') ?>">
					
					<div class="form-group">
						<label class="form-label">Username</label>
						<div class="controls">
							<input type="text" class="form-control" name="login" class="input-xlarge" placeholder="Enter Username" required="required" />
						</div>
					</div>

					<div class="form-group">
						<label class="control-label">Password</label>
						<div class="controls">
							<input class="form-control" type="password" name="password" class="input-xlarge" placeholder="Enter Password" required="required"/>
						</div>
					</div>
					
					<div class="form-group">
						<div class="controls">
							<input type="submit" class="form-control btn btn-success" name="submit" value="Login"/>
						</div>
					</div>

					<div class="form-group">
						<div class="controls">
							<a class="btn btn-primary form-control" href="<?php echo site_url('home/register');?>">Register</a>
						</div>
					</div>
				</form>	
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

$(function() {
	$('#login_form').submit(function(evt) {
		evt.preventDefault();
		var url = $(this).attr('action');
		var postData = $(this).serialize();

		$.post(url, postData, function(o) {
			if(o.result == 1)
			{	
				window.location.href='<?php echo site_url("dashboard") ?>';
				alert('Logged In');
			} else {
				alert('Invalid login');
			}
		}, 'json');
		
	});
});
</script>
