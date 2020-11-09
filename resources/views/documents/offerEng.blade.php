@extends('layouts.doc')

@section('content')
    <div style="padding: 1.5rem 2rem 1rem 2rem">
        <br>
        <table style="width:100%">
            <tbody>
            @if($button)
                <a href="/offer/print/{{ $offer->id }}/Eng">
                    <button class="btn btn-secondary"><i class="fas fa-print"></i> Download</button>
                </a>
            @endif
            <tr>
                <td class="paragraph">
                    <img style="width: 200px; text-align: center" src="{{ asset('storage/' . $settings->file_uri) }}">
                </td>
                <td class="paragraph">
                    <strong><h2 style="width: 100%; text-align: right">COMMERCIAL OFFER</h2></strong>
                    <strong><h2 style="width: 100%; text-align: right"></h2></strong>
                    <p style="width: 100%; text-align: right">
                        {{ $settings->name }}<br>
                        {{ $settings->code }}<br>
                        {{ $settings->vat_code }}<br>
                        {{ $settings->address }}<br>
                        {{ $settings->account }}<br>
                    </p>
                </td>
            </tr>

            </tbody>
        </table>

        <table style="width:100%">
            <tbody>
            <tr>
                <td class="paragraph">
                    <h3 style="width: 100%; text-align: left">BILL TO</h3>
                    <p>
                        @if($offer->company)
                            {!! !empty($offer->company->name) ? $offer->company->name . "<br>" : '' !!}
                            {!! !empty($offer->company->phone) ? $offer->company->phone . "<br>" : '' !!}
                            {!! !empty($offer->company->code) ? $offer->company->code . "<br>" : '' !!}
                            {!! !empty($offer->company->vat_code) ? $offer->company->vat_code . "<br>" : '' !!}
                            @if(!empty($offer->company->address))
                                @foreach(explode(',', $offer->company->address) as $line)
                                    {!! trim($line) . "<br>" !!}
                                @endforeach
                            @endif
                        @endif
                    </p>
                </td>
                <td class="paragraph">
                    <h4 style="width: 100%; text-align: center">
                        <div style="width: 45%; display: inline-block; text-align: right;">Offer number:</div>
                        <div
                            style="width: 45%; display: inline-block; text-align: left">{{ $offer->number . '-' . $offer->version }}</div>
                    </h4>

                    <h4 style="width: 100%; text-align: center">
                        <div style="width: 45%; display: inline-block; text-align: right;">Offer date:</div>
                        <div
                            style="width: 45%; display: inline-block; text-align: left">{{ substr($offer->created_at, 0, 10) }}</div>
                    </h4>

                </td>
            </tr>
            </tbody>
        </table>
        <br>
        <table style="width:100%" id="items">
            <thead style="background-color:#c29116">
            <tr>
                <th class="paragraph" scope="col">Items</th>
                <th class="paragraph" scope="col">Quantity</th>
                <th class="paragraph" scope="col">Price</th>
                <th class="paragraph" scope="col">Amount</th>
            </tr>
            </thead>
            <tbody>

            @foreach($positions as $item)
                <tr class="border-bottom">
                    <td class="paragraph" style="width: 40%">{{ $item->title }}</td>
                    <td class="paragraph" style="text-align: right">{{ $item->quantity }}</td>
                    <td class="paragraph" style="text-align: right">{{ $item->final_price }}</td>
                    <td class="paragraph"
                        style="text-align: right">{!! fixEuro(numfmt_format_currency($fmt, $item->total, $settings->currency->code)) !!} </td>
                </tr>
            @endforeach

            </tbody>
        </table>
        <br>
        <table style="width:100%">
            <tbody style="border: none;">
            <tr>
                <td class="paragraph" style="text-align: right">
                    Subtotal: {!! fixEuro(numfmt_format_currency($fmt, $offer->total, $settings->currency->code)) !!}
                </td>
            </tr>
            <tr>
                <td class="paragraph" style="text-align: right">
                    VAT 20%:
                    {!! fixEuro(numfmt_format_currency($fmt, $offer->total_with_vat - $offer->total, $settings->currency->code)) !!}
                </td>
            </tr>
            <tr>
                <td class="paragraph" style="text-align: right">
                    <strong>
                        Total: {!! fixEuro(numfmt_format_currency($fmt, $offer->total_with_vat, $settings->currency->code)) !!} </strong>
                </td>
            </tr>
            </tbody>
        </table>

        @if(!empty($offer->info))
            <h4>Notes / Terms</h4>
            {!! $offer->info !!}
        @endif
        <br>
        <br>
        <h3 style="width: 100%; text-align: center;">THANK YOU FOR YOUR BUSINESS. IT IS OUR PLEASURE TO WORK WITH
            YOU.</h3>
    </div>
@endsection
