<?php

/*
|--------------------------------------------------------------------------
| Industry landing pages
|--------------------------------------------------------------------------
|
| Each entry creates a point-of-sale landing page at /{slug}, adds it to the
| navigation, footer, homepage, sitemap and the prerender list, and redirects
| every "legacy" path to the new slug.
|
| - "component": set to an existing Vue page to keep its custom design.
|   Leave it null to use the shared template (resources/js/Pages/Landing/IndustryPage.vue).
| - "media": image and YouTube video ID. Null shows a placeholder box instead.
|
*/

return [

    'cosmetics' => [
        'label' => 'Cosmetics',
        'summary' => 'Track lipsticks, foundations, and beauty products by shade and expiry',
        'name' => 'Point of Sale System for Cosmetics Shop in Kenya',
        'cover' => null,
        'about' => 'WabePoint is a point of sale system for cosmetics and beauty shops in Kenya. Track every product by shade, colour, and expiry date, so you know which lipsticks, foundations, and skincare lines are selling and which are close to expiring. Take M-Pesa and cash, record credit sales, and see your daily profit from one till, even when the internet is down.',
        'search_terms' => ['cosmetics POS Kenya', 'beauty shop POS Kenya', 'salon point of sale Kenya', 'cosmetics inventory software Kenya', 'shade and expiry tracking', 'M-Pesa beauty shop payments'],
        'slug' => 'pos-system-cosmetics-kenya',
        'icon' => 'sparkles',
        'priority' => '0.8',
        'component' => 'Landing/CosmeticsPOS',
        'legacy' => ['/cosmetics'],
        'seo' => [
            'title' => 'Point of Sale System for Cosmetics Shop in Kenya | WabePoint',
            'description' => 'WabePoint is a point of sale system for cosmetics and beauty shops in Kenya. Track products by shade, colour, and expiry date, manage stock, handle M-Pesa and cash, and see daily profit.',
            'keywords' => 'point of sale system for cosmetics shop in kenya, cosmetics pos kenya, beauty shop pos kenya, cosmetics inventory software, salon point of sale kenya, mpesa cosmetics payments',
        ],
        'media' => ['image' => null, 'video' => null],
    ],

    'hardware' => [
        'label' => 'Hardware',
        'summary' => 'Manage nails, paints, cement, and bulk stock with variant pricing',
        'name' => 'Point of Sale System for Hardware Store in Kenya',
        'cover' => null,
        'about' => 'WabePoint is a point of sale system for hardware stores in Kenya. Manage bulk and piece-count stock, set variant prices for sizes and grades, and track nails, paints, cement, and fittings in one place. Record credit sales for contractors and regular customers, and see your daily profit.',
        'search_terms' => ['hardware store POS Kenya', 'hardware shop inventory software Kenya', 'building materials POS Kenya', 'construction store management Nairobi', 'variant pricing hardware', 'M-Pesa hardware payments'],
        'slug' => 'pos-system-hardware-kenya',
        'icon' => 'wrench',
        'priority' => '0.8',
        'component' => 'Landing/HardwarePOS',
        'legacy' => ['/hardware'],
        'seo' => [
            'title' => 'Point of Sale System for Hardware Store in Kenya | WabePoint',
            'description' => 'WabePoint is a point of sale system for hardware stores in Kenya. Manage bulk stock, variant pricing, credit sales, M-Pesa and cash payments, and see daily profit.',
            'keywords' => 'point of sale system for hardware store in kenya, hardware store pos kenya, hardware shop inventory software, building materials pos kenya, hardware stock management nairobi',
        ],
        'media' => ['image' => null, 'video' => null],
    ],

    'paintshop' => [
        'label' => 'Paint Shops',
        'summary' => 'Handle paint fractions, colour mixing, and litre-by-litre tracking',
        'name' => 'Point of Sale System for Paint Shop in Kenya',
        'cover' => '/assets/images/Carousel/IMG_4701.jpg',
        'about' => 'WabePoint is a point of sale system for paint shops in Kenya. Track paint by litre and fraction, see stock drop with every sale, and reconcile M-Pesa and cash at the end of the day. Record credit sales against each customer and collect balances on their next visit. Setup takes under one hour.',
        'search_terms' => ['paint shop POS Kenya', 'paint shop management system Kenya', 'paint inventory software Nairobi', 'paint fractions tracking', 'M-Pesa paint shop payments', 'paint stock management Mombasa'],
        'slug' => 'pos-system-paintshop-kenya',
        'icon' => 'paint',
        'priority' => '0.9',
        'component' => 'Landing/PaintShopPOS',
        'legacy' => ['/paintshops'],
        'seo' => [
            'title' => 'Point of Sale System for Paint Shop in Kenya | WabePoint',
            'description' => 'WabePoint is a point of sale system for paint shops in Kenya. Track paint stock by litre and fraction, handle M-Pesa and cash, record credit sales, and see daily profit. Works offline. Setup in under 1 hour.',
            'keywords' => 'point of sale system for paint shop in kenya, paint shop pos kenya, paint shop management system kenya, paint inventory software kenya, pos for paint shops nairobi, mpesa pos paint shop, paint shop stock management',
        ],
        'media' => ['image' => null, 'video' => 'qLcgaR0e4eU'],
    ],

    'restaurant' => [
        'label' => 'Restaurants',
        'summary' => 'Menu management, table orders, and kitchen receipt printing',
        'name' => 'Point of Sale System for Restaurant in Kenya',
        'cover' => null,
        'about' => 'WabePoint is a point of sale system for restaurants and cafes in Kenya. Manage your menu and prices, take table orders, split bills, and send orders to the kitchen for printing. Take M-Pesa and cash, and get daily sales reports from any device.',
        'search_terms' => ['restaurant POS Kenya', 'cafe point of sale Kenya', 'restaurant management system Nairobi', 'kitchen order printing', 'table order POS', 'M-Pesa restaurant payments'],
        'slug' => 'pos-system-restaurant-kenya',
        'icon' => 'food',
        'priority' => '0.8',
        'component' => 'Landing/RestaurantsPOS',
        'legacy' => ['/restaurants'],
        'seo' => [
            'title' => 'Point of Sale System for Restaurant in Kenya | WabePoint',
            'description' => 'WabePoint is a point of sale system for restaurants in Kenya. Menu management, table orders, kitchen receipt printing, M-Pesa and cash payments, and daily sales reports.',
            'keywords' => 'point of sale system for restaurant in kenya, restaurant pos kenya, restaurant management system nairobi, kitchen pos kenya, mpesa restaurant payments, cafe point of sale kenya',
        ],
        'media' => ['image' => null, 'video' => null],
    ],

    'gas' => [
        'label' => 'Gas & LPG',
        'summary' => 'Track cylinder stock, refills, and deposits for gas retailers',
        'name' => 'Point of Sale System for Gas and LPG in Kenya',
        'cover' => null,
        'about' => 'WabePoint is a point of sale system for gas and LPG shops in Kenya. Track cylinder stock, deposits, and refills, settle deposits when cylinders are returned, and take M-Pesa and cash on the same sale. Record credit sales for businesses you supply on account, and see your daily profit. It works offline.',
        'search_terms' => ['LPG POS Kenya', 'gas shop POS Kenya', 'LPG cylinder tracking system', 'gas refill software', 'cylinder deposit management', 'M-Pesa gas payments'],
        'slug' => 'pos-system-lpg-gas-kenya',
        'icon' => 'flame',
        'priority' => '0.9',
        'component' => 'Landing/GasPOS',
        'legacy' => ['/gas'],
        'seo' => [
            'title' => 'Point of Sale System for Gas and LPG in Kenya | WabePoint',
            'description' => 'WabePoint is a point of sale system for gas and LPG shops in Kenya. Track cylinder stock and deposits, manage refills, take M-Pesa and cash, record credit sales, and see daily profit. Works offline. Setup in under 1 hour.',
            'keywords' => 'point of sale system for gas and lpg in kenya, lpg pos kenya, gas shop pos kenya, lpg cylinder tracking system, gas refill software, gas outlet management kenya, mpesa gas payments',
        ],
        'media' => ['image' => null, 'video' => null],
    ],

    'office' => [
        'label' => 'Offices',
        'summary' => 'Professional invoice generation, PO tracking, and expense recording',
        'name' => 'Point of Sale System for Office in Kenya',
        'cover' => null,
        'about' => 'WabePoint helps Kenyan offices issue professional invoices, track purchase orders and expenses, and reconcile payments. It includes KRA eTIMS integration, so invoices can meet tax compliance requirements. Track which invoices are paid, pending, or overdue, with profit and loss reports.',
        'search_terms' => ['invoicing software Kenya', 'eTIMS invoicing Kenya', 'office invoice system Nairobi', 'expense tracking software Kenya', 'purchase order tracking Kenya', 'KRA eTIMS integration'],
        'slug' => 'pos-system-office-kenya',
        'icon' => 'doc',
        'priority' => '0.8',
        'component' => 'Landing/OfficesPOS',
        'legacy' => ['/offices'],
        'seo' => [
            'title' => 'Point of Sale System for Office in Kenya | WabePoint',
            'description' => 'WabePoint is a point of sale system for offices in Kenya. Generate professional invoices, connect to KRA eTIMS, track purchase orders and expenses, and reconcile payments.',
            'keywords' => 'point of sale system for office in kenya, office invoice software kenya, invoicing system nairobi, etims invoicing kenya, expense tracking software kenya, purchase order tracking kenya',
        ],
        'media' => ['image' => null, 'video' => null],
    ],

    'fashion' => [
        'label' => 'Fashion & Boutiques',
        'summary' => 'Track every size and colour, with M-Pesa, credit sales, and daily profit',
        'cover' => null,
        'about' => 'WabePoint is a point of sale system for clothing and boutique shops in Kenya. Track every size and colour with its own stock level and price, see what sold each day, take M-Pesa and cash, and record credit sales for regular customers. It works offline.',
        'search_terms' => ['boutique POS Kenya', 'clothing store POS Kenya', 'fashion shop point of sale Kenya', 'size and colour inventory Kenya', 'boutique stock management Nairobi', 'M-Pesa boutique payments'],
        'slug' => 'pos-system-boutique-fashion-kenya',
        'icon' => 'shirt',
        'priority' => '0.8',
        'component' => null,
        'legacy' => [],
        'seo' => [
            'title' => 'Point of Sale System for Fashion and Boutique Stores in Kenya | WabePoint',
            'description' => 'WabePoint is a point of sale system for clothing and boutique shops in Kenya. Track stock by size and colour, take M-Pesa and cash, record credit sales, and see daily profit. Works offline.',
            'keywords' => 'point of sale system for boutique in kenya, fashion boutique pos kenya, clothing store pos kenya, clothes shop inventory software, boutique stock management nairobi, size and colour inventory kenya, mpesa boutique payments',
        ],
        'name' => 'Point of Sale System for Fashion and Boutique Stores in Kenya',
        'eyebrow' => 'Built for Fashion and Boutique Shops',
        'headline' => ['KNOW WHAT SOLD', 'IN EVERY SIZE', '& COLOUR'],
        'lead' => 'A point of sale system for clothing and boutique shops. Track every size and colour, take M-Pesa and cash, record credit sales, and see daily profit from one till.',
        'problems' => [
            ['title' => 'Sizes Running Out Unnoticed', 'desc' => 'You only find out a size is gone when a customer asks for it'],
            ['title' => 'Stock Counts Do Not Match', 'desc' => 'Garments go missing and nobody can tell when or where'],
            ['title' => 'Credit Customers Forgotten', 'desc' => 'Regulars take items on account and the balance is never collected'],
        ],
        'solutions' => [
            ['title' => 'Stock by Size and Colour', 'desc' => 'Every size and colour is tracked separately with its own price'],
            ['title' => 'Stock Drops With Each Sale', 'desc' => 'Stock levels update automatically at the till'],
            ['title' => 'Credit Sales Tracked', 'desc' => 'See who owes what and collect the balance on their next visit'],
        ],
        'faqs' => [
            ['question' => 'Can I track stock by size and colour?', 'answer' => 'Yes. Create a variant for each size and colour. Stock and price are tracked separately for every variant, so you always know which sizes are running low.'],
            ['question' => 'Can I see which sizes sell best?', 'answer' => 'Yes. Sales reports show what sold each day, so you can reorder the sizes and colours that move fastest.'],
            ['question' => 'Does stock go down automatically when an item is sold?', 'answer' => 'Yes. Each sale reduces the stock of that exact size and colour, so your records match the shelves.'],
            ['question' => 'Can I track M-Pesa and cash separately?', 'answer' => 'Yes. Each payment method is tracked independently, so you can reconcile in seconds at the end of the day.'],
            ['question' => 'Can regular customers buy on credit?', 'answer' => 'Yes. Record credit sales against each customer and track what they owe until it is paid.'],
            ['question' => 'Does it work without internet?', 'answer' => 'Yes. Sales are recorded locally and sync automatically when the internet returns, so your boutique keeps trading.'],
            ['question' => 'How much does it cost?', 'answer' => 'Pricing starts at KES 2,000 per month with a KES 20,000 one-time setup. Message us on WhatsApp for a demo and a quote for your shop.'],
        ],
        'media' => ['image' => null, 'video' => null],
    ],

];
