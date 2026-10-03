<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Laravel Smart CRUD Generator</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >
</head>

<body>

<div class="container py-5">

    <div class="row justify-content-center">

        <div class="col-md-8">

            <div class="card shadow">

                <div class="card-header">
                    <h4 class="mb-0">
                        Laravel Smart CRUD Generator
                    </h4>
                </div>

                <div class="card-body">

                    <div class="mb-3">

                        <label class="form-label">
                            Model Name
                        </label>

                        <input
                            type="text"
                            id="model_name"
                            class="form-control"
                            placeholder="Example: Product"
                        >

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Number of Columns
                        </label>

                        <input
                            type="number"
                            id="column_count"
                            class="form-control"
                            min="1"
                            placeholder="Example: 4"
                        >

                    </div>

                    <button
                        type="button"
                        id="generate_columns"
                        class="btn btn-primary"
                    >
                        Generate Columns
                    </button>

                    <div id="columns_container" class="mt-4"></div>

                </div>

            </div>

        </div>

    </div>

</div>

<script>

    document
        .getElementById('generate_columns')
        .addEventListener('click', function () {

            const count = parseInt(
                document.getElementById('column_count').value
            );

            if (!count || count < 1) {
                alert('Please enter a valid column count.');
                return;
            }

            let html = '';

            for (let i = 1; i <= count; i++) {

                html += `
                    <div class="card mb-3">

                        <div class="card-header">
                            Column ${i}
                        </div>

                        <div class="card-body">

                            <div class="mb-3">

                                <label class="form-label">
                                    Column Name
                                </label>

                                <input
                                    type="text"
                                    name="columns[${i}][name]"
                                    class="form-control"
                                    placeholder="Example: name"
                                >

                            </div>

                            <div class="mb-3">

                                <label class="form-label">
                                    Column Type
                                </label>

                                <select
                                    name="columns[${i}][type]"
                                    class="form-select"
                                >

                                    <option value="string">
                                        String
                                    </option>

                                    <option value="text">
                                        Text
                                    </option>

                                    <option value="integer">
                                        Integer
                                    </option>

                                    <option value="bigInteger">
                                        Big Integer
                                    </option>

                                    <option value="boolean">
                                        Boolean
                                    </option>

                                    <option value="decimal">
                                        Decimal
                                    </option>

                                    <option value="float">
                                        Float
                                    </option>

                                    <option value="double">
                                        Double
                                    </option>

                                    <option value="date">
                                        Date
                                    </option>

                                    <option value="dateTime">
                                        Date Time
                                    </option>

                                    <option value="time">
                                        Time
                                    </option>

                                    <option value="timestamp">
                                        Timestamp
                                    </option>

                                    <option value="json">
                                        JSON
                                    </option>

                                    <option value="longText">
                                        Long Text
                                    </option>

                                </select>

                            </div>

                            <div class="form-check">

                                <input
                                    type="checkbox"
                                    name="columns[${i}][nullable]"
                                    value="1"
                                    class="form-check-input"
                                    id="nullable_${i}"
                                >

                                <label
                                    class="form-check-label"
                                    for="nullable_${i}"
                                >
                                    Nullable
                                </label>

                            </div>

                        </div>

                    </div>
                `;
            }

            document.getElementById('columns_container').innerHTML = html;
        });

</script>

</body>
</html>