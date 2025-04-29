@extends('frontend.app.main')

@section('content')
<!-- FAQ Header -->
<header class="bg-primary text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="fw-bold mb-3">Frequently Asked Questions</h1>
                <p class="lead mb-4">Find answers to the most common questions about using AdSpot. Can't find what you're looking for? Contact our support team.</p>
            </div>
            <div class="col-lg-6">
                <div class="card border-0 shadow">
                    <div class="card-body p-4">
                        <h5 class="mb-3 text-dark">Search FAQs</h5>
                        <form id="faqSearch">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Type your question here...">
                                <button class="btn btn-primary" type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- FAQ Categories -->
<section class="py-4 border-bottom bg-light">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-center">
            <a href="#general" class="btn btn-outline-primary rounded-pill m-1 active">General</a>
            <a href="#account" class="btn btn-outline-primary rounded-pill m-1">Account</a>
            <a href="#posting" class="btn btn-outline-primary rounded-pill m-1">Posting Ads</a>
            <a href="#buying" class="btn btn-outline-primary rounded-pill m-1">Buying</a>
            <a href="#selling" class="btn btn-outline-primary rounded-pill m-1">Selling</a>
            <a href="#payments" class="btn btn-outline-primary rounded-pill m-1">Payments</a>
            <a href="#safety" class="btn btn-outline-primary rounded-pill m-1">Safety & Security</a>
            <a href="#technical" class="btn btn-outline-primary rounded-pill m-1">Technical</a>
        </div>
    </div>
</section>

<!-- FAQ Content -->
<section class="py-5">
    <div class="container">
        <div class="row">
            <!-- Main Content -->
            <div class="col-lg-8 mx-auto">
                <!-- General FAQs -->
                <div id="general" class="mb-5">
                    <h2 class="mb-4">General Questions</h2>
                    <div class="accordion" id="accordionGeneral">
                        <!-- FAQ Item 1 -->
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header" id="headingG1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseG1" aria-expanded="true" aria-controls="collapseG1">
                                    What is AdSpot?
                                </button>
                            </h2>
                            <div id="collapseG1" class="accordion-collapse collapse show" aria-labelledby="headingG1" data-bs-parent="#accordionGeneral">
                                <div class="accordion-body">
                                    AdSpot is an online marketplace platform that connects buyers and sellers across various categories including real estate, jobs, services, vehicles, and more. Our platform allows users to post listings, browse available offerings, and connect directly with other users to complete transactions.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 2 -->
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header" id="headingG2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseG2" aria-expanded="false" aria-controls="collapseG2">
                                    Is AdSpot available in my country?
                                </button>
                            </h2>
                            <div id="collapseG2" class="accordion-collapse collapse" aria-labelledby="headingG2" data-bs-parent="#accordionGeneral">
                                <div class="accordion-body">
                                    AdSpot is currently available in 25 countries worldwide, including the United States, Canada, the United Kingdom, Australia, and several countries across Europe and Asia. We're continuously expanding to new markets. You can check if AdSpot is available in your country by visiting our <a href="#">global locations page</a> or by selecting your country from the dropdown menu at the bottom of our homepage.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 3 -->
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header" id="headingG3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseG3" aria-expanded="false" aria-controls="collapseG3">
                                    How do I contact AdSpot customer support?
                                </button>
                            </h2>
                            <div id="collapseG3" class="accordion-collapse collapse" aria-labelledby="headingG3" data-bs-parent="#accordionGeneral">
                                <div class="accordion-body">
                                    You can contact our customer support team through several channels:
                                    <ul>
                                        <li>Email: support@adspot.com</li>
                                        <li>Phone: (123) 456-7890 (Monday-Friday, 9 AM - 6 PM EST)</li>
                                        <li>Live Chat: Available on our website 24/7</li>
                                        <li>Contact Form: Visit our <a href="contact.html">Contact Page</a></li>
                                    </ul>
                                    Our support team typically responds within 24 hours, but most inquiries are addressed much sooner.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Account FAQs -->
                <div id="account" class="mb-5">
                    <h2 class="mb-4">Account Questions</h2>
                    <div class="accordion" id="accordionAccount">
                        <!-- FAQ Item 1 -->
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header" id="headingA1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseA1" aria-expanded="true" aria-controls="collapseA1">
                                    How do I create an account?
                                </button>
                            </h2>
                            <div id="collapseA1" class="accordion-collapse collapse show" aria-labelledby="headingA1" data-bs-parent="#accordionAccount">
                                <div class="accordion-body">
                                    Creating an account on AdSpot is simple and free. Click the "Register" button in the top right corner of any page. You can sign up using your email address, or through your Google, Facebook, or Apple account. You'll need to verify your email address and set up your profile with basic information. The entire process takes less than 5 minutes.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 2 -->
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header" id="headingA2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseA2" aria-expanded="false" aria-controls="collapseA2">
                                    How do I reset my password?
                                </button>
                            </h2>
                            <div id="collapseA2" class="accordion-collapse collapse" aria-labelledby="headingA2" data-bs-parent="#accordionAccount">
                                <div class="accordion-body">
                                    If you've forgotten your password, click on the "Login" button, then select "Forgot Password?" Enter the email address associated with your account, and we'll send you a password reset link. The link is valid for 24 hours. If you don't receive the email within a few minutes, check your spam folder or contact our support team.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 3 -->
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header" id="headingA3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseA3" aria-expanded="false" aria-controls="collapseA3">
                                    How do I delete my account?
                                </button>
                            </h2>
                            <div id="collapseA3" class="accordion-collapse collapse" aria-labelledby="headingA3" data-bs-parent="#accordionAccount">
                                <div class="accordion-body">
                                    To delete your account, go to your Account Settings and select the "Privacy & Data" tab. At the bottom of the page, you'll find the "Delete Account" option. Please note that account deletion is permanent and will remove all your listings, messages, and account history. If you have active listings or ongoing transactions, we recommend resolving these before deleting your account.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 4 -->
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header" id="headingA4">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseA4" aria-expanded="false" aria-controls="collapseA4">
                                    Can I have multiple accounts?
                                </button>
                            </h2>
                            <div id="collapseA4" class="accordion-collapse collapse" aria-labelledby="headingA4" data-bs-parent="#accordionAccount">
                                <div class="accordion-body">
                                    Our terms of service allow one personal account per user. However, if you're a business owner, you can have both a personal account and a business account. Business accounts offer additional features like multiple user access, enhanced analytics, and branded storefronts. To set up a business account, visit the "Business Solutions" section of our website.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Posting Ads FAQs -->
                <div id="posting" class="mb-5">
                    <h2 class="mb-4">Posting Ads Questions</h2>
                    <div class="accordion" id="accordionPosting">
                        <!-- FAQ Item 1 -->
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header" id="headingP1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseP1" aria-expanded="true" aria-controls="collapseP1">
                                    How do I post an ad?
                                </button>
                            </h2>
                            <div id="collapseP1" class="accordion-collapse collapse show" aria-labelledby="headingP1" data-bs-parent="#accordionPosting">
                                <div class="accordion-body">
                                    To post an ad, log in to your account and click the "Post Ad" button in the navigation menu. Select the appropriate category for your listing, fill out the required information, upload photos, set your price, and provide contact details. Review your listing before submitting. Once submitted, your ad will be reviewed and published within 24 hours, though most ads go live much sooner.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 2 -->
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header" id="headingP2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseP2" aria-expanded="false" aria-controls="collapseP2">
                                    Is it free to post ads?
                                </button>
                            </h2>
                            <div id="collapseP2" class="accordion-collapse collapse" aria-labelledby="headingP2" data-bs-parent="#accordionPosting">
                                <div class="accordion-body">
                                    We offer both free and premium listing options. Basic listings are free and include standard features. Premium listings require a small fee but offer enhanced visibility, featured placement, and additional promotional tools to help your ad stand out and attract more potential buyers or applicants. The cost of premium listings varies by category and location.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 3 -->
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header" id="headingP3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseP3" aria-expanded="false" aria-controls="collapseP3">
                                    How many photos can I include in my ad?
                                </button>
                            </h2>
                            <div id="collapseP3" class="accordion-collapse collapse" aria-labelledby="headingP3" data-bs-parent="#accordionPosting">
                                <div class="accordion-body">
                                    Free listings allow up to 5 photos per ad. Premium listings allow up to 20 photos, depending on the package selected. Each photo can be up to 10MB in size and should be in JPG, PNG, or WEBP format. We recommend using high-quality images with good lighting to showcase your item or service effectively.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 4 -->
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header" id="headingP4">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseP4" aria-expanded="false" aria-controls="collapseP4">
                                    How long will my ad stay active?
                                </button>
                            </h2>
                            <div id="collapseP4" class="accordion-collapse collapse" aria-labelledby="headingP4" data-bs-parent="#accordionPosting">
                                <div class="accordion-body">
                                    Free listings remain active for 30 days, while premium listings can stay active for up to 60 days, depending on the package. You can renew or extend your listing at any time from your account dashboard. If your item sells or position is filled before the expiration date, you can mark it as "Sold" or "Filled" to remove it from active listings.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 5 -->
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header" id="headingP5">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseP5" aria-expanded="false" aria-controls="collapseP5">
                                    How do I edit or remove my ad?
                                </button>
                            </h2>
                            <div id="collapseP5" class="accordion-collapse collapse" aria-labelledby="headingP5" data-bs-parent="#accordionPosting">
                                <div class="accordion-body">
                                    You can edit or remove your ad at any time by logging into your account and going to "My Ads" in your dashboard. From there, you can select the ad you wish to modify and choose to edit, pause, or delete it. Changes to active listings usually take effect immediately, though major changes may require a brief review.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Buying FAQs -->
                <div id="buying" class="mb-5">
                    <h2 class="mb-4">Buying Questions</h2>
                    <div class="accordion" id="accordionBuying">
                        <!-- FAQ Item 1 -->
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header" id="headingB1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseB1" aria-expanded="true" aria-controls="collapseB1">
                                    How do I contact a seller?
                                </button>
                            </h2>
                            <div id="collapseB1" class="accordion-collapse collapse show" aria-labelledby="headingB1" data-bs-parent="#accordionBuying">
                                <div class="accordion-body">
                                    To contact a seller, navigate to their listing and click the "Contact Seller" or "Send Message" button. You'll be able to send a message through our secure messaging system. Some sellers also provide phone numbers or email addresses in their listings. We recommend using our messaging system initially as it provides a record of your communication and offers additional security features.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 2 -->
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header" id="headingB2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseB2" aria-expanded="false" aria-controls="collapseB2">
                                    Is it safe to buy on AdSpot?
                                </button>
                            </h2>
                            <div id="collapseB2" class="accordion-collapse collapse" aria-labelledby="headingB2" data-bs-parent="#accordionBuying">
                                <div class="accordion-body">
                                    We take safety seriously and have implemented several measures to protect our users. These include user verification, secure messaging, fraud detection systems, and a review system. However, as with any marketplace, we recommend taking precautions: meet in public places for high-value items, use secure payment methods, inspect items before purchasing, and trust your instincts. For more safety tips, visit our <a href="#">Safety Center</a>.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 3 -->
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header" id="headingB3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseB3" aria-expanded="false" aria-controls="collapseB3">
                                    Can I negotiate the price?
                                </button>
                            </h2>
                            <div id="collapseB3" class="accordion-collapse collapse" aria-labelledby="headingB3" data-bs-parent="#accordionBuying">
                                <div class="accordion-body">
                                    Yes, price negotiation is common on AdSpot. You can make an offer by contacting the seller through our messaging system. Some sellers indicate in their listings whether they're open to negotiation with phrases like "price negotiable" or "firm price." Be respectful when making offers, and understand that extremely low offers may be ignored or declined.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 4 -->
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header" id="headingB4">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseB4" aria-expanded="false" aria-controls="collapseB4">
                                    What payment methods are recommended?
                                </button>
                            </h2>
                            <div id="collapseB4" class="accordion-collapse collapse" aria-labelledby="headingB4" data-bs-parent="#accordionBuying">
                                <div class="accordion-body">
                                    For in-person transactions, cash is often the safest method. For online transactions, we recommend using our secure payment system, AdSpot Pay, which offers buyer protection. Other secure options include PayPal, credit cards, or bank transfers. We strongly advise against using wire transfers, money orders, or cryptocurrency with unknown sellers, as these methods offer limited recourse in case of fraud.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Selling FAQs -->
                <div id="selling" class="mb-5">
                    <h2 class="mb-4">Selling Questions</h2>
                    <div class="accordion" id="accordionSelling">
                        <!-- FAQ Item 1 -->
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header" id="headingS1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseS1" aria-expanded="true" aria-controls="collapseS1">
                                    How do I price my items?
                                </button>
                            </h2>
                            <div id="collapseS1" class="accordion-collapse collapse show" aria-labelledby="headingS1" data-bs-parent="#accordionSelling">
                                <div class="accordion-body">
                                    Setting the right price is important for a successful sale. Research similar items on AdSpot to see the current market rate. Consider factors like condition, age, brand, and demand. You can use our "Price Check" tool to get an estimated value range for many common items. It's often effective to price slightly above your minimum acceptable amount to allow room for negotiation.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 2 -->
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header" id="headingS2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseS2" aria-expanded="false" aria-controls="collapseS2">
                                    How can I make my listing stand out?
                                </button>
                            </h2>
                            <div id="collapseS2" class="accordion-collapse collapse" aria-labelledby="headingS2" data-bs-parent="#accordionSelling">
                                <div class="accordion-body">
                                    To make your listing stand out:
                                    <ul>
                                        <li>Use high-quality photos from multiple angles</li>
                                        <li>Write detailed, honest descriptions</li>
                                        <li>Include relevant keywords in your title</li>
                                        <li>Highlight unique features or benefits</li>
                                        <li>Respond quickly to inquiries</li>
                                        <li>Consider upgrading to a premium listing for better visibility</li>
                                        <li>Price competitively based on market research</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 3 -->
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header" id="headingS3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseS3" aria-expanded="false" aria-controls="collapseS3">
                                    How do I handle potential buyers?
                                </button>
                            </h2>
                            <div id="collapseS3" class="accordion-collapse collapse" aria-labelledby="headingS3" data-bs-parent="#accordionSelling">
                                <div class="accordion-body">
                                    When dealing with potential buyers:
                                    <ul>
                                        <li>Respond promptly and professionally to inquiries</li>
                                        <li>Be honest about the condition and details of your item</li>
                                        <li>Be prepared to answer questions and provide additional photos if requested</li>
                                        <li>Set clear expectations about payment methods and pickup/delivery options</li>
                                        <li>For in-person meetings, choose public locations during daylight hours</li>
                                        <li>Trust your instincts and be cautious of suspicious behavior</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 4 -->
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header" id="headingS4">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseS4" aria-expanded="false" aria-controls="collapseS4">
                                    What payment methods should I accept?
                                </button>
                            </h2>
                            <div id="collapseS4" class="accordion-collapse collapse" aria-labelledby="headingS4" data-bs-parent="#accordionSelling">
                                <div class="accordion-body">
                                    For in-person transactions, cash is generally the safest option. For online transactions, our secure payment system, AdSpot Pay, offers seller protection and automatic transfers to your bank account. Other secure options include PayPal (business account), credit card payments through a secure processor, or bank transfers. Be wary of buyers insisting on unusual payment methods or offering to overpay, as these are common signs of scams.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Payments FAQs -->
                <div id="payments" class="mb-5">
                    <h2 class="mb-4">Payment Questions</h2>
                    <div class="accordion" id="accordionPayments">
                        <!-- FAQ Item 1 -->
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header" id="headingPay1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePay1" aria-expanded="true" aria-controls="collapsePay1">
                                    What is AdSpot Pay?
                                </button>
                            </h2>
                            <div id="collapsePay1" class="accordion-collapse collapse show" aria-labelledby="headingPay1" data-bs-parent="#accordionPayments">
                                <div class="accordion-body">
                                    AdSpot Pay is our secure payment platform that facilitates transactions between buyers and sellers. It offers features like buyer protection, seller protection, secure payment processing, and escrow services for high-value items. AdSpot Pay supports credit/debit cards, bank transfers, and digital wallets. Using AdSpot Pay provides an additional layer of security and helps resolve disputes if they arise.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 2 -->
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header" id="headingPay2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePay2" aria-expanded="false" aria-controls="collapsePay2">
                                    How do fees work on AdSpot?
                                </button>
                            </h2>
                            <div id="collapsePay2" class="accordion-collapse collapse" aria-labelledby="headingPay2" data-bs-parent="#accordionPayments">
                                <div class="accordion-body">
                                    Posting basic ads on AdSpot is free. Premium listing upgrades have varying fees depending on the category and features selected. For transactions processed through AdSpot Pay, there's a small processing fee of 2-3% for sellers. Buyers don't pay any transaction fees. Business accounts have different fee structures with monthly subscription options that include a certain number of premium listings and reduced transaction fees.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 3 -->
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header" id="headingPay3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePay3" aria-expanded="false" aria-controls="collapsePay3">
                                    How do refunds work?
                                </button>
                            </h2>
                            <div id="collapsePay3" class="accordion-collapse collapse" aria-labelledby="headingPay3" data-bs-parent="#accordionPayments">
                                <div class="accordion-body">
                                    For transactions processed through AdSpot Pay, refunds can be requested within 7 days of purchase if the item was misrepresented or not as described. The seller has 3 days to respond to the refund request. If approved, the refund is processed within 5-7 business days. For premium listing fees, refunds are available if your ad is rejected during the review process. No refunds are provided for ads that have already been published.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 4 -->
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header" id="headingPay4">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePay4" aria-expanded="false" aria-controls="collapsePay4">
                                    Is my payment information secure?
                                </button>
                            </h2>
                            <div id="collapsePay4" class="accordion-collapse collapse" aria-labelledby="headingPay4" data-bs-parent="#accordionPayments">
                                <div class="accordion-body">
                                    Yes, AdSpot uses industry-standard encryption and security protocols to protect your payment information. We are PCI DSS compliant and never store complete credit card information on our servers. All payment processing is handled through secure, trusted payment processors. We also employ advanced fraud detection systems to identify and prevent suspicious transactions.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Safety & Security FAQs -->
                <div id="safety" class="mb-5">
                    <h2 class="mb-4">Safety & Security Questions</h2>
                    <div class="accordion" id="accordionSafety">
                        <!-- FAQ Item 1 -->
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header" id="headingSaf1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSaf1" aria-expanded="true" aria-controls="collapseSaf1">
                                    How does AdSpot protect users from scams?
                                </button>
                            </h2>
                            <div id="collapseSaf1" class="accordion-collapse collapse show" aria-labelledby="headingSaf1" data-bs-parent="#accordionSafety">
                                <div class="accordion-body">
                                    We employ multiple measures to protect users from scams:
                                    <ul>
                                        <li>User verification processes including email, phone, and ID verification</li>
                                        <li>AI-powered fraud detection systems that flag suspicious listings and behaviors</li>
                                        <li>Secure messaging system that filters out potentially harmful content</li>
                                        <li>User rating and review system to build trust</li>
                                        <li>Secure payment options through AdSpot Pay</li>
                                        <li>24/7 monitoring by our security team</li>
                                        <li>Regular security updates and improvements</li>
                                    </ul>
                                    We also provide educational resources in our Safety Center to help users recognize and avoid common scams.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 2 -->
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header" id="headingSaf2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSaf2" aria-expanded="false" aria-controls="collapseSaf2">
                                    What should I do if I suspect a scam?
                                </button>
                            </h2>
                            <div id="collapseSaf2" class="accordion-collapse collapse" aria-labelledby="headingSaf2" data-bs-parent="#accordionSafety">
                                <div class="accordion-body">
                                    If you suspect a scam:
                                    <ol>
                                        <li>Do not send money or provide personal information</li>
                                        <li>Report the listing or user immediately using the "Report" button</li>
                                        <li>Contact our support team with details about the suspicious activity</li>
                                        <li>If you've already sent money, contact your payment provider to try to stop the payment</li>
                                        <li>Document all communications for reference</li>
                                        <li>If significant funds were lost, consider reporting to local law enforcement</li>
                                    </ol>
                                    Our team investigates all reports promptly and takes appropriate action to protect our community.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 3 -->
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header" id="headingSaf3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSaf3" aria-expanded="false" aria-controls="collapseSaf3">
                                    What safety tips should I follow for in-person meetings?
                                </button>
                            </h2>
                            <div id="collapseSaf3" class="accordion-collapse collapse" aria-labelledby="headingSaf3" data-bs-parent="#accordionSafety">
                                <div class="accordion-body">
                                    For in-person meetings:
                                    <ul>
                                        <li>Meet in public places with plenty of people around (coffee shops, mall food courts, etc.)</li>
                                        <li>Schedule meetings during daylight hours</li>
                                        <li>Bring a friend or family member when possible</li>
                                        <li>Tell someone else where you're going and when you expect to return</li>
                                        <li>Use our "Safe Meeting Spot" feature to find designated safe zones, often near police stations</li>
                                        <li>Trust your instincts - if something feels wrong, leave immediately</li>
                                        <li>For high-value items, consider meeting at a bank or using AdSpot Pay's escrow service</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 4 -->
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header" id="headingSaf4">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSaf4" aria-expanded="false" aria-controls="collapseSaf4">
                                    How does AdSpot protect my personal information?
                                </button>
                            </h2>
                            <div id="collapseSaf4" class="accordion-collapse collapse" aria-labelledby="headingSaf4" data-bs-parent="#accordionSafety">
                                <div class="accordion-body">
                                    We take data privacy seriously and employ multiple measures to protect your information:
                                    <ul>
                                        <li>End-to-end encryption for messages between users</li>
                                        <li>Option to hide your exact location and use neighborhood-level location instead</li>
                                        <li>Control over what contact information is visible to other users</li>
                                        <li>Secure data storage with regular security audits</li>
                                        <li>Strict data access controls within our organization</li>
                                        <li>Compliance with data protection regulations including GDPR and CCPA</li>
                                    </ul>
                                    You can review and adjust your privacy settings at any time in your account settings.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Technical FAQs -->
                <div id="technical" class="mb-5">
                    <h2 class="mb-4">Technical Questions</h2>
                    <div class="accordion" id="accordionTechnical">
                        <!-- FAQ Item 1 -->
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header" id="headingT1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseT1" aria-expanded="true" aria-controls="collapseT1">
                                    Is there a mobile app for AdSpot?
                                </button>
                            </h2>
                            <div id="collapseT1" class="accordion-collapse collapse show" aria-labelledby="headingT1" data-bs-parent="#accordionTechnical">
                                <div class="accordion-body">
                                    Yes, AdSpot has mobile apps available for both iOS and Android devices. Our apps offer all the functionality of the website plus additional features like push notifications for messages, saved searches, and the ability to take photos directly within the app. You can download the app from the Apple App Store or Google Play Store. The app is free and regularly updated with new features and improvements.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 2 -->
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header" id="headingT2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseT2" aria-expanded="false" aria-controls="collapseT2">
                                    Why am I having trouble uploading photos?
                                </button>
                            </h2>
                            <div id="collapseT2" class="accordion-collapse collapse" aria-labelledby="headingT2" data-bs-parent="#accordionTechnical">
                                <div class="accordion-body">
                                    If you're having trouble uploading photos, check the following:
                                    <ul>
                                        <li>Ensure each photo is under 10MB in size</li>
                                        <li>Use supported formats: JPG, PNG, or WEBP</li>
                                        <li>Check your internet connection stability</li>
                                        <li>Try using a different browser or device</li>
                                        <li>Clear your browser cache and cookies</li>
                                        <li>Disable any ad-blockers or browser extensions that might interfere</li>
                                    </ul>
                                    If problems persist, try reducing the resolution of your images or contact our support team for assistance.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 3 -->
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header" id="headingT3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseT3" aria-expanded="false" aria-controls="collapseT3">
                                    How do I enable notifications?
                                </button>
                            </h2>
                            <div id="collapseT3" class="accordion-collapse collapse" aria-labelledby="headingT3" data-bs-parent="#accordionTechnical">
                                <div class="accordion-body">
                                    To enable notifications:
                                    <ol>
                                        <li>Go to your Account Settings</li>
                                        <li>Select the "Notifications" tab</li>
                                        <li>Choose which notifications you want to receive (messages, saved searches, etc.)</li>
                                        <li>Select your preferred notification methods (email, push notifications, SMS)</li>
                                    </ol>
                                    On mobile devices, you'll need to allow notifications in your device settings as well. When you first install the app, you'll be prompted to allow notifications, but you can adjust these settings later in your device's settings menu.
                                </div>
                            </div>
                        </div>

                        <!-- FAQ Item 4 -->
                        <div class="accordion-item border-0 shadow-sm mb-3">
                            <h2 class="accordion-header" id="headingT4">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseT4" aria-expanded="false" aria-controls="collapseT4">
                                    What browsers are supported?
                                </button>
                            </h2>
                            <div id="collapseT4" class="accordion-collapse collapse" aria-labelledby="headingT4" data-bs-parent="#accordionTechnical">
                                <div class="accordion-body">
                                    AdSpot supports all major modern browsers, including:
                                    <ul>
                                        <li>Google Chrome (recommended for best experience)</li>
                                        <li>Mozilla Firefox</li>
                                        <li>Apple Safari</li>
                                        <li>Microsoft Edge</li>
                                        <li>Opera</li>
                                    </ul>
                                    We recommend keeping your browser updated to the latest version for optimal performance and security. Internet Explorer is not supported as it has been discontinued by Microsoft.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Still Have Questions -->
                <div class="card border-0 shadow-sm p-4 bg-light text-center mb-5">
                    <h3 class="mb-3">Still Have Questions?</h3>
                    <p class="mb-4">Our support team is ready to help you with any other questions you might have.</p>
                    <div class="d-flex justify-content-center flex-wrap gap-2">
                        <a href="contact.html" class="btn btn-primary px-4 py-2">Contact Support</a>
                        <a href="#" class="btn btn-outline-primary px-4 py-2">Live Chat</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script>
    document.getElementById('faqSearch').addEventListener('submit', function(e) {
        e.preventDefault();
        const searchTerm = this.querySelector('input').value.toLowerCase();

        // Simple search implementation - could be enhanced with more advanced features
        const accordionItems = document.querySelectorAll('.accordion-item');
        let foundResults = false;

        accordionItems.forEach(item => {
            const question = item.querySelector('.accordion-button').textContent.toLowerCase();
            const answer = item.querySelector('.accordion-body').textContent.toLowerCase();

            if (question.includes(searchTerm) || answer.includes(searchTerm)) {
                // Expand this item
                const collapseId = item.querySelector('.accordion-collapse').id;
                const myCollapse = new bootstrap.Collapse(document.getElementById(collapseId), {
                    show: true
                });

                // Scroll to this item
                item.scrollIntoView({ behavior: 'smooth', block: 'center' });
                foundResults = true;

                // Highlight the item briefly
                item.classList.add('border', 'border-primary');
                setTimeout(() => {
                    item.classList.remove('border', 'border-primary');
                }, 2000);

                // Only scroll to the first match
                return false;
            }
        });

        if (!foundResults) {
            alert('No results found. Please try different keywords.');
        }
    });
</script>

@endsection
