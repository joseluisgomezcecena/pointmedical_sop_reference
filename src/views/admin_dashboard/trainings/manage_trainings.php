<div class="container p-3">
    <h4 class="mb-4">Trainings</h4>
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
                            <a href="index.php?page=view_video&id=<?php echo $row['video_id'] ?>" type="button" class="btn btn-success"><i class="fa fa-play"></i></a>
                        </div>
                    </td>

                </tr>
            <?php endwhile; ?>

            </tbody>
        </table>
    </div>
</div>
