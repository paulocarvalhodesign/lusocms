{{ Area::open_wrapper($area, $handle, $id, $global) }}

<div id="navigation-{{$block->id}}" class="navigation">


{{  $menu  }}

</div>




<div class="mobile_navigation">

	
<form action="#" method="post" enctype="multipart/form-data">

  <select id="goto">
  	@foreach($pages as $page)
  	@if($active == $page->url || $page->parent_id == Config::get('page_id'))
    <option selected="selected" value="{{  url($page->route) }}">{{ $page->title }}</option>
    @elseif($active =='' && $active == 'home')
    <option selected="selected" value="{{  url($page->route) }}">{{ $page->title }}</option>
    @else
     <option value="{{  url($page->route) }}">{{ $page->title }}</option>
    @endif
    @endforeach 
  </select>

</form>

</div>




<script>
$(document).ready(function() {

  $(function(){

    var url = window.location.pathname, 
        urlRegExp = new RegExp(url.replace(/\/$/,'') + "$");
        if(window.location == '{{URL::base()}}')
        {
        $('#navigation-{{$block->id}} li a')
            .first().addClass('selected'); 
        $('#navigation-{{$block->id}} li a')
        .first().parent().attr('class', 'selected-path');  
        }
       else{
        $('#navigation-{{$block->id}} a').each(function(){
          
            if(urlRegExp.test(this.href)){
                $(this).addClass('selected');
                $(this).parent().attr('class', 'selected-path');
            }
        });
      }

});

  $("ul").each(
  function() {
    var elem = $(this);
    if (elem.children().length == 0) {
      elem.remove();
    }
  }
);



  $("#goto").change(function(){
    if ($(this).val()!='') {
      window.location.href=$(this).val();
    }
  });
});

</script>


{{ Area::close_wrapper($handle, $id, $global) }}