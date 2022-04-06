<?php

function upload()
{
    global $connection;

    if(isset($_POST['save_video']))
    {
        $title = mysqli_real_escape_string($connection, $_POST['title']);
        $description = mysqli_real_escape_string($connection, $_POST['description']);

        $query_check = "SELECT * FROM video WHERE video_title = '$title'";
        $result_check = mysqli_query($connection, $query_check);
        if(mysqli_num_rows($result_check)==1)
        {
            //echo "There is a video with this title already, please update video.";
            echo '
                  <div class="alert alert-danger" role="alert">
                      There is a video with this title already, please update video.
                  </div>
            ';
        }
        else
        {
            /***UPLOADING FILE******/
            $video = $_FILES["video_file"] ["tmp_name"];
            $video_name = $_FILES["video_file"] ["name"];
            $video_name = trim($video_name, " ");
            $screenshot = "uploads/screenshots/".rand().$video_name.".png";

            $target_dir = "uploads/";
            //$target_file = $target_dir . basename($_FILES["video_file"]["name"]);
            $target_file = $target_dir . rand() . $video_name;
            $uploadOk = 1;
            $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));



            if (file_exists($target_file)) {
                echo '
                    <div class="alert alert-danger" role="alert">
                          Sorry, This file already exists.
                    </div>      
                    ';
                $uploadOk = 0;
            }

            if ($_FILES["video_file"]["size"] > 700000000) {
                echo '
                    <div class="alert alert-danger" role="alert">
                          Sorry, you file is to large Max Size is 700 MB.
                    </div>      
                    ';

                $uploadOk = 0;
            }

            if($FileType != "mp4" && $FileType != "MP4" && $FileType != "GIF" && $FileType != "gif" )
            {
                echo '
                    <div class="alert alert-danger" role="alert">
                          Sorry, MP4 & GIF files are allowed.
                    </div>      
                    ';
                $uploadOk = 0;
            }

            if ($uploadOk == 0)
            {
                echo '
                    <div class="alert alert-danger" role="alert">
                          Video was not uploaded.
                    </div> 
                    ';
            }
            else
            {
                if ($uploadOk == 1)
                {
                    echo "The file ". htmlspecialchars( basename( $_FILES["video_file"]["name"])). " has been uploaded.";

                    $command = "D:/xampp/htdocs/pointmedical_videos/uploads/ffmpeg/bin/ffmpeg.exe -i $video  -c:v libx264 -preset superfast -crf 40 $target_file";
                    //$command = "E:/xampp/htdocs/pointmedical_videos/uploads/ffmpeg/bin/ffmpeg.exe -i $video  -c:v libx264 -preset superfast -crf 40 $target_file";
                    $cmd = system($command);

                    $command2 = "D:/xampp/htdocs/pointmedical_videos/uploads/ffmpeg/bin/ffmpeg.exe -i $video -ss 00:00:14.435 -vframes 1 $screenshot";
                    $cmd2 = system($command2);
                }
                else
                {
                    echo "Sorry, there was an error uploading your file.";
                }
            }


            /****FINISH UPLOAD******/

            if($uploadOk == 1)
            {
                $query_insert = "INSERT INTO video (video_title, video_description, video_url, video_screenshot) 
                VALUES
                ('$title', '$description', '$target_file', '$screenshot')";

                $run_insert = mysqli_query($connection, $query_insert);

                if(!$run_insert){
                    echo '
                    <div class="alert alert-danger" role="alert">
                          There was an error saving your file.<br>
                          Error: ' . $query_insert . '
                    </div>
                      
                    ';
                }else
                {
                    echo '
                    <div class="alert alert-success" role="alert">
                          Video Saved.
                    </div>
                      
                    ';
                }

            }
        }
    }
}







function edit()
{
    global $connection;

    if(isset($_POST['edit_video']))
    {
        $id = $_GET['id'];
        $title = mysqli_real_escape_string($connection, $_POST['title']);
        $description = mysqli_real_escape_string($connection, $_POST['description']);

        $query_check = "SELECT * FROM video WHERE video_title = '$title' AND video_id != $id";
        $result_check = mysqli_query($connection, $query_check);
        if(mysqli_num_rows($result_check)==1)
        {
            echo '
                        <div class="alert alert-danger" role="alert">
                          Theres already a file with that name.
                        </div>
                        ';
        }
        else
        {


            if(empty($_FILES['video_file'] ['name']))
            {
                $query_update = "UPDATE video SET video_title = '$title', video_description = '$description' WHERE video_id = $id;";
                $run = mysqli_query($connection, $query_update);

                if(!$run){
                    echo '
                        <div class="alert alert-danger" role="alert">
                          Error saving changes.
                        </div>
                        ';
                }
                else
                {
                    echo '
                        <div class="alert alert-success" role="alert">
                          Successfully saved.
                        </div>
                        ';

                    header("Location: index.php?page=edit_training&id=$id");
                }
            }
            else
            {
                /***UPLOADING FILE******/
                $video = $_FILES["video_file"] ["tmp_name"];
                $video_name = $_FILES["video_file"] ["name"];
                $video_name = trim($video_name, " ");
                $screenshot = "uploads/screenshots/".rand().$video_name.".png";

                $target_dir = "uploads/";
                //$target_file = $target_dir . basename($_FILES["video_file"]["name"]);
                $target_file = $target_dir . rand() . $video_name;
                $uploadOk = 1;
                $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));



                if (file_exists($target_file)) {
                    echo '
                    <div class="alert alert-danger" role="alert">
                          Sorry, This file already exists.
                    </div>      
                    ';
                    $uploadOk = 0;
                }

                if ($_FILES["video_file"]["size"] > 700000000) {
                    echo '
                    <div class="alert alert-danger" role="alert">
                          Sorry, you file is to large Max Size is 700 MB.
                    </div>      
                    ';
                    $uploadOk = 0;
                }

                if($FileType != "mp4" && $FileType != "MP4" && $FileType != "GIF"
                    && $FileType != "gif" ) {
                    echo '
                    <div class="alert alert-danger" role="alert">
                          Sorry, MP4 & GIF files are allowed.
                    </div>      
                    ';
                    $uploadOk = 0;
                }

                if ($uploadOk == 0)
                {
                    echo '
                    <div class="alert alert-danger" role="alert">
                          Sorry, video was not uploaded.
                    </div>      
                    ';                }
                else
                {
                    if ($uploadOk == 1)
                    {
                        echo "The file ". htmlspecialchars( basename( $_FILES["video_file"]["name"])). " has been uploaded.";

                        $command = "E:/xampp/htdocs/pointmedical_videos/uploads/ffmpeg/bin/ffmpeg.exe -i $video  -c:v libx264 -preset superfast -crf 40 $target_file";
                        $cmd = system($command);

                        $command2 = "E:/xampp/htdocs/pointmedical_videos/uploads/ffmpeg/bin/ffmpeg.exe -i $video -ss 00:00:14.435 -vframes 1 $screenshot";
                        $cmd2 = system($command2);
                    }
                    else
                    {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }


                /****FINISH UPLOAD******/

                if($uploadOk == 1)
                {
                    $query_insert = "UPDATE video  SET video_title = '$title', video_description = '$description', video_url = '$target_file', video_screenshot = '$screenshot' WHERE video_id = $id ";
                    $run_insert = mysqli_query($connection, $query_insert);

                    if(!$run_insert){
                        echo '
                            <div class="alert alert-danger" role="alert">
                                  Error while trying to update video.<br>
                                  Error: ' . $query_insert . '
                            </div>      
                            ';                    }
                    else{
                        echo '
                        <div class="alert alert-success" role="alert">
                          Successfully saved.
                        </div>
                        ';

                        header("Location: index.php?page=edit_training&id=$id");

                    }

                }
            }




        }
    }
}







function delete()
{
    global $connection;

    if(isset($_POST['delete_video']))
    {
        $id = $_GET['id'];

        $query = "DELETE FROM video WHERE  video_id = $id";
        $result = mysqli_query($connection, $query);
        if($result)
        {
            header("Location: index.php?page=dashboard");
        }
        else
        {
            echo "Failed";
        }
    }
}








function uploadVideo()
{
    global $connection;

    if (isset($_POST['save_video']))
    {
        //VIDEO UPLOAD HANDLER FFMPEG COMPRESSION
        if (empty($_FILES['video_file'] ['name']))
        {
            $uploadOk = 0;
            $error1_1 = "";
            $error1_2 = "";
        }
        else
        {
            $video = $_FILES["video_file"] ["tmp_name"];
            $video_name = $_FILES["video_file"] ["name"];
            $screenshot = "uploads/screenshots/" . rand() . $video_name . ".png";
            $target_file = "uploads/" . rand() . $video_name;
            $bitrate = $_POST['bitrate'];

            //checks
            $uploadOk = 1;
            $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            if ($_FILES["video_file"]["size"] > 999000000) {
                $uploadOk = 0;
            }

            // formatos
            if ($fileType != "mp4" && $fileType != "MP4" && $fileType != "MKV" && $fileType != "mkv") {
                $uploadOk = 0;
            }

            if ($uploadOk == 1) {
                //ultrafast, superfast, veryfast, faster, fast, medium, slow, slower, veryslow
                $command = "E:/xampp/htdocs/pointmedical_videos/uploads/ffmpeg/bin/ffmpeg.exe -i $video  -c:v libx264 -preset superfast -crf 40 $target_file";
                $cmd = system($command);

                $command2 = "E:/xampp/htdocs/pointmedical_videos/uploads/ffmpeg/bin/ffmpeg.exe -i $video -ss 00:00:14.435 -vframes 1 $screenshot";
                $cmd2 = system($command2);
            }

        }
        if ($uploadOk == 1) {
            //insert to database
            $title = mysqli_real_escape_string($connection, $_POST['title']);
            $description = mysqli_real_escape_string($connection, $_POST['description']);


            $query_insert = "INSERT INTO video (video_title, video_description, video_url, video_screenshot) 
                VALUES
                ('$title', '$description', '$target_file', '$screenshot')";

            $run_insert = mysqli_query($connection, $query_insert);

            if(!$run_insert){
                echo "Error";
            }

        }

    }

}
