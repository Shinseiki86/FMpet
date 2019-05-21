<div id="carousel-{{$name}}" class="carousel slide" data-ride="carousel">
  <!-- Indicators -->
  <ol class="carousel-indicators">
    @foreach($images as $key=>$img)
    <li data-target="#carousel-{{$name}}" data-slide-to="{{$key}}" class="{{$loop->first ?'active' : ''}}"></li>
    @endforeach
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner" role="listbox">

    @foreach($images as $key=>$img)
    <div class="item {{$loop->first ? 'active':''}} ">
      <img src="{{$img}}" alt="" style=" margin: 0 auto;{{isset($maxHeight) ? 'max-height:'.$maxHeight : ''}}">
      <div class="carousel-caption">
        {{-- label --}}
      </div>
    </div>
    @endforeach
  </div>

  <!-- Controls -->
  <a class="left carousel-control" href="#carousel-{{$name}}" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Ant</span>
  </a>
  <a class="right carousel-control" href="#carousel-{{$name}}" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Sig</span>
  </a>
</div>