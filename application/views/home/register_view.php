<div class="row">
	<div class="offset-md-4 col-md-4" >

		<!-- error message -->
		<div id="register_form_error" class="alert alert-danger">
			
		</div>

		<div class="card">
		  <div class="card-header">
		    Register 
		  </div>
		<div class="card-body">
			<form id="register_form" class="form-horizontal" method="POST" action="<?php echo site_url('api/register') ?>">
				
				<div class="form-group"">
					<label class="control-label">Ussername</label>
					<div class="controls">
						<input class="form-control" type="text" name="login" placeholder="Enter Username" required="required" />
					</div>
				</div>

				<div class="form-group"">
					<label class="control-label">Email</label>
					<div class="controls">
						<input class="form-control" type="email" name="email" placeholder="Enter Email" required="required"/>
					</div>
				</div>

				<div class="form-group"">
					<label class="control-label">Password</label>
					<div class="controls">
						<input class="form-control" type="password" name="password" placeholder="Enter Password" required="required"/>
					</div>
				</div>

				<div class="form-group"">
					<label class="control-label">Confirm Password</label>
					<div class="controls">
						<input class="form-control" type="password" name="confirm_password" placeholder="Re Enter Password" required="required"/>
					</div>
				</div>

				<div class="form-group"">
					<div class="controls">
						<input class="form-control btn btn-primary" type="submit" name="submit" value="Register" />
					</div>
				</div>

				<div class="form-group"">
					<div class="controls">
						<a class="form-control btn btn-info" href="<?php echo site_url('home');?>">Back</a>
					</div>
				</div>

			</form>
		</div>
	</div>

		
		

	</div>
</div>

<script type="text/javascript">

$(function() {

	$('#register_form_error').hide();

	$('#register_form').submit(function(evt) {
		evt.preventDefault();
		var url = $(this).attr('action');
		var postData = $(this).serialize();

		$.post(url, postData, function(o) {
			if(o.result == 1)
			{	
				window.location.href='<?php echo site_url("dashboard") ?>';
				alert('Logged In');
			} else {
				$('#register_form_error').show();
				var output = '<ul>';
				for(var key in o.error)
				{
					var value = o.error[key];
					//console.log(value);
					output += '<li>' + key + ' : ' + value + '</li>';
				}
				output += '</ul>';

				$('#register_form_error').html(output);
			}
		}, 'json');
		
	});
});
</script>
