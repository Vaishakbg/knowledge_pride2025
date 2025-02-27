<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livewire App</title>
    @livewireStyles
</head>
<body>
    {{ $slot }}  <!-- This is where Livewire will inject content -->
    @livewireScripts
</body>
</html>
