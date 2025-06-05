<?php foreach ($mentors as $mentor): ?>
    <div class="mentor-card row p-5 mb-6">
        <div class="col-md-3 p-0"> 
            <?php if (empty($mentor->image)): ?>
                <?php $mentor_img = base_url('assets/images/no-photo-sm.png'); ?>
            <?php else: ?>
                <?php $mentor_img = base_url($mentor->image); ?>
            <?php endif ?>

            <a href="<?php echo base_url('mentor/'. $mentor->slug) ?>">
            <div class="mentor_imgcontain">
                <div class="mentor-img" style="background-image:url(<?php echo $mentor_img; ?>);"></div>
            </div>
            </a>
        </div>
        
        <div class="pl-4 col-md-9">
            <h5 class="mb-2 d-flex justify-content-start fw-500">
                <?php echo html_escape($mentor->name) ?>
                <?php $code = get_by_id($mentor->country, 'country')->code; ?>
                
                <?php if(!empty($mentor->country)): ?>
                    <span class="ml-3"><img data-toggle="tooltip" data-placement="top" title="<?php echo get_by_id($mentor->country, 'country')->name; ?>" class="flag-cimg2" src="<?php echo base_url('assets/images/flags/'.strtolower($code).'.png') ?>"></span>
                <?php endif; ?>

                <?php if (!empty($mentor->respond_time) && $mentor->respond_in == 'hour'): ?>
                    <span class="available-badge2 ml-2 text-primary" data-toggle="tooltip" data-title="<?php echo trans('available-asap') ?>">
                        <span><i class="bi bi-lightning-charge"></i></span>
                    </span>
                <?php endif ?>

                <?php if ($mentor->kyc_verified == 1): ?>
                    <span class="verify_badge2 text-primary" data-toggle="tooltip" data-title="<?php echo trans('kyc').' '.trans('verified') ?>">
                        <i class="bi bi-patch-check-fill"></i>
                    </span>
                <?php endif ?>
            </h5>
            <p class="mt-1 mb-1">
                <?php if (!empty($mentor->designation)): ?>
                    <span><i class="bi bi-briefcase mr-1"></i> <?php echo html_escape($mentor->designation) ?></span>
                <?php endif ?> 
                <?php if (!empty($mentor->company)): ?>
                    <span class="text-muted fw-500"><?php echo trans('at') ?></span> <span><?php echo html_escape($mentor->company) ?>.</span>
                <?php endif ?>
            </p>

            <?php $total_sessions = count_mentors_sessions($mentor->id); ?>
            <?php $total_reviews = count_mentors_reviews($mentor->id); ?>

            <?php if($total_sessions > 0): ?>
                <div class="">
                    <p class="fs-13 text-muted"><i class="bi bi-chat-fill  mr-1"></i> <?php echo html_escape( $total_sessions); ?> Sessions
                        <?php if($total_reviews > 0): ?> 
                            <span class="text-muted">(<?php echo html_escape( $total_reviews); ?> <?php echo trans('reviews') ?>)</span>
                        <?php endif; ?>
                    </p>
                </div>
            <?php endif; ?>  

 
                <?php $mentor_lang = get_mentor_by_language($mentor->id); ?>
                <?php if (!empty($mentor_lang->about)): ?>
                    <p class="mb-4 text-muted"><?php echo character_limiter($mentor_lang->about,160) ?></p>
                <?php endif ?>
       

            <div>
                <?php $skills = $this->common_model->get_user_skills_result($mentor->id); ?>
                <?php foreach ($skills as $skill): ?>
                    <span class="mentor-skills badge"><?php echo get_by_id($skill->skill_id,'skills')->skill ?></span>
                <?php endforeach ?>
            </div>
            <div class="d-flex justify-content-start fs-14 br-4 mb-0 pr-2">
                <div class="mr-5">
                    <p class="mt-2 mb-0 fw-500 text-muted"><?php echo trans('experience') ?></p>
                    <p class="mt-0 mb-2 text-dark fs-16">
                        <?php if (empty($mentor->experience_year)): ?>
                            1 <?php echo trans('years') ?>
                        <?php else: ?>
                            <?php echo html_escape($mentor->experience_year); ?> <?php echo trans('years') ?>
                        <?php endif ?>
                    </p>
                </div>
                <div>
                    <p class="mt-2 mb-0 fw-500 text-muted"><?php echo trans('attendence') ?></p>
                    <p class="mt-0 mb-2 text-dark fs-16"><?php echo get_user_attendence($mentor->id) ?>%</p>
                </div>
            </div>
            
        </div>
    </div>
<?php endforeach ; ?>