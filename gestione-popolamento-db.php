<?php 

require_once 'connection.php';

$carte = [
    [
      "Card Network" => "VISA",
      "Card Holder" => "Jeffrey Davenport",
      "Card Number" => "4119011250192",
      "Expire" => "08/26",
      "CVC" => "400",
    ],
    [
      "Card Network" => "Maestro",
      "Card Holder" => "Shawn Fuller",
      "Card Number" => "501803747861",
      "Expire" => "01/32",
      "CVC" => "245",
    ],
    [
      "Card Network" => "Mastercard",
      "Card Holder" => "Nicholas Schmidt",
      "Card Number" => "2720095543867852",
      "Expire" => "01/24",
      "CVC" => "900",
    ],
    [
      "Card Network" => "American Express",
      "Card Holder" => "David Mccall",
      "Card Number" => "370160101950321",
      "Expire" => "11/24",
      "CVC" => "5271",
    ],
    [
      "Card Network" => "VISA",
      "Card Holder" => "Betty Fields",
      "Card Number" => "4864810451019020221",
      "Expire" => "10/25",
      "CVC" => "288",
    ],
    [
      "Card Network" => "VISA",
      "Card Holder" => "Taylor King",
      "Card Number" => "4763272608574855",
      "Expire" => "03/22",
      "CVC" => "181",
    ],
    [
      "Card Network" => "JCB",
      "Card Holder" => "Juan Blair",
      "Card Number" => "3584413833287140",
      "Expire" => "03/28",
      "CVC" => "189",
    ],
    [
      "Card Network" => "Discover",
      "Card Holder" => "Sean Moore",
      "Card Number" => "6011555411643049",
      "Expire" => "01/28",
      "CVC" => "877",
    ],
    [
      "Card Network" => "American Express",
      "Card Holder" => "Kayla Contreras",
      "Card Number" => "340074633755966",
      "Expire" => "08/28",
      "CVC" => "1151",
    ],
    [
      "Card Network" => "American Express",
      "Card Holder" => "Barbara Mcpherson",
      "Card Number" => "370663121673419",
      "Expire" => "01/32",
      "CVC" => "4088",
    ],
    [
      "Card Network" => "Mastercard",
      "Card Holder" => "John Spencer",
      "Card Number" => "2232378695843363",
      "Expire" => "08/22",
      "CVC" => "593",
    ],
    [
      "Card Network" => "VISA",
      "Card Holder" => "Keith Miller",
      "Card Number" => "4308448990250843302",
      "Expire" => "06/28",
      "CVC" => "775",
    ],
    [
      "Card Network" => "Mastercard",
      "Card Holder" => "Jennifer Rosales",
      "Card Number" => "2282112487087007",
      "Expire" => "08/22",
      "CVC" => "424",
    ],
    [
      "Card Network" => "VISA",
      "Card Holder" => "Elijah Lutz",
      "Card Number" => "4531529375668033",
      "Expire" => "02/23",
      "CVC" => "467",
    ],
    [
      "Card Network" => "Mastercard",
      "Card Holder" => "Jennifer Alvarado",
      "Card Number" => "2264862881015002",
      "Expire" => "07/30",
      "CVC" => "985",
    ],
    [
      "Card Network" => "VISA",
      "Card Holder" => "Michelle Adams",
      "Card Number" => "4917530565860111",
      "Expire" => "02/26",
      "CVC" => "479",
    ],
    [
      "Card Network" => "Discover",
      "Card Holder" => "Laura Padilla",
      "Card Number" => "6524118110733403",
      "Expire" => "06/26",
      "CVC" => "918",
    ],
    [
      "Card Network" => "JCB",
      "Card Holder" => "Scott Parker",
      "Card Number" => "3509899310214494",
      "Expire" => "09/31",
      "CVC" => "143",
    ],
    [
      "Card Network" => "VISA",
      "Card Holder" => "Sheryl Walker",
      "Card Number" => "4628441910773803",
      "Expire" => "03/24",
      "CVC" => "833",
    ],
    [
      "Card Network" => "Maestro",
      "Card Holder" => "John Romero",
      "Card Number" => "569162691509",
      "Expire" => "10/29",
      "CVC" => "110",
    ],
    [
      "Card Network" => "Diners Club / Carte Blanche",
      "Card Holder" => "Lisa Dalton",
      "Card Number" => "30144349053462",
      "Expire" => "04/26",
      "CVC" => "654",
    ],
    [
      "Card Network" => "Maestro",
      "Card Holder" => "Jason Harris",
      "Card Number" => "675913360110",
      "Expire" => "07/30",
      "CVC" => "873",
    ],
    [
      "Card Network" => "Maestro",
      "Card Holder" => "Brandon Rice",
      "Card Number" => "676282833810",
      "Expire" => "06/27",
      "CVC" => "478",
    ],
    [
      "Card Network" => "American Express",
      "Card Holder" => "Melissa Castillo",
      "Card Number" => "345893745465338",
      "Expire" => "08/22",
      "CVC" => "9784",
    ],
    [
      "Card Network" => "Maestro",
      "Card Holder" => "David Rowe",
      "Card Number" => "639072885051",
      "Expire" => "10/22",
      "CVC" => "531",
    ],
    [
      "Card Network" => "JCB",
      "Card Holder" => "Desiree Waters",
      "Card Number" => "3581179302888733",
      "Expire" => "08/26",
      "CVC" => "411",
    ],
    [
      "Card Network" => "JCB",
      "Card Holder" => "Donna Berger",
      "Card Number" => "3562619393201216",
      "Expire" => "11/25",
      "CVC" => "225",
    ],
    [
      "Card Network" => "JCB",
      "Card Holder" => "Jeffrey Calderon",
      "Card Number" => "3578653909856595",
      "Expire" => "04/28",
      "CVC" => "944",
    ],
    [
      "Card Network" => "Diners Club / Carte Blanche",
      "Card Holder" => "John Price",
      "Card Number" => "30517079544182",
      "Expire" => "03/32",
      "CVC" => "616",
    ],
    [
      "Card Network" => "JCB",
      "Card Holder" => "Brett Andrews",
      "Card Number" => "3553954108377774",
      "Expire" => "06/30",
      "CVC" => "002",
    ],
    [
      "Card Network" => "VISA",
      "Card Holder" => "Sheri Collins",
      "Card Number" => "4112353363551607",
      "Expire" => "01/32",
      "CVC" => "844",
    ],
    [
      "Card Network" => "JCB",
      "Card Holder" => "William Hatfield",
      "Card Number" => "3516598013802644",
      "Expire" => "07/29",
      "CVC" => "145",
    ],
    [
      "Card Network" => "VISA",
      "Card Holder" => "Christopher Andersen",
      "Card Number" => "4736738809685",
      "Expire" => "07/22",
      "CVC" => "612",
    ],
    [
      "Card Network" => "VISA",
      "Card Holder" => "Colton Smith",
      "Card Number" => "4564206495500",
      "Expire" => "11/30",
      "CVC" => "431",
    ],
    [
      "Card Network" => "VISA",
      "Card Holder" => "Mary Lang",
      "Card Number" => "4195245272603166",
      "Expire" => "06/27",
      "CVC" => "509",
    ],
    [
      "Card Network" => "Discover",
      "Card Holder" => "Travis Smith",
      "Card Number" => "6011611520636315",
      "Expire" => "02/31",
      "CVC" => "452",
    ],
    [
      "Card Network" => "VISA",
      "Card Holder" => "Karen Wagner",
      "Card Number" => "4946668257048705",
      "Expire" => "11/24",
      "CVC" => "329",
    ],
    [
      "Card Network" => "Mastercard",
      "Card Holder" => "Michelle Brooks",
      "Card Number" => "5196741204323838",
      "Expire" => "09/31",
      "CVC" => "345",
    ],
    [
      "Card Network" => "Discover",
      "Card Holder" => "Cheryl Chambers",
      "Card Number" => "6011297221005776",
      "Expire" => "05/28",
      "CVC" => "844",
    ],
    [
      "Card Network" => "American Express",
      "Card Holder" => "Gary Martinez",
      "Card Number" => "349712337499701",
      "Expire" => "02/27",
      "CVC" => "6821",
    ],
    [
      "Card Network" => "Diners Club / Carte Blanche",
      "Card Holder" => "Amanda Torres",
      "Card Number" => "30431674918744",
      "Expire" => "02/27",
      "CVC" => "187",
    ],
    [
      "Card Network" => "Discover",
      "Card Holder" => "Alfred Floyd",
      "Card Number" => "6011611093658795",
      "Expire" => "06/28",
      "CVC" => "155",
    ],
    [
      "Card Network" => "VISA",
      "Card Holder" => "William Adams",
      "Card Number" => "4008042238660266",
      "Expire" => "07/24",
      "CVC" => "697",
    ],
    [
      "Card Network" => "VISA",
      "Card Holder" => "Stephanie Hood",
      "Card Number" => "4121631988347256",
      "Expire" => "05/22",
      "CVC" => "057",
    ],
    [
      "Card Network" => "Mastercard",
      "Card Holder" => "Christopher Pacheco",
      "Card Number" => "2714147157256183",
      "Expire" => "06/23",
      "CVC" => "198",
    ],
    [
      "Card Network" => "American Express",
      "Card Holder" => "George Thomas",
      "Card Number" => "377097855398088",
      "Expire" => "03/24",
      "CVC" => "8703",
    ],
    [
      "Card Network" => "JCB",
      "Card Holder" => "James Gutierrez",
      "Card Number" => "180028166642366",
      "Expire" => "03/26",
      "CVC" => "926",
    ],
    [
      "Card Network" => "Discover",
      "Card Holder" => "Amy Herman",
      "Card Number" => "6011441624428850",
      "Expire" => "10/24",
      "CVC" => "659",
    ],
    [
      "Card Network" => "Discover",
      "Card Holder" => "Gregory Scott",
      "Card Number" => "6539385174949356",
      "Expire" => "10/23",
      "CVC" => "577",
    ],
    [
      "Card Network" => "JCB",
      "Card Holder" => "Barry Williamson",
      "Card Number" => "3597748038549009",
      "Expire" => "09/26",
      "CVC" => "840",
    ],
  ];
$email = [
    "timtroyr@msn.com",
    "seemant@icloud.com",
    "ivoibs@yahoo.ca",
    "terjesa@hotmail.com",
    "itstatus@me.com",
    "claypool@icloud.com",
    "lipeng@me.com",
    "tskirvin@gmail.com",
    "henkp@optonline.net",
    "bescoto@icloud.com",
    "milton@mac.com",
    "bancboy@att.net",
    "cantu@live.com",
  ];
$phone = [
    "03978224975",
    "03245480064",
    "03841261268",
    "03939862473",
    "03407483400",
    "03315439792",
    "03401054528",
    "03481750145",
    "03618906855",
    "03856608655",
    "03715967079",
    "03635316785",
    "03501200390",
    "03660260079",
    "03155295575",
    "03527026670",
    "03284254250",
    "03707494042",
    "03437356436",
    "03520974083",
  ];

$brand_name = [
    "Neat'n'Tidy",
    "Neat and Discreet Cleaning Service",
    "Neat, Sweet and Discreet Cleaning Service",
    "Peachy Cleaners",
    "Perfectly Cleaned",
    "Pleasin’ Polish",
    "Premier Cleaning Service",
    "Prestige Cleaning",
    "Pristine Cleaning",
    "Professional Cleaning Services",
    "Queen of Clean",
    "Rainbow Cleaners",
    "Reflections Cleaning Company",
    "Rise'n Shine",
    "Select Cleaning Service",
    "Softtouch Supremeklene",
    "Sparkle Aplenty",
    "Sparkling Homes",
    "Specialist Cleaning Services",
    "Spiffy Clean",
    "Spring Cleaning Everyday",
    "Squeaky Clean",
    "Sunshine Cleaning Service",
    "Super Cleaners",
    "Super Maids",
    "Swept Away",
    "Take a Bite Out of Grime",
    "The Clean Dream Team",
    "The Clean Sweep",
    "The Clean Team",
    "The Cleaning Crew",
    "The Cleaning Trust",
    "The Cleaning Wizard",
    "The Complete Cleaning",
    "Your Dust Busters Cleaners",
    "The Maid Brigade",
    "Thoroughly Cleaned Cleaning",
    "Tidy Shines",
    "True Shine",
    "Twinkle Time",
    "Two Girls and a Bucket",
    "We Do Windows Cleaning Service",
    "We Do, Do Windows",
    "We Love The Jobs You Hate",
    "We’re a Lean Mean Cleaning Machine",
    "Well Done Cleaning Service",
    "Xtreme Cleaners",
    "You Have it Maid",
    "Your Panes Are Our Pleasure",
    "A Clean Getaway",
    "A Cleaner "
  ];
$vat_number = [
    "69065606033",
    "56227563472",
    "44175830173",
    "95589575658",
    "41024606886",
    "29299004756",
    "01085273853",
    "09696404185",
    "96086030852",
    "85942003447"
];
$address_company = [
    [
        "Street" => "Vico Giganti 29",
        "City" => "Ruino",
        "State" => "Pavia",
        "Phone number" => "03815456912",
        "Zip code" => "27040",
        "Country" => "Italy",
    ],

    [
        "Street" => "Via Varrone 68",
        "City" => "Aci San Filippo",
        "State" => "Catania",
        "Phone number" => "03968912657",
        "Zip code" => "95020",
        "Country" => "Italy",
    ],

    [
        "Street" => "Piazzetta Concordia 44",
        "City" => "San Martino Sinzano",
        "State" => "Parma",
        "Phone number" => "03257202891",
        "Zip code" => "43030",
        "Country" => "Italy",
    ],

    [
        "Street" => "Via Moiariello 71",
        "City" => "San Rocco Castagnaretta",
        "State" => "Cuneo",
        "Phone number" => "01877871818",
        "Zip code" => "12010",
        "Country" => "Italy",
    ],

    [
        "Street" => "Viale Augusto 48",
        "City" => "Borgagne",
        "State" => "Lecce",
        "Phone number" => "03531977957",
        "Zip code" => "73020",
        "Country" => "Italy",
    ],

    [
        "Street" => "Via Nicola Mignogna 17",
        "City" => "Scisciano",
        "State" => "Napoli",
        "Phone number" => "03922813912",
        "Zip code" => "80030",
        "Country" => "Italy",
    ]
];
$prod_name = [
    "Axiomnigh",
    "Blonderald",
    "Blowerih",
    "Chillee",
    "Dipitype",
    "Eatrolo",
    "Enjoymere",
    "Kuroravi",
    "Listfman",
    "Mindjeter",
    "Mindolet",
    "Panterme",
    "Plentylera",
    "Ravagar",
    "ReadApenguin",
    "Reallycu",
    "Reportsne",
    "SablinkScree",
    "Scantera",
    "Shoppel",
    "Signfie",
    "Strongerse",
    "SunsetPink",
    "Surfrie",
    "Surlagic",
    "TrickyCyber",
    "TruckSelf",
    "Untagere",
    "Wittype",
    "Yuirm",
];
$lorem = [
    "Cum dolorem delectus et odit excepturi qui praesentium odit aut voluptas atque ut eligendi quia et minus dicta est sunt assumenda!",
    "Hic sint maiores sit illum minus sit exercitationem unde. Ea modi omnis vel nulla neque et suscipit officiis sed voluptas placeat. Sit fugiat accusamus.",
    "Lorem ipsum dolor sit amet. Quo placeat totam aut facilis perferendis rem quis recusandae qui rerum exercitationem ut asperiores blanditiis.",
];
$imgs = [];
$prezzi = explode(" ", "65 110 74 166 224 294 59 36 247 143 113 230 196 31 31 247 10 228 233 113");
$sconti = explode(" ", "2 75 45 24 62 45 0 41 35 18 74 0 59 0 32 37 57 7 46 20");
$qtaMag = explode(" ", "435 345 200 101 389 252 42 391 9 132 490 134 493 149 117 481 336 265 16 424");
$categorie = explode(" ", "1 2 3 4");

foreach ($email as $value) {
    $idxcarta = rand(0, count($carte)-1);
    $res = $dbh->insertNewUser($carte[$idxcarta]["Card Holder"], array_pop($phone), "Via dell'Università 50, Cesena", $value, password_hash("12345Az,", PASSWORD_DEFAULT), $carte[$idxcarta]["Card Number"], $carte[$idxcarta]["Card Holder"], "01/" . $carte[$idxcarta]["Expire"]);
}

foreach ($vat_number as $value) {
    $idxindirizzo = rand(0, count($address_company)-1);
    $res = $dbh->insertNewCompany($brand_name[rand(0, count($brand_name)-1)], $value, $address_company[$idxindirizzo]["Phone number"], $address_company[$idxindirizzo]["Street"], $address_company[$idxindirizzo]["City"], $address_company[$idxindirizzo]["State"], $address_company[$idxindirizzo]["Zip code"], $address_company[$idxindirizzo]["Country"], array_pop($email), password_hash("12345Az,", PASSWORD_DEFAULT));

    for ($i=0; $i < rand(0,count($vat_number)); $i++) { 
        $res = $dbh->insertNewProduct(($i+1), $prod_name[rand(0, count($prod_name)-1)],$lorem[rand(0, count($lorem)-1)], "productsImg/cucina.png", $prezzi[rand(0, count($prezzi)-1)], $sconti[rand(0, count($sconti)-1)], $qtaMag[rand(0, count($qtaMag)-1)], null, $categorie[rand(0, count($categorie)-1)], true, $value);
    }
}

header("location:index.php");

?>