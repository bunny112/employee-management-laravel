<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Employee Management</title>

    <style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    :root {
        --bg-dark: #070b18;
        --bg-mid: #0d1330;
        --primary: #7c5cff;
        --primary-light: #9b87ff;
        --cyan: #38bdf8;
        --text: #f8fafc;
        --muted: #94a3b8;
        --card: rgba(15, 23, 42, 0.72);
        --border: rgba(148, 163, 184, 0.16);
    }

    html {
        scroll-behavior: smooth;
    }

    body {
        min-height: 100vh;
        font-family: Inter, ui-sans-serif, system-ui, -apple-system,
            BlinkMacSystemFont, "Segoe UI", sans-serif;
        color: var(--text);

        background:
            radial-gradient(
                circle at 10% 10%,
                rgba(124, 92, 255, 0.22),
                transparent 28%
            ),
            radial-gradient(
                circle at 90% 15%,
                rgba(56, 189, 248, 0.14),
                transparent 25%
            ),
            radial-gradient(
                circle at 50% 100%,
                rgba(124, 92, 255, 0.16),
                transparent 30%
            ),
            linear-gradient(
                135deg,
                #050816 0%,
                #0a1024 45%,
                #080b19 100%
            );

        background-attachment: fixed;
        overflow-x: hidden;
    }

    body::before {
        content: "";
        position: fixed;
        inset: 0;
        pointer-events: none;
        opacity: 0.35;

        background-image:
            linear-gradient(
                rgba(255,255,255,0.025) 1px,
                transparent 1px
            ),
            linear-gradient(
                90deg,
                rgba(255,255,255,0.025) 1px,
                transparent 1px
            );

        background-size: 45px 45px;
        mask-image: linear-gradient(
            to bottom,
            black,
            transparent 85%
        );
    }

    .container {
        width: min(1180px, calc(100% - 32px));
        margin: 0 auto;
        padding: 45px 0 60px;
        position: relative;
        z-index: 1;
    }

    /* ================= HEADER ================= */

    .header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 25px;
        margin-bottom: 32px;
    }

    .brand {
        display: flex;
        align-items: center;
        gap: 15px;
    }

    .brand-icon {
        width: 54px;
        height: 54px;

        display: grid;
        place-items: center;

        border-radius: 16px;

        background:
            linear-gradient(
                135deg,
                #7c5cff,
                #4f46e5
            );

        color: white;
        font-size: 22px;
        font-weight: 800;

        box-shadow:
            0 0 35px rgba(124, 92, 255, 0.38),
            inset 0 1px 0 rgba(255,255,255,0.25);
    }

    h1 {
        font-size: clamp(25px, 4vw, 36px);
        letter-spacing: -1px;
        line-height: 1.1;
    }

    .subtitle {
        color: var(--muted);
        margin-top: 7px;
        font-size: 14px;
    }

    /* ================= BUTTONS ================= */

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;

        padding: 11px 17px;

        border-radius: 10px;
        border: 1px solid transparent;

        text-decoration: none;
        cursor: pointer;

        font-size: 13px;
        font-weight: 650;

        transition:
            transform 0.2s ease,
            box-shadow 0.2s ease,
            background 0.2s ease;
    }

    .btn:hover {
        transform: translateY(-2px);
    }

    .btn-primary {
        color: white;

        background:
            linear-gradient(
                135deg,
                #8b5cf6,
                #6366f1
            );

        box-shadow:
            0 10px 30px rgba(99, 102, 241, 0.30);
    }

    .btn-primary:hover {
        box-shadow:
            0 14px 40px rgba(124, 92, 255, 0.45);
    }

    .btn-edit {
        background: rgba(56, 189, 248, 0.10);
        color: #67e8f9;
        border-color: rgba(56, 189, 248, 0.18);
    }

    .btn-edit:hover {
        background: rgba(56, 189, 248, 0.18);
    }

    .btn-delete {
        background: rgba(239, 68, 68, 0.10);
        color: #fca5a5;
        border-color: rgba(239, 68, 68, 0.16);
    }

    .btn-delete:hover {
        background: rgba(239, 68, 68, 0.18);
    }

    /* ================= STATS ================= */

    .stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 22px;
    }

    .stat-card {
        position: relative;
        overflow: hidden;

        padding: 22px;

        background:
            linear-gradient(
                145deg,
                rgba(22, 30, 58, 0.78),
                rgba(10, 16, 35, 0.72)
            );

        border: 1px solid var(--border);
        border-radius: 17px;

        backdrop-filter: blur(18px);

        box-shadow:
            0 20px 50px rgba(0,0,0,0.20),
            inset 0 1px 0 rgba(255,255,255,0.04);
    }

    .stat-card::after {
        content: "";
        position: absolute;

        width: 120px;
        height: 120px;

        right: -45px;
        top: -50px;

        border-radius: 50%;

        background: rgba(124, 92, 255, 0.14);
        filter: blur(10px);
    }

    .stat-label {
        color: #94a3b8;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: 0.7px;
        margin-bottom: 9px;
    }

    .stat-value {
        font-size: 30px;
        font-weight: 800;

        background:
            linear-gradient(
                90deg,
                #ffffff,
                #b9b1ff
            );

        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    /* ================= ALERT ================= */

    .alert {
        margin-bottom: 20px;
        padding: 14px 17px;

        border-radius: 11px;

        color: #6ee7b7;

        background: rgba(16, 185, 129, 0.10);
        border: 1px solid rgba(52, 211, 153, 0.20);

        backdrop-filter: blur(12px);

        font-size: 14px;
        font-weight: 600;
    }

    /* ================= TABLE CARD ================= */

    .table-wrapper {
        overflow: hidden;

        background:
            linear-gradient(
                145deg,
                rgba(15, 23, 42, 0.82),
                rgba(7, 12, 27, 0.88)
            );

        border: 1px solid rgba(148, 163, 184, 0.14);
        border-radius: 19px;

        backdrop-filter: blur(20px);

        box-shadow:
            0 30px 80px rgba(0,0,0,0.30),
            inset 0 1px 0 rgba(255,255,255,0.035);
    }

    .table-header {
        padding: 21px 23px;

        border-bottom:
            1px solid rgba(148,163,184,0.12);
    }

    .table-header h2 {
        font-size: 18px;
        color: #f8fafc;
    }

    .table-header p {
        margin-top: 5px;
        color: #64748b;
        font-size: 13px;
    }

    .table-scroll {
        overflow-x: auto;
    }

    table {
        width: 100%;
        min-width: 850px;
        border-collapse: collapse;
    }

    th,
    td {
        padding: 17px 20px;
        text-align: left;

        border-bottom:
            1px solid rgba(148,163,184,0.08);

        white-space: nowrap;
    }

    th {
        background: rgba(255,255,255,0.025);

        color: #64748b;

        font-size: 11px;
        text-transform: uppercase;
        letter-spacing: 0.7px;
    }

    td {
        color: #cbd5e1;
        font-size: 14px;
    }

    tbody tr {
        transition:
            background 0.2s ease,
            transform 0.2s ease;
    }

    tbody tr:hover {
        background: rgba(124, 92, 255, 0.055);
    }

    tbody tr:last-child td {
        border-bottom: 0;
    }

    .employee-name {
        color: #f8fafc;
        font-weight: 700;
    }

    .email {
        color: #94a3b8;
    }

    /* ================= BADGE ================= */

    .badge {
        display: inline-flex;
        align-items: center;

        padding: 6px 10px;

        border-radius: 999px;

        background: rgba(124, 92, 255, 0.12);
        color: #b9a8ff;

        border: 1px solid rgba(124, 92, 255, 0.18);

        font-size: 11px;
        font-weight: 650;
    }

    .actions {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    form {
        display: inline;
    }

    /* ================= EMPTY ================= */

    .empty {
        text-align: center;
        padding: 70px 20px !important;
        color: #64748b;
    }

    .empty-icon {
        font-size: 38px;
        margin-bottom: 12px;
        opacity: 0.8;
    }

    .empty strong {
        display: block;
        color: #e2e8f0;
        margin-bottom: 6px;
        font-size: 15px;
    }

    /* ================= SCROLLBAR ================= */

    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #080d1d;
    }

    ::-webkit-scrollbar-thumb {
        background: #30395c;
        border-radius: 20px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #6253b5;
    }

    /* ================= RESPONSIVE ================= */

    @media (max-width: 768px) {

        .container {
            width: calc(100% - 20px);
            padding: 28px 0 40px;
        }

        .header {
            flex-direction: column;
            align-items: flex-start;
        }

        .btn-primary {
            width: 100%;
        }

        .stats {
            grid-template-columns: 1fr;
        }

        .stat-card {
            padding: 18px;
        }

        .table-wrapper {
            border-radius: 15px;
        }

        .table-header {
            padding: 18px;
        }
    }

    @media (max-width: 480px) {

        .container {
            width: calc(100% - 14px);
        }

        .brand-icon {
            width: 46px;
            height: 46px;
            border-radius: 13px;
        }

        h1 {
            font-size: 25px;
        }

        .subtitle {
            font-size: 12px;
        }
    }
</style>
</head>

<body>

<div class="container">

    <!-- Header -->
    <div class="header">

        <div class="brand">
            <div class="brand-icon">E</div>

            <div>
                <h1>Employee Management</h1>
                <p class="subtitle">
                    Manage your team members efficiently.
                </p>
            </div>
        </div>

        <a href="{{ route('employees.create') }}" class="btn btn-primary">
            <span>＋</span>
            Add Employee
        </a>

    </div>


    <!-- Stats -->
    <div class="stats">

        <div class="stat-card">
            <div class="stat-label">Total Employees</div>
            <div class="stat-value">{{ $employees->count() }}</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Departments</div>
            <div class="stat-value">
                {{ $employees->pluck('department')->unique()->count() }}
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Active Records</div>
            <div class="stat-value">{{ $employees->count() }}</div>
        </div>

    </div>


    <!-- Success Message -->
    @if(session('success'))

        <div class="alert">
            ✓ {{ session('success') }}
        </div>

    @endif


    <!-- Employee Table -->
    <div class="table-wrapper">

        <div class="table-header">
            <h2>Employees</h2>
            <p>View and manage all employee records.</p>
        </div>

        <div class="table-scroll">

            <table>

                <thead>
                    <tr>
                        <th>Employee</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Department</th>
                        <th>Position</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>

                @forelse($employees as $employee)

                    <tr>

                        <td>
                            <div class="employee-name">
                                {{ $employee->name }}
                            </div>
                        </td>

                        <td>
                            <span class="email">
                                {{ $employee->email }}
                            </span>
                        </td>

                        <td>
                            {{ $employee->phone ?? '-' }}
                        </td>

                        <td>
                            <span class="badge">
                                {{ $employee->department }}
                            </span>
                        </td>

                        <td>
                            {{ $employee->position }}
                        </td>

                        <td>

                            <div class="actions">

                                <a
                                    href="{{ route('employees.edit', $employee) }}"
                                    class="btn btn-edit"
                                >
                                    Edit
                                </a>

                                <form
                                    action="{{ route('employees.destroy', $employee) }}"
                                    method="POST"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="btn btn-delete"
                                        onclick="return confirm('Are you sure you want to delete this employee?')"
                                    >
                                        Delete
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="6" class="empty">

                            <div class="empty-icon">👥</div>

                            <strong>No employees found</strong>

                            Add your first employee to get started.

                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

</body>
</html>