<!DOCTYPE html>
<head>
	<title>Agile Bowling</title>
	<link rel="stylesheet" href="<?php echo base_url('resources/css/bootstrap.min.css'); ?>">
	<link rel="stylesheet" href="<?php echo base_url('resources/css/bowling.css'); ?>">
	<script src="<?php echo base_url('resources/js/jquery-1.9.1.min.js'); ?>"></script>
	<script src="<?php echo base_url('resources/js/bootstrap.min.js'); ?>"></script>
	
</head>
<body>
	<div id="wrapper">
		<h2>Agile Bowling</h2>

		<p>Please enter your frames below</p>

		<div id="frames">
			<?php echo validation_errors(); ?>

			<?php echo form_open('bowling/create', array('class'=>'form-horizontal')); ?>
				<?php for($i=1; $i < 11; $i++): ?>
					<div class="control-group">
						<label for="frame<?=$i?>" class="control-label">Frame <?=$i?></label> 
						<div class="controls">
							<input type="input" name="frame<?=$i?>" class="frames" id="frame<?=$i?>" />
						</div>
					</div>
				<?php endfor; ?>
				
				<div class="controls">
					<input type="submit" name="submit" value="Submit Game" class="btn btn-success" /> 
				</div>

			<?php form_close(); ?>
		</div>
	</div>
</body>
</html>