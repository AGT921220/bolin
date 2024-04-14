@include('store_end.layout.pos_header')

@if(Session::has('message'))
<div class="alert alert-success mt-1 alert-validation-msg" role="alert">
<i class="feather icon-check-circle mr-1 align-middle"></i>
<span>{{ Session::get('message') }}</span>
</div>
@endif

<section id="basic-input" style="padding: 10px 10px">
<div class="row">
<div class="col-md-12">

{!! Form::open(['url' => [Asset(env('store').'/orderEdit?lid=0&id='.$_GET['id'])],'method' => 'POST']) !!}

@include('store_end.order.form')

</form>
</div>
</div>
</section>

@include('store_end.layout.pos_footer')