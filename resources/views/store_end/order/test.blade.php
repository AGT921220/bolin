@include('store_end.layout.pos_header')

<section id="basic-input" style="padding: 10px 10px">
<div class="row">
<div class="col-md-12">

{!! Form::open(['url' => [Asset(env('store').'/order/add')],'method' => 'POST']) !!}

@include('store_end.order.form')

</form>
</div>
</div>
</section>

@include('store_end.layout.pos_footer')