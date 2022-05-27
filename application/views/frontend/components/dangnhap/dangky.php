<?php echo form_open('dang-ky'); ?>
<section id="product-detail">
	<div class="container">
		<div class="col-md-3 col-sm-3 hidden-xs"></div>
		<div class="col-md-6 col-sm-6 col-xs-12">
			<div class="products-wrap">
				<div class="accordion accordion-lg divcenter nobottommargin clearfix" style="max-width: 550px;">
					<div id="register">
						<div class="acctitle acctitlec">Đăng ký tài khoản</div>
						<?php 
						if(isset($success))
							echo '<h4 style="color:green;">'.$success.'</h4>';
						?>
						<div class="acc_content clearfix" style="display: block;">
							<form accept-charset="UTF-8" action="" id="customer_register" method="post">
								
								<input name="FormType" type="hidden" value="customer_register">
								<input name="utf8" type="hidden" value="true"> 
								<div class="col_full">
									<label for="first_name">Tên đăng nhập:<span class="require_symbol">*</span></label>
									<input type="text" id="first_name" name="username" value="<?php echo set_value('username','') ?>" class="form-control" placeholder="Tên đăng nhập">
									<div class="error" id="username_error"><?php echo form_error('username')?></div>
								</div> 
								<div class="col_full">
									<label for="register-form-password">Mật khẩu:<span class="require_symbol">*</span></label>
									<input type="password" id="register-form-password" value="<?php echo set_value('password','') ?>" name="password" placeholder="Mật khẩu" class="form-control">
									<div class="error" id="password_error"><?php echo form_error('password')?></div>
								</div>

								<div class="col_full">
									<label for="register-form-repassword">Nhập lại mật khẩu:<span class="require_symbol">* </span></label>
									<input type="password" id="register-form-repassword" value="<?php echo set_value('re_password','') ?>" name="re_password" value="" class="form-control" placeholder="Nhập lại mật khẩu">
									<div class="error" id="re_password_error"><?php echo form_error('re_password')?></div>
								</div>
								<div class="col_full">
									<label for="first_name">Họ tên:<span class="require_symbol">*</span></label>
									<input type="text" id="first_name" name="name" value="<?php echo set_value('name','') ?>" placeholder="Họ tên" class="form-control">
									<div class="error" id="name_error"><?php echo form_error('name')?></div>
								</div>              
								<div class="col_full">
									<label for="register-form-email">Email:<span class="require_symbol">*</span></label>
									<input type="email" id="register-form-email" value="<?php echo set_value('email','') ?>" name="email" class="form-control" placeholder="Nhập email">
									<div class="error" id="email_error"><?php echo form_error('email')?></div>
								</div>
								<div class="col_full">
									<label for="first_name">Số điện thoại:<span class="require_symbol">*</span></label>
									<input type="text" id="first_name" name="phone" value="<?php echo set_value('phone','') ?>" placeholder="Số điện thoại" class="form-control">
									<div class="error" id="name_error"><?php echo form_error('phone')?></div>
								</div>
								<div class="col_full">
                                            <label for="first_name" >Tỉnh/Thành phố: <span class="require_symbol">* </span></label>
                                                <select name="city" id="province" class="form-control next-select">
                                                    <option value="">--- Chọn tỉnh thành ---</option>
                                                    <?php $list = $this->Mprovince->province_all();
                                                    foreach ($list as $row) : ?>
                                                        <option  value="<?php echo $row['id']; ?>" <?php if($row['id']==set_value('city')) echo 'selected' ?>><?php echo $row['name']; ?></option>

                                                    <?php endforeach; ?>
                                                </select>
                                                <div class="error"><?php echo form_error('city') ?></div>
											</div>
                                        <div class="col_full">
                                            <label for="first_name">Quận/Huyện: <span class="require_symbol">* </span></label>
                                                <select name="DistrictId" id="district" class="form-control next-select">
													<?php if (set_value('DistrictId')) : ?>
														<?php $row = $this->Mdistrict->district_name(set_value('DistrictId')) ?>
													<option value="<?php echo set_value('DistrictId')?>"><?php echo $row?> </option>
													<?php else :?>
														<option value="">--- Chọn quận huyện ---</option>
														<?php endif; ?>
                                                </select>
                                                <div class="error"><?php echo form_error('DistrictId') ?></div>
											</div>
								<div class="col_full">
									<label for="first_name">Địa chỉ chi tiết:<span class="require_symbol">*</span></label>
									<input type="text" id="first_name" name="address" value="<?php echo set_value('address','') ?>" placeholder="Địa chỉ chi tiết" class="form-control">
									<div class="error" id="name_error"><?php echo form_error('address')?></div>
								</div>
								<div class="col_full nobottommargin">
									<button class="button button-3d button-black nomargin" id="register-form-submit" name="register-form-submit" type="submit" style="margin-bottom: 20px" value='Đăng ký'>Đăng ký</button>
									<ul>
										<li class="right" style="font-size: 18px;">Nếu đã có tài khoản, hãy <a href="<?php echo base_url()?>dang-nhap" style="font-size: 19px; color: #f89053;">Đăng nhập</a></li>
									</ul>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-md-3 col-sm-3 hidden-xs"></div>
	</div>
	<script>
$(document).ready(function(){
 $('#province').change(function(){
  var provinceid = $('#province').val();
  if(provinceid != '')
  {
   $.ajax({
    url:"<?php echo base_url(); ?>Dangnhap/dangky",
    method:"POST",
    data:{provinceid:provinceid},
    success:function(data)
    {
     $('#district').html(data);
    }
   });
  }
  else
  {
   $('#district').html('<option value="">--- Chọn quận huyện ---</option>');
  }
 });

});
</script>
</section>
