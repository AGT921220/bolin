@extends('layout.main')

@section('title') @lang('app.push') @endsection

@section('content')

<section id="basic-input">
<div class="row">
<div class="col-md-12">
<div class="card">
<div class="card-header">
<h4 class="card-title">@lang('app.push')</h4>
</div>

{!! Form::open(['url' => [Asset('send')],'files' => true,'method' => 'POST']) !!}

<div class="card-content">
<div class="card-body">

<div class="form-row">
<div class="form-group col-md-12">
<label for="inputEmail6">@lang('app.p_title')</label>
{!! Form::text('title',null,['id' => 'code','class' => 'form-control','required'])!!}
</div>

<div class="form-group col-md-12">
<label for="inputEmail6">@lang('app.p_desc')</label>
<textarea name="text" class="form-control" required="required"></textarea>
</div>
</div>


<button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light">@lang('app.send')</button>


</div>
</div>

</form>
</div>
</div>
</div>
</section>

@endsection