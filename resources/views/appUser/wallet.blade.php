<div class="modal fade text-left" id="wallet{{ $row->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
<div class="modal-content">
<div class="modal-header bg-primary">
<h4 class="modal-title" id="myModalLabel33">Update Wallet Balance</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<form action="{{ Asset('updateWallet') }}" method="post" enctype="multipart/form-data">
<div class="modal-body">

{{ csrf_field() }}

<input type="hidden" name="id" value="{{ $row->id }}">

<div class="row">
<div class="form-group col-md-8">
<label for="inputEmail6">Current Wallet Balance</label>
<input type="number" name="wallet" class="form-control" value="{{ $row->wallet }}">
</div>

<div class="form-group col-md-4">
<label for="inputEmail6">&nbsp;</label>
<button type="submit" class="btn btn-primary" style="margin-top: 20px">@lang('app.save')</button>
</div>

</div>
<div class="modal-footer">
</div>
</form>
</div>
</div>
</div>
