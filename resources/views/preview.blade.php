<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >

    <title>CRUD Preview</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body class="bg-light">

<div class="container py-5">

    <h2>CRUD Generation Preview</h2>

    <p class="text-muted">
        Review the files before generating your CRUD.
    </p>

    <div class="card mb-3">
        <div class="card-body">

            <h5>Files to Generate</h5>

            <ul class="mb-0">
                <li>Migration</li>
                <li>Model</li>
                <li>Controller</li>
                <li>Resource Routes</li>
                <li>Index View</li>
                <li>Create View</li>
                <li>Edit View</li>
                <li>Show View</li>
            </ul>

        </div>
    </div>

    <a
        href="{{ url('/smart-crud-generator') }}"
        class="btn btn-secondary"
    >
        Back to Generator
    </a>

</div>

</body>
</html>