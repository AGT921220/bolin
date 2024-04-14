<ul class="nav nav-tabs" role="tablist">
<li class="nav-item">
<a class="nav-link active" id="tab_0" data-toggle="tab" href="#tabs_0" aria-controls="home" role="tab" aria-selected="true"><img src="{{ Asset('upload/language/en.png') }}" style="width: 25px"> English</a>
</li>

@foreach(DB::table('language')->where('status',0)->orderBy('sort_no','ASC')->get() as $l)
<li class="nav-item">
<a class="nav-link" id="tab_{{ $l->id }}" data-toggle="tab" href="#tabs_{{ $l->id }}" aria-controls="home" role="tab" aria-selected="true"><img src="{{ Asset('upload/language/'.$l->icon) }}" style="width: 25px"> {{ $l->name }}</a>
</li>
@endforeach
</ul>
<br>