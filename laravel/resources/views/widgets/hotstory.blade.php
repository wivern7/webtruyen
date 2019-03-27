<div class="list list-truyen list-side col-xs-12">
    <div class="title-list"><h4>Truyện đang hot</h4></div>
    {{--<div class="row top-nav" data-limit="10">--}}
        {{--<div class="col-xs-4 active" data-type="day">Ngày</div>--}}
        {{--<div class="col-xs-4" data-type="month">Tháng</div>--}}
        {{--<div class="col-xs-4" data-type="all">All time</div>--}}
    {{--</div>--}}
    <?php
            $stories = \App\Story::orderBy('view', 'DESC')->skip(0)->take(10)->get();
            $count = 1;
            ?>
    @if($stories)
        @foreach($stories as $story)
        <div class="row top-item" itemscope="" itemtype="http://schema.org/Book">
            <div class="col-xs-12">
                <div class="top-num top-{{ $count }}">{{ $count  }}</div>
                <div class="s-title">
                    <h3 itemprop="name">
                        <a href="{{ route('story.show', $story->alias) }}" title="{{ $story->name }}" itemprop="url">{{ $story->name }}</a>
                    </h3>
                </div>
                <div>
                    {!! the_category($story->categories) !!}
                </div>
            </div>
        </div>
        <?php $count++ ; ?>
        @endforeach
    @endif
</div>