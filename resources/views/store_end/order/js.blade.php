<script type="text/javascript">

function removeItem(id)
{
	$(id).remove();

	return calTotal();
}

function addItem(item,price,unit,addon = [])
{
  var array = [];

  array.push({id : item.id,price : price,unit : unit,addon : addon});

  if(localStorage.getItem('item_data'))
  {
  	var allData = JSON.parse(localStorage.getItem('item_data'));

  	for(var i =0;i<allData.length;i++)
  	{
  		array.push(allData[i]);
  	}
  }

  localStorage.setItem('item_data', JSON.stringify(array));

  var node = document.createElement("div");

  if(unit == 0)
  {
  	var itemName = item.name;
  }
  else if(unit == 1)
  {
  	var itemName = item.name+" ("+item.unit1+")";
  }
  else if(unit == 2)
  {
  	var itemName = item.name+" ("+item.unit2+")";
  }
  else if(unit == 3)
  {
  	var itemName = item.name+" ("+item.unit3+")";
  }

  node.innerHTML = "<input type='hidden' name='item_id[]' value='"+item.id+"'><input type='hidden' name='qty_type[]' value='"+unit+"'><div class='row cartClass' id='cart_"+item.id+"'><div class='col-md-6'>"+itemName+"</div><div class='col-md-2'><input type='text' name='qty[]' value='1' class='cartInput' onKeyup='calTotal()'></div><div class='col-md-2'><input type='text' name='price[]' value='"+price+"' class='cartInput' onKeyup='calTotal()'></div><div class='col-md-2'><a href='javascript::void()' onClick='removeItem(cart_"+item.id+")' class='cartRemove'><i class='fa fa-times'></i></a></div></div>";

  document.getElementById("myList").appendChild(node);

  if(addon.length > 0)
  {
    for(var i = 0;i<addon.length;i++)
    {
      var node = document.createElement("div");
       
       var addonData = addon[i].split(",");

        node.innerHTML = "<input type='hidden' name='addon_id_"+item.id+"[]' value='"+addonData[0]+"'><div class='row cartClass' id='cart_"+addonData[0]+"'><div class='col-md-6'>--"+addonData[1]+"</div><div class='col-md-2'><input type='text' name='qty[]' value='1' class='cartInput' onKeyup='calTotal()'></div><div class='col-md-2'><input type='text' name='price[]' value='"+addonData[2]+"' class='cartInput' onKeyup='calTotal()'></div><div class='col-md-2'><a href='javascript::void()' onClick='removeItem(cart_"+addonData[0]+")' class='cartRemove'><i class='fa fa-times'></i></a></div></div>";

        document.getElementById("myList").appendChild(node);
    }
  }

  calTotal();

}

function calTotal()
{
	let qty   = document.getElementsByName('qty[]');
	let price = document.getElementsByName('price[]');
	let array = [];
	let sum   = 0;

	for(var i =0;i<qty.length;i++)
	{
		array.push(qty[i].value * price[i].value);
	}

	for (let i = 0; i < array.length; i++) 
	{
      sum += array[i];
	}

    document.getElementById("total").innerHTML = "{{ $c }}"+sum;


  let total       = sum;
	let d_charges   = document.getElementById('d_charges');
	let discount    = document.getElementById('discount');

	if(discount.value)
	{
		total = total - discount.value
	}

	if(d_charges.value)
	{
		total = (d_charges.value*1)+(total*1);
	}

    document.getElementById("grand").innerHTML = "{{ $c }}"+total;
    document.getElementById("total_amount").value = total;

}

function showField(id)
{
   var address   = document.getElementById("address");  
   var delivery  = document.getElementById("delivery");  
  
  if(id == 1)
  {
    address.removeAttribute("style");
    delivery.removeAttribute("style");
  }
  else
  {
    var att   = document.createAttribute("style");
    att.value   = "display:none;margin-top:10px";
    address.setAttributeNode(att);

    var att2   = document.createAttribute("style");
    att2.value   = "display:none;margin-top:10px";
    delivery.setAttributeNode(att);
  }
}


function addonData(item,id)
{
  let option      = document.getElementsByName('option_'+id);
  let addon       = document.getElementsByClassName('addon_'+id);
  let addonValue  = [];
  let optionValue = 0;

  //capture option data

  for(var i =0;i<option.length;i++)
  {
    if(option[i].checked == true)
    {
      optionValue = option[i].value;
    }
  }

  //capture addon data
  for(var i =0;i<addon.length;i++)
  {
    if(addon[i].checked == true)
    {
      addonValue.push(addon[i].value);
    }
  }

  if(optionValue == 1)
  {
    var price = item.s_price;
  }
  else if(optionValue == 2)
  {
    var price = item.m_price;
  }
  else if(optionValue == 3)
  {
    var price = item.l_price;
  }

  return addItem(item,price,optionValue,addonValue);
}

</script>

<style type="text/css">
.cartClass
{
	padding:10px 10px;
}

.cartInput
{
	width: 50px;
	padding: 5px 5px
}

.cartRemove
{
	color:red;
	font-size: 16px;
	margin-top: 10px;
	margin-left: 10px
}

</style>