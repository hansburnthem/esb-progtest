<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
<body class="bg-gray-200 mt-10 mx-10">
    <a href="invoices/create" class="p-2 bg-gray-800 text-white rounded-md">Create Invoice</a>

    <table class="mt-5 w-9/12 text-center border-collapse border border-slate-500">
        <tr>
          <th class="border border-slate-600">Date</th>
          <th class="border border-slate-600">DueDate</th> 
          <th class="border border-slate-600">Subject</th>
          <th class="border border-slate-600">From</th>
          <th class="border border-slate-600">For</th>
          <th class="border border-slate-600">Action</th>
        </tr>
        @foreach ($invoices as $invoice)
            <tr>
                <td class="border border-slate-600">{{$invoice->date}}</td>
                <td class="border border-slate-600">{{$invoice->duedate}}</td> 
                <td class="border border-slate-600">{{$invoice->subject}}</td>
                <td class="border border-slate-600">{{$invoice->fromAddress->company}}</td>
                <td class="border border-slate-600">{{$invoice->forAddress->company}}</td>
                <td class="border border-slate-600 py-5">
                    <a href="invoices/{{$invoice->id}}/edit" class="p-2 bg-gray-800 text-white rounded-md">edit</a>
                    <form action="invoices/{{$invoice->id}}" method="POST" class="mt-2">
                        @csrf
                        @method("DELETE")
                        <button class="p-2 bg-red-500 text-white rounded-md">delete</a>
                    </form>
                </td>
            </tr>
        @endforeach
        
        
      </table>
</body>
</html>