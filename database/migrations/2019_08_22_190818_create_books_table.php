<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->string('picture');
			$table->string('author');
			$table->string('title');
			$table->text('synopsis');
			$table->string('borrower')->nullable();
            $table->timestamps();
        });

        DB::table('books')->insert(
            array(
                'id' => 1,
                'picture' => '../img/1.jpg',
                'author' => 'J. K. Rowling',
                'title' => 'Harry Potter à l\'école des sorciers',
                'synopsis' => 'Orphelin, le jeune Harry Potter peut enfin quitter ses tyranniques oncle et tante Dursley lorsqu\'un curieux messager lui révèle qu\'il est un sorcier. À 11 ans, Harry va enfin pouvoir intégrer la légendaire école de sorcellerie de Poudlard, y trouver une famille digne de ce nom et des amis, développer ses dons, et préparer son glorieux avenir.'
            )
        );

        DB::table('books')->insert(
            array(
                'id' => 2,
                'picture' => '../img/2.jpg',
                'author' => 'George Orwell',
                'title' => '1984',
                'synopsis' => 'En 1984, après une catastrophe dévastatrice, le monde est divisé en 3 blocs. En guerre permanente avec Estasia et Eurasia, Océania est dominée par un gouvernement totalitaire que dirige l\'omniprésent \'Big Brother\'. Contrôlée au travers d\'innombrables écrans, la vie de chacun y est misérable, notamment celles des prolétaires, considérés comme des sous-hommes. Modeste employé au Miniver, le ministère de la Vérité, Winston Smith consigne secrètement ses réflexions dans un journal intime.'
            )
        );

        DB::table('books')->insert(
            array(
                'id' => 3,
                'picture' => '../img/3.jpg',
                'author' => 'Michaël Salanville, Balak, Bastien Vivès',
                'title' => 'LastMan - Tome 5',
                'synopsis' => 'Voilà déjà 2 semaines que Marianne et Adrian ont quitté la vallée des rois pour se lancer à la poursuite de Richard Aldana. Alors que le grand tournoi de la FFFC en est aux quarts de finale, c’est toute la vallée qui est en alerte à la recherche du traitre et voleur de coupe… Et si la réalité dépassait la légende, s’il était possible de traverser le souffle de mère iguane ? Un monde inconnu pourrait bien s’ouvrir au-delà de la vallée des rois… La saga continue !'
            )
        );

        DB::table('books')->insert(
            array(
                'id' => 4,
                'picture' => '../img/4.jpg',
                'author' => 'Mihaly Csikszentmihalyi',
                'title' => 'Flow: The Psychology of Optimal Experience',
                'synopsis' => 'Legendary psychologist Mihaly Csikszentmihalyi\'s famous investigations of "optimal experience" have revealed that what makes an experience genuinely satisfying is a state of consciousness called flow. During flow, people typically experience deep enjoyment, creativity, and a total involvement with life. In this new edition of his groundbreaking classic work, Csikszentmihalyi ("the leading researcher into ‘flow states’" —Newsweek) demonstrates the ways this positive state can be controlled, not just left to chance. Flow: The Psychology of Optimal Experience teaches how, by ordering the information that enters our consciousness, we can discover true happiness, unlock our potential, and greatly improve the quality of our lives. "Explores a happy state of mind called flow, the feeling of complete engagement in a creative or playful activity." —Time'
            )
        );

        DB::table('books')->insert(
            array(
                'id' => 5,
                'picture' => '../img/5.jpg',
                'author' => 'F. Scott Fitzgerald',
                'title' => 'Gatsby le Magnifique',
                'synopsis' => 'Printemps 1922. L\'époque est propice au relâchement des murs, à l\'essor du jazz et à l\'enrichissement des contrebandiers d\'alcool... Apprenti écrivain, Nick Carraway quitte la région du Middle-West pour s\'installer à New York. Voulant sa part du rêve américain, il vit désormais entouré d\'un mystérieux millionnaire, Jay Gatsby, qui s\'étourdit en fêtes mondaines, et de sa cousine Daisy et de son mari volage, Tom Buchanan, issu de sang noble.'
            )
        );

        DB::table('books')->insert(
            array(
                'id' => 6,
                'picture' => '../img/6.jpg',
                'author' => 'J.R.R. Tolkien',
                'title' => 'Le Hobbit',
                'synopsis' => 'Bilbon n\'est plus tout jeune et décide d\'entamer la rédaction de ses Mémoires ; il commence par faire le récit de l\'aventure qu\'il vécut quelque soixante ans plus tôt. Il se remémore notamment, alors qu\'il profitait paisiblement de sa journée, l\'arrivée du sorcier Gandalf. Ce dernier avait vu en lui la personne capable d\'aider des nains barbus à retrouver leur trésor volé par le terrifiant dragon Smaug.'
            )
        );

        DB::table('books')->insert(
            array(
                'id' => 7,
                'picture' => '../img/7.jpg',
                'author' => 'Dan Brown',
                'title' => 'Da Vinci Code',
                'synopsis' => 'Une nuit, le professeur Robert Langdon, éminent spécialiste de l\'étude des symboles, est appelé d\'urgence au Louvre : le conservateur du musée a été assassiné, mais avant de mourir, il a laissé de mystérieux symboles... Avec l\'aide de la cryptologue Sophie Neveu, Langdon va mener l\'enquête et découvrir des signes dissimulés dans les oeuvres de Léonard de Vinci.'
            )
        );

        DB::table('books')->insert(
            array(
                'id' => 8,
                'picture' => '../img/8.jpg',
                'author' => 'George R. R. Martin',
                'title' => 'Le trône de fer',
                'synopsis' => 'Le royaume des Sept Couronnes vit depuis près de quinze ans sous le règne du roi Robert Baratheon qui a mis fin à la lignée des Targaryen lors d\'une rébellion qui vit la chute du roi Aerys II Targaryen. Depuis près de neuf ans, après la tentative de rébellion de lord Balon Greyjoy, le royaume est en paix et connaît la prospérité apportée par l\'été le plus long connu de mémoire d\'homme. Cependant, cette époque touche à son terme… Au-delà du Mur qui marque la frontière septentrionale du royaume, d\'étranges événements annoncent la venue prochaine de l\'hiver. Pendant ce temps, à Port-Réal, capitale du royaume, lord Jon Arryn qui fut la Main du roi Robert lors des quinze premières années de son règne, décède. Lord Eddard Stark, ami d\'enfance du roi et seigneur suzerain du Nord est pressenti pour lui succéder, malgré son aversion pour les intrigues de la Cour. Mais un autre péril menace l\'unité du royaume car, au-delà du détroit, dans les cités libres, les derniers héritiers de la dynastie targaryenne conspirent pour reprendre le Trône de Fer qui leur a été usurpé…'
            )
        );

        DB::table('books')->insert(
            array(
                'id' => 9,
                'picture' => '../img/9.jpg',
                'author' => 'Regis Marcon, Nathalie Nannini, Philippe Barret',
                'title' => 'Herbes. 70 herbes potagères et sauvages,130 recettes',
                'synopsis' => 'Dans ce livre l\'auteur met son savoir-faire au service de la richesse et de la subtilité des aromates utilisés dans ses recettes : tartelette potagère, pistou de plantain aux grenouille, Phô aux herbes, Consoude farcie, beignets de fleurs d\'acacia, ...'
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
