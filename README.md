# AWB Html for DOMPDF Compatible

## Job Title

AWB Html for DOMPDF Compatible

## Job Description

Airway Bill (AWB) is a standard IATA document used for cargo shipment.

This project requires PHP, HTML, and CSS work to build a web-based Airway Bill layout that visually matches the provided AWB reference image and renders correctly through the DOMPDF library. The final HTML/CSS must be suitable for use inside a Laravel-compatible application, where application data can be passed into the template and exported or downloaded as a PDF on the client screen.

The layout must support dynamic placement of all AWB values into their corresponding boxes, matching the structure shown in the attachment.

## Scope

- Build an AWB HTML template that matches the provided reference layout.
- Write DOMPDF-compatible CSS that preserves alignment, spacing, borders, and field placement in PDF output.
- Prepare the template for Laravel usage, such as a Blade view rendered by a controller.
- Ensure every AWB field can be populated dynamically from application-provided values.
- Support PDF export/download through DOMPDF.

## Included Files

- `resources/views/pdf/awb.blade.php` - DOMPDF-compatible AWB Blade template.
- `app/Http/Controllers/AwbPdfController.php` - Laravel controller with preview and PDF download actions.
- `app/Support/AwbSampleData.php` - sample dynamic data transcribed from the reference image.
- `routes/web.php` - example Laravel routes for preview and download.
- `composer.json` - dependency declaration for Laravel and `barryvdh/laravel-dompdf`.

## Technical Requirements

- Use HTML and CSS that are safe for DOMPDF rendering.
- Avoid browser-only layout techniques that DOMPDF may not fully support.
- Prefer table-based or fixed-layout structures where needed for reliable PDF output.
- Keep CSS explicit for dimensions, borders, font sizes, spacing, and page sizing.
- Ensure dynamic values are placed in the correct AWB boxes.
- Render consistently at standard A4 or Letter PDF page size when possible.

## Laravel / DOMPDF Integration Expectation

Install DOMPDF in the Laravel application:

```bash
composer require barryvdh/laravel-dompdf
```

The included controller uses a Laravel flow similar to:

```php
$data = [
    // AWB field values provided by the application
];

$pdf = Pdf::loadView('pdf.awb', $data);

return $pdf->download('airway-bill.pdf');
```

The exact controller, route, and Blade view names may be adjusted to match the host Laravel application.

## Available Routes

When the included `routes/web.php` entries are loaded by Laravel:

- `/` redirects to the AWB preview.
- `/awb/preview` renders the AWB HTML in the browser for layout inspection.
- `/awb/pdf` renders the AWB Blade view through DOMPDF and downloads `airway-bill.pdf`.

## Laravel Cloud Deployment

This repository is prepared to deploy from the repository root on Laravel Cloud.

Recommended Laravel Cloud settings:

- PHP version: `8.2` or newer.
- Build command:

```bash
composer install --no-dev --optimize-autoloader
npm install
npm run build
LARAVEL_CLOUD=1 php artisan config:cache
LARAVEL_CLOUD=1 php artisan route:cache
LARAVEL_CLOUD=1 php artisan view:cache
```

- Deploy command:

```bash
php artisan migrate --force
```

This application does not require a database for the AWB preview or PDF generation itself, but the default Laravel session/cache/job tables are included. If the deployed environment does not attach a database, set these environment values in Laravel Cloud:

```env
SESSION_DRIVER=file
CACHE_STORE=file
QUEUE_CONNECTION=sync
```

If a database is attached in Laravel Cloud, the default `database` session/cache/queue configuration may be used and the deploy migration command can remain enabled.

Set production environment values in Laravel Cloud rather than committing a `.env` file:

```env
APP_NAME="AWB DOMPDF"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://your-laravel-cloud-domain.example
```

Laravel Cloud will inject platform-managed environment variables for attached resources. Custom environment variables configured in the Laravel Cloud dashboard take precedence over injected values.

## Dynamic Data

All visible AWB values are provided through the `$awb` array passed into the Blade view. The current sample data lives in `App\Support\AwbSampleData` and should be replaced with real application data from models, requests, services, or DTOs.

Example:

```php
return view('pdf.awb', [
    'awb' => [
        'awb_number' => 'TFC20246899',
        'shipper' => [
            'name' => 'ABC EXPORTER SND BND',
            'address' => "KWANG 264, PADUNGAN ROAD,\nKUCHING\nMALAYSIA",
        ],
        // Continue mapping all AWB fields...
    ],
]);
```

## Acceptance Criteria

### Critical

- Delivered solution includes an HTML and CSS layout that visually and structurally matches the AWB format shown in the attached image.
- HTML and CSS are compatible with the DOMPDF library and render without layout breakage when converted to PDF.
- The solution is integrated into a Laravel-compatible setup that renders the HTML using DOMPDF and allows the PDF to be exported or downloaded.
- All fields shown in the AWB layout can be populated dynamically with application-provided values and appear in the correct corresponding boxes.

### Optional

- The layout maintains correct alignment and formatting when rendered at standard A4 or Letter PDF page size.

## Notes

The AWB reference attachment is required to complete the layout accurately. Field names, box positions, label text, and sizing should be implemented against that reference image.
