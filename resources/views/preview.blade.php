
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>CRUD Studio — Preview</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=JetBrains+Mono:wght@400;500&display=swap"
        rel="stylesheet"
    >

    <style>
        :root {
            --bg: #f5f7fb;
            --surface: #ffffff;
            --ink: #172033;
            --muted: #8791a5;
            --border: #e7eaf1;
            --accent: #635bff;
            --accent-soft: #efeeff;
            --success: #138a61;
            --danger: #d94352;
            --code-bg: #101625;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: var(--bg);
            color: var(--ink);
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
        }

        button, a {
            -webkit-tap-highlight-color: transparent;
        }

        .topbar {
            height: 66px;
            background: rgba(255,255,255,.94);
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 32px;
            position: sticky;
            top: 0;
            z-index: 20;
            backdrop-filter: blur(14px);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 11px;
            font-weight: 700;
            font-size: 15px;
            letter-spacing: -.4px;
        }

        .brand-mark {
            width: 34px;
            height: 34px;
            border-radius: 11px;
            background: linear-gradient(135deg, #7770ff, #4d45dc);
            display: grid;
            place-items: center;
            color: white;
            font-weight: 700;
            font-size: 16px;
            box-shadow: 0 4px 12px #635bff30;
        }

        .brand small {
            display: block;
            color: var(--muted);
            font-size: 10px;
            font-weight: 500;
            letter-spacing: .3px;
            margin-top: 1px;
        }

        .top-right {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .top-label {
            color: #647087;
            font-size: 12px;
        }

        .workspace {
            max-width: 1500px;
            padding: 30px 32px 115px;
            margin: auto;
        }

        .breadcrumb-line {
            color: var(--muted);
            margin-bottom: 22px;
            display: flex;
            align-items: center;
            gap: 9px;
            font-size: 12px;
        }

        .breadcrumb-line a {
            color: #657087;
            text-decoration: none;
        }

        .breadcrumb-line a:hover {
            color: var(--accent);
        }

        .hero {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 25px;
        }

        .eyebrow {
            text-transform: uppercase;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.6px;
            color: var(--accent);
            margin-bottom: 9px;
        }

        .hero h1 {
            font-size: clamp(24px, 3vw, 32px);
            letter-spacing: -1.2px;
            font-weight: 700;
            margin: 0 0 9px;
        }

        .hero p {
            color: var(--muted);
            margin: 0;
            font-size: 13px;
            line-height: 1.7;
        }

        .status-pill {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            border-radius: 30px;
            padding: 9px 12px;
            background: #fff;
            border: 1px solid var(--border);
            color: #526078;
            font-weight: 600;
            font-size: 11px;
            white-space: nowrap;
        }

        .status-dot {
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: #19ad79;
        }

        .status-pill.warning {
            color: var(--danger);
            background: #fff5f5;
            border-color: #f8dada;
        }

        .status-pill.warning .status-dot {
            background: var(--danger);
        }

        .summary {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 14px;
            margin-bottom: 24px;
        }

        .summary-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 13px;
            padding: 17px 19px;
            display: flex;
            align-items: center;
            gap: 13px;
        }

        .summary-icon {
            width: 39px;
            height: 39px;
            border-radius: 11px;
            display: grid;
            place-items: center;
            font-size: 17px;
            flex-shrink: 0;
        }

        .icon-purple {
            color: #6257ed;
            background: #efedff;
        }

        .icon-blue {
            color: #2875d8;
            background: #eaf3ff;
        }

        .icon-green {
            color: #14865e;
            background: #e6f8ef;
        }

        .summary-label {
            color: var(--muted);
            font-size: 11px;
            margin-bottom: 4px;
        }

        .summary-value {
            font-size: 18px;
            font-weight: 700;
            letter-spacing: -.4px;
            line-height: 1.2;
        }

        .conflict-box {
            background: #fff5f5;
            border: 1px solid #f4d4d7;
            border-radius: 12px;
            padding: 16px 18px;
            margin-bottom: 22px;
            display: flex;
            gap: 13px;
        }

        .conflict-icon {
            color: var(--danger);
            font-size: 20px;
        }

        .conflict-box h3 {
            color: #a42e3c;
            font-size: 13px;
            font-weight: 700;
            margin: 0 0 5px;
        }

        .conflict-box p {
            color: #8c5058;
            font-size: 12px;
            margin: 0 0 8px;
        }

        .conflict-box ul {
            margin: 0;
            padding-left: 18px;
            color: #8c5058;
            line-height: 1.9;
            overflow-wrap: anywhere;
        }

        .editor {
            background: white;
            border: 1px solid var(--border);
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 8px 35px rgba(25, 35, 65, .035);
        }

        .editor-heading {
            height: 57px;
            padding: 0 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            border-bottom: 1px solid var(--border);
        }

        .editor-heading strong {
            font-size: 13px;
            font-weight: 700;
        }

        .editor-heading small {
            display: block;
            color: var(--muted);
            font-size: 11px;
            margin-top: 3px;
        }

        .editor-body {
            display: grid;
            grid-template-columns: 250px minmax(0, 1fr);
            min-height: 480px;
        }

        .file-sidebar {
            background: #fbfcfe;
            border-right: 1px solid var(--border);
            padding: 16px 10px;
            min-width: 0;
        }

        .sidebar-title {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1.1px;
            color: #98a1b3;
            font-weight: 700;
            padding: 0 10px;
            margin-bottom: 12px;
        }

        .file-group {
            color: #98a1b3;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: .7px;
            font-weight: 700;
            padding: 10px 10px 7px;
        }

        .file-item {
            display: flex;
            align-items: center;
            gap: 9px;
            width: 100%;
            text-align: left;
            border: 1px solid transparent;
            background: transparent;
            border-radius: 8px;
            padding: 10px;
            margin-bottom: 3px;
            color: #667187;
            font-family: inherit;
            font-size: 11px;
            cursor: pointer;
            transition: .15s ease;
        }

        .file-item:hover {
            background: #f0f2f9;
            color: var(--ink);
        }

        .file-item.active {
            background: var(--accent-soft);
            border-color: #e2dfff;
            color: #5148d9;
            font-weight: 700;
        }

        .file-symbol {
            width: 24px;
            height: 24px;
            flex-shrink: 0;
            display: grid;
            place-items: center;
            border-radius: 6px;
            background: #eef0f6;
            font-size: 9px;
            font-weight: 700;
        }

        .file-item.active .file-symbol {
            background: white;
            color: var(--accent);
        }

        .file-name {
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
            flex: 1;
        }

        .file-count {
            color: #9ca4b4;
            font-size: 10px;
        }

        .code-side {
            min-width: 0;
            background: var(--code-bg);
            display: flex;
            flex-direction: column;
        }

        .code-toolbar {
            min-height: 49px;
            padding: 10px 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            border-bottom: 1px solid #ffffff12;
            color: #a9b3c8;
        }

        .code-path {
            min-width: 0;
            overflow-wrap: anywhere;
            font-size: 11px;
            font-family: 'JetBrains Mono', monospace;
        }

        .code-actions {
            display: flex;
            gap: 8px;
            flex-shrink: 0;
        }

        .mini-btn {
            background: #ffffff0a;
            border: 1px solid #ffffff20;
            color: #c6cde0;
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 10px;
            cursor: pointer;
        }

        .mini-btn:hover {
            background: #ffffff18;
            color: white;
        }

        .code-window {
            min-width: 0;
            flex: 1;
            overflow: auto;
            max-height: 560px;
            padding: 20px 0;
        }

        .code-window pre {
            margin: 0;
            color: #d7def0;
            font-family: 'JetBrains Mono', monospace;
            font-size: 11px;
            line-height: 1.9;
            tab-size: 4;
        }

        .code-window code {
            display: block;
            padding: 0 22px;
            white-space: pre;
            overflow-wrap: normal;
        }

        .code-empty {
            padding: 35px 22px;
            color: #a9b3c8;
            font-size: 12px;
        }

        .editor-footer {
            min-height: 48px;
            padding: 10px 18px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            background: #fbfcfe;
            border-top: 1px solid var(--border);
            color: var(--muted);
            font-size: 10px;
        }

        .bottom-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 30;
            padding: 13px 32px;
            background: rgba(255,255,255,.94);
            border-top: 1px solid var(--border);
            backdrop-filter: blur(16px);
        }

        .bottom-inner {
            max-width: 1436px;
            margin: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
        }

        .bottom-note {
            color: var(--muted);
            font-size: 11px;
        }

        .bottom-note strong {
            display: block;
            color: var(--ink);
            font-size: 12px;
            margin-bottom: 3px;
        }

        .btn-quiet {
            border: 1px solid var(--border);
            background: white;
            color: #566177;
            text-decoration: none;
            padding: 11px 16px;
            border-radius: 9px;
            font-family: inherit;
            font-weight: 600;
            font-size: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
        }

        .btn-quiet:hover {
            border-color: #c8cce0;
            color: var(--ink);
        }

        .btn-generate {
            border: 0;
            background: linear-gradient(135deg, #6b63ff, #5148df);
            color: white;
            padding: 12px 19px;
            border-radius: 9px;
            font-family: inherit;
            font-weight: 700;
            font-size: 12px;
            box-shadow: 0 4px 12px #635bff35;
            cursor: pointer;
            transition: .15s ease;
        }

        .btn-generate:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 17px #635bff45;
        }

        .btn-generate:disabled {
            background: #a8a8b8;
            box-shadow: none;
            cursor: not-allowed;
            transform: none;
        }

        @media (max-width: 800px) {
            .topbar {
                padding: 0 16px;
            }

            .workspace {
                padding: 22px 14px 110px;
            }

            .hero {
                flex-direction: column;
            }

            .summary {
                gap: 8px;
            }

            .summary-card {
                padding: 12px;
                gap: 8px;
            }

            .summary-icon {
                width: 31px;
                height: 31px;
            }

            .summary-value {
                font-size: 16px;
            }

            .editor-body {
                grid-template-columns: 155px minmax(0, 1fr);
                min-height: 420px;
            }

            .file-sidebar {
                padding: 12px 6px;
            }

            .file-item {
                padding: 8px 6px;
                gap: 5px;
                font-size: 10px;
            }

            .file-symbol {
                width: 20px;
                height: 20px;
            }

            .code-window pre {
                font-size: 10px;
            }

            .code-window code {
                padding: 0 12px;
            }

            .bottom-bar {
                padding: 12px 14px;
            }
        }

        @media (max-width: 480px) {
            .summary {
                grid-template-columns: 1fr;
            }

            .summary-card {
                padding: 11px 14px;
            }

            .editor-body {
                grid-template-columns: 1fr;
            }

            .file-sidebar {
                border-right: 0;
                border-bottom: 1px solid var(--border);
                max-height: 180px;
                overflow: auto;
            }

            .file-item {
                display: inline-flex;
                width: calc(50% - 5px);
                vertical-align: top;
            }

            .file-group {
                padding-top: 8px;
            }

            .code-window {
                max-height: 430px;
            }

            .bottom-note {
                display: none;
            }

            .bottom-inner {
                justify-content: flex-end;
            }

            .btn-quiet, .btn-generate {
                padding: 11px 12px;
            }

            .top-label {
                display: none;
            }
        }
    </style>
</head>

<body>

@php
    $mainFiles = collect($previews ?? [])
        ->except(['views', 'conflicts'])
        ->filter(fn ($file) => is_array($file) && isset($file['filename']));

    $viewFiles = collect($previews['views'] ?? [])
        ->filter(fn ($file) => is_array($file) && isset($file['filename']));

    $totalFiles = $mainFiles->count() + $viewFiles->count();
    $conflicts = $previews['conflicts'] ?? [];
    $hasConflicts = !empty($conflicts);
@endphp

<header class="topbar">
    <div class="brand">
        <div class="brand-mark">S</div>
        <div>
            CRUD Studio
            <small>SMART GENERATOR</small>
        </div>
    </div>

    <div class="top-right">
        <span class="top-label">Generation workspace</span>

        <span class="status-pill {{ $hasConflicts ? 'warning' : '' }}">
            <span class="status-dot"></span>
            {{ $hasConflicts ? 'Action required' : 'Ready for review' }}
        </span>
    </div>
</header>

<main class="workspace">

    <div class="breadcrumb-line">
        <a href="{{ url('/smart-crud-generator') }}">Generator</a>
        <span>/</span>
        <span>Preview</span>
    </div>

    <section class="hero">
        <div>
            <div class="eyebrow">Your workspace / Preview</div>

            <h1>Review your CRUD.</h1>

            <p>
                Everything is prepared. Inspect your files, check for conflicts,
                and generate your resources when you're ready.
            </p>
        </div>

        <span class="status-pill {{ $hasConflicts ? 'warning' : '' }}">
            <span class="status-dot"></span>
            {{ $hasConflicts ? 'Conflicts detected' : 'Preflight checked' }}
        </span>
    </section>

    <section class="summary">

        <div class="summary-card">
            <div class="summary-icon icon-purple">⌘</div>
            <div>
                <div class="summary-label">Files prepared</div>
                <div class="summary-value">{{ $totalFiles }}</div>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon icon-blue">▤</div>
            <div>
                <div class="summary-label">Blade views</div>
                <div class="summary-value">{{ $viewFiles->count() }}</div>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon {{ $hasConflicts ? 'icon-purple' : 'icon-green' }}">
                {{ $hasConflicts ? '!' : '✓' }}
            </div>
            <div>
                <div class="summary-label">Detected conflicts</div>
                <div class="summary-value">{{ count($conflicts) }}</div>
            </div>
        </div>

    </section>

    @if($hasConflicts)
        <section class="conflict-box">
            <div class="conflict-icon">⚠</div>
            <div>
                <h3>Some conflicts need your attention</h3>
                <p>
                    Resolve these existing files or route conflicts before generating.
                    Review the items below.
                </p>

                <ul>
                    @foreach($conflicts as $conflict)
                        <li>{{ $conflict }}</li>
                    @endforeach
                </ul>
            </div>
        </section>
    @endif

    <section class="editor">

        <div class="editor-heading">
            <div>
                <strong>Generated files</strong>
                <small>Select a file to inspect its contents.</small>
            </div>

            <span class="top-label">
                {{ $totalFiles }} {{ $totalFiles === 1 ? 'file' : 'files' }}
            </span>
        </div>

        <div class="editor-body">

            <aside class="file-sidebar">
                <div class="sidebar-title">Project explorer</div>

                @if($mainFiles->isNotEmpty())
                    <div class="file-group">Application files</div>

                    @foreach($mainFiles as $type => $file)
                        <button
                            type="button"
                            class="file-item"
                            data-file="file-{{ $loop->index }}"
                            data-path="{{ $file['filename'] }}"
                            aria-pressed="false"
                        >
                            <span class="file-symbol">
                                {{ strtoupper(substr(pathinfo($file['filename'], PATHINFO_EXTENSION) ?: 'FILE', 0, 3)) }}
                            </span>

                            <span class="file-name">
                                {{ basename($file['filename']) }}
                            </span>
                        </button>
                    @endforeach
                @endif

                @if($viewFiles->isNotEmpty())
                    <div class="file-group">Blade views</div>

                    @foreach($viewFiles as $name => $file)
                        <button
                            type="button"
                            class="file-item"
                            data-file="view-{{ $loop->index }}"
                            data-path="{{ $file['filename'] }}"
                            aria-pressed="false"
                        >
                            <span class="file-symbol">BLA</span>

                            <span class="file-name">
                                {{ basename($file['filename']) }}
                            </span>
                        </button>
                    @endforeach
                @endif

                @if($totalFiles === 0)
                    <div class="code-empty">
                        No preview files are available.
                    </div>
                @endif
            </aside>

            <div class="code-side">

                <div class="code-toolbar">
                    <div class="code-path" id="activePath">
                        Select a file
                    </div>

                    <div class="code-actions">
                        <button
                            type="button"
                            class="mini-btn"
                            id="copyCode"
                            disabled
                        >
                            Copy code
                        </button>
                    </div>
                </div>

                <div class="code-window" id="codeWindow">

                    @foreach($mainFiles as $type => $file)
                        <div
                            class="code-panel"
                            id="file-{{ $loop->index }}"
                            data-path="{{ $file['filename'] }}"
                            hidden
                        >
                            <pre><code>{{ $file['content'] }}</code></pre>
                        </div>
                    @endforeach

                    @foreach($viewFiles as $name => $file)
                        <div
                            class="code-panel"
                            id="view-{{ $loop->index }}"
                            data-path="{{ $file['filename'] }}"
                            hidden
                        >
                            <pre><code>{{ $file['content'] }}</code></pre>
                        </div>
                    @endforeach

                    @if($totalFiles === 0)
                        <div class="code-empty">
                            Generated file contents will appear here.
                        </div>
                    @endif

                </div>

                <div class="editor-footer">
                    <span id="fileInfo">
                        {{ $totalFiles }} files available
                    </span>

                    <span>Read-only preview</span>
                </div>

            </div>
        </div>
    </section>

</main>

<footer class="bottom-bar">
    <div class="bottom-inner">

        <div class="bottom-note">
            <strong>Almost there.</strong>
            Review your resources before continuing.
        </div>

        <div class="d-flex gap-2">
            <a
                href="{{ url('/smart-crud-generator') }}"
                class="btn-quiet"
            >
                ← Back
            </a>

            @if(!$hasConflicts)
                <form
                    method="POST"
                    action="{{ url('/smart-crud/generate') }}"
                    id="generateForm"
                    class="m-0"
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

                    <button
                        type="submit"
                        class="btn-generate"
                        id="generateButton"
                    >
                        Confirm & Generate <span>→</span>
                    </button>
                </form>
            @else
                <button
                    type="button"
                    class="btn-generate"
                    disabled
                    title="Resolve conflicts before generating"
                >
                    Resolve conflicts first
                </button>
            @endif
        </div>

    </div>
</footer>

<script>
    (() => {
        const fileButtons = document.querySelectorAll('.file-item');
        const panels = document.querySelectorAll('.code-panel');
        const activePath = document.getElementById('activePath');
        const copyButton = document.getElementById('copyCode');
        const fileInfo = document.getElementById('fileInfo');

        let activePanel = null;

        function selectFile(button) {
            const panel = document.getElementById(button.dataset.file);

            if (!panel) return;

            fileButtons.forEach(item => {
                const active = item === button;

                item.classList.toggle('active', active);
                item.setAttribute('aria-pressed', String(active));
            });

            panels.forEach(item => {
                item.hidden = item !== panel;
            });

            activePanel = panel;
            activePath.textContent = panel.dataset.path;
            copyButton.disabled = false;

            const lineCount = panel.querySelector('code')
                .textContent.split('\n').length;

            fileInfo.textContent =
                `${lineCount} lines · ${button.dataset.path}`;
        }

        fileButtons.forEach(button => {
            button.addEventListener('click', () => selectFile(button));
        });

        if (fileButtons.length > 0) {
            selectFile(fileButtons[0]);
        }

        copyButton.addEventListener('click', async () => {
            if (!activePanel) return;

            const code = activePanel.querySelector('code').textContent;

            try {
                await navigator.clipboard.writeText(code);
                copyButton.textContent = 'Copied ✓';
            } catch (error) {
                const textarea = document.createElement('textarea');
                textarea.value = code;
                textarea.style.position = 'fixed';
                textarea.style.opacity = '0';

                document.body.appendChild(textarea);
                textarea.select();

                const copied = document.execCommand('copy');
                textarea.remove();

                copyButton.textContent = copied ? 'Copied ✓' : 'Copy failed';
            }

            setTimeout(() => {
                copyButton.textContent = 'Copy code';
            }, 1600);
        });

        const generateForm = document.getElementById('generateForm');
        const generateButton = document.getElementById('generateButton');

        if (generateForm && generateButton) {
            generateForm.addEventListener('submit', () => {
                generateButton.disabled = true;
                generateButton.textContent = 'Generating...';
            });
        }
    })();
</script>

</body>
</html>
