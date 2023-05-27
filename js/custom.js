
var flag = 0;
$('#posts').click(function () {

    var status = $('#status').val();
    var file_data = $('#formFile').prop('files')[0];
    var form_data = new FormData();

    form_data.append('file', file_data);
    form_data.append('status', status);
    form_data.append('status_code', 123);

    $.ajax({
        method: 'POST',
        url: 'ajax.php',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        success: function (data) {
            read();
            profile_status();
            $('#status').val('');
            $("#formFile").val(null);
            $("#exampleModal").modal('hide');


        }
    })




});


read();
var globIDcnt = 1;


function read() {

    $('#status_post').empty();


    $.ajax({
        method: "POST",
        url: "ajax.php",
        data: {
            code: 1234,
        },
        success: function (data) {

            var showdata = JSON.parse(data)
            var length = showdata.length;
            //for get user name and image form php sesssion
            var username = $('#username').val();
            var user_image = $('#user_image').val();

            for (var i = 0; i < length; i++) {

                let likeid = "like" + i;
                let postid = "postid" + i;
                var countlikeid = "countlikeid" + i;

                var html = '';
                html += '<div class="py-3">';
                html += '<input type="hidden" id="' + postid + '" value="' + showdata[i].post_id + '">';
                html += '<div class="card" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.5), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">';
                html += '<div class="card-body">';
                html += '<div class="d-flex">';
                html += '<div><img src="' + showdata[i].profile_image + '" alt="Avatar Logo" style="width:40px;"class="rounded-pill"></div>';
                html += '<div class="d-flex justify-content-evenly align-items-center">';
                html += '<div style="margin-left: 10px;">' + showdata[i].user_name + ' </div>';
                html += '<div style="padding: 20px;color: gray;">Update A Post</div>';
                html += '<div class="float-end" style="padding: 20px;color: gray;">'+showdata[i].created_at +'</div> </div> </div>';
                html += '<div class="text-center post_image"><img src="' + showdata[i].image + '" alt=""> </div>';
                html += '<div class="pt-2">' + showdata[i].posts + '</div>';
                html += '<div class="p-2" id="'+countlikeid+'">' + showdata[i].like_count + ' Likes</div>';
                html += '<div class="d-flex justify-content-start pt-2 like_comments">';
                html += '<div style="margin-right: 10px;">';
                html += '<a  type="button" class="click" style="color:black" id="' + likeid + '" onclick="likeFunction(this.id)"><i class="fa-sharp fa-solid fa-thumbs-up"></i> like</a></div>';
                html += '<div><a href="#" type="button" data-bs-toggle="modal" data-bs-target="#commentsmodal" style="color:black"><i class="fa-solid fa-comment"></i> comments</a></div>';
                html += '</div></div>';
                html += '<div class="card-footer">';
                html += '<div class="d-flex justify-content-start align-content-center">';
                html += '<div style="margin-right:10px"><img src="img/login_logo.jpg" alt="Avatar Logo" style="width:20px;" class="rounded-pill"></div>';
                html += '<span style="margin-right:15px">Adam</span>';
                html += ' <small id="testest">I was there too!1</small>';
                html += '</div>'
                html += '</div>'
                html += '</div>'
                html += '</div>'
                html += '</div>'


                $('#status_post').append(html);



                var get_post_id = showdata[i].post_id

                $.ajax({
                    method: "POST",
                    url: "ajax.php",
                    data: {
                        post_id: get_post_id,
                        code: 222,
                    },
                    success: function (data) {

                        var showdata = JSON.parse(data)
                        for (var i = 0; i < showdata.length; i++) {
                            var check_post_id = showdata[0].post_id;
                            var post_id = '#' + postid;
                            var like_id = '#' + likeid;
                            var post_val_id = $(post_id).val()
                            if (check_post_id == post_val_id) {
                                $(like_id).html('<i class="fa-solid fa-thumbs-down"></i> unlike')
                                $(like_id).css("color", "red");
                                // $(post_id).html('<i class="fa-solid fa-thumbs-down"></i> unlike')
                                // $(post_id).css("color", "red");
                                // alert("asdf")

                            }
                        }

                    }

                });

            }

        }
    });
}

// Event handler and the first input

function likeFunction(get_id) {
    var count = 0;




    var postid = '#' + get_id;
    var number = postid.replace(/\D/g, '');
    var user_post = '#postid' + number;

    var countlike = '#countlikeid' + number;


    if ($(postid).html() == '<i class="fa-sharp fa-solid fa-thumbs-up"></i> like') {
        $(postid).html('<i class="fa-solid fa-thumbs-down"></i> unlike')
        $(postid).css("color", "red");
        count++;

        var post_id = $(user_post).val();


        $.ajax({
            method: "POST",
            url: "ajax.php",
            data: {

                post_id: post_id,
                addlike: count,
                code: 12345,
            },
            success: function (data) {


                $(countlike).empty().append(data + " Likes")

                // alert(data)

            }
        });





    } else {
        $(postid).html('<i class="fa-sharp fa-solid fa-thumbs-up"></i> like')
        $(postid).css("color", "black")
        var post_id = $(user_post).val();

        count--;
        $.ajax({
            method: "POST",
            url: "ajax.php",
            data: {

                post_id: post_id,
                addlike: count,
                code: 12345,
            },
            success: function (data) {
                $(countlike).empty().append(data + " Likes")

            }
        });





    }

}


    profile_status();



function profile_status() {
    $('#p_status_post').empty();

    $.ajax({
        method: "POST",
        url: "ajax.php",
        data: {
            code: 242424,
        },
        success: function (data) {
            var showdata = JSON.parse(data)
            var length = showdata.length;
            //for get user name and image form php sesssion
            var username = $('#username').val();
            var user_image = $('#user_image').val();

            for(var i = 0; i < length; i++){
                let deleteid = "delete" + i;

                var html = '';
                html += '<div class="py-3">';
                // html += '<input type="hidden" id="' + postid + '" value="' + showdata[i].post_id + '">';
                html += '<div class="card" style=" box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.5), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">';
                html += '<div class="card-body">';
                html += '<div class="d-flex">';
                html += '<div><img src="' + user_image + '" alt="Avatar Logo" style="width:40px;"class="rounded-pill"></div>';
                html += '<div class="d-flex justify-content-evenly align-items-center">';
                html += '<div style="margin-left: 10px;">' + username + ' </div>';
                html += '<div style="padding: 20px;color: gray;">Update A Post</div>';
                html += '<div class="float-end" style="padding: 20px;color: gray;">'+showdata[i].created_at +'</div> </div> </div>';
                html += '<button class ="btn btn-danger float-end" id="' +  showdata[i].post_id +'" onclick="deleteFunction(this.id)"><i class="fa-solid fa-trash"></i></button>';
                html += '<div class="text-center post_image"><img src="' + showdata[i].image + '" alt=""> </div>';
                html += '<div class="pt-2">' + showdata[i].posts + '</div>';

                html += '<div class="d-flex justify-content-start pt-2 like_comments">';
                html += '<div style="margin-right: 10px;">';
                //html += '<a  type="button" style="color:black" id="' + likeid + '" onclick="likeFunction(this.id)"><i class="fa-sharp fa-solid fa-thumbs-up"></i> like</a></div>';
                //html += '<div><a href="#" type="button" data-bs-toggle="modal" data-bs-target="#commentsmodal" style="color:black"><i class="fa-solid fa-comment"></i> comments</a></div>';
                html += '</div></div>';
                html += '<div class="card-footer">';
                html += '<div class="d-flex justify-content-start align-content-center">';
                html += '<div style="margin-right:10px"><img src="img/login_logo.jpg" alt="Avatar Logo" style="width:20px;" class="rounded-pill"></div>';
                html += '<span style="margin-right:15px">Adam</span>';
                html += ' <small>I was there too!1</small>';
                html += '</div>'
                html += '</div>'
                html += '</div>'
                html += '</div>'
                html += '</div>'

                $('#p_status_post').append(html);



            }





        }

    });
}


var flag2 = 0;

function deleteFunction(deleteid) 

{
    var post_id = deleteid;

    $.ajax({
        method: "POST",
        url: "ajax.php",
        data: {
            post_id:post_id,
            code: 852,
        },
        success:function(data){
            alert(data);
          profile_status();

        }

    })
 
    
  }



  $('#profile_submit').click(function (e){
      e.preventDefault();

      var profile_name = $('#profile_name').val();
      var user_email = $('#user_email').val();

      var file_data = $('#profile_image').prop('files')[0];
      var cover_image = $('#cover_image').prop('files')[0];

      var form_data = new FormData();



      form_data.append('profile_image', file_data);
      form_data.append('cover_image', cover_image);

      form_data.append('profile_name', profile_name);
      form_data.append('user_email', user_email);
      form_data.append('code', 35275);

      $.ajax({
          method: 'POST',
          url: 'ajax.php',
          cache: false,
          contentType: false,
          processData: false,
          data: form_data,
          success: function (data) {


            alert(data);


          }
      })



  });




//friends section
$(document).ready(function(){

    friends_list();


});

function friends_list(){
    $('#suggestion_friends').empty();


    $.ajax({
        method: 'POST',
        url: 'ajax.php',
        data:{
            code:1212,
        },
        success: function (data) {


            var friends_list = JSON.parse(data)
            var length = friends_list.length;


            for(var i = 0;i<length;i++){
                let request_user = "request_user" + i;
                var reqest_user_id = "reqest_user_id"+i;

                var html = '';
                html += '<div class="d-flex justify-content-evenly align-items-center">';
                html += ' <div><img src="'+friends_list[i].profile_image+'" alt="Avatar Logo" style="width:40px;" class="rounded-pill"></div>';
                html +='<div style="padding:20px">'+friends_list[i].user_name+'</div>';
                html += '<input type="hidden" value="'+friends_list[i].user_id+'" id="'+reqest_user_id+'">';
                html +='<div style="padding:20px"><button class="btn btn-info" id="'+request_user+'" onclick="send_request(this.id)">Add</button> </div>';

                $('#suggestion_friends').append(html);

                var get_frinend_id = friends_list[i].user_id;
                check_requerst(get_frinend_id,request_user)


            }

        }

    });
}


function send_request(send_id){

    var number = send_id.replace(/\D/g, '');

    var reqest_user = '#reqest_user_id'+number;

    var friend_reqest_user_id = $(reqest_user).val()
    var lin_req_id = "#"+send_id;

   $.ajax({
       method: 'POST',
       url: 'ajax.php',
       data:{
           code:1313,
           friend_reqest_user_id:friend_reqest_user_id,
       },
       success:function (data){


            var cancel_req = data;
            if (cancel_req == 'Cancel'){
                $(lin_req_id).html(cancel_req);
                $(lin_req_id).removeClass("btn-info");
                $(lin_req_id).addClass('btn-danger');

            }else if(cancel_req == 'Add'){
                $(lin_req_id).html(cancel_req);
                $(lin_req_id).removeClass("btn-danger");
                $(lin_req_id).addClass('btn-info');

            }

       }

   });


}


function check_requerst(get_frinend_id,request_user){
    var get_req_line_id = '#'+request_user;


    var get_friend_id = get_frinend_id;

    $.ajax({
        method: "POST",
        url: "ajax.php",
        data: {
            get_frinend_id: get_friend_id,
            code: 1414,
        },
        success: function (data) {


            var showsend_req = JSON.parse(data);

            for (var i = 0; i < showsend_req.length; i++) {

                var check_friend_id = showsend_req[i].receiver_id;

                if (get_friend_id == check_friend_id){
                    //$(get_req_line_id).css({"background-color":"green !important"});
                    $(get_req_line_id).html("Cancel");
                    $(get_req_line_id).removeClass("btn-info");
                    $(get_req_line_id).addClass('btn-danger');


                }

            }

        }


    });

}



$(document).ready(function(){

    notification()
    friend_request_list();
    connected_friends_list();




    //peoples list in add_friend_list page
    $.ajax({
        method: "POST",
        url: "ajax.php",
        data: {
            code: 2323,
        },
        success:function (data){

            var friends_list = JSON.parse(data)
            var length = friends_list.length;
            for (var i = 0; i < length; i++){

                // let user_id = 'user_id'+i;
                // let user_profile_id = 'user_profile_id' + i;


                var html = '';
                html += ' <div class="col-12 col-sm-12 col-md-6 col-lg-3 pt-2">';
                html += '<div class="card" style="background-color:#dfe4ea;">';
                html += '<div class="card-body text-center">';
                html += ' <div><img src="'+friends_list[i].profile_image+'" alt="Avatar Logo" style="width:70px; height: auto;" class="rounded-pill"></div>';
                html += '<div class="p-1">'+friends_list[i].user_name+'</div>';
                html += '<div class="d-flex justify-content-between" style="font-size: 20px;">';
                html += '<button class="btn btn-success"><i class="fa-solid fa-user-plus"></i> Follow</button>';
                // html += '<input type="hidden" id="'+user_profile_id+'"  value="'+friends_list[i].user_id+'" >';
                html += '<a href="peoples_profile.php?id='+friends_list[i].user_id+'" class="btn btn-warning" ><i class="fa-solid fa-user-plus"></i> View Profile</a>';
                html += '</div> </div> </div>';
                $('#peoples_list').append(html);
            }

        }
    })

})


function friend_request_list(){

    $('#friend_request_list').empty();


    $.ajax({
        method: "POST",
        url: "ajax.php",
        data: {
            code: 1616,
        },
        success:function (data){
            var friend_request_list = JSON.parse(data);
            var arrayLength = friend_request_list.length;
            let user_name;
            for (var i = 0; i < arrayLength; i++){

                var delete_req = 'delete_req'+i;
                var requester_id = 'requester_id'+i;
                var accept_req = 'delete_req'+i;



                let user_name = friend_request_list[i].user_name;
                let profile_image = friend_request_list[i].profile_image;
                let requester_id_value = friend_request_list[i].user_id;

                var html2 = '';
                html2 += '<tr>';
                html2 += '<td>';
                html2 += '<div class="d-flex justify-content-evenly">';
                html2 += ' <div><img src="'+profile_image+'" alt="Avatar Logo" style="width:40px;" class="rounded-pill">';
                html2 += '</div>';
                html2 += '<div style="padding:20px">'+user_name+'</div></div></td>';
                html2 += '<td>';
                html2 += '<div style="padding:20px">';
                html2 += '<input type="hidden" value="'+requester_id_value+'" id="'+requester_id+'">';
                html2 += '<span><a type="button"  id="'+accept_req+'"  onclick="acceptRequest(this.id)" class=" text-success me-4"> <i class="fa-solid fa-check  fa-2xl"></i><a type="button" id="'+delete_req+'" class=" text-danger" onclick="deleteRequest(this.id)"><i class="fa-sharp fa-solid fa-xmark fa-2xl"></i></a></span> ';
                html2 += '</div></td></tr>';

                $('#friend_request_list').append(html2);

            }



        }
    })
}


function notification(){
    $('#notification').empty();
    $.ajax({
        method: "POST",
        url: "ajax.php",
        data: {
            code: 1515,
        },
        success:function (data){

            var html = '';
            html +=  '<sup><span class="badge rounded-pill bg-danger">'+data+'</span></sup>';

            $('#notification').append(html);
        }
    })
}




function deleteRequest(get_id){

    var number = get_id.replace(/\D/g, '');
    var requester_id = '#requester_id'+number;
    var requester_id_value = $(requester_id).val();

    $.ajax({
        method: "POST",
        url: "ajax.php",
        data: {
            code: 1717,
            requester_id_value:requester_id_value
        },
        success:function (data){
          alert(data)
            notification()
            friend_request_list();
            friends_list();
        }

    })




}


function acceptRequest(get_id) {

    var number = get_id.replace(/\D/g, '');
    var requester_id = '#requester_id'+number;
    var requester_id_value = $(requester_id).val();


    $.ajax({
        method: "POST",
        url: "ajax.php",
        data: {
            code: 1818,
            requester_id_value:requester_id_value
        },
        success:function (data){

            alert(data)
            friend_request_list();
            notification();
            connected_friends_list();
            friends_list();
        }

    })


}


//connected friends

function  connected_friends_list(){



    $('#connected_friends').empty();

    $.ajax({
        method: "POST",
        url: "ajax.php",
        data: {
            code: 1919,
        },
        success:function (data){


            var friend_list = JSON.parse(data);


            var arrayLength = friend_list.length;

            for (var i = 0; i < arrayLength; i++){

                var delete_req = 'delete_req'+i;
                var requester_id = 'requester_id'+i;
                var accept_req = 'delete_req'+i;



                let user_name = friend_list[i].user_name;

                let profile_image = friend_list[i].profile_image;
    //             let requester_id_value = friend_request_list[i].user_id;
    //
                var html2 = '';
                html2 += '<tr>';
                html2 += '<td>';
                html2 += '<div class="d-flex justify-content-evenly">';
                html2 += ' <div><img src="'+profile_image+'" alt="Avatar Logo" style="width:40px;" class="rounded-pill">';
                html2 += '</div>';
                html2 += '<div style="padding:20px">'+user_name+'</div></div></td>';
                html2 += '<td>';
                html2 += '<div style="padding:20px">';
                html2 += '<button class="btn btn-success"><i class="fa-solid fa-user"></i></button> ';
                html2 += '</div></td></tr>';

                $('#connected_friends').append(html2);
    //
            }



        }
    });
}


// function add_friend_list(){
//
// }