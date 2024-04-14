<div class="row">
<div class="col-lg-6">
<div class="card" style="padding: 20px 20px">

<div class="row" style="border-bottom: 1px solid #ededed;padding: 10px 10px">

<div class="col-lg-8"><h4>@lang('app.overall_order')</h4></div>
<div class="col-lg-4"><a class="btn btn-primary" href="{{ Asset('report') }}" style="margin-top: -8%">@lang('app.get_report')</a></div>
</div>

<div class="row" style="border-bottom: 1px solid #ededed;padding: 10px 10px">

<div class="col-lg-8"><b>@lang('app.total_order')</b></div>
<div class="col-lg-4">{{ $data['order'] }}</div>

</div>

<div class="row" style="border-bottom: 1px solid #ededed;padding: 10px 10px">

<div class="col-lg-8"><b>@lang('app.completed_order')</b></div>
<div class="col-lg-4">{{ $data['complete'] }}</div>

</div>

<div class="row" style="border-bottom: 1px solid #ededed;padding: 10px 10px">

<div class="col-lg-8"><b>@lang('app.running_order')</b> </div>
<div class="col-lg-4">{{ $data['running'] }}</div>

</div>

<div class="row" style="border-bottom: 1px solid #ededed;padding: 10px 10px">

<div class="col-lg-8"><b>@lang('app.cancelled_orders')</b> </div>
<div class="col-lg-4">{{ $data['cancel'] }}</div>

</div>

<div class="row" style="padding: 10px 10px">

<div class="col-lg-12"></div>

</div>

<div class="row" style="padding: 10px 10px">

<div class="col-lg-12"></div>

</div>

<div class="row" style="padding: 10px 10px">

<div class="col-lg-12"></div>

</div>

</div>
</div>

<div class="col-lg-6">
<div class="card" style="padding: 20px 20px">

<div class="row" style="border-bottom: 1px solid #ededed;padding: 10px 10px">

<div class="col-lg-8"><h4>@lang('app.most_order')</h4></div>
<div class="col-lg-4"><a class="btn btn-primary" href="{{ Asset('report') }}" style="margin-top: -8%">@lang('app.get_report')</a></div>
</div>

<div class="row" style="border-bottom: 1px solid #ededed;padding: 10px 10px">

<div class="col-lg-8"><b>@lang('app.store')</b></div>
<div class="col-lg-4"><b>@lang('app.completed_orders')</b></div>
</div>

@foreach($schart as $s)

<div class="row" style="border-bottom: 1px solid #ededed;padding: 10px 10px">

<div class="col-lg-8">{{ $s['name'] }}</div>
<div class="col-lg-4">{{ $s['order'] }}</div>
</div>

@endforeach
</div>
</div>

</div>
