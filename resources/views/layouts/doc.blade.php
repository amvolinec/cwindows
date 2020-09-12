<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="lt">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ env('APP_NAME') }}</title></head>
<style>
    body {
        font-family: DejaVu Sans;
        font-size: 12px;
    }
    .paragraph {
        font-family: DejaVu Sans;
        font-size: 12px;
        line-height: 1.5rem;
    }
    table {
        border: none;
    }
    table#items {
        border-collapse: separate;
    }

    table tr td {
        font-size: 12px;
        line-height: 1.5rem;
    }
    table#items, tr#items, td#items {
        border: 1px solid #888888;
    }
</style>
<body>
    @yield('content')
</body>
</html>
