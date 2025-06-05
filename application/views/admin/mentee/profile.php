<div class="content-wrapper">
    <?php $this->load->view('admin/include/breadcrumb'); ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-9 pl-3">
                    <div class="card">
                        <form method="post" enctype="multipart/form-data" action="<?php echo base_url('admin/settings/update_mentee_profile') ?>" role="form" class="form-horizontal pl-20">
                            <div class="card-body">
                                <h4><?php echo trans('account-settings') ?></h4>
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
                                                <option value=""><?php echo trans('select') ?></option>
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
                                                <option value=""><?php echo trans('select') ?></option>
                                                <?php foreach ($countries as $country): ?>
                                                  <option value="<?php echo html_escape($country->id) ?>" <?php if(isset($user->country) && $user->country==$country->id){echo 'selected';} ?> ><?php echo html_escape($country->name) ?></option>
                                                <?php endforeach ?>                 
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label> <?php echo trans('time-zone') ?></label>
                                            <select class="form-control select2" name="time_zone">
                                                <option value=""><?php echo trans('select') ?></option>
                                                <?php foreach ($time_zones as $time): ?>
                                                  <option value="<?php echo html_escape($time->id) ?>" <?php if(isset($user->time_zone) && $user->time_zone==$time->id){echo 'selected';} ?> ><?php echo html_escape($time->name) ?></option>
                                                <?php endforeach ?>                 
                                            </select>
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
