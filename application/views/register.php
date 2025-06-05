
<div class="bg-light d-flex align-items-center position-relative min-vh-100 py-6">
    <?php if (isset($page_title) && $page_title == 'Register'): ?>
    <!-- Register form -->
    <div class="container <?php if(settings()->site_info == 3){echo "d-hide";} ?>">
        <div class="row cards">
            <div class="col-md-8 my-4 py-5 m-auto shadow-light bg-white rounded" data-aos="fade-up"
                data-aos-duration="300">

                <?php if (settings()->enable_registration == 0): ?>
                    <div class="mb-6 text-center">
                        <img class="mb-4" width="30%" src="<?php echo base_url('assets/front/img/not-found.png') ?>">
                        <h3 class="text-muted"><?php echo trans('registration-system-is-disabled-') ?> </h3>
                        <a class="btn btn-secondary btn-sm mt-2" href="<?php echo base_url('contact') ?>"> <?php echo trans('contact') ?>
                            </a>
                        <a class="btn btn-primary btn-sm mt-2" href="<?php echo base_url() ?>"><i
                                class="icon-home"></i> <?php echo trans('home') ?> </a>
                    </div>
                <?php else: ?>

                <div class="text-center">
                    <h3 class="mb-0 custom-font"><?php echo trans('sign-up') ?></h3>
                    <p class="mb-0"><?php echo trans('create-an-account') ?></p>
                </div>

                <div class="mt-5 px-7 row">
                    <div class="col-md-6 px-0">
                        <span class="btn btn-secondary py-2 mentor_register_btn mb-2 btn-block fs-15"><i class="bi bi-person-workspace"></i> <?php echo trans('mentor') ?></span>
                    </div>

                    <div class="col-md-6 px-0 pl-md-2">
                        <span class="btn py-2 border-1 mentee_register_btn mb-2 btn-block fs-15"><i class="bi bi-person-badge"></i> <?php echo trans('mentee') ?></span>
                    </div>
                </div>

                <div class="mb-4 mt-4 pl-5">
                    <div class="success text-success"></div>
                    <div class="success_extend text-success"></div>
                    <div class="error text-danger"></div>
                    <div class="warning text-warning"></div>
                </div>

                <form id="register_form" class="authorization__form authorization__form--shadow leave_con px-5" method="post"
                    action="<?php echo base_url('auth/register_user'); ?>">

                    <div class="row">
                        
                        <div class="col-12 mt-2">
                            <div class="form-group">
                                <label class="mb-1"><?php echo trans('name') ?> <span class="text-danger">*</span></label>
                                <input type="text" required class="form-control" name="name">
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label class="mb-1"><?php echo trans('email') ?> <span class="text-danger">*</span></label>
                                <input type="email" class="form-control" name="email" placeholder="" required>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group">
                                <label class="mb-1"><?php echo trans('password') ?> <span class="text-danger">*</span></label>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                        </div>

                        <div class="col-12 mentor_category">
                            <div class="form-group">
                                <label class="mb-1"><?php echo trans('categories') ?> <span class="text-danger">*</span></label>
                                <select name="category" class="register_category select2 wide w-100 form-control" required >
                                    <option value=""> <?php echo trans('select') ?></option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?php echo html_escape($category->id)?>"> <?php echo html_escape($category->name)?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 mentor_skill">
                            <div class="form-group">
                                <label><?php echo trans('skills') ?><span class="text-danger">*</span></label>
                                <select class="form-control select2" name="skills[]" id="register_skills" multiple required>                
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-6">
                            <div class="form-group">
                                <label><?php echo trans('country') ?> <span class="text-danger">*</span></label>
                                <select class="form-control select2" name="country" required>
                                    <option value=""><?php echo trans('select') ?></option>
                                    <?php foreach ($countries as $country): ?>
                                        <option value="<?php echo html_escape($country->id) ?>"><?php echo html_escape($country->name) ?></option>
                                    <?php endforeach ?>                 
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-6">
                            <div class="form-group">
                                <label><?php echo trans('time-zone') ?> <span class="text-danger">*</span></label>
                                <select class="form-control select2" name="time_zone" required>
                                    <option value=""><?php echo trans('select') ?></option>
                                    <?php foreach ($time_zones as $time): ?>
                                      <option value="<?php echo html_escape($time->id) ?>"><?php echo html_escape($time->name) ?></option>
                                    <?php endforeach ?>                 
                                </select>
                            </div>
                        </div>

                    </div>


                    <div class="row mt-2">
                        <div class="col-md-12">
                            <?php if (settings()->enable_captcha == 1 && settings()->captcha_site_key != ''): ?>
                            <div class="g-recaptcha pull-left"
                                data-sitekey="<?php echo html_escape(settings()->captcha_site_key); ?>"></div>
                            <?php endif ?>
                        </div>
                    </div>


                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" name="agree" class="custom-control-input agree_btn"
                                    id="terms-condition" required>
                                <label class="custom-control-label" for="terms-condition">
                                    <?php echo trans('i-have-read-and-understood-the') ?> 
                                    <a class="text-primary" href="<?php echo base_url('page/terms-and-condition') ?>"><?php echo trans('terms-and-conditions') ?></a>
                                    <?php echo trans('and') ?> 

                                    <a class="text-primary" href="<?php echo base_url('page/privacy-policy') ?>"> <?php echo trans('privacy-policy') ?> </a><?php echo trans('of-this-site') ?>.
                                </label>
                            </div>
                        </div>

                        <div class="col-md-12 center">
                            <input type="hidden" name="register_type" value="1" class="register_type">
                            <input type="hidden" name="plan"
                                value="<?php if(isset($_GET['plan'])){echo html_escape($_GET['plan']);}else{echo "basic";} ?>">
                            <input type="hidden" name="billing"
                                value="<?php if(isset($_GET['billing'])){echo html_escape($_GET['billing']);}else{echo "monthly";} ?>">
                            <input type="hidden" name="<?php echo html_escape($this->security->get_csrf_token_name());?>"
                                value="<?php echo html_escape($this->security->get_csrf_hash());?>">
                            <button type="submit" class="btn btn-primary btn-block mt-4 mb-0 register_button">
                                <?php echo trans('register') ?>
                            </button>
                        </div>
                    </div>


                    <div class="text-center text-small mt-4">
                        <span><?php echo trans('already-have-an-account') ?> <a href="<?php echo base_url('login') ?>"><?php echo trans('sign-in') ?></a></span>
                    </div>

                </form>
                
                <?php endif ?>

            </div>
        </div>
    </div>
    <!-- End register form -->
    <?php endif; ?>


    <?php if (isset($page_title) && $page_title == 'Email Verification'): ?>
    <!-- email verify -->
    <div class="container">
        <div class="row justify-content-center justify-content-lg-start">
            <div class="col-md-8 col-lg-7 col-xl-5 offset-lg-2 offset-xl-3 my-5" data-aos="fade-down" data-aos-duration="400">
                    <?php $verify_type = $_GET['type']; ?>
         
                    <div class="mb-3 text-center">
                        <img class="mb-4" width="30%" src="<?php echo base_url('assets/front/img/message.png') ?>">
                        <p><?php echo trans('we-have-send-a-verification-code-in-your') ?> <?php if($verify_type == 'sms'){echo trans('phone');}else{echo trans('email');} ?>.</p>
                    </div>

                    <form id="verify_from" method="post" action="<?php echo base_url('auth/verify_account'); ?>">

                        <div class="row justify-content-center">
                            <div class="col-6 mb-2">
                                <div class="form-group">
                                    <input type="text" class="form-control text-center" name="code" placeholder="<?php echo trans('enter-code-here') ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-6">
                                <input type="hidden" name="type" value="<?php echo html_escape($verify_type) ?>">
                                <input type="hidden" name="<?php echo html_escape($this->security->get_csrf_token_name());?>" value="<?php echo html_escape($this->security->get_csrf_hash());?>">
                                <button type="submit" class="btn btn-success btn-block mb-0 verify_btn"><i class="fas fa-check-circle"></i> <?php echo trans('verify-code') ?></button>
                            </div>
                        </div>


                        <div class="loader mb-2 mt-4 text-primary text-center hide"><?php echo trans('sending') ?> <i class="fa fa-spinner fa-spin"></i></div>

                        <div class="text-center text-small mt-2">
                            <?php if ($verify_type == 'sms'): ?>
                                <span><?php echo trans('dont-received-any-code') ?><a class="resend_mail" href="<?php echo base_url('auth/resend_sms') ?>"><?php echo trans('resend') ?></a></span>
                            <?php else: ?>
                                <span><?php echo trans('dont-received-any-code') ?><a class="resend_mail" href="<?php echo base_url('auth/resend') ?>"><?php echo trans('resend') ?></a></span>
                            <?php endif ?>

                            <p><a class="btn btn-light-secondary btn-sm mt-2" href="<?php echo base_url() ?>"><i
                                class="fas fa-long-arrow-alt-left"></i> <?php echo trans('back') ?> </a></p>
                        </div>

                    </form>

            </div>
        </div>
    </div>
    <!-- End email verify -->
    <?php endif ?>
</div>