<?php echo form_open_multipart('admin/intro/update'); ?>
<div class="content-wrapper">
    <form action="<?php echo base_url() ?>admin/intro/index" enctype="multipart/form-data" method="POST" accept-charset="utf-8">
        <section class="content-header">
            <h1><i class="glyphicon glyphicon-cd"></i> Giới thiệu Store</h1>
            <div class="breadcrumb">
            <button type = "submit" class="btn btn-primary btn-sm">
					<span class="glyphicon glyphicon-floppy-save"></span>
					Lưu
</button>

            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box" id="view">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <?php if ($success = $this->session->flashdata('success')) : ?>
                                <div class="row">
                                    <div class="alert alert-success">
                                        <?php echo $this->session->flashdata('success'); ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if ($this->session->flashdata('error')) : ?>
                                <div class="row">
                                    <div class="alert alert-error">
                                        <?php echo $this->session->flashdata('error'); ?>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="row" style='padding:0px; margin:0px;'>
                                <!--ND-->


                                <textarea name="intro" id="intro" cols="30" rows="10"><?php echo $intro['intro']?></textarea>

                                <script>
                                    CKEDITOR.replace('intro', {
                                        filebrowserBrowseUrl: 'public/ckfinder/ckfinder.html',
                                        filebrowserUploadUrl: 'public/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                                        height: ['460px']
                                    });
                                </script>

                                <!-- /.ND -->
                            </div>
                        </div><!-- ./box-body -->
                    </div><!-- /.box -->
                </div>
                <!-- /.col -->

            </div>
        </section>
    </form>
    <!-- /.row -->
</div>