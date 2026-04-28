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
            height: 8mm;
            overflow: hidden;
            text-align: center;
        }

        .barcode img {
            width: 57mm;
            height: 8mm;
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

        .h-20 { height: 20mm; }
        .h-22 { height: 22mm; }
        .h-25 { height: 14mm; }
        .h-27 { height: 18mm; }
        .h-31 { height: 31mm; }
        .h-40 { height: 40mm; }
        .h-55 { height: 55mm; }
        .h-62 { height: 62mm; }
        .h-80 { height: 80mm; }
        .h-8 { height: 6mm; }
        .h-9 { height: 5mm; }
        .h-10 { height: 6mm; }
        .h-11 { height: 8mm; }
        .h-13 { height: 9mm; }
        .h-15 { height: 8mm; }

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

        .goods-heading td {
            height: 9mm;
            text-align: center;
            vertical-align: middle;
        }

        .goods-row td {
            height: 25mm;
        }

        .charges-row td {
            height: 6mm;
        }

        .copy-validity {
            height: 7mm;
            border-bottom: 0.35mm solid #000;
            padding: 1mm;
            font-weight: 700;
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

        .split-charge-cell > .charge-tab {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            z-index: 2;
        }

        .split-charge-fill td {
            border: 0;
            padding-top: 4mm;
        }

        .split-charge-fill td + td {
            border-left: 0.35mm solid #000;
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
        }

        .executed-summary-date {
            height: 5mm;
            padding: 1mm 1mm 0;
            border-bottom: 0.35mm solid #000;
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
            border-left: 0.35mm solid #000;
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
                $barcodeBars .= '<rect x="' . $barcodeX . '" y="0" width="' . $width . '" height="34" fill="#000"/>';
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
        $safeText = htmlspecialchars($text, ENT_QUOTES, 'UTF-8');
        $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 ' . $width . ' ' . $height . '" preserveAspectRatio="none">'
            . '<path d="M1 0 L' . ($width - 1) . ' 0 L' . ($width - $notch) . ' ' . ($height - 3) . ' L' . $notch . ' ' . ($height - 3) . ' Z" fill="#fff" stroke="#000" stroke-width="2"/>'
            . '<text x="' . ($width / 2) . '" y="16" text-anchor="middle" font-family="Arial, Helvetica, sans-serif" font-size="' . $fontSize . '" font-weight="400" fill="#000">' . $safeText . '</text>'
            . '</svg>';

        return 'data:image/svg+xml;base64,' . base64_encode($svg);
    };
@endphp
<div class="page">
    <div class="top-bar">
        <div class="barcode"><img src="{{ $barcodeSvg }}" alt="Barcode for {{ $awbNumber }}"></div>
        <div class="awb-number">{{ $awb['awb_number'] ?? '' }}</div>
    </div>

    <table class="charge-footer-grid">
        <tr>
            <td class="h-27" style="width: 49%;">
                <span class="label">{{ $shipper['label'] ?? "Shipper's Name and Address" }}</span>
                <span class="value">{{ $shipper['name'] ?? '' }}
{{ $shipper['address'] ?? '' }}
{{ $shipper['phone'] ?? '' }}
{{ $shipper['contact'] ?? '' }}</span>
            </td>
            <td class="h-27" style="width: 51%;">
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
            <td class="h-27">
                <span class="label">{{ $consignee['label'] ?? "Consignee's Name and Address" }}</span>
                <span class="value">{{ $consignee['name'] ?? '' }}
{{ $consignee['address'] ?? '' }}
{{ $consignee['phone'] ?? '' }}
{{ $consignee['contact'] ?? '' }}</span>
            </td>
            <td class="h-27">
                <div class="copy-validity">Copies 1, 2 and 3 of this Air waybill are originals and have the same validity</div>
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
            <td class="h-25">
                <span class="label">Issuing Carrier's Agent Name and City</span>
                <span class="value">{{ $agent['name_city'] ?? '' }}</span>
            </td>
            <td class="h-25">
                <span class="label">Account Information</span>
                <span class="value value-small">{{ $awb['account_information'] ?? '' }}</span>
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <td class="h-10" style="width: 24%;">
                <span class="label">Agent IATA Code</span>
                <span class="value value-small">{{ $agent['iata_code'] ?? '' }}</span>
            </td>
            <td class="h-10" style="width: 25%;">
                <span class="label">Account No</span>
                <span class="value value-small">{{ $agent['account_no'] ?? '' }}</span>
            </td>
            <td class="h-10" style="width: 51%;"></td>
        </tr>
        <tr>
            <td class="h-11" colspan="3">
                <span class="label">Airport of Departure (Addr of First Carrier) and Requested Routing</span>
                <span class="value value-small">{{ $routing['departure_airport'] ?? '' }}</span>
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <td class="route-cell" style="width: 5.5%;">
                <span class="label">To</span>
                <span class="value value-small">{{ $routing['to'] ?? '' }}</span>
            </td>
            <td class="route-cell" style="width: 23%;">
                <span class="label">By First Carrier</span>
                <span class="label-center">Routing and Destination</span>
                <span class="value value-small">{{ $routing['first_carrier'] ?? '' }}</span>
            </td>
            <td class="route-cell" style="width: 5.5%;"><span class="label">to</span></td>
            <td class="route-cell" style="width: 5.5%;"><span class="label">by</span></td>
            <td class="route-cell" style="width: 5.5%;"><span class="label">to</span></td>
            <td class="route-cell" style="width: 5.5%;"><span class="label">by</span></td>
            <td class="route-cell" style="width: 4.5%;"><span class="label">CUR</span><span class="value value-small">{{ $routing['currency'] ?? '' }}</span></td>
            <td class="route-cell" style="width: 4.5%;"><span class="label tiny">CHGS<br>Code</span><span class="value value-small">{{ $routing['charges_code'] ?? '' }}</span></td>
            <td class="route-cell" style="width: 4.5%;"><span class="label tiny">WT/VAL<br>PPD</span><span class="value value-small">{{ $routing['wt_val_ppd'] ?? '' }}</span></td>
            <td class="route-cell" style="width: 4.5%;"><span class="label tiny">COLL</span><span class="value value-small">{{ $routing['wt_val_coll'] ?? '' }}</span></td>
            <td class="route-cell" style="width: 4.5%;"><span class="label tiny">Other<br>PPD</span><span class="value value-small">{{ $routing['other_ppd'] ?? '' }}</span></td>
            <td class="route-cell" style="width: 4.5%;"><span class="label tiny">COLL</span><span class="value value-small">{{ $routing['other_coll'] ?? '' }}</span></td>
            <td class="route-cell" style="width: 16.5%;">
                <span class="label-center">Declared Value for Carriage</span>
                <span class="value value-small value-center">{{ $routing['declared_carriage'] ?? '' }}</span>
            </td>
            <td class="route-cell" style="width: 17%;">
                <span class="label-center">Declared Value for Customs</span>
                <span class="value value-small value-center">{{ $routing['declared_customs'] ?? '' }}</span>
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <td class="h-13" style="width: 24.5%;">
                <span class="label-center">Airport of Destination</span>
                <span class="value value-small">{{ $routing['destination_airport'] ?? '' }}</span>
            </td>
            <td class="h-13" style="width: 24.5%;">
                <span class="label-center">Requested Flight/Terms</span>
                <span class="value value-small">{{ $routing['requested_flight_terms'] ?? '' }}</span>
            </td>
            <td class="h-13" style="width: 12%;">
                <span class="label-center">Amount of Insurance</span>
                <span class="value value-small value-center">{{ $routing['amount_insurance'] ?? '' }}</span>
            </td>
            <td class="h-13" style="width: 39%;">
                <span class="label">INSURANCE - If carrier offers insurance and such insurance is requested in accordance with the conditions hereof, indicate amount to be insure in figures in box marked 'Amount of Insurance'</span>
            </td>
        </tr>
        <tr>
            <td class="h-15" colspan="4">
                <span class="label">Handling information</span>
                <span class="value value-small">{{ $awb['handling_information'] ?? '' }}</span>
            </td>
        </tr>
    </table>

    <table>
        <tr class="goods-heading">
            <td style="width: 4.5%;">No. of<br>Pieces<br>RCP</td>
            <td style="width: 9%;">Gross<br>Weight</td>
            <td style="width: 3%;">kg<br>lb</td>
            <td style="width: 10.5%;">Rate Class<br>Commodity<br>Item No.</td>
            <td style="width: 12%;">Chargeable<br>weight</td>
            <td style="width: 12.5%;">Rate<br>Charge</td>
            <td style="width: 13%;">Total</td>
            <td style="width: 35.5%; text-align: left;">Nature and Quantity of Goods<br>(Incl Dimension or Volume)</td>
        </tr>
        <tr class="goods-row">
            <td><span class="value value-center">{{ $firstGoods['pieces'] ?? '' }}</span></td>
            <td><span class="value value-center">{{ $firstGoods['gross_weight'] ?? '' }}</span></td>
            <td><span class="value value-center">{{ $firstGoods['kg_lb'] ?? '' }}</span></td>
            <td>
                <span class="value value-small value-center">{{ $firstGoods['rate_class'] ?? '' }}</span>
                <span class="value value-small value-center">{{ $firstGoods['commodity_item_no'] ?? '' }}</span>
            </td>
            <td><span class="value value-small value-center">{{ $firstGoods['chargeable_weight'] ?? '' }}</span></td>
            <td><span class="value value-small value-center">{{ $firstGoods['rate_charge'] ?? '' }}</span></td>
            <td><span class="value value-small value-center">{{ $firstGoods['total'] ?? '' }}</span></td>
            <td><span class="value value-small">{{ $firstGoods['description'] ?? '' }}</span></td>
        </tr>
        <tr class="charges-row">
            <td><span class="value value-center">{{ $totals['pieces'] ?? '' }}</span></td>
            <td><span class="value value-center">{{ $totals['gross_weight'] ?? '' }}</span></td>
            <td colspan="4"></td>
            <td><span class="value value-small value-center">{{ $totals['total_rate_total'] ?? '' }}</span></td>
            <td></td>
        </tr>
    </table>

    <table class="charge-grid">
        <tr>
            <td class="h-10 split-charge-cell" colspan="2" style="width: 34%;">
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
            <td class="other-charges-box" style="width: 66%;" rowspan="3">
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
            <td class="h-9">
                <div class="charge-tab tab-small"><img src="{{ $chargeTab('Total Prepaid', 130) }}" alt="Total Prepaid"></div>
                <span class="value value-small value-center">{{ $totals['total_prepaid'] ?? '' }}</span>
            </td>
            <td class="h-9">
                <div class="charge-tab tab-small"><img src="{{ $chargeTab('Total Collect', 130) }}" alt="Total Collect"></div>
                <span class="value value-small value-center">{{ $totals['total_collect'] ?? '' }}</span>
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <td class="h-8 bottom-tab-cell" style="width: 17%;">
                <div class="charge-tab tab-small"><img src="{{ $chargeTab('Currency conversion Rates', 160) }}" alt="Currency conversion Rates"></div>
                <span class="value value-small value-center">{{ $totals['currency_conversion_rates'] ?? '' }}</span>
            </td>
            <td class="h-8 bottom-tab-cell" style="width: 17%;">
                <div class="charge-tab tab-small"><img src="{{ $chargeTab('Collect Charges in Destination Currency', 180, 9) }}" alt="Collect Charges in Destination Currency"></div>
                <span class="value value-small value-center">{{ $totals['collect_charges_destination_currency'] ?? '' }}</span>
            </td>
            <td class="h-8 executed-summary-cell" style="width: 66%;">
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
                <div class="charge-tab tab-small"><img src="{{ $chargeTab('Charges at Destination', 150) }}" alt="Charges at Destination"></div>
                <span class="value value-small value-center">{{ $totals['charges_at_destination'] ?? '' }}</span>
            </td>
            <td class="h-10 final-copy-area">
                <table class="final-copy-table">
                    <tr>
                        <td class="signature-cell bottom-tab-cell total-collect-box" style="width: 25%;">
                            <div class="charge-tab tab-small"><img src="{{ $chargeTab('Total Collect Charges', 140) }}" alt="Total Collect Charges"></div>
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
