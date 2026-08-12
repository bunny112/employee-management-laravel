<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Add Employee | Employee Management</title>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            min-height: 100vh;
            font-family: Inter, ui-sans-serif, system-ui, -apple-system,
                BlinkMacSystemFont, "Segoe UI", sans-serif;
            color: #f8fafc;

            background:
                radial-gradient(
                    circle at 10% 10%,
                    rgba(124, 92, 255, 0.24),
                    transparent 28%
                ),
                radial-gradient(
                    circle at 90% 15%,
                    rgba(56, 189, 248, 0.15),
                    transparent 25%
                ),
                radial-gradient(
                    circle at 50% 100%,
                    rgba(124, 92, 255, 0.14),
                    transparent 30%
                ),
                linear-gradient(
                    135deg,
                    #050816,
                    #0a1024 50%,
                    #080b19
                );

            background-attachment: fixed;
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;

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
            opacity: 0.35;
        }

        .page {
            width: min(900px, calc(100% - 30px));
            margin: 0 auto;
            padding: 45px 0 60px;
            position: relative;
            z-index: 1;
        }

        /* Top navigation */

        .topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 25px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-icon {
            width: 42px;
            height: 42px;

            display: grid;
            place-items: center;

            border-radius: 12px;

            background:
                linear-gradient(
                    135deg,
                    #8b5cf6,
                    #6366f1
                );

            color: white;
            font-weight: 800;

            box-shadow:
                0 0 25px rgba(124, 92, 255, 0.35);
        }

        .brand-name {
            font-weight: 700;
            font-size: 15px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 7px;

            color: #94a3b8;
            text-decoration: none;

            font-size: 13px;
            font-weight: 600;

            transition: 0.2s ease;
        }

        .back-link:hover {
            color: #c4b5fd;
        }

        /* Heading */

        .heading {
            margin-bottom: 22px;
        }

        .heading h1 {
            font-size: clamp(27px, 5vw, 38px);
            letter-spacing: -1px;
            line-height: 1.1;

            background:
                linear-gradient(
                    90deg,
                    #ffffff,
                    #c4b5fd
                );

            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }

        .heading p {
            margin-top: 8px;
            color: #94a3b8;
            font-size: 14px;
        }

        /* Form Card */

        .form-card {
            position: relative;
            overflow: hidden;

            padding: 30px;

            background:
                linear-gradient(
                    145deg,
                    rgba(15, 23, 42, 0.86),
                    rgba(7, 12, 27, 0.92)
                );

            border: 1px solid rgba(148, 163, 184, 0.15);
            border-radius: 20px;

            backdrop-filter: blur(22px);

            box-shadow:
                0 30px 80px rgba(0,0,0,0.32),
                inset 0 1px 0 rgba(255,255,255,0.04);
        }

        .form-card::before {
            content: "";

            position: absolute;
            width: 280px;
            height: 280px;

            top: -160px;
            right: -100px;

            border-radius: 50%;

            background: rgba(124, 92, 255, 0.13);
            filter: blur(40px);

            pointer-events: none;
        }

        .form-title {
            position: relative;
            margin-bottom: 25px;
        }

        .form-title h2 {
            font-size: 18px;
        }

        .form-title p {
            margin-top: 5px;
            color: #64748b;
            font-size: 13px;
        }

        /* Validation */

        .errors {
            margin-bottom: 22px;
            padding: 14px 16px;

            border-radius: 11px;

            background: rgba(239, 68, 68, 0.09);
            border: 1px solid rgba(239, 68, 68, 0.20);

            color: #fca5a5;
            font-size: 13px;
        }

        .errors ul {
            padding-left: 18px;
        }

        .errors li + li {
            margin-top: 5px;
        }

        /* Grid */

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .field {
            display: flex;
            flex-direction: column;
        }

        .field.full {
            grid-column: 1 / -1;
        }

        label {
            margin-bottom: 8px;

            color: #cbd5e1;
            font-size: 13px;
            font-weight: 650;
        }

        .required {
            color: #a78bfa;
        }

        input {
            width: 100%;

            padding: 13px 14px;

            border: 1px solid rgba(148, 163, 184, 0.17);
            border-radius: 10px;

            outline: none;

            background: rgba(2, 6, 23, 0.60);
            color: #f8fafc;

            font-size: 14px;

            transition:
                border-color 0.2s ease,
                box-shadow 0.2s ease,
                background 0.2s ease;
        }

        input::placeholder {
            color: #475569;
        }

        input:hover {
            border-color: rgba(148, 163, 184, 0.28);
        }

        input:focus {
            border-color: #8b5cf6;

            background: rgba(2, 6, 23, 0.78);

            box-shadow:
                0 0 0 3px rgba(139, 92, 246, 0.11),
                0 0 25px rgba(124, 92, 255, 0.08);
        }

        .hint {
            margin-top: 6px;
            color: #475569;
            font-size: 11px;
        }

        /* Buttons */

        .form-actions {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 12px;

            margin-top: 28px;
            padding-top: 22px;

            border-top:
                1px solid rgba(148, 163, 184, 0.10);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;

            padding: 12px 18px;

            border-radius: 10px;
            border: 1px solid transparent;

            text-decoration: none;
            cursor: pointer;

            font-size: 13px;
            font-weight: 650;

            transition: 0.2s ease;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .btn-cancel {
            color: #94a3b8;
            background: rgba(148, 163, 184, 0.06);
            border-color: rgba(148, 163, 184, 0.13);
        }

        .btn-cancel:hover {
            color: #e2e8f0;
            background: rgba(148, 163, 184, 0.10);
        }

        .btn-save {
            color: white;

            background:
                linear-gradient(
                    135deg,
                    #8b5cf6,
                    #6366f1
                );

            box-shadow:
                0 10px 30px rgba(99, 102, 241, 0.28);
        }

        .btn-save:hover {
            box-shadow:
                0 14px 38px rgba(124, 92, 255, 0.42);
        }

        /* Responsive */

        @media (max-width: 650px) {

            .page {
                width: calc(100% - 18px);
                padding: 25px 0 40px;
            }

            .topbar {
                margin-bottom: 22px;
            }

            .form-card {
                padding: 22px 18px;
                border-radius: 16px;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 17px;
            }

            .field.full {
                grid-column: auto;
            }

            .form-actions {
                flex-direction: column-reverse;
            }

            .form-actions .btn {
                width: 100%;
            }
        }

        @media (max-width: 400px) {

            .brand-name {
                font-size: 13px;
            }

            .brand-icon {
                width: 38px;
                height: 38px;
            }

            .heading h1 {
                font-size: 27px;
            }

            .form-card {
                padding: 20px 15px;
            }
        }
    </style>
</head>

<body>

<div class="page">

    <!-- Top Bar -->

    <div class="topbar">

        <div class="brand">

            <div class="brand-icon">
                E
            </div>

            <div class="brand-name">
                Employee Management
            </div>

        </div>

        <a
            href="{{ route('employees.index') }}"
            class="back-link"
        >
            ← Back to Employees
        </a>

    </div>


    <!-- Heading -->

    <div class="heading">

        <h1>Add New Employee</h1>

        <p>
            Create a new employee record and keep your team information organized.
        </p>

    </div>


    <!-- Form -->

    <div class="form-card">

        <div class="form-title">

            <h2>Employee Information</h2>

            <p>
                Enter the employee's details below.
            </p>

        </div>


        <!-- Validation Errors -->

        @if($errors->any())

            <div class="errors">

                <ul>

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif


        <form
            action="{{ route('employees.store') }}"
            method="POST"
        >

            @csrf

            <div class="form-grid">

                <!-- Name -->

                <div class="field">

                    <label>
                        Full Name
                        <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        placeholder="e.g. Chaitanya Kumar"
                        required
                    >

                </div>


                <!-- Email -->

                <div class="field">

                    <label>
                        Email Address
                        <span class="required">*</span>
                    </label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        placeholder="employee@example.com"
                        required
                    >

                </div>


                <!-- Phone -->

                <div class="field">

                    <label>
                        Phone Number
                    </label>

                    <input
                        type="text"
                        name="phone"
                        value="{{ old('phone') }}"
                        placeholder="+91 98765 43210"
                    >

                    <span class="hint">
                        Optional contact number
                    </span>

                </div>


                <!-- Department -->

                <div class="field">

                    <label>
                        Department
                        <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        name="department"
                        value="{{ old('department') }}"
                        placeholder="e.g. Development"
                        required
                    >

                </div>


                <!-- Position -->

                <div class="field full">

                    <label>
                        Position
                        <span class="required">*</span>
                    </label>

                    <input
                        type="text"
                        name="position"
                        value="{{ old('position') }}"
                        placeholder="e.g. Laravel Developer"
                        required
                    >

                </div>

            </div>


            <!-- Actions -->

            <div class="form-actions">

                <a
                    href="{{ route('employees.index') }}"
                    class="btn btn-cancel"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="btn btn-save"
                >
                    ✓ Save Employee
                </button>

            </div>

        </form>

    </div>

</div>

</body>
</html>