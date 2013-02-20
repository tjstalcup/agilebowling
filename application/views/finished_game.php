<!DOCTYPE html>
<head>
  <title>Agile Bowling</title>
  <link rel="stylesheet" href="<?php echo base_url('resources/css/bootstrap.css'); ?>">
  <link rel="stylesheet" href="<?php echo base_url('resources/css/bowling.css'); ?>">
  <script src="<?php echo base_url('resources/js/jquery-1.9.1.min.js'); ?>"></script>
  <script src="<?php echo base_url('resources/js/bootstrap.js'); ?>"></script>
  
</head>
<body>
  <div id="wrapper">
    <h2>Agile Bowling</h2>

    <p>Your Final Score is: <?=$score?></p>

    <?php echo anchor('/','Enter Another Score'); ?>
  </div>
</body>
</html>