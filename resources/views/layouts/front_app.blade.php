<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title inertia>{{ config('app.name', 'WabePoint POS') }}</title>
  @vite('resources/js/app.js')
</head>
<body>
  @inertia
</body>
</html>
