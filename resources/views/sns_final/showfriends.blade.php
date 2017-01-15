@extends('sns_final/template_dashboard')


@section('content_section')

@if($friendCount != 0)
<div class='sidebar_right'>
 <div class='row'>
   <div class='col-md-12 col-sm-12 col-xs-12'>

   @if($currentuser->id == $thisuser->id)
   <?php $friends = 'Your Friends'; ?>
   @else
    <?php $friends = 'Friends of '.$thisuser->name; ?>
   @endif

     <div style="padding-left:5%">
      <a href=""><h2><span class='glyphicon glyphicon-user' style='color:#0066ff;'></span> {{$friends}}({{ $friendCount }})</h2></a>
    </div>

    @foreach($myfriends as $friends)

    <div class='col-md-4 col-sm-4 col-xs-12' style=''>

      <div class='col-center-block text-center' style="background-color: white ;border: 1px solid black; ">
       @if( $friends->userinfo->isEmpty() || $friends->userinfo->last()->avatar=='')
       <!-- no avatar or blank -->
       <img src='{{ asset("images/userpic/noavatar.png")}}' class='image-avatar-l'>
       @else

       <img src='{{ asset("images/userpic/".$friends->userinfo->last()->avatar)}}' class='image-avatar-l'>

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

@endsection

@section('sidebarright_section')
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
@endsection