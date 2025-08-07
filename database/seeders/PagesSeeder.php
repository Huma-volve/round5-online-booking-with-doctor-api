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
            'content' => `<<<EOT
                Privacy Policy
                Effective Date: {$date}

                This Privacy Policy describes how Tech-cell ("we", "our", or "us") collects, uses, discloses, and protects the personal information of users ("you" or "your") who use our online doctor booking platform ("Service").

                1. Information We Collect
                - Personal Information: name, email, phone number, etc.
                - Medical Information: appointment notes, medical history, etc.
                - Technical Data: IP address, browser type, device information.
                - Payment Info: payment gateway metadata (we do not store card details).

                2. How We Use Your Information
                We use your data to manage appointments, send notifications, improve our services, process payments, and fulfill legal obligations.

                3. Sharing Your Information
                We share information only with healthcare providers, payment processors, or legal authorities when required. We do not sell your information.

                4. Data Security
                We use encryption, secure logins, and other industry-standard measures to protect your information.

                5. Your Rights
                You may request access to, correction of, or deletion of your personal information at any time.

                6. Cookies
                We use cookies to improve your experience. You can disable cookies in your browser settings.

                7. Third-Party Links
                We are not responsible for the privacy practices of any third-party websites linked from our platform.

                8. Children’s Privacy
                We do not knowingly collect personal information from children under 13 without parental consent.

                9. Changes to This Policy
                We may update this Privacy Policy periodically. Please review this page for the latest version.

                10. Contact Us
                If you have questions, please contact us at:
                Email: tech-cell@example.com
                Phone: +20 123 456 789
                Address: Cairo, Egypt
                EOT;`
        ]);
        Page::create([
            'type' => 'terms_and_conditions',
            'title' => 'Terms and Conditions',
            'content' => `<<<EOT
                Terms and Conditions
                Effective Date: {$date}

                These Terms and Conditions ("Terms") govern your access to and use of Tech-cell’s online doctor booking platform ("Service"). By using the Service, you agree to these Terms.

                1. Use of the Service
                You must be at least 18 years old or have parental/guardian consent to use our platform. You agree to provide accurate, complete, and current information.

                2. User Accounts
                You are responsible for maintaining the confidentiality of your account credentials and for any activity under your account.

                3. Appointment Booking
                Appointments are subject to availability. We do not guarantee medical outcomes and are not responsible for the advice provided by doctors.

                4. Payments
                Fees are displayed before booking. Payments are processed securely via third-party gateways. All payments are non-refundable unless otherwise specified.

                5. Prohibited Conduct
                You agree not to misuse the Service, engage in harassment, or violate any applicable laws.

                6. Intellectual Property
                All platform content is owned by Tech-cell and is protected by copyright and trademark laws.

                7. Termination
                We may suspend or terminate your access to the Service at our discretion for any violation of these Terms.

                8. Limitation of Liability
                We are not liable for indirect, incidental, or consequential damages, including medical outcomes or data breaches.

                9. Modifications to Terms
                We may update these Terms at any time. Your continued use of the Service indicates acceptance of any changes.

                10. Governing Law
                These Terms are governed by the laws of Egypt. Disputes shall be resolved in Egyptian courts.

                11. Contact
                Email: tech-cell@example.com
                Phone: +20 123 456 789
                Address: Cairo, Egypt
                EOT;`,
        ]);
    }
}
