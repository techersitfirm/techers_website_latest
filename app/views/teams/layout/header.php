<?php

use App\Core\View;

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1">

    <title>
        <?= htmlspecialchars($pageTitle ?? 'Techers team') ?>
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.css"
        rel="stylesheet">

    <style>

        :root {
            --team-primary: #6f42c1;
            --team-primary-hover: #5b35a3;
        }

        body {
            background: #f8fafc;
            margin: 0;
            padding: 0;
        }

        /* Login */

        .team-brand {
            color: var(--team-primary);
            font-weight: 700;
        }

        .btn-primary {
            background-color: var(--team-primary);
            border-color: var(--team-primary);
        }

        .btn-primary:hover {
            background-color: var(--team-primary-hover);
            border-color: var(--team-primary-hover);
        }

        /* Layout */

        .team-wrapper {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 260px;
            background: #ffffff;
            border-right: 1px solid #dee2e6;
            flex-shrink: 0;
        }

        .sidebar-header {
            height: 70px;
            padding: 0 20px;
            border-bottom: 1px solid #dee2e6;

            display: flex;
            align-items: center;
        }

        .logo-text {
            font-size: 22px;
            font-weight: 700;
            color: var(--team-primary);
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
            background: #f1edfb;
        }

        .sidebar .nav-link.active {
            background: var(--team-primary);
            color: #ffffff;
        }

        .main-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .page-header-wrapper {
            border-bottom: 1px solid #dee2e6;
            background: #ffffff;
        }

        .page-header {
            height: 70px;

            display: flex;
            align-items: center;
            justify-content: space-between;

            padding: 0 25px;
        }

        .content-wrapper {
            flex: 1;
            padding: 25px;
        }

        .footer-bar {
            background: #ffffff;
            border-top: 1px solid #dee2e6;
            padding: 12px;
            text-align: center;
            color: #6c757d;
        }

        .footer-bar a {
            color: var(--team-primary);
            text-decoration: none;
        }

        .footer-bar a:hover {
            text-decoration: underline;
        }

        .team-company-name {
            font-size: 20px;
            font-weight: 600;
            color: var(--team-primary);
        }
    </style>

    <?= View::section('custom_css'); ?>

</head>

<body>