<link rel="stylesheet" href="<?php echo base_url();?>assets/front/global/plugins/multi-file-upload/jquery.fileupload.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets_v1/admin/css/components/common/forms/editors/wysihtml5/assets/lib/css/bootstrap-wysihtml5-0.0.2.css">
 <div class="page-content-wrapper">
    <!-- BEGIN CONTENT BODY -->
    <!-- BEGIN PAGE HEAD-->
    <div class="page-head">
        <div class="container">
            <!-- BEGIN PAGE TITLE -->
            <div class="page-title">
                <h1>
                    <?php if(isset($title)){ echo $title;}?>                                
                </h1>
                
            </div>
            <div class="page-title pull-right">
            	<a href="all_invitations" class="btn btn-primary ">My Invites</a>
            </div>
        </div>
    </div>
    <!-- END PAGE HEAD-->
    <!-- BEGIN PAGE CONTENT BODY -->
    <div class="page-content">
        <div class="container">
            <!-- BEGIN PAGE CONTENT INNER -->
            <div class="page-content-inner">
                <div class="left-post">
                  <div class="portlet light" style="min-height:479px;">
                    <!--<div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject font-dark sbold uppercase"><?php if(isset($title)){ echo $title;}?>
                            Form
                            </span>
                        </div>
                        <div class="actions">
                            
                        </div>
                    </div>-->
                    <div class="portlet-body form">
                     <?php if ($this->session->flashdata('message')) { ?>
                        <div class="alert alert-info"> 
                            <?= $this->session->flashdata('message') ?> 
                        </div>
                    <?php } ?>
                    <form class="form-horizontal" role="form"  id="surveyForm" method="post" onsubmit="return check_empty_email()"><!--invite_users-->
                        <div class="form-body">
                            <section class="email_fields">
                            <div class="form-group">
                                <label class="col-md-3 control-label">Who would you like to invite?</label>
                                <div class="col-md-4">
                                    <input type="text" class="form-control emailfield" name="email[0]"  id="email" />
                                    <style>
									.form-horizontal .radio
									{
										padding-top: 0px;
									}
									 .radio  input[type=radio]
									 {
    									margin-left: -10px;
									 }
									</style>
                                </div>
                                <div class="col-md-3">
                                    <input type="radio" name="type[0]" value="2" checked="checked" >Owner
                                    <input type="radio" name="type[0]" value="1" >Tenant
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-default addButton" onclick="add_email()"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                            </section>
                            
                            <div class="form-group">
                                <label class="col-md-3 control-label">Description</label>
                                <div class="col-md-9"><!--wysihtml5-->
                                      <textarea name="invite_message" id="invite_message" placeholder="Invite Message" 
                                      class="form-control  " rows="5" readonly="readonly">Hi, 
I would like to invite you to join ALIA, our very own community platform. We can do almost everything online such as booking a facility, request for a service, communicate with our neighbours, pre-register our visitors, pay and manage our condo expenses, all these for absolutely FREE.</textarea>
                                      <span id="invite_message_validate" class="error_individual help-block"></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-3 col-md-9">
                                    <button type="submit" name="send_email_btn" id="send_email_btn" class="btn green">Send Email</button>
                                    <button type="button" class="btn default">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                  </div>        
                </div>

                 <?php echo $this->load->view('template/sidebar');?>
                
                
            </div>
        </div>
    </div>
</div>
<script>
function add_email()
{
		var lenth = $('.email_fields .form-group').length;
		if(lenth>3)
		{ 
			alert("More than 4 emails are not allowed.");
			return false;//this will stop add progress bar
		}
	var ran = "";
	var charset = "123456789";
	for( var i=0; i < 5; i++ )
		ran += charset.charAt(Math.floor(Math.random() * charset.length));
	$('.email_fields').append('<div class="form-group '+ran+'"><label class="col-md-3 control-label">Who would you like to invite?</label><div class="col-md-4"><input type="text" class="form-control emailfield" name="email['+ran+']" /></div><div class="col-md-3">&nbsp;<input type="radio" name="type['+ran+']" value="2" checked="checked" >Owner &nbsp;<input type="radio" name="type['+ran+']" value="1" >Tenant</div><div class="col-md-2"><button type="button" class="btn btn-default addButton" onclick="remove_email(&#39;'+ran+'&#39;)"><i class="fa fa-minus"></i></button></div></div>');
}
function remove_email(emailclass)
{
	$('.'+emailclass).remove();
}
function check_empty_email()
{
	divs  = $('.emailfield')
	for(ind in divs){
	  div = divs[ind];
	  //alert(div.value);
	  var x =div.value;
		var atpos = x.indexOf("@");
		var dotpos = x.lastIndexOf(".");
		
		if (x=='') {
			alert("Please enter e-mail address");
			return false;
		}
		if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
			alert("Not a valid e-mail address");
			return false;
		}
	  //do whatever you want
	}
        //alert($(this).val())
		
}
</script>