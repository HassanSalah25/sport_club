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
<h2> ايصالات التوريد </h2>
@endif
<table class="table  table-bordered">
    <thead>
    <tr>
        <th class="border-top-0">  اسم المستلم</th>
        <th class="border-top-0"> من </th>
        <th class="border-top-0"> الي </th>

        <th class="border-top-0">   كلي\جزئي</th>
        <th class="border-top-0">   المدفوع</th>
        <th class="border-top-0">   المتبقي</th>
        <th class="border-top-0">   المبلغ</th>
        <th class="border-top-0">   تاريخ الايصال</th>


    </tr>
    </thead>
    <tbody>
    @foreach($allData as $receipt)

        <tr class="row1" data-id="{{ $receipt->id }}" >
            <td>{{$receipt->user->name}}</td>

            @php
                $id =  $receipt->from;
                $name ='';
                if($receipt->type_of_from=='players'){
                   $player = \App\models\Players::find($id);
                   $name = $player->name;
                }
                if($receipt->type_of_from=='others'){
                  $receiptType = \App\Models\ReceiptTypes::find($id);
                   $name = $receiptType->name;

                }

                $remain = 0;
                if($receipt->type_of_amount == 'part'){
                  $remain =  $receipt->amount - $receipt->paid;
                }
            @endphp
            <td>{{$name}}</td>
            <td>{{$receipt->receiptType->name}}</td>

            <td>{{ $receipt->type_of_amount == '' ? 'كلي ' : 'جزئي' }}</td>

            <td>{{ $receipt->paid ?? $receipt->amount }}</td>


            <td>
                {{ $remain }}
            </td>
            <td>
                {{ $receipt->amount }}
            </td>
            <td>
                {{ $receipt->date_receipt }}
            </td>

        </tr>
    @endforeach

    </tbody>
</table>


