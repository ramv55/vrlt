<?php $__env->startSection('content'); ?>
	<div class="container">
        <div class="row vertical-offset-100">
            <div class="col-sm-6 col-sm-offset-3  col-md-5 col-md-offset-4 col-lg-4 col-lg-offset-4">
              <div id="container_demo">
                    <a class="hiddenanchor" id="toregister"></a>
                    <a class="hiddenanchor" id="tologin"></a>
                    <a class="hiddenanchor" id="toforgot"></a>
                    <div id="wrapper">
                        <div id="login" class="animate form">

								<?php echo e(Form::open(array('url' => 'login'))); ?>

                                <h3 class="black_bg">
                                    <img src="img/logo.png" alt="josh logo">
                                    </h3>
                                    <h2 class="modal-title text-center" >Log In</h2>
																		<?php if(@$authfailed): ?>
																			<span style="color:#ff0000"><?php echo e($authfailed); ?></span>
																		<?php endif; ?>

                                <div class="form-group ">
                                    <label style="margin-bottom:0;" for="username" class="uname control-label"> <i class="livicon" data-name="user" data-size="16" data-loop="true" data-c="#3c8dbc" data-hc="#3c8dbc"></i> Username
                                    </label>
                                    <input id="username" name="user_name" placeholder="Enter username" value="" required/>
                                    <div class="col-sm-12">
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <label style="margin-bottom:0;" for="password" class="youpasswd"> <i class="livicon" data-name="key" data-size="16" data-loop="true" data-c="#3c8dbc" data-hc="#3c8dbc"></i> Password
                                    </label>
                                    <input type="password" id="password" name="password" placeholder="Enter a password" required/>
                                    <div class="col-sm-12">
                                    </div>
                                </div>

                                <p class="login button">
                                    <input type="submit" value="Log In" class="btn btn-success" />
                                </p>

                            <?php echo e(Form::close()); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>