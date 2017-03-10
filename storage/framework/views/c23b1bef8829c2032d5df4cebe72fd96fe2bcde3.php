<?php echo $__env->make('includes.header_home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->yieldContent('content'); ?>
<?php echo $__env->make('includes.footer_home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
