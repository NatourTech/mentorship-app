<div class="content-wrapper">
    <?php $this->load->view('admin/include/breadcrumb'); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-lg-9 pl-3">
                    <div class="card">
                        <div class="d-flex justify-content-between">
                          <h3 class="box-title"><?php echo trans('mentor') ?></h3>

                            <a href="<?php echo base_url('admin/mentors') ?>" class="mr-3 mb-2 btn btn-secondary btn-sm"><i class="fa fa-angle-left"></i> <?php echo trans('back') ?></a>

                        </div>

                        <form method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/users/update_mentor') ?>" role="form" class="form-horizontal pl-20">
                            <div class="card-body">

                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo trans('name') ?></label>
                                            <input type="text" name="name" value="<?php echo html_escape($user->name); ?> " class="form-control" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo trans('email') ?></label>
                                            <input type="text" name="email" value="<?php echo html_escape($user->email); ?>" class="form-control" >
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo trans('phone') ?></label>
                                            <input type="text" name="phone" value="<?php echo html_escape($user->phone); ?>" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo trans('gender') ?></label>
                                            <select class="form-control" name="gender">
                                                <option value=""><?php echo trans('select-your-gender') ?></option>
                                                <option value="1" <?php if(isset($user->gender) && $user->gender==1){echo 'selected';} ?>>Male</option>
                                                <option value="2" <?php if(isset($user->gender) && $user->gender==2){echo 'selected';} ?>>Female</option>
                                                <option value="3" <?php if(isset($user->gender) && $user->gender==3){echo 'selected';} ?>>Other</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo trans('country') ?></label>
                                            <select class="form-control select2" name="country">
                                                <option value=""><?php echo trans('select-your-ountry') ?></option>

                                                <?php foreach ($countries as $country): ?>
                                                    <option value="<?php echo html_escape($country->id) ?>" <?php if(isset($user->country) && $user->country==$country->id){echo 'selected';} ?> ><?php echo html_escape($country->name) ?></option>
                                                <?php endforeach ?>                 
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo trans('time-zone') ?></label>
                                            <select class="form-control select2" name="time_zone">
                                                <option value=""><?php echo trans('select-your-time-zone') ?></option>
                                                <?php foreach ($time_zones as $time): ?>
                                                  <option value="<?php echo html_escape($time->id) ?>" <?php if(isset($user->time_zone) && $user->time_zone==$time->id){echo 'selected';} ?> ><?php echo html_escape($time->name) ?></option>
                                                <?php endforeach ?>                 
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><?php echo trans('language') ?></label>
                                            <input type="text" data-role="tagsinput" name="language" value="<?php if(!empty($user->language)){echo html_escape($user->language);} ?>" />
                                        </div>
                                    </div>

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
                                            <label><?php echo trans('skill') ?></label>
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

                                     <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label><?php echo trans('company') ?></label>
                                            <input class="form-control" type="text" name="company" value="<?php echo html_escape($user->company) ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group mb-4">
                                            <label><?php echo trans('designation') ?></label>
                                            <input class="form-control" type="text" name="designation" value="<?php echo html_escape($user->designation) ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label><?php echo trans('respond-in') ?></label>
                                            <div class="input-group "> 
                                                <input type="text" width="30%" class="form-control" name="respond_time" value="<?php echo html_escape($user->respond_time); ?>" 
                                                    placeholder="insert responding day or hour">

                                                <select class="form-control" name="respond_in">
                                                    <option value=""><?php echo trans('select') ?></option>
                                                    <option value="hour" <?php if(isset($user->respond_in) && $user->respond_in == 'hour'){echo 'selected';} ?>><?php echo trans('hours') ?></option>
                                                    <option value="day" <?php if(isset($user->respond_in) && $user->respond_in == 'day'){echo 'selected';} ?>><?php echo trans('days') ?></option>
                                                </select> 
                                            </div>
                                        </div> 
                                    </div>
                                </div>

                                <div class="card-footer">
                                    <input type="hidden" name="id" value="<?php echo html_escape($user->id); ?>">
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
