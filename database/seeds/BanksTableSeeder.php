<?php

use Illuminate\Database\Seeder;
use App\Models\Bank;

class BanksTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('banks')->delete();
        
        \DB::table('banks')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'BANCO CENTRAL DEL ECUADOR ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'BANCO PICHINCHA C.A. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            
            2 => 
            array (
                'id' => 3,
                'name' => 'BANCO DE GUAYAQUIL S.A ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'BANCO CITY BANK ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'BANCO MACHALA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'BANCO DE LOJA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'BANCO DEL PACIFICO ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'BANCO INTERNACIONAL ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'BANCO AMAZONAS ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'BANCO DEL AUSTRO ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            10 => 
            array (
                'id' => 11,
                'name' => 'PRODUBANCO / PROMERICA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            11 => 
            array (
                'id' => 12,
                'name' => 'BANCO BOLIVARIANO ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'name' => 'BANCO COMERCIAL DE MANABI ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'name' => 'BANCO GENERAL RUMINAHUI S.A. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'name' => 'BANCO DEL LITORAL S.A. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            15 => 
            array (
                'id' => 16,
                'name' => 'BANCO SOLIDARIO ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            16 => 
            array (
                'id' => 17,
                'name' => 'BANCO PROCREDIT S.A. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            17 => 
            array (
                'id' => 18,
                'name' => 'BANCO CAPITAL ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            18 => 
            array (
                'id' => 19,
                'name' => 'BANCO DESARROLLO DE LOS PUEBLOS S.A. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            19 => 
            array (
                'id' => 20,
                'name' => 'BANECUADOR B.P. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            20 => 
            array (
                'id' => 21,
                'name' => 'COOP. AHORRO Y CREDITO 15 DE ABRIL LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            21 => 
            array (
                'id' => 22,
                'name' => 'COOP. JARDIN AZUAYO ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            22 => 
            array (
                'id' => 23,
                'name' => 'COOP.DE AHORRO Y CREDITO POLICIA NACIONAL ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            23 => 
            array (
                'id' => 24,
                'name' => 'FINANCOOP ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            24 => 
            array (
                'id' => 25,
                'name' => 'BANCO DELBANK S.A. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            25 => 
            array (
                'id' => 26,
                'name' => 'BANCO ECUATORIANO DE LA VIVIENDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            26 => 
            array (
                'id' => 27,
                'name' => 'CACPECO LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            27 => 
            array (
                'id' => 28,
                'name' => 'C.PEQ.EMPRESA DE PASTAZA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            28 => 
            array (
                'id' => 29,
                'name' => 'COOP. AHORRO Y CREDITO 23 DE JULIO ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            29 => 
            array (
                'id' => 30,
                'name' => 'COOP. AHORRO Y CREDITO 29 DE OCTUBRE ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            30 => 
            array (
                'id' => 31,
                'name' => 'COOP. AHORRO Y CREDITO ANDALUCIA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            31 => 
            array (
                'id' => 32,
                'name' => 'COOP. AHORRO Y CREDITO COTOCOLLAO ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            32 => 
            array (
                'id' => 33,
                'name' => 'COOP. AHORRO Y CREDITO EL SAGRARIO ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            33 => 
            array (
                'id' => 34,
                'name' => 'COOP. AHORRO Y CREDITO GUARANDA LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            34 => 
            array (
                'id' => 35,
                'name' => 'COOP. JUVENTUD ECUATORIANA PROGRESISTA LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            35 => 
            array (
                'id' => 36,
                'name' => 'COOP. AHORRO Y CREDITO MANUEL ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            36 => 
            array (
                'id' => 37,
                'name' => 'COOP. AHORRO Y CREDITO OSCUS ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            37 => 
            array (
                'id' => 38,
                'name' => 'COOP. AHORRO Y CREDITO PABLO MUNOZ VEGA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            38 => 
            array (
                'id' => 39,
                'name' => 'COOP. AHORRO Y CREDITO PROGRESO ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            39 => 
            array (
                'id' => 40,
                'name' => 'COOP. AHORRO Y CREDITO RIOBAMBA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            40 => 
            array (
                'id' => 41,
                'name' => 'COOP. AHORRO Y CREDITO SAN FRANCISCO ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            41 => 
            array (
                'id' => 42,
                'name' => 'COOP. AHORRO Y CREDITO TULCAN ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            42 => 
            array (
                'id' => 43,
                'name' => 'COOP. DE AHORRO Y CREDITO ATUNTAQUI LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            43 => 
            array (
                'id' => 44,
                'name' => 'COOP. DE AHORRO Y CREDITO COMERCIO LTDA PORTOVIEJO ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            44 => 
            array (
                'id' => 45,
                'name' => 'COOP. DE AHORRO Y CREDITO LA DOLOROSA LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            45 => 
            array (
                'id' => 46,
                'name' => 'COOP. PREVISION AHORRO Y DESARROLLO ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            46 => 
            array (
                'id' => 47,
                'name' => 'COOP.AHORRO Y CREDITO ALIANZA DEL VALLE LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            47 => 
            array (
                'id' => 48,
                'name' => 'COOP AHORRO Y CREDITO CONSTRC COMERCIO Y PRODUC ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            48 => 
            array (
                'id' => 49,
                'name' => 'COOP.AHORRO Y CREDITO CHONE LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            49 => 
            array (
                'id' => 50,
                'name' => 'COOPERATIVA DE AHORRO Y CREDITO SANTA ANA LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            50 => 
            array (
                'id' => 51,
                'name' => 'FINANCIERA - DINERS CLUB DEL ECUADOR ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            51 => 
            array (
                'id' => 52,
                'name' => 'MUTUALISTA AMBATO ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            52 => 
            array (
                'id' => 53,
                'name' => 'MUTUALISTA AZUAY ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            53 => 
            array (
                'id' => 54,
                'name' => 'MUTUALISTA IMBABURA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            54 => 
            array (
                'id' => 55,
                'name' => 'MUTUALISTA PICHINCHA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            55 => 
            array (
                'id' => 56,
                'name' => 'COOP DE A. Y C. CORPORACION CENTRO LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            56 => 
            array (
                'id' => 57,
                'name' => 'COOP. DE A. Y C. CORDILLERA DE LOS ANDES LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            57 => 
            array (
                'id' => 58,
                'name' => 'COOP. DE A. Y C. PUERTO FRANCISCO DE ORELLANA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            58 => 
            array (
                'id' => 59,
                'name' => 'COOP. DE A Y C. LUZ DEL VALLE ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            59 => 
            array (
                'id' => 60,
                'name' => 'COOP. DE A Y C. ESPERANZA Y PROGRESO DEL VALLE ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            60 => 
            array (
                'id' => 61,
                'name' => 'COOP. DE A. Y C. CHOCO TUNGURAHUA RUNA LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            61 => 
            array (
                'id' => 62,
                'name' => 'COOP. DE A. Y C. COOPARTAMOS LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            62 => 
            array (
                'id' => 63,
                'name' => 'COOP. DE A. Y C. EMPRENDEDORES COOPEMPRENDER LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            63 => 
            array (
                'id' => 64,
                'name' => 'COOP. DE A. Y C. NUEVA LOJA LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            64 => 
            array (
                'id' => 65,
                'name' => 'COOP. DE A. Y C. PICHNCHA LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            65 => 
            array (
                'id' => 66,
                'name' => 'COOP. CREDITO Y AHORRO SAN FRANCISCO DE ASIS ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            66 => 
            array (
                'id' => 67,
            'name' => 'COOP.DE AHORRO Y CREDITO CACEC LTDA. (COTOPAXI) ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            67 => 
            array (
                'id' => 68,
                'name' => 'COOP.DE A. Y C. VENCEDORES DE PICHINCHA LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            68 => 
            array (
                'id' => 69,
                'name' => 'COOPERATIVA DE AHORRO Y CREDITO SAN BARTOLO LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            69 => 
            array (
                'id' => 70,
                'name' => 'COOP. DE A. Y C. DEL EMIGRANTE ECUATORIANO Y SU FA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            70 => 
            array (
                'id' => 71,
                'name' => 'COOP. AHORRO Y CREDITO LA LIBERTAD LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            71 => 
            array (
                'id' => 72,
                'name' => 'COAC CUNA DE LA NACIONALIDAD LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            72 => 
            array (
                'id' => 73,
                'name' => 'COOPERATIVA DE AHORRO Y CREDITO MACODES LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            73 => 
            array (
                'id' => 74,
                'name' => 'COOPERATIVA DE AHORRO Y CREDITO SANTA ISABEL LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            74 => 
            array (
                'id' => 75,
                'name' => 'COOPERATIVA DE AHORRO Y CREDITO GANANSOL LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            75 => 
            array (
                'id' => 76,
                'name' => 'COOPERATIVA DE AHORRO Y CREDITO DEL AZUAY ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            76 => 
            array (
                'id' => 77,
                'name' => 'COOPERATIVA DE AHORRO Y CREDITO DEL COLEGIO DE ARQ ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            77 => 
            array (
                'id' => 78,
                'name' => 'COOPERATIVA DE AHORRO Y CREDITO NUKANCHIK ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            78 => 
            array (
                'id' => 79,
                'name' => 'COOP DE AHORRO Y CREDITO SANTA ANA CUENCA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            79 => 
            array (
                'id' => 80,
                'name' => 'COOPERATIVA DE AHORRO Y CREDITO MULTIEMPRESARIAL L ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            80 => 
            array (
                'id' => 81,
                'name' => 'COAC DEL SINDICATO DE CHOFERES PROFESIONALES DEL A ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            81 => 
            array (
                'id' => 82,
                'name' => 'COOP. AHORRO Y CREDITO JUAN DE SALINAS LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            82 => 
            array (
                'id' => 83,
                'name' => 'COOP. AHORRO Y CREDITO PUELLARO LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            83 => 
            array (
                'id' => 84,
                'name' => 'COOP. AHORRO Y CREDITO NUEVA JERUSALEN ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            84 => 
            array (
                'id' => 85,
                'name' => 'COOP. AHORRO Y CREDITO MALCHINGUI LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            85 => 
            array (
                'id' => 86,
                'name' => 'COOP. DE AHORRO Y CREDITO CHOLA CUENCANA LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            86 => 
            array (
                'id' => 87,
                'name' => 'COOP. AHORRO Y CREDITO TENA LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            87 => 
            array (
                'id' => 88,
                'name' => 'COOP. AHORRO Y CREDITO DE LA PEQUENA EMPRESA GUALA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            88 => 
            array (
                'id' => 89,
                'name' => 'COOP. AHORRO Y CREDITO ALIANZA MINAS LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            89 => 
            array (
                'id' => 90,
                'name' => 'COOP. DE AHORRO Y CREDITO PEDRO MONCAYO LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            90 => 
            array (
                'id' => 91,
                'name' => 'COOPERATIVA DE AHORRO Y CREDITO PROVIDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            91 => 
            array (
                'id' => 92,
                'name' => 'COOPERATIVA DE AHORRO Y CREDITO SAN JOSE S.J. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            92 => 
            array (
                'id' => 93,
                'name' => 'COOP. AHORRO Y CREDITO SENOR DE GIRON ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            93 => 
            array (
                'id' => 94,
                'name' => 'COOP. DE AHORRO Y CREDITO EDUC.DEL TUNGURAHUA LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            94 => 
            array (
                'id' => 95,
                'name' => 'COOPERATIVA 15 DE AGOSTO PILACOTO ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            95 => 
            array (
                'id' => 96,
                'name' => 'COOP. DE AHORRO Y CREDITO CRISTO REY ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            96 => 
            array (
                'id' => 97,
                'name' => 'COOP. DE AHORRO Y CREDITO EDUCADORES DE CHIMBORAZO ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            97 => 
            array (
                'id' => 98,
                'name' => 'COOPERATIVA DE AHORRO Y CREDITO MINGA LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            98 => 
            array (
                'id' => 99,
                'name' => 'COOP. DE AHORRO Y CREDITO 4 DE OCTUBRE LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            99 => 
            array (
                'id' => 100,
                'name' => 'COOP. DE AHORRO Y CREDITO CREDI FACIL LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            100 => 
            array (
                'id' => 101,
                'name' => 'COOP. DE AHORRO Y CREDITO ALFONSO JARAMILLO C.C.C. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            101 => 
            array (
                'id' => 102,
                'name' => 'COOP. DE A. Y C. INDIGENA SAC PELILEO ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            102 => 
            array (
                'id' => 103,
                'name' => 'COOP. DE A. Y C. INTERCULTURAL TAWANTINSUYU LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            103 => 
            array (
                'id' => 104,
                'name' => 'COOP. DE A. Y C. OCIPSA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            104 => 
            array (
                'id' => 105,
                'name' => 'COOP. DE A. Y C. 21 DE NOVIEMBRE LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            105 => 
            array (
                'id' => 106,
                'name' => 'COOP. DE A. Y C. LA FLORESTA LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            106 => 
            array (
                'id' => 107,
                'name' => 'COOP. DE A. Y C. CORP. ORG. CAMPESINAS DE QUISAPIN ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            107 => 
            array (
                'id' => 108,
                'name' => 'COOP. DE A. Y C. MULTICULTURAL BANCO INDIGENA LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            108 => 
            array (
                'id' => 109,
                'name' => 'COOP DE A. Y C. CRECER WINARI LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            109 => 
            array (
                'id' => 110,
                'name' => 'COOP. DE A. Y C. BANOS DE AGUA SANTA LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            110 => 
            array (
                'id' => 111,
                'name' => 'COOP. DE AHORRO Y CREDITO 1 DE JULIO ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            111 => 
            array (
                'id' => 112,
                'name' => 'COOP. DE A. Y C. SUMAK NAN LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            112 => 
            array (
                'id' => 113,
                'name' => 'COOPERATIVA DE AHORRO Y CREDITO CANAR LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            113 => 
            array (
                'id' => 114,
                'name' => 'COOPERATIVA DE AHORRO Y CREDITO SAN ANTONIO LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            114 => 
            array (
                'id' => 115,
                'name' => 'COOP. DE AHORRO Y CREDITO FUNDAR ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            115 => 
            array (
                'id' => 116,
                'name' => 'COOP. AHORRO Y CREDITO METROPOLIS LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            116 => 
            array (
                'id' => 117,
                'name' => 'COOP. DE AHORRO Y CREDITO EL CAFETAL ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            117 => 
            array (
                'id' => 118,
                'name' => 'COOP.DE AHORRO Y CREDITO MICROEMPRESARIAL SUCRE ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            118 => 
            array (
                'id' => 119,
                'name' => 'COOP. DE A. Y C. AFROECUATORIANA DE LA PEQ. EMP. L ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            119 => 
            array (
                'id' => 120,
                'name' => 'COOPERATIVA DE AHORRO Y CREDITO JOYOCOTO LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            120 => 
            array (
                'id' => 121,
                'name' => 'COOP. AHORRO Y CREDITO SAN ANTONIO LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            121 => 
            array (
                'id' => 122,
                'name' => 'COOP. DE A. Y C. UNIOTAVALO LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            122 => 
            array (
                'id' => 123,
                'name' => 'COOP. DE A. Y C. UNION EL EJIDO ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            123 => 
            array (
                'id' => 124,
                'name' => 'COOP. DE A. Y C. GENESIS LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            124 => 
            array (
                'id' => 125,
                'name' => 'COOP. DE A Y C. MARIA AUXILIADORA DE QUIROGA LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            125 => 
            array (
                'id' => 126,
                'name' => 'COOP. DE A. Y C. FORTALEZA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            126 => 
            array (
                'id' => 127,
                'name' => 'BANCO PARA LA ASISTENCIA COMUNITARIA FINCA S.A. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            127 => 
            array (
                'id' => 128,
                'name' => 'COOP. CALCETA LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            128 => 
            array (
                'id' => 129,
                'name' => 'COOP. AHORRO Y CREDITO 9 DE OCTUBRE LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            129 => 
            array (
                'id' => 130,
                'name' => 'COOP. AHORRO Y CREDITO D LA PEQ EMPR CACPE BIBLIAN ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            130 => 
            array (
                'id' => 131,
                'name' => 'COOP. AHORRO Y CREDITO SAN GABRIEL LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            131 => 
            array (
                'id' => 132,
                'name' => 'COOP. AHORRO Y CREDITO SAN JOSE LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            132 => 
            array (
                'id' => 133,
                'name' => 'COOP. AHORRO Y CREDITO SAN MIGUEL DE LOS BANCOS ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            133 => 
            array (
                'id' => 134,
                'name' => 'COOP. AHORRO Y CREDITO SEMILLA DEL PROGRESO LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            134 => 
            array (
                'id' => 135,
                'name' => 'COOP. AHORRO. Y CREDI. MUJERES UNIDAS TANTANAKUSHK ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            135 => 
            array (
                'id' => 136,
                'name' => 'COOP. DE AHORRO Y CRED. SANTA ROSA LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            136 => 
            array (
                'id' => 137,
                'name' => 'COOP. DE AHORRO Y CREDITO ONCE DE JUNIO ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            137 => 
            array (
                'id' => 138,
                'name' => 'COOP. DE A. Y C. PUJILI LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            138 => 
            array (
                'id' => 139,
                'name' => 'COOP. DE A. Y C. CREDIL LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            139 => 
            array (
                'id' => 140,
                'name' => 'COOP. DE A. Y C. MUSHUK PAKARI LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            140 => 
            array (
                'id' => 141,
                'name' => 'COOP. DE A. Y C. UNIBLOCK Y SERVICIOS LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            141 => 
            array (
                'id' => 142,
                'name' => 'COOP. DE A. Y C. SAN FERNANDO LIMITADA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            142 => 
            array (
                'id' => 143,
                'name' => 'COOP. DE A. Y C. FUTURO LAMANENSE ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            143 => 
            array (
                'id' => 144,
                'name' => 'COOP. DE A. Y C. SAQUISILI LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            144 => 
            array (
                'id' => 145,
                'name' => 'COOP. DE A. Y C. INNOVACION ANDINA LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            145 => 
            array (
                'id' => 146,
            'name' => 'COOP.DE A.Y C. EL COMERCIANTE LTDA (MIES) ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            146 => 
            array (
                'id' => 147,
            'name' => 'COOP. DE A. Y C. MUSHUK WASI LTDA ( MIES ) ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            147 => 
            array (
                'id' => 148,
                'name' => 'COOPERATIVA DE AHORRO Y CREDITO SOLIDARIA LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            148 => 
            array (
                'id' => 149,
                'name' => 'COOPERATIVA DE AHORRO Y CREDITO LLANGANATES ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            149 => 
            array (
                'id' => 150,
                'name' => 'INTERDIN S.A. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            150 => 
            array (
                'id' => 151,
                'name' => 'COOP.AHO Y CREDITO DE LA PEQ. EMP. DE LOJA CACPE ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            151 => 
            array (
                'id' => 152,
                'name' => 'COOPERATIVA DE AHORRO Y CREDITO ECONOMIA DEL SUR C ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            152 => 
            array (
                'id' => 153,
                'name' => 'COOPERATIVA DE AHORRO Y CREDITO MIGRANTES Y EMPREN ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            153 => 
            array (
                'id' => 154,
                'name' => 'COOPERATIVA DE AHORRO Y CREDITO SAN SEBASTIAN ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            154 => 
            array (
                'id' => 155,
                'name' => 'COOP. DE A. Y C. DEL SINDICATO DE CHOFERES PROFESI ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            155 => 
            array (
                'id' => 156,
                'name' => 'COOP.DE AHORRO Y CREDITO 29 DE ENERO ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            156 => 
            array (
                'id' => 157,
                'name' => 'COOP. AHORRO Y CREDITO AGRARIA MUSHUK KAWSAY LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            157 => 
            array (
                'id' => 158,
                'name' => 'COOPERATIVA DE AHORRO Y CREDITO RUNA SHUNGO LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            158 => 
            array (
                'id' => 159,
                'name' => 'COOP. DE A. Y C. SAN MARCOS ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            159 => 
            array (
                'id' => 160,
                'name' => 'COOP. DE A. Y C. ANTORCHA LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            160 => 
            array (
                'id' => 161,
                'name' => 'COOPERATIVA DE AHORRO Y CREDITO SOCIO AMIGO ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            161 => 
            array (
                'id' => 162,
                'name' => 'COOP. DE A. Y C. INDIGENAS GALAPAGOS LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            162 => 
            array (
                'id' => 163,
                'name' => 'COOP. AHORRO Y CREDITO CAMARA DE COMERCIO DEL CANT ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            163 => 
            array (
                'id' => 164,
                'name' => 'COOPERATIVA DE AHORRO Y CREDITO LA BENEFICA LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            164 => 
            array (
                'id' => 165,
                'name' => 'COOP.DE AHORRO Y CREDITO ABDON CALDERON LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            165 => 
            array (
                'id' => 166,
                'name' => 'COOP. A Y C CAMARA DE COMERCIO CANTON -EL CARMEN L ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            166 => 
            array (
                'id' => 167,
                'name' => 'COOP.DE AHORRO Y CREDITO AGROPRODUCTIVA MANABI LTD ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            167 => 
            array (
                'id' => 168,
                'name' => 'COOP. DE AHORRO Y CRED. LA INMACULADA DE SAN PLACI ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            168 => 
            array (
                'id' => 169,
                'name' => 'COOP. AHORRO Y CREDITO CACPE MANABI ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            169 => 
            array (
                'id' => 170,
                'name' => 'COOP.AHORRO Y CREDITO MAGISTERIO MANABITA LIMITADA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            170 => 
            array (
                'id' => 171,
                'name' => 'COAC TIENDA DE DINERO LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            171 => 
            array (
                'id' => 172,
                'name' => 'COOP.A.Y C. SANTA MARIA DE LA MANGA DEL CURA LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            172 => 
            array (
                'id' => 173,
                'name' => 'COOP. AHORRO Y CREDITO CAMARA DE COMERCIO INDIGENA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            173 => 
            array (
                'id' => 174,
                'name' => 'COOP. DE A. Y C. GUAMOTE LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            174 => 
            array (
                'id' => 175,
                'name' => 'COOP. DE A.Y C. PRODUC. AHORRO INVERS. SERVICIO P. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            175 => 
            array (
                'id' => 176,
                'name' => 'COOP. DE A. Y C. FRANDESC LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            176 => 
            array (
                'id' => 177,
                'name' => 'COOP. DE A. Y C. NUKA LLAKTA LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            177 => 
            array (
                'id' => 178,
                'name' => 'COOP. DE A Y C. CAMARA DE COMERCIO RIOBAMBA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            178 => 
            array (
                'id' => 179,
                'name' => 'COOP. DE A. Y C. BASHALAN LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            179 => 
            array (
                'id' => 180,
                'name' => 'COOP. DE A. Y C. CAMARA DE COMERCIO SANTO DOMINGO ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            180 => 
            array (
                'id' => 181,
                'name' => 'COOP. DE A. Y C. EDUCADORES TULCAN LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            181 => 
            array (
                'id' => 182,
                'name' => 'COOP. WARMIKUNAPAK RIKCHARI ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            182 => 
            array (
                'id' => 183,
                'name' => 'COOP AHORRO Y CREDITO MI TIERRA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            183 => 
            array (
                'id' => 184,
                'name' => 'COOP AHORRO Y CREDITO DE LA PEQ EMP CACPE YANZATZA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            184 => 
            array (
                'id' => 185,
                'name' => 'COOP AHORRO Y CREDITO FUNDESARROLLO ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            185 => 
            array (
                'id' => 186,
                'name' => 'CAJA ECUAESPANA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            186 => 
            array (
                'id' => 187,
                'name' => 'COOP DE AHORRO Y CREDITO NUEVA HUANCAVILCA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            187 => 
            array (
                'id' => 188,
                'name' => 'COOP DE AHORRO Y CREDITO ERCO LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            188 => 
            array (
                'id' => 189,
                'name' => 'COOP  AHORRO Y CREDITO CAMARA COMERCIO DE AMBATO ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            189 => 
            array (
                'id' => 190,
                'name' => 'COOP AHORRO Y CREDITO MUSHUC RUNA LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            190 => 
            array (
                'id' => 191,
                'name' => 'COOP DE AHORRO Y CREDITO AMBATO LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            191 => 
            array (
                'id' => 192,
                'name' => 'COOP DE AHORRO Y CREDITO DORADO LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            192 => 
            array (
                'id' => 193,
                'name' => 'COOP DE AHORRO Y CREDITO NUESTROS ABUELOS LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            193 => 
            array (
                'id' => 194,
                'name' => 'COOP DE AHORRO Y CREDITO ARTESANOS  LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            194 => 
            array (
                'id' => 195,
                'name' => 'COOP DE AHORRO Y CREDITO SANTA ANITA LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            195 => 
            array (
                'id' => 196,
                'name' => 'COOP DE AHORRO Y CREDITO HUAYCO PUNGO LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            196 => 
            array (
                'id' => 197,
                'name' => 'COOP MANUEL ESTEBAN GODOY ORTEGA LTDA COOPMEGO ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            197 => 
            array (
                'id' => 198,
                'name' => 'COOP AHORRO Y CREDITO PADRE JULIAN LORENTE LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            198 => 
            array (
                'id' => 199,
                'name' => 'COOP AHORRO Y CREDITO CARIAMANGA LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            199 => 
            array (
                'id' => 200,
                'name' => 'COOP DE AHORRO Y CREDITO MARCABELI LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            200 => 
            array (
                'id' => 201,
                'name' => 'COOP DE AHORRO Y CREDITO AGRICOLA JUNIN LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            201 => 
            array (
                'id' => 202,
                'name' => 'COOP DE AHORRO Y CREDITO PUERTO LOPEZ LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            202 => 
            array (
                'id' => 203,
                'name' => 'COOP DE AHORRO Y CREDITO NUEVA ESPERANZA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            203 => 
            array (
                'id' => 204,
                'name' => 'COOP DE AHORRO Y CREDITO SAN JORGE LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            204 => 
            array (
                'id' => 205,
                'name' => 'COOP DE AHORRO Y CREDITO FERNANDO DAQUILEMA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            205 => 
            array (
                'id' => 206,
                'name' => 'COOP DE A Y C EDUCADORES DE PASTAZA LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            206 => 
            array (
                'id' => 207,
                'name' => 'COOP. A. Y C. DE LA PEQ. EMP. CACPE ZAMORA LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            207 => 
            array (
                'id' => 208,
                'name' => 'COOP. DE A. Y C. DESARROLLO INTEGRAL LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            208 => 
            array (
                'id' => 209,
                'name' => 'COOP. DE AHORRO Y CREDITO EL CALVARIO LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            209 => 
            array (
                'id' => 210,
                'name' => 'COOP. DE A. Y C. JUAN PIO DE MORA LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            210 => 
            array (
                'id' => 211,
                'name' => 'COOP. DE AHORRO Y CREDITO PILAHUIN ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            211 => 
            array (
                'id' => 212,
                'name' => 'COOP. DE AHORRO Y CREDITO PUCARA LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            212 => 
            array (
                'id' => 213,
                'name' => 'COOP. A. Y C. CAMARA DE COMERCIO DE PINDAL CADECOP ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            213 => 
            array (
                'id' => 214,
                'name' => 'BANCO DEL INSTITU ECUATORIANO DE SEGURIDAD SOCIAL ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            214 => 
            array (
                'id' => 215,
                'name' => 'COOP DE A Y C DE SERV PUBL DEL MIN EDUCACION Y CUL ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            215 => 
            array (
                'id' => 216,
                'name' => 'COOP DE A Y C 23 DE MAYO LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            216 => 
            array (
                'id' => 217,
                'name' => 'COOP DE A Y C COCA LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            217 => 
            array (
                'id' => 218,
                'name' => 'COOP DE AHORRO Y CREDITO PILAHUIN TIO LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            218 => 
            array (
                'id' => 219,
                'name' => 'COOP DE AHORRO Y CREDITO HUAICANA LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            219 => 
            array (
                'id' => 220,
                'name' => 'COOP DE A Y C CREDISUR LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            220 => 
            array (
                'id' => 221,
                'name' => 'FONDO DE CESANTIA DEL MAGISTERIO ECUAT FCME-FCPC ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            221 => 
            array (
                'id' => 222,
                'name' => 'COOP DE AHORRO Y CREDITO HUAQUILLAS LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            222 => 
            array (
                'id' => 223,
                'name' => 'COOP DE A Y C BANOS LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            223 => 
            array (
                'id' => 224,
                'name' => 'COOP DE AHORRO Y CREDITO CAC-CICA MIES ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            224 => 
            array (
                'id' => 225,
                'name' => 'COOP DE A Y C VENCEDORES DE TUNGURAHUA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            225 => 
            array (
                'id' => 226,
                'name' => 'COOP A Y C ECUAFUTURO LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            226 => 
            array (
                'id' => 227,
                'name' => 'COOP DE A Y C MAQUITA CUSHUN LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            227 => 
            array (
                'id' => 228,
                'name' => 'COOP DE A Y C VALLES DEL LIRIO ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            228 => 
            array (
                'id' => 229,
                'name' => 'COOP ESFUERZO UNIDO PARA EL DESARR DEL CHILCO ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            229 => 
            array (
                'id' => 230,
                'name' => 'COOP A Y C CARROCEROS DE TUNGURAHUA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            230 => 
            array (
                'id' => 231,
                'name' => 'COOP DE AHORRO Y CREDITO SIMIATUG LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            231 => 
            array (
                'id' => 232,
                'name' => 'COOP DE A Y C SINCHI RUNA LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            232 => 
            array (
                'id' => 233,
                'name' => 'COOP DE A Y C SANTA ROSA DE PAUTAN LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            233 => 
            array (
                'id' => 234,
                'name' => 'COOP DE AHORRO Y CREDITO SAN MIGUEL DE SIGCHOS ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            234 => 
            array (
                'id' => 235,
                'name' => 'COOP DE A Y C SIERRA CENTRO LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            235 => 
            array (
                'id' => 236,
                'name' => 'COOP DE A Y C GONZANAMA MIES ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            236 => 
            array (
                'id' => 237,
                'name' => 'COOP DE AHORRO Y CREDITO QUILANGA LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            237 => 
            array (
                'id' => 238,
                'name' => 'COOP DE AHORRO Y CREDITO 27 DE ABRIL LOJA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            238 => 
            array (
                'id' => 239,
                'name' => 'COOP DE A Y C CREDIAMIGO LTDA LOJA MIES ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            239 => 
            array (
                'id' => 240,
                'name' => 'COOP DE AHORRO Y CREDITO FORTUNA MIES ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            240 => 
            array (
                'id' => 241,
                'name' => 'COOP A Y C PROFESIONALES DEL VOLANTE UNION LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            241 => 
            array (
                'id' => 242,
                'name' => 'COOP DE AHORRO Y CREDITO CACPE CELICA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            242 => 
            array (
                'id' => 243,
                'name' => 'COOP DE A Y C FUTURO Y PROGRESO DE GALAPAGOS LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            243 => 
            array (
                'id' => 244,
                'name' => 'COOP DE A Y C SUMAC LLACTA LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            244 => 
            array (
                'id' => 245,
                'name' => 'COOP DE A Y C LUCHA CAMPESINA LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            245 => 
            array (
                'id' => 246,
                'name' => 'COOP DE A Y C MAQUITA CUSHUNCHIC LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            246 => 
            array (
                'id' => 247,
                'name' => 'COOP A Y C FOCLA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            247 => 
            array (
                'id' => 248,
                'name' => 'COOP DE A Y C CASAG LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            248 => 
            array (
                'id' => 249,
                'name' => 'BANCO D MIRO SA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            249 => 
            array (
                'id' => 250,
                'name' => 'COOP DE A Y C GENERAL RUMINAHUI ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            250 => 
            array (
                'id' => 251,
                'name' => 'COOP DE A Y C FINANCIERA INDIGENA LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            251 => 
            array (
                'id' => 252,
                'name' => 'COOP A Y C 20 FEBRERO LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            252 => 
            array (
                'id' => 253,
                'name' => 'COOP DE A Y C  DEL COL. FISC. VICENTE ROCAFUERTE ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            253 => 
            array (
                'id' => 254,
            'name' => 'COOP DE A Y C JADAN LTDA (MIES) ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            254 => 
            array (
                'id' => 255,
                'name' => 'COOP DE A Y C INKA KIPU LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            255 => 
            array (
                'id' => 256,
                'name' => 'COOP DE A Y C ACCION TUNGURAHUA LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            256 => 
            array (
                'id' => 257,
                'name' => 'COOP DE A Y C PIJAL ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            257 => 
            array (
                'id' => 258,
                'name' => 'COOP DE A Y C ESCENCIA INDIGENA LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            258 => 
            array (
                'id' => 259,
                'name' => 'COOP DE A Y C UNION MERCEDARIA LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            259 => 
            array (
                'id' => 260,
                'name' => 'COOP DE A Y C CATAMAYO LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            260 => 
            array (
                'id' => 261,
                'name' => 'COOP DE A Y C DE LA PEQ EMPRESA CACPE MACARA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            261 => 
            array (
                'id' => 262,
                'name' => 'COOP A Y C NUEVOS HORIZONTES EL ORO LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            262 => 
            array (
                'id' => 263,
                'name' => 'BANCO COOPNACIONAL SA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            263 => 
            array (
                'id' => 264,
                'name' => 'COOP DE A Y C 16 DE JUNIO ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            264 => 
            array (
                'id' => 265,
                'name' => 'COOP A Y C ESC SUP POLITEC AGROP DE MANABI MANUEL ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            265 => 
            array (
                'id' => 266,
                'name' => 'COOP DE AHORRO Y CREDITO FASAYNAN LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            266 => 
            array (
                'id' => 267,
                'name' => 'COOP CACIQUE GURITAVE ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            267 => 
            array (
                'id' => 268,
                'name' => 'COOP SOLIDARIDAD Y PROGRESO ORIENTAL ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            268 => 
            array (
                'id' => 269,
                'name' => 'COOP. DE AHO Y CRED LOS ANDES LATINOS LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            269 => 
            array (
                'id' => 270,
            'name' => 'C. DE A. Y C COOPAC AUSTRO LTDA (MIESS) ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            270 => 
            array (
                'id' => 271,
                'name' => 'COOP. DE A. Y C. SALASACA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            271 => 
            array (
                'id' => 272,
                'name' => 'COOP. DE A. Y C. SUMAK SAMY LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            272 => 
            array (
                'id' => 273,
                'name' => 'C.  A. Y C. INTERCULT. TARPUK RUNA LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            273 => 
            array (
                'id' => 274,
                'name' => 'COOP. DE A. Y C. VIRGEN DEL CISNE ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            274 => 
            array (
                'id' => 275,
                'name' => 'C. DE A Y C EDUCAD. DE ZAMORA CHINCHIPE ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            275 => 
            array (
                'id' => 276,
            'name' => 'C. DE AH. Y CREDITO LAS LAGUNAS (MIESS) ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            276 => 
            array (
                'id' => 277,
                'name' => 'C. DE A Y C. EDUCADORES DE EL ORO LTD ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            277 => 
            array (
                'id' => 278,
                'name' => 'C  DE A Y C EMPLEAD BANCAR DEL ORO LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            278 => 
            array (
                'id' => 279,
                'name' => 'COOPERATIVA DE AH. Y CREDITO RIOCHICO ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            279 => 
            array (
                'id' => 280,
                'name' => 'C. DE A. Y C. SAN MARTIN DE TISALEO LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            280 => 
            array (
                'id' => 281,
                'name' => 'COOP. DE A. Y C. ALLI TARPUC LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            281 => 
            array (
                'id' => 282,
                'name' => 'C. DE A Y C. SAN MIGUEL DE PALLATANGA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            282 => 
            array (
                'id' => 283,
                'name' => 'COOP DE A Y C FENIX ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            283 => 
            array (
                'id' => 284,
                'name' => 'COOP.DE AHORRO Y CREDITO CAMARA DE COMERCIO DE LOJ ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            284 => 
            array (
                'id' => 285,
                'name' => 'COOP.DE A. Y C. DE CRECIMIENTO ECONOMICO RENTABLE ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            285 => 
            array (
                'id' => 286,
                'name' => 'COOPERATIVA DE AHORRO Y CREDITO SANTIAGO LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            286 => 
            array (
                'id' => 287,
                'name' => 'COOP.DE A. Y C. POPULAR Y SOLIDARIA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            287 => 
            array (
                'id' => 288,
                'name' => 'COOP.DE AHORRO Y CREDITO SAN PLACIDO LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            288 => 
            array (
                'id' => 289,
                'name' => 'COOP.DE AHORRO Y CREDITO CIUDAD DE ZAMORA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            289 => 
            array (
                'id' => 290,
                'name' => 'COOP. DE A Y C DE LA PEQUENA EMPRESA DE PALORA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            290 => 
            array (
                'id' => 291,
                'name' => 'COOP. DE A. Y C. INDIGENA ALFA Y OMEGA LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            291 => 
            array (
                'id' => 292,
            'name' => 'COOPERATIVA DE AHORRO Y CREDITO CREA LTDA ( MIES) ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            292 => 
            array (
                'id' => 293,
                'name' => 'COOP. DE A. Y C. CHIBULEO LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            293 => 
            array (
                'id' => 294,
                'name' => 'COOP. DE A. Y C. EL TESORO PILLARENO ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            294 => 
            array (
                'id' => 295,
                'name' => 'COOP. DE A. Y C. KISAPINCHA LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            295 => 
            array (
                'id' => 296,
                'name' => 'COOP. DE A. Y C. JUVENTUD UNIDA LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            296 => 
            array (
                'id' => 297,
                'name' => 'COOP. DE A. Y C. UNION QUISAPINCHA LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            297 => 
            array (
                'id' => 298,
                'name' => 'COOP. DE A. Y C. 13 DE ABRIL LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            298 => 
            array (
                'id' => 299,
                'name' => 'COOP. DE A. Y C. SALINAS LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            299 => 
            array (
                'id' => 300,
                'name' => 'COOP. DE A. Y C. SAN PEDRO LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            300 => 
            array (
                'id' => 301,
                'name' => 'COOP. DE A. Y C. LOS CHASQUIS PASTOCALLE LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            301 => 
            array (
                'id' => 302,
                'name' => 'COOP. DE A. Y C. COOPINDIGENA LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            302 => 
            array (
                'id' => 303,
                'name' => 'COOP. DE A. Y C. LA UNION LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            303 => 
            array (
                'id' => 304,
                'name' => 'COOP. DE A. Y C. PADRE VICENTE PONCE RUBIO ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            304 => 
            array (
                'id' => 305,
                'name' => 'COOP. DE A. Y C. MUSHUG CAUSAY LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            305 => 
            array (
                'id' => 306,
                'name' => 'COOP. DE A. Y C. 29 DE AGOSTO ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            306 => 
            array (
                'id' => 307,
                'name' => 'COOP. DE A. Y C. CREDISOCIO ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            307 => 
            array (
                'id' => 308,
                'name' => 'COOP. DE A. Y C. FONDO PARA EL DESARROLLO Y LA VID ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            308 => 
            array (
                'id' => 309,
                'name' => 'COOPERATIVA DE A Y C NUEVA VISION ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            309 => 
            array (
                'id' => 310,
                'name' => 'COOP. DE AHORRO Y CREDITO FOCASH LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            310 => 
            array (
                'id' => 311,
                'name' => 'COOP. DE A. Y C. SAN VICENTE DEL SUR LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            311 => 
            array (
                'id' => 312,
                'name' => 'COOP. DE A. Y C. PARA LA VIVIENDA ORDEN Y SEGURIDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            312 => 
            array (
                'id' => 313,
                'name' => 'COOP DE A. Y C. CAMARA DE COMERCIO JOYA DE LOS SAC ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            313 => 
            array (
                'id' => 314,
                'name' => 'COOP. DE A. Y C. FOCAP ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            314 => 
            array (
                'id' => 315,
                'name' => 'COOP. DE A. Y C. 18 DE NOVIEMBRE ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            315 => 
            array (
                'id' => 316,
                'name' => 'COOPERATIVA DE AHORRO Y CREDITO DR. CORNELIO SAENZ ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            316 => 
            array (
                'id' => 317,
                'name' => 'COOP DE A. Y C. EDUCADORES DEL AZUAY ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            317 => 
            array (
                'id' => 318,
                'name' => 'COOP. DE A. Y C. INDIGENA SAC LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            318 => 
            array (
                'id' => 319,
                'name' => 'COOP. DE A. Y C. CREDI YA LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            319 => 
            array (
                'id' => 320,
                'name' => 'COOP. DE A. Y C. SAN BARTOLOME LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            320 => 
            array (
                'id' => 321,
                'name' => 'COOP. DE AHORRO Y CREDITO MUSHUK YUYAY ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            321 => 
            array (
                'id' => 322,
                'name' => 'COOP DE A. Y C. SISAY KANARI ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            322 => 
            array (
                'id' => 323,
                'name' => 'COOPERATIVA DE A Y C ACCION IMBABURAPAK LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            323 => 
            array (
                'id' => 324,
                'name' => 'COOP DE A. Y C. HERMES GAIBOR VERDESOTO ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            324 => 
            array (
                'id' => 325,
                'name' => 'COOP. DE A. Y C. SEMILLAS DE PANGUA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            325 => 
            array (
                'id' => 326,
                'name' => 'COOPERATIVA DE A Y C MUSHUK SOLIDARIA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            326 => 
            array (
                'id' => 327,
                'name' => 'COOP DE A. Y C. PANAMERICANA LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            327 => 
            array (
                'id' => 328,
                'name' => 'COOP. DE A. Y C. VILCABAMBA CACVIL ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            328 => 
            array (
                'id' => 329,
                'name' => 'COOP. DE A. Y C. FAMILIA SOLIDARIA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            329 => 
            array (
                'id' => 330,
                'name' => 'COOPERATIVA DE AHORRO Y CREDITO EL PARAISO MANGA D ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            330 => 
            array (
                'id' => 331,
                'name' => 'COAC DE LOS PROFESORES EMPLEADOS Y TRABAJADORES DE ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            331 => 
            array (
                'id' => 332,
                'name' => 'COAC. SANTA ROSA DE SAN CARLOS LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            332 => 
            array (
                'id' => 333,
                'name' => 'COOP. DE A. Y C. CONSTRUCTOR DEL DESARROLLO SOLIDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            333 => 
            array (
                'id' => 334,
                'name' => 'COOP DE A. Y C. MUSHUK YUYAY LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            334 => 
            array (
                'id' => 335,
                'name' => 'CORPORACION FINANCIERA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            335 => 
            array (
                'id' => 336,
                'name' => 'COOP. DE A. Y C. ALIANZA SOCIAL ECU. ALSEC ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            336 => 
            array (
                'id' => 337,
                'name' => 'COOP. DE A. Y C. RENOVADORA ECU ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            337 => 
            array (
                'id' => 338,
                'name' => 'COOP. DE A. Y C. MUSHUK YUYAY - NAPO ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            338 => 
            array (
                'id' => 339,
                'name' => 'COOP. DE A. Y C. SANTA ANA DE NAYON ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            339 => 
            array (
                'id' => 340,
                'name' => 'COOP. DE A. Y C. EDUCADORES DEL NAPO ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            340 => 
            array (
                'id' => 341,
                'name' => 'COOPERATIVA DE A. Y C. TEXTIL 14 DE MARZO ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            341 => 
            array (
                'id' => 342,
                'name' => 'COOP. DE A Y C SAN CARLOS LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            342 => 
            array (
                'id' => 343,
                'name' => 'COAC A Y C ESPERANZA DE VALLE DE LA VIRGEN LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            343 => 
            array (
                'id' => 344,
                'name' => 'COAC A Y C ZONA DE CAPITAL CORCIMOL ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            344 => 
            array (
                'id' => 345,
                'name' => 'COOP.DE A. Y C. ARTESANAL DEL AZUAY ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            345 => 
            array (
                'id' => 346,
                'name' => 'COOPERATIVA DE AHORRO Y CREDITO SUMAK SISA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            346 => 
            array (
                'id' => 347,
                'name' => 'COOP. DE A. Y C. REY DAVID LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            347 => 
            array (
                'id' => 348,
                'name' => 'COOP. DE A. Y C. KULLKI WASI LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            348 => 
            array (
                'id' => 349,
                'name' => 'COOP DE A. Y C. SINCHI CODEFIS ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            349 => 
            array (
                'id' => 350,
                'name' => 'COOP. DE A. Y C. FUERZA DE LOS ANDES ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            350 => 
            array (
                'id' => 351,
                'name' => 'COOP DE A. Y C. CAMINO DE LUZ LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            351 => 
            array (
                'id' => 352,
                'name' => 'COAC A Y C EDUCADORES DE BOLIVAR ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            352 => 
            array (
                'id' => 353,
                'name' => 'COAC SAN MIGUEL LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            353 => 
            array (
                'id' => 354,
                'name' => 'COOP. DE A. Y C. SALINERITA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            354 => 
            array (
                'id' => 355,
                'name' => 'COOP. DE A. Y C. BOLA AMARILLA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            355 => 
            array (
                'id' => 356,
                'name' => 'COOP A Y C VISION DE LOS ANDES VISANDES ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            356 => 
            array (
                'id' => 357,
                'name' => 'COOP. DE A. Y C. SENOR DEL ARBOL ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            357 => 
            array (
                'id' => 358,
                'name' => 'COOP. DE A. Y C. CAMARA DE COMERCIO DE LA MANA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            358 => 
            array (
                'id' => 359,
                'name' => 'COOP DE A. Y C. EDUCADORES DE LOJA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            359 => 
            array (
                'id' => 360,
                'name' => 'COOP DE A. Y C. INDIGENA SAC LATACUNGA LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            360 => 
            array (
                'id' => 361,
                'name' => 'COOP DE A.Y C. CADECOG GONZANAMA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            361 => 
            array (
                'id' => 362,
                'name' => 'COAC COOPYMEC MACARA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            362 => 
            array (
                'id' => 363,
                'name' => 'COAC CADECOM  MACARA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            363 => 
            array (
                'id' => 364,
                'name' => 'COOP DE A. Y C. 22 DE JUNIO-ORIANGA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            364 => 
            array (
                'id' => 365,
                'name' => 'COOP. A.YC.SAGRADA FAMILIA SOLIDARIDAD ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            365 => 
            array (
                'id' => 366,
                'name' => 'COOP. DE A. Y C. NAUPA KAUSAY ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            366 => 
            array (
                'id' => 367,
                'name' => 'CCOP A Y C DE APECAP CAC APECAP ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            367 => 
            array (
                'id' => 368,
                'name' => 'COOP DE A. Y C. SAN JUAN DE COTOGCHOA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            368 => 
            array (
                'id' => 369,
                'name' => 'COOP DE AHORRO Y CREDITO LA MERCED ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            369 => 
            array (
                'id' => 370,
                'name' => 'COOP. DE A. Y C. COOPTOPAXI LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            370 => 
            array (
                'id' => 371,
                'name' => 'COOP. DE A. Y C. GRAMEEN AMAZONAS ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            371 => 
            array (
                'id' => 372,
                'name' => 'COOP. DE A. Y C. EL TRANSPORTISTA CACET ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            372 => 
            array (
                'id' => 373,
                'name' => 'COOP. DE A Y C. SERVIDORES MUNICIPALES DE CUENCA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            373 => 
            array (
                'id' => 374,
                'name' => 'COOP. DE AHORRO Y CREDITO PROFUTURO LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            374 => 
            array (
                'id' => 375,
                'name' => 'COOP. DE A. Y C. ILINIZA LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            375 => 
            array (
                'id' => 376,
                'name' => 'COOP. DE AHORRO Y CREDITO SARAGUROS ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            376 => 
            array (
                'id' => 377,
                'name' => 'COOPERATIVA DE AHORRO Y CREDITO INTI WASI LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            377 => 
            array (
                'id' => 378,
                'name' => 'COOPERATIVA DE AHORRO Y CREDITO SAN ISIDRO LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            378 => 
            array (
                'id' => 379,
                'name' => 'COOP. DE A. Y C. EMPRESAS COMUNITARIAS COOCREDITO ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            379 => 
            array (
                'id' => 380,
                'name' => 'SILVERCROSS S.A CASA DE VALORES SCCV ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            380 => 
            array (
                'id' => 381,
                'name' => 'REAL CASA DE VALORES DE GUAYAQUIL S.A. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            381 => 
            array (
                'id' => 382,
                'name' => 'COOPERATIVA DE AHORRO Y CREDITO ETAPA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            382 => 
            array (
                'id' => 383,
                'name' => 'COOP. AHORRO Y CREDITO MASCOOP ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            383 => 
            array (
                'id' => 384,
                'name' => 'COOP. DE A. Y C. SAINT MICHEL LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            384 => 
            array (
                'id' => 385,
                'name' => 'COOP. AHORRO Y CREDITO MANANTIAL DE ORO LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            385 => 
            array (
                'id' => 386,
                'name' => 'COOP. DE AHORRO Y CREDITO ANDINA LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            386 => 
            array (
                'id' => 387,
                'name' => 'COOP. DE AHORRO Y CREDITO ACCION Y DESARROLLO LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            387 => 
            array (
                'id' => 388,
                'name' => 'COOP. DE A. Y C. UNION Y DESARROLLO ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            388 => 
            array (
                'id' => 389,
                'name' => 'COOP. DE A. Y C. ESPERANZA DEL FUTURO LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            389 => 
            array (
                'id' => 390,
                'name' => 'COOP. DE A. Y C. 17 DE MARZO LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            390 => 
            array (
                'id' => 391,
                'name' => 'COOP. DE A. Y C. CATAR LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            391 => 
            array (
                'id' => 392,
                'name' => 'COOP. DE A. Y C. DE ACCION POPULAR ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            392 => 
            array (
                'id' => 393,
                'name' => 'COOP. DE A. Y C. ALLI TARPUK LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            393 => 
            array (
                'id' => 394,
                'name' => 'COOP. DE A. Y C. 16 DE JULIO LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            394 => 
            array (
                'id' => 395,
                'name' => 'COOP. DE A. Y C. SUBOFICIALES DE LA POLICIA NACION ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            395 => 
            array (
                'id' => 396,
                'name' => 'COOP. DE A. Y C. POLITECNICA LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            396 => 
            array (
                'id' => 397,
                'name' => 'COOP. DE A. Y C. NACIONAL LLANO GRANDE LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            397 => 
            array (
                'id' => 398,
                'name' => 'COOP. DE A. Y C. SAN VALENTIN ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            398 => 
            array (
                'id' => 399,
                'name' => 'COOP. DE A. Y C. TOTALIFE LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            399 => 
            array (
                'id' => 400,
                'name' => 'ACCIONES VALORES CASA DE VALORES S.A. ACCIVAL ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            400 => 
            array (
                'id' => 401,
                'name' => 'SANTA FE CASA DE VALORES S.A. SANTAFEVALORES ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            401 => 
            array (
                'id' => 402,
                'name' => 'PICAVAL CASA DE VALORES S.A ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            402 => 
            array (
                'id' => 403,
                'name' => 'ANALYTICA SECURTIES C.A. CASA DE VALORES ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            403 => 
            array (
                'id' => 404,
                'name' => 'ORION CASA DE VALORES S.A ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            404 => 
            array (
                'id' => 405,
                'name' => 'STRATEGA CASA DE VALORES S.A. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            405 => 
            array (
                'id' => 406,
                'name' => 'ECOFSA CASA DE VALORES S.A. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            406 => 
            array (
                'id' => 407,
                'name' => 'MERCHANTVALORES CASA DE VALORES S.A. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            407 => 
            array (
                'id' => 408,
                'name' => 'CASA DE VALORES VALUE S.A. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            408 => 
            array (
                'id' => 409,
                'name' => 'INMOVALOR CASA DE VALORES S.A. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            409 => 
            array (
                'id' => 410,
                'name' => 'ECUABURSATIL CASA DE VALORES S.A. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            410 => 
            array (
                'id' => 411,
                'name' => 'PLUS VALORES CASA DE VALORES S.A. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            411 => 
            array (
                'id' => 412,
                'name' => 'MERCAPITAL CASA DE VALORES S.A. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            412 => 
            array (
                'id' => 413,
                'name' => 'PORTAFOLIO CASA DE VALORES S.A. PORTAVALOR ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            413 => 
            array (
                'id' => 414,
                'name' => 'METROVALORES CASA DE VALORES S.A. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            414 => 
            array (
                'id' => 415,
                'name' => 'VECTORGLOBAL WMG CASA DE VALORES S.A. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            415 => 
            array (
                'id' => 416,
                'name' => 'HOLDUNPARTNERS CASA DE VALORES S.A. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            416 => 
            array (
                'id' => 417,
                'name' => 'COOP. DE AHORRO Y CREDITO BASE DE TAURA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            417 => 
            array (
                'id' => 418,
                'name' => 'CASA DE VALORES BANRIO S.A. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            418 => 
            array (
                'id' => 419,
                'name' => 'ALBION CASA DE VALORES S.A. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            419 => 
            array (
                'id' => 420,
                'name' => 'MASVALORES CASA DE VALORES S.A CAVAMASA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            420 => 
            array (
                'id' => 421,
            'name' => 'CASA DE VALORES DEL PACIFICO (VALPACIFICO) S.A. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            421 => 
            array (
                'id' => 422,
                'name' => 'CASA DE VALORES ADVFIN S.A. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            422 => 
            array (
                'id' => 423,
                'name' => 'KAPITAL ONE CASA DE VALORES S.A. KAOVALSA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            423 => 
            array (
                'id' => 424,
                'name' => 'PLUSBURSATIL CASA DE VALORES S.A ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            424 => 
            array (
                'id' => 425,
                'name' => 'ACTIVA ASES.E INTERMED.VALORES ACTIVALORES CASA DE ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            425 => 
            array (
                'id' => 426,
                'name' => 'CITADEL CASA DE VALORES S.A. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            426 => 
            array (
                'id' => 427,
                'name' => 'DECEVALE S.A. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            427 => 
            array (
                'id' => 428,
                'name' => 'COOP. DE A. Y C. SANTA LUCIA LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            428 => 
            array (
                'id' => 429,
                'name' => 'COOP. DE A. Y C. PRODUACTIVA LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            429 => 
            array (
                'id' => 430,
                'name' => 'COOP. DE A. Y C. TAMBOLOMA LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            430 => 
            array (
                'id' => 431,
                'name' => 'COOP DE A. Y C. PUSHAK RUNA HOMBRE LIDER ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            431 => 
            array (
                'id' => 432,
                'name' => 'COOP. DE A. Y C. 15 DE AGOSTO LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            432 => 
            array (
                'id' => 433,
                'name' => 'COOP. DE A. Y C. MIGRANTES DEL ECUADOR LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            433 => 
            array (
                'id' => 434,
                'name' => 'COOPERATIVA DE AHORRO Y CREDITO WUAMANLOMA LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            434 => 
            array (
                'id' => 435,
                'name' => 'COOP. DE A. Y C. SALATE LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            435 => 
            array (
                'id' => 436,
                'name' => 'COOP. DE A. Y C. UNION POPULAR LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            436 => 
            array (
                'id' => 437,
                'name' => 'COAC ACHIK INTI LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            437 => 
            array (
                'id' => 438,
                'name' => 'COAC EL MIGRANTE SOLIDARIO ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            438 => 
            array (
                'id' => 439,
                'name' => 'COOP AC LAS NAVES ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            439 => 
            array (
                'id' => 440,
                'name' => 'COOP. DE A. Y C. DE IMBABURA AMAZONAS ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            440 => 
            array (
                'id' => 441,
                'name' => 'COOP. A. Y C. DE INDIGENAS CHUCHUQUI LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            441 => 
            array (
                'id' => 442,
                'name' => 'COOP. AHORRO Y CREDITO FOCAZSUM LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            442 => 
            array (
                'id' => 443,
                'name' => 'COOP. DE A. Y C. SOLIDARIA LTDA.- COTOPAXI ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            443 => 
            array (
                'id' => 444,
                'name' => 'COOP. DE A. Y C. UNIDAD Y PROGRESO ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            444 => 
            array (
                'id' => 445,
                'name' => 'COAC LOJA INTERNACIONAL LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            445 => 
            array (
                'id' => 446,
                'name' => 'COAC 23 DE ENERO ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            446 => 
            array (
                'id' => 447,
                'name' => 'COAC OBRAS PUBLICAS FISCALES DE LOJA Y ZAMORA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            447 => 
            array (
                'id' => 448,
                'name' => 'COAC DEL SIND CHOF PROF VIRGEN DEL CISNE ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            448 => 
            array (
                'id' => 449,
                'name' => 'COAC SAN MIGUEL DE CHIRIJOS LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            449 => 
            array (
                'id' => 450,
                'name' => 'COOP. AHORRO Y CREDITO QUEVEDO LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            450 => 
            array (
                'id' => 451,
                'name' => 'COOP. DE A. Y C. EL ALTAR LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            451 => 
            array (
                'id' => 452,
                'name' => 'COOP. DE A. Y C. NUEVA ALIANZA DE CHIMBORAZO LTDA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            452 => 
            array (
                'id' => 453,
                'name' => 'COOP. DE A. Y C. LUIS FELIPE DUCHICELA XXVII ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            453 => 
            array (
                'id' => 454,
                'name' => 'COOP. DE A. Y C. NIZAG LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            454 => 
            array (
                'id' => 455,
                'name' => 'COOP. DE A. Y C. MAKITA KUNCHIK ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            455 => 
            array (
                'id' => 456,
                'name' => 'COOP. DE A. Y C. CERRADA MANUELA LEON ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            456 => 
            array (
                'id' => 457,
                'name' => 'COOP. DE A. Y C. EL BUEN SEMBRADOR LTDA. ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            457 => 
            array (
                'id' => 458,
                'name' => 'COAC SINDICATO DE CHOFERES PROFESIONALES DE YANTZA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            458 => 
            array (
                'id' => 459,
                'name' => 'COOP. DE A. Y C. 5 DE MAYO DE SANTA MARTHA DE CUBA ',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));






        $bank = Bank::find(2);
        $bank->addMedia(public_path('images/icons/banks/banco-pichincha.png'))
                            ->withCustomProperties(['isLogo' => true])
                            ->preservingOriginal()
                            ->toMediaCollection('banks');
        
        $bank = Bank::find(3);
        $bank->addMedia(public_path('images/icons/banks/banco-guayaquil.png'))
                            ->withCustomProperties(['isLogo' => true])
                            ->preservingOriginal()
                            ->toMediaCollection('banks');                    

        $bank = Bank::find(4);
        $bank->addMedia(public_path('images/icons/banks/banco-city-bank.png'))
                            ->withCustomProperties(['isLogo' => true])
                            ->preservingOriginal()
                            ->toMediaCollection('banks');          


        $bank = Bank::find(6);
        $bank->addMedia(public_path('images/icons/banks/banco-loja.png'))
                            ->withCustomProperties(['isLogo' => true])
                            ->preservingOriginal()
                            ->toMediaCollection('banks');  

        $bank = Bank::find(7);
        $bank->addMedia(public_path('images/icons/banks/banco-pacifico.png'))
                            ->withCustomProperties(['isLogo' => true])
                            ->preservingOriginal()
                            ->toMediaCollection('banks');  

        $bank = Bank::find(8);
        $bank->addMedia(public_path('images/icons/banks/banco-internacional.png'))
                            ->withCustomProperties(['isLogo' => true])
                            ->preservingOriginal()
                            ->toMediaCollection('banks');  

        $bank = Bank::find(10);
        $bank->addMedia(public_path('images/icons/banks/banco-austro.png'))
                            ->withCustomProperties(['isLogo' => true])
                            ->preservingOriginal()
                            ->toMediaCollection('banks');

        $bank = Bank::find(11);
        $bank->addMedia(public_path('images/icons/banks/banco-produbanco.png'))
                            ->withCustomProperties(['isLogo' => true])
                            ->preservingOriginal()
                            ->toMediaCollection('banks');  


        $bank = Bank::find(12);
        $bank->addMedia(public_path('images/icons/banks/banco-bolivariano.png'))
                            ->withCustomProperties(['isLogo' => true])
                            ->preservingOriginal()
                            ->toMediaCollection('banks');

        $bank = Bank::find(13);
        $bank->addMedia(public_path('images/icons/banks/banco-comercial-manabi.png'))
                            ->withCustomProperties(['isLogo' => true])
                            ->preservingOriginal()
                            ->toMediaCollection('banks');                    
        
        $bank = Bank::find(14);
        $bank->addMedia(public_path('images/icons/banks/banco-ruminahui.png'))
                            ->withCustomProperties(['isLogo' => true])
                            ->preservingOriginal()
                            ->toMediaCollection('banks');  

        $bank = Bank::find(16);
        $bank->addMedia(public_path('images/icons/banks/banco-solidario.png'))
                            ->withCustomProperties(['isLogo' => true])
                            ->preservingOriginal()
                            ->toMediaCollection('banks');  

        $bank = Bank::find(17);
        $bank->addMedia(public_path('images/icons/banks/banco-pro-credit.png'))
                            ->withCustomProperties(['isLogo' => true])
                            ->preservingOriginal()
                            ->toMediaCollection('banks');  

        $bank = Bank::find(25);
        $bank->addMedia(public_path('images/icons/banks/banco-delbank.png'))
                            ->withCustomProperties(['isLogo' => true])
                            ->preservingOriginal()
                            ->toMediaCollection('banks');  

    }
}