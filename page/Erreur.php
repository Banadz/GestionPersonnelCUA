<?php if (count($_SESSION['theErr']) > 0){?>
    <div style="color:green; backgrounf:#f2fefe;">
        <?php foreach($_SESSION['theErr'] as $faut): ?>
            <p><?php echo $faut;?></p>
        <?php endforeach ?>
    </div>
<?php }?>