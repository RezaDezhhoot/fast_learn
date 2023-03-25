<div>
    <section class="breadcrumb-area bg-white organ-bg pattern-bg" style='background: url({{asset($organ->info['image'])}})'>
        <div class="container">
            <div class="breadcrumb-content pb-150px text-right py-4">
                <div class="section-heading text-white">
                    <img class="p-2" src="{{ asset($organ['info']['logo']) }}" alt="لوگو">
                    <h2 class="section__title fs-50 lh-50 px-2 organ-title text-white">
                        {{ $organ->title }}
                    </h2>
                </div>
            </div>
            <!-- end breadcrumb-content -->
        </div>
        <!-- end container -->
    </section>
    <section class="course-details-area pt-50px">
        <div class="container">
            <div class="student-details-wrap pb-20px">
                <div class="row">
                    <div class="col-lg-4 responsive-column-half">
                        <div class="counter-item">
                            <div class="counter__icon icon-element mb-3 shadow-sm">
                                <svg class="svg-icon-color-1" width="40" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 490.667 490.667" xml:space="preserve">
                                        <g>
                                            <g>
                                                <path
                                                    d="M245.333,85.333c-41.173,0-74.667,33.493-74.667,74.667s33.493,74.667,74.667,74.667S320,201.173,320,160
                                                C320,118.827,286.507,85.333,245.333,85.333z M245.333,213.333C215.936,213.333,192,189.397,192,160
                                                c0-29.397,23.936-53.333,53.333-53.333s53.333,23.936,53.333,53.333S274.731,213.333,245.333,213.333z"
                                                ></path>
                                            </g>
                                        </g>
                                    <g>
                                        <g>
                                            <path
                                                d="M394.667,170.667c-29.397,0-53.333,23.936-53.333,53.333s23.936,53.333,53.333,53.333S448,253.397,448,224
                                                S424.064,170.667,394.667,170.667z M394.667,256c-17.643,0-32-14.357-32-32c0-17.643,14.357-32,32-32s32,14.357,32,32
                                                C426.667,241.643,412.309,256,394.667,256z"
                                            ></path>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path
                                                d="M97.515,170.667c-29.419,0-53.333,23.936-53.333,53.333s23.936,53.333,53.333,53.333s53.333-23.936,53.333-53.333
                                                S126.933,170.667,97.515,170.667z M97.515,256c-17.643,0-32-14.357-32-32c0-17.643,14.357-32,32-32c17.643,0,32,14.357,32,32
                                                C129.515,241.643,115.157,256,97.515,256z"
                                            ></path>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path
                                                d="M245.333,256c-76.459,0-138.667,62.208-138.667,138.667c0,5.888,4.779,10.667,10.667,10.667S128,400.555,128,394.667
                                                c0-64.704,52.629-117.333,117.333-117.333s117.333,52.629,117.333,117.333c0,5.888,4.779,10.667,10.667,10.667
                                                c5.888,0,10.667-4.779,10.667-10.667C384,318.208,321.792,256,245.333,256z"
                                            ></path>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path
                                                d="M394.667,298.667c-17.557,0-34.752,4.8-49.728,13.867c-5.013,3.072-6.635,9.621-3.584,14.656
                                                c3.093,5.035,9.621,6.635,14.656,3.584C367.637,323.712,380.992,320,394.667,320c41.173,0,74.667,33.493,74.667,74.667
                                                c0,5.888,4.779,10.667,10.667,10.667c5.888,0,10.667-4.779,10.667-10.667C490.667,341.739,447.595,298.667,394.667,298.667z"
                                            ></path>
                                        </g>
                                    </g>
                                    <g>
                                        <g>
                                            <path
                                                d="M145.707,312.512c-14.955-9.045-32.149-13.845-49.707-13.845c-52.928,0-96,43.072-96,96
                                                c0,5.888,4.779,10.667,10.667,10.667s10.667-4.779,10.667-10.667C21.333,353.493,54.827,320,96,320
                                                c13.675,0,27.029,3.712,38.635,10.752c5.013,3.051,11.584,1.451,14.656-3.584C152.363,322.133,150.741,315.584,145.707,312.512z"
                                            ></path>
                                        </g>
                                    </g>
                                    </svg>
                            </div>
                            <h4 class="counter__title counter text-color-2 fs-35">{{ number_format(count($organ->orderDetails)) }}</h4>
                            <p class="counter__meta">کل دانش آموزان</p>
                        </div>
                        <!-- end counter-item -->
                    </div>
                    <!-- end col-lg-4 -->
                    <div class="col-lg-4 responsive-column-half">
                        <div class="counter-item">
                            <div class="counter__icon icon-element mb-3 shadow-sm">
                                <svg class="svg-icon-color-1" width="45" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><g><path d="m499.5 422h-10v-304.92c0-20.678-16.822-37.5-37.5-37.5h-108.332v-27.962c0-28.462-23.156-51.618-51.618-51.618h-72.1c-28.462 0-51.618 23.156-51.618 51.618v27.962h-108.332c-20.678 0-37.5 16.822-37.5 37.5v304.92h-10c-6.893 0-12.5 5.607-12.5 12.5v34.549c0 23.683 19.268 42.951 42.951 42.951h426.098c23.683 0 42.951-19.268 42.951-42.951v-34.549c0-6.893-5.607-12.5-12.5-12.5zm-155.832-307.112h2.347c6.299 0 11.423 5.124 11.423 11.423 0 6.298-5.124 11.422-11.423 11.422h-2.347zm0 37.844h2.347c15.203.011 27.366-12.987 26.36-28.152h72.125v249.151h-18.64v-41.301c0-14.129-4.877-27.975-13.732-38.988-8.856-11.014-21.335-18.751-35.139-21.786l-67.199-14.761c-4.975-1.086-8.438-5.551-8.44-10.494v-12.896c25.347-15.384 42.318-43.248 42.318-75.002zm-144.678 120.228 6.441-1.415c6.113-1.344 11.335-4.877 14.948-9.642l24.143 17.74-15.434 15.434zm29.701 38.208-3.889 62.563h-123.662v-41.301c0-22 15.599-41.398 37.09-46.124l41.257-9.062 43.142 31.702c1.838 1.349 3.941 2.081 6.062 2.222zm57.691-64.029-30.382 22.325-30.382-22.325c.031-.624.058-5.717.033-6.388 9.461 3.502 19.686 5.419 30.35 5.419s20.888-1.917 30.35-5.419c-.013.671-.005 5.765.031 6.388zm-42.032 53.89 11.65-11.65 11.599 11.599 4.258 72.753h-32.027zm23.129-21.385 24.143-17.74c3.613 4.765 8.835 8.298 14.948 9.642l6.44 1.415-30.098 22.118zm21.894 29.3 43.14-31.701 41.256 9.062c21.492 4.726 37.091 24.124 37.091 46.124v41.302h-123.976l-3.662-62.561c2.151-.126 4.287-.857 6.151-2.226zm-106.041-194.309c10.817-.592 21.509-2.153 31.874-4.66 4.026-.974 6.501-5.027 5.527-9.054-.975-4.026-5.026-6.503-9.054-5.526-9.216 2.229-18.722 3.628-28.348 4.202v-47.979c.001-20.191 16.428-36.618 36.619-36.618h72.1c20.191 0 36.618 16.427 36.618 36.618v45.1c-6.201-2.706-12.011-6.201-17.336-10.485-7.358-5.922-13.503-13.088-18.26-21.298-1.673-2.89-4.521-4.86-7.814-5.407-3.288-.544-6.619.398-9.132 2.589-10.05 8.761-21.15 16.144-33.04 21.971-3.719 1.822-5.257 6.315-3.434 10.035 1.821 3.718 6.313 5.258 10.035 3.434 11.728-5.747 22.683-12.825 32.811-21.178 5.302 8.187 11.822 15.419 19.43 21.54 8.063 6.488 17.038 11.5 26.74 14.939v45.645c0 40.069-32.599 72.668-72.668 72.668s-72.668-32.599-72.668-72.668zm27.318 118.869v12.896c-.006 4.93-3.494 9.415-8.439 10.494l-67.201 14.761c-13.803 3.035-26.281 10.772-35.138 21.786-8.855 11.014-13.732 24.859-13.732 38.988v41.302h-18.64v-249.151h72.125c-1.022 15.115 11.132 28.186 26.36 28.152h2.347v5.77c0 31.754 16.971 59.619 42.318 75.002zm-56.087-107.193c0-6.299 5.124-11.423 11.423-11.423h2.347v22.845h-2.347c-6.299-.001-11.423-5.125-11.423-11.422zm342.437 342.738c0 15.412-12.539 27.951-27.951 27.951h-426.098c-15.412 0-27.951-12.539-27.951-27.951v-32.049h190.545v12.5c0 9.649 7.851 17.5 17.5 17.5h65.91c9.649 0 17.5-7.851 17.5-17.5v-12.5h72.043c4.143 0 7.5-3.357 7.5-7.5s-3.357-7.5-7.5-7.5h-340.998v-304.92c0-12.406 10.094-22.5 22.5-22.5h108.332v5.308h-2.347c-8.226 0-15.584 3.78-20.434 9.692h-81.551c-6.341 0-11.5 5.159-11.5 11.5v260.151c0 4.143 3.357 7.5 7.5 7.5h392c4.143 0 7.5-3.357 7.5-7.5v-260.151c0-6.341-5.159-11.5-11.5-11.5h-81.551c-4.85-5.913-12.208-9.692-20.434-9.692h-2.347v-5.308h108.332c12.406 0 22.5 10.094 22.5 22.5v304.92h-61.002c-4.143 0-7.5 3.357-7.5 7.5s3.357 7.5 7.5 7.5h83.502zm-276.455-19.549v-12.5h70.91v12.5c0 1.379-1.121 2.5-2.5 2.5h-65.91c-1.379 0-2.5-1.121-2.5-2.5zm16.377-243.596c5.712 3.132 12.166 4.823 18.662 4.892 8.306.087 15.383-2.637 19.495-4.893 3.632-1.992 4.96-6.551 2.968-10.183s-6.549-4.961-10.183-2.968c-2.545 1.396-6.654 3.045-11.863 3.045-5.146 0-9.343-1.661-11.866-3.046-3.633-1.994-8.191-.661-10.183 2.97-1.991 3.633-.662 8.191 2.97 10.183zm-19.602-52.241c4.143 0 7.5-3.357 7.5-7.5v-15.472c0-4.143-3.357-7.5-7.5-7.5s-7.5 3.357-7.5 7.5v15.472c0 4.143 3.358 7.5 7.5 7.5zm77.36 0c4.143 0 7.5-3.357 7.5-7.5v-15.472c0-4.143-3.357-7.5-7.5-7.5s-7.5 3.357-7.5 7.5v15.472c0 4.143 3.357 7.5 7.5 7.5z"></path></g></svg>
                            </div>
                            <h4 class="counter__title counter text-color-2 fs-35">{{ count($organ->teachers) }}</h4>
                            <p class="counter__meta">مدرسین</p>
                        </div>
                        <!-- end counter-item -->
                    </div>
                    <!-- end col-lg-4 -->
                    <div class="col-lg-4 responsive-column-half">
                        <div class="counter-item">
                            <div class="counter__icon icon-element mb-3 shadow-sm">
                                <svg class="svg-icon-color-3" width="40" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve">
                                        <g>
                                            <g>
                                                <g>
                                                    <path
                                                        d="M405.333,42.667h-44.632c-4.418-12.389-16.147-21.333-30.035-21.333h-32.229C288.417,8.042,272.667,0,256,0
                                                        s-32.417,8.042-42.438,21.333h-32.229c-13.888,0-25.617,8.944-30.035,21.333h-44.631C83.146,42.667,64,61.802,64,85.333v384
                                                        C64,492.865,83.146,512,106.667,512h298.667C428.854,512,448,492.865,448,469.333v-384C448,61.802,428.854,42.667,405.333,42.667
                                                        z M170.667,53.333c0-5.885,4.792-10.667,10.667-10.667h37.917c3.792,0,7.313-2.021,9.208-5.302
                                                        c5.854-10.042,16.146-16.031,27.542-16.031s21.688,5.99,27.542,16.031c1.896,3.281,5.417,5.302,9.208,5.302h37.917
                                                        c5.875,0,10.667,4.781,10.667,10.667V64c0,11.76-9.563,21.333-21.333,21.333H192c-11.771,0-21.333-9.573-21.333-21.333V53.333z
                                                         M426.667,469.333c0,11.76-9.563,21.333-21.333,21.333H106.667c-11.771,0-21.333-9.573-21.333-21.333v-384
                                                        c0-11.76,9.563-21.333,21.333-21.333h42.667c0,23.531,19.146,42.667,42.667,42.667h128c23.521,0,42.667-19.135,42.667-42.667
                                                        h42.667c11.771,0,21.333,9.573,21.333,21.333V469.333z"
                                                    ></path>
                                                    <path
                                                        d="M160,170.667c-17.646,0-32,14.354-32,32c0,17.646,14.354,32,32,32s32-14.354,32-32
                                                        C192,185.021,177.646,170.667,160,170.667z M160,213.333c-5.875,0-10.667-4.781-10.667-10.667
                                                        c0-5.885,4.792-10.667,10.667-10.667s10.667,4.781,10.667,10.667C170.667,208.552,165.875,213.333,160,213.333z"
                                                    ></path>
                                                    <path
                                                        d="M160,277.333c-17.646,0-32,14.354-32,32c0,17.646,14.354,32,32,32s32-14.354,32-32
                                                        C192,291.688,177.646,277.333,160,277.333z M160,320c-5.875,0-10.667-4.781-10.667-10.667c0-5.885,4.792-10.667,10.667-10.667
                                                        s10.667,4.781,10.667,10.667C170.667,315.219,165.875,320,160,320z"
                                                    ></path>
                                                    <path
                                                        d="M160,384c-17.646,0-32,14.354-32,32c0,17.646,14.354,32,32,32s32-14.354,32-32C192,398.354,177.646,384,160,384z
                                                         M160,426.667c-5.875,0-10.667-4.781-10.667-10.667c0-5.885,4.792-10.667,10.667-10.667s10.667,4.781,10.667,10.667
                                                        C170.667,421.885,165.875,426.667,160,426.667z"
                                                    ></path>
                                                    <path
                                                        d="M373.333,192h-128c-5.896,0-10.667,4.771-10.667,10.667c0,5.896,4.771,10.667,10.667,10.667h128
                                                        c5.896,0,10.667-4.771,10.667-10.667C384,196.771,379.229,192,373.333,192z"
                                                    ></path>
                                                    <path
                                                        d="M373.333,298.667h-128c-5.896,0-10.667,4.771-10.667,10.667c0,5.896,4.771,10.667,10.667,10.667h128
                                                        c5.896,0,10.667-4.771,10.667-10.667C384,303.438,379.229,298.667,373.333,298.667z"
                                                    ></path>
                                                    <path
                                                        d="M373.333,405.333h-128c-5.896,0-10.667,4.771-10.667,10.667c0,5.896,4.771,10.667,10.667,10.667h128
                                                        c5.896,0,10.667-4.771,10.667-10.667C384,410.104,379.229,405.333,373.333,405.333z"
                                                    ></path>
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                            </div>
                            <h4 class="counter__title counter text-color-4 fs-35">{{count($organ->courses)}}</h4>
                            <p class="counter__meta">دوره های آموزشی</p>
                        </div>
                        <!-- end counter-item -->
                    </div>
                    <!-- end col-lg-4 -->
                </div>
                <!-- end row -->
            </div>

            <div class="py-5 px-2">
                <div class="card card-item">
                    <h2 class="px-4 pt-2">درباره آموزشگاه</h2>
                    <div class="card-body">
                        {!! $organ['info']['description'] !!}
                    </div>
                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </section>
    <section class="course-area">
        <div class="container">
            <div class="d-flex align-items-center justify-content-between pb-3">
                <h3 class="fs-24 font-weight-semi-bold">دوره های آموزشی</h3>
                <span class="ribbon ribbon-lg">{{count($organ->courses)}}</span>
            </div>
            <div class="divider"><span></span></div>
            <div class="row pt-30px">
                @foreach($organ->courses as $item)
                    <div class="col-lg-3 col-md-4 col-6">
                        <x-site.courses.course-box :item="$item" />
                    </div>
                @endforeach
            </div>
        </div>
        <!-- end container -->
    </section>
    <section class="contact-area  position-relative">
        <span class="ring-shape ring-shape-1"></span>
        <span class="ring-shape ring-shape-2"></span>
        <span class="ring-shape ring-shape-3"></span>
        <span class="ring-shape ring-shape-4"></span>
        <span class="ring-shape ring-shape-5"></span>
        <span class="ring-shape ring-shape-6"></span>
        <span class="ring-shape ring-shape-7"></span>
        <div class="container">
            <div class="py-5 px-2">
                <h2 class="px-4 pt-2">ارتباط با آموزشگاه</h2>
            </div>
            <div class="row">
                <div class="col-lg-4 responsive-column-half">
                    <div class="info-box">
                        <div class="info-overlay"></div>
                        <div class="icon-element mx-auto shadow-sm">
                            <svg class="svg-icon-color-1" width="45" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">
                                <g>
                                    <g>
                                        <path
                                            d="m397.359 393.957c-3.552-2.103-8.136-.932-10.241 2.619-2.104 3.551-.931 8.136 2.619 10.241 20.542 12.174 24.854 23.563 24.854 30.974 0 14.357-16.02 29.028-43.952 40.253-30.5 12.257-71.212 19.007-114.638 19.007-43.425 0-84.138-6.75-114.638-19.007-27.933-11.224-43.953-25.896-43.953-40.252 0-14.357 16.02-29.028 43.952-40.253 12.416-4.99 26.539-9.056 41.835-12.136l58.291 67.502c3.645 4.221 8.935 6.643 14.512 6.643s10.867-2.421 14.512-6.643l58.266-67.472c10.6 2.124 20.631 4.715 29.864 7.747l1.302.433c3.923 1.304 8.148-.817 9.452-4.734 1.302-3.917-.817-8.148-4.734-9.451l-1.329-.442c-7.371-2.42-15.218-4.569-23.423-6.444l56.847-65.829c9.765-11.309 17.931-23.237 24.27-35.454 13.592-26.196 20.776-55.746 20.776-85.456 0-102.452-83.35-185.803-185.801-185.803-.002 0-.002 0-.003 0-30.467 0-60.661 7.491-87.317 21.663-3.645 1.938-5.029 6.463-3.091 10.108 1.937 3.645 6.464 5.031 10.108 3.091 24.504-13.027 52.272-19.913 80.303-19.913 94.209 0 170.853 76.645 170.853 170.855 0 27.714-6.425 54.15-19.096 78.572-5.802 11.183-13.311 22.141-22.316 32.568l-126.245 146.191c-1.1 1.274-2.476 1.464-3.198 1.464-.723 0-2.098-.19-3.198-1.464l-126.35-146.314c-8.265-9.571-15.228-19.527-20.694-29.592-13.56-24.964-20.687-53.281-20.612-81.888.135-51.322 22.92-99.361 62.512-131.801 3.193-2.616 3.661-7.325 1.044-10.518-2.615-3.193-7.324-3.661-10.518-1.044-43.06 35.28-67.84 87.52-67.987 143.325-.082 31.105 7.673 61.902 22.425 89.062 5.977 11.004 13.552 21.847 22.516 32.227l56.932 65.928c-13.097 3.01-25.303 6.737-36.283 11.149-34.388 13.819-53.326 33.04-53.326 54.123s18.939 40.304 53.326 54.123c32.232 12.952 74.924 20.085 120.213 20.085 45.29 0 87.982-7.133 120.212-20.085 34.387-13.819 53.326-33.04 53.326-54.123.001-16.2-11.127-31.357-32.179-43.835z"
                                        ></path>
                                        <path
                                            d="m256 313.833c72.133 0 130.817-58.684 130.817-130.817s-58.684-130.817-130.817-130.817-130.817 58.684-130.817 130.817 58.685 130.817 130.817 130.817zm0-14.949c-19.726 0-38.314-4.96-54.59-13.691 5.041-6.854 11.364-12.759 18.574-17.302 4.952-3.11 9.082-7.475 11.961-12.653 2.829-5.143 4.323-10.958 4.323-16.816 0-10.928-5.15-21.297-13.78-27.738-14.359-10.705-22.594-27.107-22.594-45.002 0-15.727 6.332-30.299 17.829-41.031 11.487-10.723 26.502-16.034 42.273-14.944 27.271 1.896 49.583 23.838 51.897 51.035 1.652 19.48-6.646 38.09-22.197 49.781-4.284 3.222-7.832 7.464-10.283 12.312-2.409 4.844-3.682 10.233-3.682 15.586 0 12.05 6.084 23.066 16.268 29.465 7.221 4.545 13.547 10.451 18.59 17.307-16.275 8.731-34.863 13.691-54.589 13.691zm0-231.737c63.89 0 115.869 51.978 115.869 115.868 0 38.811-19.183 73.223-48.562 94.261-6.258-8.76-14.214-16.294-23.348-22.044-5.81-3.65-9.279-9.935-9.279-16.811 0-3.099.712-6.103 2.096-8.886 1.42-2.81 3.406-5.186 5.904-7.064 19.69-14.802 30.198-38.351 28.108-62.994-2.934-34.473-31.203-62.28-65.76-64.683-19.948-1.373-38.956 5.348-53.506 18.929-14.348 13.394-22.577 32.332-22.577 51.959 0 22.328 10.695 43.632 28.605 56.984 4.865 3.632 7.77 9.521 7.77 15.756 0 3.346-.855 6.67-2.456 9.582-1.643 2.954-4.005 5.454-6.84 7.235-9.124 5.75-17.071 13.286-23.326 22.042-29.382-21.038-48.566-55.452-48.566-94.264 0-63.891 51.978-115.87 115.868-115.87z"
                                        ></path>
                                    </g>
                                </g>
                            </svg>
                        </div>
                        <h3 class="info__title">ادرس ما</h3>
                        <p class="info__text">{{ $organ['info']['address'] }}</p>
                    </div>
                    <!-- end info-box -->
                </div>
                <!-- end col-lg-3 -->
                <div class="col-lg-4 responsive-column-half">
                    <div class="info-box">
                        <div class="info-overlay"></div>
                        <div class="icon-element mx-auto shadow-sm">
                            <svg class="svg-icon-color-2" width="40" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 512 512" xml:space="preserve">
                                    <g>
                                        <g>
                                            <path
                                                d="M469.333,64H42.667C19.135,64,0,83.135,0,106.667v298.667C0,428.865,19.135,448,42.667,448h426.667
                                        C492.865,448,512,428.865,512,405.333V106.667C512,83.135,492.865,64,469.333,64z M42.667,85.333h426.667
                                        c1.572,0,2.957,0.573,4.432,0.897c-36.939,33.807-159.423,145.859-202.286,184.478c-3.354,3.021-8.76,6.625-15.479,6.625
                                        s-12.125-3.604-15.49-6.635C197.652,232.085,75.161,120.027,38.228,86.232C39.706,85.908,41.094,85.333,42.667,85.333z
                                         M21.333,405.333V106.667c0-2.09,0.63-3.986,1.194-5.896c28.272,25.876,113.736,104.06,169.152,154.453
                                        C136.443,302.671,50.957,383.719,22.46,410.893C21.957,409.079,21.333,407.305,21.333,405.333z M469.333,426.667H42.667
                                        c-1.704,0-3.219-0.594-4.81-0.974c29.447-28.072,115.477-109.586,169.742-156.009c7.074,6.417,13.536,12.268,18.63,16.858
                                        c8.792,7.938,19.083,12.125,29.771,12.125s20.979-4.188,29.76-12.115c5.096-4.592,11.563-10.448,18.641-16.868
                                        c54.268,46.418,140.286,127.926,169.742,156.009C472.552,426.073,471.039,426.667,469.333,426.667z M490.667,405.333
                                        c0,1.971-0.624,3.746-1.126,5.56c-28.508-27.188-113.984-108.227-169.219-155.668c55.418-50.393,140.869-128.57,169.151-154.456
                                        c0.564,1.91,1.194,3.807,1.194,5.897V405.333z"
                                            ></path>
                                        </g>
                                    </g>
                                </svg>
                        </div>
                        <h3 class="info__title">ادرس ایمیل</h3>
                        <p class="info__text">{{ $organ['info']['email'] }}</p>
                    </div>
                    <!-- end info-box -->
                </div>
                <!-- end col-lg-3 -->
                <div class="col-lg-4 responsive-column-half">
                    <div class="info-box">
                        <div class="info-overlay"></div>
                        <div class="icon-element mx-auto shadow-sm">
                            <svg class="svg-icon-color-3" width="40" version="1.1" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 473.806 473.806" xml:space="preserve">
                                    <g>
                                        <g>
                                            <path
                                                d="M374.456,293.506c-9.7-10.1-21.4-15.5-33.8-15.5c-12.3,0-24.1,5.3-34.2,15.4l-31.6,31.5c-2.6-1.4-5.2-2.7-7.7-4
                                            c-3.6-1.8-7-3.5-9.9-5.3c-29.6-18.8-56.5-43.3-82.3-75c-12.5-15.8-20.9-29.1-27-42.6c8.2-7.5,15.8-15.3,23.2-22.8
                                            c2.8-2.8,5.6-5.7,8.4-8.5c21-21,21-48.2,0-69.2l-27.3-27.3c-3.1-3.1-6.3-6.3-9.3-9.5c-6-6.2-12.3-12.6-18.8-18.6
                                            c-9.7-9.6-21.3-14.7-33.5-14.7s-24,5.1-34,14.7c-0.1,0.1-0.1,0.1-0.2,0.2l-34,34.3c-12.8,12.8-20.1,28.4-21.7,46.5
                                            c-2.4,29.2,6.2,56.4,12.8,74.2c16.2,43.7,40.4,84.2,76.5,127.6c43.8,52.3,96.5,93.6,156.7,122.7c23,10.9,53.7,23.8,88,26
                                            c2.1,0.1,4.3,0.2,6.3,0.2c23.1,0,42.5-8.3,57.7-24.8c0.1-0.2,0.3-0.3,0.4-0.5c5.2-6.3,11.2-12,17.5-18.1c4.3-4.1,8.7-8.4,13-12.9
                                            c9.9-10.3,15.1-22.3,15.1-34.6c0-12.4-5.3-24.3-15.4-34.3L374.456,293.506z M410.256,398.806
                                            C410.156,398.806,410.156,398.906,410.256,398.806c-3.9,4.2-7.9,8-12.2,12.2c-6.5,6.2-13.1,12.7-19.3,20
                                            c-10.1,10.8-22,15.9-37.6,15.9c-1.5,0-3.1,0-4.6-0.1c-29.7-1.9-57.3-13.5-78-23.4c-56.6-27.4-106.3-66.3-147.6-115.6
                                            c-34.1-41.1-56.9-79.1-72-119.9c-9.3-24.9-12.7-44.3-11.2-62.6c1-11.7,5.5-21.4,13.8-29.7l34.1-34.1c4.9-4.6,10.1-7.1,15.2-7.1
                                            c6.3,0,11.4,3.8,14.6,7c0.1,0.1,0.2,0.2,0.3,0.3c6.1,5.7,11.9,11.6,18,17.9c3.1,3.2,6.3,6.4,9.5,9.7l27.3,27.3
                                            c10.6,10.6,10.6,20.4,0,31c-2.9,2.9-5.7,5.8-8.6,8.6c-8.4,8.6-16.4,16.6-25.1,24.4c-0.2,0.2-0.4,0.3-0.5,0.5
                                            c-8.6,8.6-7,17-5.2,22.7c0.1,0.3,0.2,0.6,0.3,0.9c7.1,17.2,17.1,33.4,32.3,52.7l0.1,0.1c27.6,34,56.7,60.5,88.8,80.8
                                            c4.1,2.6,8.3,4.7,12.3,6.7c3.6,1.8,7,3.5,9.9,5.3c0.4,0.2,0.8,0.5,1.2,0.7c3.4,1.7,6.6,2.5,9.9,2.5c8.3,0,13.5-5.2,15.2-6.9
                                            l34.2-34.2c3.4-3.4,8.8-7.5,15.1-7.5c6.2,0,11.3,3.9,14.4,7.3c0.1,0.1,0.1,0.1,0.2,0.2l55.1,55.1
                                            C420.456,377.706,420.456,388.206,410.256,398.806z"
                                            ></path>
                                            <path
                                                d="M256.056,112.706c26.2,4.4,50,16.8,69,35.8s31.3,42.8,35.8,69c1.1,6.6,6.8,11.2,13.3,11.2c0.8,0,1.5-0.1,2.3-0.2
                                            c7.4-1.2,12.3-8.2,11.1-15.6c-5.4-31.7-20.4-60.6-43.3-83.5s-51.8-37.9-83.5-43.3c-7.4-1.2-14.3,3.7-15.6,11
                                            S248.656,111.506,256.056,112.706z"
                                            ></path>
                                            <path
                                                d="M473.256,209.006c-8.9-52.2-33.5-99.7-71.3-137.5s-85.3-62.4-137.5-71.3c-7.3-1.3-14.2,3.7-15.5,11
                                            c-1.2,7.4,3.7,14.3,11.1,15.6c46.6,7.9,89.1,30,122.9,63.7c33.8,33.8,55.8,76.3,63.7,122.9c1.1,6.6,6.8,11.2,13.3,11.2
                                            c0.8,0,1.5-0.1,2.3-0.2C469.556,223.306,474.556,216.306,473.256,209.006z"
                                            ></path>
                                        </g>
                                    </g>
                                </svg>
                        </div>
                        <h3 class="info__title">با ما تماس بگیرید</h3>
                        <p class="info__text">{{ $organ['info']['phone1'] }} {{ $organ['info']['phone2'] ? ' - '.$organ['info']['phone2'] : '' }} </p>
                    </div>
                    <!-- end info-box -->
                </div>
                <!-- end col-lg-3 -->
            </div>
        </div>
        <!-- end container -->
    </section>

</div>
