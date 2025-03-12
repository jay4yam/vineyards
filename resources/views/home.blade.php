<x-front-layout>

    <!-- header video -->
    <header class="relative flex items-center justify-center h-screen w-full overflow-hidden">

        <!--logo & baseline -->
        <div class="relative z-40 w-1/2 h-fit m-auto left-0 right-0 top-0 bottom-0 text-white drop-shadow text-center">
            <div class="flex flex-col gap-4">
                <img data-aos="fade-down"
                     data-aos-offset="0"
                     data-aos-delay="1000"
                     data-aos-duration="1000"
                     data-aos-easing="ease-in-out"
                     data-aos-mirror="true"
                     data-aos-once="false"
                     data-aos-anchor-placement="top-center"
                     class="h-64 pb-20"
                     height="200" src="{{ asset('images/logo-vineyards.svg') }}"
                     alt="logo Michaël Zingraf Real Estate"/>
                <h1 data-aos="fade-down"
                    data-aos-offset="0"
                    data-aos-delay="1500"
                    data-aos-duration="1000"
                    data-aos-easing="ease-in-out"
                    data-aos-mirror="true"
                    data-aos-once="false"
                    class="font-eurostile text-shadow uppercase text-2xl font-bold z-50">{{ __('home.baseline') }}</h1>
                <h2 data-aos="fade-up"
                    data-aos-offset="0"
                    data-aos-delay="2000"
                    data-aos-duration="1000"
                    data-aos-easing="ease-in-out"
                    data-aos-mirror="true"
                    data-aos-once="false"
                    class="font-retro lowercase text-7xl text-shadow animate-fade-down animate-once animate-delay-[3000ms] animate-ease-in-out">{{ __('home.secondline') }}</h2>
            </div>
        </div>

        <!-- video de la home page-->
        <video poster="{{ asset('images/bg-video.webp') }}" autoplay loop muted class="absolute z-10 w-auto min-w-full min-h-screen max-w-none">
            <source src="{{ asset('images/vineyards.mp4') }}" type="video/mp4">
        </video>

        <!-- logo christie's -->
        <img data-aos="zoom-in"
             data-aos-offset="0"
             data-aos-delay="2500"
             data-aos-duration="1000"
             data-aos-easing="ease-in-out"
             data-aos-mirror="true"
             data-aos-once="false"
             class="absolute w-48 z-50 bottom-4 animate-fade-up animate-once animate-delay-[3500ms] animate-ease-in-out"
             src="{{ asset('images/cire_logo.svg') }}" alt="logo christie's international real estate">

    </header>

    <!-- bloc MZ et Intro -->
    <section class="flex flex-col lg:flex-row">

        <!-- MZ & HZ photo -->
        <div class="w-full lg:w-1/2 h-96 lg:h-auto"
             data-aos="fade-right"
             data-aos-offset="-200"
             data-aos-delay="50"
             data-aos-duration="1000"
             data-aos-easing="ease-in-out"
             data-aos-mirror="true"
             data-aos-anchor-placement="top-center">
            <img class="w-full lg:h-full object-cover" src="{{ asset('images/michael-heathcliff-zingraf.webp') }}" alt="michaël et heatghcliff zingraf">
        </div>
        <!-- end MZ & HZ photo -->

        <!-- intro -->
        <div class="w-full lg:w-1/2 p-8 lg:p-28 text-justify">
            <h2 class="uppercase font-black text-3xl text-black py-4 text-center">{{ __('home.metier_passion') }}</h2>
            <h3 class="font-crimson font-bold">
                Dans chaque verre de vin se reflète l'essence d'un terroir,
                et derrière chaque domaine viticole, une demeure rêvée où l'art de vivre
                se marie à la perfection avec l'immobilier de prestige.
            </h3>
            <div class="text-gray-500 font-crimson pt-12">
                <p class="py-2">En tant que fondateur du groupe Michaël Zingraf Real Estate,
                    j'ai toujours souhaité marier mes passions pour l'immobilier
                    et la pierre et le monde exquis du vin. C'est avec une grande fierté
                    que nous avons lançé notre département Vineyards, une initiative
                    qui reflète cette fusion de passions. Ce nouveau département offre
                    à nos clients une sélection exclusive de vignobles, des domaines familiaux intimes
                    aux châteaux emblématiques, tous choisis pour leur caractère unique
                    et leur excellence en matière de vinification.</p>

                <p class="py-2">Ma vision et celle de mon équipe sont claires :
                    Offrir une expérience d'achat incomparable dans le secteur des propriétés viticoles,
                    en mettant à profit notre expertise reconnue dans l'immobilier de luxe.
                    Nous guidons nos clients à chaque étape, de la sélection de la propriété parfaite
                    à la gestion après l'achat, en mettant l'accent sur l'authenticité et la tradition.
                </p>

                <p class="py-2">Lancer le département vineyards est plus qu'un ajout
                    à Michaël Zingraf Real Estate ; c'est une invitation
                    à nos clients de partager notre amour pour le vin et de
                    réaliser leur rêve de posséder un morceau de la tradition viticole.
                    Avec nous, investir dans un vignoble devient non seulement un choix passionné
                    mais aussi un investissement des plus enrichissants.
                </p>
                <p data-aos="fade-up"
                   data-aos-offset="0"
                   data-aos-delay="50"
                   data-aos-duration="1000"
                   data-aos-easing="ease-in-out"
                   data-aos-mirror="true"
                   data-aos-anchor-placement="top-bottom"
                   class="font-retro text-red-600 text-5xl text-center pt-12">Michaël & Heathcliff Zingraf</p>
            </div>
        </div>

    </section>

    <!-- philosophie & img bg -->
    <section class="flex flex-col lg:flex-row">

        <!-- intro -->
        <div class="w-full lg:w-1/2 order-2 lg:order-1 p-8 lg:p-28 text-justify">
            <h2 class="uppercase font-black text-3xl text-black py-4 text-center">Notre Philosophie</h2>
            <h3 class="font-crimson font-bold">
                Vendre un domaine viticole, c'est transmettre un héritage de passion et d'excellence,
                où chaque vignoble raconte l'histoire d'une terre et d'un savoir-faire ancestral.
            </h3>
            <div class="text-gray-500 font-crimson pt-14">
                <p class="py-2">
                    La philosophie de Michaël Zingraf Vineyards repose sur l'harmonie
                    entre notre passion pour le vin et notre expertise en immobilier de luxe,
                    guidée par nos valeurs fondamentales : excellence, discrétion, intégrité, et confiance.
                    Nous recherchons l'excellence dans la sélection de chaque vignoble,
                    assurant un service personnalisé et d'exception. La discrétion est primordiale,
                    respectant la confidentialité de nos clients à chaque étape. L'intégrité anime notre démarche,
                    garantissant transparence et authenticité dans nos conseils. La confiance,
                    pierre angulaire de nos relations, se forge à travers un accompagnement sur mesure
                    et dévoué, répondant aux attentes les plus élevées.
                </p>

                <p class="py-2">
                    Chez Michaël Zingraf Vineyards, nous promettons une expérience unique,
                    où l'amour du vin et le luxe de l'immobilier se rencontrent pour créer des histoires uniques,
                    capturant l'essence de terroirs exceptionnels dans chaque propriété sélectionnée.
                </p>

                <div class="text-center rounded-sm pt-12">
                    <button class="bg-red-700 hover:bg-red-600 p-3 text-white ">Contactez-nous</button>
                </div>
            </div>
        </div>

        <!-- BG-wine -->
        <div class="w-full lg:w-1/2 order-1 lg:order-2 h-96 lg:h-auto bg-wine">
            <img data-aos="fade-right"
                 data-aos-offset="-200"
                 data-aos-delay="50"
                 data-aos-duration="1000"
                 data-aos-easing="ease-in-out"
                 data-aos-mirror="true"
                 data-aos-anchor-placement="top-center"
                 class="h-full object-cover" src="{{ asset('/images/bg-vin.webp') }}" alt="">
        </div>

    </section>

    <!-- PROPERTIES -->
    <section class="flex flex-wrap">

        <!-- produits -->
        <div class="basis-full lg:basis-1/2 grid grid-cols-1 lg:grid-cols-2 auto-rows-max gap-2">

            @foreach($featuredProperties as $property)
                <x-home-property :property="$property" :index="$loop->index"/>
            @endforeach

        </div>

        <!-- texte présentation -->
        <div class="basis-full lg:basis-1/2 p-8 lg:p-28 text-justify">
            <h2 class="uppercase font-black text-3xl text-black py-4 text-center">Nos Propriétés</h2>
            <h3 class="font-crimson font-bold">
                Découvrez les Trésors Viticoles en Provence et dans le monde avec Michaël Zingraf Vineyards.
                Au cœur de notre succès, une équipe d'experts, spécialistes en immobilier de luxe, en œnologie et en
                cession d'entreprise
                conjuguent leurs savoirs pour vous offrir un accompagnement sur-mesure dans l'acquisition de propriétés
                viticoles d'exception.
            </h3>

            <p class="text-gray-500 font-crimson pt-14">
                Au cœur des paysages envoûtants où les vignes se dessinent à l'horizon,
                Michaël Zingraf Vineyards vous invite à explorer une collection exclusive
                de propriétés viticoles en Provence et au-delà. Notre réputation,
                bâtie sur la passion du terroir et l'excellence du savoir-faire,
                nous positionne comme le partenaire privilégié des amateurs
                de vin et des investisseurs à la recherche de domaines d'exception.
                Nos propriétés viticoles à la vente sont plus qu'un investissement;
                elles sont le reflet d'un art de vivre, d'une histoire et d'un héritage.
                En Provence, terre bénie des dieux, où la vigne se marie à la lavande sous un ciel d'azur,
                nous proposons des domaines où tradition et modernité se rencontrent pour produire des vins de
                caractère.
            </p>

            <p class="text-gray-500 font-crimson pt-2"><strong>Un Accompagnement Sur-Mesure</strong><br>
                Acheter une propriété viticole est une démarche unique qui demande une expertise spécifique.
                Chez Michaël Zingraf Vineyards, nous comprenons les enjeux liés à cet investissement.
                Notre équipe d'experts vous accompagne à chaque étape, depuis la sélection de
                votre domaine jusqu'à la concrétisation de votre projet, en vous fournissant conseils juridiques,
                techniques et commerciaux.
            </p>

            <div class="text-center rounded-sm pt-12">
                <button class="bg-red-700 hover:bg-red-600 p-3 text-white ">Découvrez toutes nos propriétés</button>
            </div>
        </div>
    </section>

    <!-- STAFF & FORM -->
    <section class="flex flex-col lg:flex-row">

        <!-- colonne staff -->
        <div class="w-full lg:w-1/2 p-8 lg:pt-24 lg:px-24 text-justify">
            <h2 class="uppercase font-black text-3xl text-black py-4 text-center">{{ __('home.brand') }}</h2>
            <h3 class="font-crimson font-bold text-center">{{ __('home.staff') }}</h3>

            <div class="flex flex-wrap gap-y-6 p-6">

                <!-- staff -->
                <div data-aos="fade-up"
                     data-aos-offset="200"
                     data-aos-delay="50"
                     data-aos-duration="500"
                     data-aos-easing="ease-in-out"
                     data-aos-mirror="true"
                     data-aos-once="false"
                     class="w-1/2 flex flex-col gap-2 items-center text-gray-600 text-sm">
                    <img class="mx-auto w-full lg:w-1/2 rounded-md" src="{{ asset('images/staff/caroline-carlini-loup.webp') }}" alt="caroline carlini loup">
                    <p>
                        Caroline <span class="uppercase font-bold">Carlini-Loup</span>
                    </p>
                    <p>
                        Vineyards Broker
                    </p>
                    <div class="flex gap-4 justify-center">
                        <a href="#"><x-fab-linkedin class="h-6 hover:text-red-800"/></a>
                        <a href="#"><x-fab-facebook-square class="h-6 hover:text-red-800"/></a>
                        <a href="#"><x-fas-envelope class="h-6 hover:text-red-800" /></a>
                    </div>
                </div>

                <!-- staff -->
                <div class="w-1/2 flex flex-col gap-2 items-center text-gray-600 text-sm">
                    <img class="mx-auto w-full lg:w-1/2 rounded-md" src="{{ asset('images/staff/caroline-carlini-loup.webp') }}" alt="caroline carlini loup">
                    <p>
                        Caroline <span class="uppercase font-bold">Carlini-Loup</span>
                    </p>
                    <p>
                        Vineyards Broker
                    </p>
                    <div class="flex gap-4 justify-center">
                        <a href="#"><x-fab-linkedin class="h-6 hover:text-red-800"/></a>
                        <a href="#"><x-fab-facebook-square class="h-6 hover:text-red-800"/></a>
                        <a href="#"><x-fas-envelope class="h-6 hover:text-red-800" /></a>
                    </div>
                </div>

                <!-- staff -->
                <div class="w-1/2 flex flex-col gap-2 items-center text-gray-600 text-sm">
                    <img class="mx-auto w-full lg:w-1/2 rounded-md" src="{{ asset('images/staff/caroline-carlini-loup.webp') }}" alt="caroline carlini loup">
                    <p>
                        Caroline <span class="uppercase font-bold">Carlini-Loup</span>
                    </p>
                    <p>
                        Vineyards Broker
                    </p>
                    <div class="flex gap-4 justify-center">
                        <a href="#"><x-fab-linkedin class="h-6 hover:text-red-800"/></a>
                        <a href="#"><x-fab-facebook-square class="h-6 hover:text-red-800"/></a>
                        <a href="#"><x-fas-envelope class="h-6 hover:text-red-800" /></a>
                    </div>
                </div>

                <!-- staff -->
                <div class="w-1/2 flex flex-col gap-2 items-center text-gray-600 text-sm">
                    <img class="mx-auto w-full lg:w-1/2 rounded-md" src="{{ asset('images/staff/caroline-carlini-loup.webp') }}" alt="caroline carlini loup">
                    <p>
                        Caroline <span class="uppercase font-bold">Carlini-Loup</span>
                    </p>
                    <p>
                        Vineyards Broker
                    </p>
                    <div class="flex gap-4 justify-center">
                        <a href="#"><x-fab-linkedin class="h-6 hover:text-red-800"/></a>
                        <a href="#"><x-fab-facebook-square class="h-6 hover:text-red-800"/></a>
                        <a href="#"><x-fas-envelope class="h-6 hover:text-red-800" /></a>
                    </div>
                </div>

                <!-- staff -->
                <div class="w-1/2 flex flex-col gap-2 items-center text-gray-600 text-sm">
                    <img class="mx-auto w-full lg:w-1/2 rounded-md" src="{{ asset('images/staff/caroline-carlini-loup.webp') }}" alt="caroline carlini loup">
                    <p>
                        Caroline <span class="uppercase font-bold">Carlini-Loup</span>
                    </p>
                    <p>
                        Vineyards Broker
                    </p>
                    <div class="flex gap-4 justify-center">
                        <a href="#"><x-fab-linkedin class="h-6 hover:text-red-800"/></a>
                        <a href="#"><x-fab-facebook-square class="h-6 hover:text-red-800"/></a>
                        <a href="#"><x-fas-envelope class="h-6 hover:text-red-800" /></a>
                    </div>
                </div>

                <!-- staff -->
                <div class="w-1/2 flex flex-col gap-2 items-center text-gray-600 text-sm">
                    <img class="mx-auto w-full lg:w-1/2 rounded-md" src="{{ asset('images/staff/caroline-carlini-loup.webp') }}" alt="caroline carlini loup">
                    <p>
                        Caroline <span class="uppercase font-bold">Carlini-Loup</span>
                    </p>
                    <p>
                        Vineyards Broker
                    </p>
                    <div class="flex gap-4 justify-center">
                        <a href="#"><x-fab-linkedin class="h-6 hover:text-red-800"/></a>
                        <a href="#"><x-fab-facebook-square class="h-6 hover:text-red-800"/></a>
                        <a href="#"><x-fas-envelope class="h-6 hover:text-red-800" /></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- main form -->
        <div class="w-full lg:w-1/2 h-fit lg:h-auto bg-form hover:cursor-pointer flex items-center justify-center">

            <div class="my-10 lg:my-28 mx-12 lg:mx-44 w-full lg:w-2/3 bg-white rounded-md drop-shadow-2xl"
                 data-aos="flip-left"
                 data-aos-offset="0"
                 data-aos-delay="50"
                 data-aos-duration="1000"
                 data-aos-easing="ease-in-out"
                 data-aos-mirror="false"
                 data-aos-once="true"
                 data-aos-anchor-placement="top-center">

                <form action="{{ route('contact.form.submit') }}" method="post" class="p-6 lg:p-14" method="POST">
                    <input type="hidden" name="ip_address" value="{{ request()->getClientIp() }}">
                    <input type="hidden" name="sources" value="form_home_page">
                    @method('post')
                    @csrf
                    @if(! session()->has('form_contact_success'))
                        <div class="flex flex-col gap-6 pb-6">
                            <img class="mx-auto w-20" src="{{ asset('images/logo-vineyards-rouge.svg') }}"
                                 alt="logo Michaël Zingraf Vineyards">
                            <h4 class="uppercase text-center font-black text-xl">{{ __('form.contact-us') }}</h4>
                            <p class="text-base text-justify text-gray-500 hidden lg:block">
                                Prêt à explorer l'univers des vignobles d'exception ?<br>
                                Laissez-nous vous accompagner dans cette quête passionnante.
                                Remplissez le formulaire ci-dessous et un membre de notre équipe d'experts
                                vous contactera pour donner vie à votre projet viticole.</p>
                        </div>
                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('form.name')" class="text-gray-700"/>
                            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required/>
                            <x-input-error :messages="$errors->get('name')" class="mt-2"/>
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="phone" :value="__('form.phone')" class="text-gray-700"/>
                            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('email')" required/>
                            <x-input-error :messages="$errors->get('phone')" class="mt-2"/>
                        </div>

                        <!-- Email Address -->
                        <div class="mt-4">
                            <x-input-label for="email" :value="__('form.email')" class="text-gray-700"/>
                            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                          :value="old('email')" required/>
                            <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                        </div>

                        <!-- Message -->
                        <div class="mt-4">
                            <x-input-label for="message" :value="__('form.message')" class="text-gray-700"/>
                            <x-text-area id="message" class="block mt-1 w-full" name="message" :value="old('message')" required/>
                            <x-input-error :messages="$errors->get('message')" class="mt-2"/>
                        </div>

                        <div class="text-center rounded-sm pt-12">
                            <button type="submit" class="rounded-sm bg-red-700 hover:bg-red-600 p-3 text-white ">{{ __('form.send') }}</button>
                        </div>
                    @else
                        <div x-init="$el.closest('form').scrollIntoView()">
                            <p>{{ __('form.thanks') }}</p>
                        </div>
                    @endif
                </form>

            </div>

        </div>

    </section>

    <!-- réassurance -->
    <section class="flex flex-col lg:flex-row gap-y-12 w-full p-10 lg:p-20 justify-center items-start text-gray-500 font-crimson">

        <div data-aos="fade-right"
             data-aos-delay="100"
             data-aos-duration="500"
             data-aos-easing="ease-in-out"
             data-aos-mirror="true"
             data-aos-anchor-placement="center-bottom"
             class="w-full lg:w-1/3 flex flex-col justify-center">
            <x-iconsax-lin-award class="h-10 text-black"/>
            <h3 class="uppercase font-black text-md text-black py-4 text-center">Une Expertise Confirmé</h3>
            <p class="px-0 lg:px-8 text-center lg:text-justify text-md">
                Depuis 1977, l'expérience dans le domaine viticole et immobilier de luxe,
                de Michaël Zingraf Vineyards est reconnu pour son expertise approfondie,
                assurant une connaissance inégalée du marché et des opportunités d'investissement les plus prestigieuses
            </p>
        </div>


        <div data-aos="fade-up"
             data-aos-delay="200"
             data-aos-duration="500"
             data-aos-easing="ease-in-out"
             data-aos-mirror="true"
             data-aos-anchor-placement="center-bottom"
             class="w-full lg:w-1/3 flex flex-col justify-center">
            <x-iconsax-lin-award class="h-10 text-black"/>
            <h3 class="uppercase font-black text-md text-black py-4 text-center">Un Réseau Exclusif</h3>
            <p class="px-0 lg:px-8 text-center lg:text-justify text-md">Bénéficiez de notre réseau exclusif
                d'opportunités privées et de contacts dans le monde entier,
                permettant un accès privilégié à des propriétés viticoles d'exception qui ne sont souvent
                pas disponibles sur le marché ouvert.
            </p>
        </div>

        <div data-aos="fade-left"
             data-aos-delay="300"
             data-aos-duration="500"
             data-aos-easing="ease-in-out"
             data-aos-mirror="true"
             data-aos-anchor-placement="center-bottom"
             class="w-full lg:w-1/3 flex flex-col justify-center">
            <x-iconsax-lin-award class="h-10 text-black"/>
            <h3 class="uppercase font-black text-md text-black py-4 text-center">Un Accompagnement Personnalisé</h3>
            <p class="px-0 lg:px-8 text-center lg:text-justify text-md">Notre équipe de spécialistes en immobilier,
                œnologie,
                et cession d'entreprise offre un accompagnement personnalisé à chaque étape de votre projet,
                garantissant une expérience d'achat ou de vente fluide et sans souci.
            </p>
        </div>
    </section>

    <!-- adresse -->
    <section class="flex justify-center items-center bg-address">

        <div class="m-10 lg:m-28 w-full lg:w-1/3 bg-white rounded-md p-20 text-center"
             data-aos="zoom-in"
             data-aos-offset="0"
             data-aos-delay="50"
             data-aos-duration="1000"
             data-aos-easing="ease-in-out"
             data-aos-mirror="false"
             data-aos-once="true"
             data-aos-anchor-placement="top-center">

            <h3 class="uppercase text-center font-black text-xl">Michaël Zingraf Vineyards</h3>

            <p class="font-crimson text-sm text-center p-6">
                Venez découvrir l'élégance intemporelle chez Michael Zingraf Vineyards,
                où chaque vignoble est une porte ouverte sur un monde où le luxe
                et la terre se rencontrent en harmonie parfaite.
            </p>
            <div class="w-full flex p-6">
                <x-fas-map-marker-alt class="mx-auto h-12 text-red-600"/>
            </div>
            <div class="flex flex-col gap-4 font-crimson italic">
                <div>
                    <p class="text-black">Adresse</p>
                    <p class="text-gray-500">2 rue du Quadrille - Résidence Les Lices</p>
                    <p class="text-gray-500">83990 SAINT-TROPEZ</p>
                </div>

                <div>
                    <p class="text-black">{{ __('form.phone') }}</p>
                    <a href="tel:+33(0)4.22.400.300" class="text-gray-500">+33(0)4.22.400.300</a>
                </div>

                <div>
                    <p class="text-black">{{ __('form.email') }}</p>
                    <a href="mailto:vineyards@michaelzingraf.com" class="text-gray-500">vineyards@michaelzingraf.com</a>
                </div>
            </div>
        </div>
    </section>

</x-front-layout>
