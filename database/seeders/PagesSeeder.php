<?php

namespace Database\Seeders;

use App\Models\Page;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PagesSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $date = Carbon::now()->toFormattedDateString();
        Page::create([
            'type' => 'privacy_policy',
            'title' => 'Privacy Policy',
            'content' => <<<EOT
Privacy Policy
Effective Date: {$date}

This Privacy Policy explains how Tech-cell ("we", "our", "us") collects, uses, and protects your information when you use our online doctor booking platform (the "Service").

1) Information We Collect
- Personal Information: name, email, phone number.
- Medical Information: appointment notes/medical history (if applicable).
- Technical Data: IP address, browser, device details.
- Payments: processed via secure gateways (we don't store card data).

2) How We Use Information
We use it to manage appointments, send notifications, improve the Service, process payments, and meet legal obligations.

3) Sharing Information
We only share with healthcare providers, payment processors, or legal authorities when required. We do not sell your data.

4) Security
We apply industry-standard security and encryption practices.

5) Your Rights
You can request access, correction, or deletion of your personal data.

6) Cookies
We use cookies to enhance your experience. You can disable them in your browser.

7) Third-Party Links
We are not responsible for the privacy practices of third-party sites.

8) Children’s Privacy
We do not knowingly collect data from children under 13 without parental consent.

9) Changes
We may update this policy from time to time. Please review periodically.

10) Contact Us
Email: tech-cell@example.com
Phone: +20 123 456 789
Address: Cairo, Egypt
EOT
        ]);

        Page::create([
            'type' => 'terms_and_conditions',
            'title' => 'Terms and Conditions',
            'content' => <<<EOT
Terms and Conditions
Effective Date: {$date}

By using Tech-cell's online doctor booking platform (the "Service"), you agree to these Terms.

1) Use of Service
You must be 18+ or have guardian consent. Provide accurate, up-to-date information.

2) Accounts
You are responsible for keeping your credentials secure and for activity under your account.

3) Appointments
Bookings are subject to availability. We do not guarantee medical outcomes and are not responsible for clinical advice.

4) Payments
Processed via secure payment gateways. Refunds apply only if explicitly stated.

5) Prohibited Conduct
Do not misuse the Service, harass others, or violate laws.

6) Intellectual Property
All content is owned by Tech-cell and protected by applicable laws.

7) Termination
We may suspend or terminate access if you violate these Terms.

8) Limitation of Liability
We are not liable for indirect or consequential damages.

9) Changes to Terms
We may update these Terms at any time. Continued use means acceptance.

10) Governing Law
These Terms are governed by the laws of Egypt.

11) Contact
Email: tech-cell@example.com
Phone: +20 123 456 789
Address: Cairo, Egypt
EOT,
        ]);
    }
}
