<script>
    $(document).ready(function () {

        var $datePicker = $("#datepickers");
        var base_url = $('#base_url').val();
        var business_id = 0;
        var arrayFromPHP = <?php echo json_encode($not_available) ?>;
        var disabledDays = <?php echo $holidays ?>;
        var session_id = <?php echo html_escape($session->id) ?>;
        $.datepicker.regional ['en'] = {
            clearText: 'Clear', 
            clearStatus: '',
            closeText: 'Close',
            closeStatus: 'Close without modifying',
            prevStatus: 'See previous month',
            nextStatus: 'See next month',
            currentText: 'Current',
            currentStatus: 'See current month',
            monthNames: ['<?php echo trans('january') ?>', '<?php echo trans('february') ?>', '<?php echo trans('march') ?>', '<?php echo trans('april') ?>', '<?php echo trans('may') ?>', '<?php echo trans('june') ?>',
            '<?php echo trans('july') ?>', '<?php echo trans('august') ?>', '<?php echo trans('september') ?>', '<?php echo trans('october') ?>', '<?php echo trans('november') ?>', '<?php echo trans('december') ?>'],
            monthNamesShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            monthStatus: 'See another month',
            yearStatus: 'See another year',
            weekHeader: 'Sm',
            weekStatus: '',
            dayNames: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
            dayNamesShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
            dayNamesMin: ['<?php echo trans('su') ?>', '<?php echo trans('mo') ?>', '<?php echo trans('tu') ?>', '<?php echo trans('we') ?>', '<?php echo trans('th') ?>', '<?php echo trans('fr') ?>', '<?php echo trans('sa') ?>'],
            dayStatus: 'Use DD as the first day of the week',
            dateStatus: 'Choose the DD, MM of',
            firstDay: 0,
            initStatus: 'Choose date',
            isRTL: false
        }; 

        $.datepicker.setDefaults($.datepicker.regional['en']);

        $datePicker.datepicker({
            daysOfWeekDisabled: [0],
            changeMonth: false,
            changeYear: false,
            showOtherMonths: true,
            selectOtherMonths: true,
            showButtonPanel: true,
            minDate: 0,
            maxDate: 90,
            todayBtn: false,
            dateFormat: 'yy-mm-dd',
            onSelect: function(){
                var date = $(this).val();
                var btime_zone = $('.booking_time_zone').val();
                $('.booking_date').val(date);

                var url = base_url+'home/get_time/'+date+'/'+session_id+'/'+btime_zone;
                var post_data = {
                    'csrf_test_name' : csrf_token
                };

                $('#load_data').html('<span class="spinner-border spinner-border-sm"></span>');

                $.ajax({
                    type: "POST",
                    url: url,
                    dataType: 'json',
                    data: post_data,
                    success: function(data) {
                        if (data.status == 0) {
                            $('.step2_btn').prop('disabled', true);
                        }
                        $('#load_data').html(data.result);
                    }
                })

            },

            beforeShowDay: function(date) {
                var show = true;
          
                $.each(arrayFromPHP, function (i, elem) {
                    if(date.getDay() == elem-1) show = false
                });

                //new holidays code
                var dateString = $.datepicker.formatDate("yy-mm-dd", date);
                if (disabledDays.indexOf(dateString) !== -1) {
                    show = false;
                }

                // holidays
                // var m = date.getMonth(), d = date.getDate(), y = date.getFullYear();
                // for (i = 0; i < disabledDays.length; i++) {
                //     if($.inArray(y + '-' + (m+1) + '-' + d,disabledDays) != -1) {
                //         show = false
                //     }
                // }
                
                return [show];
            }

        });
    });
</script>


<script>

    var base_url = $('#base_url').val();
    var session_id = <?php echo html_escape($session->id) ?>;

    $(document).ready(function() {


        
        // Handle click events on days
        $(".day").click(function() {
            $(".day").removeClass("active");
            $(this).addClass("active");
            var selectedDate = $(this).data("date");
            //alert(selectedDate); return false ;
            console.log("Selected Date:", selectedDate);
            
            var btime_zone = $('.booking_time_zone').val();
            $('.booking_date').val(selectedDate);

            var url = base_url+'home/get_time/'+selectedDate+'/'+session_id+'/'+btime_zone;
            var post_data = {
                'csrf_test_name' : csrf_token
            };

            $('#load_data').html('<span class="spinner-border spinner-border-sm"></span>');

            $.ajax({
                type: "POST",
                url: url,
                dataType: 'json',
                data: post_data,
                success: function(data) {
                    if (data.status == 0) {
                        $('.step2_btn').prop('disabled', true);
                    }
                    $('#load_data').html(data.result);
                }
            })
        });


    });
</script>

    


