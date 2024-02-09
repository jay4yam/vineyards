<footer class="bg-stone-800 p-32 text-white">
    <div class="w-full flex justify-center">
        <div class="logo_footer_wrap_inner">
            <a href="{{ route('home', ['locale' => app()->getLocale()]) }}">
                <img class="w-32" src="{{ asset('images/logo-vineyards-rouge.svg') }}" alt="logo Vineyards" />
            </a>
        </div>
    </div>
    <div class="socials_footer_wrap socials_wrap scheme_dark">
        <div class="socials_footer_wrap_inner">
				<span class="social_item"><a href="#" target="_blank" class="social_icons social_twitter"><span class="trx_addons_icon-twitter"></span></a>
				</span><span class="social_item"><a href="#" target="_blank" class="social_icons social_facebook"><span class="trx_addons_icon-facebook"></span></a>
				</span><span class="social_item"><a href="#" target="_blank" class="social_icons social_instagram"><span class="trx_addons_icon-instagram"></span></a>
				</span>
        </div>
    </div>
    <div class="menu_footer_wrap scheme_dark">
        <div class="menu_footer_wrap_inner">
            <nav class="menu_footer_nav_area">
                <ul id="menu_footer" class="menu_footer_nav">
                    <li class="menu-item menu-item-143"><a href="home3.html"><span>Home</span></a></li>
                    <li class="menu-item menu-item-675"><a href="about-us.html"><span>Our philosophy</span></a></li>
                    <li class="menu-item menu-item-677"><a href="wine-list.html"><span>What we craft</span></a></li>
                    <li class="menu-item menu-item-147"><a href="shop.html"><span>Shop</span></a></li>
                    <li class="menu-item menu-item-676"><a href="contacts.html"><span>Privacy policy</span></a></li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="copyright_wrap scheme_dark">
        <div class="copyright_wrap_inner">
            <div class="content_wrap">
                <div class="copyright_text">Michaël Zingraf Vineyards - une marque du groupe Michaël Zingraf Real Estate ©{{ date('Y') }}. All rights reserved.</div>
            </div>
        </div>
    </div>
</footer>
