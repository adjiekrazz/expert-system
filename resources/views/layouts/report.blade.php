<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        html {
            font-family: sans-serif;
            line-height: 1.15;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
            -ms-overflow-style: scrollbar;
            -webkit-tap-highlight-color: transparent;
        }
        
        .row {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            margin-right: -15px;
            margin-left: -15px;
        }

        .col-1, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-10, .col-11, .col-12, .col, .col-auto {
            position: relative;
            width: 100%;
            min-height: 1px;
            padding-right: 15px;
            padding-left: 15px;
        }

        .col-auto {
            -ms-flex: 0 0 auto;
            flex: 0 0 auto;
            width: auto;
            max-width: none;
        }

        .col-1 {
            -ms-flex: 0 0 8.333333%;
            flex: 0 0 8.333333%;
            max-width: 8.333333%;
        }

        .col-2 {
            -ms-flex: 0 0 16.666667%;
            flex: 0 0 16.666667%;
            max-width: 16.666667%;
        }

        .col-3 {
            -ms-flex: 0 0 25%;
            flex: 0 0 25%;
            max-width: 25%;
        }

        .col-4 {
            -ms-flex: 0 0 33.333333%;
            flex: 0 0 33.333333%;
            max-width: 33.333333%;
        }

        .col-5 {
            -ms-flex: 0 0 41.666667%;
            flex: 0 0 41.666667%;
            max-width: 41.666667%;
        }

        .col-6 {
            -ms-flex: 0 0 50%;
            flex: 0 0 50%;
            max-width: 50%;
        }

        .col-7 {
            -ms-flex: 0 0 58.333333%;
            flex: 0 0 58.333333%;
            max-width: 58.333333%;
        }

        .col-8 {
            -ms-flex: 0 0 66.666667%;
            flex: 0 0 66.666667%;
            max-width: 66.666667%;
        }

        .col-9 {
            -ms-flex: 0 0 75%;
            flex: 0 0 75%;
            max-width: 75%;
        }

        .col-10 {
            -ms-flex: 0 0 83.333333%;
            flex: 0 0 83.333333%;
            max-width: 83.333333%;
        }

        .col-11 {
            -ms-flex: 0 0 91.666667%;
            flex: 0 0 91.666667%;
            max-width: 91.666667%;
        }

        .col-12 {
            -ms-flex: 0 0 100%;
            flex: 0 0 100%;
            max-width: 100%;
        }

        .float-left {
            float: left !important;
        }

        .float-right {
            float: right !important;
        }

        .clearfix::after {
            display: block;
            clear: both;
            content: "";
        }

        .table {
            width: 100%;
            max-width: 100%;
            margin-bottom: 1rem;
            background-color: transparent;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        .table tbody + tbody {
            border-top: 2px solid #dee2e6;
        }

        .table .table {
            background-color: #fff;
        }

        .table-borderless th,
        .table-borderless td,
        .table-borderless thead th,
        .table-borderless tbody + tbody {
            border: 0;
        }

        .table-sm th,
        .table-sm td {
            padding: 0.3rem;
        }

        body {
            width: 100%;
        }

        table {
            width: 100%;
        }

        .invoice-wrapper {
            background: #FFF;
        }

        .invoice-wrapper .payment-info {
            margin-top: 25px;
            padding-top: 15px; 
        }

        .invoice-wrapper .payment-info strong {
            display: block;
            color: #444;
            margin-top: 3px; 
        }

        .invoice-wrapper .payment-details {
            line-height: 18px; 
        }

        .invoice-wrapper .line-items {
            margin-top: 10px; 
        }

        .report-table > tbody > tr > td, .report-table > thead > tr > th {
            padding-top: 0;
            padding-left: 0;
            padding-bottom: 0;
        }

        .report-table > tbody > tr > td:first-child, .report-table > thead > tr > th:first-child {
            width: 30%;
            font-weight: bold;
        }

        .report-table > tbody > tr > td:nth-child(3), .report-table > thead > tr > th:nth-child(3) {
            width: 1%;
        }

        .report-table > tbody > tr > td:nth-child(5) {
            width: 1%;
            text-align: right;
        }

        .report-table, .signature-table, .payment-details, .line-items {
            font-size: 12px;
        }

        .spk-lines-header > div:first-child {
            font-weight: bold;
        }

        .spk-lines-item .title {
            font-size: 12px;
            font-weight: bold;
        }

        .spk-lines-item .detail {
            margin-left: 15px;
            font-size: 12px;
        }

        .signature-table {
            font-size: 12px;
        }

        div.items > div.row {
            page-break-inside: avoid !important;
        }

        div.items > div.row > div.col-12 {
            border-top:0.5px solid black;
        }

        div.items > div.row > div > div:first-child {
            padding-top:10px;
        }

        .text-right {
            text-align: right !important;
        }

        .text-left {
            text-align: left !important;
        }

        .text-center {
            text-align: center !important;
        }
    </style>
</head>
<body>
    @yield('content')
</body>
</html>