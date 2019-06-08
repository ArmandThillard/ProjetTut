<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org.TR.html4/loose.dtd">
<html>
<head>
	<meta charset="utf-8" />
      <title>Title</title>
</head>
<?php
    require('./header.php');
?>
<body>

	<div class="container text-center">
		<h1>Title</h1></br>
		<form  method=post action="#">
			<div class="form-group row ">
	        	<label class="col-sm-1 col-form-label col-sm-offset-2">Civilité </label>
				<div class="col-sm-2 col-sm-offset-2">
					<input class="form-control-sm" type="radio" name="civ" value="M."> M.</input>
					<input class="form-control-sm" type="radio" name="civ" value="Mme"> Mme</input>
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-1 col-form-label col-sm-offset-2">Label</label>
				<div class="col-sm-4 col-sm-offset-1">
					<input name='#' type=text class="form-control " />
				</div>
			</div>
			<div class="form-group row">
				<label class="col-sm-1 col-form-label col-sm-offset-2">Label </label>
				<div class="col-sm-4 col-sm-offset-1">
					<input class="form-control" name='#' type=text />
				</div>
			</div>

			<button type=submit class="btn btn-success" name="submit">Envoyer</>

		</form>
	</div>
</body>
</html>
