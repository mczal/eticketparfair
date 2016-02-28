<style>
@page { margin: 0px; }
body {
    margin: 20px;
    font-family: helvetica;
}
</style>

<table border=0>
    <tr>
        <td style="text-align: center; width: 250px;">
            <img src="{{ asset('/qrcodes/' . $ticket->generateBarcode() . '.png') }}" alt="" width="220"/><br>
            <b style="letter-spacing: 5px">{{ $ticket->unique_code }}</b>
        </td>
        <td style="text-align: left; width: 500px;">
            <h1 style="text-transform: uppercase; margin: 0px;">Parahyangan Festival</h1>
            <p>
                Bandung, 7 Mei 2016
            </p>
            <table border=0>
                <tr>
                    <td>ID</td><td>:</td><td>{{ $ticket->order ? App\Order::getIdTypeList($ticket->order->id_type) . ' / ' . $ticket->order->id_no : '- / -' }}</td>
                </tr>
                <tr>
                    <td>Name</td><td>:</td><td>{{ $ticket->order ? $ticket->order->name : ' - ' }}</td>
                </tr>
                <tr>
                    <td>Email</td><td>:</td><td>{{ $ticket->order ? $ticket->order->email : ' - ' }}</td>
                </tr>
                <tr>
                    <td>Phone</td><td>:</td><td>{{ $ticket->order ? $ticket->order->handphone : ' - ' }}</td>
                </tr>
            </table>
        </td>
    </tr>
    <tr>
        <td colspan=2>
            <br>
            ================================================================================
        </td>
    </tr>
    <tr>
        <td colspan=2>
            <p>Lorem ipsum dolor sit amet, per iudico graeco cu, ex minimum petentium consulatu quo. Dicam nonumy ullamcorper ne mea, no per oporteat expetenda voluptatibus. Ea sea sensibus mnesarchum. Debet nihil aliquid in vix. Has eu vitae perfecto accommodare. Quo at malis elitr, ad sit brute albucius, te diam duis epicurei pro. Nonumy nonumes epicurei cu sed.</p>
        </td>
    </tr>
    <tr>
        <td colspan=2 style="text-align: right; font-size: 13px">
            <br><br>
            <p>
                <small><em>{{ date('Y-m-d H:i:s') }} | {{ strtoupper($ticket->generateBarcode()) }}</em></small>
            </p>
        </td>
    </tr>
</table>
