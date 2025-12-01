<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta content="width=device-width, initial-scale=1" name="viewport" />
    <meta content="dark" name="color-scheme" />
    @vite(['resources/css/app.css', 'resource/js/app.js'])
    <title>{{ $title }}</title>
</head>
<body
    class="bg-pixl-dark text-pixl-light flex gap-8 px-4 sm:h-dvh sm:overflow-clip xl:gap-16"
>
 {{ $slot }}
</body>
</html>
