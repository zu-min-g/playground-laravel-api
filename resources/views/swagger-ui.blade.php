<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Swagger UI</title>

        <script src="/js/app.js"></script>
    </head>
    <body class="antialiased">
        <main id="swagger-ui">
        </main>
        <script>
            const ui = SwaggerUI({
                url: "/api/v1/open-api",
                dom_id: '#swagger-ui',
            })
        </script>
    </body>
</html>
