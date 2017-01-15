@extends('sns_final/template_dashboard')





@section('header')

@endsection

@section('sidebarright_section')
<?php $mightKnow[]=$currentuser->id; ?>

<div class='sidebar_right'>
 <div class='row'>
   <div class='col-md-12 col-sm-12 col-xs-12'>
     <div style="padding-left:5%;padding-right:5%">

       <div class='row'>


         <div class='col-md-12 col-xs-12 col-sm-12'><h2><span class="glyphicon glyphicon-plus" style='color:#00ccff'></span> Suggested People<h2></div>
         @foreach($users->random(5) as $user)

         <div class='col-md-12 col-xs-12 col-sm-12'>

          @if(!in_array($user->id,$mightKnow))

          @if((count($user->userinfo) == 0) || ($user->userinfo->last()->avatar == ''))

          <img src='{{ asset("images/userpic/noavatar.png")}}' class='image-avatar-s'">
          <a href='{{ url("user/$user->id") }}'>  {{ $user->name }}</a>
          @else


          <img src='{{ asset("images/userpic/".$user->userinfo->last()->avatar)}}' class='image-avatar-s'">
          <a href='{{ url("user/$user->id") }}'>{{ $user->name }}</a>

          @endif


          <a href='{{ url("/addfriend/$user->id")}} pull-right' ><button type="submit" class="btn btn-primary commentbutton pull-right"><span class='glyphicon glyphicon-plus'></span></button></a>
          @endif
        </div>       <!--   <a href='{{ url("user/$user->id") }}'>  {{ $user->name}}</a><br> -->


        @endforeach


      </div>


    </div>
  </div>
</div>

</div>

<br>

<div class='sidebar_right'>
 <div class='row'>
   <div class='col-md-12 col-sm-12 col-xs-12'>

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
<Br>

<div style='color:gray'>
  Privacy · Terms · Advertising · Ad Choices · Cookies · 
  More
  Facebook © 2017

</div>



@endsection


@section('sidebarleft_section')

<!-- FRIENDS -->
@if($friendCount != 0)
<div class='sidebar_right'>
 <div class='row'>
   <div class='col-md-12'>

     <div style="padding-left:5%">
      <a href='{{url("user/$user_info->id/friends")}}'><h2><span class='glyphicon glyphicon-user' style='color:#0066ff;'></span> Friends of {{$user_info->name}}({{ $friendCount }})</h2></a>
    </div>

    @foreach($myfriends->take($take) as $friends)

    <div class='col-md-4' style=''>

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

<br>
  @if(!($nineposts->isEmpty()))
 <div class='well row  text-center' style='padding:0px; margin-left:auto;margin-right:auto;'>

  <div class='col-md-12' >

    <div class='row ' style='height: 50px;'><span style='font-size: 20px;  '>
      <span class="glyphicon glyphicon-picture " style='font-size: 25px; color:#a5d950;'></span>
      Gallery
    </div>
  </div>

  @foreach($nineposts as $gallery)


  @if(!is_null($gallery->img_src))
  <div class='col-md-4' style='margin:0px; padding: 0px; '> 
    <div class='row' style='margin-bottom: 1% ;'> 
     <img src='{{ asset("images/userpost/$gallery->img_src")}}' class="image-avatar-l img-responsive" style=" max-width: 100%; max-height: 100%;   margin-left: auto; margin-right: auto;">

   </div>
 </div>
 @endif

 @endforeach

</div>
 @endif

@endsection 





@section('content_section')


<div class='well outerbox2'>
  <div class='row commentsection' style='background-color: white;'>

    <div class="row">
      <div class="col-md-2 col-md-offset-5" >

        <?php $myavatar = 'noavatar.png'?>



        @if($user_info->userinfoExist())

        <?php $myavatar = $user_info->userinfo->last()-> avatar; ?>   
        @endif

        <img src='{{ asset("images/userpic/$myavatar")}}' class='img-responsive thumbnail' style="height:100px; width: 100px;">
      </div>

      <div class="row">


        <div class="col-md-12 col-sm-12 col-xs-12 text-center">

          @if($user_info->userinfoExist())



          "{{($user_info->userinfo->last()-> description) }}"

          <h2>{{($user_info->userinfo->last()-> fname) }} {{($user_info->userinfo->last()-> lname) }}</h2><br>
          <span class="glyphicon glyphicon-envelope"></span> {{ $user_info->email }}<br>

          <span class="glyphicon glyphicon-gift"></span> {{($user_info->userinfo->last()-> birthday) }}<bR>





          @else

          <h2> {{ $user_info->name }}</h2><br>
          <span class="glyphicon glyphicon-envelope" style='color: #66ccff;'></span> {{ $user_info->email }}<br>



          @endif
          <h5>Posts ({{ count($user_post) }}) | 

          </div>
        </div>

        <div class='pull-right'>

          @if($thisuserSentRequest != 0 )
          <a href='{{ url("/accept/$user_info->id")}}'><button type="submit" class="btn btn-primary commentbutton"><span class='glyphicon glyphicon-plus'></span>Accept Request</button></a>


          @elseif($meSentRequest != 0 )


          <a href='{{ url("/addfriend/$user_info->id")}}'></a>
          <a href='{{ url("/cancelRequest/$user_info->id")}}'><button type="submit" class="btn btn-primary commentbutton"><span class='glyphicon glyphicon-plus'></span>Cancel Request</button></a>



          @elseif($iFfriend == 0)


          <a href='{{ url("/addfriend/$user_info->id")}}'><button type="submit" class="btn btn-primary commentbutton"><span class='glyphicon glyphicon-plus'></span>Add</button></a>

          @else

          <!-- <a href='{{ url("/unfriend/$user_info->id")}}'>unfriend</a> -->
          <a href='{{ url("/unfriend/$user_info->id")}}'><button type="submit" class="btn btn-primary commentbutton" style='background-color:rgba(0, 0, 0, 0.6)'><span class='glyphicon glyphicon-remove' style:'color:red;'></span>Unfriend</button></a>
          @endif
        </div>





      </div>

    </div>

    <!-- ----------------- -->
  </div>

<!-- 
<Br>
	{{ $user_info -> name }}
	<Br>
   {{ $user_info -> email }}

   @if($user_info->userinfoExist())

   {{($user_info->userinfo->last()-> birthday) }}<bR>
   {{($user_info->userinfo->last()-> fname) }}<br>
   {{($user_info->userinfo->last()-> description) }}
   @endif
 -->





 <!-- <h2>SAY SOMEthiNG</h2> -->
<!-- 
  <form action= '' method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
            <br>say something<br>

            <input type="file" name="image"></input>

            <textarea name='post_body'></textarea>
            <input type="submit" value="Submit">
          </form>  -->




          <!-- <h1>posts</h1> -->



          @foreach($user_post as $post)
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
        <img src='{{ asset("images/userpic/$avatar")}}' class='image-avatar-m'>
        <a href='{{ url("user/".$post->user_id)}}'><strong>{{ $post->user->name}}</strong></a>


  <?php  $time = \Carbon\Carbon::createFromTimeStamp(strtotime($post->created_at))->diffForHumans() ?>
        
         <span><a href='{{url("post/$post->id")}}'style='color:gray;'><span class="glyphicon glyphicon-time"></span> {{ $time }}</a></span>



        @if($post->user->id == $currentuser->id)
        <!-- if post is made by the current user -->

        <span class="glyphicon glyphicon-remove-sign pull-right" id="delete_{{$post->id}}" onclick='deletePost({{$post->id}})' style='font-size: 150%; color: #E9EBEE; margin-left: 1%;'></span>

        <span class="glyphicon glyphicon-cog pull-right" style='font-size: 150%; color: #E9EBEE' onclick='editPost({{$post->id}})' id="edit_{{$post->id}}"></span>
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
<!-- 
      @if( $post->islike() == 0 )
   
      <span id='color{{$post->id}}' class="btn btn-default btn-sm" onclick="like({{$post->id}})">
        <span class="glyphicon glyphicon-thumbs-up"></span><span id='{{$post->id}}'> Like</span>
        <span class="label label-default">{{ $post->like()}}</span> </span>


        @else
    

        <span id='color{{$post->id}}' class="btn btn-default btn-sm" onclick="like({{$post->id}})" style='color:#365899'>
          <span class="glyphicon glyphicon-thumbs-up"></span> <u><strong><span id='{{$post->id}}'> Unlike</span></strong></u>
          <span class="badge" style='background-color:#365899'>{{ $post->like()}}</span></span>

          @endif -->



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


              <!-- modal for editing post -->

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

              <!-- end of edit modal -->





            </div>

            <div class='row commentsection'>
              <div class='col-md-offset-1'>
                <span class="glyphicon glyphicon-comment" style='color:#0066ff;'> {{($post->countComment() ) }}</span></span>


                @if($post->like() != 0)
                |  <span style='color:#DFE0E2;'>| <span id="countLike{{$post->id}}" class="glyphicon glyphicon-thumbs-up" style='color:#0066ff;'>
                <span id="COUNT{{$post->id}}" color:#0066ff;> {{ $post->like() }}</span></span></span>
                @else
                 <span id="countLike{{$post->id}}" class="glyphicon glyphicon-thumbs-up" style="display:none ;color:#0066ff;">
                  <span id="COUNT{{$post->id}}"></span></span>
                  @endif




                  @foreach($post->comments()->orderBy('created_at','desc')->take(3)->get()->reverse() as $comment)
                  <div class='col-md-12' style="margin-bottom: 1%;">


                    <div class='col-md-1'>
                     <?php $commentAvatar = $comment->userinfo()->orderBy('created_at','desc')->first() ; ?>

                     @if(!is_null($commentAvatar))
                     <img src='{{ url("images/userpic/$commentAvatar->avatar")}}' class='image-avatar-s'>      
                     @else
                     <img src='{{ url("images/userpic/noavatar.png")}}' class='image-avatar-s'>  
                     @endif
                   </div>

                   <div style='padding-left: 11%;'>
                     <a href='{{ url("/user/$comment->user_id")}}' style='color:#3B5998'><big>{{$comment->user->name}}</big></a> {{$comment->comment_body}}
                     <div >


                      <!-- <?php echo \Carbon\Carbon::createFromTimeStamp(strtotime($comment->created_at))->diffForHumans() ?> -->


                      
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


              <div class='col-md-offset-1'>
                <form action= '{{ url("/post/comment/$post->id") }}'  method="POST" enctype="multipart/form-data">
                 {{ csrf_field() }}


                 <div class='col-md-8'>




                  <div class='row'>
                    <div class='col-md-2'>
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
                     <button type="submit" class="btn btn-primary commentbutton"><span class="glyphicon glyphicon-ok-circle"></span> Comment</button>
                   </div>
                 </div>





               </form>

             </div>

           </div>

         </div>

       </div>
     </form>
     <!-- --- post end -->




     <div id='csrf'>{{csrf_field()}} </div>


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

    // alert(value);
  }





</script>
@endsection