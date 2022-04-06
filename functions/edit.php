<?php

function edit()
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
            echo "There is a video with this title already, please update video.";
        }
        else
        {
            /***UPLOADING FILE******/
            $video = $_FILES["video_file"] ["tmp_name"];
            $video_name = $_FILES["video_file"] ["name"];
            $screenshot = "uploads/screenshots/".rand().$video_name.".png";

            $target_dir = "uploads/";
            //$target_file = $target_dir . basename($_FILES["video_file"]["name"]);
            $target_file = $target_dir . rand() . $video_name;
            $uploadOk = 1;
            $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));



            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }

            if ($_FILES["video_file"]["size"] > 50000000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            if($FileType != "mp4" && $FileType != "MP4" && $FileType != "GIF"
                && $FileType != "gif" ) {
                echo "Sorry, MP4 & GIF files are allowed.";
                $uploadOk = 0;
            }

            if ($uploadOk == 0)
            {
                echo "Sorry, your file was not uploaded.";
            }
            else
            {
                if ($uploadOk == 1)
                {
                    echo "The file ". htmlspecialchars( basename( $_FILES["video_file"]["name"])). " has been uploaded.";

                    $command = "D:/xampp/htdocs/martech/point_video_site/cbt/uploads/ffmpeg/bin/ffmpeg.exe -i $video  -c:v libx264 -preset superfast -crf 40 $target_file";
                    $cmd = system($command);

                    $command2 = "D:/xampp/htdocs/martech/point_video_site/cbt/uploads/ffmpeg/bin/ffmpeg.exe -i $video -ss 00:00:14.435 -vframes 1 $screenshot";
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
                    echo "Error";
                }

            }
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
                $command = "D:/xampp/htdocs/martech/point_video_site/cbt/uploads/ffmpeg/bin/ffmpeg.exe -i $video  -c:v libx264 -preset superfast -crf 40 $target_file";
                $cmd = system($command);

                $command2 = "D:/xampp/htdocs/martech/point_video_site/cbt/uploads/ffmpeg/bin/ffmpeg.exe -i $video -ss 00:00:14.435 -vframes 1 $screenshot";
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
