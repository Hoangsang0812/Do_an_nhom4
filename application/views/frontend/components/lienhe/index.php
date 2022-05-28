<?php echo form_open( base_url()."lien-he"); ?>
<?php

    $user = $this->session->userdata('sessionKhachHang');
?>
<section>
	<div class="container">
		<div class="col-md-7 col-12">
			<div class="section-article contactpage" style="  padding-left: 20px;">

				<form accept-charset="UTF-8" action="<?php echo base_url() ?>lien-he" id="contact" method="post">
					<input name="FormType" type="hidden" value="contact">
					<input name="utf8" type="hidden" value="true">
					<h1 style="color: black">Liên hệ với chúng tôi</h1>				
					
					<div class="form-comment">
						<div class="row" style="padding-left: 14px;">
							<div class="col-md-4 col-12">
								<div class="form-group" style="width: 200px;">
									<label for="name"><em> Họ tên</em><span class="required">*</span></label>
									<input id="name" name="fullname" type="text" value="<?php if ($this->session->userdata('sessionKhachHang')) echo $user['fullname'] ?>" class="form-control">
								</div>
								<div class="error"><?php echo form_error('fullname') ?></div>
							</div>
							<div class="col-md-4 col-12">
								<div class="form-group" style="width: 200px;">
									<label for="email"><em> Email</em><span class="required">*</span></label>
									<input id="email" name="email" class="form-control" type="email" value="<?php if ($this->session->userdata('sessionKhachHang')) echo $user['email'] ?>">
								</div>
								<div class="error"><?php echo form_error('email') ?></div>
							</div>
							<div class="col-md-4 col-12">
								<div class="form-group" style="width: 200px;">
									<label for="phone"><em> Số điện thoại</em><span class="required">*</span></label>
									<input type="number" id="phone" class="form-control" name="phone" value="<?php if ($this->session->userdata('sessionKhachHang')) echo $user['phone'] ?>">

								</div>
								<div class="error"><?php echo form_error('phone') ?></div>
							</div>
						</div>
						<div class="form-group">
							<label for="message"><em> Tiêu đề</em><span class="required">*</span></label>
							<textarea id="message" name="title" class="form-control custom-control" rows="2" ></textarea>
						</div>
						<div class="error"><?php echo form_error('title') ?></div>
						<div class="form-group">
							<label for="message"><em> Lời nhắn</em><span class="required">*</span></label>
							<textarea id="message" name="content" class="form-control custom-control" rows="5"></textarea>
						</div>
						<div class="error"><?php echo form_error('content') ?></div>
						<button type="submit" class="btn-update-order" >Gửi nhận xét</button>

					</div>
				</form>
			</div>
		</div>
		<div class="col-md-4 col-12">
			<div class="f-contact" style="
			padding-left: 32px;
			">
			<h1 style="color: black">Thông tin liên hệ</h1>
			<ul class="list-unstyled">
				<li class="clearfix">
					<i class="fa fa-map-marker fa-1x" style="color:#0f9ed8; padding: 20px; "></i>
					<span style="color: black"> Phúc Sơn, Vũ Ninh, TP Bắc Ninh, Bắc Ninh</span><br>
				</li>
				<li class="clearfix">
					<i class="fa fa-phone fa-1x" style="color:#0f9ed8;padding: 20px;  "></i>
					<span style="color: black">0123456789 - 0123456789</span>
				</li>
				<li class="clearfix">
					<i class="fa fa-envelope fa-1x " style="color:#0f9ed8; padding: 20px; "></i>
					<span style="color: black"><a href="">9orangestore@gmail.com</a></span>
				</li>
			</ul>
		</div>

	</div>
	<div class="col-md-12 col-lg-12 col-xs-12 col-12">

		<div style="margin-top: 15px;">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3719.9503911714337!2d106.0717994147868!3d21.194129587488444!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31350c1887cabd39%3A0x272d34d083ce6f04!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBLaW5oIELhuq9j!5e0!3m2!1svi!2s!4v1651232295667!5m2!1svi!2s" width="1000" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
		</div>
	</div>
</div>

</section>