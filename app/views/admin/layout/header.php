<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0">

    <title>
        <?= htmlspecialchars($pageTitle ?? 'Techers Admin') ?>
    </title>

    <!-- Bootstrap -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <!-- Bootstrap Icons -->

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css"
        rel="stylesheet">

    <!-- Summernote Bootstrap 5 CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.css"
        rel="stylesheet">
    
    <!-- DataTables Bootstrap 5 CSS -->
    <link
        rel="stylesheet"
        href="https://cdn.datatables.net/2.3.8/css/dataTables.bootstrap5.css">

    <!-- DataTables Buttons Bootstrap 5 CSS -->
    <link
        rel="stylesheet"
        href="https://cdn.datatables.net/buttons/3.2.6/css/buttons.bootstrap5.css">

    <style>

        body {
            background: #f8fafc;
            margin: 0;
            padding: 0;
        }

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar */

        .sidebar {
            width: 260px;
            background: #ffffff;
            border-right: 1px solid #dee2e6;
            transition: all .3s ease;
            flex-shrink: 0;
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar-header {
            height: 70px;

            border-bottom: 1px solid #dee2e6;

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 0 15px;

            box-sizing: border-box;
        }

        .logo-text {
            font-size: 22px;
            font-weight: 700;
            color: #0d6efd;
        }

        .sidebar.collapsed .logo-text {
            display: none;
        }

        .sidebar .nav {
            padding: 10px;
        }

        .sidebar .nav-link {
            color: #495057;
            border-radius: 8px;
            margin-bottom: 4px;
            padding: 12px 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar .nav-link:hover {
            background: #f1f3f5;
        }

        .sidebar .nav-link.active {
            background: #0d6efd;
            color: #ffffff;
        }

        .sidebar.collapsed .nav-link span {
            display: none;
        }

        /* Content */

        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .content-wrapper {
            flex: 1;
            padding: 25px;
        }

        /* Footer */

        .footer-bar {
            background: #ffffff;
            border-top: 1px solid #dee2e6;
            padding: 12px;
            text-align: center;
            color: #6c757d;
        }

        /* Dashboard Cards */

        .dashboard-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 .125rem .25rem rgba(0,0,0,.075);
        }

        .dashboard-card h2 {
            margin: 0;
            font-weight: 700;
        }

        .page-header {
            height: 71px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 0 25px;

            box-sizing: border-box;

            background: #fff;
        }

        .page-header-wrapper {
            border-bottom: 1px solid #dee2e6;
        }

        
        

    </style>

    <!-- Page Specific CSS -->

    <?= \app\core\View::section('custom_css'); ?>

</head>

<body>