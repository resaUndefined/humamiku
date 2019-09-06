<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<h2 style="text-align: center;">Rekap Kas HUMAMIKU</h2>
      <table border="1">
        <thead>
          <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Keterangan</th>
            <th>Kredit</th>
            <th>Debit</th>
            <th>Saldo</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($data as $key => $d)
            <tr>
              <td>{{ $key+1 }}</td>
              <td>{{ date('d F Y', strtotime($d->tanggal)) }}</td>
              <td>@if ($d->status == 2 || $d->status == '2')
                <strong>{{ $d->keterangan }}</strong>
              @else
                {{ $d->keterangan }}
              @endif</td>
              @if ($d->status == 0 || $d->status == '0')
                <td>@currency($d->nominal)</td>
                <td>-</td>
                <td>-</td>
              @elseif($d->status == 1 || $d->status == '1')
                <td>-</td>
                <td>@currency($d->nominal)</td>
                <td>-</td>
              @else
                <td>-</td>
                <td>-</td>
                <td>@currency($d->nominal)</td>
              @endif
            </tr>
          @endforeach
        </tbody>
      </table>
</body>
</html>