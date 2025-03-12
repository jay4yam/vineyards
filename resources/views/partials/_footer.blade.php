<footer class="bg-stone-800 pt-32 px-10 lg:px-32 text-white">

    <!-- logo et lien vers la home -->
    <div class="w-full flex flex-col">
        <a class="mx-auto" href="{{ route('home') }}">
            <img data-aos="fade-down"
                 data-aos-offset="0"
                 data-aos-delay="50"
                 data-aos-duration="1000"
                 data-aos-easing="ease-in-out"
                 data-aos-mirror="true"
                 data-aos-once="false"
                 data-aos-anchor-placement="top-center"
                 class="w-48 " src="{{ asset('images/logo-vineyards-rouge.svg') }}" alt="logo Vineyards" />
        </a>
        <!-- logo christie's -->
        <img data-aos="fade-up"
             data-aos-offset="-50"
             data-aos-delay="50"
             data-aos-duration="500"
             data-aos-easing="ease-in-out"
             data-aos-mirror="true"
             data-aos-once="false"
             data-aos-anchor-placement="top-center"
            class="mx-auto w-48 z-50 bottom-4 pt-10" src="{{ asset('images/cire_logo.svg') }}" alt="logo christie's international real estate">
    </div>

    <!-- social network -->
    <div class="flex gap-16 w-full lg:w-1/4 justify-between mx-auto pt-28 ">

        <a href="#" target="_blank" rel="noreferrer noopener" class="text-xl">
            <x-fab-linkedin class="h-12 hover:scale-110"/>
        </a>

        <a href="#" target="_blank" rel="noreferrer noopener" class="text-xl">
            <x-fab-instagram class="h-12 hover:scale-110"/>
        </a>

        <a href="#" target="_blank" rel="noreferrer noopener" class="text-xl">
            <x-fab-youtube  class="h-12 hover:scale-110"/>
        </a>

        <a href="#" target="_blank" rel="noreferrer noopener" class="text-xl">
            <x-fab-tiktok class="h-12 hover:scale-110"/>
        </a>

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

        <div class="flex flex-col lg:flex-row text-center text-xs">
            <span>Michaël Zingraf Vineyards</span>
            <span class="hidden lg:block">&nbsp;-&nbsp;</span>
            <span>une marque du groupe Michaël Zingraf Real Estate ©{{ date('Y') }}</span>
        </div>

    </div>

</footer>
