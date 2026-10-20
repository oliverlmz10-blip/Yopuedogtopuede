<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Yo puedo Guanajuato puede</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: #1d4ed8;
            color: #ffffff;
            font-family: system-ui, -apple-system, "Segoe UI", Arial, sans-serif;
        }

        .encabezado {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 24px;
            padding: 28px 40px;
        }

        .encabezado h1 {
            margin: 0;
            font-size: 2.2rem;
            line-height: 1.15;
        }

        .logo {
            height: 90px;
            width: auto;
            flex-shrink: 0;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 8px;
            padding: 6px;
        }

        .logo-relleno {
            width: 90px;
            height: 90px;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.15);
            border-radius: 8px;
            font-size: 0.7rem;
            text-align: center;
            padding: 8px;
            color: rgba(255, 255, 255, 0.8);
        }

        @media (max-width: 600px) {
            .encabezado {
                padding: 20px;
            }
            .encabezado h1 {
                font-size: 1.6rem;
            }
            .logo,
            .logo-relleno {
                height: 64px;
                width: auto;
                min-width: 64px;
            }
        }
    </style>
</head>
<body>

    <header class="encabezado">
        <h1>Yo puedo Guanajuato puede</h1>

        @if (file_exists(public_path('imagen/gto.png')))
            <img class="logo" src="{{ asset('imagen/gto.png') }}" alt="Logo">
        @else
            <div class="logo-relleno"><img src="/public/imagen/gto.png"></div>
        @endif
    </header>

</body>
</html>
