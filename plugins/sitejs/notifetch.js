$(document).ready(function (){
    showUnreadNotifications();
    showTimeleftNotifications();
    getTimeRemaining();
    
});

function showUnreadNotifications(option = ''){
    let user_userid = document.getElementById("userID").value;
    $.ajax({                                      
  url: '../fetchNotifications.php',              
  type: "POST",          
  data: {option: option,user: user_userid},
  dataType: 'json',
  success: function(data){
      $('.noti-menu').html(data.notification);
      if(data.unreadNotification > 0 ) {
        $('.noti-badge').html(data.unreadNotification);
      }
  }
 });
}

function checkBooking(){
    $('.noti-badge').html('');
    showUnreadNotifications(option = 'read');
}
function checkUpcomming(a){
    $('.timeleft-badge').html('');
    var myLink = a.getAttribute('value');
    showTimeleftNotifications(option = myLink);
}

function showTimeleftNotifications(option = ''){
    let user_userid = document.getElementById("userID").value;
    const audio = new Audio('https://wangmai.eng.cmu.ac.th/dist/audio/Red_Dwarf.ogg');
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-full-width",
        "preventDuplicates": true,
        "preventOpenDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "0",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      };
    $.ajax({                                      
        url: 'fetchTimeleft.php',              
        type: "POST",          
        data: {option: option,user: user_userid},
        dataType: 'json',
        success: function(data){
            $('.timeleft-menu').html(data.notification);
            if(data.toast == 'found' && data.unreadNotification > 0 )
            {
                toastr.error('You have 1 booking coming in!');
                $('.timeleft-badge').html(1);
                audio.play();
            }
            else
            {
                //
            }
            
        }
    });
      
}


function getTimeRemaining(option = ''){
    
    let user_userid = document.getElementById("userID").value;
    $.ajax({                                      
        url: '../fetchTimeleft.php',              
        type: "POST",          
        data: {option: option,user: user_userid},
        dataType: 'json',
        success: function(data){
            var interval = setInterval(function() {
                const total = Date.parse(data.futuredate) - Date.parse(new Date());
                const seconds = Math.floor( (total/1000) % 60 );
                const minutes = Math.floor( (total/1000/60) % 60 );
                const hours = Math.floor( (total/(1000*60*60)) % 24 );
                const days = Math.floor( total/(1000*60*60*24) );
                console.log('Days:'+days+'Hours:'+hours+'Min:'+minutes);
                if(((days == 0 && hours == 0)||(days == -1 && hours == -1)) && minutes <= 5 && minutes > -5)
                {
                    
                    clearInterval(interval);
                    showTimeleftNotifications('');
                }
                if(minutes <= -7 || isNaN(minutes))
                {
                    clearInterval(interval);
                }  
              }, 3000);
            
            // if(data.unreadNotification > 0 ) {
            //     $('.noti-badge').html(data.unreadNotification);
            // }
        }
    });
    
  }

