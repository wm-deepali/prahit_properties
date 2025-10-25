@extends('layouts.front.app')

@section('title')
    <title>{{ $category->name }} FAQs - Property Questions</title>
@endsection

@section('content')
<style>
    .faq-section { padding: 60px 0; background: #ffffff; }
    .faq-container { max-width: 1200px; margin: 0 auto; padding: 0 15px; }
    .faq-title { text-align: center; font-size: 2.5rem; color: #1a3c34; margin-bottom: 40px; font-weight: 700; }
    .faq-item { background: #fff; border-radius: 10px; margin-bottom: 15px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); overflow: hidden; }
    .faq-question { padding: 20px; font-size: 1.2rem; color: #1a3c34; font-weight: 600; cursor: pointer; display: flex; justify-content: space-between; align-items: center; transition: background 0.3s ease; }
    .faq-question:hover { background: #e6f0fa; }
    .faq-answer { padding: 0 20px; font-size: 1rem; color: #333; line-height: 1.6; max-height: 0; overflow: hidden; transition: max-height 0.3s ease, padding 0.3s ease; }
    .faq-answer.active { padding: 20px; max-height: 500px; }
    .faq-toggle { font-size: 1.5rem; color: #007bff; transition: transform 0.3s ease; }
    .faq-toggle.active::before { content: '-'; }
    .faq-toggle::before { content: '+'; }

    /* Categories card */
    .card { border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); }
    .card-title { font-size: 1.5rem; font-weight: 600; }
    .tag-list { list-style: none; padding: 0; margin: 0; }
    .tag-list li { margin-bottom: 10px; }
    .tag-list li a { text-decoration: none; color: #007bff; transition: color 0.3s; }
    .tag-list li a:hover { color: #0056b3; }
</style>

<section class="faq-section">
    <div class="faq-container">
        <h1 class="faq-title">{{ $category->name }} FAQs</h1>
        <div class="row">
            <!-- FAQs Left Column -->
            <div class="col-lg-8">
                @forelse($faqs as $faq)
                    <div class="faq-item">
                        <div class="faq-question">{{ $faq->question }}<span class="faq-toggle"></span></div>
                        <div class="faq-answer">{{ $faq->answer }}</div>
                    </div>
                @empty
                    <p class="text-muted">No FAQs available in this category.</p>
                @endforelse
            </div>

            <!-- Categories Right Column -->
            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <h4 class="card-title mb-3">Categories</h4>
                        <ul class="tag-list">
                            @foreach($categories as $cat)
                                <li>
                                    <a href="{{ route('faq.category', $cat->slug) }}">
                                        {{ $cat->name }}
                                    </a>
                                </li>
                            @endforeach
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
@endsection
