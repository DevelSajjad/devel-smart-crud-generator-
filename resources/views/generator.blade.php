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
                    <form method="post" action="{{ url('smart-crud/generate') }}" id="crud-generator-form">
                        @csrf
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

                        <button
                            type="submit"
                            id="generate_crud"
                            class="btn btn-success mt-3"
                            style="display: none;"
                        >
                            Generate CRUD
                        </button>
                    </form>

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
                    <div class="card mb-4">

                        <div class="card-header">
                            <strong>Column ${i}</strong>
                        </div>

                        <div class="card-body">

                            <!-- Column Name -->

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


                            <!-- Column Type -->

                            <div class="mb-3">

                                <label class="form-label">
                                    Column Type
                                </label>

                                <select
                                    name="columns[${i}][type]"
                                    class="form-select column-type"
                                    data-column="${i}"
                                >

                                    <option value="string">
                                        String
                                    </option>

                                    <option value="text">
                                        Text
                                    </option>

                                    <option value="longText">
                                        Long Text
                                    </option>

                                    <option value="integer">
                                        Integer
                                    </option>

                                    <option value="bigInteger">
                                        Big Integer
                                    </option>

                                    <option value="smallInteger">
                                        Small Integer
                                    </option>

                                    <option value="tinyInteger">
                                        Tiny Integer
                                    </option>

                                    <option value="unsignedInteger">
                                        Unsigned Integer
                                    </option>

                                    <option value="unsignedBigInteger">
                                        Unsigned Big Integer
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

                                </select>

                            </div>


                            <!-- String Options -->

                            <div
                                id="string_options_${i}"
                                class="type-options"
                            >

                                <div class="mb-3">

                                    <label class="form-label">
                                        Length
                                    </label>

                                    <input
                                        type="number"
                                        name="columns[${i}][length]"
                                        class="form-control"
                                        value="255"
                                        min="1"
                                    >

                                </div>

                            </div>


                            <!-- Decimal Options -->

                            <div
                                id="decimal_options_${i}"
                                class="type-options"
                                style="display: none;"
                            >

                                <div class="row">

                                    <div class="col-md-6">

                                        <label class="form-label">
                                            Precision
                                        </label>

                                        <input
                                            type="number"
                                            name="columns[${i}][precision]"
                                            class="form-control"
                                            value="10"
                                            min="1"
                                        >

                                    </div>

                                    <div class="col-md-6">

                                        <label class="form-label">
                                            Scale
                                        </label>

                                        <input
                                            type="number"
                                            name="columns[${i}][scale]"
                                            class="form-control"
                                            value="2"
                                            min="0"
                                        >

                                    </div>

                                </div>

                            </div>


                            <!-- Default -->

                            <div class="mb-3">

                                <label class="form-label">
                                    Default Value
                                </label>

                                <input
                                    type="text"
                                    name="columns[${i}][default]"
                                    class="form-control"
                                    placeholder="Optional"
                                >

                            </div>


                            <!-- Checkboxes -->

                            <div class="row">

                                <div class="col-md-3">

                                    <div class="form-check">

                                        <input
                                            type="checkbox"
                                            name="columns[${i}][nullable]"
                                            value="1"
                                            class="form-check-input"
                                        >

                                        <label class="form-check-label">
                                            Nullable
                                        </label>

                                    </div>

                                </div>


                                <div class="col-md-3">

                                    <div class="form-check">

                                        <input
                                            type="checkbox"
                                            name="columns[${i}][unique]"
                                            value="1"
                                            class="form-check-input"
                                        >

                                        <label class="form-check-label">
                                            Unique
                                        </label>

                                    </div>

                                </div>


                                <div class="col-md-3">

                                    <div class="form-check">

                                        <input
                                            type="checkbox"
                                            name="columns[${i}][index]"
                                            value="1"
                                            class="form-check-input"
                                        >

                                        <label class="form-check-label">
                                            Index
                                        </label>

                                    </div>

                                </div>


                                <div class="col-md-3">

                                    <div class="form-check">

                                        <input
                                            type="checkbox"
                                            name="columns[${i}][unsigned]"
                                            value="1"
                                            class="form-check-input"
                                        >

                                        <label class="form-check-label">
                                            Unsigned
                                        </label>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>
                `;
            }

            document.getElementById(
                'columns_container'
            ).innerHTML = html;


            registerColumnTypeEvents();

            document.getElementById(
                'generate_crud'
            ).style.display = 'block';

        });


    function registerColumnTypeEvents()
    {
        document
            .querySelectorAll('.column-type')
            .forEach(function (select) {

                select.addEventListener('change', function () {

                    const column = this.dataset.column;

                    const stringOptions =
                        document.getElementById(
                            `string_options_${column}`
                        );

                    const decimalOptions =
                        document.getElementById(
                            `decimal_options_${column}`
                        );


                    stringOptions.style.display = 'none';

                    decimalOptions.style.display = 'none';


                    if (this.value === 'string') {

                        stringOptions.style.display = 'block';

                    }


                    if (this.value === 'decimal') {

                        decimalOptions.style.display = 'block';

                    }

                });

            });
    }

</script>

</body>
</html>