<head>
    <style>
        table {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        table td,table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        table tr:nth-child(even){background-color: #f2f2f2;}

        table tr:hover {background-color: #ddd;}

        table th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #04AA6D;
            color: white;
        }
    </style>
</head>
@if(request('pdf'))
<h2> ايصالات الصرف </h2>
@endif
<table class="table  table-bordered">
    <thead>
    <tr>
        <th class="border-top-0">   القائم  بالصرف</th>
        <th class="border-top-0"> من </th>
        <th class="border-top-0"> الي </th>

        <th class="border-top-0">   المبلغ</th>
        <th class="border-top-0">   تاريخ الايصال</th>
        <th class="border-top-0">   تاريخ الانشاء</th>
        <th class="border-top-0">   تاريخ التعديل</th>
    </tr>
    </thead>
    <tbody>
    @foreach($allData as $receipt)

        <tr class="row1" data-id="{{ $receipt->id }}" >
            <td>{{$receipt->user->name}}</td>
            <td>{{$receipt->receiptType->name}}</td>

            @php
                $id =  $receipt->to;
                $name ='';
                if($receipt->type_of_to=='players'){
                   $player = \App\models\Players::find($id);
                   $name = $player->name;
                }
                if($receipt->type_of_to=='others'){
                  $receiptType = \App\Models\ReceiptTypePay::find($id);
                   $name = $receiptType->name;

                }

            @endphp
            <td>{{$name}}</td>

            <td>
                {{ $receipt->amount }}
            </td>
            <td>
                {{ $receipt->date_receipt->format('Y-m-d') }}
            </td>
            <td>
                {{ $receipt->created_at->format('Y-m-d') }}
            </td>
            <td>
                {{ $receipt->updated_at->format('Y-m-d') }}
            </td>

        </tr>
    @endforeach

    </tbody>
</table>


