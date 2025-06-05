<div class="content-wrapper">
    <?php $this->load->view('admin/include/breadcrumb'); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <?php $this->load->view('admin/user/include/settings_menu.php'); ?>

                <div class="col-lg-9 pl-3">
                    <div class="card">
                        <div class="box-header with-border">
                          <h3 class="box-title"><?php echo trans('mentorship-profile') ?></h3>
                        </div>

                        <form method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/settings/update_mentorship_profile') ?>" role="form" class="form-horizontal pl-20">

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="custom-control custom-switch prefrence-item ml-10 mt-1">
                                              <input type="checkbox" name="booking_enable" class="custom-control-input" value="1" id="switch-eb" <?php if($user->booking_enable == 1){echo "checked";} ?>>
                                              <label class="custom-control-label" for="switch-eb"><?php echo trans('enable-booking') ?></label>
                                              <p class="text-muted"><small><?php echo trans('enable-booking-title') ?></small></p>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="custom-control custom-switch prefrence-item ml-10 mt-1">
                                              <input type="checkbox" name="status" class="custom-control-input" value="1" id="switch-sap" <?php if($user->status == 1){echo "checked";} ?>>
                                              <label class="custom-control-label" for="switch-sap"><?php echo trans('show-account-publicly') ?></label>
                                              <p class="text-muted"><small><?php echo trans('show-account-publicly-title') ?></small></p>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">

                                    <div class="col-md-12">
                                        <div class="form-group mb-4">
                                            <label><?php echo trans('category') ?></label>
                                            <select class="form-control skill_category" name="category">
                                                <option value=""><?php echo trans('select-category') ?></option>

                                                <?php foreach ($categories as $category): ?>
                                                    <option  <?php if(isset($user->category) && $user->category == $category->id){echo 'selected';} ?> value="<?php echo html_escape($category->id) ?>"><?php echo html_escape($category->name) ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="form-group">
                                            <label><?php echo trans('skills') ?></label>
                                            <select name="skill[]" class="form-control wide w-100 select2" id="category_skill" multiple>
                                                <?php foreach ($skills as $skill): ?>
                                                    <?php foreach ($user_skills as $user_skill): ?>
                                                        <?php 
                                                            if ($skill->id==$user_skill->skill_id) {
                                                                $selected='selected'; break;
                                                            }else{
                                                                $selected='';
                                                            }
                                                         ?>
                                                    <?php endforeach ?>
                                                    <option  <?php echo html_escape($selected); ?> value="<?php echo html_escape($skill->id) ?>" name="skill"><?php echo html_escape($skill->skill) ?></option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label><?php echo trans('level-of-experience') ?></label>
                                            <select class="form-control" name="level" >
                                                <option value=""><?php echo trans('select-your-experience-level') ?></option>
                                                <?php foreach (get_levels() as $level): ?>
                                                    <option value="<?php echo html_escape($level); ?>" <?php if(isset($user->level) && $user->level == $level){echo 'selected';} ?>>
                                                        <?php echo html_escape($level); ?>
                                                    </option>
                                                <?php endforeach ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label><?php echo trans('experience') ?></label>
                                            <select class="form-control" name="experience_year" >
                                                <option value=""><?php echo trans('select-your-experience') ?></option>

                                                <?php for ($i=1 ; $i <31; $i++ ): ?>
                                                    <option value="<?php echo html_escape($i); ?>" <?php if(isset($user->experience_year) && $user->experience_year == $i){echo 'selected';} ?>><?php echo html_escape($i); ?> Year</option>
                                                    
                                                <?php endfor; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-4">
                                            <label><?php echo trans('company') ?></label>
                                            <input class="form-control" type="text" name="company" value="<?php echo html_escape($user->company) ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group mb-4">
                                            <label><?php echo trans('designation') ?></label>
                                            <input class="form-control" type="text" name="designation" value="<?php echo html_escape($user->designation) ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label><?php echo trans('linkedin-profile') ?></label>
                                            <input class="form-control" type="text" name="linkedin_profile" value="<?php echo html_escape($user->linkedin_profile) ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label><?php echo trans('facebook-profile') ?></label>
                                            <input class="form-control" type="text" name="facebook_profile" value="<?php echo html_escape($user->facebook_profile) ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label><?php echo trans('instagram-profile') ?></label>
                                            <input class="form-control" type="text" name="instagram_profile" value="<?php echo html_escape($user->instagram_profile) ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label><?php echo trans('x-profile') ?></label>
                                            <input class="form-control" type="text" name="x_profile" value="<?php echo html_escape($user->x_profile) ?>">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group mb-4">
                                            <label><?php echo trans('portfolio-website') ?></label>
                                            <input class="form-control" type="text" name="portfolio" value="<?php echo html_escape($user->portfolio) ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group mb-4">
                                        <label><?php echo trans('intro-video-url') ?></label>
                                        <input class="form-control" type="text" name="intro_video" value="<?php echo html_escape($user->intro_video) ?>">

                                        <p class="mt-3"><a target="_blank" class="badge-sm badge badge-warning-soft fs-13 pt-2" href="<?php echo base_url('docs/#idocs_ytemb') ?>"><i class="bi bi-info-circle-fill"></i> How to get your embedded YouTube video URL?</a></p>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <input type="hidden" name="id" value="<?php echo html_escape(user()->id); ?>">
                                <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                                <button type="submit" class="btn btn-primary mt-2"><?php echo trans('save-changes') ?></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
