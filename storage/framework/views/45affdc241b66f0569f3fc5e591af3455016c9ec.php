


<?php $__env->startSection('title'); ?>
    <title>FAQ - Property Questions</title>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <style>
        /* Custom FAQ Section Styling */
        .faq-section {
            padding: 60px 0;
            background: #ffffff;
        }

        .faq-container {
            max-width: 90%;
            margin: 0 auto;
            padding: 0 15px;
        }

        .faq-title {
            text-align: center;
            font-size: 2.5rem;
            color: #1a3c34;
            margin-bottom: 40px;
            font-weight: 700;
        }

        .faq-item {
            background: #fff;
            border-radius: 10px;
            margin-bottom: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .faq-question {
            padding: 20px;
            font-size: 1.2rem;
            color: #1a3c34;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: background 0.3s ease;
        }

        .faq-question:hover {
            background: #e6f0fa;
        }

        .faq-answer {
            padding: 0 20px;
            font-size: 1rem;
            color: #333;
            line-height: 1.6;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease, padding 0.3s ease;
        }

        .faq-answer.active {
            padding: 20px;
            max-height: 200px; /* Adjust based on content */
        }

        .faq-toggle {
            font-size: 1.5rem;
            color: #007bff;
            transition: transform 0.3s ease;
        }

        .faq-toggle.active::before {
            content: '-';
        }

        .faq-toggle::before {
            content: '+';
        }
    </style>

    <section class="faq-section">
        <div class="faq-container">
            <h1 class="faq-title">Frequently Asked Questions</h1>
            <div class="faq-item">
                <div class="faq-question">What factors should I consider when buying a property?<span class="faq-toggle"></span></div>
                <div class="faq-answer">
                    When buying a property, consider location, budget, property type (residential, commercial, etc.), future appreciation potential, amenities, legal documentation, and proximity to essential services like schools, hospitals, and public transport.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question">How do I check if a property has clear legal titles?<span class="faq-toggle"></span></div>
                <div class="faq-answer">
                    To verify clear legal titles, review the property’s title deed, encumbrance certificate, and land records. Consult a legal expert to check for disputes, liens, or pending loans. Ensure all documents are registered with the local authority.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question">What is the difference between carpet area and built-up area?<span class="faq-toggle"></span></div>
                <div class="faq-answer">
                    Carpet area is the usable floor area within the walls, excluding walls and balconies. Built-up area includes the carpet area plus the thickness of walls and balconies. Always clarify these terms before purchasing a property.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question">How can I finance my property purchase?<span class="faq-toggle"></span></div>
                <div class="faq-answer">
                    You can finance a property through home loans from banks or financial institutions, personal savings, or government schemes. Compare interest rates, loan tenure, and eligibility criteria before choosing a lender.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question">What are the taxes associated with buying a property?<span class="faq-toggle"></span></div>
                <div class="faq-answer">
                    Taxes include stamp duty, registration fees, and Goods and Services Tax (GST) for under-construction properties. Rates vary by state and property type, so check with local authorities for exact costs.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question">How do I evaluate a property’s investment potential?<span class="faq-toggle"></span></div>
                <div class="faq-answer">
                    Evaluate investment potential by analyzing location growth, infrastructure development, rental yield, and historical price trends. Consult market reports and real estate experts for data-driven insights.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question">What is an RERA-compliant property?<span class="faq-toggle"></span></div>
                <div class="faq-answer">
                    An RERA-compliant property is registered under the Real Estate (Regulation and Development) Act, ensuring transparency in pricing, timely delivery, and legal compliance. Check the RERA website for project details.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question">How do I sell my property quickly?<span class="faq-toggle"></span></div>
                <div class="faq-answer">
                    To sell quickly, price the property competitively, stage it for viewings, list on reputable platforms, and ensure all documents are ready. Hiring a professional real estate agent can also speed up the process.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question">What is the role of a property broker?<span class="faq-toggle"></span></div>
                <div class="faq-answer">
                    A property broker facilitates buying, selling, or renting by connecting buyers and sellers, negotiating prices, and handling paperwork. Choose a licensed broker with a good reputation for best results.
                </div>
            </div>
            <div class="faq-item">
                <div class="faq-question">Can I buy a property without a home loan?<span class="faq-toggle"></span></div>
                <div class="faq-answer">
                    Yes, you can buy a property using personal savings, investments, or other funding sources like family support. Ensure you have enough liquidity to cover the full cost, including taxes and fees.
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function() {
            $('.faq-question').click(function() {
                const $answer = $(this).next('.faq-answer');
                const $toggle = $(this).find('.faq-toggle');
                
                // Toggle the active class for the answer
                $answer.toggleClass('active');
                
                // Toggle the +/- icon
                $toggle.toggleClass('active');
                
                // Close other open FAQs
                $('.faq-answer').not($answer).removeClass('active');
                $('.faq-toggle').not($toggle).removeClass('active');
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.front.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\web-mingo-project\prahit-properties\resources\views/front/faq.blade.php ENDPATH**/ ?>