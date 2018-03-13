<!DOCTYPE html>
<html lang="en">
<head>
<?php echo $this->load->view('layouts/headers') ?>
</head>
<body>
<link rel="stylesheet" href="<?php echo base_url()?>public/assets/css/main.css" defer>
    <div id='container'>
        <?php echo $content ?>
    </div>
</body>
<?php echo $this->load->view('layouts/footers') ?>
</html>