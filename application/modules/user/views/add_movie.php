<form role="form bor-rad" enctype="multipart/form-data" action="<?php echo base_url() . 'user/add_edit_movie' ?>"
      method="post">
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Title</label>
                    <input type="text" name="title" value="<?php echo isset($userData->title) ? $userData->title : ''; ?>"
                           class="form-control" placeholder="Title">
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="">Rating</label>
                    <input type="text" name="rating" value="<?php echo isset($userData->rating) ? $userData->rating : ''; ?>"
                           class="form-control" placeholder="Rating">
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group imsize">
                    <label for="exampleInputFile">Image Upload</label>
                    <div class="pic_size" id="image-holder">
                        <?php if (isset($userData->image) && file_exists('assets/images/movies/' . $userData->image)) {
                            $image = $userData->image;
                        } else {
                            $image = 'untitled.jpg';
                        } ?>
                        <left><img class="thumb-image setpropileam" id="movie_image"
                                   src="<?php echo base_url(); ?>/assets/images/movies/<?php echo isset($image) ? $image : 'untitled.png'; ?>"
                                   alt="User profile picture"></left>
                    </div>
                    <input type="file" name="image" id="exampleInputFile">
                    <input type="hidden" name="image_name" id="exampleInputFile_name">
                </div>
            </div>
        </div>
        <?php if (!empty($userData->id)) { ?>
            <input type="hidden" name="id"
                   value="<?php echo isset($userData->id) ? $userData->id : ''; ?>">
            <input type="hidden" name="fileOld"
                   value="<?php echo isset($userData->image) ? $userData->image : ''; ?>">
            <div class="box-footer sub-btn-wdt">
                <button type="submit" name="edit" value="edit" class="btn btn-success wdt-bg">Update</button>
            </div>
            <!-- /.box-body -->
        <?php } else { ?>
            <div class="box-footer sub-btn-wdt">
                <button type="submit" name="submit" value="add" class="btn btn-success wdt-bg">Add</button>
            </div>
        <?php } ?>
        <script>
            $(document).ready(function(){
                $("#exampleInputFile").change(function () {
                    var file_data = $('#exampleInputFile').prop('files')[0];
                    $("#exampleInputFile_name").val(file_data['name']);
                    var form_data = new FormData();
                    form_data.append('file', file_data);
                    $.ajax({
                        url: '<?php echo base_url();?>user/imgupload', // point to server-side PHP script
                        dataType: 'text',  // what to expect back from the PHP script, if anything
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        type: 'post',
                        success: function(php_script_response){
                            var path = "<?php echo base_url(); ?>" + php_script_response;
                            // alert(php_script_response); // display response from the PHP script, if any
                            $("#movie_image").attr("src", path);
                        }
                    });
                });
            });
        </script>
</form>
