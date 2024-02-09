<footer class="bg-stone-800 pt-32 px-32 text-white">

    <!-- logo et lien vers la home -->
    <div class="w-full flex">
        <a class="mx-auto" href="{{ route('home', ['locale' => app()->getLocale()]) }}">
            <img class="w-32" src="{{ asset('images/logo-vineyards-rouge.svg') }}" alt="logo Vineyards" />
        </a>
    </div>

    <!-- social network -->
    <div class="flex gap-16 mx-auto pt-28 w-1/4">

        <span class="mx-auto">
            <a href="#" target="_blank" rel="noreferrer noopener" class="text-xl">
                <x-fab-linkedin class="h-12 hover:scale-110"/>
            </a>
        </span>

        <span class="mx-auto">
            <a href="#" target="_blank" rel="noreferrer noopener" class="text-xl">
                <x-fab-instagram class="h-12 hover:scale-110"/>
            </a>
        </span>

        <span class="mx-auto">
            <a href="#" target="_blank" rel="noreferrer noopener" class="text-xl">
                <x-fab-youtube  class="h-12 hover:scale-110"/>
            </a>
        </span>

        <span class="mx-auto">
            <a href="#" target="_blank" rel="noreferrer noopener" class="text-xl">
                <x-fab-tiktok class="h-12 hover:scale-110"/>
            </a>
        </span>

    </div>

    <!-- liens footer -->
    <nav class="pt-14 pb-8 mx-auto w-fit">
        <ul id="menu_footer" class="flex gap-2 font-bold text-lg uppercase">
            <li class="menu-item menu-item-143"><a href="home3.html"><span>Home</span></a></li>
            <li class="menu-item menu-item-675"><a href="about-us.html"><span>Our philosophy</span></a></li>
            <li class="menu-item menu-item-677"><a href="wine-list.html"><span>What we craft</span></a></li>
            <li class="menu-item menu-item-147"><a href="shop.html"><span>Shop</span></a></li>
            <li class="menu-item menu-item-676"><a href="contacts.html"><span>Privacy policy</span></a></li>
        </ul>
    </nav>


    <div class="mx-auto w-fit text-sm p-3 uppercase">

        <div class="copyright_text">Michaël Zingraf Vineyards - une marque du groupe Michaël Zingraf Real Estate ©{{ date('Y') }}</div>

    </div>

</footer>
