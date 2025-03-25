<?php

namespace App\Traits;

use App\Models\Blog;
use App\Models\ListeSeo;
use App\Models\Properties\Property;
use Illuminate\Support\Str;
use RalphJSmit\Laravel\SEO\SchemaCollection;
use RalphJSmit\Laravel\SEO\Support\AlternateTag;
use RalphJSmit\Laravel\SEO\Support\SEOData;

trait Seoable
{
    /**
     * Retourne le seo pour la home page
     * @return SEOData
     */
    public function seoHome(): SEOData
    {
        return match(app()->getLocale()){
            'fr' => new SEOData(
                title :"Vente Vignobles et Domaines Viticoles en France",
                description:"Vente de vignobles, domaines et propriétés viticoles de prestige en France. Trouvez le domaine viticole idéal avec Michaël Zingraf Vineyards",
                image:asset('/images/vineyards-for-sale.jpg'),
                alternates:[
                    new AlternateTag(
                        hreflang:'x-default',
                        href:route('home', ['locale' => 'fr']),
                    ),
                    new AlternateTag(
                        hreflang:'en',
                        href:route('home', ['locale' => 'en']),
                    ),
                    new AlternateTag(
                        hreflang:'fr',
                        href:route('home', ['locale' => 'fr']),
                    ),
                    new AlternateTag(
                        hreflang:'de',
                        href:route('home', ['locale' => 'de']),
                    ),
                ]
            ),
            'en' => new SEOData(
                title :"Vineyards and wine estates for sale in France",
                description:"Prestigious vineyards, estates and winegrowing properties for sale in France. Find your ideal wine estate with Michaël Zingraf Vineyards",
                image:asset('/images/vineyards-for-sale.jpg'),
                alternates:[
                    new AlternateTag(
                        hreflang:'x-default',
                        href:route('home', ['locale' => 'fr']),
                    ),
                    new AlternateTag(
                        hreflang:'en',
                        href:route('home', ['locale' => 'en']),
                    ),
                    new AlternateTag(
                        hreflang:'fr',
                        href:route('home', ['locale' => 'fr']),
                    ),
                    new AlternateTag(
                        hreflang:'de',
                        href:route('home', ['locale' => 'de']),
                    ),
                ]
            ),
            'de' => new SEOData(
                title :"Weinberge und Weingüter in Frankreich zu verkaufen",
                description:"Renommierte Weinberge, Weingüter und Weinbaugrundstücke in Frankreich zu verkaufen. Finden Sie Ihr ideales Weingut mit Michaël Zingraf Vineyards",
                image:asset('/images/vineyards-for-sale.jpg'),
                alternates:[
                    new AlternateTag(
                        hreflang:'x-default',
                        href:route('home', ['locale' => 'fr']),
                    ),
                    new AlternateTag(
                        hreflang:'en',
                        href:route('home', ['locale' => 'en']),
                    ),
                    new AlternateTag(
                        hreflang:'fr',
                        href:route('home', ['locale' => 'fr']),
                    ),
                    new AlternateTag(
                        hreflang:'de',
                        href:route('home', ['locale' => 'de']),
                    ),
                ]
            ),
        };
    }

    /**
     * Retourne le seo de la page contact
     * @return SEOData
     */
    public function seoContact(): SEOData
    {
        return match(app()->getLocale()){
            'fr' => new SEOData(
                title :"👉 Contactez Michaël Zingraf Vineyards | Achat & Vente de Vignobles en France",
                description:"Contactez Michaël Zingraf Vineyards pour l'achat ou la vente de vignobles et propriétés viticoles en France. Nos experts vous accompagnent dans votre projet viticole avec discrétion et expertise.",
                image:asset('/images/contact-michael-zingraf-vineyards.webp'),
                schema: SchemaCollection::make()
                    ->add(fn (SEOData $SEOData) => [
                        '@context' => 'https://schema.org',
                        '@type' => 'Organization',
                        'name' => 'Michaël Zingraf Vineyards',
                        'legalName' => 'Michaël Zingraf Vineyards',
                        'url' => 'https://vineyards.michaelzingraf.com',
                        'logo' => 'https://vineyards.michaelzingraf.com/images/logo-vineyards-rouge.svg',
                        'foundingDate' => '1977',
                        'founders' => [
                            'type' => 'Person',
                            'name' => 'Michaël Zingraf',
                        ],
                        'address' => [
                            '@type' => 'PostalAddress',
                            'streetAddress' => '1 rue du Quadrille',
                            'addressLocality' => 'Saint-Tropez',
                            'postalCode' => '83990',
                            'addressCountry' => 'Fr',
                        ],
                        'contactPoint' => [
                            '@type' => 'ContactPoint',
                            'contactType' => 'customer service',
                            'telephone' => '[+33(0)4.94.97.07.07]',
                            'email' => 'vineyards.michaelzingraf@gmail.com',
                        ],
                    ]),
                alternates:[
                    new AlternateTag(
                        hreflang:'x-default',
                        href:url( '/fr/'.trans('routes.contact', locale:'fr')),
                    ),
                    new AlternateTag(
                        hreflang:'en',
                        href:url( '/en/'.trans('routes.contact', locale:'en')),
                    ),
                    new AlternateTag(
                        hreflang:'fr',
                        href:url( '/fr/'.trans('routes.contact', locale:'fr')),
                    ),
                    new AlternateTag(
                        hreflang:'de',
                        href:url( '/de/'.trans('routes.contact', locale:'de')),
                    ),
                ]
            ),
            'en' => new SEOData(
                title :"👉 Contact Michaël Zingraf Vineyards | Buy & Sell Vineyards in France",
                description:"Contact Michaël Zingraf Vineyards to buy or sell vineyards and wine estates in France. Our experts will guide you through your wine project with discretion and expertise.",
                image:asset('/images/contact-michael-zingraf-vineyards.webp'),
                schema: SchemaCollection::make()
                    ->add(fn (SEOData $SEOData) => [
                        '@context' => 'https://schema.org',
                        '@type' => 'Organization',
                        'name' => 'Michaël Zingraf Vineyards',
                        'legalName' => 'Michaël Zingraf Vineyards',
                        'url' => 'https://vineyards.michaelzingraf.com',
                        'logo' => 'https://vineyards.michaelzingraf.com/images/logo-vineyards-rouge.svg',
                        'foundingDate' => '1977',
                        'founders' => [
                            'type' => 'Person',
                            'name' => 'Michaël Zingraf',
                        ],
                        'address' => [
                            '@type' => 'PostalAddress',
                            'streetAddress' => '1 rue du Quadrille',
                            'addressLocality' => 'Saint-Tropez',
                            'postalCode' => '83990',
                            'addressCountry' => 'Fr',
                        ],
                        'contactPoint' => [
                            '@type' => 'ContactPoint',
                            'contactType' => 'customer service',
                            'telephone' => '[+33(0)4.94.97.07.07]',
                            'email' => 'vineyards.michaelzingraf@gmail.com',
                        ],
                    ]),
                alternates:[
                    new AlternateTag(
                        hreflang:'x-default',
                        href:url( '/fr/'.trans('routes.contact', locale:'fr')),
                    ),
                    new AlternateTag(
                        hreflang:'en',
                        href:url( '/en/'.trans('routes.contact', locale:'en')),
                    ),
                    new AlternateTag(
                        hreflang:'fr',
                        href:url( '/fr/'.trans('routes.contact', locale:'fr')),
                    ),
                    new AlternateTag(
                        hreflang:'de',
                        href:url( '/de/'.trans('routes.contact', locale:'de')),
                    ),
                ]
            ),
            'de' => new SEOData(
                title :"👉 Kontakt zu Michael Zingraf Vineyards | Kaufen & Verkaufen von Weinbergen in Frankreich",
                description:"Kontaktieren Sie Michaël Zingraf Vineyards, um Weinberge und Weingüter in Frankreich zu kaufen oder zu verkaufen. Unsere Experten werden Sie mit Diskretion und Fachwissen durch Ihr Weinprojekt begleiten.",
                image:asset('/images/contact-michael-zingraf-vineyards.webp'),
                schema: SchemaCollection::make()
                    ->add(fn (SEOData $SEOData) => [
                        '@context' => 'https://schema.org',
                        '@type' => 'Organization',
                        'name' => 'Michaël Zingraf Vineyards',
                        'legalName' => 'Michaël Zingraf Vineyards',
                        'url' => 'https://vineyards.michaelzingraf.com',
                        'logo' => 'https://vineyards.michaelzingraf.com/images/logo-vineyards-rouge.svg',
                        'foundingDate' => '1977',
                        'founders' => [
                            'type' => 'Person',
                            'name' => 'Michaël Zingraf',
                        ],
                        'address' => [
                            '@type' => 'PostalAddress',
                            'streetAddress' => '1 rue du Quadrille',
                            'addressLocality' => 'Saint-Tropez',
                            'postalCode' => '83990',
                            'addressCountry' => 'FR',
                        ],
                        'contactPoint' => [
                            '@type' => 'ContactPoint',
                            'contactType' => 'customer service',
                            'telephone' => '[+33(0)4.94.97.07.07]',
                            'email' => 'vineyards.michaelzingraf@gmail.com',
                        ],
                    ]),
                alternates:[
                    new AlternateTag(
                        hreflang:'x-default',
                        href:url( '/fr/'.trans('routes.contact', locale:'fr')),
                    ),
                    new AlternateTag(
                        hreflang:'en',
                        href:url( '/en/'.trans('routes.contact', locale:'en')),
                    ),
                    new AlternateTag(
                        hreflang:'fr',
                        href:url( '/fr/'.trans('routes.contact', locale:'fr')),
                    ),
                    new AlternateTag(
                        hreflang:'de',
                        href:url( '/de/'.trans('routes.contact', locale:'de')),
                    ),
                ]
            ),
        };
    }

    /**
     * Retourne le seo de l'index des articles de blog
     * @return SEOData
     */
    public function seoBlogIndex(): SEOData
    {
        return match(app()->getLocale()){
            'fr' => new SEOData(
                title :"Blog - Actualités & Conseils sur l’Investissement Viticole",
                description:"Découvrez les actualités et conseils sur l’investissement viticole. De l’acquisition d’un domaine à la valorisation de votre vignoble, suivez nos analyses.",
                image:asset('/images/vineyards-for-sale.jpg'),
                alternates:[
                    new AlternateTag(
                        hreflang:'x-default',
                        href:route('blog.index', ['locale' => 'fr']),
                    ),
                    new AlternateTag(
                        hreflang:'en',
                        href:route('blog.index', ['locale' => 'en']),
                    ),
                    new AlternateTag(
                        hreflang:'fr',
                        href:route('blog.index', ['locale' => 'fr']),
                    ),
                    new AlternateTag(
                        hreflang:'de',
                        href:route('blog.index', ['locale' => 'de']),
                    ),
                ]
            ),
            'en' => new SEOData(
                title :"Blog - News & Advice on Wine Investment",
                description:"Discover the latest news and advice on wine investment. From acquiring an estate to enhancing your vineyard, follow our analyses.",
                image:asset('/images/vineyards-for-sale.jpg'),
                alternates:[
                    new AlternateTag(
                        hreflang:'x-default',
                        href:route('blog.index', ['locale' => 'fr']),
                    ),
                    new AlternateTag(
                        hreflang:'en',
                        href:route('blog.index', ['locale' => 'en']),
                    ),
                    new AlternateTag(
                        hreflang:'fr',
                        href:route('blog.index', ['locale' => 'fr']),
                    ),
                    new AlternateTag(
                        hreflang:'de',
                        href:route('blog.index', ['locale' => 'de']),
                    ),
                ]
            ),
            'de' => new SEOData(
                title :"Blog - Nachrichten & Tipps zu Weininvestitionen",
                description:"Entdecken Sie aktuelle Nachrichten und Ratschläge zu Investitionen in den Weinbau. Vom Erwerb eines Weinguts bis zur Aufwertung Ihres Weinbergs, folgen Sie unseren Analysen.",
                image:asset('/images/vineyards-for-sale.jpg'),
                alternates:[
                    new AlternateTag(
                        hreflang:'x-default',
                        href:route('blog.index', ['locale' => 'fr']),
                    ),
                    new AlternateTag(
                        hreflang:'en',
                        href:route('blog.index', ['locale' => 'en']),
                    ),
                    new AlternateTag(
                        hreflang:'fr',
                        href:route('blog.index', ['locale' => 'fr']),
                    ),
                    new AlternateTag(
                        hreflang:'de',
                        href:route('blog.index', ['locale' => 'de']),
                    ),
                ]
            ),
        };
    }

    /**
     * Retourne le seo de la page contact
     * @param Blog $blog
     * @return SEOData
     */
    public function seoBlogShow(Blog $blog): SEOData
    {
        return match(app()->getLocale()){
            'fr' => new SEOData(
                title : $blog->translate->meta_title,
                description: Str::limit($blog->translate->meta_desc, limit: 170, end:'.'),
                author: $blog->user->fullname,
                image:asset('storage/blog/'.$blog->image),
                schema: SchemaCollection::make()
                    ->add(fn (SEOData $SEOData) => [
                        '@context' => 'https://schema.org',
                        '@type' => 'NewsArticle',
                        'headline' => $blog->translate->meta_title,
                        'image' => [ asset('storage/blog/'.$blog->image)],
                        'datePublished' => $blog->created_at->format('Y-m-dTh:m'),
                        'dateModified' => $blog->updated_at->format('Y-m-dTh:m'),
                        'author' => [
                            '@type' => 'Person',
                            'name' => $blog->user->fullname,
                            'url' => $blog->user->linkedin_profile_url
                        ]
                    ]),
                alternates:[
                    new AlternateTag(
                        hreflang:'x-default',
                        href:route('blog.show', ['locale' => 'fr', 'slug' => Str::slug($blog->translates->where('locale', 'fr')->first()->title), 'blog' => $blog]),
                    ),
                    new AlternateTag(
                        hreflang:'en',
                        href:route('blog.show', ['locale' => 'en', 'slug' => Str::slug($blog->translates->where('locale', 'en')->first()->title), 'blog' => $blog]),
                    ),
                    new AlternateTag(
                        hreflang:'fr',
                        href:route('blog.show', ['locale' => 'fr', 'slug' => Str::slug($blog->translates->where('locale', 'fr')->first()->title), 'blog' => $blog]),
                    ),
                    new AlternateTag(
                        hreflang:'de',
                        href:route('blog.show', ['locale' => 'de', 'slug' => Str::slug($blog->translates->where('locale', 'de')->first()->title), 'blog' => $blog]),
                    ),
                ],
            ),
            'en' => new SEOData(
                title : $blog->translate->meta_title,
                description: Str::limit($blog->translate->meta_desc, limit: 170, end:'.'),
                author: $blog->user->fullname,
                image:asset('storage/blog/'.$blog->image),
                schema: SchemaCollection::make()
                    ->add(fn (SEOData $SEOData) => [
                        '@context' => 'https://schema.org',
                        '@type' => 'NewsArticle',
                        'headline' => $blog->translate->meta_title,
                        'image' => [ asset('storage/blog/'.$blog->image)],
                        'datePublished' => $blog->created_at->format('Y-m-dTh:m'),
                        'dateModified' => $blog->updated_at->format('Y-m-dTh:m'),
                        'author' => [
                            '@type' => 'Person',
                            'name' => $blog->user->fullname,
                            'url' => $blog->user->linkedin_profile_url
                        ]
                    ]),
                alternates:[
                    new AlternateTag(
                        hreflang:'x-default',
                        href:route('blog.show', ['locale' => 'fr', 'slug' => Str::slug($blog->translates->where('locale', 'fr')->first()->title), 'blog' => $blog]),
                    ),
                    new AlternateTag(
                        hreflang:'en',
                        href:route('blog.show', ['locale' => 'en', 'slug' => Str::slug($blog->translates->where('locale', 'en')->first()->title), 'blog' => $blog]),
                    ),
                    new AlternateTag(
                        hreflang:'fr',
                        href:route('blog.show', ['locale' => 'fr', 'slug' => Str::slug($blog->translates->where('locale', 'fr')->first()->title), 'blog' => $blog]),
                    ),
                    new AlternateTag(
                        hreflang:'de',
                        href:route('blog.show', ['locale' => 'de', 'slug' => Str::slug($blog->translates->where('locale', 'de')->first()->title), 'blog' => $blog]),
                    ),
                ],
            ),
            'de' => new SEOData(
                title : $blog->translate->meta_title,
                description: Str::limit($blog->translate->meta_desc, limit: 170, end:'.'),
                author: $blog->user->fullname,
                image:asset('storage/blog/'.$blog->image),
                schema: SchemaCollection::make()
                    ->add(fn (SEOData $SEOData) => [
                        '@context' => 'https://schema.org',
                        '@type' => 'NewsArticle',
                        'headline' => $blog->translate->meta_title,
                        'image' => [ asset('storage/blog/'.$blog->image)],
                        'datePublished' => $blog->created_at->format('Y-m-dTh:m'),
                        'dateModified' => $blog->updated_at->format('Y-m-dTh:m'),
                        'author' => [
                            '@type' => 'Person',
                            'name' => $blog->user->fullname,
                            'url' => $blog->user->linkedin_profile_url
                        ]
                    ]),
                alternates:[
                    new AlternateTag(
                        hreflang:'x-default',
                        href:route('blog.show', ['locale' => 'fr', 'slug' => Str::slug($blog->translates->where('locale', 'fr')->first()->title), 'blog' => $blog]),
                    ),
                    new AlternateTag(
                        hreflang:'en',
                        href:route('blog.show', ['locale' => 'en', 'slug' => Str::slug($blog->translates->where('locale', 'en')->first()->title), 'blog' => $blog]),
                    ),
                    new AlternateTag(
                        hreflang:'fr',
                        href:route('blog.show', ['locale' => 'fr', 'slug' => Str::slug($blog->translates->where('locale', 'fr')->first()->title), 'blog' => $blog]),
                    ),
                    new AlternateTag(
                        hreflang:'de',
                        href:route('blog.show', ['locale' => 'de', 'slug' => Str::slug($blog->translates->where('locale', 'de')->first()->title), 'blog' => $blog]),
                    ),
                ],
            ),
        };
    }

    /**
     * Retourne le seo de la page listing de propriété viticole
     * @return SEOData
     */
    public function seoProperties(): SEOData
    {
        return match(app()->getLocale()){
            'fr' => new SEOData(
                title :"Vignobles, Propriétés et Domaines Viticoles à Vendre 🏰🍇",
                description:"Découvrez une sélection exclusive de vignobles et domaines viticoles à vendre. Investissez dans l'excellence avec Michaël Zingraf Vineyards",
                image:asset('/images/contact-michael-zingraf-vineyards.webp'),
                alternates:[
                    new AlternateTag(
                        hreflang:'x-default',
                        href:url( '/fr/'.trans('routes.properties', locale:'fr')),
                    ),
                    new AlternateTag(
                        hreflang:'en',
                        href:url( '/en/'.trans('routes.properties', locale:'en')),
                    ),
                    new AlternateTag(
                        hreflang:'fr',
                        href:url( '/fr/'.trans('routes.properties', locale:'fr')),
                    ),
                    new AlternateTag(
                        hreflang:'de',
                        href:url( '/de/'.trans('routes.properties', locale:'de')),
                    ),
                ]
            ),
            'en' => new SEOData(
                title :"Vineyards, estates and wineries for sale 🏰🍇",
                description:"Discover an exclusive selection of vineyards and wineries for sale. Invest in excellence with Michaël Zingraf Vineyards",
                image:asset('/images/contact-michael-zingraf-vineyards.webp'),
                alternates:[
                    new AlternateTag(
                        hreflang:'x-default',
                        href:url( '/fr/'.trans('routes.properties', locale:'fr')),
                    ),
                    new AlternateTag(
                        hreflang:'en',
                        href:url( '/en/'.trans('routes.properties', locale:'en')),
                    ),
                    new AlternateTag(
                        hreflang:'fr',
                        href:url( '/fr/'.trans('routes.properties', locale:'fr')),
                    ),
                    new AlternateTag(
                        hreflang:'de',
                        href:url( '/de/'.trans('routes.properties', locale:'de')),
                    ),
                ]
            ),
            'de' => new SEOData(
                title :"Weinberge, Anwesen und Weingüter zum Verkauf 🏰🍇",
                description:"Entdecken Sie eine exklusive Auswahl an Weinbergen und Weingütern, die zum Verkauf stehen. Investieren Sie in Exzellenz mit Michaël Zingraf Vineyards",
                image:asset('/images/contact-michael-zingraf-vineyards.webp'),
                alternates:[
                    new AlternateTag(
                        hreflang:'x-default',
                        href:url( '/fr/'.trans('routes.properties', locale:'fr')),
                    ),
                    new AlternateTag(
                        hreflang:'en',
                        href:url( '/en/'.trans('routes.properties', locale:'en')),
                    ),
                    new AlternateTag(
                        hreflang:'fr',
                        href:url( '/fr/'.trans('routes.properties', locale:'fr')),
                    ),
                    new AlternateTag(
                        hreflang:'de',
                        href:url( '/de/'.trans('routes.properties', locale:'de')),
                    ),
                ]
            ),
        };
    }

    /**
     * Retourne le seo de la page detail de propriété
     * @param Property $property
     * @return SEOData
     */
    public function seoPropertyShow(Property $property): SEOData
    {

        return match(app()->getLocale()){
            'fr' => new SEOData(
                title : $property->category()->where('locale', 'fr')->first()->name.' '. $property->subtype()->where('locale', 'fr')->first()->name .' '.$property->region->name. ' '.$property->city->name,
                description: Str::limit($property->comments()->where('locale', 'fr')->first()->comment, limit: 170, end:'.'),
                author: $property->user->fullname,
                image:asset('storage/properties/'.$property->picture->name),
                schema: SchemaCollection::make()
                    ->add(fn (SEOData $SEOData) => [
                        // You could use the `$SEOData` to dynamically
                        // fetch any data about the current page.
                        '@context' => 'https://schema.org',
                        '@type' => 'Product',
                        'name' => $property->category()->where('locale', 'fr')->first()->name. ' '. $property->subtype()->where('locale', 'fr')->first()->name,
                        'image' => [  ],
                        'mainEntity' => [
                            '@type' => 'Question',
                            'name' => 'Your question goes here',
                            'acceptedAnswer' => [
                                '@type' => 'Answer',
                                'text' => 'Your answer goes here',
                            ],
                        ],
                    ]),
                alternates:[
                    new AlternateTag(
                        hreflang:'x-default',
                        href:route('properties.show', ['locale' => 'fr', 'slug' => Str::slug($property->comments()->where('locale', 'fr')->first()->title), 'property' => $property]),
                    ),
                    new AlternateTag(
                        hreflang:'en',
                        href:route('properties.show', ['locale' => 'en', 'slug' => Str::slug($property->comments()->where('locale', 'en')->first()->title), 'property' => $property]),
                    ),
                    new AlternateTag(
                        hreflang:'fr',
                        href:route('properties.show', ['locale' => 'fr', 'slug' => Str::slug($property->comments()->where('locale', 'fr')->first()->title), 'property' => $property]),
                    ),
                    new AlternateTag(
                        hreflang:'de',
                        href:route('properties.show', ['locale' => 'de', 'slug' => Str::slug($property->comments()->where('locale', 'de')->first()->title), 'property' => $property]),
                    ),
                ],
            ),
            'en' => new SEOData(
                title : $property->category()->where('locale', 'en')->first()->name.' '. $property->subtype()->where('locale', 'en')->first()->name .' '.$property->region->name. ' '.$property->city->name,
                description: Str::limit($property->comments()->where('locale', 'en')->first()->comment, limit: 170, end:'.'),
                author: $property->user->fullname,
                image:asset('storage/properties/'.$property->picture->name),
                alternates:[
                    new AlternateTag(
                        hreflang:'x-default',
                        href:route('properties.show', ['locale' => 'fr', 'slug' => Str::slug($property->comments()->where('locale', 'fr')->first()->title), 'property' => $property]),
                    ),
                    new AlternateTag(
                        hreflang:'en',
                        href:route('properties.show', ['locale' => 'en', 'slug' => Str::slug($property->comments()->where('locale', 'en')->first()->title), 'property' => $property]),
                    ),
                    new AlternateTag(
                        hreflang:'fr',
                        href:route('properties.show', ['locale' => 'fr', 'slug' => Str::slug($property->comments()->where('locale', 'fr')->first()->title), 'property' => $property]),
                    ),
                    new AlternateTag(
                        hreflang:'de',
                        href:route('properties.show', ['locale' => 'de', 'slug' => Str::slug($property->comments()->where('locale', 'de')->first()->title), 'property' => $property]),
                    ),
                ],
            ),
            'de' => new SEOData(
                title : $property->category()->where('locale', 'de')->first()->name.' '. $property->subtype()->where('locale', 'de')->first()->name .' '.$property->region->name. ' '.$property->city->name,
                description: Str::limit($property->comments()->where('locale', 'de')->first()->comment, limit: 170, end:'.'),
                author: $property->user->fullname,
                image:asset('storage/properties/'.$property->picture->name),
                alternates:[
                    new AlternateTag(
                        hreflang:'x-default',
                        href:route('properties.show', ['locale' => 'fr', 'slug' => Str::slug($property->comments()->where('locale', 'fr')->first()->title), 'property' => $property]),
                    ),
                    new AlternateTag(
                        hreflang:'en',
                        href:route('properties.show', ['locale' => 'en', 'slug' => Str::slug($property->comments()->where('locale', 'en')->first()->title), 'property' => $property]),
                    ),
                    new AlternateTag(
                        hreflang:'fr',
                        href:route('properties.show', ['locale' => 'fr', 'slug' => Str::slug($property->comments()->where('locale', 'fr')->first()->title), 'property' => $property]),
                    ),
                    new AlternateTag(
                        hreflang:'de',
                        href:route('properties.show', ['locale' => 'de', 'slug' => Str::slug($property->comments()->where('locale', 'de')->first()->title), 'property' => $property]),
                    ),
                ],
            ),
        };
    }

    /**
     * Retourne le seo de la page listing de propriété viticole
     * @param ListeSeo $listeSeo
     * @return SEOData
     */
    public function seoListeSeo(ListeSeo $listeSeo): SEOData
    {
        return match(app()->getLocale()){
            'fr' => new SEOData(
                title :$listeSeo->translate->meta_title_seo,
                description:$listeSeo->translate->meta_description_seo,
                image:asset('/images/contact-michael-zingraf-vineyards.webp'),
                alternates:[
                    new AlternateTag(
                        hreflang:'x-default',
                        href:route('properties.region', ['locale' => 'fr', 'listeseo' => $listeSeo, 'slug' => $listeSeo->slug]),
                    ),
                    new AlternateTag(
                        hreflang:'en',
                        href:route('properties.region', ['locale' => 'en', 'listeseo' => $listeSeo, 'slug' => $listeSeo->slug]),
                    ),
                    new AlternateTag(
                        hreflang:'fr',
                        href:route('properties.region', ['locale' => 'fr', 'listeseo' => $listeSeo, 'slug' => $listeSeo->slug]),
                    ),
                    new AlternateTag(
                        hreflang:'de',
                        href:route('properties.region', ['locale' => 'de', 'listeseo' => $listeSeo, 'slug' => $listeSeo->slug]),
                    ),
                ]
            ),
            'en' => new SEOData(
                title :$listeSeo->translate->meta_title_seo,
                description:$listeSeo->translate->meta_description_seo,
                image:asset('/images/contact-michael-zingraf-vineyards.webp'),
                alternates:[
                    new AlternateTag(
                        hreflang:'x-default',
                        href:route('properties.region', ['locale' => 'fr', 'listeseo' => $listeSeo, 'slug' => $listeSeo->slug]),
                    ),
                    new AlternateTag(
                        hreflang:'en',
                        href:route('properties.region', ['locale' => 'en', 'listeseo' => $listeSeo, 'slug' => $listeSeo->slug]),
                    ),
                    new AlternateTag(
                        hreflang:'fr',
                        href:route('properties.region', ['locale' => 'fr', 'listeseo' => $listeSeo, 'slug' => $listeSeo->slug]),
                    ),
                    new AlternateTag(
                        hreflang:'de',
                        href:route('properties.region', ['locale' => 'de', 'listeseo' => $listeSeo, 'slug' => $listeSeo->slug]),
                    ),
                ]
            ),
            'de' => new SEOData(
                title :$listeSeo->translate->meta_title_seo,
                description:$listeSeo->translate->meta_description_seo,
                image:asset('/images/contact-michael-zingraf-vineyards.webp'),
                alternates:[
                    new AlternateTag(
                        hreflang:'x-default',
                        href:route('properties.region', ['locale' => 'fr', 'listeseo' => $listeSeo, 'slug' => $listeSeo->slug]),
                    ),
                    new AlternateTag(
                        hreflang:'en',
                        href:route('properties.region', ['locale' => 'en', 'listeseo' => $listeSeo, 'slug' => $listeSeo->slug]),
                    ),
                    new AlternateTag(
                        hreflang:'fr',
                        href:route('properties.region', ['locale' => 'fr', 'listeseo' => $listeSeo, 'slug' => $listeSeo->slug]),
                    ),
                    new AlternateTag(
                        hreflang:'de',
                        href:route('properties.region', ['locale' => 'de', 'listeseo' => $listeSeo, 'slug' => $listeSeo->slug]),
                    ),
                ]
            ),
        };
    }
}
