$(".thumbs-up").click(function() {
    console.log('1')
    postid = $(this).parent('div').parent('div').parent('div').attr('id');
    console.log('2')
    react = 'thumbs-up'
    console.log('3')
    changeReact(postid, react);
})

$(".heart").click(function() {
    postid = $(this).parent('div').parent('div').parent('div').attr('id');
    react = 'heart'
    changeReact(postid, react);
})

$(".thumbs-down").click(function() {
    postid = $(this).parent('div').parent('div').parent('div').attr('id');
    react = 'thumbs-down'
    changeReact(postid, react);
})

$('.addcomment').click(function() {
    postid = $(this).parent('div').parent('div').parent('div').parent('div').attr('id');
    comment = $('#comment'+postid).val();
    if(comment.length > 0 && comment.trim() != ''){
        comment = comment.trim();
        $.ajax(
        {
            type:"POST",
            url: "/comment",
            data:{
                '_token': $('meta[name=csrf-token]').attr('content'),
                postid: postid,
                comment: comment,
            },
            success: function( data ) 
            {
                $('#commentsection'+postid).append('<div class="mb-1 mt-1" id="'+data['commentid']+'"><div class="d-flex align-items-start"><img class="d-block mr-1" style="max-width: 30px; height: auto; border-radius:50%" src="'+data['userimg']+'" alt=""><div class="d-flex flex-column"><a href="'+data['userurl']+'"><h6 class="pb-0 mb-0">'+data['name']+'</h6></a><small>'+data['date']+'</small></div><div class="d-flex flex-fill justify-content-end dropdown"><button class="btn btn-sm p-0" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" type="submit"><svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-three-dots" fill="currentColor" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 9.5a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3zm5 0a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3z"/></svg></button><div class="dropdown-menu p-0" style="min-width: inherit" aria-labelledby="dropdownMenuButton"><button id=del'+data['commentid']+' class="dropdown-item p-1 deletecomment">Delete</button></div></div></div><span type="text" readonly class="form-control-plaintext pb-0 pt-0" value="">'+comment+'</span></div>');
                $('#del'+data['commentid']).attr("onclick", "deletecomment("+postid+", "+data['commentid']+")");
                $('#comment'+postid).val('');
                $('#nocomments'+postid).hide();
            },
            error: function(result) {
                alert('error');
            }
         })   
    }
})

$('.deletecomment').click(function() {
    postid = $(this).parent('div').parent('div').parent('div').parent('div').parent('div').parent('div').parent('div').attr('id');
    commentid = $(this).parent('div').parent('div').parent('div').parent('div').attr('id');
    deletecomment(postid, commentid);
})

function changeReact(postid, react){
    $.ajax(
        {
            type:"POST",
            url:"/react",
            data:{
                '_token':$('meta[name=csrf-token]').attr('content'),
                postid:postid,
                react:react,
            },
            success: function(data){
                if(data['result'] == react){
                    $("#reactssection"+postid+" #"+react).html('<i class="fas fa-'+react+'"></i>')
                    if (data['old'] !== "") {
                        $("#reactssection"+postid+" #"+data['old']).html('<i class="far fa-'+data['old']+'"></i>')
                    }
                } else {
                    $("#reactssection"+postid+" #"+react).html('<i class="far fa-'+react+'"></i>')
                }
            }
        }
    )
}

function deletecomment(postid, commentid) {
    postid = postid
    commentid = commentid
    $.ajax(
    {
        type:"POST",
        url: "/deletecomment",
        data:{
            '_token': $('meta[name=csrf-token]').attr('content'),
            postid: postid,
            commentid: commentid,
        },
        success: function( data ) 
        {
            $('#'+data['commentid']).remove();
        },
        error: function(result) {
            alert('error');
        }
    })
}