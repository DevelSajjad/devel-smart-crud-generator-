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

    @if(!empty($previews['conflicts']))
        <div class="alert alert-danger">
            <strong>Conflicts detected!</strong>

            <p>
                Some target files or routes already exist.
                Resolve these conflicts before generating.
            </p>

            <ul class="mb-0">
                @foreach($previews['conflicts'] as $conflict)
                    <li>{{ $conflict }}</li>
                @endforeach
            </ul>
        </div>
    @else
        <div class="alert alert-success">
            No conflicts detected by the preflight checker.
        </div>
    @endif

    @if(isset($previews))
        @foreach($previews as $type => $file)
            @continue($type === 'views' || !isset($file['filename']))

            <div class="card mb-4">
                <div class="card-header">
                    {{ ucfirst($type) }}:
                    {{ $file['filename'] }}
                </div>

                <div class="card-body">
                    <pre class="mb-0"><code>{{ $file['content'] }}</code></pre>
                </div>
            </div>
        @endforeach
    @endif

    @if(isset($previews['views']))
        <h3 class="mt-4 mb-3">Blade Views</h3>

        @foreach($previews['views'] as $name => $file)
            <div class="card mb-3">
                <div class="card-header">
                    {{ $file['filename'] }}
                </div>

                <div class="card-body">
                    <pre class="mb-0"><code>{{ $file['content'] }}</code></pre>
                </div>
            </div>
        @endforeach
    @endif

    @if(empty($previews['conflicts']))
        <form
            method="POST"
            action="{{ url('/smart-crud/generate') }}"
        >
            @csrf

            <input
                type="hidden"
                name="model_name"
                value="{{ request('model_name') }}"
            >

            @foreach(request('columns', []) as $index => $column)
                @foreach($column as $key => $value)
                    @if(is_scalar($value) && $value !== '')
                        <input
                            type="hidden"
                            name="columns[{{ $index }}][{{ $key }}]"
                            value="{{ $value }}"
                        >
                    @endif
                @endforeach
            @endforeach

            <button type="submit" class="btn btn-success">
                Confirm & Generate
            </button>
        </form>
    @endif

    <a
        href="{{ url('/smart-crud-generator') }}"
        class="btn btn-secondary"
    >
        Back to Generator
    </a>

</div>

</body>
</html>