@extends('layouts.mail')
@section('content')
<table>
    <tbody>
        <tr>
            <td>Hello Madam, Mister {{ $request['name'] }},</td>
        </tr>
        <tr>
            <td>Michaël Zingraf Vineyards and his team would like to thank you for contacting us.</td>
        </tr>
        <tr>
            <td>
                <p>Your information :</p>
                <ul>
                    <li>
                        Name: {{ $request['name'] }}
                    </li>
                    <li>
                        Phone: {{ $request['phone'] }}
                    </li>
                    <li>
                        Email: {{ $request['email'] }}
                    </li>
                    <li>
                        Message: {{ $request['message'] }}
                    </li>
                </ul>
            </td>
        </tr>
    </tbody>
</table>
@endsection
