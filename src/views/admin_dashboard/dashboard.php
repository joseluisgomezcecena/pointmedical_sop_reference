<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
            <?php include("./src/includes/admin_sidebar.php") ?>
        </div>
        <div class="col py-3">
            <div class="container-fluid">
                <div class="mt-4 mb-5">
                    <div class="row row-cols-1 row-cols-md-4 col-sm-12 g-4">
                        <div style="float: right;" class="col-lg-2 right">
                            <a class="btn btn-primary" href="index.php?page=upload_training">Add Video</a>
                        </div>
                    </div>
                </div>
                <div class=" mt-4 mb-5">








                    <div class="container p-3">
                        <h4 class="mb-4">Manage Videos</h4>
                        <div class="table-responsive">
                            <table id="example" class="table">
                                <thead>
                                <tr>
                                    <th class="text-center">Video</th>
                                    <th class="text-center">Details</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $query = "SELECT * FROM video";
                                $result = mysqli_query($connection, $query);
                                while($row = mysqli_fetch_array($result)):
                                    ?>
                                    <tr>
                                        <td style="width:5rem;"><img src="<?php echo $row['video_screenshot'] ?>" alt="" style="width: 15rem;"></td>
                                        <td class="w-50">
                                            <h5><?php echo $row['video_title'] ?></h5>
                                            <?php echo $row['video_description'] ?>
                                        </td>
                                        <td>
                                            <div class="btn-group d-flex align-items-center justify-content-center mt-5" role="group" aria-label="Basic mixed styles example">
                                                <a href="index.php?page=edit_training&id=<?php echo $row['video_id'] ?>" type="button" class="btn btn-warning text-light"><i class="fa fa-edit"></i></a>
                                                <a href="index.php?page=delete_training&id=<?php echo $row['video_id'] ?>" type="button" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                                <a target="_blank" href="index.php?page=courseo&id=<?php echo $row['video_id'] ?>" type="button" class="btn btn-success"><i class="fa fa-play"></i></a>
                                            </div>
                                        </td>

                                    </tr>
                                <?php endwhile; ?>

                                </tbody>
                            </table>
                        </div>
                    </div>











                </div>
            </div>
        </div>
    </div>
</div>
