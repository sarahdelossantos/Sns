  @extends('sns_final/template_dashboard')

  @section('sidebarleft_section')

  <style>


  </style>


  <div  class='left' style=' padding-left:5%; padding-right:5%; border-right: 1px;'>

   @if (count($currentuser->userinfo) == 0)
   <img src='{{ asset("images/userpic/noavatar.png")}}' class='image-avatar-s'>
   <?php $name = $currentuser->name; ?>
   @else
   <br>
   <img src='{{ asset("images/userpic/$myinfo->avatar")}}' class='image-avatar-s'>
   <?php $fname = $currentuser->userinfo()->latest()->first()->fname ; ?>
   <?php $lname = $currentuser->userinfo()->latest()->first()->lname; ?>
   <?php $name = $fname." ".$lname; ?>
   @endif
   
   <a href='{{ url("user/$currentuser->id") }}'>{{$name}}</a>
   <br>  <br>
   <a href='' ><div>Newsfeed<span class="glyphicon glyphicon-option-horizontal pull-right" style='color:gray '></span></div></a>
   <h5><strong>SHORTCUTS</strong></h5>
   <a href='{{url("user/$currentuser->id/friends")}}'><div><span class="glyphicon glyphicon-user" style="color:#0066ff;"></span> Friends <span class='pull-right'>{{ $friendCount }}</span></div></a>
   <a href=''><div><span class="glyphicon glyphicon-picture " style=" color:#a5d950;"></span> Photos <span></span></div></a>
   <h5><strong>EXPLORE</strong></h5>

   <a href=''><div><span class="glyphicon glyphicon-plus" style='color:#00ccff'></span> Suggested People <span></span></div></a>
   <a href=''><div><span class="glyphicon glyphicon-align-center" style='color: #ff66ff;'></span> Pages<span></span></div></a>
   <a href=''><div><span class="glyphicon glyphicon-phone" style='color:#006600;'></span> Groups<span></span></div></a>
   <h5><strong>CREATE</strong></h5>

   <span style='text-decoration: '><a href="">Add</a> • <a href="">Page</a> • <a href="">Group</a> • <a href="">Event</a></span>

 </div>


 <!-- (!is_null($myFriendRequests) || (!($myFriendRequests->isEmpty())) ) -->
 @if(!($myFriendRequests->isEmpty()) )

 <div style='background-color: white;'>



  <div>

    <div class='sidebar_right' style='padding-bottom:2% ;background-color: #F6F7F9;'>
      <div>
       <div style="padding-left:5%">

        <h5><span class="glyphicon glyphicon-ok" style='color:#0066ff'></span> FriendRequest</h5>
         <?php $mightKnow[]= $currentuser->id ; ?>
       </div>
     </div>

     <div class='row' style="padding-left:5%; padding-right:5%; " >

       @foreach($myFriendRequests as $user)
       <div class='col-md-12 col-xs-12' >



        @if(!in_array($user->id,$mightKnow))


        @if((count($user->userinfo) == 0) || ($user->userinfo->last()->avatar == ''))

        <img src='{{ asset("images/userpic/noavatar.png")}}' class='image-avatar-s'">
        <a href='{{ url("user/$user->id") }}'>  {{ $user->name }}</a>
        @else


        <img src='{{ asset("images/userpic/".$user->userinfo->last()->avatar)}}' class='image-avatar-s'">
        <a href='{{ url("user/$user->id") }}'>{{ $user->name }}</a>

        @endif


        <a href='{{ url("/addfriend/$user->id")}} pull-right' >

          <button onclick='accept({{$user->id}})' type="submit" class="btn btn-primary commentbutton pull-right">Accept</button></span>
        </a>
        @endif
      </div>       <!--   <a href='{{ url("user/$user->id") }}'>  {{ $user->name}}</a><br> -->


      @endforeach
    </div>

  </div>


</div>
</div>
@endif





<hr>  



<!-- {{ $myfriends }} -->
@endsection

@section('sidebarright_section')

@if($friendCount != 0)
<div class='sidebar_right'>
 <div class='row'>
   <div class='col-md-12 col-sm-12 col-xs-12'>

     <div style="padding-left:5%">
      <a href='{{url("user/$currentuser->id/friends")}}'><h2><span class='glyphicon glyphicon-user' style='color:#0066ff;'></span> Friends({{ $friendCount }})</h2></a>
    </div>

    @foreach($myfriends->take($take) as $friends)

    <div class='col-md-4 col-sm-4 col-xs-12' style=''>

      <div class='col-center-block text-center' style="background-color: white ;border: 1px solid black; ">
       @if( $friends->userinfo->isEmpty() || $friends->userinfo->last()->avatar=='')
       <!-- no avatar or blank -->
       <img src='{{ asset("images/userpic/noavatar.png")}}' class='image-avatar-m'>
       @else

       <img src='{{ asset("images/userpic/".$friends->userinfo->last()->avatar)}}' class='image-avatar-m'>

       @endif

     </div>
     <div class='friendlist'>
       <a href='{{ url("user/$friends->id") }}' class='friendlist-name'>  {{ $friends->name}}</a><br> 
       <?php $mightKnow[] = $friends->id; ?>
     </div>

   </div>

   @endforeach

 </div>
</div>

</div>
@endif


<div class='sidebar_right ' style='padding-bottom:2%'>



  <div>
   <div style="padding-left:5%">

    <h2><span class="glyphicon glyphicon-plus" style='color:#00ccff'></span> Suggested People</h3>
     <?php $mightKnow[]= $currentuser->id ; ?>
   </div>
 </div>

 <div class='row' style=''>

   @foreach($users->random(5) as $user)
   
   <div class='col-md-offset-1 col-md-10 col-xs-12 col-sm-12' style=' display: inline;white-space: initial;'>

    @if(!in_array($user->id,$mightKnow))

    @if((count($user->userinfo) == 0) || ($user->userinfo->last()->avatar == ''))

    <img src='{{ asset("images/userpic/noavatar.png")}}' class='image-avatar-s'">
  <a href='{{ url("user/$user->id") }}'>   <div style=' display: inline; overflow: hidden;'>{{ $user->name }}</div></a>
    @else


    <img src='{{ asset("images/userpic/".$user->userinfo->last()->avatar)}}' class='image-avatar-s'">
    <a href='{{ url("user/$user->id") }}'>{{ $user->name }}</a>

    @endif


    <a href='{{ url("/addfriend/$user->id")}} pull-right' ><button type="submit" class="btn btn-primary commentbutton pull-right" ><span class='glyphicon glyphicon-plus' style='color:#e4e4e4'></span></button></a>
    @endif
  </div>       <!--   <a href='{{ url("user/$user->id") }}'>  {{ $user->name}}</a><br> -->


  @endforeach
</div>

</div>
<br>

<div class='sidebar_right'>
 <div class='row'>
   <div class='col-md-12 col-sm-12 col-xs-12'>
     <div style="padding-left:5%">
      <ul class="list-inline">
        <li><span style='color:gray;'>English (US)</span></li>
        <li><a href=''>·Filipino</a></li>
        <li><a href=''>·Bisaya</a></li>
        <li><a href=''>·Español</a></li>
        <li><a href=''>·Português(Brasil)</a></li>


      </ul>

    </div>
  </div>
</div>

</div>
<br>

<div style='color:gray'>
Privacy · Terms · Advertising · Ad Choices · Cookies · 
More
Facebook © 2017

</div>




@endsection

<!-- ----------------------CONTENT SECTION -->

@section('content_section')

<div class='container-fluid '>





 <div class='row well'> 





  <form action= '{{ url("dashboard/createpost") }}'  method="POST" enctype="multipart/form-data" >
   {{ csrf_field() }}


   <div class='col-md-4'>
    <div class="form-group">
      <label for="exampleInputFile">File input</label>
      <input type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp" name= "image">
      <small id="fileHelp" class="form-text text-muted">This is some placeholder block-level help text for the above input. It's a bit lighter and easily wraps to a new line.</small>
    </div>
  </div>
  <div class='col-md-8'>
    <div class="form-group">
      <label for="exampleTextarea"></label>
      <textarea class="form-control" id="exampleTextarea" rows="3" name= "post_body"  placeholder="What's on your mind?"></textarea>
    </div>  </div>
    <div class='col-md-12'>
     <button type="submit" class="btn btn-primary pull-right button" >Post</button>
   </form>

 </div>
</div>

</div>


@foreach($posts->wherein('user_id',$mightKnow) as $post)

<!-- ----- post start-->

<div class='well' style="; background-color: #FFFFFF; bottom-margin:2%; border-radius: 0.5%; padding:0px;">
  <div style="background-color: #FFFFFF; padding: 2.5% 2.5% 2.5% 2.5%  ;">

    <?php $avatar = 'noavatar.png'; ?>

    @if(!(is_null($post->userinfo)))
    @if ($post->userinfo->where('user_id',$post->user_id)->latest()->first()->avatar != '') 

    <?php $avatar = $post->userinfo->where('user_id',$post->user_id)->latest()->first()->avatar; ?>


    @endif

    @endif



      <div>
        <img src='{{ asset("images/userpic/$avatar")}}' class='image-avatar-m img'>
        <a href='{{ url("user/".$post->user_id)}}'><strong>{{ $post->user->name}}</strong></a>


        <?php  $time = \Carbon\Carbon::createFromTimeStamp(strtotime($post->created_at))->diffForHumans() ?>
        
         <span><a href='{{url("post/$post->id")}}'style='color:gray;'><span class="glyphicon glyphicon-time"></span> {{ $time }}</a></span>

      

        @if($post->user->id == $currentuser->id)

        <span class="glyphicon glyphicon-remove-sign pull-right" id="delete_{{$post->id}}" onclick='deletePost({{$post->id}})' style='font-size: 150%; color: #E9EBEE; margin-left: 1%;'></span>

        <!--  glyphicon glyphicon-cog -->

        <span class="glyphicon glyphicon-cog pull-right" style='font-size: 150%; color: #E9EBEE' onclick='editPost({{$post->id}})' id="edit_{{$post->id}}"></span>

<!--            <a href='{{ url("post/edit/$post->id")}}'><span class="glyphicon glyphicon-cog pull-right" style='font-size: 150%; color: #E9EBEE' ></span></a>
-->

@endif
</div>

<div style="padding: 2%">{{ $post->body}}</div>


@if($post->img_src != '')
<div class='vertical-center'>
  <img src='{{ asset("images/userpost/$post->img_src")}}' class='img-responsive center-block' style='height:100%;'>
</div>
@endif

<hr class='row' style="margin-bottom: 1%;">
<!-- {{ $post->like()}} -->

@if( $post->islike() == 0 )
<!-- <a href='{{ url("post/like/{$post->id}")}}'>like</a> -->
<span id='color{{$post->id}}' class="btn btn-default btn-sm" onclick="like({{$post->id}})">
  <span class="glyphicon glyphicon-thumbs-up"></span><span id='{{$post->id}}'> Like</span>
  <span class="label label-default">{{ $post->like()}}</span> </span>


  @else
  <!-- <a href='{{ url("post/unlike/{$post->id}")}}'>unlike</a>| -->

  <span id='color{{$post->id}}' class="btn btn-default btn-sm" onclick="like({{$post->id}})" style='color:#365899'>
    <span class="glyphicon glyphicon-thumbs-up"></span> <u><strong><span id='{{$post->id}}'> Unlike</span></strong></u>
    <!-- <span class="badge" style='background-color:#365899'>{{ $post->like()}}</span> -->
  </span>

  @endif



         <!--    @if($post->user->id == $currentuser->id)
            <span  id="delete_{{$post->id}}" onclick='deletePost({{$post->id}})'>| <a>delete</a></span>

              <a href='{{ url("post/delete/$post->id")}}'>| delete</a>
              <a href='{{ url("post/edit/$post->id")}}'>| edit</a>
              @endif -->

              <div id="dialog-confirm_{{$post->id}}" title="Delete Post" style='display:none;'>
                <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>{{$post->user->name}}<br>"{{$post->body}}"</p>
              </div>

              <!-- edit post modal -->
              <div id="dialog-edit_{{$post->id}}" title="Edit Post" style='display:none;'>
                <p><span class="ui-icon ui-icon-alert" style="float:left; margin:12px 12px 20px 0;"></span>{{$post->user->name}}<br>"{{$post->body}}"</p>

                @if($post->img_src != '')
                <img src='{{ asset("images/userpost/$post->img_src")}}' class='image-avatar-m img'>
                @endif

                <form action='{{ url("post/edit/$post->id/save") }}' method="POST" enctype="multipart/form-data">
                  {{ csrf_field() }}

                  <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <input type="file" class="form-control-file" id="exampleInputFile" aria-describedby="fileHelp" name='post_image'>
                    <small id="fileHelp" class="form-text text-muted">This is some placeholder block-level help text for the above input. It's a bit lighter and easily wraps to a new line.</small>
                  </div>



                  <div class="form-group">
                    <label for="exampleTextarea"></label>
                    <textarea class="form-control" id="exampleTextarea" rows="3" name='post_body'>{{$post->body}}</textarea>
                  </div>

                  <button type="submit" class="btn btn-primary">Edit this post</button>
                </form>


              </div>

              <!-- edit post modal -->








            </div>

            <div class='row commentsection'>
              <div class='col-md-offset-1'>
                 <span class="glyphicon glyphicon-comment" style='color:#0066ff;'> {{($post->countComment() ) }}</span></span>

                @if($post->like() != 0)
                <span style='color:#DFE0E2;'>| <span id="countLike{{$post->id}}" class="glyphicon glyphicon-thumbs-up" style='color:#0066ff;'>
                <span id="COUNT{{$post->id}}" color:#0066ff;> {{ $post->like() }}</span></span></span>
                @else
                <span id="countLike{{$post->id}}" class="glyphicon glyphicon-thumbs-up" style="display:none ;color:#0066ff;">
                  <span id="COUNT{{$post->id}}"></span></span>
                  @endif




                  @foreach($post->comments()->orderBy('created_at','desc')->take(3)->get()->reverse() as $comment)
                  <div class='col-md-12' style="margin-bottom: 1%;">

                    <div class='col-md-1'>
                     <?php $commentAvatar = $comment->userinfo()->orderBy('created_at','asc')->first() ; ?>

                     @if(!is_null($commentAvatar))

                     <img src='{{ url("images/userpic/$commentAvatar->avatar")}}' class='image-avatar-s'>      
                     @else
                     <img src='{{ url("images/userpic/noavatar.png")}}' class='image-avatar-s'>  
                     @endif

                   </div>


                   <div style='padding-left: 11%;'>



                     <a href='{{ url("/user/$comment->user_id")}}' style='color:#3B5998'><big>{{ $comment->user->name}}</big></a>
                     <span id="{{$comment->id}}">{{$comment->comment_body}}</span>
                     <div >


                      <!-- <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($comment->created_at))->diffForHumans() ?> -->

<!-- 
                      @if($currentuser->id == $comment->user_id )
                      <a href='{{ url("/comment/delete/$comment->id")}}'><small>Delete</small></a>
                    
                      <span onclick="editComment({{$comment->id}})"><small>Edit</small></span>
                        1
                      @elseif($comment->user_id != $post->user_id && $comment->user_id == $currentuser->id)

                      <a href='{{ url("/comment/delete/$comment->id")}}'><small>Delete</small></a>
                      2
                      @elseif($comment->user_id != $post->user_id && $comment->user_id == $currentuser->id)
                      3
                      @endif -->

                      @if($currentuser->id == $post->user_id || $currentuser->id == $comment->user_id)
                      <a href='{{ url("/comment/delete/$comment->id")}}'><small>Delete</small></a>
                        @if($currentuser->id == $comment->user_id)
                         <span onclick="editComment({{$comment->id}})"><small>Edit</small></span>
                        @endif                       
                      @endif


                    </div>
                  </div>




                </div>
                @endforeach


              </div>

              <!-- start edit comment modal -->

              <div class='col-md-offset-1'>
                <form action= '{{ url("/post/comment/$post->id") }}'  method="POST" enctype="multipart/form-data">
                 {{ csrf_field() }}


                 <div class='col-md-8'>
                  <div class='row'>
                    <div class='col-md-2 '>
                      @if (count($currentuser->userinfo) == 0)
                      <img src='{{ asset("images/userpic/noavatar.png")}}' class='image-avatar-s'>
                      <?php $name = $currentuser->name; ?>
                      @else
                      <img src='{{ asset("images/userpic/$myinfo->avatar")}}' class='image-avatar-s'>
                      <?php $fname = $currentuser->userinfo()->latest()->first()->fname ; ?>
                      <?php $lname = $currentuser->userinfo()->latest()->first()->lname; ?>
                      <?php $name = $fname." ".$lname; ?>
                      @endif


                    </div>

                    <div class='col-md-8'>
                      <div class="form-group">
                        <!-- <label for="exampleInputEmail1">Lastname</label> -->
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="comment_body">
                        <!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->

                      </div>

                    </div>
                    <div class='col-md-2'>
                     <button type="submit" class="btn btn-primary commentbutton">Comment <span class="glyphicon glyphicon-comment" style='color:white;'></span></button>
                   </div>
                 </div>





               </form>

             </div>
             <!-- end edit comment modal -->




           </div>

         </div>

       </div>
     </form>

     <div id='csrf'>{{csrf_field()}} </div>
     <!-- --- post end -->
     @endforeach






     <script type="text/javascript">

      function deletePost(id){
        var dialog;

        dialog = $( "#dialog-confirm_"+id ).dialog({
          autoOpen: false,
          resizable: false,
          height: "auto",
          width: 400,
          modal: true,
          buttons: {
            "Delete this post": function() {
              $.get("{{ url("post/delete/")}}/"+id, function(data, status){
                location.reload();
              });
            },
            Cancel: function() {
              $( this ).dialog( "close" );
            }
          }
        });
        dialog.dialog( "open" );
      }



      function like(id){
        if($('#'+id).html() == " Like"){
          $.get("{{ url("post/like/")}}/"+id, function(data, status){
            $('#color'+id).css({"color":"#365899","font-weight":"bold",'text-decoration':'underline'});
            $('#'+id).html(" Unlike");
            var count = $('#COUNT'+id).html();
            if(count!="") count++
              else count = 1;
            $('#COUNT'+id).html(count);
            $('#countLike'+id).show();
          });
        } else {
          $.get("{{ url("post/unlike/")}}/"+id, function(data, status){
            $('#'+id).html(" Like");
            var count = $('#COUNT'+id).html();
            if(count == 1){
              $('#COUNT'+id).html("0");
              $('#countLike'+id).hide();
            } else $('#COUNT'+id).html(--count);

          });
        }
      }



      function accept(id){

        $.get("{{ url("accept/")}}/"+id, function(data, status){
         $('#accept_'+id).remove();
       });

    // alert(id);



  }





  function editPost(id){
    var dialog;

    dialog = $( "#dialog-edit_"+id ).dialog({
      autoOpen: false,
      resizable: false,
      height: "auto",
      width: 400,
      modal: true,
      buttons: {
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });
    dialog.dialog( "open" );
  }

  function editComment(id){
    var value = $('#'+id).html();
    var csrf = ($('#csrf').html());
    var newValue = "<form action='{{ url('comment/edit') }}/"+id+"/save' enctype='multipart/form-data' method='post'>"+csrf+"<input type='text' name='comment_body' value='"+value+"'><input type='submit' name='edit' value='Edit'></form>";
    $('#'+id).html(newValue);
  }





</script>
</input>

@endsection 
<!-- 
var newValue = "<form action='{{ url('comment/edit') }}/"+id+"/save' enctype='multipart/form-data' method='post'>"+csrf+"<input type='text' name='comment_body' value='"+value+"'><input type='submit' name='edit' value='Edit'></form>";
    $('#'+id).html(newValue); -->