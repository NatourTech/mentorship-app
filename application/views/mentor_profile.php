<style type="text/css">

    .ui-datepicker {
        width: auto !important; /* Force the width to 100% */
    }

    /* Responsive CSS for Smaller Screens */
@media (max-width: 768px) {
.hasDatepicker{
    padding: 2px!important;
}
.ui-state-default {
    display: block;
    text-decoration: none;
    color: #302e2e;
    font-size: 11px;
    font-weight: 600;
    height: 30px;
    width: 29px;
    line-height: 30px;
    border-radius: 6px;
    margin-left: 18px;
    margin-bottom: 5px;
  }
}

@media (max-width: 480px) {
    .hasDatepicker{
        padding: 2px!important;
    }
    .ui-state-default {
      display: block;
      text-decoration: none;
      color: #302e2e;
      font-size: 11px;
      font-weight: 600;
      height: 30px;
      width: 29px;
      line-height: 30px;
      border-radius: 6px;
      margin-left: 0px;
      margin-bottom: 5px;
    }
}
</style>

<section class="p-0 mb-5">
    <div class="container-fluid">
        <div class="row p-0">
            <div class="col-md-12 p-0">
                <div class="bg-cover<?php if(empty($mentor->cover)){echo "-empty";} ?> overlay overlay-black overlay-30" style="background-image:url(<?php echo base_url($mentor->cover) ?>)">
                   
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="d-flex justify-content-between">
                    <div class="mr-3">
                        <div class="mentor-profile-img pull-left" style="background-image: url(<?php echo base_url($mentor->image) ?>)">    
                            <?php if ($mentor->kyc_verified == 1): ?>
                                <span class="verified-pbadge text-primary">
                                    <img width="40px" src="<?php echo base_url('assets/images/approved.png') ?>">
                                </span>
                            <?php endif; ?>

                            <div class="<?php if($mentor->is_active == 1){echo 'active_icon_profile';}else{echo 'inactive_icon_profile';} ?> d-none">
                                <p><i class="bi bi-circle-fill "></i></p>
                            </div> 
                        </div>
                    </div>
                
                    <div class="media-body pt-3">
                        <?php $code = get_by_id($mentor->country, 'country')->code; ?>
                        <h2 class="text-dark mb-0 font-weight-bold"><?php echo html_escape($mentor->name) ?> <img data-toggle="tooltip" data-placement="top" title="<?php echo get_by_id($mentor->country, 'country')->name; ?>" class="flag-cimg ml-3" src="<?php echo base_url('assets/images/flags/'.strtolower($code).'.png') ?>"></h2>
                       
                        <p class="font-weight-light fs-18 mb-1"><?php echo html_escape($mentor->designation) ?> <span class="text-muted">
                        <?php if (!empty($mentor->company)): ?>
                            <?php echo trans('at') ?></span> 
                        <?php endif ?>
                        <span class="fw-600"><?php echo html_escape($mentor->company) ?></span></p>

                        <p class="text-dark mb-1"><i class="bi bi-geo-alt-fill mr-2 text-primary"></i> <?php echo get_by_id($mentor->country, 'country')->name ?></p>
                        <?php 
                            if($mentor->is_active == 0 && !empty($mentor->last_logout)){
                                $active_text = get_time_ago($mentor->last_logout);
                            }else{
                                $active_text = 'now';
                            }
                         ?>

                        <p class="text-muted mb-1"><i class="bi bi-clock-fill mr-2 text-primary"></i> <?php echo trans('active') ?> <span class="text-dark fw-500"><?php echo html_escape($active_text) ?></span></p>

                        <?php 

                            if ($mentor->respond_in == 'day') {
                                if ($mentor->respond_time > 1) {
                                    $text = 'days' ;
                                }else{
                                    $text = 'day' ;
                                }
                            }else{
                                if ($mentor->respond_time > 1) {
                                    $text = 'hours' ;
                                }else{
                                    $text = 'hour';
                                }
                            }

                         ?>

                        <p class="text-muted mb-0"><i class="bi bi-lightning-charge-fill mr-2 text-primary"></i> <?php echo trans('usually-responds-in') ?> <span class="text-dark fw-500"><?php echo html_escape($mentor->respond_time) ?> <?php echo html_escape($text); ?></span></p>

                 
                            <ul class="list-unstyled social-icon2 mb-0">
                                <?php if (!empty($mentor->facebook_profile)) : ?>
                                    <li class="mr-3 fs-12"><a target="_blank" href="<?= prep_url($mentor->facebook_profile) ?>"><i class="bi bi-facebook fs-20"></i></a></li>
                                <?php endif ?>

                                <?php if (!empty($mentor->x_profile)) : ?>
                                    <li class="mr-3 fs-12"><a target="_blank" href="<?= prep_url($mentor->x_profile) ?>"><i class="bi bi-twitter fs-20"></i></a></li>
                                <?php endif ?>

                                <?php if (!empty($mentor->linkedin_profile)) : ?>
                                    <li class="mr-3 fs-12"><a target="_blank" href="<?= prep_url($mentor->linkedin_profile) ?>"><i class="bi bi-linkedin fs-20"></i></a></li>
                                <?php endif ?>

                                <?php if (!empty($mentor->instagram_profile)) : ?>
                                    <li class="mr-3 fs-12"><a target="_blank" href="<?= prep_url($mentor->instagram_profile) ?>"><i class="bi bi-instagram fs-20"></i></a></li>
                                <?php endif ?>
                            </ul>

                    </div>
                </div>
            </div>

            <div class="col-md-4 text-right">

                <?php if(check_auth() == TRUE): ?>
                    <?php if(is_mentee() || is_user()): ?>
                        <?php if($this->session->userdata('id') != $mentor->id): ?>
                            <a  href="#" data-toggle="modal" data-target="#send_message" class="btn btn-outline-secondary mt-3 mr-3 add_favourite <?php if(empty($favourite)){echo 'btn-primary';}else{echo 'btn-secondary';} ?>"><i class="bi bi-chat"></i></a>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php else: ?>
                    <a href="<?php echo base_url('login') ?>" class="btn btn-primary mt-3"><i class="bi bi-chat"></i></a>
                <?php endif; ?>


                <?php $favourite = check_favourite($mentor->id, $this->session->userdata('id')) ?>
                <?php if(check_auth() == TRUE ): ?>
                    <?php if($this->session->userdata('id') != $mentor->id): ?>
                        <a  href="#" class="btn btn-outline-secondary mt-3 add_favourite <?php if(empty($favourite)){echo 'btn-default shadow-lg border-1';}else{echo 'btn-secondary';} ?>"><i class="bi bi-heart <?php if(!empty($favourite)){echo 'text-light';} ?>"></i></a>

                        <input type="hidden" class="favourite_id" value="<?php echo html_escape($mentor->id) ?>" name="favourite_id">
                        <input type="hidden" class="user_id" value="<?php echo html_escape($this->session->userdata('id')) ?>" name="user_id">
                    <?php endif; ?>
                <?php else: ?>
                    <a href="<?php echo base_url('login') ?>" class="btn btn-default shadow-lg border-1 mt-3"><i class="bi bi-heart"></i></a>
                <?php endif; ?>

            </div>

        </div>

        <div class="row mt-8">
            <div class="col-md-12">
                <div class="tab-card-header">
                    <ul class="nav nav-tabs card-header-tabs bbm-1" id="myTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="one-tab" data-toggle="tab" href="#one" role="tab" aria-controls="One" aria-selected="true"><?php echo trans('overview') ?></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="two-tab" data-toggle="tab" href="#two" role="tab" aria-controls="Two" aria-selected="false"><?php echo trans('reviews') ?> 
                                <?php if ($total_rating): ?>
                                    <span class="fs-12">(<?php echo html_escape($total_rating) ?>)</span>
                                <?php endif ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="tab-content mt-5" id="myTabContent">
                <div class="tab-pane fade show active" id="one" role="tabpanel" aria-labelledby="one-tab">
                    <div class="row">
                        <div class="col-md-6">
                            <?php 

                                $mentor_lang = get_mentor_by_language($mentor->id);
                            ?>
                            
                            <?php if (!empty($mentor_lang->about)): ?>
                                <p class="pl-2 mb-5"><?php echo html_escape($mentor_lang->about) ?></p>
                            <?php endif ?>

                            <!-- background -->
                            <div class="sidebar-info mb-5 pl-2">

                                <?php if (!empty($mentor->intro_video)): ?>
                                    <div class="row align-items-centers mb-5">
                                        <div class="col-md-12">
                                           <!-- <iframe width="560" height="315" src="https://www.youtube.com/embed/U6fC4Ij608A?si=262Dhf0n3IWbCcef" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe> -->

                                            <iframe class="brd-10" width="100%" height="315"src="<?php echo prep_url($mentor->intro_video) ?>"></iframe>
                                        </div>
                                    </div>
                                <?php endif ?> 


                                <div class="d-flex justify-content-start">
                                    <p class="fs-20 mb-2 fw-600"><?php echo trans('background') ?> </p>
                                </div>

                                <div class="shadow-lg sidebar-item mb-3">
                                    <div class="p-3">
                                        <h6 class=" mt-2 mb-3 fs-16 fw-500"><?php echo trans('skills') ?></h6>
                                    <?php $i=0; foreach ($skills as $skill): ?>
                                        <?php $skill_id = $skills[$i]['skill_id'] ;?>
                                        <span class="badge badge-custom-lg mb-2 p-2"><?php  echo get_by_id($skill_id, 'skills')->skill; ?></span>
                                    <?php $i++; endforeach ?>
                                    </div>
                                </div>

                                <div class="sidebar-item shadow-lg">
                                    <!-- <div class="sidebar-item-row d-flex justify-content-between align-items-center">
                                        <?php $total = count($skills) ;?>
                                        <?php $skill1 = $skills[0]['skill_id'] ;?>
                                        <?php $skill2 = $skills[1]['skill_id'] ;?>

                                        <div class="sidebar-item-info">
                                            <p class="mb-0 mt-0 sidebar-item-title fs-16 fw-500"><?php echo trans('skills') ?></p>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <?php if (empty($skill1)): ?>
                                                <span><?php echo trans('no-data-found') ?></span>
                                            <?php else: ?>
                                                <span class="badge badge-custom border-danger bg-danger-soft"><?php echo get_by_id($skill1, 'skills')->skill; ?></span>

                                                <span class="badge badge-custom border-info bg-info-soft"><?php echo get_by_id($skill2, 'skills')->skill; ?></span>

                                                <?php if($total > 2): ?>
                                                    <div class="dropdown">
                                                      <button class="badge badge-custom dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                                                        +<?php echo html_escape($total - 2) ; ?>
                                                      </button>
                                                      <div class="custom dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                        <?php $i=2; foreach ($skills as $skill): ?>
                                                            <?php $skill_id = $skills[$i]['skill_id'] ;?>
                                                            <span class="badge badge-custom-lg mb-2"><?php  echo get_by_id($skill_id, 'skills')->skill; ?></span>
                                                        <?php $i++; endforeach ?>
                                                      </div>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endif ?>
                                        </div>
                                    </div> -->

                                    <?php $languages = explode(",", $mentor->language);  ?>
                                    <div class="sidebar-item-row d-flex justify-content-between align-items-center">
                                        <div class="sidebar-item-info">
                                            <p class="mb-0 mt-0 sidebar-item-title fs-16 fw-500"><?php echo trans('fluent-in') ?></p>
                                        </div>
                                        <div>
                                            <?php foreach ($languages as $language): ?>
                                                <span class="badge badge-custom dm-bg"><?php    echo html_escape($language) ?></span>
                                            <?php endforeach ?>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <!-- experience -->
                            <?php if(!empty($experiences)): ?>
                                <div class="sidebar-info mb-5 mt-0 pl-2">

                                    <div class="d-flex justify-content-start">
                                        <p class="font-weight-light fs-20 mb-2 fw-600"><?php echo trans('experiences') ?> </p>
                                    </div>

                                    <div class="sidebar-item shadow-lg">
                                        <?php foreach ($experiences as $experience): ?>
                                            <div class="sidebar-item-row d-flex justify-content-between align-items-center">
                                                <div class="d-flex justify-content-end">
                                                    <div class="mr-3 sidebar-icon">
                                                        <i class="<?php echo html_escape($experience->icon) ?>"></i>
                                                    </div>

                                                    <div class="sidebar-item-info">
                                                        <p class="mb-0 mt-0 sidebar-item-title fs-18"><?php echo html_escape($experience->title) ?></p>
                                                        <p class="mb-1 sidebar-item-info text-dark"><?php echo html_escape($experience->company) ?> <span class="text-muted fs-12 ml-2">(<?php echo my_date_show($experience->start_date); ?> - <?php if($experience->is_present == 1){echo 'Present';}else{echo my_date_show($experience->end_date);} ?>)</span></p>
                                                        <p class="fs-12 pr-1"><?php echo html_escape($experience->contribution) ?></p>
                                                    </div>
                                                </div>

                                                
                                            </div>
                                        <?php endforeach ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- educations -->
                            <?php if(!empty($educations)): ?>
                                <div class="sidebar-info mb-5 mt-0">

                                    <div class="d-flex justify-content-start">
                                        <p class="font-weight-light fs-20 mb-2 fw-600"><?php echo trans('educations') ?></p>
                                    </div>

                                    <?php foreach ($educations as $education): ?>
                                        <div class="sidebar-item mb-3 shadow-lg">
                                            <div class="sidebar-item-row d-flex justify-content-start align-items-center">
                                                
                                                <div class="mr-3 sidebar-icon">
                                                    <i class="bi bi-mortarboard"></i>
                                                </div>

                                                <div class="sidebar-item-info">
                                                    <p class="mb-0 mt-0 sidebar-item-title fs-18"><?php echo html_escape($education->institute) ?></p>
                                                    <p class="mb-0 sidebar-item-info text-muted fs-12"><?php echo html_escape($education->degree) ?> (<?php echo $education->start_year ?> - <?php echo $education->end_year ?>)</p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                            <?php endif; ?>


                            <?php $similar_mentors = $this->common_model->get_similar_mentors($mentor->category, $mentor->id); ?>

                            <div class="pl-0">
                                <h5 class="pt-5 fw-500"><?php echo trans('similar-mentors') ?></h5>
                                <?php foreach ($similar_mentors as $similar_mentor): ?>
                                    <a href="<?php echo base_url('mentor/'. $similar_mentor->slug) ?>">
                                        <div class="similar-mentor">
                                            <?php if (empty($similar_mentor->image)): ?>
                                                <?php $similar_mentor_img = base_url('assets/images/no-photo-sm.png'); ?>
                                            <?php else: ?>
                                                <?php $similar_mentor_img = base_url($similar_mentor->image); ?>
                                            <?php endif ?>
                                            <img src="<?php echo $similar_mentor_img; ?>" alt="Mentor Image" class="similar-mentor-avatar">

                                            <?php $total_sessions = count_mentors_sessions($similar_mentor->id); ?>
                                            <?php $total_reviews = count_mentors_reviews($similar_mentor->id); ?>
                                            <div class="similar-mentor-details mt-2">
                                                <span class="h5 mr-3 mb-3">
                                                    <?php echo html_escape($similar_mentor->name) ?>   
                                                </span>

                                                <?php if (!empty($similar_mentor->designation)): ?>    
                                                    <p class="mt-1 mb-1">
                                                        <?php if (!empty($similar_mentor->designation)): ?>
                                                            <span><i class="bi bi-briefcase mr-1"></i> <?php echo html_escape($similar_mentor->designation) ?></span>
                                                        <?php endif ?> 
                                                        <?php if (!empty($similar_mentor->company)): ?>
                                                            <span class="text-muted fw-500"><?php echo trans('at') ?></span> <span><?php echo html_escape($similar_mentor->company) ?>.</span>
                                                        <?php endif ?>
                                                    </p>
                                                <?php endif; ?>

                                                <?php if($total_sessions > 0): ?>
                                                    <div class="">
                                                        <p class="fs-13 text-muted"><i class="bi bi-chat-fill  mr-1"></i> <?php echo html_escape( $total_sessions); ?> <?php echo trans('sessions') ?>
                                                            <?php if($total_reviews > 0): ?> 
                                                                <span class="text-muted">(<?php echo html_escape( $total_reviews); ?> <?php echo trans('reviews') ?>)</span>
                                                            <?php endif; ?>
                                                        </p>
                                                    </div>
                                                <?php endif; ?>  

                                                <?php $skills = $this->common_model->get_user_skills_result($similar_mentor->id); ?>
                                                <div class="mt-2">
                                                    <?php foreach ($skills as $skill): ?>
                                                        <span class="mentor-skills badge"><?php echo get_by_id($skill->skill_id,'skills')->skill ?></span>
                                                    <?php endforeach ?>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                <?php endforeach ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="right-overview shadow-lg br-10 ml-md-5">
                                <h5 class="pl-4 pt-5 fw-600"><?php echo trans('community-statistics') ?></h5>

                                <div class="row pl-2">
                                    <div class="col-md-6 col-xs-12">
                                        <div class="sidebar-item-row d-flex justify-content-start align-items-center">
                                            <div class="mr-3 esidebar-icon bg-danger-soft">
                                                <i class="bi bi-view-list"></i>
                                            </div>

                                            <div class="sidebar-item-info">
                                                <p class="mb-0 mt-0 sidebar-item-title fs-18"><?php echo get_count_completed_sessions($mentor->id) ?></p>
                                                <p class="mb-0 sidebar-item-info text-muted"><?php echo trans('completed-sessions') ?></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-xs-12">
                                        <div class="sidebar-item-row d-flex justify-content-start align-items-center">
                                            <div class="mr-3 esidebar-icon bg-success-soft">
                                                <i class="bi bi-clock"></i>
                                            </div>

                                            <div class="sidebar-item-info">
                                                <p class="mb-0 mt-0 sidebar-item-title fs-18"><?php echo get_count_minute_by_user($mentor->id) ?> <?php echo trans('minutes') ?></p>
                                                <p class="mb-0 sidebar-item-info text-muted"><?php echo trans('total-mentoring-time') ?></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-xs-12">
                                        <div class="sidebar-item-row d-flex justify-content-start align-items-center">
                                            <div class="mr-3 esidebar-icon bg-nprimary-soft">
                                                <i class="bi bi-person-fill-check"></i>
                                            </div>

                                            <div class="sidebar-item-info">
                                                <p class="mb-0 mt-0 sidebar-item-title fs-18"><?php echo get_user_attendence($mentor->id) ?>%</p>
                                                <p class="mb-0 sidebar-item-info text-muted"><?php echo trans('average-attendence') ?> <span class="pl-1" data-toggle="tooltip" data-placement="bottom" data-title="<?php echo trans('total-attendance-info') ?>"><i class="bi bi-info-circle"></i></span></p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-xs-12">
                                        <div class="sidebar-item-row d-flex justify-content-start align-items-center">
                                            <div class="mr-3 esidebar-icon bg-warning-soft">
                                                <i class="bi bi-mortarboard"></i>
                                            </div>

                                            <div class="sidebar-item-info">
                                                <p class="mb-0 mt-0 sidebar-item-title fs-18">
                                                    <?php if (empty($mentor->experience_year)): ?>
                                                        1 <?php echo trans('years') ?>
                                                    <?php else: ?>
                                                        <?php echo html_escape($mentor->experience_year); ?> <?php echo trans('years') ?>
                                                    <?php endif ?>
                                                </p>
                                                <p class="mb-0 sidebar-item-info text-muted"><?php echo trans('experience') ?></p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                
                                <?php if (!empty($sessions)): ?>
                                <!-- <form class="form-controls" action="<?php echo base_url('session') ?>" method="post"> -->
                                    

                                    <?php if($mentor->booking_enable == 1): ?>
                                        <h5 class="pl-4 pt-5 fw-600"><?php echo trans('sessions') ?></h5>

                                        <div class="row pl-4 pr-3 mt-4">
                                            <?php $i=1; foreach ($sessions as $session): ?>
                                                <div class="col-md-12 col-xs-12">
                                                    <label class="service-rdo">
                                                        <input data-id="<?php echo html_escape($session->slug) ?>" type="radio" name="session_id" class="service_input" id="selected_session" value="<?php echo html_escape($session->id) ?>" required>
                                                        <div class="d-flex justify-content-between py-2 align-items-center mb-1 m-0">
                                                            <div class="col-auto mb-sm-0">
                                                                <div class="media service_item">
                                                                    <div class="media-body">
                                                                        <p class="text-dark fw-500 mb-0 pt-1"><?php echo html_escape($session->name) ?></p>
                                                                        <small class="d-block text-muted"> <i class="bi bi-clock"></i> <?php echo html_escape($session->duration); ?> minitues
                                                                            <?php if($session->type == 2 ): ?>
                                                                                <?php
                                                                                    if($session->session_repeat == 7){

                                                                                        $session_text = 'weekly';
                                                                                    }else{
                                                                                      $session_text = 'monthly';  
                                                                                    }
                                                                                 ?>
                                                                            <span class=" ml-2 mr-2">Repeats <?php echo html_escape($session_text) ?></span>
                                                                            <span class="mr-2"><?php echo html_escape($session->session_number) ?> Sessions</span>
                                                                        <?php endif; ?>

                                                                             
                                                                        </small>

                                                                        <span class="service-price-sm font-weight-bold text-dark d-hide">

                                                                            <?php if(settings()->curr_locate == 0){echo settings()->currency_symbol;} ?>
                                                                            <?php echo number_format($session->price, settings()->num_format) ?>
                                                                            <?php if(settings()->curr_locate == 1){echo settings()->currency_symbol;} ?> 

                                                                        </span>

                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="col-auto text-sm-right">
                                                                <span class="service-price badge badge-secondary-soft badge-pill">

                                                                    <?php if($session->price != 0): ?>

                                                                        <?php if(settings()->curr_locate == 0){echo settings()->currency_symbol;} ?>
                                                                             <?php echo number_format($session->price, settings()->num_format) ?>
                                                                        <?php if(settings()->curr_locate == 1){echo settings()->currency_symbol;} ?>
                                                                    <?php else: ?>
                                                                        <?php echo trans('free') ?>
                                                                    <?php endif; ?> 
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </label>

                                                </div>
                                                <input type="hidden" name="mentor_id" value="<?php echo html_escape($session->user_id) ?>">
                                            <?php $i++; endforeach ?>

                                            <input type="hidden" name="<?php echo html_escape($this->security->get_csrf_token_name());?>" value="<?php echo html_escape($this->security->get_csrf_hash());?>">

                                            
                                        </div>

                                        <div class="mt-3 session_details p-3">
                                            
                                        </div>

                                    <?php else: ?>
                                        <div class="row px-4 mt-4">
                                            <div class="col-md-12">
                                                <div class="alert alert-warning" role="alert">
                                                    <p class="mt-0 mb-1 text-center fs-20"><span></span></p>
                                                  <i class="fas fa-ban"></i> <?php echo trans('session-booking-disabled-warning') ?>
                                                </div>
                                            </div>
                                            
                                        </div>
                                    <?php endif; ?>


                                <!-- </form> -->
                                <?php endif ?>

                            </div>
                        </div>


                    </div>
                </div>

                <div class="tab-pane fade" id="two" role="tabpanel" aria-labelledby="two-tab">
                    <div class="row">
                        <?php if (!empty(get_all_ratings($mentor->id))): ?>
                            <?php foreach (get_all_ratings($mentor->id) as $value): ?>
                                <div class="col-md-12 col-xs-12 p-0 mb-3">
                                    <div class="sidebar-item-row d-flex justify-content-start align-items-top review-item shadow-lg">
                                        <div class="mr-3">
                                            <?php if (empty($value->mentee_thumb)): ?>
                                                <?php $mentee_thumb = base_url('assets/images/no-photo-sm.png'); ?>
                                            <?php else: ?>
                                                <?php $mentee_thumb = base_url($value->mentee_thumb); ?>
                                            <?php endif ?>
                                            <div class="avatar-sm" style="background-image: url(<?php echo $mentee_thumb ?>);">
                                                
                                            </div>
                                        </div>

                                        <div class="sidebar-item-info">

                                            <?php if (!empty($value->rating)): ?>
                                              <?php for($u = 1; $u <= 5; $u++):?>
                                                <?php 
                                                  if ( round($value->rating - .25) >= $u) {
                                                        $star = "fas fa-star";
                                                    } elseif (round($value->rating + .25) >= $u) {
                                                        $star = "fas fa-star-half-alt";
                                                    } else {
                                                        $star = "far fa-star";
                                                    }
                                                ?>
                                                <i class="<?php echo html_escape($star);?> text-warning fs-12"></i> 
                                              <?php endfor;?>
                                            <?php endif ?> 

                                            <p class="mb-2 mt-0 sidebar-item-title fs-18 text-dark"><?php echo html_escape($value->mentee_name) ?></p>
                                            <!-- <p class="mb-2 sidebar-item-info text-muted">
                                                <?php echo html_escape($value->designation) ?>  
                                                <?php echo html_escape($value->company) ?>
                                            </p> -->

                                            <p><?php echo html_escape($value->feedback) ?></p>
                                        </div>
                                    </div>
                                </div>
                                
                            <?php endforeach ?>
                        <?php else: ?>
                            <div class="col-md-12">
                                <p class="pl-3"><?php echo trans('no-data-found') ?></p>
                            </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>






        <div class="carousel-3 owl-carousel owl-theme">
            <?php $b=1; foreach ($blogs as $blog): ?>
            <div class="cbrand-carousel-5 owl-carousel owl-theme mb-4 mb-md-5 mb-lg-0 mt-6 lift-xs">
                <article class="card shadow-none h-100 border-0" data-aos="fade-up" data-aos-delay="<?= $b * 100; ?>"> 
                    <a href="<?php echo base_url('post/'. $mentor->slug.'/'.$blog->slug) ?>">
                        <div class="blog-img round-1" style="background-image: url(<?php echo base_url($blog->image) ?>);"></div>
                    </a>
                    <div class="card-body p-0">
                        <div class="d-flex justify-content-between align-items-center mb-2 mt-4">
                            <p class="text-muted mb-0"><span class="text-muted"><?php echo my_date_show($blog->created_at) ?></span></p>
                        </div>
                        <h3 class="h5 mb-4">
                            <a class="text-dark" href="<?php echo base_url('post/'. $mentor->slug.'/'.$blog->slug) ?>"><h5><?php echo html_escape($blog->title) ?></h5></a>
                        </h3>

                        <a class="text-muted link-hover" class="mt-5" href="<?php echo base_url('post/'. $mentor->slug.'/'.$blog->slug) ?>"> <?php echo trans('read-more') ?> <i class="pl-1 pt-1 bi bi-arrow-right"></i></a>
                    </div>
                </article>
            </div>
            <?php $b++; endforeach ?>
        </div>
    </div>  

</section>


<!-- Modal -->
<div class="modal fade" id="send_message" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <div class="message_modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle"><?php echo trans('message-to') ?> <?php echo html_escape($mentor->name) ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true"><i class="bi bi-x"></i></span>
            </button>
        </div>
        <form class="" action="<?php echo base_url('home/send_message_mentor') ?>" method="POST">
            <div class="message-modal-body">
                <div class="form-group">
                    <textarea class="form-control"  name="message" placeholder="write your message" rows="3"></textarea>
                </div>
                <input type="hidden" name="mgs_to" value="<?php echo html_escape($mentor->id) ?>">
                <input type="hidden" name="mgs_from" value="<?php echo html_escape($this->session->userdata('id')) ?>">
            </div>

            <div class="message-modal-footer">
                <input type="hidden" name="<?php echo html_escape($this->security->get_csrf_token_name());?>" value="<?php echo html_escape($this->security->get_csrf_hash());?>">
                <button type="submit" class="btn btn-primary"><?php echo trans('send-message') ?></button>
            </div>
        </form>
    </div>
  </div>
</div>
