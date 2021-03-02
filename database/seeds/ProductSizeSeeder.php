<?php

use Illuminate\Database\Seeder;
use App\Models\ProductSize;
use App\Models\Category;

class ProductSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


         // Start ProductSize
         $size = ProductSize::create([
            'name' => 'XXXS',
            'order' => 1,
            
        ]);

        $size->categories()->saveMany([
            Category::find(80), // * El número debe ser el ID de la categoría que se vincula a esta talla
            Category::find(81),
            Category::find(82),
            Category::find(83),
            Category::find(84),
            Category::find(85),
            Category::find(86),
            Category::find(87),
            Category::find(88),
        ]);
        // End ProductSize
        
        // Start ProductSize
        $size = ProductSize::create([
            'name' => 'XXS',
            'order' => 1
        ]);

        $size->categories()->saveMany([
            Category::find(12),
            Category::find(80), // * El número debe ser el ID de la categoría que se vincula a esta talla
            Category::find(81),
            Category::find(82),
            Category::find(83),
            Category::find(84),
            Category::find(85),
            Category::find(86),
            Category::find(87),
            Category::find(88),
            Category::find(89),
            Category::find(90),
            Category::find(91),
            Category::find(92),
            Category::find(93),
            Category::find(102),
            Category::find(103),
            Category::find(104),
            Category::find(105),
            Category::find(106),
            Category::find(107),
            Category::find(108),
            Category::find(101),
            Category::find(128),
            Category::find(119),
            Category::find(120),
            Category::find(121),
            Category::find(122),
            Category::find(123),
            Category::find(126),
            Category::find(166),
            Category::find(167),
            Category::find(168),
            Category::find(169),
            Category::find(170),
            Category::find(171),
            Category::find(172),
            Category::find(173),
            Category::find(174),
            Category::find(175),
            Category::find(176),
            Category::find(183),
            Category::find(184),
            Category::find(185),
        ]);
        // End ProductSize


        // Start ProductSize
        $size = ProductSize::create([
            'name' => 'XS',
            'order' => 1
        ]);

        $size->categories()->saveMany([
            Category::find(12),
            Category::find(67),
            Category::find(68),
            Category::find(69),
            Category::find(70),
            Category::find(71),
            Category::find(73),
            Category::find(80), // * El número debe ser el ID de la categoría que se vincula a esta talla
            Category::find(81),
            Category::find(82),
            Category::find(83),
            Category::find(84),
            Category::find(85),
            Category::find(86),
            Category::find(87),
            Category::find(88),
            Category::find(89),
            Category::find(90),
            Category::find(91),
            Category::find(92),
            Category::find(93),
            Category::find(102),
            Category::find(103),
            Category::find(104),
            Category::find(105),
            Category::find(106),
            Category::find(107),
            Category::find(108),
            Category::find(101),
            Category::find(128),
            Category::find(119),
            Category::find(120),
            Category::find(121),
            Category::find(122),
            Category::find(123),
            Category::find(124),
            Category::find(125),
            Category::find(126),
            Category::find(166),
            Category::find(167),
            Category::find(168),
            Category::find(169),
            Category::find(170),
            Category::find(171),
            Category::find(172),
            Category::find(173),
            Category::find(174),
            Category::find(175),
            Category::find(176),
            Category::find(183),
            Category::find(184),
            Category::find(185),
            Category::find(256),
            Category::find(318),
            Category::find(342),
            Category::find(343),
            Category::find(67),
        ]);
        // End ProductSize


        // Start ProductSize
        $size = ProductSize::create([
            'name' => 'S',
            'order' => 1
        ]);

        $size->categories()->saveMany([
            Category::find(12),
            Category::find(67),
            Category::find(68),
            Category::find(69),
            Category::find(70),
            Category::find(71),
            Category::find(73),
            Category::find(80), // * El número debe ser el ID de la categoría que se vincula a esta talla
            Category::find(81),
            Category::find(82),
            Category::find(83),
            Category::find(84),
            Category::find(85),
            Category::find(86),
            Category::find(87),
            Category::find(88),
            Category::find(89),
            Category::find(90),
            Category::find(91),
            Category::find(92),
            Category::find(93),
            Category::find(102),
            Category::find(103),
            Category::find(104),
            Category::find(105),
            Category::find(106),
            Category::find(107),
            Category::find(108),
            Category::find(101),
            Category::find(128),
            Category::find(119),
            Category::find(120),
            Category::find(121),
            Category::find(122),
            Category::find(123),
            Category::find(124),
            Category::find(125),
            Category::find(126),
            Category::find(127),
            Category::find(132),
            Category::find(144),
            Category::find(166),
            Category::find(167),
            Category::find(168),
            Category::find(169),
            Category::find(170),
            Category::find(171),
            Category::find(172),
            Category::find(173),
            Category::find(174),
            Category::find(175),
            Category::find(176),
            Category::find(183),
            Category::find(184),
            Category::find(185),
            Category::find(192),
            Category::find(193),
            Category::find(194),
            Category::find(195),
            Category::find(196),
            Category::find(197),
            Category::find(198),
            Category::find(203), 
            Category::find(212),
            Category::find(256),
            Category::find(260),
            Category::find(261),
            Category::find(262),
            Category::find(273),
            Category::find(318),
            Category::find(321),
            Category::find(322),
            Category::find(323),
            Category::find(324),
            Category::find(333),
            Category::find(342),
            Category::find(343),
            Category::find(67),
        ]);
        // End ProductSize


        // Start ProductSize
        $size = ProductSize::create([
            'name' => 'M',
            'order' => 1
        ]);

        $size->categories()->saveMany([
            Category::find(12),
            Category::find(67),
            Category::find(68),
            Category::find(69),
            Category::find(70),
            Category::find(71),
            Category::find(73),
            Category::find(80), // * El número debe ser el ID de la categoría que se vincula a esta talla
            Category::find(81),
            Category::find(82),
            Category::find(83),
            Category::find(84),
            Category::find(85),
            Category::find(86),
            Category::find(87),
            Category::find(88),
            Category::find(89),
            Category::find(90),
            Category::find(91),
            Category::find(92),
            Category::find(93),
            Category::find(102),
            Category::find(103),
            Category::find(104),
            Category::find(106),
            Category::find(105),
            Category::find(107),
            Category::find(108),
            Category::find(101),
            Category::find(128),
            Category::find(119),
            Category::find(120),
            Category::find(121),
            Category::find(122),
            Category::find(123),
            Category::find(124),
            Category::find(125),
            Category::find(126),
            Category::find(127),
            Category::find(132),
            Category::find(144),
            Category::find(166),
            Category::find(167),
            Category::find(168),
            Category::find(169),
            Category::find(170),
            Category::find(171),
            Category::find(172),
            Category::find(173),
            Category::find(174),
            Category::find(175),
            Category::find(176),
            Category::find(183),
            Category::find(184),
            Category::find(185),
            Category::find(192),
            Category::find(193),
            Category::find(194),
            Category::find(195),
            Category::find(196),
            Category::find(197),
            Category::find(198),
            Category::find(203), 
            Category::find(212),
            Category::find(256),
            Category::find(260),
            Category::find(261),
            Category::find(262),
            Category::find(273),
            Category::find(318),
            Category::find(321),
            Category::find(322),
            Category::find(323),
            Category::find(324),
            Category::find(333),
            Category::find(342),
            Category::find(343),
            Category::find(67),
        ]);
        // End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => 'L',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(12),
    Category::find(67),
    Category::find(68),
    Category::find(69),
    Category::find(70),
    Category::find(71),
    Category::find(73),
    Category::find(80), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(81),
    Category::find(82),
    Category::find(83),
    Category::find(84),
    Category::find(85),
    Category::find(86),
    Category::find(87),
    Category::find(88),
    Category::find(89),
    Category::find(90),
    Category::find(91),
    Category::find(92),
    Category::find(93),
    Category::find(102),
    Category::find(103),
    Category::find(104),
    Category::find(105),
    Category::find(106),
    Category::find(107),
    Category::find(108),
    Category::find(101),
    Category::find(128),
    Category::find(119),
    Category::find(120),
    Category::find(121),
    Category::find(122),
    Category::find(123),
    Category::find(124),
    Category::find(125),
    Category::find(126),
    Category::find(127),
    Category::find(132),
    Category::find(144),
    Category::find(166),
    Category::find(167),
    Category::find(168),
    Category::find(169),
    Category::find(170),
    Category::find(171),
    Category::find(172),
    Category::find(173),
    Category::find(174),
    Category::find(175),
    Category::find(176),
    Category::find(183),
    Category::find(184),
    Category::find(185),
    Category::find(192),
    Category::find(193),
    Category::find(194),
    Category::find(195),
    Category::find(196),
    Category::find(197),
    Category::find(198),
    Category::find(203), 
    Category::find(212),
    Category::find(256),
    Category::find(260),
    Category::find(261),
    Category::find(273),
    Category::find(318),
    Category::find(321),
    Category::find(322),
    Category::find(333),
    Category::find(342),
    Category::find(343),
    Category::find(67),
]);
// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => 'XL',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(12),
    Category::find(67),
    Category::find(68),
    Category::find(69),
    Category::find(70),
    Category::find(71),
    Category::find(73),
    Category::find(80), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(81),
    Category::find(82),
    Category::find(83),
    Category::find(84),
    Category::find(85),
    Category::find(86),
    Category::find(87),
    Category::find(88),
    Category::find(89),
    Category::find(90),
    Category::find(91),
    Category::find(92),
    Category::find(93),
    Category::find(102),
    Category::find(103),
    Category::find(104),
    Category::find(105),
    Category::find(106),
    Category::find(107),
    Category::find(108),
    Category::find(101),
    Category::find(119),
    Category::find(128),
    Category::find(120),
    Category::find(121),
    Category::find(122),
    Category::find(123),
    Category::find(124),
    Category::find(125),
    Category::find(126),
    Category::find(127),
    Category::find(132),
    Category::find(144),
    Category::find(166),
    Category::find(167),
    Category::find(168),
    Category::find(169),
    Category::find(170),
    Category::find(171),
    Category::find(172),
    Category::find(173),
    Category::find(174),
    Category::find(175),
    Category::find(176),
    Category::find(183),
    Category::find(184),
    Category::find(185),
    Category::find(192),
    Category::find(193),
    Category::find(194),
    Category::find(195),
    Category::find(196),
    Category::find(197),
    Category::find(198),
    Category::find(203), 
    Category::find(212),
    Category::find(342),
    Category::find(343),
    Category::find(67),
]);
// End ProductSize


// Start ProductSize
$size = ProductSize::create([
    'name' => 'XXL',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(12),
    Category::find(67),
    Category::find(68),
    Category::find(69),
    Category::find(70),
    Category::find(71),
    Category::find(73),
    Category::find(80), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(81),
    Category::find(82),
    Category::find(83),
    Category::find(84),
    Category::find(85),
    Category::find(86),
    Category::find(87),
    Category::find(88),
    Category::find(89),
    Category::find(90),
    Category::find(91),
    Category::find(92),
    Category::find(93),
    Category::find(102),
    Category::find(103),
    Category::find(104),
    Category::find(105),
    Category::find(106),
    Category::find(107),
    Category::find(108),
    Category::find(101),
    Category::find(128),
    Category::find(119),
    Category::find(120),
    Category::find(121),
    Category::find(122),
    Category::find(123),
    Category::find(124),
    Category::find(125),
    Category::find(126),
    Category::find(144),
    Category::find(166),
    Category::find(167),
    Category::find(168),
    Category::find(169),
    Category::find(170),
    Category::find(171),
    Category::find(172),
    Category::find(173),
    Category::find(174),
    Category::find(175),
    Category::find(176),
    Category::find(183),
    Category::find(184),
    Category::find(185),
    Category::find(192),
    Category::find(193),
    Category::find(194),
    Category::find(195),
    Category::find(196),
    Category::find(198),
    Category::find(212),
    Category::find(342),
    Category::find(343),
    Category::find(67),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '3XL',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(119),
    Category::find(67),
    Category::find(68),
    Category::find(69),
    Category::find(70),
    Category::find(71),
    Category::find(73),
    Category::find(80),
    Category::find(81),
    Category::find(82),
    Category::find(83),
    Category::find(84),
    Category::find(85),
    Category::find(86),
    Category::find(87),
    Category::find(88),
    Category::find(89),
    Category::find(90),
    Category::find(91),
    Category::find(92),
    Category::find(93),
    Category::find(101),
    Category::find(102),
    Category::find(103),
    Category::find(104),
    Category::find(105),
    Category::find(106),
    Category::find(107),
    Category::find(108),
    Category::find(120), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(121),
    Category::find(122),
    Category::find(123),
    Category::find(124),
    Category::find(125),
    Category::find(126),
    Category::find(166),
    Category::find(167),
    Category::find(168),
    Category::find(169),
    Category::find(170),
    Category::find(171),
    Category::find(172),
    Category::find(173),
    Category::find(174),
    Category::find(175),
    Category::find(176),
    Category::find(183),
    Category::find(184),
    Category::find(185),
    Category::find(196),
    Category::find(198),
    Category::find(128),
    Category::find(192),
    Category::find(193),
    Category::find(194),
    Category::find(195),
    Category::find(196),
    Category::find(198),
    Category::find(342),
    Category::find(343),
    Category::find(67),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '4XL',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(119),
    Category::find(67),
    Category::find(68),
    Category::find(69),
    Category::find(70),
    Category::find(71),
    Category::find(73),
    Category::find(80),
    Category::find(81),
    Category::find(82),
    Category::find(83),
    Category::find(84),
    Category::find(85),
    Category::find(86),
    Category::find(87),
    Category::find(88),
    Category::find(89),
    Category::find(90),
    Category::find(91),
    Category::find(92),
    Category::find(93),
    Category::find(101),
    Category::find(102),
    Category::find(103),
    Category::find(104),
    Category::find(105),
    Category::find(106),
    Category::find(107),
    Category::find(108),
    Category::find(120), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(121),
    Category::find(122),
    Category::find(123),
    Category::find(124),
    Category::find(125),
    Category::find(126),
    Category::find(128),
    Category::find(166),
    Category::find(167),
    Category::find(168),
    Category::find(169),
    Category::find(170),
    Category::find(171),
    Category::find(172),
    Category::find(173),
    Category::find(174),
    Category::find(175),
    Category::find(176),
    Category::find(183),
    Category::find(184),
    Category::find(185),
    Category::find(196),
    Category::find(198),
    Category::find(192),
    Category::find(193),
    Category::find(194),
    Category::find(195),
    Category::find(196),
    Category::find(198),
    Category::find(342),
    Category::find(343),
    Category::find(67),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '5XL',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(67),
    Category::find(68),
    Category::find(69),
    Category::find(70),
    Category::find(71),
    Category::find(73),
    Category::find(342),
    Category::find(343), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(67),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '6XL',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(67),
    Category::find(68),
    Category::find(69),
    Category::find(70),
    Category::find(71),
    Category::find(73),
    Category::find(342),
    Category::find(343), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(67),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '7XL',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(67),
    Category::find(68),
    Category::find(69),
    Category::find(70),
    Category::find(71),
    Category::find(73),
    Category::find(342),
    Category::find(343), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(67),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => 'S/M',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(130), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(131),
    Category::find(200),
    Category::find(201),  
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => 'M/L',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(130), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(131),
    Category::find(200), 
    Category::find(201), 
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => 'L/XL',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(130), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(131),
    Category::find(200),
    Category::find(201),  
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '1',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(94), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(95),
    Category::find(96),
    Category::find(97),
    Category::find(98),
    Category::find(99),
    Category::find(100),
    
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '2',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(94), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(95),
    Category::find(96),
    Category::find(97),
    Category::find(98),
    Category::find(99),
    Category::find(100),
    Category::find(217),
    Category::find(218),
    Category::find(219),
    Category::find(220),
    Category::find(221),
    Category::find(222),
    Category::find(223),
    Category::find(224),
    Category::find(225),
    Category::find(226),
    Category::find(227),
    Category::find(228),
    Category::find(229),
    Category::find(230),
    Category::find(231),
    Category::find(232), 
    Category::find(233),
    Category::find(234),
    Category::find(235),
    Category::find(236),
    Category::find(237),
    Category::find(238),
    Category::find(239),
    Category::find(240), 
    Category::find(241),
    Category::find(242),
    Category::find(243),
    Category::find(244),
    Category::find(253),
    Category::find(254),
    Category::find(255),
    Category::find(257),
    Category::find(288),
    Category::find(289),
    Category::find(290),
    Category::find(291),
    Category::find(292),
    Category::find(293), 
    Category::find(294),
    Category::find(295),
    Category::find(296),
    Category::find(297),
    Category::find(298),
    Category::find(299),
    Category::find(300),
    Category::find(301), 
    Category::find(302),
    Category::find(303),
    Category::find(304),
    Category::find(305),
    Category::find(306),
    Category::find(307),
    Category::find(308),
    Category::find(315),
    Category::find(316),
    Category::find(317),
    Category::find(319),
           
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '3',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(217),
    Category::find(218),
    Category::find(219), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(220),
    Category::find(221),
    Category::find(222),
    Category::find(223),
    Category::find(224),
    Category::find(225),
    Category::find(226),
    Category::find(227),
    Category::find(228),
    Category::find(229),
    Category::find(230),
    Category::find(231),
    Category::find(232), 
    Category::find(233),
    Category::find(234),
    Category::find(235),
    Category::find(236),
    Category::find(237),
    Category::find(238),
    Category::find(239),
    Category::find(240), 
    Category::find(241),
    Category::find(242),
    Category::find(244),
    Category::find(288),
    Category::find(289),
    Category::find(290),
    Category::find(291),
    Category::find(292),
    Category::find(293), 
    Category::find(294),
    Category::find(295),
    Category::find(296),
    Category::find(297),
    Category::find(298),
    Category::find(299),
    Category::find(300),
    Category::find(301), 
    Category::find(302),
    Category::find(303),
    Category::find(304),
    Category::find(305),
    Category::find(306),
    Category::find(307),
    Category::find(308),
           
]);
// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '4',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(94), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(95),
    Category::find(96),
    Category::find(97),
    Category::find(98),
    Category::find(99),
    Category::find(100),
    Category::find(142),
    Category::find(211),
    Category::find(217),
    Category::find(218),
    Category::find(219),
    Category::find(220),
    Category::find(221),
    Category::find(222),
    Category::find(223),
    Category::find(224),
    Category::find(225),
    Category::find(226),
    Category::find(227),
    Category::find(228),
    Category::find(229),
    Category::find(230),
    Category::find(231),
    Category::find(232), 
    Category::find(233),
    Category::find(234),
    Category::find(235),
    Category::find(236),
    Category::find(237),
    Category::find(238),
    Category::find(239),
    Category::find(240), 
    Category::find(241),
    Category::find(242),
    Category::find(243),
    Category::find(244),
    Category::find(253),
    Category::find(254),
    Category::find(255),
    Category::find(257),
    Category::find(271),
    Category::find(288),
    Category::find(289),
    Category::find(290),
    Category::find(291),
    Category::find(292),
    Category::find(293), 
    Category::find(294),
    Category::find(295),
    Category::find(296),
    Category::find(297),
    Category::find(298),
    Category::find(299),
    Category::find(300),
    Category::find(301), 
    Category::find(302),
    Category::find(303),
    Category::find(304),
    Category::find(305),
    Category::find(306),
    Category::find(307),
    Category::find(308),
    Category::find(315),
    Category::find(316),
    Category::find(317),
    Category::find(319),
    Category::find(332),
          
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '5',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(142),
    Category::find(211),
    Category::find(217),
    Category::find(218),
    Category::find(219), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(220),
    Category::find(221),
    Category::find(222),
    Category::find(223),
    Category::find(224),
    Category::find(225),
    Category::find(226),
    Category::find(227),
    Category::find(228),
    Category::find(229),
    Category::find(230),
    Category::find(231),
    Category::find(232), 
    Category::find(233),
    Category::find(234),
    Category::find(235),
    Category::find(236),
    Category::find(237),
    Category::find(238),
    Category::find(239),
    Category::find(240), 
    Category::find(241),
    Category::find(242),
    Category::find(244),
    Category::find(271),
    Category::find(288),
    Category::find(289),
    Category::find(290),
    Category::find(291),
    Category::find(292),
    Category::find(293), 
    Category::find(294),
    Category::find(295),
    Category::find(296),
    Category::find(297),
    Category::find(298),
    Category::find(299),
    Category::find(300),
    Category::find(301), 
    Category::find(302),
    Category::find(303),
    Category::find(304),
    Category::find(305),
    Category::find(306),
    Category::find(307),
    Category::find(308),
    Category::find(332),
           
]);
// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '6',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(142),
    Category::find(211),
    Category::find(217),
    Category::find(218),
    Category::find(94), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(95),
    Category::find(96),
    Category::find(97),
    Category::find(98),
    Category::find(99),
    Category::find(100),
    Category::find(219),
    Category::find(220),
    Category::find(221),
    Category::find(222),
    Category::find(223),
    Category::find(224),
    Category::find(225),
    Category::find(226),
    Category::find(227),
    Category::find(228),
    Category::find(229),
    Category::find(230),
    Category::find(231),
    Category::find(232), 
    Category::find(233),
    Category::find(234),
    Category::find(235),
    Category::find(236),
    Category::find(237),
    Category::find(238),
    Category::find(239),
    Category::find(240), 
    Category::find(241),
    Category::find(242),
    Category::find(243),
    Category::find(244),
    Category::find(253),
    Category::find(254),
    Category::find(255),
    Category::find(257),
    Category::find(271),
    Category::find(288),
    Category::find(289),
    Category::find(290),
    Category::find(291),
    Category::find(292),
    Category::find(293), 
    Category::find(294),
    Category::find(295),
    Category::find(296),
    Category::find(297),
    Category::find(298),
    Category::find(299),
    Category::find(300),
    Category::find(301), 
    Category::find(302),
    Category::find(303),
    Category::find(304),
    Category::find(305),
    Category::find(306),
    Category::find(307),
    Category::find(308),
    Category::find(315),
    Category::find(316),
    Category::find(317),
    Category::find(319),
    Category::find(332),
       
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '7',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(142),
    Category::find(211),
    Category::find(217),
    Category::find(218),
    Category::find(219), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(220),
    Category::find(221),
    Category::find(222),
    Category::find(223),
    Category::find(224),
    Category::find(225),
    Category::find(226),
    Category::find(227),
    Category::find(228),
    Category::find(229),
    Category::find(230),
    Category::find(231),
    Category::find(232), 
    Category::find(233),
    Category::find(234),
    Category::find(235),
    Category::find(236),
    Category::find(237),
    Category::find(238),
    Category::find(239),
    Category::find(240), 
    Category::find(241),
    Category::find(242),
    Category::find(244),
    Category::find(271),
    Category::find(288),
    Category::find(289),
    Category::find(290),
    Category::find(291),
    Category::find(292),
    Category::find(293), 
    Category::find(294),
    Category::find(295),
    Category::find(296),
    Category::find(297),
    Category::find(298),
    Category::find(299),
    Category::find(300),
    Category::find(301), 
    Category::find(302),
    Category::find(303),
    Category::find(304),
    Category::find(305),
    Category::find(306),
    Category::find(307),
    Category::find(308),
    Category::find(332),
          
]);
// End ProductSize


// Start ProductSize
$size = ProductSize::create([
    'name' => '8',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(142),
    Category::find(211),
    Category::find(217),
    Category::find(218),
    Category::find(94), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(95),
    Category::find(96),
    Category::find(97),
    Category::find(98),
    Category::find(99),
    Category::find(100),
    Category::find(219),
    Category::find(220),
    Category::find(221),
    Category::find(222),
    Category::find(223),
    Category::find(224),
    Category::find(225),
    Category::find(226),
    Category::find(227),
    Category::find(228),
    Category::find(229),
    Category::find(230),
    Category::find(231),
    Category::find(232), 
    Category::find(233),
    Category::find(234),
    Category::find(235),
    Category::find(236),
    Category::find(237),
    Category::find(238),
    Category::find(239),
    Category::find(240), 
    Category::find(241),
    Category::find(242),
    Category::find(243),
    Category::find(244),
    Category::find(253),
    Category::find(254),
    Category::find(255),
    Category::find(257),
    Category::find(271),
    Category::find(288),
    Category::find(289),
    Category::find(290),
    Category::find(291),
    Category::find(292),
    Category::find(293), 
    Category::find(294),
    Category::find(295),
    Category::find(296),
    Category::find(297),
    Category::find(298),
    Category::find(299),
    Category::find(300),
    Category::find(301), 
    Category::find(302),
    Category::find(303),
    Category::find(304),
    Category::find(305),
    Category::find(306),
    Category::find(307),
    Category::find(308),
    Category::find(315),
    Category::find(316),
    Category::find(317),
    Category::find(319),
    Category::find(332),
           
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '9',
    'order' => 1

]);

$size->categories()->saveMany([
    Category::find(142),
    Category::find(211),
    Category::find(271),
    Category::find(332),

    ]);

    // End ProductSize


// Start ProductSize
$size = ProductSize::create([
    'name' => '10',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(142),
    Category::find(211),
    Category::find(217),
    Category::find(218),
    Category::find(94), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(95),
    Category::find(96),
    Category::find(97),
    Category::find(98),
    Category::find(99),
    Category::find(100),
    Category::find(219),
    Category::find(220),
    Category::find(221),
    Category::find(222),
    Category::find(223),
    Category::find(224),
    Category::find(225),
    Category::find(226),
    Category::find(227),
    Category::find(228),
    Category::find(229),
    Category::find(230),
    Category::find(231),
    Category::find(232), 
    Category::find(233),
    Category::find(234),
    Category::find(235),
    Category::find(236),
    Category::find(237),
    Category::find(238),
    Category::find(239),
    Category::find(240), 
    Category::find(241),
    Category::find(242),
    Category::find(243),
    Category::find(244),
    Category::find(253),
    Category::find(254),
    Category::find(255),
    Category::find(257),
    Category::find(271),
    Category::find(288),
    Category::find(289),
    Category::find(290),
    Category::find(291),
    Category::find(292),
    Category::find(293), 
    Category::find(294),
    Category::find(295),
    Category::find(296),
    Category::find(297),
    Category::find(298),
    Category::find(299),
    Category::find(300),
    Category::find(301), 
    Category::find(302),
    Category::find(303),
    Category::find(304),
    Category::find(305),
    Category::find(306),
    Category::find(307),
    Category::find(308),
    Category::find(315),
    Category::find(316),
    Category::find(317),
    Category::find(319),
    Category::find(332),
          
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '11',
    'order' => 1
]);

$size->categories()->saveMany([

    Category::find(142),
    Category::find(211),
    Category::find(271),
    Category::find(332),

    ]);

    // End ProductSize


// Start ProductSize
$size = ProductSize::create([
    'name' => '12',
    'order' => 1
]);

$size->categories()->saveMany([
 
    Category::find(142),
    Category::find(211),
    Category::find(217),
    Category::find(218),
    Category::find(94), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(95),
    Category::find(96),
    Category::find(97),
    Category::find(98),
    Category::find(99),
    Category::find(100),
    Category::find(219),
    Category::find(220),
    Category::find(221),
    Category::find(222),
    Category::find(223),
    Category::find(224),
    Category::find(225),
    Category::find(226),
    Category::find(227),
    Category::find(228),
    Category::find(229),
    Category::find(230),
    Category::find(231),
    Category::find(232), 
    Category::find(233),
    Category::find(234),
    Category::find(235),
    Category::find(236),
    Category::find(237),
    Category::find(238),
    Category::find(239),
    Category::find(240), 
    Category::find(241),
    Category::find(242),
    Category::find(243),
    Category::find(244),
    Category::find(253),
    Category::find(254),
    Category::find(255),
    Category::find(257),
    Category::find(258),
    Category::find(271),
    Category::find(288),
    Category::find(289),
    Category::find(290),
    Category::find(291),
    Category::find(292),
    Category::find(293), 
    Category::find(294),
    Category::find(295),
    Category::find(296),
    Category::find(297),
    Category::find(298),
    Category::find(299),
    Category::find(300),
    Category::find(301), 
    Category::find(302),
    Category::find(303),
    Category::find(304),
    Category::find(305),
    Category::find(306),
    Category::find(307),
    Category::find(308),
    Category::find(315),
    Category::find(316),
    Category::find(317),
    Category::find(319),
    Category::find(332),
         
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '13',
    'order' => 1
]);

$size->categories()->saveMany([
    
    Category::find(142),
    Category::find(211),
    Category::find(271),
    Category::find(332),
    ]);

    // End ProductSize



// Start ProductSize
$size = ProductSize::create([
    'name' => '14',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(142),
    Category::find(211),
    Category::find(217),
    Category::find(218),
    Category::find(94), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(95),
    Category::find(96),
    Category::find(97),
    Category::find(98),
    Category::find(99),
    Category::find(100),
    Category::find(219),
    Category::find(220),
    Category::find(221),
    Category::find(222),
    Category::find(223),
    Category::find(224),
    Category::find(225),
    Category::find(226),
    Category::find(227),
    Category::find(228),
    Category::find(229),
    Category::find(230),
    Category::find(231),
    Category::find(232), 
    Category::find(233),
    Category::find(234),
    Category::find(235),
    Category::find(236),
    Category::find(237),
    Category::find(238),
    Category::find(239),
    Category::find(240), 
    Category::find(241),
    Category::find(242),
    Category::find(243),
    Category::find(244),
    Category::find(253),
    Category::find(254),
    Category::find(255),
    Category::find(257),
    Category::find(258),
    Category::find(271),
    Category::find(288),
    Category::find(289),
    Category::find(290),
    Category::find(291),
    Category::find(292),
    Category::find(293), 
    Category::find(294),
    Category::find(295),
    Category::find(296),
    Category::find(297),
    Category::find(298),
    Category::find(299),
    Category::find(300),
    Category::find(301), 
    Category::find(302),
    Category::find(303),
    Category::find(304),
    Category::find(305),
    Category::find(306),
    Category::find(307),
    Category::find(308),
    Category::find(315),
    Category::find(316),
    Category::find(317),
    Category::find(319),
    Category::find(332),
         
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '15',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(142),
    Category::find(211),
    Category::find(271),
    Category::find(347),
    Category::find(348),
    Category::find(349),
    Category::find(350),
    Category::find(351),
    Category::find(352),
    Category::find(353),
    Category::find(332),
    ]);

    // End ProductSize


// Start ProductSize
$size = ProductSize::create([
    'name' => '16',
    'order' => 1
]);

$size->categories()->saveMany([
    
    Category::find(94), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(95),
    Category::find(96),
    Category::find(97),
    Category::find(98),
    Category::find(99),
    Category::find(100),
    Category::find(347),
    Category::find(348),
    Category::find(349),
    Category::find(350),
    Category::find(351),
    Category::find(352),
    Category::find(353),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '17',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(347),
    Category::find(348),
    Category::find(349),
    Category::find(350),
    Category::find(351),
    Category::find(352),
    Category::find(353),
]);

// End ProductSize



// Start ProductSize
$size = ProductSize::create([
    'name' => '18',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(94), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(95),
    Category::find(96),
    Category::find(97),
    Category::find(98),
    Category::find(99),
    Category::find(100),
    Category::find(347),
    Category::find(348),
    Category::find(349),
    Category::find(350),
    Category::find(351),
    Category::find(352),
    Category::find(353),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '19',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(245), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(246),
    Category::find(247),
    Category::find(248),
    Category::find(249),
    Category::find(250),
    Category::find(251),
    Category::find(252),
    Category::find(309),
    Category::find(310),
    Category::find(311),
    Category::find(312),
    Category::find(313),
    Category::find(314),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '20',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(245), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(246),
    Category::find(247),
    Category::find(248),
    Category::find(249),
    Category::find(250),
    Category::find(251),
    Category::find(252),
    Category::find(309),
    Category::find(310),
    Category::find(311),
    Category::find(312),
    Category::find(313),
    Category::find(314),
]);

// End ProductSize


// Start ProductSize
$size = ProductSize::create([
    'name' => '21',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(245), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(246),
    Category::find(247),
    Category::find(248),
    Category::find(249),
    Category::find(250),
    Category::find(251),
    Category::find(252),
    Category::find(309),
    Category::find(310),
    Category::find(311),
    Category::find(312),
    Category::find(313),
    Category::find(314),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '22',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(245), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(246),
    Category::find(247),
    Category::find(248),
    Category::find(249),
    Category::find(250),
    Category::find(251),
    Category::find(252),
    Category::find(309),
    Category::find(310),
    Category::find(311),
    Category::find(312),
    Category::find(313),
    Category::find(314),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '23',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(245), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(246),
    Category::find(247),
    Category::find(248),
    Category::find(249),
    Category::find(250),
    Category::find(251),
    Category::find(252),
    Category::find(309),
    Category::find(310),
    Category::find(311),
    Category::find(312),
    Category::find(313),
    Category::find(314),
]);

// End ProductSize


// Start ProductSize
$size = ProductSize::create([
    'name' => '24',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(245), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(246),
    Category::find(247),
    Category::find(248),
    Category::find(249),
    Category::find(250),
    Category::find(251),
    Category::find(252),
    Category::find(309),
    Category::find(310),
    Category::find(311),
    Category::find(312),
    Category::find(313),
    Category::find(314),
]);

// End ProductSize


// Start ProductSize
$size = ProductSize::create([
    'name' => '25',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(245), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(246),
    Category::find(247),
    Category::find(248),
    Category::find(249),
    Category::find(250),
    Category::find(251),
    Category::find(252),
    Category::find(309),
    Category::find(310),
    Category::find(311),
    Category::find(312),
    Category::find(313),
    Category::find(314),
]);

// End ProductSize



// Start ProductSize
$size = ProductSize::create([
    'name' => '26',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(177),
    Category::find(178),
    Category::find(179), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(180),
    Category::find(181),
    Category::find(182),
    Category::find(245),
    Category::find(246),
    Category::find(247),
    Category::find(248),
    Category::find(249),
    Category::find(250),
    Category::find(251),
    Category::find(252),
    Category::find(309),
    Category::find(310),
    Category::find(311),
    Category::find(312),
    Category::find(313),
    Category::find(314),
]);

// End ProductSize


// Start ProductSize
$size = ProductSize::create([
    'name' => '27',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(245), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(246),
    Category::find(247),
    Category::find(248),
    Category::find(249),
    Category::find(250),
    Category::find(251),
    Category::find(252),
    Category::find(309),
    Category::find(310),
    Category::find(311),
    Category::find(312),
    Category::find(313),
    Category::find(314),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '28',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(177),
    Category::find(178),
    Category::find(179), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(180),
    Category::find(181),
    Category::find(182),
    Category::find(245),
    Category::find(246),
    Category::find(247),
    Category::find(248),
    Category::find(249),
    Category::find(250),
    Category::find(251),
    Category::find(252),
    Category::find(309),
    Category::find(310),
    Category::find(311),
    Category::find(312),
    Category::find(313),
    Category::find(314),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '29',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(245), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(246),
    Category::find(247),
    Category::find(248),
    Category::find(249),
    Category::find(250),
    Category::find(251),
    Category::find(252),
    Category::find(309),
    Category::find(310),
    Category::find(311),
    Category::find(312),
    Category::find(313),
    Category::find(314),
]);

// End ProductSize


// Start ProductSize
$size = ProductSize::create([
    'name' => '30',
    'order' => 1
]);

$size->categories()->saveMany([
     // * El número debe ser el ID de la categoría que se vincula a esta talla
     Category::find(177),
     Category::find(178),
     Category::find(179),
    Category::find(180),
    Category::find(181),
    Category::find(182),
    Category::find(245),
    Category::find(246),
    Category::find(247),
    Category::find(248),
    Category::find(249),
    Category::find(250),
    Category::find(251),
    Category::find(252),
    Category::find(309),
    Category::find(310),
    Category::find(311),
    Category::find(312),
    Category::find(313),
    Category::find(314),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '31',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(245), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(246),
    Category::find(247),
    Category::find(248),
    Category::find(249),
    Category::find(250),
    Category::find(251),
    Category::find(252),
    Category::find(309),
    Category::find(310),
    Category::find(311),
    Category::find(312),
    Category::find(313),
    Category::find(314),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '32',
    'order' => 1
]);

$size->categories()->saveMany([
     // * El número debe ser el ID de la categoría que se vincula a esta talla
     Category::find(177),
     Category::find(178),
     Category::find(179),
    Category::find(180),
    Category::find(181),
    Category::find(182),
    Category::find(245),
    Category::find(246),
    Category::find(247),
    Category::find(248),
    Category::find(249),
    Category::find(250),
    Category::find(251),
    Category::find(252),
    Category::find(309),
    Category::find(310),
    Category::find(311),
    Category::find(312),
    Category::find(313),
    Category::find(314),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '33',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(245), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(246),
    Category::find(247),
    Category::find(248),
    Category::find(249),
    Category::find(250),
    Category::find(251),
    Category::find(252),
    Category::find(309),
    Category::find(310),
    Category::find(311),
    Category::find(312),
    Category::find(313),
    Category::find(314),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '34',
    'order' => 1
]);

$size->categories()->saveMany([
    // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(177),
    Category::find(178),
    Category::find(179),
    Category::find(180),
    Category::find(181),
    Category::find(182),
    Category::find(245),
    Category::find(246),
    Category::find(247),
    Category::find(248),
    Category::find(249),
    Category::find(250),
    Category::find(251),
    Category::find(252),
    Category::find(309),
    Category::find(310),
    Category::find(311),
    Category::find(312),
    Category::find(313),
    Category::find(314),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '35',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(245), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(246),
    Category::find(247),
    Category::find(248),
    Category::find(249),
    Category::find(250),
    Category::find(251),
    Category::find(252),
    Category::find(309),
    Category::find(310),
    Category::find(311),
    Category::find(312),
    Category::find(313),
    Category::find(314),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '35.5',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(109),// * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(110),
    Category::find(111),
    Category::find(112),
    Category::find(113),
    Category::find(114),
    Category::find(115),
    Category::find(116),
    Category::find(186),
    Category::find(187),
    Category::find(188),
    Category::find(189),
    Category::find(190),
    Category::find(191),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '36',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(109),// * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(110),
    Category::find(111),
    Category::find(112),
    Category::find(113),
    Category::find(114),
    Category::find(115),
    Category::find(116),
    Category::find(177),
    Category::find(178),
    Category::find(186),
    Category::find(187),
    Category::find(188),
    Category::find(189),
    Category::find(190),
    Category::find(191),
    Category::find(179),
    Category::find(180),
    Category::find(181),
    Category::find(182),
    Category::find(245),
    Category::find(246),
    Category::find(247),
    Category::find(248),
    Category::find(249),
    Category::find(250),
    Category::find(251),
    Category::find(252),
    Category::find(309),
    Category::find(310),
    Category::find(311),
    Category::find(312),
    Category::find(313),
    Category::find(314),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '36.5',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(109),// * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(110),
    Category::find(111),
    Category::find(112),
    Category::find(113),
    Category::find(114),
    Category::find(115),
    Category::find(116),
    Category::find(186),
    Category::find(187),
    Category::find(188),
    Category::find(189),
    Category::find(190),
    Category::find(191),
]);

// End ProductSize


// Start ProductSize
$size = ProductSize::create([
    'name' => '37',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(109),// * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(110),
    Category::find(111),
    Category::find(112),
    Category::find(113),
    Category::find(114),
    Category::find(115),
    Category::find(116),
    Category::find(186),
    Category::find(187),
    Category::find(188),
    Category::find(189),
    Category::find(190),
    Category::find(191),
    Category::find(245), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(246),
    Category::find(247),
    Category::find(248),
    Category::find(249),
    Category::find(250),
    Category::find(251),
    Category::find(252),
    Category::find(309),
    Category::find(310),
    Category::find(311),
    Category::find(312),
    Category::find(313),
    Category::find(314),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '37.5',
    'order' => 1
]);

$size->categories()->saveMany([
    
    
]);

// End ProductSize


// Start ProductSize
$size = ProductSize::create([
    'name' => '38',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(109),// * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(110),
    Category::find(111),
    Category::find(112),
    Category::find(113),
    Category::find(114),
    Category::find(115),
    Category::find(116),
    Category::find(177),
    Category::find(178),
    Category::find(186),
    Category::find(187),
    Category::find(188),
    Category::find(189),
    Category::find(190),
    Category::find(191),
    Category::find(179),
    Category::find(180),
    Category::find(181),
    Category::find(182),
    Category::find(245),
    Category::find(246),
    Category::find(247),
    Category::find(248),
    Category::find(249),
    Category::find(250),
    Category::find(251),
    Category::find(252),
    Category::find(309),
    Category::find(310),
    Category::find(311),
    Category::find(312),
    Category::find(313),
    Category::find(314),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '38.5',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(109),// * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(110),
    Category::find(111),
    Category::find(112),
    Category::find(113),
    Category::find(114),
    Category::find(115),
    Category::find(116),
    Category::find(186),
    Category::find(187),
    Category::find(188),
    Category::find(189),
    Category::find(190),
    Category::find(191),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '39',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(109),// * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(110),
    Category::find(111),
    Category::find(112),
    Category::find(113),
    Category::find(114),
    Category::find(115),
    Category::find(116),
    Category::find(186),
    Category::find(187),
    Category::find(188),
    Category::find(189),
    Category::find(190),
    Category::find(191),
    Category::find(245),
    Category::find(246),
    Category::find(247),
    Category::find(248),
    Category::find(249),
    Category::find(250),
    Category::find(251),
    Category::find(252),
    Category::find(309),
    Category::find(310),
    Category::find(311),
    Category::find(312),
    Category::find(313),
    Category::find(314),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '40',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(109),// * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(110),
    Category::find(111),
    Category::find(112),
    Category::find(113),
    Category::find(114),
    Category::find(115),
    Category::find(116),
    Category::find(177),
    Category::find(178),
    Category::find(186),
    Category::find(187),
    Category::find(188),
    Category::find(189),
    Category::find(190),
    Category::find(191),
    Category::find(179),
    Category::find(180),
    Category::find(181),
    Category::find(182),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '40.5',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(109),// * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(110),
    Category::find(111),
    Category::find(112),
    Category::find(113),
    Category::find(114),
    Category::find(115),
    Category::find(116),
    Category::find(186),
    Category::find(187),
    Category::find(188),
    Category::find(189),
    Category::find(190),
    Category::find(191),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '41',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(109),// * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(110),
    Category::find(111),
    Category::find(112),
    Category::find(113),
    Category::find(114),
    Category::find(115),
    Category::find(116),
    Category::find(186),
    Category::find(187),
    Category::find(188),
    Category::find(189),
    Category::find(190),
    Category::find(191),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '42',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(109),// * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(110),
    Category::find(111),
    Category::find(112),
    Category::find(113),
    Category::find(114),
    Category::find(115),
    Category::find(116),
    Category::find(177),
    Category::find(178),
    Category::find(186),
    Category::find(187),
    Category::find(188),
    Category::find(189),
    Category::find(190),
    Category::find(191),
    Category::find(179),
    Category::find(180),
    Category::find(181),
    Category::find(182),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '42.5',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(109),// * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(110),
    Category::find(111),
    Category::find(112),
    Category::find(113),
    Category::find(114),
    Category::find(115),
    Category::find(116),
    Category::find(186),
    Category::find(187),
    Category::find(188),
    Category::find(189),
    Category::find(190),
    Category::find(191),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '43',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(109),// * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(110),
    Category::find(111),
    Category::find(112),
    Category::find(113),
    Category::find(114),
    Category::find(115),
    Category::find(116),
    Category::find(186),
    Category::find(187),
    Category::find(188),
    Category::find(189),
    Category::find(190),
    Category::find(191),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '44',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(109),// * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(110),
    Category::find(111),
    Category::find(112),
    Category::find(113),
    Category::find(114),
    Category::find(115),
    Category::find(116),
    Category::find(186),
    Category::find(187),
    Category::find(188),
    Category::find(189),
    Category::find(190),
    Category::find(191),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '44.5',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(109),// * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(110),
    Category::find(111),
    Category::find(112),
    Category::find(113),
    Category::find(114),
    Category::find(115),
    Category::find(116),
    Category::find(186),
    Category::find(187),
    Category::find(188),
    Category::find(189),
    Category::find(190),
    Category::find(191),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '45',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(186),
    Category::find(187),
    Category::find(188),
    Category::find(189),
    Category::find(190),
    Category::find(191),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '45.5',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(186),
    Category::find(187),
    Category::find(188),
    Category::find(189),
    Category::find(190),
    Category::find(191),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '46',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(186),
    Category::find(187),
    Category::find(188),
    Category::find(189),
    Category::find(190),
    Category::find(191),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '47',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(186),
    Category::find(187),
    Category::find(188),
    Category::find(189),
    Category::find(190),
    Category::find(191),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '47.5',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(186),
    Category::find(187),
    Category::find(188),
    Category::find(189),
    Category::find(190),
    Category::find(191),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '48',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(186),
    Category::find(187),
    Category::find(188),
    Category::find(189),
    Category::find(190),
    Category::find(191),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '48.5',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(186),
    Category::find(187),
    Category::find(188),
    Category::find(189),
    Category::find(190),
    Category::find(191),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '49.5',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(186),
    Category::find(187),
    Category::find(188),
    Category::find(189),
    Category::find(190),
    Category::find(191),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '50.5',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(186),
    Category::find(187),
    Category::find(188),
    Category::find(189),
    Category::find(190),
    Category::find(191),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '51.5',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(186),
    Category::find(187),
    Category::find(188),
    Category::find(189),
    Category::find(190),
    Category::find(191),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '52.5',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(186),
    Category::find(187),
    Category::find(188),
    Category::find(189),
    Category::find(190),
    Category::find(191),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '0-1 M',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(44), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(45),
    Category::find(46),
    Category::find(47),
    Category::find(48),
    Category::find(49),
    Category::find(50),
    Category::find(51),
    Category::find(52),
    Category::find(53),
    Category::find(54),
    Category::find(55),
    Category::find(56),
    Category::find(57),
    Category::find(58),
    Category::find(59),
    Category::find(60),
    Category::find(61),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '1-3 M',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(44), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(45),
    Category::find(46),
    Category::find(47),
    Category::find(48),
    Category::find(49),
    Category::find(50),
    Category::find(51),
    Category::find(52),
    Category::find(53),
    Category::find(54),
    Category::find(55),
    Category::find(56),
    Category::find(57),
    Category::find(58),
    Category::find(59),
    Category::find(60),
    Category::find(61),
    Category::find(339),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '1-6 M',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(354), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);
// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '3-6 M',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(44), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(45),
    Category::find(46),
    Category::find(47),
    Category::find(48),
    Category::find(49),
    Category::find(50),
    Category::find(51),
    Category::find(52),
    Category::find(53),
    Category::find(54),
    Category::find(55),
    Category::find(56),
    Category::find(57),
    Category::find(58),
    Category::find(59),
    Category::find(60),
    Category::find(61),
    Category::find(339),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '6-9 M',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(44), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(45),
    Category::find(46),
    Category::find(47),
    Category::find(48),
    Category::find(49),
    Category::find(50),
    Category::find(51),
    Category::find(52),
    Category::find(53),
    Category::find(54),
    Category::find(55),
    Category::find(56),
    Category::find(57),
    Category::find(58),
    Category::find(59),
    Category::find(60),
    Category::find(61),
    Category::find(339),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '6-12 M',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(354), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);
// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '9-12 M',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(44), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(45),
    Category::find(46),
    Category::find(47),
    Category::find(48),
    Category::find(49),
    Category::find(50),
    Category::find(51),
    Category::find(52),
    Category::find(53),
    Category::find(54),
    Category::find(55),
    Category::find(56),
    Category::find(57),
    Category::find(58),
    Category::find(59),
    Category::find(60),
    Category::find(61),
    Category::find(339),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '12-18 M',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(44), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(45),
    Category::find(46),
    Category::find(47),
    Category::find(48),
    Category::find(49),
    Category::find(50),
    Category::find(51),
    Category::find(52),
    Category::find(53),
    Category::find(54),
    Category::find(55),
    Category::find(56),
    Category::find(57),
    Category::find(58),
    Category::find(59),
    Category::find(60),
    Category::find(61),
    Category::find(339),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '12-24 M',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(354), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);
// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '18-24 M',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(44), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(45),
    Category::find(46),
    Category::find(47),
    Category::find(48),
    Category::find(49),
    Category::find(50),
    Category::find(51),
    Category::find(52),
    Category::find(53),
    Category::find(54),
    Category::find(55),
    Category::find(56),
    Category::find(57),
    Category::find(58),
    Category::find(59),
    Category::find(60),
    Category::find(61),
    Category::find(339),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '24-36 M',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(44), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(45),
    Category::find(46),
    Category::find(47),
    Category::find(48),
    Category::find(49),
    Category::find(50),
    Category::find(51),
    Category::find(52),
    Category::find(53),
    Category::find(54),
    Category::find(55),
    Category::find(56),
    Category::find(57),
    Category::find(58),
    Category::find(59),
    Category::find(60),
    Category::find(61),
    Category::find(339),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '30 - Copa A / XS',
    'order' => 1
]);

$size->categories()->saveMany([
     // * El número debe ser el ID de la categoría que se vincula a esta talla
]);
// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '32 - Copa A / S',
    'order' => 1
]);

$size->categories()->saveMany([
    // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '34 - Copa A / M',
    'order' => 1
]);

$size->categories()->saveMany([
     // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '36 - Copa A / L',
    'order' => 1
]);

$size->categories()->saveMany([
    // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '38 - Copa A / XL',
    'order' => 1
]);

$size->categories()->saveMany([
    // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '40 - Copa A / XXL',
    'order' => 1
]);

$size->categories()->saveMany([
     // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '42 - Copa A / 3XL',
    'order' => 1
]);

$size->categories()->saveMany([
    // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '30 - Copa B / XS',
    'order' => 1
]);

$size->categories()->saveMany([
     // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '32 - Copa B / S',
    'order' => 1
]);

$size->categories()->saveMany([
     // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '34 - Copa B / M',
    'order' => 1
]);

$size->categories()->saveMany([
     // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '36 - Copa B / L',
    'order' => 1
]);

$size->categories()->saveMany([
     // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '38 - Copa B / XL',
    'order' => 1
]);

$size->categories()->saveMany([
     // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '40 - Copa B / XXL',
    'order' => 1
]);

$size->categories()->saveMany([
     // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '42 - Copa B / 3XL',
    'order' => 1
]);

$size->categories()->saveMany([
     // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '30 - Copa C / XS',
    'order' => 1
]);

$size->categories()->saveMany([
     // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '32 - Copa C / S',
    'order' => 1
]);

$size->categories()->saveMany([
     // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '34 - Copa C / M',
    'order' => 1
]);

$size->categories()->saveMany([
     // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '36 - Copa C / L',
    'order' => 1
]);

$size->categories()->saveMany([
     // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '38 - Copa C / XL',
    'order' => 1
]);

$size->categories()->saveMany([
     // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '40 - Copa C / XXL',
    'order' => 1
]);

$size->categories()->saveMany([
     // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '42 - Copa C / 3XL',
    'order' => 1
]);

$size->categories()->saveMany([
     // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize


// Start ProductSize
$size = ProductSize::create([
    'name' => '30 - Copa D / XS',
    'order' => 1
]);

$size->categories()->saveMany([
     // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize


// Start ProductSize
$size = ProductSize::create([
    'name' => '32 - Copa D / S',
    'order' => 1
]);

$size->categories()->saveMany([
     // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize


// Start ProductSize
$size = ProductSize::create([
    'name' => '34 - Copa D / M',
    'order' => 1
]);

$size->categories()->saveMany([
     // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize


// Start ProductSize
$size = ProductSize::create([
    'name' => '36 - Copa D / L',
    'order' => 1
]);

$size->categories()->saveMany([
     // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize


// Start ProductSize
$size = ProductSize::create([
    'name' => '38 - Copa D / XL',
    'order' => 1
]);

$size->categories()->saveMany([
     // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize


// Start ProductSize
$size = ProductSize::create([
    'name' => '40 - Copa D / XXL',
    'order' => 1
]);

$size->categories()->saveMany([
     // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize


// Start ProductSize
$size = ProductSize::create([
    'name' => '42 - Copa D / 3XL',
    'order' => 1
]);

$size->categories()->saveMany([
     // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '1 Plaza',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(74), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(75),
    Category::find(76),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '1 1/4 Plaza',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(74), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(75),
    Category::find(76),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '1 1/2 Plaza',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(74), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(75),
    Category::find(76),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '2 Plazas',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(74), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(75),
    Category::find(76),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '2 1/2 Plazas',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(74), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(75),
    Category::find(76),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '3 Plazas',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(74), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(75),
    Category::find(76),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '60 X 110 cm',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(78), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '60 X 140 cm',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(78), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '80 X 110 cm',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(78), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '90 X 160 cm',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(78), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '90 X 180 cm',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(78), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '90 X 210 cm',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(78), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '110 X 230 cm',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(78), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '120 X 180 cm',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(78), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize


// Start ProductSize
$size = ProductSize::create([
    'name' => '120 X 220 cm',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(78), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '120 X 260 cm',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(78), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '70 X 70 cm',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(77), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '80 X 80 cm',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(77), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '90 X 90 cm',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(77), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '110 cm',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(79), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '120 cm',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(79), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '130 cm',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(79), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '150 cm',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(79), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '180 cm',
    'order' => 1
]);

$size->categories()->saveMany([
    Category::find(79), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '30 - Copa A',
    'order' => 1
]);
$size->categories()->saveMany([
    Category::find(117),
    Category::find(118), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '30 - Copa B',
    'order' => 1
]);
$size->categories()->saveMany([
    Category::find(117),
    Category::find(118), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '30 - Copa C',
    'order' => 1
]);
$size->categories()->saveMany([
    Category::find(117),
    Category::find(118), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '30 - Copa D',
    'order' => 1
]);
$size->categories()->saveMany([
    Category::find(117),
    Category::find(118), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '32 - Copa A',
    'order' => 1
]);
$size->categories()->saveMany([
    Category::find(117),
    Category::find(118), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '32 - Copa B',
    'order' => 1
]);
$size->categories()->saveMany([
    Category::find(117), 
    Category::find(118), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '32 - Copa C',
    'order' => 1
]);
$size->categories()->saveMany([
    Category::find(117),
    Category::find(118), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '32 - Copa D',
    'order' => 1
]);
$size->categories()->saveMany([
    Category::find(117),
    Category::find(118), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '34 - Copa A',
    'order' => 1
]);
$size->categories()->saveMany([
    Category::find(117),
    Category::find(118), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '34 - Copa B',
    'order' => 1
]);
$size->categories()->saveMany([
    Category::find(117),
    Category::find(118), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '34 - Copa C',
    'order' => 1
]);
$size->categories()->saveMany([
    Category::find(117),
    Category::find(118), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '34 - Copa D',
    'order' => 1
]);
$size->categories()->saveMany([
    Category::find(117),
    Category::find(118), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '36 - Copa A',
    'order' => 1
]);
$size->categories()->saveMany([
    Category::find(117),
    Category::find(118), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '36 - Copa B',
    'order' => 1
]);
$size->categories()->saveMany([
    Category::find(117),
    Category::find(118), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '36 - Copa C',
    'order' => 1
]);
$size->categories()->saveMany([
    Category::find(117),
    Category::find(118), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '36 - Copa D',
    'order' => 1
]);
$size->categories()->saveMany([
    Category::find(117),
    Category::find(118), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '38 - Copa A',
    'order' => 1
]);
$size->categories()->saveMany([
    Category::find(117),
    Category::find(118), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '38 - Copa B',
    'order' => 1
]);
$size->categories()->saveMany([
    Category::find(117),
    Category::find(118), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '38 - Copa C',
    'order' => 1
]);
$size->categories()->saveMany([
    Category::find(117),
    Category::find(118), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '38 - Copa D',
    'order' => 1
]);
$size->categories()->saveMany([
    Category::find(117),
    Category::find(118), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '40 - Copa A',
    'order' => 1
]);
$size->categories()->saveMany([
    Category::find(117),
    Category::find(118), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '40 - Copa B',
    'order' => 1
]);
$size->categories()->saveMany([
    Category::find(117),
    Category::find(118), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '40 - Copa C',
    'order' => 1
]);
$size->categories()->saveMany([
    Category::find(117),
    Category::find(118), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '40 - Copa D',
    'order' => 1
]);
$size->categories()->saveMany([
    Category::find(117),
    Category::find(118), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize


// Start ProductSize
$size = ProductSize::create([
    'name' => '42 - Copa A',
    'order' => 1
]);
$size->categories()->saveMany([
    Category::find(117),
    Category::find(118), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '42 - Copa B',
    'order' => 1
]);
$size->categories()->saveMany([
    Category::find(117),
    Category::find(118), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '42 - Copa C',
    'order' => 1
]);
$size->categories()->saveMany([
    Category::find(117),
    Category::find(118), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => '42 - Copa D',
    'order' => 1
]);
$size->categories()->saveMany([
    Category::find(117),
    Category::find(118), // * El número debe ser el ID de la categoría que se vincula a esta talla
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => 'Talla única',
    'order' => 1
]);
$size->categories()->saveMany([
    Category::find(64),
    Category::find(65),
    Category::find(66),
    Category::find(70),
    Category::find(71),
    Category::find(73),
    Category::find(72),
    Category::find(129), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(133),
    Category::find(134),
    Category::find(135),
    Category::find(136),
    Category::find(137),
    Category::find(138),
    Category::find(139),
    Category::find(140),
    Category::find(141),
    Category::find(143),
    Category::find(145),
    Category::find(146),
    Category::find(147),
    Category::find(148),
    Category::find(149),
    Category::find(150),
    Category::find(151),
    Category::find(152),
    Category::find(153),
    Category::find(154),
    Category::find(155),
    Category::find(156),
    Category::find(157),
    Category::find(158),
    Category::find(159),
    Category::find(160),
    Category::find(161),
    Category::find(162),
    Category::find(163),
    Category::find(164),
    Category::find(165),
    Category::find(264),
    Category::find(199),
    Category::find(202),
    Category::find(204),
    Category::find(205),
    Category::find(206),
    Category::find(207),
    Category::find(208),
    Category::find(209),
    Category::find(210),
    Category::find(213),
    Category::find(214),
    Category::find(215),
    Category::find(216),
    Category::find(259),
    Category::find(263),
    Category::find(264),
    Category::find(265),
    Category::find(266),
    Category::find(267),
    Category::find(268),
    Category::find(269),
    Category::find(270),
    Category::find(272),
    Category::find(274),
    Category::find(275),
    Category::find(276),
    Category::find(277),
    Category::find(278),
    Category::find(279),
    Category::find(280),
    Category::find(281),
    Category::find(282),
    Category::find(283),
    Category::find(284),
    Category::find(285),
    Category::find(286),
    Category::find(287),
    Category::find(320),
    Category::find(325),
    Category::find(326),
    Category::find(327),
    Category::find(328),
    Category::find(329),
    Category::find(330),
    Category::find(331),
    Category::find(334),
    Category::find(335),
    Category::find(336),
    Category::find(337),
    Category::find(355),
     
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => 'Pequeño',
    'order' => 1
]);
$size->categories()->saveMany([
    Category::find(64),
    Category::find(65),
    Category::find(66),
    Category::find(70),
    Category::find(71),
    Category::find(73),
    Category::find(72),
    Category::find(129), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(133),
    Category::find(134),
    Category::find(135),
    Category::find(136),
    Category::find(137),
    Category::find(138),
    Category::find(139),
    Category::find(140),
    Category::find(141),
    Category::find(143),
    Category::find(145),
    Category::find(146),
    Category::find(147),
    Category::find(148),
    Category::find(149),
    Category::find(150),
    Category::find(151),
    Category::find(152),
    Category::find(153),
    Category::find(154),
    Category::find(155),
    Category::find(156),
    Category::find(157),
    Category::find(158),
    Category::find(159),
    Category::find(160),
    Category::find(161),
    Category::find(162),
    Category::find(163),
    Category::find(164),
    Category::find(165),
    Category::find(264),
    Category::find(199),
    Category::find(202),
    Category::find(204),
    Category::find(205),
    Category::find(206),
    Category::find(207),
    Category::find(208),
    Category::find(209),
    Category::find(210),
    Category::find(213),
    Category::find(214),
    Category::find(215),
    Category::find(216),
    Category::find(259),
    Category::find(263),
    Category::find(264),
    Category::find(265),
    Category::find(266),
    Category::find(267),
    Category::find(268),
    Category::find(269),
    Category::find(270),
    Category::find(272),
    Category::find(274),
    Category::find(275),
    Category::find(276),
    Category::find(277),
    Category::find(278),
    Category::find(279),
    Category::find(280),
    Category::find(281),
    Category::find(282),
    Category::find(283),
    Category::find(284),
    Category::find(285),
    Category::find(286),
    Category::find(287),
    Category::find(320),
    Category::find(325),
    Category::find(326),
    Category::find(327),
    Category::find(328),
    Category::find(329),
    Category::find(330),
    Category::find(331),
    Category::find(334),
    Category::find(335),
    Category::find(336),
    Category::find(337),
    Category::find(355),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => 'Mediano',
    'order' => 1
]);
$size->categories()->saveMany([
    Category::find(64),
    Category::find(65),
    Category::find(66),
    Category::find(70),
    Category::find(71),
    Category::find(73),
    Category::find(72),
    Category::find(129), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(133),
    Category::find(134),
    Category::find(135),
    Category::find(136),
    Category::find(137),
    Category::find(138),
    Category::find(139),
    Category::find(140),
    Category::find(141),
    Category::find(143),
    Category::find(145),
    Category::find(146),
    Category::find(147),
    Category::find(148),
    Category::find(149),
    Category::find(150),
    Category::find(151),
    Category::find(152),
    Category::find(153),
    Category::find(154),
    Category::find(155),
    Category::find(156),
    Category::find(157),
    Category::find(158),
    Category::find(159),
    Category::find(160),
    Category::find(161),
    Category::find(162),
    Category::find(163),
    Category::find(164),
    Category::find(165),
    Category::find(264),
    Category::find(199),
    Category::find(202),
    Category::find(204),
    Category::find(205),
    Category::find(206),
    Category::find(207),
    Category::find(208),
    Category::find(209),
    Category::find(210),
    Category::find(213),
    Category::find(214),
    Category::find(215),
    Category::find(216),
    Category::find(259),
    Category::find(263),
    Category::find(264),
    Category::find(265),
    Category::find(266),
    Category::find(267),
    Category::find(268),
    Category::find(269),
    Category::find(270),
    Category::find(272),
    Category::find(274),
    Category::find(275),
    Category::find(276),
    Category::find(277),
    Category::find(278),
    Category::find(279),
    Category::find(280),
    Category::find(281),
    Category::find(282),
    Category::find(283),
    Category::find(284),
    Category::find(285),
    Category::find(286),
    Category::find(287),
    Category::find(320),
    Category::find(325),
    Category::find(326),
    Category::find(327),
    Category::find(328),
    Category::find(329),
    Category::find(330),
    Category::find(331),
    Category::find(334),
    Category::find(335),
    Category::find(336),
    Category::find(337),
    Category::find(355),
]);

// End ProductSize

// Start ProductSize
$size = ProductSize::create([
    'name' => 'Grande',
    'order' => 1
]);
$size->categories()->saveMany([
    Category::find(64),
    Category::find(65),
    Category::find(66),
    Category::find(70),
    Category::find(71),
    Category::find(73),
    Category::find(72),
    Category::find(129), // * El número debe ser el ID de la categoría que se vincula a esta talla
    Category::find(133),
    Category::find(134),
    Category::find(135),
    Category::find(136),
    Category::find(137),
    Category::find(138),
    Category::find(139),
    Category::find(140),
    Category::find(141),
    Category::find(143),
    Category::find(145),
    Category::find(146),
    Category::find(147),
    Category::find(148),
    Category::find(149),
    Category::find(150),
    Category::find(151),
    Category::find(152),
    Category::find(153),
    Category::find(154),
    Category::find(155),
    Category::find(156),
    Category::find(157),
    Category::find(158),
    Category::find(159),
    Category::find(160),
    Category::find(161),
    Category::find(162),
    Category::find(163),
    Category::find(164),
    Category::find(165),
    Category::find(264),
    Category::find(199),
    Category::find(202),
    Category::find(204),
    Category::find(205),
    Category::find(206),
    Category::find(207),
    Category::find(208),
    Category::find(209),
    Category::find(210),
    Category::find(213),
    Category::find(214),
    Category::find(215),
    Category::find(216),
    Category::find(259),
    Category::find(263),
    Category::find(264),
    Category::find(265),
    Category::find(266),
    Category::find(267),
    Category::find(268),
    Category::find(269),
    Category::find(270),
    Category::find(272),
    Category::find(274),
    Category::find(275),
    Category::find(276),
    Category::find(277),
    Category::find(278),
    Category::find(279),
    Category::find(280),
    Category::find(281),
    Category::find(282),
    Category::find(283),
    Category::find(284),
    Category::find(285),
    Category::find(286),
    Category::find(287),
    Category::find(320),
    Category::find(325),
    Category::find(326),
    Category::find(327),
    Category::find(328),
    Category::find(329),
    Category::find(330),
    Category::find(331),
    Category::find(334),
    Category::find(335),
    Category::find(336),
    Category::find(337),
    Category::find(355),
]);

// End ProductSize


    }
}
