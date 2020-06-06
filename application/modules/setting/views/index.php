<!-- page content -->
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper settingPage">
    <!-- Main content -->
    <section class="content">
      <?php if($this->session->flashdata("message")){?>
        <div class="alert alert-info alert-dismissible"  role="alert">      
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <?php echo $this->session->flashdata("message")?>
        </div>
      <?php } ?>
      <!-- Default box -->
      <div class="box box-success" >
        <div class="box-header with-border">
          <h3 class="box-title">Halaman Data Student </h3>
        </div>
        <div class="box-body" style="background: rgb(249, 250, 252);">
            <div class="row">
                <div class="col-md-6">
                    <button type="button" class="mb-xs mt-xs mr-xs btn btn-primary btn-lg btn-block">Tambah Data</button>
                </div>
                <div class="col-md-6">
                    <button type="button" class="mb-xs mt-xs mr-xs btn btn-primary btn-lg btn-block">Cetak Datat</button>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">

                    <table class="table" id="StudentTable">
                        <thead>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Content</th>
                        <th>Reviewed At</th>
                        <th>Action</th>
                        </thead>
                        <tbody>
                        <?php $i = 1;?>
                        <?php foreach ($all_reviews as $review): ?>
                            <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo $review->name ?></td>
                                <td><?php echo $review->email; ?></td>
                                <td><?php echo $review->phone_number; ?></td>
                                <td><?php echo $review->content; ?></td>
                                <td><?php echo $review->created_at; ?></td>
                                <td>
                                    <form action="<?php echo base_url();?>about/delete_review/<?php echo $review->id?>">
                                        <input type="submit" class="btn btn-danger" value="Delete">
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
            <!-- /.box-body -->
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
<script type="text/javascript">
    $(document).ready(function () {
        var table = $('#StudentTable').DataTable({})
    })
</script>
  <!-- /page content -->