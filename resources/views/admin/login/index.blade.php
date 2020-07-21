<!DOCTYPE html>
<html>

<head>
    <link rel="shortcut icon" href="{{ URL::asset('foto/favicon.png') }}">
    <title>Admin-Login</title>
    <style>
    body {
        font-family: sans-serif;
        background-image: url('{{asset('foto/Background Login Tech Insider.svg')}}');
        "
overflow: auto;
        width: 100%;
        height: 100%;
        background-position: fixed;
        -webkit-background-size: cover;
        -webkit-filter: cover;
        background-size: cover;
        margin: 0;
        padding: 0;
    }

    h1 {
        text-align: center;
        /*ketebalan font*/
        font-weight: 300;
    }

    .tulisan_login {
        text-align: center;
        /*membuat semua huruf menjadi kapital*/
        text-transform: uppercase;
    }

    .kotak_login {
        width: 350px;
        background: white;
        /*meletakkan form ke tengah*/
        margin: 80px auto;
        padding: 30px 20px;
    }

    label {
        font-size: 11pt;
    }

    .form_login {
        /*membuat lebar form penuh*/
        box-sizing: border-box;
        width: 100%;
        padding: 10px;
        font-size: 11pt;
        margin-bottom: 20px;
    }

    .tombol_login {
        background: #46de4b;
        color: white;
        font-size: 11pt;
        width: 100%;
        border: none;
        border-radius: 3px;
        padding: 10px 20px;
    }

    .link {
        color: #232323;
        text-decoration: none;
        font-size: 10pt;
    }

    body {
        font-family: sans-serif;
    }

    h1 {
        text-align: center;
        /*ketebalan font*/
        font-weight: 300;
    }

    .tulisan_login {
        text-align: center;
        /*membuat semua huruf menjadi kapital*/
        text-transform: uppercase;
    }

    .kotak_login {
        width: 350px;
        background: white;
        border-radius: 5px;
        /*meletakkan form ke tengah*/
        padding: 30px 20px;
        box-shadow: 3px 3px 10px #333333;
    }

    label {
        font-size: 11pt;
    }

    .form_login {
        /*membuat lebar form penuh*/
        box-sizing: border-box;
        width: 100%;
        padding: 10px;
        font-size: 11pt;
        margin-bottom: 20px;
    }

    .tombol_login {
        background: #1C2259;
        color: white;
        font-size: 11pt;
        width: 100%;
        border: none;
        border-radius: 3px;
        padding: 10px 20px;
    }

    .link {
        color: #232323;
        text-decoration: none;
        font-size: 10pt;
    }
    </style>

</head>

<body>


    <div class="kotak_login">
        <center>
            <img src="{{ URL::asset('foto/Logo Tech Insider Black.svg') }}" alt="Logo Tech Insider" style="width:200px; margin-bottom:30px;">
            </center>

        <form action="{{ url('/admin/ceklogin') }}" method="POST">
            {{ csrf_field() }}
            <label>Email</label>
            <input type="email" name="email" class="form_login" placeholder="Username atau email ..">

            <label>Password</label>
            <input type="password" name="password" class="form_login" placeholder="Password ..">
            @include('partials.admin.flash')
            <br>
            <input type="submit" class="tombol_login" value="LOGIN">

            <br />
        </form>


    </div>


</body>

</html>