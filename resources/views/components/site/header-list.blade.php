<ul>
    <li>
        <a href="{{route('home')}}">صفحه اصلی </a>
    </li>
    <li>
        <a href="{{route('courses')}}">دوره های آموزشی </a>
    </li>
    <li>
        <a href="{{route('articles',\App\Enums\ArticleEnum::ARTICLES)}}">مقالات </a>
    </li>
    <li>
        <a href="{{route('articles',\App\Enums\ArticleEnum::NEWS)}}">اخبار </a>
    </li>
</ul>
