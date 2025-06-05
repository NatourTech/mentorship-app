<div class="content-wrapper">
    <?php $this->load->view('admin/include/breadcrumb'); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <?php $this->load->view('admin/user/include/settings_menu.php'); ?>

                <div class="col-lg-9 pl-3">
                    <div class="card">
                        <div class="box-header with-border">
                          <h3 class="box-title"><?php echo trans('profile') ?></h3>
                        </div>

                        <form method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/settings/update_profile') ?>" role="form" class="form-horizontal pl-20">
                            <div class="card-body">

                                <div class="row ">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="mih-100">
                                                <?php if (!empty($user->image)):?>
                                                    <img class="m-auto" width="100px" src="<?php echo base_url($user->image); ?>">
                                                <?php else: ?>
                                                   <p class="m-auto text-muted"><?php echo trans('profile-photo') ?></p>
                                                <?php endif; ?>
                                            </div>

                                            <div class="form-group">
                                                <div class="custom-file">
                                                    <input type="file" class="custom-file-input" name="photo" id="customFile">
                                                    <label class="custom-file-label" for="customFile"><?php echo trans('upload-profile-photo') ?></label>
                                                    <p class="text-muted mt-1 fs-12 small"><i class="fas fa-info-circle"></i> <?php echo trans('for-better-view-use') ?> 300 x 150px</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <div class="mih-100">
                                                <?php if (!empty($user->cover)):?>
                                                    <img class="m-auto" width="100px" height="80px" src="<?php echo base_url($user->cover); ?>">
                                                <?php else: ?>
                                                    <img class="m-auto" width="100px" src="<?php echo base_url('assets/front/img/vericla-cover.jpg'); ?>">
                                                <?php endif; ?>
                                            </div>

                                            <div class="form-group">
                                                <div class="custom-file">
                                                <input type="file" name="photo1" class="custom-file-input" id="customFiles">
                                                <label class="custom-file-label" for="customFiles"><?php echo trans('cover-photo') ?></label>
                                                </div>
                                                <p class="text-muted mt-1 fs-12 small"><i class="fas fa-info-circle"></i> <?php echo trans('for-better-view-use') ?> 1600 x 1000px</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>


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
                                </div>

                                <div class="row mb-2">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label><?php echo trans('language') ?></label>
                                            <input type="text" data-role="tagsinput" name="language" value="<?php if(!empty($user->language)){echo html_escape($user->language);} ?>" />
                                        </div>
                                    </div>
                                </div>





                                <!-- language base settings -->

                                <div class="row mb-4">
                                  <div class="col-12">
                                    <ul class="nav nav-tabs mb-4" role="tablist">
                                        <?php $i=1; foreach ($settings_language as $language): ?>
                                          <li class="nav-item" role="presentation">
                                            <a class="nav-link <?php if($i==1){echo "active";} ?>" id="home-tab<?php echo $i ?>" data-toggle="tab" data-target="#language_<?php echo html_escape($language->lang_id) ?>" type="button" role="tab" aria-controls="home" aria-selected="true"><?php echo get_by_id($language->lang_id,'language')->name; ?></a>
                                          </li>
                                        <?php $i++; endforeach ?>
                                    </ul>

                                  
                                    <div class="tab-content" id="myTabContent">

                                        <?php $a=1; foreach ($settings_language as $language): ?>
                                          <div class="tab-pane fade <?php if($a==1){echo "show active";} ?>" id="language_<?php echo html_escape($language->lang_id) ?>" role="tabpanel" aria-labelledby="home-tab<?php echo $a ?>">

                                              

                                              <div class="form-group">
                                                  <label><?php echo trans('about') ?></label>
                                                  <textarea class="form-control" name="about[]" rows="4"><?php if(isset($mentor_settings_extra)){echo html_escape($mentor_settings_extra[$a-1]->about);} ?></textarea>
                                              </div>

                                              <div class="form-group">
                                                <label><?php echo trans('keywords') ?></label>
                                                <input type="text" data-role="tagsinput" name="keywords[]" value="<?php if(isset($mentor_settings_extra)){echo html_escape($mentor_settings_extra[$a
                                                    -1]->keywords);} ?>" class="form-control">
                                              </div>

                                              <div class="form-group">
                                                  <label><?php echo trans('description') ?></label>
                                                  <textarea class="form-control" name="description[]" rows="4"><?php if(isset($mentor_settings_extra)){echo html_escape($mentor_settings_extra[$a-1]->description);} ?></textarea>
                                              </div>


                                              <input type="hidden" name="lang_id[]" value="<?php echo html_escape($language->id); ?>">
                                             
                                          </div>
                                        <?php $a++; endforeach ?>
                                      
                                    </div>
                                  
                                  </div>
                                </div>




                                

                                <div class="row mb-2">
                                    <div class="col-md-4">
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
