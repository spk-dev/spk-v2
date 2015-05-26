<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><i class="fa fa-map-marker fa-fw"></i>Mes organisations</h1>
    </div>
    <!-- /.col-lg-12 -->
</div>

<div class="table-responsive">
    <table class="table table-bordered table-hover table-striped"  id="dataTables-example">
        <thead>
            <tr>
                <th>#</th>
                <th>Img</th>
                <th>Nom</th>
                <th>Localisation</th>
                <th>Nb evenement</th>
                <th>Actions</th>
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
    while($i<6){
?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><img src="http://lorempixel.com/60/30/city/"/></td>
                <td>event <?php echo generateRandomString(); ?></td>
                <td>typ_<?php echo generateRandomString(); ?></td>
                <td><?php echo rand(0, 10); ?></td>

                <td>
                    <div class="tooltip-demo">
                        <a href=""><button type="button" class="btn btn-warning btn-circle" data-toggle="tooltip" data-placement="top" title="Voir"><i class="fa fa-search fa-fw"></i></button></a>
                        <a href=""><button type="button" class="btn btn-success btn-circle" data-toggle="tooltip" data-placement="top" title="Modifier"><i class="fa fa-pencil fa-fw"></i></button></a>
                        <a href=""><button type="button" class="btn btn-primary btn-circle" data-toggle="tooltip" data-placement="top" title="Voir sur le site"><i class="fa fa-globe fa-fw"></i></button></a>
                    </div>
                </td>
            </tr>
            
            
            <?php
    $i++;
            
    }
            ?>
        </tbody>
    </table>
</div>