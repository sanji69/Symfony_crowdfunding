<?php

namespace App\DataFixtures;

use App\Entity\Users;
use App\Entity\Articles;
use App\Entity\Contributor;
use \DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class MyFixture extends Fixture
{

    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        /*
         * Users Fixtures
         */
        // user 1
        $user1 = new Users();
        $user1->setUsername('jane_admin');
        $user1->setLastname('Doe');
        $user1->setFirstname('Jane');
        $user1->setPassword($this->passwordEncoder->encodePassword($user1, 'kitten'));
        $user1->setEmail('jane_admin@symfony.com');
        $user1->setToken(rand(250, 1000));
        $user1->setRoles('ROLE_ADMIN');
        $manager->persist($user1);
        $this->addReference('jane_admin', $user1);


        // user 2
        $user2 = new Users();
        $user2->setUsername('tom_admin');
        $user2->setLastname('Tom');
        $user2->setFirstname('Jane');
        $user2->setPassword($this->passwordEncoder->encodePassword($user2, 'kitten'));
        $user2->setEmail('tom_admin@symfony.com');
        $user2->setToken(rand(250, 1000));
        $user2->setRoles('ROLE_ADMIN');
        $manager->persist($user2);
        $this->addReference('tom_admin', $user2);


        // user 3
        $user3 = new Users();
        $user3->setUsername('john_user');
        $user3->setLastname('Doe');
        $user3->setFirstname('John');
        $user3->setPassword($this->passwordEncoder->encodePassword($user3, 'kitten'));
        $user3->setEmail('john_user@symfony.com');
        $user3->setToken(rand(250, 1000));
        $user3->setRoles('ROLE_USER');
        $manager->persist($user3);
        $this->addReference('john_user', $user3);

        // user ADMIN
        $user4 = new Users();
        $user4->setUsername('Kami-Sama');
        $user4->setLastname('Vinsmock');
        $user4->setFirstname('Sanji');
        $user4->setPassword($this->passwordEncoder->encodePassword($user1, 'bob'));
        $user4->setEmail('sanji@admin.com');
        $user4->setToken(rand(250, 1000));
        $user4->setRoles('ROLE_ADMIN');
        $manager->persist($user4);
        $this->addReference('Sanji_Admin', $user4);

        /*
         * Fin Users Fixtures
         */

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        /*
         * Articles Fixtures
         */
        $i = rand(250, 1000);
        $v = rand(250, 1000);
        $article1 = new Articles();
        $article1->setTitle('La Poste');
        $article1->setContent('La Poste est issue des relais de poste créés par Louis XI en 1477 pour le transport des messages royaux et surtout des offices de messagers royaux créés en 1576 qui étaient autorisés à transporter le courrier des particuliers8.
                                        C\'est au début du XVIIe siècle que date l\'origine de l\'administration des postes en France, avec la création de la « poste aux lettres », dirigée par le surintendant général des postes. À l\'époque, le port était payé par le destinataire.Le service a été organisé par 
                                        l\'État pour sa communication interne et la transmission des ordres, des rapports, entre les différents échelons de son administration.En 1879 deux administrations, celle des postes et celle du télégraphe, sont fusionnées pour former l\'administration des postes et télégraphes. 
                                        Les Postes, Télégraphes et Téléphones (PTT) sont rattachées au ministère des Postes et Télécommunications.');
        $article1->setGoal($i*$v);
        $article1->setStatus(1000);
        $article1->setUser($user1);
        $article1->setActived(0);
        $manager->persist($article1);


        $i = rand(250, 1000);
        $v = rand(250, 1000);
        $article2 = new Articles();
        $article2->setTitle('Renault');
        $article2->setContent('Le groupe Renault est un constructeur automobile français. Il est lié aux constructeurs japonais Nissan depuis 1999 et Mitsubishi depuis 201711, à travers l\'alliance Renault-Nissan-Mitsubishi qui est
                                        , au premier semestre 2017, le premier groupe automobile mondial12. Le groupe Renault possède des usines et filiales à travers le monde entier. Fondée par les frères Louis, Marcel et Fernand Renault en 1899,
                                         l\'entreprise joue, lors de la Première Guerre mondiale, un rôle essentiel (activités d\'armement, production de moteurs d\'avion, du char Renault FT)13.
                                        Elle se distingue ensuite rapidement par ses innovations, en profitant de l\'engouement pour la voiture des « années folles » et produit alors des véhicules « haut de gamme ».');
        $article2->setGoal($i*$v);
        $article2->setStatus(1000);
        $article2->setUser($user2);
        $article2->setActived(1);
        $manager->persist($article2);


        $i = rand(250, 1000);
        $v = rand(250, 1000);
        $article3 = new Articles();
        $article3->setTitle('SNCF');
        $article3->setContent('La Société nationale des chemins de fer français (SNCF) est l\'entreprise ferroviaire publique française, officiellement créée par convention entre l\'État et les compagnies de chemin de fer préexistantes, en application du décret-loi du 31 août 19375.
                                        Elle est notamment présente dans les domaines du transport de voyageurs, du transport de marchandises et réalise la gestion, l\'exploitation et la maintenance du réseau ferré national dont elle est propriétaire.
                                        La SNCF est composée de trois EPIC, mais elle possède de nombreuses filiales aussi bien de droit public que de droit privé qui forment le groupe SNCF.');
        $article3->setGoal($i*$v);
        $article3->setStatus(1000);
        $article3->setUser($user3);
        $article3->setActived(1);
        $manager->persist($article3);


        $i = rand(250, 1000);
        $v = rand(250, 1000);
        $article4 = new Articles();
        $article4->setTitle('Mangaka');
        $article4->setContent('Dès l’âge de quatre ans, Oda décide de suivre une carrière de mangaka et se passionne pour les vikings (notamment grâce au manga Vic le Viking2 auquel il fait des allusions fréquentes dans One Piece[réf. nécessaire]) et les pirates.
                                        En 1992, il reçoit les honneurs du 44e Prix Tezuka pour sa nouvelle Wanted, un western dont le héros est hanté par le fantôme d’un homme qu’il a tué. L’année suivante voit sa première publication professionnelle, Un présent divin (神から未来のプレゼント, Kami kara mirai no puresento?), dans le Jump Original d’octobre 1993. La même année, il gagne le concours de talent mensuel organisé par la rédaction du Weekly Shōnen Jump, le prix du manga Tenkaichi, avec la nouvelle intitulée Le démon solitaire (一鬼夜行, Ikki Yakō?).');
        $article4->setGoal($i*$v);
        $article4->setStatus(1000);
        $article4->setUser($user1);
        $article4->setActived(0);
        $manager->persist($article4);


        $i = rand(250, 1000);
        $v = rand(250, 1000);
        $article5 = new Articles();
        $article5->setTitle('Vivarte');
        $article5->setContent('Vivarte (anciennement Groupe André) est un groupe d\'entreprises français, dont l\'activité est la distribution de prêt-à-porter et de chaussures qui emploie plusieurs milliers de personnes. 
                                        Vivarte possède, durant plusieurs années, des marques comme Caroll, Chevignon, Kookaï, La Halle, Minelli, Naf Naf ou Pataugas entre autres. À partir de l\'an 2000, le groupe connait plusieurs restructurations : 
                                        de Groupe André, il change alors de nom pour Vivarte. Georges Plassat tient la tête de l\'entreprise durant une dizaine d\'années et réalise une politique d\'expansion. Par la suite de nombreux PDG qui se succèderont, restant parfois quelques mois en poste.
                                        Vivarte est revendu en 2004, puis 2006 par un malheureux LBO basé sur une dette trop importante qui grèvera le développement du groupe jusqu\'à nos jours. Dès les années 2010, les difficultés se font fortes et Vivarte tarde à réagir face à la concurrence d\'autres enseignes,
                                        l\'essor d\'internet ou l\'image vieillissante de certaines de ses marques. Marc Lelandais prend la direction en 2012 ; il réussit à négocier un important effacement de dette avec les créanciers, mais la coûteuse politique commerciale de montée en gamme qu\'il promeut reste un échec. 
                                        Ce groupe devient la propriété de plusieurs fonds d\'investissement en 2014, qui dirigent l\'entreprise. Après maintes péripéties financières, le groupe se retrouve acculé et un redresseur d\'entreprise, Patrick Puy, le prend en main fin 2016 pour le restructurer de nouveau, après toutes ces années d\'errements dans la stratégie. 
                                        Ce dernier revend rapidement plusieurs marques afin d\'essayer de sauver Vivarte dont le chiffre d\'affaires et les bénéfices ne cessent de chuter depuis plusieurs années.');
        $article5->setGoal($i*$v);
        $article5->setStatus(1000);
        $article5->setUser($user2);
        $article5->setActived(1);
        $manager->persist($article5);


        $i = rand(250, 1000);
        $v = rand(250, 1000);
        $article6 = new Articles();
        $article6->setTitle('Système U');
        $article6->setContent('Système U est une coopérative de commerçants de grande distribution française présidée par Dominique Schelcher.
                                        Le groupement coopératif rassemble les enseignes Hyper U, Super U, U Express qui est le supplantant Marché U et Utile, réseau de supérettes dans les communes en campagne.
                                        Avec 10,4 % de parts de marché au 31 décembre 2016, il s\'agit du sixième distributeur alimentaire en France, après les groupes Carrefour, Auchan, Leclerc, Casino et Intermarché. 
                                        Il est parfois classé au quatrième rang lorsque les parts de marché sont affichées par enseigne et non par groupe. En 2016, ils comptent 1 575 points de vente.');
        $article6->setGoal($i*$v);
        $article6->setStatus(1000);
        $article6->setUser($user3);
        $article6->setActived(1);
        $manager->persist($article6);


        $i = rand(250, 1000);
        $v = rand(250, 1000);
        $article7 = new Articles();
        $article7->setTitle('Blizzard Entertainment');
        $article7->setContent('Blizzard Entertainment est une société américaine de développement et d’édition de jeux vidéo siégeant à Irvine en Californie. La société a été fondée en 1991 par Allen Adham, Michael Morhaime et Frank Pearce sous le nom de Silicon & Synapse.
                                    Renommée Chaos Studios en 1994 puis Blizzard Entertainment la même année, elle est à l’origine des séries à succès Warcraft, Diablo, StarCraft, et surtout World of Warcraft ainsi que, plus récemment, Hearthstone: Heroes of Warcraft, Heroes of the Storm et Overwatch.
                                    Le studio a été une filiale du groupe français Vivendi (initialement au sein de Vivendi Universal Games, puis de l\'éditeur Activision Blizzard, à la suite de la fusion opérée en juillet 2008) jusqu\'à la cession de 49 % de ses actions en octobre 2013 où Activision Blizzard devient indépendant.');
        $article7->setGoal($i*$v);
        $article7->setStatus(1000);
        $article7->setUser($user1);
        $article7->setActived(0);
        $manager->persist($article7);


        $i = rand(250, 1000);
        $v = rand(250, 1000);
        $article8 = new Articles();
        $article8->setTitle('SuzuyaXIII');
        $article8->setContent('Juzo Suzuya (鈴屋 什造, Suzuya Jūzō), anciennement Rei Suzuya (鈴屋 玲, Suzuya Rei), est un Inspecteur Spécial du CCG. Son 1er partenaire était Yukinori Shinohara. Actuellement, il est le chef de l\'Escouade Suzuya.
                                        Il a d\'abord été affecté au 20°Arrondissement et a été responsable de l\'Enquête sur la Goinfre. Plus tard, il fut affecté au 13ème Arrondissement et enquêtait sur Nutcracker, avec l\'Escouade Quinckes. ');
        $article8->setGoal($i*$v);
        $article8->setStatus(1000);
        $article8->setUser($user2);
        $article8->setActived(1);
        $manager->persist($article8);


        $i = rand(250, 1000);
        $v = rand(250, 1000);
        $article9 = new Articles();
        $article9->setTitle('One Piece');
        $article9->setContent('L\'histoire de One Piece se déroule dans un monde fictif dominé par les océans, où les pirates aspirent à une ère de liberté et d\'aventure connue comme « l\'âge d\'or de la piraterie ». Cette époque fut inaugurée suite aux derniers mots prononcés par le roi des pirates, Gol D. Roger avant son exécution4. Roger annonce au monde que ses habitants étaient libres de chercher toutes les richesses qu\'il avait accumulées durant sa vie entière, le « One Piece5. »

Vingt-deux ans après l\'exécution de Roger, l\'intérêt pour le One Piece s’effrite. Beaucoup y ont renoncé, certains se demandent même s\'il existe vraiment. Même si les pirates sont toujours une menace pour les habitants, la Marine est devenue plus efficace pour contrer leurs attaques sur les quatre mers: East Blue, North Blue, West Blue et South Blue. Pourtant, ce changement n\'a pas dissuadé Monkey D. Luffy, un jeune garçon, de vouloir devenir le successeur du légendaire Roger. Il va ainsi partir à l’aventure en se donnant comme premier objectif de créer un équipage afin de rejoindre la mer de Grand Line, où la fièvre de la « grande vague de piraterie » continue de sévir, et où de nombreux grands noms de la piraterie sont à la poursuite du One Piece, supposé être sur la dernière île de cette grande mer, Raftel.

Luffy part à l\'aventure après sa rencontre avec Shanks le Roux, le capitaine d\'un navire de pirates qui a passé un an dans son village et l\'a sauvé d\'un monstre marin en sacrifiant son bras gauche. Depuis, Luffy porte son chapeau de paille qu\'il lui a offert pour marquer la promesse de devenir un grand pirate. Ce chapeau deviendra donc le symbole de son équipage. C\'est à cette époque qu\'il mange un fruit du démon que détenait Shanks : le fruit du caoutchoutier/ Gomu Gomu, et qui rend son corps élastique. Les fruits du Démon une fois mangés donnent des capacités spéciales à leur détenteur, qui perd par la même occasion toutes ses forces lorsqu\'il est immergé dans l\'eau de mer. Luffy et son équipage feront de nombreuses rencontres qui renforceront leur amitié et élargiront leurs équipages. Mais ils devront se confronter aux équipages pirates prônant violence et pouvoirs, ainsi qu\'à la Marine et ses soldats, garants de la justice.');
        $article9->setGoal($i*$v);
        $article9->setStatus(1000);
        $article9->setUser($user3);
        $article9->setActived(1);
        $manager->persist($article9);

        /*
         * Fin Articles Fixtures
         */

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

        /*
         * Contribution Fixtures
         */
        $contrib1 = new Contributor();
        $contrib1->setUsers($user1);
        $contrib1->setArticles($article1);
        $contrib1->setValue(500);
        $submit = new DateTime();
        $contrib1->setSubmitAt($submit);
        $manager->persist($contrib1);


        $contrib2 = new Contributor();
        $contrib2->setUsers($user2);
        $contrib2->setArticles($article1);
        $contrib2->setValue(500);
        $contrib2->setSubmitAt($submit);
        $manager->persist($contrib2);


        $contrib3 = new Contributor();
        $contrib3->setUsers($user3);
        $contrib3->setArticles($article2);
        $contrib3->setValue(500);
        $contrib3->setSubmitAt($submit);
        $manager->persist($contrib3);


        $contrib4 = new Contributor();
        $contrib4->setUsers($user1);
        $contrib4->setArticles($article2);
        $contrib4->setValue(500);
        $contrib4->setSubmitAt($submit);
        $manager->persist($contrib4);


        $contrib5 = new Contributor();
        $contrib5->setUsers($user2);
        $contrib5->setArticles($article3);
        $contrib5->setValue(500);
        $contrib5->setSubmitAt($submit);
        $manager->persist($contrib5);


        $contrib6 = new Contributor();
        $contrib6->setUsers($user3);
        $contrib6->setArticles($article3);
        $contrib6->setValue(500);
        $contrib6->setSubmitAt($submit);
        $manager->persist($contrib6);


        $contrib7 = new Contributor();
        $contrib7->setUsers($user1);
        $contrib7->setArticles($article4);
        $contrib7->setValue(500);
        $contrib7->setSubmitAt($submit);
        $manager->persist($contrib7);


        $contrib8 = new Contributor();
        $contrib8->setUsers($user2);
        $contrib8->setArticles($article4);
        $contrib8->setValue(500);
        $contrib8->setSubmitAt($submit);
        $manager->persist($contrib8);

        $contrib9 = new Contributor();
        $contrib9->setUsers($user3);
        $contrib9->setArticles($article5);
        $contrib9->setValue(500);
        $contrib9->setSubmitAt($submit);
        $manager->persist($contrib9);


        $contrib10 = new Contributor();
        $contrib10->setUsers($user1);
        $contrib10->setArticles($article5);
        $contrib10->setValue(500);
        $contrib10->setSubmitAt($submit);
        $manager->persist($contrib10);


        $contrib11 = new Contributor();
        $contrib11->setUsers($user2);
        $contrib11->setArticles($article6);
        $contrib11->setValue(500);
        $contrib11->setSubmitAt($submit);
        $manager->persist($contrib11);

        $contrib12 = new Contributor();
        $contrib12->setUsers($user3);
        $contrib12->setArticles($article6);
        $contrib12->setValue(500);
        $contrib12->setSubmitAt($submit);
        $manager->persist($contrib12);


        $contrib13 = new Contributor();
        $contrib13->setUsers($user1);
        $contrib13->setArticles($article7);
        $contrib13->setValue(500);
        $contrib13->setSubmitAt($submit);
        $manager->persist($contrib13);


        $contrib14 = new Contributor();
        $contrib14->setUsers($user2);
        $contrib14->setArticles($article7);
        $contrib14->setValue(500);
        $contrib14->setSubmitAt($submit);
        $manager->persist($contrib14);


        $contrib15 = new Contributor();
        $contrib15->setUsers($user3);
        $contrib15->setArticles($article8);
        $contrib15->setValue(500);
        $contrib15->setSubmitAt($submit);
        $manager->persist($contrib15);


        $contrib16 = new Contributor();
        $contrib16->setUsers($user1);
        $contrib16->setArticles($article8);
        $contrib16->setValue(500);
        $contrib16->setSubmitAt($submit);
        $manager->persist($contrib16);


        $contrib17 = new Contributor();
        $contrib17->setUsers($user2);
        $contrib17->setArticles($article9);
        $contrib17->setValue(500);
        $contrib17->setSubmitAt($submit);
        $manager->persist($contrib17);


        $contrib18 = new Contributor();
        $contrib18->setUsers($user3);
        $contrib18->setArticles($article9);
        $contrib18->setValue(500);
        $contrib18->setSubmitAt($submit);
        $manager->persist($contrib18);


        $manager->flush();

    }
}
