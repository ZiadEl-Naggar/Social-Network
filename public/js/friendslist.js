$(document).ready(function() {
    $(".navbar li").removeClass('active');
    $(".navbar .friends").addClass('active');
    window.onload = myFriends();
});

$('#myfriends').click(function(){
    myFriends();
});

$('#received-requests').click(function(){
    receivedRequests();
});

$('#sent-requests').click(function(){
    sentRequests();
});

$('#others').click(function(){
    others($(this).attr("id"));
});

function myFriends(){
    $.ajax(
        {
            type:"GET",
            url:"/friends/myfriends",
            success: function(data){
                $('a.active').removeClass("active");
                $('#myfriends').addClass('active');
                $('#list').html(data);
            }
        }
    )
}

function receivedRequests(){
    $.ajax(
        {
            type:"GET",
            url:"/friends/received",
            success: function(data){
                $('a.active').removeClass("active");
                $('#received-requests').addClass('active');
                $('#list').html(data);
            }
        }
    )
}

function sentRequests(){
    $.ajax(
        {
            type:"GET",
            url:"/friends/sent",
            success: function(data){
                $('a.active').removeClass("active");
                $('#sent-requests').addClass('active');
                $('#list').html(data);
            }
        }
    )
}

function others(){
    $.ajax(
        {
            type:"GET",
            url:"/friends/others",
            success: function(data){
                $('a.active').removeClass("active");
                $('#others').addClass('active');
                $('#list').html(data);
            }
        }
    )
}