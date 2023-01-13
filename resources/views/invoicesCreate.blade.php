<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>
        <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
<body class="bg-gray-200 mt-10 mx-10">
    <form action="/invoices" class="w-full" method="POST">
        @csrf
        <label>Issue Date:</label><br>
        <input type="date" name="issuedate"><br>
        <label>Due Date:</label><br>
        <input type="date" name="duedate"><br>
        <label>Subject:</label><br>
        <input type="text" name="subject" class="w-1/2"><br>
        <label>From:</label><br>
        <select name="from">
            @foreach ($addresses as $address)
                <option value="{{$address->id}}">{{$address->company}} - {{$address->address}}</option>
            @endforeach
        </select><br>
        <label>For:</label><br>
        <select name="for">
            @foreach ($addresses as $address)
                <option value="{{$address->id}}">{{$address->company}} - {{$address->address}}</option>
            @endforeach
        </select><br>
        
        <div x-data="{
            items: []
        }">
            <label>Item:</label><br>
            <select x-ref="item">
                @foreach ($items as $item)
                    <option value="{{$item->id}}#{{$item->item}}">{{$item->item}} - {{$item->type}}</option>
                @endforeach
            </select>
            <input x-ref="qty" type="number" placeholder="qty">
            <a class="bg-gray-900 text-white rounded-md py-1 px-3 cursor-pointer" @click="items.push({id: $refs.item.value, qty: $refs.qty.value});">Add</a>
            <a class="bg-red-500 text-white rounded-md py-1 px-3 cursor-pointer" @click="items=items.filter((val) => $refs.item.value != val.id)">Remove</a>

            <p>list items:</p>
            
            <table class="mt-5 w-9/12 text-center border-collapse border border-slate-500">
                <tr>
                  <th class="border border-slate-600">Item</th>
                  <th class="border border-slate-600">Qty</th> 
                </tr>
                <template x-for="item in items">
                    <tr>
                        <td class="border border-slate-600" x-text="item.id.split('#')[1]"></td>
                        <td class="border border-slate-600" x-text="item.qty"></td> 
                    </tr>
                </template>
            </table>

            <input type="hidden" x-bind:value="() => {
                var itemsOut = [];
                items.forEach((val) => itemsOut.push(val.id.split('#')[0]))
                return itemsOut
            }" name="items">
            <input type="hidden" x-bind:value="() => {
                var qtysOut = [];
                items.forEach((val) => qtysOut.push(val.qty))
                return qtysOut
            }" name="qtys">
        </div>
        <button class="p-2 bg-gray-800 text-white mt-5 rounded-md">submit</button>
    </form>
</body>
</html>