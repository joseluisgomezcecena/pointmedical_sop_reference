<div class="container-fluid">
    <div class="row flex-nowrap">
        <div class="col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark">
            <?php include("./src/includes/admin_sidebar.php") ?>
        </div>


        <div class="col py-3 mt-5 mb-5">
            <div class="container-fluid">
                <div class="card">

                    <div id="loading"  style="display:none;" class="loading text-center" >
                        <img src="assets/img/loading2.gif" alt="">
                        <p class=""> <b>Compressing and uploading your file...</b> </p>
                    </div>


                    <?php upload(); ?>
                    <form id="upload_form" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="bitrate" value="250k">
                    <div class="row p-3">
                        <h5 class="mt-4 mb-5">Upload training</h5>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="formFile" class="form-label">Select file</label>
                                <input class="form-control" type="file" name="video_file" id="formFile">
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="mb-3">
                                <label for="title" class="form-label">Title</label>
                                <input type="text" class="form-control" id="title" name="title" aria-describedby="title">
                                <div id="title" class="form-text">Mandatory field <span class="text-danger">*</span></div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="mb-5">
                                <label for="description" class="form-label">Description</label>
                                <textarea type="text" rows="8" class="form-control" id="description" name="description" aria-describedby="description"></textarea>
                                <div id="description" class="form-text">Mandatory field <span class="text-danger">*</span></div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="mb-5">
                                <input class="btn btn-primary" type="submit" name="save_video" value="Save Video" onclick="showDiv()">
                            </div>
                        </div>


                    </div>

                    </form>

                </div>
            </div>
        </div>


    </div>
</div>

<script>
    function showDiv() {
        document.getElementById('loading').style.display = "block";
        document.getElementById('upload_form').style.display = "none";
    }
</script>
