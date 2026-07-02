<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Print {{ $title }} – {{ $year }}</title>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@700;800&display=swap" rel="stylesheet">

    <style>
        *, *::before, *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: #1e293b;
            background-color: #ffffff;
            padding: 20px;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        /* Watermark */
        .watermark {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 480px;
            height: 480px;
            background-image: url("{{ asset('logo-hri.png') }}");
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
            opacity: 0.04;
            pointer-events: none;
            z-index: -1;
        }

        /* Print Page Setup */
        @media print {
            @page {
                size: landscape;
                margin: 0.2in !important;
            }
            html, body {
                height: 100vh;
                margin: 0 !important;
                padding: 0 !important;
                overflow: hidden !important;
                background: #ffffff;
            }
            .no-print {
                display: none !important;
            }
            .print-header {
                margin-bottom: 2mm !important;
                gap: 10px !important;
            }
            .header-logo {
                height: 40px !important;
                width: 40px !important;
            }
            .header-banner {
                padding: 4px 8px !important;
                font-size: 9px !important;
            }
            .category-title {
                font-size: 13px !important;
                margin-bottom: 2mm !important;
            }
            .print-table {
                font-size: 7.5px !important;
                margin-bottom: 2mm !important;
            }
            .print-table th, .print-table td {
                padding: 2px 3px !important;
                border: 0.5px solid #94a3b8 !important;
            }
            .print-footer {
                margin-top: 2mm !important;
            }
            .sig-label {
                margin-bottom: 15px !important;
                font-size: 9px !important;
            }
            .sig-name {
                font-size: 10px !important;
            }
            .sig-title {
                font-size: 8px !important;
            }
        }

        /* Header banner layout */
        .print-header {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 25px;
            page-break-after: avoid;
        }

        .header-logo {
            height: 70px;
            width: 70px;
            object-fit: contain;
        }

        .header-banner {
            flex: 1;
            background-color: #f1f5f9;
            color: #0f2d5e;
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-weight: 700;
            font-size: 13px;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 14px 20px;
            border-radius: 6px;
            text-align: center;
            border: 1px solid #cbd5e1;
        }

        /* Category Title */
        .category-title {
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #0f2d5e;
            font-size: 24px;
            font-weight: 800;
            letter-spacing: 0.5px;
            margin-bottom: 15px;
            text-transform: uppercase;
            page-break-after: avoid;
        }

        /* Table Styling */
        .print-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
            font-size: 9px;
        }

        .print-table th, .print-table td {
            border: 1px solid #94a3b8;
            padding: 4px 6px;
            text-align: center;
            vertical-align: middle;
        }

        .print-table th {
            background-color: #f1f5f9 !important;
            color: #0f2d5e !important;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 8px;
            letter-spacing: 0.5px;
        }

        /* Dynamic Table Header Colors */
        .print-table.theme-survival th { background-color: #22c55e !important; color: #ffffff !important; }
        .print-table.theme-development th { background-color: #facc15 !important; color: #000000 !important; }
        .print-table.theme-protection th { background-color: #ef4444 !important; color: #ffffff !important; }
        .print-table.theme-ip th { background-color: #8b4513 !important; color: #ffffff !important; }
        .print-table.theme-disability th { background-color: #38bdf8 !important; color: #000000 !important; }


        .print-table td {
            color: #334155;
        }

        /* Specific alignments */
        .print-table th:nth-child(2), 
        .print-table td:nth-child(2) {
            text-align: left; /* LGU column */
            font-weight: 500;
        }

        .print-table tr {
            page-break-inside: avoid;
        }

        .print-table tr:nth-child(even) td {
            background-color: #f8fafc;
        }

        .print-table .total-row td {
            font-weight: 700;
            background-color: #e2e8f0 !important;
            color: #0f2d5e !important;
            border-top: 2.5px double #64748b;
            border-bottom: 2.5px double #64748b;
        }

        /* Signatures block */
        .print-footer {
            display: flex;
            justify-content: space-between;
            margin-top: 10px;
            page-break-inside: avoid;
        }

        .signature-block {
            width: 38%;
        }

        .sig-label {
            font-size: 12px;
            font-weight: 600;
            margin-bottom: 30px;
            color: #334155;
        }

        .sig-line {
            border-bottom: 1.5px solid #1e293b;
            margin-bottom: 6px;
            width: 100%;
        }

        .sig-name {
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            color: #0f2d5e;
        }

        .sig-title {
            font-size: 11px;
            color: #64748b;
            margin-top: 2px;
        }

        /* Top control bar (no-print) */
        .control-bar {
            background-color: #0f2d5e;
            color: #ffffff;
            padding: 12px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-radius: 8px;
            margin-bottom: 25px;
            box-shadow: 0 4px 12px rgba(15, 45, 94, 0.15);
        }

        .control-title {
            font-weight: 600;
            font-size: 14px;
        }

        .btn-print {
            background-color: #f5a623;
            color: #000000;
            border: none;
            padding: 8px 20px;
            border-radius: 4px;
            font-weight: 700;
            cursor: pointer;
            transition: background-color 0.2s;
            font-size: 13px;
        }

        .pill {
            display: inline-block;
            padding: 3px 8px;
            font-size: 9px;
            font-weight: 600;
            border-radius: 4px;
            text-align: center;
        }
        .pill-green  { background: #dcfce7 !important; color: #15803d !important; }
        .pill-amber  { background: #fef3c7 !important; color: #b45309 !important; }
        .pill-red    { background: #fee2e2 !important; color: #dc2626 !important; }
        .pill-blue   { background: #dbeafe !important; color: #1d4ed8 !important; }
    </style>
</head>
<body>

    <!-- Faded background watermark -->
    <div class="watermark"></div>

    <!-- Top bar for interactive users -->
    <div class="control-bar no-print">
        <span class="control-title">Print Preview — Landscape Mode</span>
        <button class="btn-print" onclick="window.print()">Print Report</button>
    </div>

    <!-- Main Print Content -->
    <div class="print-header">
        <img src="{{ asset('logo-hri.png') }}" class="header-logo" alt="PSWDO Logo">
        <div class="header-banner">
            Surigao del Norte Database on Children {{ $year }}
        </div>
    </div>

    <h1 class="category-title">{{ $title }}</h1>

    <table class="print-table theme-{{ $dataset }}">
        <thead>
            <tr>
                @foreach($headers as $header)
                    <th>{{ $header }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach($rows as $row)
                <tr>
                    @foreach($headers as $header)
                        @php
                            $val = $row[$header];
                            $isPill = false;
                            $pillClass = '';
                            
                            if (($header === 'Immunization %' || $header === 'Immunization Rate (%)' || $header === 'Immunization % (12 mos.)') && $val !== '-') {
                                $numVal = (float) str_replace('%', '', $val);
                                $isPill = true;
                                $pillClass = $numVal >= 85 ? 'pill-green' : ($numVal >= 70 ? 'pill-amber' : 'pill-red');
                            } elseif ($dataset === 'development' && ($header === 'Total' || $header === 'Total in School') && $val !== '-') {
                                $numVal = (int) str_replace(',', '', $val);
                                $isPill = true;
                                $pillClass = $numVal >= 200 ? 'pill-green' : ($numVal >= 80 ? 'pill-amber' : 'pill-red');
                            } elseif ($dataset === 'protection' && $header === 'CNSP Cases' && $val !== '-') {
                                $numVal = (int) str_replace(',', '', $val);
                                $isPill = true;
                                $pillClass = $numVal >= 3 ? 'pill-red' : ($numVal >= 1 ? 'pill-amber' : 'pill-green');
                            } elseif ($dataset === 'protection' && ($header === 'Total' || $header === 'Overall Total' || $header === 'CAR/CICL' || $header === 'CAR_CICL Total' || $header === 'CAR/CICL Total') && $val !== '-') {
                                $numVal = (int) str_replace(',', '', $val);
                                $isPill = true;
                                $pillClass = $numVal >= 15 ? 'pill-red' : ($numVal >= 5 ? 'pill-amber' : 'pill-green');
                            } elseif ($dataset === 'disability' && $header === 'Total' && $val !== '-') {
                                $numVal = (int) str_replace(',', '', $val);
                                $isPill = true;
                                $pillClass = $numVal >= 70 ? 'pill-red' : ($numVal >= 30 ? 'pill-amber' : 'pill-green');
                            } elseif ($dataset === 'ip' && $header === 'Total' && $val !== '-') {
                                $numVal = (int) str_replace(',', '', $val);
                                $isPill = true;
                                $pillClass = $numVal >= 200 ? 'pill-red' : ($numVal >= 50 ? 'pill-amber' : 'pill-green');
                            }
                        @endphp
                        <td>
                            @if($isPill)
                                <span class="pill {{ $pillClass }}">{{ $val }}</span>
                            @else
                                {!! $val !!}
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
            <tr class="total-row">
                @foreach($headers as $header)
                    <td>{!! $totals[$header] !!}</td>
                @endforeach
            </tr>
        </tbody>
    </table>

    <div class="print-footer">
        <div class="signature-block">
            <p class="sig-label">Prepared by:</p>
            <div class="sig-line"></div>
            <p class="sig-name">JESSEL D. BOU, RSW</p>
            <p class="sig-title">PCPC Secretariat</p>
        </div>
        
        <div class="signature-block">
            <p class="sig-label">Noted by:</p>
            <div class="sig-line"></div>
            <p class="sig-name">ROBERT LYNDON S. BARBERS</p>
            <p class="sig-title">PCPC Chairperson</p>
        </div>
    </div>

    <script>
        // Trigger print dialog automatically after page loads
        window.addEventListener('DOMContentLoaded', () => {
            setTimeout(() => {
                window.print();
            }, 500);
        });
    </script>
</body>
</html>
