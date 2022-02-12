<?php if($this->session->userdata('successmsg')){?>
<script>
toastr.options = {
					  "closeButton": true,		
					  "debug": false,
					  "positionClass": "toast-top-right",
					  "progressBar": true,
					  "onclick": null,
					  "fadeIn": 300,
					  "fadeOut": 1000,
					  "timeOut": 5000,
					  "extendedTimeOut": 1000
					}
					// show when the button is clicked
toastr.success('<?php echo $this->session->userdata('successmsg'); ?></span>','<?=$this->title?>');
</script>
<?php } ?> 
<?php if($this->session->userdata('errmsg')){?>

<script>
	toastr.options = {
					  "closeButton": true,		
					  "debug": false,
					  "positionClass": "toast-top-right",
					  "progressBar": true,
					  "onclick": null,
					  "fadeIn": 300,
					  "fadeOut": 1000,
					  "timeOut": 5000,
					  "extendedTimeOut": 1000
					}
					// show when the button is clicked
	toastr.error('<?php echo $this->session->userdata('errmsg'); ?></span>','<?=$this->title?>');
</script>
<?php } ?> 
<?php if($this->session->userdata('delmsg')){?>

<script>
	toastr.options = {
					  "closeButton": true,		
					  "debug": false,
					  "positionClass": "toast-top-right",
					  "progressBar": true,
					  "onclick": null,
					  "fadeIn": 300,
					  "fadeOut": 1000,
					  "timeOut": 5000,
					  "extendedTimeOut": 1000
					}
					// show when the button is clicked
	toastr.warning('<?php echo $this->session->userdata('delmsg'); ?></span>','<?=$this->title?>');
</script>
<?php } ?> 
