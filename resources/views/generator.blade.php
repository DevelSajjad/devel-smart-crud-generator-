<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Laravel Smart CRUD Generator</title>

    <style>
        :root {
            --primary: #635bff;
            --primary-dark: #5048df;
            --primary-soft: #efefff;

            --success: #10b981;
            --success-soft: #ecfdf5;

            --danger: #ef4444;
            --danger-soft: #fef2f2;

            --warning: #f59e0b;
            --warning-soft: #fffbeb;

            --text: #111827;
            --text-secondary: #6b7280;
            --text-muted: #9ca3af;

            --border: #e5e7eb;
            --border-light: #f0f1f3;

            --background: #f7f8fc;
            --surface: #ffffff;

            --sidebar-width: 300px;

            --radius-sm: 8px;
            --radius-md: 12px;
            --radius-lg: 16px;

            --shadow-sm:
                0 1px 2px rgba(16, 24, 40, 0.04),
                0 1px 3px rgba(16, 24, 40, 0.06);

            --shadow-md:
                0 8px 30px rgba(16, 24, 40, 0.08);
        }

        * {
            box-sizing: border-box;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            min-height: 100%;
        }

        body {
            font-family:
                Inter,
                ui-sans-serif,
                system-ui,
                -apple-system,
                BlinkMacSystemFont,
                "Segoe UI",
                sans-serif;

            background: var(--background);
            color: var(--text);

            -webkit-font-smoothing: antialiased;
        }

        button,
        input,
        select {
            font: inherit;
        }

        button {
            cursor: pointer;
        }

        /* =========================================================
           APP
        ========================================================= */

        .app {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* =========================================================
           TOPBAR
        ========================================================= */

        .topbar {
            height: 72px;
            flex: 0 0 72px;

            background: rgba(255, 255, 255, 0.96);

            border-bottom: 1px solid var(--border);

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 0 28px;

            position: sticky;
            top: 0;

            z-index: 100;

            backdrop-filter: blur(14px);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-icon {
            width: 38px;
            height: 38px;

            border-radius: 11px;

            display: flex;
            align-items: center;
            justify-content: center;

            color: white;

            background:
                linear-gradient(
                    135deg,
                    #635bff,
                    #8b5cf6
                );

            box-shadow:
                0 5px 14px rgba(99, 91, 255, 0.25);
        }

        .brand-icon svg {
            width: 21px;
            height: 21px;
        }

        .brand-text {
            display: flex;
            flex-direction: column;
            gap: 1px;
        }

        .brand-title {
            font-size: 15px;
            font-weight: 700;
            letter-spacing: -0.2px;
        }

        .brand-subtitle {
            font-size: 11px;
            color: var(--text-muted);
        }

        .topbar-right {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .step-indicator {
            display: flex;
            align-items: center;
            gap: 8px;

            padding: 7px 11px;

            border-radius: 9px;

            background: #f9fafb;
            border: 1px solid var(--border);

            font-size: 12px;
            color: var(--text-secondary);
        }

        .step-dot {
            width: 7px;
            height: 7px;

            border-radius: 50%;

            background: var(--success);

            box-shadow:
                0 0 0 3px var(--success-soft);
        }

        /* =========================================================
           SETUP
        ========================================================= */

        .setup-wrapper {
            padding: 28px 28px 0;
            flex: 0 0 auto;
        }

        .setup-card {
            max-width: 1180px;

            margin: 0 auto;

            background: var(--surface);

            border: 1px solid var(--border);

            border-radius: var(--radius-lg);

            padding: 20px;

            box-shadow: var(--shadow-sm);
        }

        .setup-title {
            margin-bottom: 16px;
        }

        .setup-title h1 {
            margin: 0;

            font-size: 18px;
            font-weight: 700;

            letter-spacing: -0.3px;
        }

        .setup-title p {
            margin: 5px 0 0;

            font-size: 13px;

            color: var(--text-secondary);
        }

        .setup-grid {
            display: grid;

            grid-template-columns:
                minmax(0, 1fr)
                220px
                auto;

            gap: 14px;

            align-items: end;
        }

        /* =========================================================
           FORM
        ========================================================= */

        .field {
            display: flex;
            flex-direction: column;
            gap: 7px;
        }

        .field-label {
            font-size: 12px;
            font-weight: 600;
            color: #374151;
        }

        .input,
        .select {
            width: 100%;
            height: 42px;

            border: 1px solid var(--border);

            border-radius: 9px;

            padding: 0 12px;

            background: white;
            color: var(--text);

            outline: none;

            transition:
                border-color .15s ease,
                box-shadow .15s ease;
        }

        .input::placeholder {
            color: #b0b5bd;
        }

        .input:focus,
        .select:focus {
            border-color: var(--primary);

            box-shadow:
                0 0 0 3px rgba(99, 91, 255, 0.10);
        }

        /* =========================================================
           BUTTON
        ========================================================= */

        .btn {
            border: 0;

            border-radius: 9px;

            height: 42px;

            padding: 0 15px;

            display: inline-flex;

            align-items: center;
            justify-content: center;

            gap: 8px;

            font-size: 13px;
            font-weight: 600;

            transition:
                transform .12s ease,
                box-shadow .15s ease,
                background .15s ease;
        }

        .btn:active {
            transform: translateY(1px);
        }

        .btn svg {
            width: 16px;
            height: 16px;
        }

        .btn-primary {
            background: var(--primary);
            color: white;

            box-shadow:
                0 5px 12px rgba(99, 91, 255, .18);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
        }

        .btn-secondary {
            background: #f9fafb;

            color: #374151;

            border: 1px solid var(--border);
        }

        .btn-secondary:hover {
            background: #f3f4f6;
        }

        .btn-danger {
            background: var(--danger-soft);
            color: var(--danger);
        }

        .btn-success {
            background: var(--success);
            color: white;

            box-shadow:
                0 5px 12px rgba(16, 185, 129, .18);
        }

        .btn-icon {
            width: 36px;
            height: 36px;
            padding: 0;
        }

        /* =========================================================
           BUILDER
        ========================================================= */

        .builder-wrapper {
            flex: 1;

            min-height: 0;

            padding: 22px 28px 100px;
        }

        .builder {
            max-width: 1180px;

            height: calc(100vh - 230px);

            min-height: 560px;

            margin: 0 auto;

            display: grid;

            grid-template-columns:
                var(--sidebar-width)
                minmax(0, 1fr);

            background: white;

            border: 1px solid var(--border);

            border-radius: var(--radius-lg);

            overflow: hidden;

            box-shadow: var(--shadow-md);
        }

        /* =========================================================
           SIDEBAR
        ========================================================= */

        .sidebar {
            min-width: 0;
            min-height: 0;

            display: flex;
            flex-direction: column;

            background: #fbfbfd;

            border-right: 1px solid var(--border);

            overflow: hidden;
        }

        .sidebar-header {
            flex: 0 0 auto;

            padding: 17px;

            border-bottom: 1px solid var(--border);
        }

        .sidebar-header-top {
            display: flex;

            align-items: center;

            justify-content: space-between;

            margin-bottom: 13px;
        }

        .sidebar-heading {
            font-size: 13px;
            font-weight: 700;
        }

        .column-count-badge {
            min-width: 30px;

            height: 23px;

            padding: 0 7px;

            display: inline-flex;

            align-items: center;
            justify-content: center;

            border-radius: 7px;

            background: var(--primary-soft);

            color: var(--primary);

            font-size: 11px;

            font-weight: 700;
        }

        .search-box {
            position: relative;
        }

        .search-box svg {
            position: absolute;

            left: 11px;

            top: 50%;

            transform: translateY(-50%);

            width: 15px;
            height: 15px;

            color: #9ca3af;

            pointer-events: none;
        }

        .search-box .input {
            padding-left: 34px;

            height: 36px;

            font-size: 12px;

            background: white;
        }

        /* =========================================================
           IMPORTANT:
           INDEPENDENT COLUMN SCROLL
        ========================================================= */

        .column-list {
            flex: 1 1 auto;

            min-height: 0;

            height: 0;

            overflow-y: auto;

            overflow-x: hidden;

            padding: 9px;

            scrollbar-width: thin;

            scrollbar-color:
                #cbd5e1
                transparent;
        }

        .column-list::-webkit-scrollbar {
            width: 6px;
        }

        .column-list::-webkit-scrollbar-track {
            background: transparent;
        }

        .column-list::-webkit-scrollbar-thumb {
            background: #cbd5e1;

            border-radius: 10px;
        }

        .column-list::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        .column-item {
            position: relative;

            display: flex;

            align-items: center;

            min-height: 51px;

            padding: 7px 8px;

            margin-bottom: 4px;

            border: 1px solid transparent;

            border-radius: 9px;

            cursor: pointer;

            transition:
                background .12s ease,
                border-color .12s ease;
        }

        .column-item:hover {
            background: #f3f4f8;
        }

        .column-item.active {
            background: white;

            border-color: #dddafe;

            box-shadow:
                0 1px 3px rgba(0, 0, 0, .04);
        }

        .column-item.dragging {
            opacity: .35;
        }

        .drag-handle {
            flex: 0 0 18px;

            display: flex;

            align-items: center;

            justify-content: center;

            color: #c2c6ce;

            cursor: grab;
        }

        .drag-handle:active {
            cursor: grabbing;
        }

        .drag-handle svg {
            width: 14px;
            height: 14px;
        }

        .column-number {
            flex: 0 0 32px;

            font-size: 10px;

            font-weight: 700;

            color: #9ca3af;
        }

        .column-item.active .column-number {
            color: var(--primary);
        }

        .column-main {
            min-width: 0;

            flex: 1;
        }

        .column-name {
            font-size: 12px;

            font-weight: 600;

            white-space: nowrap;

            overflow: hidden;

            text-overflow: ellipsis;

            color: #374151;
        }

        .column-name.empty {
            color: #b1b5bd;

            font-style: italic;

            font-weight: 500;
        }

        .column-meta {
            margin-top: 2px;

            display: flex;

            align-items: center;

            gap: 5px;

            font-size: 10px;

            color: #9ca3af;

            white-space: nowrap;

            overflow: hidden;

            text-overflow: ellipsis;
        }

        .column-status-dot {
            width: 5px;
            height: 5px;

            flex: 0 0 5px;

            border-radius: 50%;

            background: #d1d5db;
        }

        .column-status-dot.complete {
            background: var(--success);
        }

        .column-status-dot.warning {
            background: var(--warning);
        }

        /* =========================================================
           SIDEBAR FOOTER
        ========================================================= */

        .sidebar-footer {
            flex: 0 0 auto;

            padding: 11px 13px;

            border-top: 1px solid var(--border);

            background: #fbfbfd;
        }

        .sidebar-progress {
            display: flex;

            align-items: center;

            justify-content: space-between;

            margin-bottom: 7px;

            font-size: 10px;

            color: var(--text-muted);
        }

        .progress-bar {
            height: 4px;

            overflow: hidden;

            background: #e9eaee;

            border-radius: 10px;
        }

        .progress-fill {
            height: 100%;

            width: 0;

            background:
                linear-gradient(
                    90deg,
                    var(--primary),
                    #8b5cf6
                );

            border-radius: inherit;

            transition:
                width .25s ease;
        }

        /* =========================================================
           EDITOR
        ========================================================= */

        .editor {
            min-width: 0;
            min-height: 0;

            display: flex;

            flex-direction: column;

            background: white;

            overflow: hidden;
        }

        .editor-header {
            flex: 0 0 auto;

            min-height: 72px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            padding: 14px 22px;

            border-bottom: 1px solid var(--border);
        }

        .editor-heading {
            display: flex;

            align-items: center;

            gap: 12px;

            min-width: 0;
        }

        .editor-number {
            width: 38px;
            height: 38px;

            display: flex;

            align-items: center;
            justify-content: center;

            flex: 0 0 auto;

            border-radius: 10px;

            background: var(--primary-soft);

            color: var(--primary);

            font-size: 12px;

            font-weight: 800;
        }

        .editor-title-wrap {
            min-width: 0;
        }

        .editor-title {
            margin: 0;

            font-size: 15px;

            font-weight: 700;

            white-space: nowrap;

            overflow: hidden;

            text-overflow: ellipsis;
        }

        .editor-subtitle {
            margin-top: 2px;

            font-size: 11px;

            color: var(--text-muted);
        }

        .editor-actions {
            display: flex;

            align-items: center;

            gap: 7px;

            flex: 0 0 auto;
        }

        .editor-content {
            flex: 1 1 auto;

            min-height: 0;

            overflow-y: auto;

            overflow-x: hidden;

            padding: 25px;

            scrollbar-width: thin;

            scrollbar-color:
                #cbd5e1
                transparent;
        }

        .editor-content::-webkit-scrollbar {
            width: 6px;
        }

        .editor-content::-webkit-scrollbar-thumb {
            background: #cbd5e1;

            border-radius: 10px;
        }

        .editor-inner {
            max-width: 680px;

            margin: 0 auto;
        }

        /* =========================================================
           SECTION
        ========================================================= */

        .section {
            margin-bottom: 24px;
        }

        .section-heading {
            display: flex;

            align-items: center;

            justify-content: space-between;

            margin-bottom: 12px;
        }

        .section-title {
            font-size: 12px;

            font-weight: 700;

            color: #374151;
        }

        .section-description {
            font-size: 10px;

            color: var(--text-muted);
        }

        .field-grid {
            display: grid;

            grid-template-columns:
                1fr 1fr;

            gap: 14px;
        }

        .field-full {
            grid-column: 1 / -1;
        }

        /* =========================================================
           TYPE
        ========================================================= */

        .type-selector {
            position: relative;
        }

        .type-selector .select {
            height: 48px;

            padding-left: 43px;

            font-weight: 600;
        }

        .type-icon {
            position: absolute;

            left: 13px;

            top: 50%;

            transform: translateY(-50%);

            width: 19px;
            height: 19px;

            color: var(--primary);

            pointer-events: none;
        }

        /* =========================================================
           ADVANCED
        ========================================================= */

        .advanced {
            border: 1px solid var(--border);

            border-radius: 11px;

            overflow: hidden;
        }

        .advanced-header {
            width: 100%;

            border: 0;

            background: white;

            padding: 14px;

            display: flex;

            align-items: center;

            justify-content: space-between;

            text-align: left;
        }

        .advanced-header:hover {
            background: #fafafa;
        }

        .advanced-left {
            display: flex;

            align-items: center;

            gap: 10px;
        }

        .advanced-icon {
            width: 30px;
            height: 30px;

            display: flex;

            align-items: center;
            justify-content: center;

            border-radius: 8px;

            background: #f3f4f6;

            color: #6b7280;
        }

        .advanced-icon svg {
            width: 15px;
            height: 15px;
        }

        .advanced-title {
            display: block;

            font-size: 12px;

            font-weight: 700;
        }

        .advanced-subtitle {
            display: block;

            margin-top: 2px;

            font-size: 10px;

            color: var(--text-muted);
        }

        .chevron {
            color: #9ca3af;

            transition:
                transform .2s ease;
        }

        .advanced.open .chevron {
            transform: rotate(180deg);
        }

        .advanced-body {
            display: none;

            padding: 0 14px 16px;
        }

        .advanced.open .advanced-body {
            display: block;
        }

        /* =========================================================
           CHECKBOXES
        ========================================================= */

        .options-grid {
            display: grid;

            grid-template-columns:
                repeat(4, 1fr);

            gap: 9px;
        }

        .check-card {
            position: relative;
        }

        .check-card input {
            position: absolute;

            opacity: 0;

            pointer-events: none;
        }

        .check-label {
            min-height: 64px;

            display: flex;

            flex-direction: column;

            align-items: center;

            justify-content: center;

            gap: 5px;

            padding: 8px;

            border: 1px solid var(--border);

            border-radius: 9px;

            cursor: pointer;

            background: white;

            transition:
                background .15s ease,
                border-color .15s ease;
        }

        .check-label:hover {
            background: #fafafa;
        }

        .check-card input:checked + .check-label {
            border-color: #c9c5ff;

            background: var(--primary-soft);

            color: var(--primary);
        }

        .check-box {
            width: 17px;
            height: 17px;

            border: 1.5px solid #d1d5db;

            border-radius: 5px;

            display: flex;

            align-items: center;

            justify-content: center;
        }

        .check-card input:checked
        + .check-label
        .check-box {
            border-color: var(--primary);

            background: var(--primary);
        }

        .check-box svg {
            width: 11px;
            height: 11px;

            opacity: 0;

            color: white;
        }

        .check-card input:checked
        + .check-label
        .check-box
        svg {
            opacity: 1;
        }

        .check-text {
            font-size: 10px;

            font-weight: 600;
        }

        /* =========================================================
           EMPTY
        ========================================================= */

        .empty-state {
            height: 100%;

            display: flex;

            align-items: center;

            justify-content: center;

            text-align: center;

            padding: 40px;
        }

        .empty-state-inner {
            max-width: 360px;
        }

        .empty-icon {
            width: 64px;
            height: 64px;

            margin: 0 auto 17px;

            display: flex;

            align-items: center;

            justify-content: center;

            border-radius: 18px;

            background: var(--primary-soft);

            color: var(--primary);
        }

        .empty-icon svg {
            width: 28px;
            height: 28px;
        }

        .empty-title {
            margin: 0;

            font-size: 17px;

            font-weight: 700;
        }

        .empty-description {
            margin: 7px 0 17px;

            font-size: 12px;

            line-height: 1.6;

            color: var(--text-secondary);
        }

        /* =========================================================
           ACTION BAR
        ========================================================= */

        .action-bar {
            position: fixed;

            bottom: 0;

            left: 0;
            right: 0;

            height: 68px;

            display: flex;

            align-items: center;

            justify-content: center;

            background:
                rgba(255, 255, 255, .96);

            border-top: 1px solid var(--border);

            backdrop-filter: blur(14px);

            z-index: 90;
        }

        .action-bar-inner {
            width: 100%;

            max-width: 1180px;

            padding: 0 28px;

            display: flex;

            align-items: center;

            justify-content: space-between;
        }

        .action-summary {
            display: flex;

            align-items: center;

            gap: 10px;

            font-size: 12px;

            color: var(--text-secondary);
        }

        .summary-item {
            display: inline-flex;

            align-items: center;

            gap: 5px;
        }

        .summary-divider {
            width: 1px;

            height: 17px;

            background: var(--border);
        }

        .summary-strong {
            color: var(--text);

            font-weight: 700;
        }

        .action-buttons {
            display: flex;

            gap: 8px;
        }

        /* =========================================================
           TOAST
        ========================================================= */

        .toast {
            position: fixed;

            right: 24px;

            bottom: 88px;

            max-width: 330px;

            padding: 12px 15px;

            display: flex;

            align-items: center;

            gap: 9px;

            background: #111827;

            color: white;

            border-radius: 10px;

            font-size: 12px;

            box-shadow:
                0 12px 30px rgba(0, 0, 0, .18);

            transform:
                translateY(15px);

            opacity: 0;

            pointer-events: none;

            transition:
                opacity .2s ease,
                transform .2s ease;

            z-index: 300;
        }

        .toast.show {
            opacity: 1;

            transform:
                translateY(0);
        }

        .toast svg {
            width: 16px;
            height: 16px;

            color: #86efac;
        }

        /* =========================================================
           MOBILE
        ========================================================= */

        @media (max-width: 900px) {

            .setup-grid {
                grid-template-columns:
                    1fr 1fr;
            }

            .setup-grid .setup-generate {
                grid-column: 1 / -1;
            }

            .builder {
                grid-template-columns:
                    250px
                    minmax(0, 1fr);
            }

            .options-grid {
                grid-template-columns:
                    1fr 1fr;
            }
        }

        @media (max-width: 720px) {

            .topbar {
                padding: 0 16px;
            }

            .brand-subtitle,
            .step-indicator {
                display: none;
            }

            .setup-wrapper {
                padding:
                    16px 14px 0;
            }

            .builder-wrapper {
                padding:
                    14px 14px 90px;
            }

            .setup-grid {
                grid-template-columns:
                    1fr;
            }

            .setup-grid
            .setup-generate {
                grid-column: auto;
            }

            .builder {
                height: auto;

                min-height: 0;

                display: flex;

                flex-direction: column;
            }

            .sidebar {
                max-height: 320px;

                border-right: 0;

                border-bottom:
                    1px solid var(--border);
            }

            .column-list {
                min-height: 0;

                height: auto;

                max-height: 210px;
            }

            .editor {
                min-height: 500px;
            }

            .field-grid {
                grid-template-columns:
                    1fr;
            }

            .field-full {
                grid-column: auto;
            }

            .editor-content {
                padding: 18px;
            }

            .editor-header {
                padding: 12px 15px;
            }

            .action-bar-inner {
                padding: 0 14px;
            }

            .action-summary {
                display: none;
            }

            .action-buttons {
                width: 100%;
            }

            .action-buttons .btn {
                flex: 1;
            }
        }
    </style>
</head>


<body>

<div class="app">

    <!-- =========================================================
         TOP BAR
    ========================================================== -->

    <header class="topbar">

        <div class="brand">

            <div class="brand-icon">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path d="M12 3v18"></path>
                    <path d="M3 12h18"></path>

                    <rect
                        x="4"
                        y="4"
                        width="16"
                        height="16"
                        rx="3"
                    ></rect>
                </svg>

            </div>


            <div class="brand-text">

                <div class="brand-title">
                    Laravel Smart CRUD
                </div>

                <div class="brand-subtitle">
                    Database & CRUD Generator
                </div>

            </div>

        </div>


        <div class="topbar-right">

            <div class="step-indicator">

                <span class="step-dot"></span>

                <span>
                    Step 2 · Define Columns
                </span>

            </div>

        </div>

    </header>

    @if(session()->has('errors') &&
        session('errors')->has('generation'))

        <style>
            .scg-error {
                --error-accent: #f43f5e;
                --error-text: #172033;

                position: relative;
                display: grid;
                grid-template-columns: 108px minmax(0, 1fr);
                gap: 24px;
                align-items: center;
                margin: 24px 0;
                padding: 28px;
                overflow: hidden;
                isolation: isolate;

                background:
                    radial-gradient(
                        circle at 8% 50%,
                        rgba(251, 113, 133, .13),
                        transparent 32%
                    ),
                    linear-gradient(135deg, #ffffff 0%, #fff9fc 100%);

                border: 1px solid rgba(244, 63, 94, .16);
                border-radius: 24px;
                box-shadow:
                    0 20px 55px rgba(42, 31, 70, .07),
                    0 3px 10px rgba(244, 63, 94, .035);

                animation: scg-error-enter .45s ease-out both;
            }

            .scg-error,
            .scg-error * {
                box-sizing: border-box;
            }

            .scg-error::before {
                content: "";
                position: absolute;
                z-index: -1;
                top: -95px;
                right: -65px;
                width: 220px;
                height: 220px;
                background: rgba(251, 113, 133, .07);
                border: 1px solid rgba(244, 63, 94, .09);
                border-radius: 50%;
                pointer-events: none;
            }

            .scg-error__visual {
                display: grid;
                place-items: center;
                width: 108px;
                height: 108px;
                position: relative;
                border-radius: 30px;
                background: linear-gradient(145deg, #fff1f4, #ffe4eb);
                border: 1px solid rgba(244, 63, 94, .12);
            }

            .scg-error__visual::before,
            .scg-error__visual::after {
                content: "";
                position: absolute;
                border: 1px solid rgba(244, 63, 94, .13);
                border-radius: 25px;
                inset: 9px;
                transform: rotate(10deg);
            }

            .scg-error__visual::after {
                inset: -5px;
                border-radius: 34px;
                transform: rotate(-8deg);
            }

            .scg-error__symbol {
                display: grid;
                place-items: center;
                width: 62px;
                height: 62px;
                position: relative;
                z-index: 1;
                color: white;
                background: linear-gradient(145deg, #fb7185, #e11d48);
                border: 1px solid rgba(255, 255, 255, .65);
                border-radius: 21px;
                box-shadow:
                    0 9px 20px rgba(225, 29, 72, .22),
                    inset 0 1px 1px rgba(255, 255, 255, .45);
            }

            .scg-error__content {
                min-width: 0;
                position: relative;
            }

            .scg-error__topline {
                display: flex;
                align-items: center;
                gap: 8px;
                margin-bottom: 10px;
            }

            .scg-error__badge {
                display: inline-flex;
                align-items: center;
                gap: 7px;
                padding: 6px 10px;
                color: #be123c;
                background: #fff0f3;
                border: 1px solid #ffe0e7;
                border-radius: 999px;
                font: 700 11px/1.2 system-ui, sans-serif;
                letter-spacing: .45px;
                text-transform: uppercase;
            }

            .scg-error__dot {
                width: 7px;
                height: 7px;
                flex-shrink: 0;
                background: #f43f5e;
                border-radius: 50%;
                box-shadow: 0 0 0 3px rgba(244, 63, 94, .10);
            }

            .scg-error__title {
                margin: 0 40px 8px 0;
                color: var(--error-text);
                font: 750 21px/1.35 system-ui, sans-serif;
                letter-spacing: -.55px;
            }

            .scg-error__description {
                margin: 0 0 18px;
                max-width: 620px;
                color: #647084;
                font: 400 13px/1.75 system-ui, sans-serif;
            }

            .scg-error__details {
                display: flex;
                align-items: flex-start;
                gap: 11px;
                padding: 14px 15px;
                color: #9f1239;
                background: rgba(255, 240, 244, .85);
                border: 1px solid #ffd7e1;
                border-radius: 13px;
                overflow-wrap: anywhere;
            }

            .scg-error__details-icon {
                display: grid;
                place-items: center;
                flex-shrink: 0;
                width: 30px;
                height: 30px;
                color: #e11d48;
                background: white;
                border: 1px solid #ffe0e7;
                border-radius: 9px;
            }

            .scg-error__details-body {
                min-width: 0;
                flex: 1;
            }

            .scg-error__details-label {
                display: block;
                margin-bottom: 4px;
                color: #be123c;
                font: 700 10px/1.4 system-ui, sans-serif;
                letter-spacing: .8px;
                text-transform: uppercase;
            }

            .scg-error__message {
                display: block;
                margin: 0;
                color: #881337;
                font: 500 12px/1.8 ui-monospace, SFMono-Regular, Consolas, monospace;
                white-space: normal;
                overflow-wrap: anywhere;
            }

            .scg-error__close {
                position: absolute;
                top: 18px;
                right: 18px;
                display: grid;
                place-items: center;
                width: 34px;
                height: 34px;
                padding: 0;
                color: #8c7180;
                background: rgba(255, 255, 255, .85);
                border: 1px solid #f2e4e9;
                border-radius: 12px;
                cursor: pointer;
                transition: .2s ease;
            }

            .scg-error__close:hover {
                color: #be123c;
                background: #fff0f3;
                border-color: #fecdd8;
                transform: rotate(90deg);
            }

            .scg-error__close:focus-visible {
                outline: 3px solid rgba(244, 63, 94, .35);
                outline-offset: 3px;
            }

            .scg-error.is-closing {
                animation: scg-error-exit .22s ease-in forwards;
                pointer-events: none;
            }

            @keyframes scg-error-enter {
                from {
                    opacity: 0;
                    transform: translateY(12px) scale(.99);
                }
                to {
                    opacity: 1;
                    transform: translateY(0) scale(1);
                }
            }

            @keyframes scg-error-exit {
                to {
                    opacity: 0;
                    transform: translateY(-6px);
                }
            }

            @media (max-width: 640px) {
                .scg-error {
                    grid-template-columns: 1fr;
                    gap: 20px;
                    padding: 22px 17px;
                    border-radius: 19px;
                }

                .scg-error__visual {
                    width: 70px;
                    height: 70px;
                    border-radius: 22px;
                }

                .scg-error__visual::before {
                    border-radius: 18px;
                    inset: 6px;
                }

                .scg-error__visual::after {
                    border-radius: 24px;
                }

                .scg-error__symbol {
                    width: 43px;
                    height: 43px;
                    border-radius: 15px;
                }

                .scg-error__symbol svg {
                    width: 23px;
                    height: 23px;
                }

                .scg-error__title {
                    font-size: 19px;
                    padding-right: 15px;
                }

                .scg-error__close {
                    top: 14px;
                    right: 14px;
                }
            }

            @media (prefers-reduced-motion: reduce) {
                .scg-error,
                .scg-error.is-closing {
                    animation: none;
                }

                .scg-error__close {
                    transition: none;
                }
            }
        </style>

        <div class="scg-error" id="scg-generation-error" role="alert">

            <div class="scg-error__visual" aria-hidden="true">
                <div class="scg-error__symbol">
                    <svg width="31" height="31" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor"
                        stroke-width="2.3" stroke-linecap="round">
                        <path d="M18 6 6 18M6 6l12 12"/>
                    </svg>
                </div>
            </div>

            <div class="scg-error__content">

                <div class="scg-error__topline">
                    <span class="scg-error__badge">
                        <span class="scg-error__dot"></span>
                        Generation Error
                    </span>
                </div>

                <h3 class="scg-error__title">
                    CRUD Generation Failed
                </h3>

                <p class="scg-error__description">
                    We couldn't complete the CRUD generation process.
                    Review the diagnostic message below and correct the
                    issue before trying again.
                </p>

                <div class="scg-error__details">
                    <div class="scg-error__details-icon" aria-hidden="true">
                        <svg width="17" height="17" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor"
                            stroke-width="1.8" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16
                                    a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                            <path d="M14 2v6h6M8 13h8M8 17h6"/>
                        </svg>
                    </div>

                    <div class="scg-error__details-body">
                        <span class="scg-error__details-label">
                            Diagnostic details
                        </span>

                        <p class="scg-error__message">
                            {!! nl2br(e(session('errors')->first('generation'))) !!}
                        </p>
                    </div>
                </div>

            </div>

            <button
                type="button"
                class="scg-error__close"
                aria-label="Dismiss error"
                onclick="
                    const alert = document.getElementById('scg-generation-error');
                    if (alert) {
                        alert.classList.add('is-closing');
                        alert.addEventListener('animationend', () => alert.remove(), { once: true });
                    }
                ">
                <svg width="17" height="17" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor"
                    stroke-width="2" stroke-linecap="round">
                    <path d="m18 6-12 12M6 6l12 12"/>
                </svg>
            </button>

        </div>

    @endif

  
    @if($errors->any() && !session('errors')->has('generation'))
        <style>
            .scg-validation {
                position: relative;
                display: flex;
                gap: 15px;
                margin: 22px 0;
                padding: 20px;
                overflow: hidden;
                background: linear-gradient(125deg, #fff8f8, #fff 75%);
                border: 1px solid #f4d5dc;
                border-radius: 17px;
                box-shadow: 0 8px 28px rgba(159, 18, 57, .045);
                animation: scg-validation-in .35s ease-out;
            }

            .scg-validation::before {
                content: "";
                position: absolute;
                inset: 0 auto 0 0;
                width: 4px;
                background: linear-gradient(180deg, #fb7185, #e11d48);
            }

            .scg-validation__icon {
                display: grid;
                place-items: center;
                flex-shrink: 0;
                width: 42px;
                height: 42px;
                color: #e11d48;
                background: #ffe8ee;
                border: 1px solid #fecdd8;
                border-radius: 13px;
            }

            .scg-validation__body {
                flex: 1;
                min-width: 0;
            }

            .scg-validation__heading {
                margin: 1px 0 5px;
                color: #881337;
                font-size: 15px;
                font-weight: 750;
                letter-spacing: -.2px;
            }

            .scg-validation__subtitle {
                margin: 0 0 13px;
                color: #9f5366;
                font-size: 12px;
                line-height: 1.6;
            }

            .scg-validation__list {
                display: grid;
                gap: 7px;
                margin: 0;
                padding: 0;
                list-style: none;
            }

            .scg-validation__item {
                display: flex;
                align-items: flex-start;
                gap: 9px;
                padding: 9px 11px;
                color: #9f1239;
                background: rgba(255, 255, 255, .8);
                border: 1px solid #fce7ed;
                border-radius: 9px;
                font-size: 12px;
                line-height: 1.6;
                overflow-wrap: anywhere;
            }

            .scg-validation__bullet {
                flex-shrink: 0;
                margin-top: 5px;
                width: 6px;
                height: 6px;
                background: #f43f5e;
                border-radius: 50%;
            }

            .scg-validation__count {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                min-width: 23px;
                height: 23px;
                margin-left: 6px;
                padding: 0 6px;
                color: #be123c;
                background: #ffe4eb;
                border-radius: 7px;
                font-size: 11px;
                font-weight: 750;
                vertical-align: middle;
            }

            @keyframes scg-validation-in {
                from {
                    opacity: 0;
                    transform: translateY(-7px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @media (max-width: 480px) {
                .scg-validation {
                    gap: 11px;
                    padding: 15px 13px;
                    border-radius: 13px;
                }

                .scg-validation__icon {
                    width: 34px;
                    height: 34px;
                    border-radius: 10px;
                }
            }

            @media (prefers-reduced-motion: reduce) {
                .scg-validation {
                    animation: none;
                }
            }
        </style>

        <div class="scg-validation" role="alert" aria-labelledby="scg-validation-heading">
            <div class="scg-validation__icon" aria-hidden="true">
                <svg width="22" height="22" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2"
                    stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="9"/>
                    <path d="M12 8v4"/>
                    <path d="M12 16h.01"/>
                </svg>
            </div>

            <div class="scg-validation__body">
                <h3 class="scg-validation__heading" id="scg-validation-heading">
                    Please review your input
                    <span class="scg-validation__count">{{ $errors->count() }}</span>
                </h3>

                <p class="scg-validation__subtitle">
                    A few fields need your attention before we can generate your CRUD.
                </p>

                <ul class="scg-validation__list">
                    @foreach($errors->all() as $error)
                        <li class="scg-validation__item">
                            <span class="scg-validation__bullet"></span>
                            <span>{{ $error }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif


    <!-- =========================================================
         MODEL SETUP
    ========================================================== -->

    <div class="setup-wrapper">

        <div class="setup-card">

            <div class="setup-title">

                <h1>
                    Create your database structure
                </h1>

                <p>
                    Define your model and generate as many columns as you need.
                </p>

            </div>


            <div class="setup-grid">

                <div class="field">

                    <label
                        class="field-label"
                        for="model_name"
                    >
                        Model Name
                    </label>

                    <input
                        type="text"
                        id="model_name"
                        class="input"
                        placeholder="Example: Product"
                        autocomplete="off"
                    >

                </div>


                <div class="field">

                    <label
                        class="field-label"
                        for="column_count"
                    >
                        Number of Columns
                    </label>

                    <input
                        type="number"
                        id="column_count"
                        class="input"
                        min="1"
                        max="500"
                        value="5"
                    >

                </div>


                <div class="setup-generate">

                    <button
                        type="button"
                        id="generate_columns"
                        class="btn btn-primary"
                    >

                        <svg
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path d="M12 5v14"></path>
                            <path d="M5 12h14"></path>
                        </svg>

                        Generate Columns

                    </button>

                </div>

            </div>

        </div>

    </div>


    <!-- =========================================================
         BUILDER
    ========================================================== -->

    <div class="builder-wrapper">

        <form method="post" action="{{ url('smart-crud/generate') }}" id="crud-generator-form">

            @csrf


            <input
                type="hidden"
                name="model_name"
                id="model_name_hidden"
            >


            <div
                class="builder"
                id="builder"
                style="display:none;"
            >

                <!-- =================================================
                     SIDEBAR
                ================================================== -->

                <aside class="sidebar">

                    <div class="sidebar-header">

                        <div class="sidebar-header-top">

                            <span class="sidebar-heading">
                                Columns
                            </span>

                            <span
                                class="column-count-badge"
                                id="column_count_badge"
                            >
                                0
                            </span>

                        </div>


                        <div class="search-box">

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <circle
                                    cx="11"
                                    cy="11"
                                    r="7"
                                ></circle>

                                <path
                                    d="m20 20-4-4"
                                ></path>
                            </svg>


                            <input
                                type="text"
                                id="column_search"
                                class="input"
                                placeholder="Search columns..."
                                autocomplete="off"
                            >

                        </div>

                    </div>


                    <!--
                        IMPORTANT:
                        This container is independently scrollable.
                        It can display 250 / 500 columns.
                    -->

                    <div
                        class="column-list"
                        id="column_list"
                    ></div>


                    <div class="sidebar-footer">

                        <div class="sidebar-progress">

                            <span>
                                Configuration progress
                            </span>

                            <span id="progress_text">
                                0%
                            </span>

                        </div>


                        <div class="progress-bar">

                            <div
                                class="progress-fill"
                                id="progress_fill"
                            ></div>

                        </div>

                    </div>

                </aside>


                <!-- =================================================
                     EDITOR
                ================================================== -->

                <main class="editor">

                    <div
                        class="editor-header"
                        id="editor_header"
                        style="display:none;"
                    >

                        <div class="editor-heading">

                            <div
                                class="editor-number"
                                id="editor_number"
                            >
                                01
                            </div>


                            <div class="editor-title-wrap">

                                <h2
                                    class="editor-title"
                                    id="editor_title"
                                >
                                    Column
                                </h2>


                                <div
                                    class="editor-subtitle"
                                    id="editor_subtitle"
                                >
                                    Configure this database column
                                </div>

                            </div>

                        </div>


                        <div class="editor-actions">

                            <button
                                type="button"
                                class="btn btn-secondary btn-icon"
                                id="duplicate_column"
                                title="Duplicate column"
                            >

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <rect
                                        x="8"
                                        y="8"
                                        width="12"
                                        height="12"
                                        rx="2"
                                    ></rect>

                                    <path
                                        d="M16 8V6a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h2"
                                    ></path>
                                </svg>

                            </button>


                            <button
                                type="button"
                                class="btn btn-danger btn-icon"
                                id="delete_column"
                                title="Delete column"
                            >

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path d="M3 6h18"></path>
                                    <path d="M8 6V4h8v2"></path>
                                    <path d="M19 6l-1 15H6L5 6"></path>
                                    <path d="M10 11v6"></path>
                                    <path d="M14 11v6"></path>
                                </svg>

                            </button>

                        </div>

                    </div>


                    <div
                        class="editor-content"
                        id="editor_content"
                    >

                        <!-- EMPTY STATE -->

                        <div
                            class="empty-state"
                            id="empty_state"
                        >

                            <div class="empty-state-inner">

                                <div class="empty-icon">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <rect
                                            x="3"
                                            y="4"
                                            width="18"
                                            height="16"
                                            rx="3"
                                        ></rect>

                                        <path
                                            d="M8 8h8"
                                        ></path>

                                        <path
                                            d="M8 12h8"
                                        ></path>

                                        <path
                                            d="M8 16h4"
                                        ></path>
                                    </svg>

                                </div>


                                <h2 class="empty-title">
                                    No columns yet
                                </h2>


                                <p class="empty-description">
                                    Enter the number of columns above and click
                                    "Generate Columns" to start building your
                                    database structure.
                                </p>

                            </div>

                        </div>


                        <!-- COLUMN EDITOR -->

                        <div
                            class="editor-inner"
                            id="column_editor"
                            style="display:none;"
                        >

                            <!-- BASIC -->

                            <section class="section">

                                <div class="section-heading">

                                    <span class="section-title">
                                        Basic Information
                                    </span>

                                    <span class="section-description">
                                        Required
                                    </span>

                                </div>


                                <div class="field-grid">

                                    <div class="field field-full">

                                        <label
                                            class="field-label"
                                            for="active_column_name"
                                        >
                                            Column Name
                                        </label>

                                        <input
                                            type="text"
                                            id="active_column_name"
                                            class="input"
                                            placeholder="Example: product_name"
                                            autocomplete="off"
                                        >

                                    </div>


                                    <div class="field field-full">

                                        <label class="field-label">
                                            Column Type
                                        </label>


                                        <div class="type-selector">

                                            <svg
                                                class="type-icon"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                            >
                                                <rect
                                                    x="3"
                                                    y="5"
                                                    width="18"
                                                    height="14"
                                                    rx="2"
                                                ></rect>

                                                <path
                                                    d="M7 9h10"
                                                ></path>

                                                <path
                                                    d="M7 13h7"
                                                ></path>
                                            </svg>


                                            <select
                                                id="active_column_type"
                                                class="select"
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

                                    </div>

                                </div>

                            </section>


                            <!-- TYPE CONFIGURATION -->

                            <section
                                class="section"
                                id="type_specific_section"
                            >

                                <div class="section-heading">

                                    <span class="section-title">
                                        Type Configuration
                                    </span>

                                </div>


                                <!-- STRING -->

                                <div
                                    id="string_options"
                                    class="type-options"
                                >

                                    <div class="field">

                                        <label
                                            class="field-label"
                                            for="active_length"
                                        >
                                            Maximum Length
                                        </label>

                                        <input
                                            type="number"
                                            id="active_length"
                                            class="input"
                                            min="1"
                                            value="255"
                                        >

                                    </div>

                                </div>


                                <!-- DECIMAL -->

                                <div
                                    id="decimal_options"
                                    class="type-options"
                                    style="display:none;"
                                >

                                    <div class="field-grid">

                                        <div class="field">

                                            <label
                                                class="field-label"
                                                for="active_precision"
                                            >
                                                Precision
                                            </label>

                                            <input
                                                type="number"
                                                id="active_precision"
                                                class="input"
                                                min="1"
                                                value="10"
                                            >

                                        </div>


                                        <div class="field">

                                            <label
                                                class="field-label"
                                                for="active_scale"
                                            >
                                                Scale
                                            </label>

                                            <input
                                                type="number"
                                                id="active_scale"
                                                class="input"
                                                min="0"
                                                value="2"
                                            >

                                        </div>

                                    </div>

                                </div>

                            </section>


                            <!-- DEFAULT -->

                            <section class="section">

                                <div class="section-heading">

                                    <span class="section-title">
                                        Default Value
                                    </span>

                                    <span class="section-description">
                                        Optional
                                    </span>

                                </div>


                                <div class="field">

                                    <input
                                        type="text"
                                        id="active_default"
                                        class="input"
                                        placeholder="Leave empty for no default"
                                    >

                                </div>

                            </section>


                            <!-- ADVANCED -->

                            <section class="section">

                                <div
                                    class="advanced"
                                    id="advanced_settings"
                                >

                                    <button
                                        type="button"
                                        class="advanced-header"
                                        id="advanced_toggle"
                                    >

                                        <span class="advanced-left">

                                            <span class="advanced-icon">

                                                <svg
                                                    viewBox="0 0 24 24"
                                                    fill="none"
                                                    stroke="currentColor"
                                                    stroke-width="2"
                                                >
                                                    <circle
                                                        cx="12"
                                                        cy="12"
                                                        r="3"
                                                    ></circle>

                                                    <path
                                                        d="M19.4 15a1.7 1.7 0 0 0 .34 1.88l.06.06-1.42 1.42-.06-.06a1.7 1.7 0 0 0-1.88-.34 1.7 1.7 0 0 0-1.03 1.55V20h-2v-.09a1.7 1.7 0 0 0-1.03-1.55 1.7 1.7 0 0 0-1.88.34l-.06.06-1.42-1.42.06-.06A1.7 1.7 0 0 0 9.4 15a1.7 1.7 0 0 0-1.55-1.03H7v-2h.85A1.7 1.7 0 0 0 9.4 11a1.7 1.7 0 0 0-.34-1.88L9 9.06l1.42-1.42.06.06A1.7 1.7 0 0 0 12.36 8.7 1.7 1.7 0 0 0 13.4 7.15V7h2v.15a1.7 1.7 0 0 0 1.03 1.55 1.7 1.7 0 0 0 1.88-.34l.06-.06 1.42 1.42-.06.06A1.7 1.7 0 0 0 19.4 11c.22.62.8 1.03 1.46 1.03H21v2h-.14A1.7 1.7 0 0 0 19.4 15z"
                                                    ></path>
                                                </svg>

                                            </span>


                                            <span>

                                                <span class="advanced-title">
                                                    Advanced Settings
                                                </span>

                                                <span class="advanced-subtitle">
                                                    Constraints, indexes and database behavior
                                                </span>

                                            </span>

                                        </span>


                                        <svg
                                            class="chevron"
                                            width="16"
                                            height="16"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                        >
                                            <path d="m6 9 6 6 6-6"></path>
                                        </svg>

                                    </button>


                                    <div class="advanced-body">

                                        <div class="options-grid">

                                            <!-- NULLABLE -->

                                            <div class="check-card">

                                                <input
                                                    type="checkbox"
                                                    id="active_nullable"
                                                >

                                                <label
                                                    class="check-label"
                                                    for="active_nullable"
                                                >

                                                    <span class="check-box">

                                                        <svg
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            stroke-width="3"
                                                        >
                                                            <path
                                                                d="m5 12 4 4L19 6"
                                                            ></path>
                                                        </svg>

                                                    </span>


                                                    <span class="check-text">
                                                        Nullable
                                                    </span>

                                                </label>

                                            </div>


                                            <!-- UNIQUE -->

                                            <div class="check-card">

                                                <input
                                                    type="checkbox"
                                                    id="active_unique"
                                                >

                                                <label
                                                    class="check-label"
                                                    for="active_unique"
                                                >

                                                    <span class="check-box">

                                                        <svg
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            stroke-width="3"
                                                        >
                                                            <path
                                                                d="m5 12 4 4L19 6"
                                                            ></path>
                                                        </svg>

                                                    </span>


                                                    <span class="check-text">
                                                        Unique
                                                    </span>

                                                </label>

                                            </div>


                                            <!-- INDEX -->

                                            <div class="check-card">

                                                <input
                                                    type="checkbox"
                                                    id="active_index"
                                                >

                                                <label
                                                    class="check-label"
                                                    for="active_index"
                                                >

                                                    <span class="check-box">

                                                        <svg
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            stroke-width="3"
                                                        >
                                                            <path
                                                                d="m5 12 4 4L19 6"
                                                            ></path>
                                                        </svg>

                                                    </span>


                                                    <span class="check-text">
                                                        Index
                                                    </span>

                                                </label>

                                            </div>


                                            <!-- UNSIGNED -->

                                            <div class="check-card">

                                                <input
                                                    type="checkbox"
                                                    id="active_unsigned"
                                                >

                                                <label
                                                    class="check-label"
                                                    for="active_unsigned"
                                                >

                                                    <span class="check-box">

                                                        <svg
                                                            viewBox="0 0 24 24"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            stroke-width="3"
                                                        >
                                                            <path
                                                                d="m5 12 4 4L19 6"
                                                            ></path>
                                                        </svg>

                                                    </span>


                                                    <span class="check-text">
                                                        Unsigned
                                                    </span>

                                                </label>

                                            </div>

                                        </div>

                                    </div>

                                </div>

                            </section>

                        </div>

                    </div>

                </main>

            </div>


            <!-- =================================================
                 ACTION BAR
            ================================================== -->

            <div
                class="action-bar"
                id="action_bar"
                style="display:none;"
            >

                <div class="action-bar-inner">

                    <div class="action-summary">

                        <span class="summary-item">

                            <span
                                class="summary-strong"
                                id="summary_columns"
                            >
                                0
                            </span>

                            columns

                        </span>


                        <span class="summary-divider"></span>


                        <span class="summary-item">

                            <span
                                class="summary-strong"
                                id="summary_configured"
                            >
                                0
                            </span>

                            configured

                        </span>


                        <span class="summary-divider"></span>


                        <span class="summary-item">

                            Model:

                            <span
                                class="summary-strong"
                                id="summary_model"
                            >
                                —
                            </span>

                        </span>

                    </div>


                    <div class="action-buttons">

                        <button
                            type="button"
                            class="btn btn-secondary"
                            id="add_column_bottom"
                        >

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path d="M12 5v14"></path>
                                <path d="M5 12h14"></path>
                            </svg>

                            Add Column

                        </button>

                        <button
                            type="submit"
                            formaction="{{ url('/smart-crud-generate/preview') }}"
                            formmethod="POST"
                            class="btn btn-primary mt-3"
                        >
                            Preview Code
                        </button>


                        <button
                            type="submit"
                            class="btn btn-success"
                            id="generate_crud"
                        >

                            Generate CRUD

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path d="M5 12h14"></path>
                                <path d="m13 6 6 6-6 6"></path>
                            </svg>

                        </button>

                    </div>

                </div>

            </div>

        </form>

    </div>

</div>


<!-- =========================================================
     TOAST
========================================================= -->

<div
    class="toast"
    id="toast"
>

    <svg
        viewBox="0 0 24 24"
        fill="none"
        stroke="currentColor"
        stroke-width="2"
    >
        <path d="m5 12 4 4L19 6"></path>
    </svg>

    <span id="toast_message">
        Saved
    </span>

</div>


<script>

(() => {

    "use strict";


    /* =========================================================
       STATE
    ========================================================== */

    let columns = [];

    let activeColumnId = null;

    let nextId = 1;

    let draggedId = null;


    /* =========================================================
       DOM
    ========================================================== */

    const modelInput =
        document.getElementById("model_name");

    const modelHidden =
        document.getElementById("model_name_hidden");

    const columnCountInput =
        document.getElementById("column_count");

    const generateColumnsButton =
        document.getElementById("generate_columns");

    const builder =
        document.getElementById("builder");

    const columnList =
        document.getElementById("column_list");

    const columnSearch =
        document.getElementById("column_search");

    const columnCountBadge =
        document.getElementById("column_count_badge");

    const editorHeader =
        document.getElementById("editor_header");

    const emptyState =
        document.getElementById("empty_state");

    const columnEditor =
        document.getElementById("column_editor");

    const actionBar =
        document.getElementById("action_bar");

    const editorNumber =
        document.getElementById("editor_number");

    const editorTitle =
        document.getElementById("editor_title");

    const editorSubtitle =
        document.getElementById("editor_subtitle");

    const activeName =
        document.getElementById("active_column_name");

    const activeType =
        document.getElementById("active_column_type");

    const activeLength =
        document.getElementById("active_length");

    const activePrecision =
        document.getElementById("active_precision");

    const activeScale =
        document.getElementById("active_scale");

    const activeDefault =
        document.getElementById("active_default");

    const activeNullable =
        document.getElementById("active_nullable");

    const activeUnique =
        document.getElementById("active_unique");

    const activeIndex =
        document.getElementById("active_index");

    const activeUnsigned =
        document.getElementById("active_unsigned");

    const stringOptions =
        document.getElementById("string_options");

    const decimalOptions =
        document.getElementById("decimal_options");

    const typeSpecificSection =
        document.getElementById(
            "type_specific_section"
        );

    const advancedSettings =
        document.getElementById(
            "advanced_settings"
        );

    const advancedToggle =
        document.getElementById(
            "advanced_toggle"
        );

    const duplicateButton =
        document.getElementById(
            "duplicate_column"
        );

    const deleteButton =
        document.getElementById(
            "delete_column"
        );

    const addColumnBottom =
        document.getElementById(
            "add_column_bottom"
        );

    const summaryColumns =
        document.getElementById(
            "summary_columns"
        );

    const summaryConfigured =
        document.getElementById(
            "summary_configured"
        );

    const summaryModel =
        document.getElementById(
            "summary_model"
        );

    const progressText =
        document.getElementById(
            "progress_text"
        );

    const progressFill =
        document.getElementById(
            "progress_fill"
        );

    const toast =
        document.getElementById("toast");

    const toastMessage =
        document.getElementById(
            "toast_message"
        );

    const form =
        document.getElementById(
            "crud-generator-form"
        );


    /* =========================================================
       CREATE COLUMN
    ========================================================== */

    function createColumn() {

        return {

            id: nextId++,

            name: "",

            type: "string",

            length: 255,

            precision: 10,

            scale: 2,

            default: "",

            nullable: false,

            unique: false,

            index: false,

            unsigned: false
        };
    }


    /* =========================================================
       GENERATE
    ========================================================== */

    generateColumnsButton.addEventListener(
        "click",
        generateColumns
    );


    function generateColumns() {

        const count =
            parseInt(
                columnCountInput.value,
                10
            );


        if (
            !count ||
            count < 1 ||
            count > 500
        ) {

            showToast(
                "Please enter between 1 and 500 columns."
            );

            columnCountInput.focus();

            return;
        }


        columns = [];

        nextId = 1;


        /*
         * Create columns efficiently.
         */

        for (
            let i = 0;
            i < count;
            i++
        ) {

            columns.push(
                createColumn()
            );
        }


        activeColumnId =
            columns[0]?.id ?? null;


        render();


        /*
         * Important:
         * Scroll the column list to top.
         */

        requestAnimationFrame(() => {

            columnList.scrollTop = 0;

        });


        showToast(
            `${count} columns generated.`
        );
    }


    /* =========================================================
       ADD
    ========================================================== */

    addColumnBottom.addEventListener(
        "click",
        addColumn
    );


    function addColumn() {

        if (columns.length >= 500) {

            showToast(
                "Maximum 500 columns allowed."
            );

            return;
        }


        const column =
            createColumn();


        columns.push(column);


        activeColumnId =
            column.id;


        render();


        requestAnimationFrame(() => {

            /*
             * Automatically scroll to bottom
             * when adding a new column.
             */

            columnList.scrollTop =
                columnList.scrollHeight;


            activeName.focus();

        });


        showToast(
            "New column added."
        );
    }


    /* =========================================================
       ACTIVE
    ========================================================== */

    function getActiveColumn() {

        return columns.find(
            column =>
                column.id ===
                activeColumnId
        );
    }


    function selectColumn(id) {

        saveEditorToState();

        activeColumnId = id;

        renderEditor();

        renderColumnList();

        updateSummary();

        updateProgress();
    }


    /* =========================================================
       DUPLICATE
    ========================================================== */

    duplicateButton.addEventListener(
        "click",
        duplicateActiveColumn
    );


    function duplicateActiveColumn() {

        if (columns.length >= 500) {

            showToast(
                "Maximum 500 columns allowed."
            );

            return;
        }


        const source =
            getActiveColumn();


        if (!source) {
            return;
        }


        const copy = {

            ...source,

            id: nextId++,

            name: source.name
                ? `${source.name}_copy`
                : ""
        };


        const index =
            columns.findIndex(
                column =>
                    column.id ===
                    source.id
            );


        columns.splice(
            index + 1,
            0,
            copy
        );


        activeColumnId =
            copy.id;


        render();


        showToast(
            "Column duplicated."
        );
    }


    /* =========================================================
       DELETE
    ========================================================== */

    deleteButton.addEventListener(
        "click",
        deleteActiveColumn
    );


    function deleteActiveColumn() {

        if (!activeColumnId) {
            return;
        }


        if (columns.length <= 1) {

            showToast(
                "At least one column is required."
            );

            return;
        }


        const index =
            columns.findIndex(
                column =>
                    column.id ===
                    activeColumnId
            );


        if (index === -1) {
            return;
        }


        const deleted =
            columns[index];


        columns.splice(
            index,
            1
        );


        const nextColumn =
            columns[index] ||
            columns[index - 1] ||
            columns[0];


        activeColumnId =
            nextColumn?.id ??
            null;


        render();


        showToast(
            deleted.name
                ? `"${deleted.name}" deleted.`
                : "Column deleted."
        );
    }


    /* =========================================================
       RENDER
    ========================================================== */

    function render() {

        builder.style.display =
            "grid";

        actionBar.style.display =
            "flex";


        emptyState.style.display =
            columns.length
                ? "none"
                : "flex";


        editorHeader.style.display =
            columns.length
                ? "flex"
                : "none";


        columnEditor.style.display =
            columns.length
                ? "block"
                : "none";


        renderColumnList();


        if (columns.length) {

            renderEditor();

        }


        updateSummary();

        updateProgress();

        syncModelName();
    }


    /* =========================================================
       COLUMN LIST
    ========================================================== */

    function renderColumnList() {

        const search =
            columnSearch.value
                .trim()
                .toLowerCase();


        columnList.innerHTML = "";


        const fragment =
            document.createDocumentFragment();


        let visibleCount = 0;


        columns.forEach(
            (column, index) => {

                const typeLabel =
                    getTypeLabel(
                        column.type
                    );


                const matches =
                    !search ||
                    column.name
                        .toLowerCase()
                        .includes(search) ||
                    typeLabel
                        .toLowerCase()
                        .includes(search);


                if (!matches) {
                    return;
                }


                visibleCount++;


                const item =
                    document.createElement(
                        "div"
                    );


                item.className =
                    "column-item";


                if (
                    column.id ===
                    activeColumnId
                ) {

                    item.classList.add(
                        "active"
                    );
                }


                item.draggable = true;

                item.dataset.id =
                    column.id;


                const configured =
                    isColumnConfigured(
                        column
                    );


                item.innerHTML = `

                    <div class="drag-handle">

                        <svg
                            viewBox="0 0 24 24"
                            fill="currentColor"
                        >
                            <circle
                                cx="8"
                                cy="6"
                                r="1.3"
                            ></circle>

                            <circle
                                cx="16"
                                cy="6"
                                r="1.3"
                            ></circle>

                            <circle
                                cx="8"
                                cy="12"
                                r="1.3"
                            ></circle>

                            <circle
                                cx="16"
                                cy="12"
                                r="1.3"
                            ></circle>

                            <circle
                                cx="8"
                                cy="18"
                                r="1.3"
                            ></circle>

                            <circle
                                cx="16"
                                cy="18"
                                r="1.3"
                            ></circle>
                        </svg>

                    </div>


                    <div class="column-number">
                        ${String(index + 1).padStart(2, "0")}
                    </div>


                    <div class="column-main">

                        <div
                            class="column-name ${
                                column.name
                                    ? ""
                                    : "empty"
                            }"
                        >
                            ${
                                escapeHtml(
                                    column.name ||
                                    "Untitled column"
                                )
                            }
                        </div>


                        <div class="column-meta">

                            <span
                                class="column-status-dot ${
                                    configured
                                        ? "complete"
                                        : "warning"
                                }"
                            ></span>

                            ${escapeHtml(typeLabel)}

                            ${
                                column.unique
                                    ? " · Unique"
                                    : ""
                            }

                            ${
                                column.index
                                    ? " · Indexed"
                                    : ""
                            }

                        </div>

                    </div>

                `;


                item.addEventListener(
                    "click",
                    () => {

                        selectColumn(
                            column.id
                        );

                    }
                );


                item.addEventListener(
                    "dragstart",
                    handleDragStart
                );


                item.addEventListener(
                    "dragover",
                    handleDragOver
                );


                item.addEventListener(
                    "drop",
                    handleDrop
                );


                item.addEventListener(
                    "dragend",
                    handleDragEnd
                );


                fragment.appendChild(item);

            }
        );


        if (!visibleCount) {

            const empty =
                document.createElement(
                    "div"
                );


            empty.style.padding =
                "30px 10px";


            empty.style.textAlign =
                "center";


            empty.style.fontSize =
                "11px";


            empty.style.color =
                "#9ca3af";


            empty.textContent =
                "No matching columns.";


            fragment.appendChild(
                empty
            );
        }


        columnList.appendChild(
            fragment
        );


        columnCountBadge.textContent =
            columns.length;
    }


    /* =========================================================
       DRAG
    ========================================================== */

    function handleDragStart(event) {

        draggedId =
            Number(
                event.currentTarget
                    .dataset
                    .id
            );


        event.currentTarget
            .classList
            .add("dragging");


        event.dataTransfer.effectAllowed =
            "move";
    }


    function handleDragOver(event) {

        event.preventDefault();

        event.dataTransfer.dropEffect =
            "move";
    }


    function handleDrop(event) {

        event.preventDefault();


        const targetId =
            Number(
                event.currentTarget
                    .dataset
                    .id
            );


        if (
            !draggedId ||
            draggedId === targetId
        ) {

            return;
        }


        const fromIndex =
            columns.findIndex(
                column =>
                    column.id ===
                    draggedId
            );


        const toIndex =
            columns.findIndex(
                column =>
                    column.id ===
                    targetId
            );


        if (
            fromIndex < 0 ||
            toIndex < 0
        ) {

            return;
        }


        const moved =
            columns.splice(
                fromIndex,
                1
            )[0];


        columns.splice(
            toIndex,
            0,
            moved
        );


        render();


        showToast(
            "Column order updated."
        );
    }


    function handleDragEnd(event) {

        event.currentTarget
            .classList
            .remove("dragging");


        draggedId = null;
    }


    /* =========================================================
       EDITOR
    ========================================================== */

    function renderEditor() {

        const column =
            getActiveColumn();


        if (!column) {
            return;
        }


        const index =
            columns.findIndex(
                item =>
                    item.id ===
                    column.id
            );


        editorNumber.textContent =
            String(index + 1)
                .padStart(2, "0");


        editorTitle.textContent =
            column.name ||
            "Untitled column";


        editorSubtitle.textContent =
            `${getTypeLabel(column.type)} · Column ${index + 1}`;


        activeName.value =
            column.name;


        activeType.value =
            column.type;


        activeLength.value =
            column.length ?? 255;


        activePrecision.value =
            column.precision ?? 10;


        activeScale.value =
            column.scale ?? 2;


        activeDefault.value =
            column.default ?? "";


        activeNullable.checked =
            Boolean(
                column.nullable
            );


        activeUnique.checked =
            Boolean(
                column.unique
            );


        activeIndex.checked =
            Boolean(
                column.index
            );


        activeUnsigned.checked =
            Boolean(
                column.unsigned
            );


        updateTypeOptions();


        advancedSettings
            .classList
            .remove("open");
    }


    /* =========================================================
       SAVE EDITOR
    ========================================================== */

    function saveEditorToState() {

        const column =
            getActiveColumn();


        if (!column) {
            return;
        }


        column.name =
            activeName.value.trim();


        column.type =
            activeType.value;


        column.length =
            activeLength.value;


        column.precision =
            activePrecision.value;


        column.scale =
            activeScale.value;


        column.default =
            activeDefault.value;


        column.nullable =
            activeNullable.checked;


        column.unique =
            activeUnique.checked;


        column.index =
            activeIndex.checked;


        column.unsigned =
            activeUnsigned.checked;
    }


    /* =========================================================
       LIVE INPUT
    ========================================================== */

    [
        activeName,
        activeLength,
        activePrecision,
        activeScale,
        activeDefault
    ].forEach(
        element => {

            element.addEventListener(
                "input",
                () => {

                    saveEditorToState();

                    updateEditorHeader();

                    renderColumnList();

                    updateSummary();

                    updateProgress();

                }
            );

        }
    );


    [
        activeNullable,
        activeUnique,
        activeIndex,
        activeUnsigned
    ].forEach(
        element => {

            element.addEventListener(
                "change",
                () => {

                    saveEditorToState();

                    renderColumnList();

                    updateSummary();

                    updateProgress();

                }
            );

        }
    );


    activeType.addEventListener(
        "change",
        () => {

            saveEditorToState();

            updateTypeOptions();

            updateEditorHeader();

            renderColumnList();

            updateSummary();

        }
    );


    /* =========================================================
       HEADER
    ========================================================== */

    function updateEditorHeader() {

        const column =
            getActiveColumn();


        if (!column) {
            return;
        }


        const index =
            columns.findIndex(
                item =>
                    item.id ===
                    column.id
            );


        editorTitle.textContent =
            column.name ||
            "Untitled column";


        editorSubtitle.textContent =
            `${getTypeLabel(column.type)} · Column ${index + 1}`;
    }


    /* =========================================================
       TYPE OPTIONS
    ========================================================== */

    function updateTypeOptions() {

        const type =
            activeType.value;


        stringOptions.style.display =
            type === "string"
                ? "block"
                : "none";


        decimalOptions.style.display =
            type === "decimal"
                ? "block"
                : "none";


        typeSpecificSection.style.display =
            (
                type === "string" ||
                type === "decimal"
            )
                ? "block"
                : "none";
    }


    /* =========================================================
       ADVANCED
    ========================================================== */

    advancedToggle.addEventListener(
        "click",
        () => {

            advancedSettings
                .classList
                .toggle("open");

        }
    );


    /* =========================================================
       SEARCH
    ========================================================== */

    columnSearch.addEventListener(
        "input",
        () => {

            renderColumnList();

        }
    );


    /* =========================================================
       MODEL
    ========================================================== */

    modelInput.addEventListener(
        "input",
        () => {

            syncModelName();

            updateSummary();

        }
    );


    function syncModelName() {

        modelHidden.value =
            modelInput.value.trim();
    }


    /* =========================================================
       SUMMARY
    ========================================================== */

    function updateSummary() {

        const configured =
            columns.filter(
                isColumnConfigured
            ).length;


        summaryColumns.textContent =
            columns.length;


        summaryConfigured.textContent =
            configured;


        summaryModel.textContent =
            modelInput.value.trim() ||
            "—";
    }


    function updateProgress() {

        if (!columns.length) {

            progressText.textContent =
                "0%";

            progressFill.style.width =
                "0%";

            return;
        }


        const configured =
            columns.filter(
                isColumnConfigured
            ).length;


        const percentage =
            Math.round(
                (
                    configured /
                    columns.length
                ) * 100
            );


        progressText.textContent =
            `${percentage}%`;


        progressFill.style.width =
            `${percentage}%`;
    }


    function isColumnConfigured(
        column
    ) {

        return Boolean(
            column.name &&
            column.name.trim()
        );
    }


    /* =========================================================
       SUBMIT
    ========================================================== */

    form.addEventListener(
        "submit",
        event => {

            saveEditorToState();

            syncModelName();


            if (
                !modelInput.value.trim()
            ) {

                event.preventDefault();

                showToast(
                    "Please enter a model name."
                );

                modelInput.focus();

                return;
            }


            if (!columns.length) {

                event.preventDefault();

                showToast(
                    "Please create at least one column."
                );

                return;
            }


            const invalid =
                columns.find(
                    column =>
                        !column.name.trim()
                );


            if (invalid) {

                event.preventDefault();

                activeColumnId =
                    invalid.id;


                render();


                showToast(
                    "Please give every column a name."
                );


                setTimeout(
                    () => {

                        activeName.focus();

                    },
                    50
                );


                return;
            }


            buildSubmitFields();

        }
    );


    /* =========================================================
       LARAVEL HIDDEN FIELDS
    ========================================================== */

    function buildSubmitFields() {

        document
            .querySelectorAll(
                ".generated-column-field"
            )
            .forEach(
                field =>
                    field.remove()
            );


        columns.forEach(
            (column, index) => {

                const number =
                    index + 1;


                addHiddenField(
                    `columns[${number}][name]`,
                    column.name
                );


                addHiddenField(
                    `columns[${number}][type]`,
                    column.type
                );


                if (
                    column.type ===
                    "string"
                ) {

                    addHiddenField(
                        `columns[${number}][length]`,
                        column.length
                    );
                }


                if (
                    column.type ===
                    "decimal"
                ) {

                    addHiddenField(
                        `columns[${number}][precision]`,
                        column.precision
                    );


                    addHiddenField(
                        `columns[${number}][scale]`,
                        column.scale
                    );
                }


                if (
                    column.default !==
                    ""
                ) {

                    addHiddenField(
                        `columns[${number}][default]`,
                        column.default
                    );
                }


                if (column.nullable) {

                    addHiddenField(
                        `columns[${number}][nullable]`,
                        "1"
                    );
                }


                if (column.unique) {

                    addHiddenField(
                        `columns[${number}][unique]`,
                        "1"
                    );
                }


                if (column.index) {

                    addHiddenField(
                        `columns[${number}][index]`,
                        "1"
                    );
                }


                if (column.unsigned) {

                    addHiddenField(
                        `columns[${number}][unsigned]`,
                        "1"
                    );
                }

            }
        );
    }


    function addHiddenField(
        name,
        value
    ) {

        const input =
            document.createElement(
                "input"
            );


        input.type = "hidden";

        input.name = name;

        input.value =
            value ?? "";


        input.className =
            "generated-column-field";


        form.appendChild(input);
    }


    /* =========================================================
       TYPE LABEL
    ========================================================== */

    function getTypeLabel(
        type
    ) {

        const labels = {

            string:
                "String",

            text:
                "Text",

            longText:
                "Long Text",

            integer:
                "Integer",

            bigInteger:
                "Big Integer",

            smallInteger:
                "Small Integer",

            tinyInteger:
                "Tiny Integer",

            unsignedInteger:
                "Unsigned Integer",

            unsignedBigInteger:
                "Unsigned Big Integer",

            boolean:
                "Boolean",

            decimal:
                "Decimal",

            float:
                "Float",

            double:
                "Double",

            date:
                "Date",

            dateTime:
                "Date Time",

            time:
                "Time",

            timestamp:
                "Timestamp",

            json:
                "JSON"
        };


        return (
            labels[type] ||
            type
        );
    }


    /* =========================================================
       ESCAPE
    ========================================================== */

    function escapeHtml(
        value
    ) {

        const div =
            document.createElement(
                "div"
            );


        div.textContent =
            value;


        return div.innerHTML;
    }


    /* =========================================================
       TOAST
    ========================================================== */

    let toastTimer;


    function showToast(
        message
    ) {

        toastMessage.textContent =
            message;


        toast.classList.add(
            "show"
        );


        clearTimeout(
            toastTimer
        );


        toastTimer =
            setTimeout(
                () => {

                    toast.classList.remove(
                        "show"
                    );

                },
                2200
            );
    }


    /* =========================================================
       KEYBOARD
    ========================================================== */

    document.addEventListener(
        "keydown",
        event => {

            /*
             * Ctrl + Enter
             */

            if (
                (
                    event.ctrlKey ||
                    event.metaKey
                ) &&
                event.key === "Enter"
            ) {

                event.preventDefault();

                form.requestSubmit();

                return;
            }


            /*
             * Ctrl + D
             */

            if (
                (
                    event.ctrlKey ||
                    event.metaKey
                ) &&
                event.key.toLowerCase() === "d"
            ) {

                event.preventDefault();

                duplicateActiveColumn();

                return;
            }


            /*
             * Delete active column
             * only when not typing.
             */

            const tag =
                document.activeElement?.tagName;


            if (
                event.key === "Delete" &&
                tag !== "INPUT" &&
                tag !== "SELECT" &&
                tag !== "TEXTAREA"
            ) {

                deleteActiveColumn();

            }

        }
    );


    /* =========================================================
       INITIAL
    ========================================================== */

    columnCountInput.value = 5;

})();

</script>

</body>
</html>