<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Crema Dashboard')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,500;9..144,600&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        /* =========================================================
           Crema — design tokens
           ========================================================= */
        :root {
            --cream-50:   #fffcf5;   /* cards / surfaces */
            --cream-100:  #f8f2e5;   /* page background */
            --cream-200:  #f0e7d3;   /* sidebar, table heads */
            --cream-300:  #e5d9bf;   /* borders */
            --cream-400:  #cdbf9f;   /* strong borders */

            --ink:        #2a2320;   /* main text (espresso) */
            --ink-soft:   #6f655b;   /* secondary text */
            --ink-faint:  #9a8f82;   /* hints, disabled */

            --matcha:       #5a7a4c; /* primary accent */
            --matcha-deep:  #3f5a36;
            --matcha-soft:  #e3ebd7;
            --butter:       #e9c46a; /* highlight */
            --sky:          #4f7a8c; /* info / view */
            --brick:        #b4483b; /* danger */
            --brick-deep:   #96392e;

            --radius-sm: 8px;
            --radius:    14px;
            --radius-lg: 20px;

            --shadow-sm: 0 1px 2px rgba(60, 44, 24, .06);
            --shadow:    0 6px 22px -8px rgba(60, 44, 24, .16);
            --shadow-lg: 0 18px 40px -16px rgba(60, 44, 24, .26);

            --font-display: 'Fraunces', Georgia, serif;
            --font-body:    'Manrope', 'Segoe UI', Arial, sans-serif;

            --ease: cubic-bezier(.22, .8, .3, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: var(--font-body);
            font-size: 15px;
            line-height: 1.55;
            background-color: var(--cream-100);
            background-image:
                radial-gradient(900px 500px at 105% -10%, rgba(233, 196, 106, .18), transparent 60%),
                radial-gradient(700px 500px at -10% 110%, rgba(90, 122, 76, .10), transparent 60%);
            background-attachment: fixed;
            color: var(--ink);
            -webkit-font-smoothing: antialiased;
        }

        h1, h2, h3 {
            font-family: var(--font-display);
            font-weight: 600;
            letter-spacing: -.01em;
            color: var(--ink);
        }

        :focus-visible {
            outline: 2px solid var(--matcha);
            outline-offset: 2px;
        }

        ::selection {
            background: var(--butter);
            color: var(--ink);
        }

        /* =========================================================
           Layout
           ========================================================= */
        .dashboard-container {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 260px;
            height: 100vh;
            background-color: var(--cream-200);
            border-right: 1px solid var(--cream-300);
            color: var(--ink);
            padding: 28px 18px;
            overflow-y: auto;
            z-index: 10;
        }

        .main-content {
            flex: 1;
            padding: 32px 36px 48px;
            margin-left: 260px;
            min-width: 0;
        }

        .header {
            background-color: var(--cream-50);
            border: 1px solid var(--cream-300);
            padding: 20px 26px;
            border-radius: var(--radius);
            margin-bottom: 26px;
            box-shadow: var(--shadow-sm);
            position: relative;
            overflow: hidden;
        }

        /* a soft strip of "butter" on the header edge */
        .header::before {
            content: "";
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 5px;
            background: linear-gradient(var(--butter), var(--matcha));
        }

        .header h2 {
            font-size: 26px;
        }

        .page-content {
            width: 100%;
        }

        /* =========================================================
           Brand + logo
           ========================================================= */
        .sidebar-brand {
            padding: 4px 8px 26px;
            border-bottom: 1px solid var(--cream-300);
            margin-bottom: 26px;
        }

        .brand-link {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            color: inherit;
        }

        .brand-logo {
            width: 44px;
            height: 44px;
            flex-shrink: 0;
            filter: drop-shadow(0 6px 10px rgba(63, 90, 54, .28));
            transition: transform .5s var(--ease);
        }

        .brand-link:hover .brand-logo {
            transform: rotate(-8deg) scale(1.06);
        }

        .brand-logo .tip {
            transform-origin: 20px 15px;
            animation: tipSway 4s ease-in-out infinite;
        }

        .sidebar-brand h2 {
            font-size: 24px;
            line-height: 1.1;
            margin-bottom: 2px;
        }

        .sidebar-brand p {
            color: var(--ink-soft);
            font-size: 12.5px;
        }

        /* =========================================================
           Sidebar navigation
           ========================================================= */
        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .sidebar-nav a {
            position: relative;
            display: block;
            padding: 12px 16px;
            color: var(--ink-soft);
            text-decoration: none;
            font-weight: 600;
            border-radius: 12px;
            transition: background-color .25s ease, color .25s ease, padding-left .3s var(--ease);
        }

        .sidebar-nav a:hover {
            background-color: var(--cream-50);
            color: var(--ink);
            padding-left: 22px;
        }

        .sidebar-nav a.active {
            background-color: var(--matcha-deep);
            color: var(--cream-50);
            box-shadow: 0 10px 18px -10px rgba(63, 90, 54, .7);
        }

        .sidebar-nav a.active::after {
            content: "";
            position: absolute;
            right: 14px;
            top: 50%;
            width: 7px;
            height: 7px;
            border-radius: 50%;
            background: var(--butter);
            transform: translateY(-50%);
            animation: pulseDot 2.4s ease-in-out infinite;
        }

        /* =========================================================
           Stats
           ========================================================= */
        .stats-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .stat-card {
            background-color: var(--cream-50);
            padding: 24px;
            border-radius: var(--radius);
            border: 1px solid var(--cream-300);
            box-shadow: var(--shadow-sm);
            position: relative;
            overflow: hidden;
            transition: transform .35s var(--ease), box-shadow .35s var(--ease);
        }

        .stat-card::after {
            content: "";
            position: absolute;
            right: -28px;
            top: -28px;
            width: 90px;
            height: 90px;
            border-radius: 50%;
            background: var(--matcha-soft);
            transition: transform .5s var(--ease);
        }

        .stat-card:nth-child(even)::after {
            background: #f6e8c1;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: var(--shadow);
        }

        .stat-card:hover::after {
            transform: scale(1.35);
        }

        .stat-info {
            position: relative;
            z-index: 1;
        }

        .stat-info h3 {
            font-family: var(--font-body);
            color: var(--ink-soft);
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 14px;
        }

        .stat-info p {
            font-family: var(--font-display);
            color: var(--ink);
            font-size: 34px;
            font-weight: 600;
            line-height: 1;
        }

        @media (max-width: 1000px) {
            .stats-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .stats-container {
                grid-template-columns: 1fr;
            }
        }

        /* =========================================================
           Recent products / sellers
           ========================================================= */
        .recent-products,
        .recent-sellers {
            background-color: var(--cream-50);
            border: 1px solid var(--cream-300);
            padding: 26px;
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            overflow-x: auto;
        }

        .recent-products { margin-top: 30px; }
        .recent-sellers  { margin-top: 26px; }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 22px;
        }

        .section-header h2 {
            font-size: 21px;
        }

        .section-header a {
            color: var(--matcha-deep);
            font-weight: 700;
            text-decoration: none;
            background-image: linear-gradient(var(--butter), var(--butter));
            background-size: 0% 2px;
            background-position: 0 100%;
            background-repeat: no-repeat;
            padding-bottom: 2px;
            transition: background-size .35s var(--ease);
        }

        .section-header a:hover {
            background-size: 100% 2px;
        }

        .recent-products table,
        .recent-sellers table {
            width: 100%;
            border-collapse: collapse;
            min-width: 650px;
        }

        .recent-products th,
        .recent-products td,
        .recent-sellers th,
        .recent-sellers td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid var(--cream-300);
        }

        .recent-products th,
        .recent-sellers th {
            color: var(--ink-soft);
            font-size: 13px;
            font-weight: 700;
            background-color: var(--cream-100);
        }

        .recent-products td,
        .recent-sellers td {
            font-size: 14px;
        }

        .recent-products tbody tr,
        .recent-sellers tbody tr,
        .categories-table tbody tr,
        .products-section tbody tr {
            transition: background-color .2s ease;
        }

        .recent-products tbody tr:hover,
        .recent-sellers tbody tr:hover,
        .categories-table tbody tr:hover,
        .products-section tbody tr:hover {
            background-color: #fbf6e9;
        }

        .product-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 12px;
            border: 1px solid var(--cream-300);
        }

        /* =========================================================
           Page header + buttons
           ========================================================= */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            gap: 15px;
        }

        .page-header h2 {
            margin-bottom: 6px;
            font-size: 24px;
        }

        .page-header p {
            color: var(--ink-soft);
            font-size: 14px;
        }

        .btn-primary,
        .btn-save,
        .btn-cancel,
        .btn-back,
        .seller-edit-btn,
        .seller-back-btn {
            transition: transform .25s var(--ease), box-shadow .25s ease, background-color .25s ease;
        }

        .btn-primary:hover,
        .btn-save:hover,
        .btn-cancel:hover,
        .btn-back:hover,
        .seller-edit-btn:hover,
        .seller-back-btn:hover {
            transform: translateY(-2px);
        }

        .btn-primary:active,
        .btn-save:active,
        .btn-cancel:active,
        .btn-back:active,
        .seller-edit-btn:active,
        .seller-back-btn:active {
            transform: translateY(0) scale(.98);
        }

        .btn-primary {
            display: inline-block;
            background: var(--matcha-deep);
            color: var(--cream-50);
            font-weight: 700;
            padding: 11px 20px;
            border-radius: 999px;
            text-decoration: none;
            box-shadow: 0 10px 18px -10px rgba(63, 90, 54, .8);
        }

        .btn-primary:hover {
            background: var(--matcha);
            box-shadow: 0 14px 22px -10px rgba(63, 90, 54, .8);
        }

        /* =========================================================
           Categories table
           ========================================================= */
        .categories-table {
            background: var(--cream-50);
            border: 1px solid var(--cream-300);
            padding: 20px;
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            overflow-x: auto;
        }

        .categories-table table {
            width: 100%;
            border-collapse: collapse;
            min-width: 750px;
        }

        .categories-table th,
        .categories-table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid var(--cream-300);
        }

        .categories-table th {
            background: var(--cream-100);
            color: var(--ink-soft);
            font-size: 13px;
            font-weight: 700;
        }

        .category-image {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 12px;
            border: 1px solid var(--cream-300);
        }

        .actions {
            display: flex;
            align-items: center;
            gap: 7px;
        }

        .actions a,
        .actions button {
            padding: 7px 13px;
            border: none;
            border-radius: 999px;
            color: white;
            text-decoration: none;
            cursor: pointer;
            font-family: var(--font-body);
            font-size: 12.5px;
            font-weight: 700;
            transition: transform .25s var(--ease), filter .2s ease;
        }

        .actions a:hover,
        .actions button:hover {
            transform: translateY(-2px);
            filter: brightness(1.08);
        }

        .btn-view   { background: var(--sky); }
        .btn-edit   { background: var(--matcha); }
        .btn-delete { background: var(--brick); }

        /* =========================================================
           Pagination — works with Laravel's default markup,
           with or without a .pagination wrapper
           ========================================================= */
        .pagination {
            margin-top: 25px;
        }

        nav[role="navigation"] {
            margin-top: 25px;
        }

        /* Laravel prints a mobile block + a desktop block (Tailwind hides one).
           We have no Tailwind, so hide the mobile one ourselves. */
        nav[role="navigation"] > div[class*="sm:hidden"] {
            display: none;
        }

        nav[role="navigation"] > div[class*="sm:flex-1"],
        .pagination nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        nav[role="navigation"] p {
            color: var(--ink-soft);
            font-size: 14px;
        }

        nav[role="navigation"] p span {
            font-weight: 700;
            color: var(--ink);
        }

        nav[role="navigation"] span[class*="z-0"] {
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        nav[role="navigation"] span[class*="z-0"] a,
        nav[role="navigation"] span[class*="z-0"] span[aria-current="page"] > span,
        nav[role="navigation"] span[class*="z-0"] span[aria-disabled="true"] > span,
        .pagination a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 38px;
            min-height: 38px;
            padding: 8px 12px;
            border: 1px solid var(--cream-300);
            border-radius: 10px;
            background: var(--cream-50);
            color: var(--ink);
            text-decoration: none;
            font-size: 14px;
            font-weight: 600;
            transition: background-color .2s ease, color .2s ease, transform .2s var(--ease);
        }

        nav[role="navigation"] span[class*="z-0"] a:hover,
        .pagination a:hover {
            background-color: var(--matcha-deep);
            border-color: var(--matcha-deep);
            color: var(--cream-50);
            transform: translateY(-2px);
        }

        nav[role="navigation"] span[aria-current="page"] > span {
            background-color: var(--matcha-deep) !important;
            border-color: var(--matcha-deep) !important;
            color: var(--cream-50) !important;
        }

        nav[role="navigation"] span[aria-disabled="true"] > span {
            color: var(--ink-faint);
            background: var(--cream-100);
            cursor: not-allowed;
        }

        /* Fix oversized pagination arrows */
        nav[role="navigation"] svg,
        .pagination svg {
            width: 18px;
            height: 18px;
            display: inline-block;
        }

        /* =========================================================
           Category details
           ========================================================= */
        .category-details {
            background: var(--cream-50);
            border: 1px solid var(--cream-300);
            padding: 26px;
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
        }

        .details-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 15px;
            margin-bottom: 25px;
        }

        .details-header p {
            color: var(--ink-soft);
            margin-top: 7px;
        }

        .btn-back {
            display: inline-block;
            background: var(--ink-soft);
            color: var(--cream-50);
            font-weight: 600;
            padding: 10px 18px;
            border-radius: 999px;
            text-decoration: none;
        }

        .btn-back:hover {
            background: var(--ink);
        }

        .category-info {
            display: flex;
            gap: 25px;
            align-items: center;
            padding-bottom: 25px;
            border-bottom: 1px solid var(--cream-300);
        }

        .category-image-container img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: var(--radius);
            border: 1px solid var(--cream-300);
            box-shadow: var(--shadow);
        }

        .category-text {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .products-section {
            margin-top: 30px;
            overflow-x: auto;
        }

        .products-section h2 {
            margin-bottom: 20px;
        }

        .products-section table {
            width: 100%;
            border-collapse: collapse;
            min-width: 550px;
        }

        .products-section th,
        .products-section td {
            padding: 14px;
            text-align: left;
            border-bottom: 1px solid var(--cream-300);
        }

        .products-section th {
            background: var(--cream-100);
            color: var(--ink-soft);
            font-size: 13px;
            font-weight: 700;
        }

        /* =========================================================
           Forms
           ========================================================= */
        .form-container {
            background: var(--cream-50);
            border: 1px solid var(--cream-300);
            padding: 32px;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow);
            max-width: 800px;
        }

        .form-header {
            margin-bottom: 26px;
        }

        .form-header h2 {
            margin-bottom: 8px;
        }

        .form-header p {
            color: var(--ink-soft);
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 22px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 700;
            font-size: 14px;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px 14px;
            border: 1.5px solid var(--cream-300);
            border-radius: 12px;
            font-family: var(--font-body);
            font-size: 14px;
            background-color: var(--cream-100);
            color: var(--ink);
            transition: border-color .25s ease, box-shadow .25s ease, background-color .25s ease;
        }

        .form-group input::placeholder,
        .form-group textarea::placeholder {
            color: var(--ink-faint);
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            background-color: var(--cream-50);
            border-color: var(--matcha);
            box-shadow: 0 0 0 4px rgba(90, 122, 76, .16);
        }

        .error-message {
            display: block;
            color: var(--brick);
            font-size: 13px;
            font-weight: 600;
            margin-top: 6px;
            animation: shake .4s ease;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-top: 28px;
        }

        .btn-save,
        .btn-cancel {
            padding: 11px 24px;
            border: none;
            border-radius: 999px;
            text-decoration: none;
            cursor: pointer;
            font-family: var(--font-body);
            font-size: 14px;
            font-weight: 700;
        }

        .btn-save {
            background: var(--matcha-deep);
            color: var(--cream-50);
            box-shadow: 0 10px 18px -10px rgba(63, 90, 54, .8);
        }

        .btn-save:hover {
            background: var(--matcha);
        }

        .btn-cancel {
            background: var(--cream-200);
            color: var(--ink);
        }

        .btn-cancel:hover {
            background: var(--cream-300);
        }

        .current-category-image {
            display: block;
            width: 130px;
            height: 130px;
            object-fit: cover;
            border-radius: var(--radius);
            margin-top: 10px;
            border: 1px solid var(--cream-300);
        }

        /* =========================================================
           Seller details
           ========================================================= */
        .seller-details {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .details-actions {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .details-card,
        .seller-details .products-section {
            background: var(--cream-50);
            border: 1px solid var(--cream-300);
            padding: 26px;
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
        }

        .details-card h3 {
            margin-bottom: 20px;
            font-size: 19px;
        }

        .details-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .details-grid label {
            display: block;
            color: var(--ink-soft);
            font-size: 13px;
            margin-bottom: 6px;
        }

        .details-grid p {
            font-weight: 700;
        }

        .products-section .section-header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        @media (max-width: 700px) {
            .details-grid {
                grid-template-columns: 1fr;
            }

            .details-header {
                align-items: flex-start;
                flex-direction: column;
            }
        }

        .seller-edit-btn,
        .seller-back-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 11px 20px;
            border-radius: 999px;
            text-decoration: none;
            font-size: 14px;
            font-weight: 700;
        }

        .seller-edit-btn {
            background-color: var(--matcha-deep);
            color: var(--cream-50);
        }

        .seller-edit-btn:hover {
            background-color: var(--matcha);
        }

        .seller-back-btn {
            background-color: var(--cream-200);
            color: var(--ink);
        }

        .seller-back-btn:hover {
            background-color: var(--cream-300);
        }

        .details-actions i {
            font-size: 14px;
        }

        /* =========================================================
           SweetAlert toast (matches the theme)
           ========================================================= */
        .swal2-popup.swal2-toast {
            font-family: var(--font-body);
            border: 1px solid var(--cream-300);
            border-radius: 14px !important;
            box-shadow: var(--shadow-lg) !important;
        }

        /* =========================================================
           Motion — one orchestrated page-load sequence
           ========================================================= */
        @keyframes riseIn {
            from { opacity: 0; transform: translateY(14px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateX(-14px); }
            to   { opacity: 1; transform: translateX(0); }
        }

        @keyframes tipSway {
            0%, 100% { transform: rotate(-5deg); }
            50%      { transform: rotate(5deg); }
        }

        @keyframes pulseDot {
            0%, 100% { opacity: 1;  transform: translateY(-50%) scale(1); }
            50%      { opacity: .5; transform: translateY(-50%) scale(.7); }
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25%      { transform: translateX(-4px); }
            75%      { transform: translateX(4px); }
        }

        .sidebar-brand        { animation: slideIn .6s var(--ease) both; }
        .sidebar-nav a        { animation: slideIn .6s var(--ease) both; }
        .sidebar-nav a:nth-child(1) { animation-delay: .10s; }
        .sidebar-nav a:nth-child(2) { animation-delay: .17s; }
        .sidebar-nav a:nth-child(3) { animation-delay: .24s; }
        .sidebar-nav a:nth-child(4) { animation-delay: .31s; }
        .sidebar-nav a:nth-child(5) { animation-delay: .38s; }
        .sidebar-nav a:nth-child(6) { animation-delay: .45s; }

        .header               { animation: riseIn .6s var(--ease) .15s both; }
        .page-content         { animation: riseIn .7s var(--ease) .3s both; }

        .stat-card            { animation: riseIn .6s var(--ease) both; }
        .stat-card:nth-child(1) { animation-delay: .40s; }
        .stat-card:nth-child(2) { animation-delay: .48s; }
        .stat-card:nth-child(3) { animation-delay: .56s; }
        .stat-card:nth-child(4) { animation-delay: .64s; }

        /* =========================================================
           Responsive shell
           ========================================================= */
        @media (max-width: 900px) {
            .dashboard-container {
                flex-direction: column;
            }

            .sidebar {
                position: static;
                width: 100%;
                height: auto;
                padding: 20px 16px;
                border-right: none;
                border-bottom: 1px solid var(--cream-300);
            }

            .sidebar-nav {
                flex-direction: row;
                flex-wrap: wrap;
            }

            .main-content {
                margin-left: 0;
                padding: 24px 18px 40px;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *, *::before, *::after {
                animation: none !important;
                transition: none !important;
                scroll-behavior: auto !important;
            }
        }
    </style>
</head>

<body>

    <div class="dashboard-container">

        <aside class="sidebar">

            <div class="sidebar-brand">
                <a href="{{ route('dashboard') }}" class="brand-link">

                    <!-- Crema logo: a soft cream dollop on a matcha tile -->
                    <svg class="brand-logo" viewBox="0 0 44 44" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                        <rect width="44" height="44" rx="14" fill="#3f5a36"/>
                        <rect x="1" y="1" width="42" height="42" rx="13" fill="none" stroke="#fffcf5" stroke-opacity=".18"/>
                        <ellipse cx="22" cy="30" rx="11" ry="5" fill="#fffcf5"/>
                        <ellipse cx="22" cy="24" rx="8.5" ry="4.5" fill="#f8f2e5"/>
                        <ellipse cx="22" cy="18.5" rx="6" ry="3.6" fill="#f0e7d3"/>
                        <path class="tip" d="M22 8.5c2.6 2.4 2.6 4.4 0 6.6-2.6-2.2-2.6-4.2 0-6.6z" fill="#e9c46a"/>
                    </svg>

                    <div>
                        <h2>Crema</h2>
                        <p>Commerce studio</p>
                    </div>
                </a>
            </div>

            <nav class="sidebar-nav">
                <a href="{{ route('dashboard') }}"
                   class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    Dashboard
                </a>


            </nav>

        </aside>

        <main class="main-content">

            <header class="header">
                <h2>@yield('page-heading', 'Dashboard')</h2>
            </header>

            <section class="page-content">
                @yield('content')
            </section>

        </main>

    </div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if (session('success'))
    <script>
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'success',
            iconColor: '#5a7a4c',
            background: '#fffcf5',
            color: '#2a2320',
            title: @json(session('success')),
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });
    </script>
@endif

@if (session('error'))
    <script>
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: 'error',
            iconColor: '#b4483b',
            background: '#fffcf5',
            color: '#2a2320',
            title: @json(session('error')),
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });
    </script>
@endif

</body>
</html>
