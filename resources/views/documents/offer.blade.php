@extends('layouts.doc')

@section('content')
    <div style="padding: 1.5rem 2rem 1rem 2rem">
        <h2 style="width: 100%; text-align: center">KOMERCINIS PASIŪLYMAS</h2>
        <h3 style="width: 100%; text-align: center">Nr. KM{{ date('Ymd-'). $offer->id . '-' . $offer->version }}</h3>
        <br>
        <table style="width:100%">
            <tbody>
            <tr>
                <td class="paragraph">
                    <strong>Pardavejas: </strong>
                </td>
                <td class="paragraph">
                    <strong>Pirkejas: </strong>
                </td>
            </tr>
            <tr>
                <td class="paragraph">
                    {{ $settings->name }}
                </td>
                <td class="paragraph">
                    @if($offer->private === 1)
                        {{ $offer->client ? $offer->client->name : '' }}
                    @else
                        {{ $offer->company ? $offer->company->name : '' }}
                    @endif
                </td>
            </tr>
            <tr>
                <td class="paragraph">
                    Įm. kodas: {{ $settings->code }}
                </td>
                <td class="paragraph">
                    Įm. kodas: {{ $offer->company ? $offer->company->code : '' }}
                </td>
            </tr>
            <tr>
                <td class="paragraph">
                    PVM mok. kodas: {{ $settings->vat_code }}
                </td>
                <td class="paragraph">
                    PVM mok. kodas: {{ $offer->company ? $offer->company->vat_code : '' }}
                </td>
            </tr>
            <tr>
                <td class="paragraph">
                    Adresas: {{ $settings->address }}
                </td>
                <td class="paragraph">
                    Adresas: {{ $offer->company ? $offer->company->address : '' }}
                </td>
            </tr>
            <tr>
                <td class="paragraph">
                    A.S. Nr.:: {{ $settings->address }}
                </td>
                <td class="paragraph">
                    <strong>Pristatymo data:</strong> {{ $offer->planed_date }}
                </td>
            </tr>
            </tbody>
        </table>
        <br>
        <table style="width:100%" id="items">
            <thead style="background-color:#bfbfbf">
            <tr>
                <th class="paragraph" scope="col">Nr.</th>
                <th class="paragraph" scope="col">Kodas</th>
                <th class="paragraph" scope="col">Aprašymas</th>
                <th class="paragraph" scope="col">Mato vnt.</th>
                <th class="paragraph" scope="col">Kiekis</th>
                <th class="paragraph" scope="col">Kaina, Eur</th>
                <th class="paragraph" scope="col">Suma, Eur</th>
            </tr>
            </thead>
            <tbody>

            @foreach($positions as $item)
                <tr class="border-bottom">
                    <th class="paragraph" scope="row">{{ $i++ }}.</th>
                    <td class="paragraph"></td>
                    <td class="paragraph" style="width: 40%">{{ $item->title }}</td>
                    <td class="paragraph" style="text-align: center">Vnt.</td>
                    <td class="paragraph" style="text-align: right">{{ $item->quantity }}</td>
                    <td class="paragraph" style="text-align: right">{{ $item->final_price }}</td>
                    <td class="paragraph" style="text-align: right">{{ $item->total }}</td>
                </tr>
            @endforeach

            </tbody>
        </table>
        <br>
        <table style="width:100%">
            <tbody style="border: none;">
            <tr>
                <td class="paragraph" style="text-align: right">
                    Suma be PVM: {{ number_format($offer->total, 2) }} Eur
                </td>
            </tr>
            <tr>
                <td class="paragraph" style="text-align: right">
                    PVM 21%: {{ number_format($offer->total_with_vat - $offer->total,2) }} Eur
                </td>
            </tr>
            <tr>
                <td class="paragraph" style="text-align: right">
                    <strong> Visa suma Eur: {{ number_format($offer->total_with_vat,2) }} Eur</strong>
                </td>
            </tr>
            </tbody>
        </table>
        <p class="paragraph">
            <strong>Suma žodžiu:</strong> {{ $offer->total_words }} Eur {{ $offer->fraction }} ct
        </p>
        <table style="width: 100%">
            <tr>
                <td class="paragraph">
                    <strong>Pasiūlymą paruošė: </strong> {{ $offer->user->name }}
                </td>
                <td class="paragraph">
                    <strong>Pasiūlymą gavo: </strong>____________________________
                </td>
            </tr>
        </table>
    </div>
@endsection
