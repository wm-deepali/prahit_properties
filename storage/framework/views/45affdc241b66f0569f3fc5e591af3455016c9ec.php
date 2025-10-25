

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
            max-height: 200px;
            /* Adjust based on content */
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
            <div class="row">
                <!-- FAQs Left Column -->
                <div class="col-lg-8">
                    <?php $__empty_1 = true; $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="faq-item">
                            <div class="faq-question"><?php echo e($faq->question); ?><span class="faq-toggle"></span></div>
                            <div class="faq-answer"><?php echo e($faq->answer); ?></div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-muted">No FAQs available.</p>
                    <?php endif; ?>
                </div>

                <!-- Categories Right Column -->
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body">
                            <h4 class="card-title mb-3">Categories</h4>
                            <ul class="tag-list">
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li>
                                        <a href="<?php echo e(route('faq.category', $category->slug)); ?>">
                                            <?php echo e($category->name); ?>

                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        $(document).ready(function () {
            $('.faq-question').click(function () {
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