<?php

namespace App\Support;

final class AwbSampleData
{
    /**
     * Sample values transcribed from the provided AWB reference image.
     *
     * Replace this method with application data from a model, request, service,
     * or DTO when integrating into the final Laravel application.
     */
    public static function make(): array
    {
        return [
            'awb_number' => 'TFC20246899',
            'copy_label' => 'ORIGINAL 1',
            'copy_label_note' => '(FOR CARRIER)',
            'shipper' => [
                'label' => "Shipper's Name and Address",
                'name' => 'ABC EXPORTER SND BND',
                'address' => "KWANG 264, PADUNGAN ROAD,\nKUCHING\nMALAYSIA",
                'phone' => 'T:46465 F:12346',
                'contact' => 'THE DIRECTOR',
            ],
            'consignee' => [
                'label' => "Consignee's Name and Address",
                'name' => 'AYZ IMPORTER GMBH',
                'address' => "RIEMER STRASSE 350, D - 81829\nMUNICH\nGERMANY",
                'phone' => 'T:123987 F:654123',
                'contact' => 'PURCHASING OFFICER',
            ],
            'agent' => [
                'name_city' => "MY FREIGHT FORWARDING COMPANY LTD\nMALAYSIA",
                'iata_code' => '',
                'account_no' => '',
            ],
            'carrier' => [
                'issued_by' => 'MY FREIGHT FORWARDING COMPANY LTD',
                'address' => '30, DEMO FREIGHT BUILDING KUALA LUMPUR Malaysia',
                'phone' => 'T:+000000 F:+000000',
                'logo_url' => public_path('images/rufaatrack-logo.svg'),
                'logo_alt' => 'rufaatrack',
            ],
            'routing' => [
                'departure_airport' => 'KUALA LUMPUR INTERNATIONAL',
                'to' => 'FRA',
                'first_carrier' => '',
                'destination_airport' => 'FRANKFURT INTERNATIO',
                'currency' => '',
                'charges_code' => '',
                'wt_val_ppd' => '',
                'wt_val_coll' => '',
                'other_ppd' => '',
                'other_coll' => '',
                'declared_carriage' => 'N V D',
                'declared_customs' => 'N C V',
                'amount_insurance' => 'NIL',
                'requested_flight_terms' => '',
            ],
            'account_information' => '',
            'handling_information' => '',
            'goods' => [
                [
                    'pieces' => '13',
                    'gross_weight' => '147',
                    'kg_lb' => 'KQ',
                    'rate_class' => '',
                    'commodity_item_no' => '',
                    'chargeable_weight' => '',
                    'rate_charge' => 'AS AGREED',
                    'total' => 'AS AGREED',
                    'description' => "Shipper's load, stow, and count\nFOOD STUFF\n3.78",
                ],
            ],
            'totals' => [
                'pieces' => '13',
                'gross_weight' => '147',
                'weight_charge_prepaid' => '',
                'weight_charge_collect' => '',
                'other_charges' => 'AS AGREED',
                'total_rate_total' => 'AS AGREED',
                'total_other_due_agent' => '',
                'total_other_due_carrier' => '',
                'valuation_charges' => '',
                'tax' => '',
                'total_prepaid' => '',
                'total_collect' => '',
                'currency_conversion_rates' => '',
                'collect_charges_destination_currency' => '',
                'charges_at_destination' => '',
                'total_collect_charges' => '',
            ],
            'certification' => [
                'shipper_signature' => 'MY FREIGHT FORWARDING COMPANY LTD',
                'executed_date' => '2 January 2010',
                'executed_place' => 'KUALA LUMPUR INTERNATIONAL',
                'carrier_signature' => '',
            ],
        ];
    }
}
