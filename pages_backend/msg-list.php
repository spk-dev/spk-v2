
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa  fa-envelope"></i>Messagerie </h1>
    </div>
    <!-- /.col-lg-12 -->
</div>
<div class="row">
   
    <div class="table-responsive">
    <table class="table table-hover"  id="dataTables-example">
        <thead>
            <tr>
                <th>Etat</th>
                <th>Emetteur</th>
                <th>Message</th>
                <th>Date de réception</th>
            </tr>
        </thead>
        <tbody>
<?php 

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
    $i=0;
    $star[1] = "fa-envelope";
    $star[2] = "fa-envelope-o";
    $etat[1] = "Non lu";
    $etat[2] = "Lu";
    $style[1] = "font-weight:bold;";
    $style[2] = "";
    while($i<8){
        $val = intval(rand(1, 2));
?>
        
            <tr style="<?php echo $style[$val]; ?>">
                
                <td><a href="index.php?page=msg-manage"><span class="fa <?php echo $star[$val]; ?>" aria-hidden="true"></span> 
                    <?php echo $etat[$val]; ?></a></td>
                
                <td><a href="index.php?page=msg-manage"><?php echo generateRandomString(); ?></a></td>
                <td><a href="index.php?page=msg-manage">typ_<?php echo generateRandomString(); ?>...</a></td>
                <td><a href="index.php?page=msg-manage"><?php echo rand(1, 27)."/".rand(1, 12)."/".rand(2015, 2016)?></a></td>
                
                
            </tr>
        
            
            
            <?php
    $i++;
            
    }
    ?>
        </tbody>
    </table>
</div>
