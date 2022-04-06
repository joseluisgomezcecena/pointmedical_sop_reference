<?php
$id = $_GET['id'];
$query = "SELECT * FROM video WHERE video_id = $id";
$result = mysqli_query($connection, $query);
$row = mysqli_fetch_array($result);
?>
<div class="container-fluid">
    <dic class="row">
        <div class="col-md-12 col-sm-12 col-lg-9">
            <h5 class="mt-4 mb-3"><?php echo $row['video_title']; ?></h5>
            <iframe width="100%" height="400" src="<?php echo $row['video_url'] ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <div class="card">
                <div class="card-body">
                    <h5 class="mt-4 mb-2"><?php echo $row['video_title']; ?></h5>
                    <small class="text-muted"><i class="fa-solid fa-upload me-4"></i><b>Uploaded:</b> <?php echo date_format( date_create($row['created_at']), "m/d/Y" )  ?></small><br>
                    <!--
                    <small class="text-muted"><i class="fa-solid fa-city me-4"></i><b>Department:</b> Purchasing</small><br>
                    <small class="text-muted"><i class="fa-solid fa-tags me-4"></i><b>Category:</b> Programacion</small>
                    -->
                    <p class="mt-3"><?php echo $row['video_description']; ?></p>
                    <!--
                    <div class="d-flex justify-content-end">
                        <button class="btn btn-success border-2">
                            <i class="fa-solid fa-certificate me-2"></i>
                            Get Certificate!
                        </button>
                    </div>
                    -->
                </div>
                <div class="card-footer">
                    <!--
                    <span><i class="fa-solid fa-eye me-4"></i>348 Views</span>
                    -->
                </div>
            </div>
        </div>
        <div class="col-md-12 col-lg-3 col-sm-12">
            <h5 class="mt-4 mb-3">Recent Videos</h5>
            <div class="row">

                <?php
                $query = "SELECT * FROM video ORDER BY video_id DESC LIMIT 3";
                $result = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_array($result)):
                ?>

                <div class="col-md-6 col-lg-12 col-sm-12 mb-2">
                    <div class="card">
                        <img width="100%" height="200" src="<?php echo $row['video_screenshot'] ?>"   >
                        <div class="card-body">
                            <h6 class="mb-2"><?php echo $row['video_title'] ?></h6>
                            <p class="text-truncate text-muted"><?php echo $row['video_description'] ?></p>
                        </div>
                    </div>
                </div>

                <?php endwhile; ?>

                <!--
                <div class="col-md-6 col-lg-12 col-sm-3 mb-2">
                    <div class="card">
                        <iframe width="100%" height="200" src="https://www.youtube.com/embed/Y4hfWBJ-UzY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                        <div class="card-body">
                            <h6 class="mb-2">Curso VueJS | Tutorial en Español [Desde Cero]</h6>
                            <p class="text-truncate text-muted">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sequi doloribus quia dignissimos mollitia beatae, magni, quo rerum excepturi sunt, ducimus voluptates. Totam nam animi autem ullam, facere aperiam corporis asperiores.</p>
                        </div>
                    </div>
                </div>
                -->

            </div>
    </dic>
</div>
