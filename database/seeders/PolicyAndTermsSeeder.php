<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Page;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PolicyAndTermsSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $date = Carbon::now()->toFormattedDateString();
        Page::create([
            'type' => 'privacy_policy',
            'title' => 'Privacy Policy',
            'content' => <<<EOT
            <h1>Privacy Policy</h1>
            <p><strong>Effective Date:</strong> {$date}</p>

            <p>This Privacy Policy describes how Tech-cell ("we", "our", or "us") collects, uses, discloses, and protects the personal information of users ("you" or "your") who use our online doctor booking platform (the “Service”).</p>

            <h2>1. Information We Collect</h2>
            <ul>
                <li><strong>Personal Information:</strong> name, email, phone number, etc.</li>
                <li><strong>Medical Information:</strong> appointment notes, history, etc.</li>
                <li><strong>Technical Data:</strong> IP address, device info, etc.</li>
                <li><strong>Payment Info:</strong> payment gateway metadata (no card details stored)</li>
            </ul>

            <h2>2. How We Use Your Information</h2>
            <p>We use it to manage appointments, send notifications, improve the platform, and comply with legal duties.</p>

            <h2>3. Sharing Your Information</h2>
            <p>Shared only with doctors, third-party providers (e.g. payments), or legal authorities when necessary. Never sold.</p>

            <h2>4. Data Security</h2>
            <p>We use industry-standard protections like encryption and secure login.</p>

            <h2>5. Your Rights</h2>
            <p>You can request access, correction, or deletion of your personal data.</p>

            <h2>6. Cookies</h2>
            <p>We use cookies to improve user experience. You can disable them in your browser.</p>

            <h2>7. Third-Party Links</h2>
            <p>We are not responsible for third-party website content or policies.</p>

            <h2>8. Children’s Privacy</h2>
            <p>No data knowingly collected from children under 13 without consent.</p>

            <h2>9. Changes</h2>
            <p>We may update this policy periodically. Check the latest version here.</p>

            <h2>10. Contact</h2>
            <p>Email: tech-cell@test.com<br>
            Phone: +20 123 456 789<br>
            Address: Cairo, Egypt</p>
            EOT,
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);

        Page::create([
            'type' => 'terms_and_conditions',
            'title' => 'Terms and conditions',
            'content' => <<<EOT
                <h1>Terms and Conditions</h1>
                <p><strong>Effective Date:</strong> {$date}</p>

                <p>These Terms and Conditions ("Terms") govern your use of our online doctor booking platform ("Service") operated by Tech-cell ("we", "us", or "our").</p>

                <h2>1. Acceptance of Terms</h2>
                <p>By accessing or using our Service, you agree to be bound by these Terms. If you do not agree, you may not use the platform.</p>

                <h2>2. Eligibility</h2>
                <p>You must be at least 18 years old to use our Service, or have parental/guardian consent if under 18.</p>

                <h2>3. Use of Service</h2>
                <ul>
                    <li>You may only use the platform to book appointments with licensed healthcare providers.</li>
                    <li>You agree to provide accurate and complete information during booking.</li>
                    <li>You must not use the Service for fraudulent or unlawful purposes.</li>
                </ul>

                <h2>4. Medical Disclaimer</h2>
                <p>We are not a medical provider. All medical advice, diagnosis, or treatment is solely the responsibility of the consulted doctor. We do not guarantee the accuracy or quality of medical services provided.</p>

                <h2>5. Payments</h2>
                <p>Some services may require payment. All transactions are handled securely by third-party providers. We do not store any payment information.</p>

                <h2>6. Cancellations & Refunds</h2>
                <p>Cancellation and refund policies depend on the individual doctor's terms. Please review their policies before booking.</p>

                <h2>7. User Conduct</h2>
                <ul>
                    <li>You must not interfere with the operation of the platform.</li>
                    <li>You must not upload viruses, spam, or harmful content.</li>
                    <li>You must respect the privacy and rights of doctors and other users.</li>
                </ul>

                <h2>8. Account Termination</h2>
                <p>We reserve the right to suspend or terminate your account at any time for violations of these Terms or misuse of the platform.</p>

                <h2>9. Intellectual Property</h2>
                <p>All content on the platform is owned by Tech-cell or its licensors. You may not copy, distribute, or use it without permission.</p>

                <h2>10. Limitation of Liability</h2>
                <p>We are not liable for any direct, indirect, or consequential damages arising from your use of the Service, including but not limited to medical negligence by third-party providers.</p>

                <h2>11. Modifications</h2>
                <p>We reserve the right to update these Terms at any time. Continued use of the Service after changes means you accept the new Terms.</p>

                <h2>12. Contact Us</h2>
                <p>If you have questions about these Terms, contact us at:<br>
                Email: tech-cell@test.com<br>
                Phone: +20 123 456 789<br>
                Address: Cairo, Egypt</p>
                EOT,
            'updated_at' => Carbon::now(),
            'created_at' => Carbon::now(),
        ]);
    }
}
