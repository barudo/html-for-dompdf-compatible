<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Air Waybill {{ $awb['awb_number'] ?? '' }}</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 2mm;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            color: #000;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 8px;
            line-height: 1.08;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
        }

        td,
        th {
            border: 0.35mm solid #000;
            padding: 1mm;
            vertical-align: top;
            overflow: hidden;
        }

        .page {
            width: 204mm;
            min-height: 293mm;
            margin: 0 auto;
            position: relative;
        }

        .top-bar {
            height: 8mm;
            position: relative;
        }

        .barcode {
            position: absolute;
            left: 68mm;
            top: 0;
            width: 57mm;
            height: 7mm;
            overflow: hidden;
            text-align: center;
        }

        .barcode img {
            width: 57mm;
            height: 7mm;
            display: block;
        }

        .awb-number {
            position: absolute;
            right: 0;
            top: 1mm;
            font-size: 27px;
            font-weight: 700;
            line-height: 1;
        }

        .label {
            display: block;
            font-family: Arial, Helvetica, sans-serif;
            font-size: 8px;
            font-weight: 400;
            line-height: 1.05;
        }

        .label-center {
            display: block;
            text-align: center;
            font-size: 7px;
            line-height: 1.05;
        }

        .value {
            display: block;
            margin-top: 1mm;
            font-family: "Courier New", Courier, monospace;
            font-size: 14px;
            font-weight: 700;
            line-height: 1.03;
            white-space: pre-line;
        }

        .value-small {
            font-size: 11px;
        }

        .value-center {
            text-align: center;
        }

        .tiny {
            font-size: 6px;
            line-height: 1.05;
        }

        .medium {
            font-size: 10px;
        }

        .bold {
            font-weight: 700;
        }

        .no-border {
            border: 0;
        }

        .no-top-border {
            border-top: 0;
        }

        .no-left-border {
            border-left: 0;
        }

        .no-bottom-border {
            border-bottom: 0;
        }

        .hidden-top-border {
            border-top-style: hidden;
        }

        .hidden-bottom-border {
            border-bottom-style: hidden;
        }

        .double-right-border {
            border-right: 1mm double #000;
        }

        .h-20 {
            height: 20mm;
        }

        .h-22 {
            height: 22mm;
        }

        .h-25 {
            height: 14mm;
        }

        .h-27 {
            height: 18mm;
        }

        .h-31 {
            height: 31mm;
        }

        .h-40 {
            height: 40mm;
        }

        .h-55 {
            height: 55mm;
        }

        .h-62 {
            height: 62mm;
        }

        .h-80 {
            height: 80mm;
        }

        .h-8 {
            height: 6mm;
        }

        .h-9 {
            height: 5mm;
        }

        .h-10 {
            height: 6mm;
        }

        .h-11 {
            height: 8mm;
        }

        .h-13 {
            height: 9mm;
        }

        .h-15 {
            height: 8mm;
        }

        .header-title {
            font-size: 20px;
            font-weight: 700;
            line-height: 1;
        }

        .logo {
            float: right;
            width: 34mm;
            height: 20mm;
            text-align: center;
            padding-top: 1mm;
        }

        .logo img {
            max-width: 34mm;
            max-height: 20mm;
            display: inline-block;
        }

        .destination-logo {
            margin-top: 1mm;
            margin-left: 7mm;
            text-align: left;
            line-height: 0;
        }

        .destination-logo img {
            width: 16mm;
            max-height: 8mm;
            display: inline-block;
        }

        .notice {
            font-size: 8px;
            line-height: 1.05;
            text-align: justify;
        }

        .subgrid td {
            border-top: 0;
            border-left: 0;
            border-bottom: 0;
        }

        .subgrid td:last-child {
            border-right: 0;
        }

        .route-cell {
            height: 8mm;
        }

        .route-group-heading {
            height: 3mm;
            padding: 0.5mm;
            text-align: center;
            vertical-align: middle;
        }

        .route-subcell {
            height: 7mm;
            padding: 0.5mm;
            vertical-align: top;
        }

        .first-carrier-cell {
            padding: 0;
        }

        .first-carrier-heading td {
            border: 0;
            height: 4mm;
            padding: 0;
            vertical-align: top;
        }

        .first-carrier-label {
            padding-left: 1mm !important;
            padding-top: 1mm !important;
        }

        .routing-destination-tab {
            line-height: 0;
            text-align: center;
        }

        .routing-destination-tab img {
            display: inline-block;
            height: 4mm;
            width: 27mm;
        }

        .requested-flight-cell {
            padding: 0;
            position: relative;
        }

        .requested-flight-cell::after {
            content: '';
            position: absolute;
            left: 50%;
            top: 5mm;
            bottom: 0;
            width: 0.35mm;
            background: #000;
            transform: translateX(-50%);
            z-index: 1;
        }

        .requested-flight-tab {
            line-height: 0;
            text-align: center;
        }

        .requested-flight-tab img {
            display: inline-block;
            height: 5mm;
            width: 31mm;
        }

        .requested-flight-fill {
            width: 100%;
            height: 8mm;
            border: 0;
        }

        .requested-flight-fill td {
            width: 50%;
            height: 8mm;
            border-top: 0;
            border-bottom: 0;
            padding: 1mm;
        }

        .requested-flight-fill td:first-child {
            border-left: 0;
        }

        .requested-flight-fill td:last-child {
            border-right: 0;
        }

        .first-carrier-cell .value {
            padding-left: 1mm;
            padding-right: 1mm;
        }

        .goods-heading>td {
            height: 9mm;
            text-align: center;
            vertical-align: middle;
        }

        .rate-charge-heading {
            line-height: 0;
            text-align: center;
        }

        .rate-charge-heading img {
            width: 21mm;
            height: 8mm;
            display: inline-block;
        }

        .goods-heading .rate-commodity-cell {
            height: 9mm;
        }

        .goods-row>td {
            height: 34mm;
        }

        .goods-stack-cell {
            padding: 0;
        }

        .goods-stack-block {
            height: 42mm;
        }

        .goods-stack-top {
            height: 25mm;
            padding: 1mm;
            text-align: center;
        }

        .goods-stack-bottom {
            height: 10mm;
            padding: 1mm;
            text-align: center;
        }

        .goods-stack-top {
            border-bottom: 0.35mm solid #000;
        }

        .rate-commodity-value {
            height: 34mm;
            position: relative;
        }

        .rate-commodity-body {
            height: 34mm;
            position: relative;
        }

        .rate-commodity-body-code {
            position: absolute;
            left: 0;
            top: 0;
            width: 15%;
            height: 70mm;
            border-right: 0.35mm solid #000;
            padding-top: 1mm;
            text-align: center;
        }

        .rate-commodity-body-main {
            margin-left: 15%;
            height: 34mm;
        }

        .rate-commodity-cell {
            padding: 0;
        }

        .rate-commodity-heading-cell {
            width: 10.5%;
            padding: 0;
        }

        .rate-commodity-heading-code {
            width: 15%;
            border: 0;
        }

        .rate-commodity-heading-label {
            width: 85%;
            text-align: center;
            border-left: 0;
            border-right: 0;
        }

        .rate-commodity-heading-rate {
            border-top: 0;
        }

        .rate-commodity-heading-commodity-code {
            width: 15%;
            border-left: 0;
            border-top: 0;
            border-bottom: 0;
        }

        .rate-commodity-row {
            position: relative;
            width: 100%;
        }

        .rate-class-row {
            height: 3mm;
            padding-top: 0.5mm;
            padding-bottom: 0.5mm;
        }

        .commodity-row {
            height: 6mm;
            border-top: 0.35mm solid #000;
        }

        .rate-commodity-code {
            position: absolute;
            left: 0;
            top: 0;
            width: 2%;
            height: 100%;
            text-align: center;
            overflow: visible;
        }

        .rate-commodity-main {
            margin-left: 2%;
            height: 100%;
            text-align: center;
        }

        .rate-commodity-value .rate-commodity-code {
            border-right: 0.35mm solid #000;
            padding-top: 1mm;
        }

        .rate-commodity-code .value {
            margin-top: 0;
        }

        .rate-commodity-value-main {
            margin-left: 2%;
            height: 30mm;
        }

        .charges-row td {
            height: 6mm;
        }

        .copy-validity-cell {
            height: 7mm;
            font-weight: 700;
            vertical-align: middle;
        }

        .copy-notice {
            height: 20mm;
            padding: 2mm;
        }

        .charge-grid td {
            vertical-align: top;
        }

        .charge-tab {
            text-align: center;
            height: 4mm;
            line-height: 0;
        }

        .charge-tab img {
            height: 4mm;
            display: inline-block;
        }

        .tab-small img {
            width: 24mm;
        }

        .tab-medium img {
            width: 43mm;
        }

        .tab-wide img {
            width: 58mm;
        }

        .charge-tabs-strip td {
            border: 0;
            padding: 0;
            text-align: center;
            overflow: visible;
        }

        .split-charge-cell {
            position: relative;
            padding: 0;
        }

        .split-charge-cell::after {
            content: '';
            position: absolute;
            left: 50%;
            top: 4mm;
            bottom: 0;
            width: 0.35mm;
            background: #000;
            transform: translateX(-50%);
            z-index: 1;
            pointer-events: none;
        }

        .split-charge-cell>.charge-tab {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            z-index: 2;
        }

        .split-charge-cell>.charge-tab::after {
            content: '';
            position: absolute;
            left: 50%;
            top: 4mm;
            bottom: 0;
            width: 0.35mm;
            background: #000;
            transform: translateX(-50%);
            z-index: 1;
        }

        .split-charge-fill td {
            border: 0;
            padding-top: 4mm;
        }

        .split-charge-fill td+td {
            border-left: 0.35mm solid #000;
        }

        .split-charge-cell .split-charge-fill::after {
            content: '';
            position: absolute;
            left: 50%;
            top: 4mm;
            bottom: 0;
            width: 0.35mm;
            background: #000;
            transform: translateX(-50%);
            z-index: 1;
        }

        .charge-grid .h-9,
        .charge-grid .h-10 {
            padding-top: 0;
        }

        .charge-footer-grid .h-8,
        .charge-footer-grid .h-10 {
            padding-top: 0;
        }

        .bottom-tab-cell {
            position: relative;
            padding-top: 0;
            overflow: visible;
        }

        .bottom-tab-cell .charge-tab {
            position: absolute;
            top: -0.45mm;
            left: 0;
            right: 0;
            z-index: 2;
        }

        .bottom-tab-cell .charge-tab::after {
            content: '';
            position: absolute;
            left: 50%;
            top: 4mm;
            bottom: 0;
            width: 0.35mm;
            background: #000;
            transform: translateX(-50%);
            z-index: 1;
        }

        .bottom-tab-cell .value {
            padding-top: 4mm;
        }

        .other-charges-box {
            height: 26mm;
        }

        .other-charges-box .label {
            margin-bottom: 2mm;
        }

        .final-row td {
            height: 9mm;
        }

        .signature-cell {
            font-size: 7px;
            text-align: center;
            line-height: 1.05;
            vertical-align: bottom;
        }

        .execution-line-cell {
            vertical-align: top;
            padding-top: 1mm;
            white-space: nowrap;
        }

        .executed-summary-cell {
            padding: 0;
            overflow: visible;
            position: relative;
        }

        /*.executed-summary-cell::after {
            content: '';
            position: absolute;
            right: -0.175mm;
            top: 0;
            bottom: 0;
            width: 0.35mm;
            background: #000;
            z-index: 1;
        }*/

        .executed-summary-date {
            height: 5mm;
            padding: 1mm 1mm 0;
            border-bottom: 0.35mm solid #000;
            margin: 0;
            width: 100%;
            box-sizing: border-box;
        }

        .executed-summary-labels {
            border-collapse: collapse;
        }

        .executed-summary-labels td {
            border: 0;
            padding: 0;
            font-size: 7px;
            line-height: 1;
            text-align: center;
            vertical-align: top;
            white-space: nowrap;
        }

        .footer-copy-cell {
            border-right: 0;
            border-bottom: 0;
            text-align: right;
            vertical-align: bottom;
            font-weight: 700;
            font-size: 22px;
            line-height: 0.82;
            padding-right: 0;
            padding-bottom: 0;
            white-space: nowrap;
        }

        .footer-copy-cell .copy-note {
            display: block;
            font-size: 12px;
        }

        .final-copy-area {
            border-right: 0;
            border-bottom: 0;
            padding: 0;
        }

        .final-copy-table td {
            border: 0;
        }

        .final-copy-table td.total-collect-box {
            border-left: 0;
            border-right: 0.35mm solid #000;
            border-bottom: 0.35mm solid #000;
        }

        .certification {
            font-size: 8px;
            line-height: 1.05;
        }

        .signature {
            margin-top: 7mm;
            text-align: center;
        }

        .signature .value {
            display: inline-block;
            border-bottom: 0.35mm solid #000;
            min-width: 94mm;
            padding-bottom: 1mm;
        }
    </style>
</head>

<body>
    @php
    $shipper = $awb['shipper'] ?? [];
    $consignee = $awb['consignee'] ?? [];
    $agent = $awb['agent'] ?? [];
    $carrier = $awb['carrier'] ?? [];
    $routing = $awb['routing'] ?? [];
    $goods = $awb['goods'] ?? [];
    $firstGoods = $goods[0] ?? [];
    $totals = $awb['totals'] ?? [];
    $certification = $awb['certification'] ?? [];
    $awbNumber = strtoupper((string) ($awb['awb_number'] ?? ''));
    $barcodeMap = [
    '0' => 'nnnwwnwnn', '1' => 'wnnwnnnnw', '2' => 'nnwwnnnnw', '3' => 'wnwwnnnnn',
    '4' => 'nnnwwnnnw', '5' => 'wnnwwnnnn', '6' => 'nnwwwnnnn', '7' => 'nnnwnnwnw',
    '8' => 'wnnwnnwnn', '9' => 'nnwwnnwnn', 'A' => 'wnnnnwnnw', 'B' => 'nnwnnwnnw',
    'C' => 'wnwnnwnnn', 'D' => 'nnnnwwnnw', 'E' => 'wnnnwwnnn', 'F' => 'nnwnwwnnn',
    'G' => 'nnnnnwwnw', 'H' => 'wnnnnwwnn', 'I' => 'nnwnnwwnn', 'J' => 'nnnnwwwnn',
    'K' => 'wnnnnnnww', 'L' => 'nnwnnnnww', 'M' => 'wnwnnnnwn', 'N' => 'nnnnwnnww',
    'O' => 'wnnnwnnwn', 'P' => 'nnwnwnnwn', 'Q' => 'nnnnnnwww', 'R' => 'wnnnnnwwn',
    'S' => 'nnwnnnwwn', 'T' => 'nnnnwnwwn', 'U' => 'wwnnnnnnw', 'V' => 'nwwnnnnnw',
    'W' => 'wwwnnnnnn', 'X' => 'nwnnwnnnw', 'Y' => 'wwnnwnnnn', 'Z' => 'nwwnwnnnn',
    '-' => 'nwnnnnwnw', '.' => 'wwnnnnwnn', ' ' => 'nwwnnnwnn', '*' => 'nwnnwnwnn',
    '$' => 'nwnwnwnnn', '/' => 'nwnwnnnwn', '+' => 'nwnnnwnwn', '%' => 'nnnwnwnwn',
    ];
    $barcodeText = '*' . preg_replace('/[^0-9A-Z. $\/+%-]/', '', $awbNumber) . '*';
    $barcodeX = 0;
    $barcodeBars = '';
    foreach (str_split($barcodeText) as $character) {
    $pattern = $barcodeMap[$character] ?? $barcodeMap['-'];
    foreach (str_split($pattern) as $index => $widthCode) {
    $width = $widthCode === 'w' ? 3 : 1;
    if ($index % 2 === 0) {
    $barcodeBars .= '
    <rect x="' . $barcodeX . '" y="0" width="' . $width . '" height="34" fill="#000" />';
    }
    $barcodeX += $width;
    }
    $barcodeX += 1;
    }
    $barcodeSvg = 'data:image/svg+xml;base64,' . base64_encode('<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 ' . $barcodeX . ' 34" preserveAspectRatio="none">' . $barcodeBars . '</svg>');
    $carrierLogoSrc = $carrier['logo_url'] ?? '';
    if (is_string($carrierLogoSrc) && $carrierLogoSrc !== '' && is_file($carrierLogoSrc)) {
    $extension = strtolower(pathinfo($carrierLogoSrc, PATHINFO_EXTENSION));
    $mimeType = $extension === 'svg' ? 'image/svg+xml' : ('image/' . ($extension === 'jpg' ? 'jpeg' : $extension));
    $carrierLogoSrc = 'data:' . $mimeType . ';base64,' . base64_encode(file_get_contents($carrierLogoSrc));
    }
    $chargeTab = function (string $text, int $width = 180, int $fontSize = 12): string {
    $height = 24;
    $notch = 24;
    $centerX = $width / 2;
    $trapezoidBottom = $height - 3;
    $safeText = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 ' . $width . ' ' . $height . '" preserveAspectRatio="none">'
        . '
        <path d="M1 0 L' . ($width - 1) . ' 0 L' . ($width - $notch) . ' ' . $trapezoidBottom . ' L' . $notch . ' ' . $trapezoidBottom . ' Z" fill="#fff" stroke="#000" stroke-width="2" />'
        . '
        <line x1="' . $centerX . '" y1="' . $trapezoidBottom . '" x2="' . $centerX . '" y2="' . $height . '" stroke="#000" stroke-width="2" />'
        . '<text x="' . ($width / 2) . '" y="16" text-anchor="middle" font-family="Arial, Helvetica, sans-serif" font-size="' . $fontSize . '" font-weight="400" fill="#000">' . $safeText . '</text>'
        . '
    </svg>';

    return 'data:image/svg+xml;base64,' . base64_encode($svg);
    };
    $rateChargeHeading = function (): string {
    $width = 160;
    $height = 60;
    $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 ' . $width . ' ' . $height . '" preserveAspectRatio="none">'
        . '
        <line x1="62" y1="42" x2="118" y2="16" stroke="#000" stroke-width="2" />'
        . '<text x="52" y="24" text-anchor="middle" font-family="Arial, Helvetica, sans-serif" font-size="12" font-weight="400" fill="#000">Rate</text>'
        . '<text x="108" y="46" text-anchor="middle" font-family="Arial, Helvetica, sans-serif" font-size="12" font-weight="400" fill="#000">Charge</text>'
        . '
    </svg>';

    return 'data:image/svg+xml;base64,' . base64_encode($svg);
    };
    $routingDestinationTab = function (string $text): string {
    $width = 190;
    $height = 24;
    $bottomInset = 45;
    $safeText = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 ' . $width . ' ' . $height . '" preserveAspectRatio="none">'
        . '
        <path d="M1 1 L' . $bottomInset . ' ' . ($height - 1) . ' L' . ($width - $bottomInset) . ' ' . ($height - 1) . ' L' . ($width - 1) . ' 1" fill="none" stroke="#000" stroke-width="2" />'
        . '<text x="' . ($width / 2) . '" y="15" text-anchor="middle" font-family="Arial, Helvetica, sans-serif" font-size="11" font-weight="400" fill="#000">' . $safeText . '</text>'
        . '
    </svg>';

    return 'data:image/svg+xml;base64,' . base64_encode($svg);
    };
    $requestedFlightTermsTab = function (string $text): string {
    $width = 190;
    $height = 30;
    $trapezoidBottom = 22;
    $bottomInset = 45;
    $centerX = $width / 2;
    $safeText = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
    $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 ' . $width . ' ' . $height . '" preserveAspectRatio="none">'
        . '
        <path d="M1 1 L' . $bottomInset . ' ' . $trapezoidBottom . ' L' . ($width - $bottomInset) . ' ' . $trapezoidBottom . ' L' . ($width - 1) . ' 1" fill="none" stroke="#000" stroke-width="2" />'
        . '
        <line x1="' . $centerX . '" y1="' . $trapezoidBottom . '" x2="' . $centerX . '" y2="' . $height . '" stroke="#000" stroke-width="2" />'
        . '<text x="' . $centerX . '" y="15" text-anchor="middle" font-family="Arial, Helvetica, sans-serif" font-size="9" font-weight="400" fill="#000">' . $safeText . '</text>'
        . '
    </svg>';

    return 'data:image/svg+xml;base64,' . base64_encode($svg);
    };
    @endphp
    <div class="page">
        <div class="top-bar">
            <div class="barcode"><img src="{{ $barcodeSvg }}" alt="Barcode for {{ $awbNumber }}"></div>
            <div class="awb-number">{{ $awb['awb_number'] ?? '' }}</div>
        </div>

        <table class="charge-footer-grid">
            <colgroup>
                <col style="width: 24%;">
                <col style="width: 25%;">
                <col style="width: 51%;">
            </colgroup>
            <tr>
                <td class="h-27" colspan="2" rowspan="2" style="width: 49%;">
                    <span class="label">{{ $shipper['label'] ?? "Shipper's Name and Address" }}</span>
                    <span class="value">{{ $shipper['name'] ?? '' }}
                        {{ $shipper['address'] ?? '' }}
                        {{ $shipper['phone'] ?? '' }}
                        {{ $shipper['contact'] ?? '' }}</span>
                </td>
                <td class="h-20" style="width: 51%;">
                    @if (! empty($carrierLogoSrc))
                    <div class="logo"><img src="{{ $carrierLogoSrc }}" alt="{{ $carrier['logo_alt'] ?? 'Carrier logo' }}"></div>
                    @endif
                    <span class="bold">Not Negotiable</span><br>
                    <span class="header-title">HOUSE AIR WAYBILL</span><br>
                    <span>issued By</span><br>
                    <span class="bold medium">{{ $carrier['issued_by'] ?? '' }}</span><br>
                    <span class="bold">{{ $carrier['address'] ?? '' }}</span><br>
                    <span class="bold">{{ $carrier['phone'] ?? '' }}</span>
                </td>
            </tr>
            <tr>
                <td class="copy-validity-cell">Copies 1, 2 and 3 of this Air waybill are originals and have the same validity</td>
            </tr>
            <tr>
                <td class="h-27" colspan="2">
                    <span class="label">{{ $consignee['label'] ?? "Consignee's Name and Address" }}</span>
                    <span class="value">{{ $consignee['name'] ?? '' }}
                        {{ $consignee['address'] ?? '' }}
                        {{ $consignee['phone'] ?? '' }}
                        {{ $consignee['contact'] ?? '' }}</span>
                </td>
                <td class="h-27">
                    <div class="notice copy-notice">
                        It is agreed that the goods described herein are accepted in apparent good order and condition
                        (except as noted) for carriage SUBJECT TO THE CONDITIONS OF CONTRACT ON THE REVERSE HEREOF.
                        ALL GOODS MAY BE CARRIED BY ANY OTHER MEANS INCLUDING ROAD OR ANY OTHER CARRIER UNLESS
                        SPECIFIC CONTRARY INSTRUCTIONS ARE GIVEN HEREON BY THE SHIPPER, AND SHIPPER AGREES THAT
                        THE SHIPMENT MAY BE CARRIED VIA IMMEDIATE STOPPING PLACES WHICH THE CARRIER DEEMS
                        APPROPRIATE. THE SHIPPER'S ATTENTION IS DRAWN TO THE NOTICE CONCERNING CARRIER
                        LIMITATION OF LIABILITY.
                    </div>
                </td>
            </tr>
            <tr>
                <td class="h-25" colspan="2">
                    <span class="label">Issuing Carrier's Agent Name and City</span>
                    <span class="value">{{ $agent['name_city'] ?? '' }}</span>
                </td>
                <td class="h-25" rowspan="2">
                    <span class="label">Account Information</span>
                    <span class="value value-small">{{ $awb['account_information'] ?? '' }}</span>
                </td>
            </tr>
            <tr>
                <td class="h-10" style="width: 24%;">
                    <span class="label">Agent IATA Code</span>
                    <span class="value value-small">{{ $agent['iata_code'] ?? '' }}</span>
                </td>
                <td class="h-10" style="width: 25%;">
                    <span class="label">Account No</span>
                    <span class="value value-small">{{ $agent['account_no'] ?? '' }}</span>
                </td>
            </tr>
        </table>

        <table>
            <colgroup>
                <col style="width: 49%;">
                <col style="width: 22.8%;">
                <col style="width: 28.2%;">
            </colgroup>
            <tr>
                <td class="h-11 no-top-border" style="width:49%">
                    <span class="label">Airport of Departure (Addr of First Carrier) and Requested Routing</span>
                    <span class="value value-small">{{ $routing['departure_airport'] ?? '' }}</span>
                </td>
                <td class="h-11 no-top-border"></td>
                <td class="h-11 no-top-border"></td>
            </tr>
        </table>

        <table>
            <tr>
                <td class="route-cell no-top-border" rowspan="2" style="width: 5.5%;">
                    <span class="label">To</span>
                    <span class="value value-small">{{ $routing['to'] ?? '' }}</span>
                </td>
                <td class="route-cell first-carrier-cell no-top-border" rowspan="2" style="width: 23%;">
                    <table class="first-carrier-heading">
                        <tr>
                            <td class="first-carrier-label" style="width: 36%;"><span class="label">By First Carrier</span></td>
                            <td class="routing-destination-tab" style="width: 64%;">
                                <img src="{{ $routingDestinationTab('Routing and Destination') }}" alt="Routing and Destination">
                            </td>
                        </tr>
                    </table>
                    <span class="value value-small">{{ $routing['first_carrier'] ?? '' }}</span>
                </td>
                <td class="route-cell no-top-border" rowspan="2" style="width: 5.125%;"><span class="label">to</span></td>
                <td class="route-cell no-top-border" rowspan="2" style="width: 5.125%;"><span class="label">by</span></td>
                <td class="route-cell no-top-border" rowspan="2" style="width: 5.125%;"><span class="label">to</span></td>
                <td class="route-cell no-top-border" rowspan="2" style="width: 5.125%;"><span class="label">by</span></td>
                <td class="route-cell no-top-border" rowspan="2" style="width: 3.8%;"><span class="label">CUR</span><span class="value value-small">{{ $routing['currency'] ?? '' }}</span></td>
                <td class="route-cell no-top-border" rowspan="2" style="width: 3.8%;"><span class="label tiny">CHGS<br>Code</span><span class="value value-small">{{ $routing['charges_code'] ?? '' }}</span></td>
                <td class="route-group-heading no-top-border" colspan="2" style="width: 7.6%;"><span class="label-center tiny">WT/VAL</span></td>
                <td class="route-group-heading no-top-border" colspan="2" style="width: 7.6%;"><span class="label-center tiny">Other</span></td>
                <td class="route-cell no-top-border no-left-border" rowspan="2" style="width: 13.9%;">
                    <span class="label-center">Declared Value for Carriage</span>
                    <span class="value value-small value-center">{{ $routing['declared_carriage'] ?? '' }}</span>
                </td>
                <td class="route-cell no-top-border" rowspan="2" style="width: 14.3%;">
                    <span class="label-center">Declared Value for Customs</span>
                    <span class="value value-small value-center">{{ $routing['declared_customs'] ?? '' }}</span>
                </td>
            </tr>
            <tr>
                <td class="route-subcell" style="width: 3.8%;"><span class="label tiny">PPD</span><span class="value value-small">{{ $routing['wt_val_ppd'] ?? '' }}</span></td>
                <td class="route-subcell" style="width: 3.8%;"><span class="label tiny">COLL</span><span class="value value-small">{{ $routing['wt_val_coll'] ?? '' }}</span></td>
                <td class="route-subcell" style="width: 3.8%;"><span class="label tiny">PPD</span><span class="value value-small">{{ $routing['other_ppd'] ?? '' }}</span></td>
                <td class="route-subcell" style="width: 3.8%;"><span class="label tiny">COLL</span><span class="value value-small">{{ $routing['other_coll'] ?? '' }}</span></td>
            </tr>
        </table>

        <table>
            <tr>
                <td class="h-13 no-top-border" style="width: 24.5%;">
                    <span class="label-center">Airport of Destination</span>
                    <span class="value value-small">{{ $routing['destination_airport'] ?? '' }}</span>
                </td>
                <td class="h-13 requested-flight-cell no-top-border" style="width: 24.5%;">
                    <div class="requested-flight-tab">
                        <img src="{{ $requestedFlightTermsTab('Requested Flight/Terms') }}" alt="Requested Flight/Terms">
                    </div>
                    <table class="requested-flight-fill">
                        <tr>
                            <td><span class="value value-small">{{ $routing['requested_flight_terms'] ?? '' }}</span></td>
                            <td></td>
                        </tr>
                    </table>
                </td>
                <td class="h-13 no-top-border" style="width: 12%;">
                    <span class="label-center">Amount of Insurance</span>
                    <span class="value value-small value-center">{{ $routing['amount_insurance'] ?? '' }}</span>
                </td>
                <td class="h-13 no-top-border" style="width: 39%;">
                    <span class="label">INSURANCE - If carrier offers insurance and such insurance is requested in accordance with the conditions hereof, indicate amount to be insure in figures in box marked 'Amount of Insurance'</span>
                </td>
            </tr>
            <tr>
                <td class="h-12" colspan="4">
                    <span class="label">Handling information</span>
                    <span class="value value-small">{{ $awb['handling_information'] ?? '' }}</span>
                </td>
            </tr>
        </table>

        <table class="goods-table">
            <tr class="goods-heading">
                <td class="no-top-border" style="width: 4.5%;">No. of<br>Pieces<br>RCP</td>
                <td class="no-top-border" style="width: 9%;">Gross<br>Weight</td>
                <td class="no-top-border" style="width: 3%;">kg<br>lb</td>
                <td class="rate-commodity-heading-cell double-right-border no-top-border">
                    <table class="rate-commodity-heading">
                        <tr>
                            <td class="rate-commodity-heading-code"></td>
                            <td class="rate-commodity-heading-label rate-commodity-heading-rate">Rate Class</td>
                        </tr>
                        <tr>
                            <td class="rate-commodity-heading-commodity-code"></td>
                            <td class="rate-commodity-heading-label">Commodity<br>Item No.</td>
                        </tr>
                    </table>
                </td>
                <!-- td class="rate-commodity-cell no-bottom-border hidden-bottom-border double-right-border" style="width: 10.5%;">
                    <div class="rate-commodity-row rate-class-row">
                        <div class="rate-commodity-code"></div>
                        <div class="rate-commodity-main">Rate Class</div>
                    </div>
                    <div class="rate-commodity-row commodity-row">
                        <div class="rate-commodity-code"></div>
                        <div class="rate-commodity-main">Commodity<br>Item No.</div>
                    </div>
                </td -->
                <td class="double-right-border no-top-border" style="width: 12%;">Chargeable<br>weight</td>
                <td class="double-right-border rate-charge-heading no-top-border" style="width: 12.5%;">
                    <img src="{{ $rateChargeHeading() }}" alt="Rate/Charge">
                </td>
                <td class="double-right-border no-top-border" style="width: 13%;">Total</td>
                <td class="no-top-border" style="width: 35.5%; text-align: left;">Nature and Quantity of Goods<br>(Incl Dimension or Volume)</td>
            </tr>
            <tr class="goods-row">
                <td class="goods-stack-cell">
                    <div class="goods-stack-block">
                        <div class="goods-stack-top"><span class="value value-center">{{ $firstGoods['pieces'] ?? '' }}</span></div>
                        <div class="goods-stack-bottom"><span class="value value-center">{{ $totals['pieces'] ?? '' }}</span></div>
                    </div>
                </td>
                <td class="goods-stack-cell">
                    <div class="goods-stack-block">
                        <div class="goods-stack-top"><span class="value value-center">{{ $firstGoods['gross_weight'] ?? '' }}</span></div>
                        <div class="goods-stack-bottom"><span class="value value-center">{{ $totals['gross_weight'] ?? '' }}</span></div>
                    </div>
                </td>
                <td><span class="value value-center">K</span></td>
                <td class="rate-commodity-cell no-top-border hidden-top-border double-right-border">
                    <div class="rate-commodity-body">
                        <div class="rate-commodity-body-code"><span class="value value-center">Q</span></div>
                        <div class="rate-commodity-body-main"></div>
                    </div>
                </td>
                <td class="double-right-border"><span class="value value-small value-center">{{ $firstGoods['chargeable_weight'] ?? '' }}</span></td>
                <td class="double-right-border"><span class="value value-small value-center">{{ $firstGoods['rate_charge'] ?? '' }}</span></td>
                <td class="goods-stack-cell double-right-border">
                    <div class="goods-stack-block">
                        <div class="goods-stack-top"><span class="value value-small value-center">{{ $firstGoods['total'] ?? '' }}</span></div>
                        <div class="goods-stack-bottom"><span class="value value-small value-center">{{ $totals['total_rate_total'] ?? ($firstGoods['total'] ?? '') }}</span></div>
                    </div>
                </td>
                <td><span class="value value-small">{{ $firstGoods['description'] ?? '' }}</span></td>
            </tr>
        </table>

        <table class="charge-grid">
            <tr>
                <td class="h-10 split-charge-cell no-top-border" colspan="2" style="width: 34%;">
                    <table class="charge-tabs-strip">
                        <tr>
                            <td style="width: 31%;">
                                <div class="charge-tab tab-small"><img src="{{ $chargeTab('Prepaid', 130) }}" alt="Prepaid"></div>
                            </td>
                            <td style="width: 38%;">
                                <div class="charge-tab tab-small"><img src="{{ $chargeTab('Weight Charge', 170) }}" alt="Weight Charge"></div>
                            </td>
                            <td style="width: 31%;">
                                <div class="charge-tab tab-small"><img src="{{ $chargeTab('Collect', 130) }}" alt="Collect"></div>
                            </td>
                        </tr>
                    </table>
                    <table class="split-charge-fill">
                        <tr>
                            <td style="width: 50%;">
                                <span class="value value-small value-center">{{ $totals['weight_charge_prepaid'] ?? '' }}</span>
                            </td>
                            <td style="width: 50%;">
                                <span class="value value-small value-center">{{ $totals['weight_charge_collect'] ?? '' }}</span>
                            </td>
                        </tr>
                    </table>
                </td>
                <td class="other-charges-box no-top-border" style="width: 66%;" rowspan="3">
                    <span class="label">Other Charges</span>
                    <span class="value value-small">{{ $totals['other_charges'] ?? '' }}</span>
                </td>
            </tr>
            <tr>
                <td class="h-9 split-charge-cell" colspan="2">
                    <div class="charge-tab tab-wide"><img src="{{ $chargeTab('Total Other Charges Due Agent', 260) }}" alt="Total Other Charges Due Agent"></div>
                    <table class="split-charge-fill">
                        <tr>
                            <td style="width: 50%;"><span class="value value-small value-center">{{ $totals['total_other_due_agent'] ?? '' }}</span></td>
                            <td style="width: 50%;"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="h-9 split-charge-cell" colspan="2">
                    <div class="charge-tab tab-wide"><img src="{{ $chargeTab('Total Other Charges Due Carrier', 260) }}" alt="Total Other Charges Due Carrier"></div>
                    <table class="split-charge-fill">
                        <tr>
                            <td style="width: 50%;"><span class="value value-small value-center">{{ $totals['total_other_due_carrier'] ?? '' }}</span></td>
                            <td style="width: 50%;"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="h-9 split-charge-cell" colspan="2">
                    <div class="charge-tab tab-medium"><img src="{{ $chargeTab('Valuation Charges', 200) }}" alt="Valuation Charges"></div>
                    <table class="split-charge-fill">
                        <tr>
                            <td style="width: 50%;"><span class="value value-small value-center">{{ $totals['valuation_charges'] ?? '' }}</span></td>
                            <td style="width: 50%;"></td>
                        </tr>
                    </table>
                </td>
                <td class="h-9" rowspan="3">
                    <div class="certification">
                        Shipper certifies that the particulars on the face hereof are correct and that insofar as any
                        part of the consignment contains dangerous goods, such part is properly described by name
                        and is in proper condition for carriage by air according to applicable Dangerous Goods
                        Regulations.
                    </div>
                    <div class="signature">
                        <span class="value value-small">{{ $certification['shipper_signature'] ?? '' }}</span>
                        <div class="bold medium">Signature of Shipper or his agent</div>
                    </div>
                </td>
            </tr>
            <tr>
                <td class="h-9 split-charge-cell" colspan="2">
                    <div class="charge-tab tab-small"><img src="{{ $chargeTab('Tax', 130) }}" alt="Tax"></div>
                    <table class="split-charge-fill">
                        <tr>
                            <td style="width: 50%;"><span class="value value-small value-center">{{ $totals['tax'] ?? '' }}</span></td>
                            <td style="width: 50%;"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="h-9 split-charge-cell" colspan="2">
                    <table class="split-charge-fill">
                        <tr>
                            <td style="width: 50%;"><span class="value value-small value-center">{{ $totals['tax_prepaid'] ?? '' }}</span></td>
                            <td style="width: 50%;"><span class="value value-small value-center">{{ $totals['tax_collect'] ?? '' }}</span></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td class="h-9">
                    <div class="charge-tab tab-small"><img src="{{ $chargeTab('Total Prepaid', 130) }}" alt="Total Prepaid"></div>
                    <span class="value value-small value-center">{{ $totals['total_prepaid'] ?? '' }}</span>
                </td>
                <td class="h-9">
                    <div class="charge-tab tab-small"><img src="{{ $chargeTab('Total Collect', 130) }}" alt="Total Collect"></div>
                    <span class="value value-small value-center">{{ $totals['total_collect'] ?? '' }}</span>
                </td>
                <td class="no-bottom-border"></td>
            </tr>
        </table>

        <table>
            <tr>
                <td class="h-8 bottom-tab-cell" style="width: 17%;">
                    <div class="charge-tab tab-small"><img src="{{ $chargeTab('Currency conversion Rates', 160, 8) }}" alt="Currency conversion Rates"></div>
                    <span class="value value-small value-center">{{ $totals['currency_conversion_rates'] ?? '' }}</span>
                </td>
                <td class="h-8 bottom-tab-cell" style="width: 17%;">
                    <div class="charge-tab tab-small"><img src="{{ $chargeTab('Collect Charges in Destination Currency', 180, 9) }}" alt="Collect Charges in Destination Currency"></div>
                    <span class="value value-small value-center">{{ $totals['collect_charges_destination_currency'] ?? '' }}</span>
                </td>
                <td class="h-8 executed-summary-cell no-top-border" style="width: 66%;">
                    <div class="executed-summary-date">
                        <span class="value value-small">{{ $certification['executed_date'] ?? '' }} {{ $certification['executed_place'] ?? '' }}</span>
                    </div>
                    <table class="executed-summary-labels">
                        <tr>
                            <td style="width: 20%;">Executed on</td>
                            <td style="width: 13%;">(Date)</td>
                            <td style="width: 20%;">at</td>
                            <td style="width: 13%;">(Place)</td>
                            <td style="width: 34%;">Signature of Issuing Carrier or his agent</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="final-row">
                <td class="h-10">
                    <span class="label-center">For Carrier's Use only at Destination</span>
                </td>
                <td class="h-10 bottom-tab-cell">
                    <div class="charge-tab tab-small"><img src="{{ $chargeTab('Charges at Destination', 150, 8) }}" alt="Charges at Destination"></div>
                    <span class="value value-small value-center">{{ $totals['charges_at_destination'] ?? '' }}</span>
                </td>
                <td class="h-10 final-copy-area">
                    <table class="final-copy-table">
                        <tr>
                            <td class="signature-cell bottom-tab-cell total-collect-box" style="width: 25%;">
                                <div class="charge-tab tab-small"><img src="{{ $chargeTab('Total Collect Charges', 140, 8) }}" alt="Total Collect Charges"></div>
                                <span class="value value-small value-center">{{ $totals['total_collect_charges'] ?? '' }}</span>
                            </td>
                            <td class="footer-copy-cell" style="width: 75%;">
                                {{ $awb['copy_label'] ?? '' }}
                                <span class="copy-note">{{ $awb['copy_label_note'] ?? '' }}</span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        @if (! empty($carrierLogoSrc))
        <div class="destination-logo"><img src="{{ $carrierLogoSrc }}" alt="{{ $carrier['logo_alt'] ?? 'Carrier logo' }}"></div>
        @endif
    </div>
</body>

</html>