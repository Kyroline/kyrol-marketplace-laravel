<table class="table align-items-center mb-0">
  <thead>
    <th></th>
    <th>Service</th>
    <th>Tarifs</th>
    <th>ETD</th>
  </thead>
  <tbody>
    @foreach ($data['rajaongkir']['results'][0]['costs'] as $value)
    @foreach ($value['cost'] as $tarif)
          <tr  class="text-xs font-weight-bold mb-0">
          <td><input type="radio" name="service" value="{{$value['service']}}-{{$tarif['value']}}"></td>
          <td>{{$value['service']}}</td>
          <td>@convert($tarif['value'])</td>
          <td>{{$tarif['etd']}} day(s)</td>
          </tr>
      @endforeach
    @endforeach
  </tbody>
</table>