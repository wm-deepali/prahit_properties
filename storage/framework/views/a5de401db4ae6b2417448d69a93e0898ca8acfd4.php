<style type="text/css">
.error{
	color: red;
}
</style>

<link rel="stylesheet" href="<?php echo e(url('/public/backend/css/bootstrap-4.css')); ?>"> 
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"> 
<link rel="stylesheet" href="//cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css"> 
<link rel="stylesheet" type="text/css" href="<?php echo e(URL('/public/backend/css/style.css')); ?>">
<link rel="stylesheet" href="<?php echo e(url('/public/css/toastr.min.css')); ?>">
<style type="text/css">
	/* Absolute Center Spinner */
	.new_loader {
	  position: fixed;
	  z-index: 999;
	  height: 2em;
	  width: 2em;
	  overflow: show;
	  margin: auto;
	  top: 0;
	  left: 0;
	  bottom: 0;
	  right: 0;
	}

	/* Transparent Overlay */
	.new_loader:before {
	  content: '';
	  display: block;
	  position: fixed;
	  top: 0;
	  left: 0;
	  width: 100%;
	  height: 100%;
	    background: radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0, .8));

	  background: -webkit-radial-gradient(rgba(20, 20, 20,.8), rgba(0, 0, 0,.8));
	}

	/* :not(:required) hides these rules from IE9 and below */
	.new_loader:not(:required) {
	  /* hide "loading..." text */
	  font: 0/0 a;
	  color: transparent;
	  text-shadow: none;
	  background-color: transparent;
	  border: 0;
	}

	.new_loader:not(:required):after {
	  content: '';
	  display: block;
	  font-size: 10px;
	  width: 1em;
	  height: 1em;
	  margin-top: -0.5em;
	  -webkit-animation: spinner 150ms infinite linear;
	  -moz-animation: spinner 150ms infinite linear;
	  -ms-animation: spinner 150ms infinite linear;
	  -o-animation: spinner 150ms infinite linear;
	  animation: spinner 150ms infinite linear;
	  border-radius: 0.5em;
	  -webkit-box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
	box-shadow: rgba(255,255,255, 0.75) 1.5em 0 0 0, rgba(255,255,255, 0.75) 1.1em 1.1em 0 0, rgba(255,255,255, 0.75) 0 1.5em 0 0, rgba(255,255,255, 0.75) -1.1em 1.1em 0 0, rgba(255,255,255, 0.75) -1.5em 0 0 0, rgba(255,255,255, 0.75) -1.1em -1.1em 0 0, rgba(255,255,255, 0.75) 0 -1.5em 0 0, rgba(255,255,255, 0.75) 1.1em -1.1em 0 0;
	}

	/* Animation */

	@-webkit-keyframes spinner {
	  0% {
	    -webkit-transform: rotate(0deg);
	    -moz-transform: rotate(0deg);
	    -ms-transform: rotate(0deg);
	    -o-transform: rotate(0deg);
	    transform: rotate(0deg);
	  }
	  100% {
	    -webkit-transform: rotate(360deg);
	    -moz-transform: rotate(360deg);
	    -ms-transform: rotate(360deg);
	    -o-transform: rotate(360deg);
	    transform: rotate(360deg);
	  }
	}
	@-moz-keyframes spinner {
	  0% {
	    -webkit-transform: rotate(0deg);
	    -moz-transform: rotate(0deg);
	    -ms-transform: rotate(0deg);
	    -o-transform: rotate(0deg);
	    transform: rotate(0deg);
	  }
	  100% {
	    -webkit-transform: rotate(360deg);
	    -moz-transform: rotate(360deg);
	    -ms-transform: rotate(360deg);
	    -o-transform: rotate(360deg);
	    transform: rotate(360deg);
	  }
	}
	@-o-keyframes spinner {
	  0% {
	    -webkit-transform: rotate(0deg);
	    -moz-transform: rotate(0deg);
	    -ms-transform: rotate(0deg);
	    -o-transform: rotate(0deg);
	    transform: rotate(0deg);
	  }
	  100% {
	    -webkit-transform: rotate(360deg);
	    -moz-transform: rotate(360deg);
	    -ms-transform: rotate(360deg);
	    -o-transform: rotate(360deg);
	    transform: rotate(360deg);
	  }
	}
	@keyframes  spinner {
	  0% {
	    -webkit-transform: rotate(0deg);
	    -moz-transform: rotate(0deg);
	    -ms-transform: rotate(0deg);
	    -o-transform: rotate(0deg);
	    transform: rotate(0deg);
	  }
	  100% {
	    -webkit-transform: rotate(360deg);
	    -moz-transform: rotate(360deg);
	    -ms-transform: rotate(360deg);
	    -o-transform: rotate(360deg);
	    transform: rotate(360deg);
	  }
	}
</style>
<?php /**PATH /home/parhitproperties/public_html/parhit-2021/resources/views/layouts/app_css.blade.php ENDPATH**/ ?>