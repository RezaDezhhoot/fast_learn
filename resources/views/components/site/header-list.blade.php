<ul>
    <li>
        <a href="{{route('home')}}">صفحه اصلی </a>
    </li>
    <li>
        <a href="{{route('courses',['level_type' => \App\Enums\CourseEnum::LEVEL_TYPE_PROFESSIONAL])}}">دوره های تخصصی </a>
    </li>
    <li>
        <a href="{{route('courses' ,['level_type' => \App\Enums\CourseEnum::LEVEL_TYPE_GENERAL])}}">دوره های عمومی </a>
    </li>
    <li>
        <a href="{{route('articles')}}">مقالات </a>
    </li>
</ul>
