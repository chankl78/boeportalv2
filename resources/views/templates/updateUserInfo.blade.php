

<h3>Hello, user with <b>ID{{$userId}}</b> want to change their information:</h3>
<br>
<table>
    @foreach ($data as $key => $value)
    <tr>
        <th>{{$key}}<th>
        <td>{{$value}}</td>
    </tr>
    @endforeach
</table>
