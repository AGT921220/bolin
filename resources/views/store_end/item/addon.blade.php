<div class="modal fade text-left" id="addon{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
<div class="modal-content">
<div class="modal-header bg-primary">
<h4 class="modal-title" id="myModalLabel33">@lang('app.assign_addon')</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<form action="{{ Asset(env('store').'/addAddon') }}" method="post" enctype="multipart/form-data">
<div class="modal-body">

{{ csrf_field() }}

<input type="hidden" name="id" value="{{ $row->id }}">

@foreach($addon as $a)


<div class="row">
<div class="col-xl-12"><h3>{{ $a['name'] }}</h3></div>

@foreach($a['item'] as $i)

<div class="col-xl-3" style="margin-top: 10px;margin-bottom: 10px"><input type="checkbox" name="chk[]" value="{{ $i->id }}" @if(in_array($i->id,$assign->getAssigned($row->id))) checked @endif> {{ $i->name }}</div>

@endforeach
</div>
@endforeach

</div>
<div class="modal-footer">
<button type="submit" class="btn btn-primary">@lang('app.save')</button>
</div>
</form>
</div>
</div>
</div>
