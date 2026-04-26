<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Air Waybill {{ $awb['awb_number'] ?? '' }}</title>
    <style>
        @page {
            size: A4 portrait;
            margin: 6mm;
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
            width: 198mm;
            min-height: 285mm;
            margin: 0 auto;
            position: relative;
        }

        .top-bar {
            height: 10mm;
            position: relative;
        }

        .barcode {
            position: absolute;
            left: 69mm;
            top: 0;
            width: 55mm;
            height: 9mm;
            overflow: hidden;
            font-family: "Courier New", monospace;
            font-size: 20px;
            font-weight: 700;
            line-height: 9mm;
            letter-spacing: 0;
            white-space: nowrap;
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
        .h-25 { height: 25mm; }
        .h-27 { height: 27mm; }
        .h-31 { height: 31mm; }
        .h-40 { height: 40mm; }
        .h-55 { height: 55mm; }
        .h-62 { height: 62mm; }
        .h-80 { height: 80mm; }
        .h-8 { height: 8mm; }
        .h-9 { height: 9mm; }
        .h-10 { height: 10mm; }
        .h-11 { height: 11mm; }
        .h-13 { height: 13mm; }
        .h-15 { height: 15mm; }

        .header-title {
            font-size: 20px;
            font-weight: 700;
            line-height: 1;
        }

        .logo {
            float: right;
            width: 29mm;
            height: 20mm;
            text-align: center;
            color: #306bff;
            font-size: 16px;
            font-weight: 700;
            padding-top: 6mm;
        }

        .logo span {
            color: #7ad33a;
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
            height: 12mm;
        }

        .goods-heading td {
            height: 9mm;
            text-align: center;
            vertical-align: middle;
        }

        .goods-row td {
            height: 59mm;
        }

        .charges-row td {
            height: 10mm;
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

        .footer-copy {
            position: absolute;
            right: 0;
            bottom: -3mm;
            text-align: right;
            font-weight: 700;
            font-size: 35px;
            line-height: 0.85;
        }

        .footer-copy .copy-note {
            display: block;
            font-size: 17px;
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
@endphp
<div class="page">
    <div class="top-bar">
        <div class="barcode">||||||||||||||||||||||||||||||||||||||||</div>
        <div class="awb-number">{{ $awb['awb_number'] ?? '' }}</div>
    </div>

    <table>
        <tr>
            <td class="h-27" style="width: 49%;">
                <span class="label">{{ $shipper['label'] ?? "Shipper's Name and Address" }}</span>
                <span class="value">{{ $shipper['name'] ?? '' }}
{{ $shipper['address'] ?? '' }}
{{ $shipper['phone'] ?? '' }}
{{ $shipper['contact'] ?? '' }}</span>
            </td>
            <td class="h-27" style="width: 51%;">
                <div class="logo">{{ $carrier['logo_text'] ?? '' }}<br><span class="tiny">{{ $carrier['logo_url'] ?? '' }}</span></div>
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
                <div class="bold" style="margin-bottom: 5mm;">Copies 1, 2 and 3 of this Air waybill are originals and have the same validity</div>
                <div class="notice">
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
            <td colspan="4">
                <span class="label">Other Charges</span>
                <span class="value value-small">{{ $totals['other_charges'] ?? '' }}</span>
            </td>
            <td><span class="value value-small value-center">{{ $totals['total_rate_total'] ?? '' }}</span></td>
            <td></td>
        </tr>
    </table>

    <table>
        <tr>
            <td class="h-10" style="width: 17%;">
                <span class="label-center">Prepaid</span>
                <span class="value value-small value-center">{{ $totals['weight_charge_prepaid'] ?? '' }}</span>
            </td>
            <td class="h-10" style="width: 17%;">
                <span class="label-center">Weight Charge</span>
                <span class="value value-small value-center">{{ $totals['weight_charge_collect'] ?? '' }}</span>
            </td>
            <td class="h-10" style="width: 66%;"></td>
        </tr>
        <tr>
            <td class="h-9" colspan="2">
                <span class="label-center">Total Other Charges Due Agent</span>
                <span class="value value-small value-center">{{ $totals['total_other_due_agent'] ?? '' }}</span>
            </td>
            <td class="h-9" rowspan="5">
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
            <td class="h-9" colspan="2">
                <span class="label-center">Total Other Charges Due Carrier</span>
                <span class="value value-small value-center">{{ $totals['total_other_due_carrier'] ?? '' }}</span>
            </td>
        </tr>
        <tr>
            <td class="h-9" colspan="2">
                <span class="label-center">Valuation Charges</span>
                <span class="value value-small value-center">{{ $totals['valuation_charges'] ?? '' }}</span>
            </td>
        </tr>
        <tr>
            <td class="h-9" colspan="2">
                <span class="label-center">Tax</span>
                <span class="value value-small value-center">{{ $totals['tax'] ?? '' }}</span>
            </td>
        </tr>
        <tr>
            <td class="h-9">
                <span class="label-center">Total Prepaid</span>
                <span class="value value-small value-center">{{ $totals['total_prepaid'] ?? '' }}</span>
            </td>
            <td class="h-9">
                <span class="label-center">Total Collect</span>
                <span class="value value-small value-center">{{ $totals['total_collect'] ?? '' }}</span>
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <td class="h-8" style="width: 17%;">
                <span class="label-center">Currency conversion Rates</span>
                <span class="value value-small value-center">{{ $totals['currency_conversion_rates'] ?? '' }}</span>
            </td>
            <td class="h-8" style="width: 17%;">
                <span class="label-center">Collect Charges in Destination Currency</span>
                <span class="value value-small value-center">{{ $totals['collect_charges_destination_currency'] ?? '' }}</span>
            </td>
            <td class="h-8" style="width: 66%;">
                <span class="value value-small">{{ $certification['executed_date'] ?? '' }} {{ $certification['executed_place'] ?? '' }}</span>
            </td>
        </tr>
        <tr>
            <td class="h-10">
                <span class="label-center">For Carrier's Use only at Destination</span>
            </td>
            <td class="h-10">
                <span class="label-center">Charges at Destination</span>
                <span class="value value-small value-center">{{ $totals['charges_at_destination'] ?? '' }}</span>
            </td>
            <td class="h-10">
                <table>
                    <tr>
                        <td class="no-border" style="width: 30%; text-align: center;">
                            Executed on<br>{{ $certification['executed_date'] ?? '' }}
                        </td>
                        <td class="no-border" style="width: 30%; text-align: center;">
                            at<br>{{ $certification['executed_place'] ?? '' }}
                        </td>
                        <td class="no-border" style="width: 40%; text-align: center;">
                            Signature of Issuing Carrier or his agent<br>{{ $certification['carrier_signature'] ?? '' }}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <div class="footer-copy">
        {{ $awb['copy_label'] ?? '' }}
        <span class="copy-note">{{ $awb['copy_label_note'] ?? '' }}</span>
    </div>
</div>
</body>
</html>
