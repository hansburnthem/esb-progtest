<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
<body class="bg-gray-200 mt-10 mx-10">
    <form action="/invoices/{{$invoice->id}}" method="POST" class="w-full">
        @csrf
        @method("PUT")
        <label>Issue Date:</label><br>
        <input type="date" name="issuedate" value="{{$invoice->date}}"><br>
        <label>Due Date:</label><br>
        <input type="date" name="duedate" value="{{$invoice->duedate}}"><br>
        <label>Subject:</label><br>
        <input type="text" name="subject" class="w-1/2" value="{{$invoice->subject}}"><br>
        <label>From:</label><br>
        <select name="from">
            @foreach ($addresses as $address)
                <option value="{{$address->id}}" {{$invoice->fromAddress->id == $address->id ? 'selected' : ''}}>{{$address->company}} - {{$address->address}}</option>
            @endforeach
        </select><br>
        <label>For:</label><br>
        <select name="for" value="{{$invoice->forAddress->id}}">
            @foreach ($addresses as $address)
                <option value="{{$address->id}}" {{$invoice->forAddress->id == $address->id ? 'selected' : ''}}>{{$address->company}} - {{$address->address}}</option>
            @endforeach
        </select><br>
        
        <div x-data="{
            items: {{$invoice->items}}
        }" x-init="() => {
            
        }">
            <label>Item:</label><br>
            <select x-ref="item">
                @foreach ($items as $item)
                    <option value="{{$item->id}}#{{$item->item}}#{{$item->price}}">{{$item->item}} - {{$item->type}}</option>
                @endforeach
            </select>
            <input x-ref="qty" type="number" placeholder="qty">
            <a class="bg-gray-900 text-white rounded-md py-1 px-3 cursor-pointer" @click="items.push({id: $refs.item.value.split('#')[0], item: $refs.item.value.split('#')[1], price: $refs.item.value.split('#')[2], pivot: {qty: $refs.qty.value}});">Add</a>
            <a class="bg-red-500 text-white rounded-md py-1 px-3 cursor-pointer" @click="items=items.filter((val) => $refs.item.value.split('#')[0] != val.id)">Remove</a>

            <p>list items:</p>
            
            <table class="mt-5 w-9/12 text-center border-collapse border border-slate-500">
                <tr>
                  <th class="border border-slate-600">Item</th>
                  <th class="border border-slate-600">Qty</th> 
                  <th class="border border-slate-600">Unit Price</th> 
                  <th class="border border-slate-600">Amount</th> 
                </tr>
                <template x-for="item in items">
                    <tr>
                        <td class="border border-slate-600" x-text="item.item"></td>
                        <td class="border border-slate-600" x-text="item.pivot.qty"></td> 
                        <td class="border border-slate-600" x-text="item.price"></td> 
                        <td class="border border-slate-600" x-text="item.price * item.pivot.qty"></td> 
                    </tr>
                </template>
            </table>

            <p x-text="() => {
                let subTotal = 0;
                items.forEach((val) => {
                    subTotal += (val.price * val.pivot.qty)
                })
                return 'Subtotal '+subTotal;
            }"></p>
            <p x-text="() => {
                let subTotal = 0;
                items.forEach((val) => {
                    subTotal += (val.price * val.pivot.qty)
                })
                return 'Tax(10%) ' + (subTotal * 0.1);
            }"></p>
            <p x-text="() => {
                let subTotal = 0;
                items.forEach((val) => {
                    subTotal += (val.price * val.pivot.qty)
                })
                return 'Payments ' + ((subTotal * 0.1) + subTotal);
            }"></p>

            <input type="hidden" x-bind:value="() => {
                var itemsOut = [];
                items.forEach((item) => itemsOut.push(item.id))
                return itemsOut
            }" name="items">
            <input type="hidden" x-bind:value="() => {
                var qtysOut = [];
                items.forEach((item) => qtysOut.push(item.pivot.qty))
                return qtysOut
            }" name="qtys">
        </div>
        <button class="p-2 bg-gray-800 text-white mt-5 rounded-md">submit</button>
    </form>
</body>