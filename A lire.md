# Projet de création d'une base de données du personnel d'une entreprise

Je vous demande de créer par le biais de WordPress et de ce que nous avons vu ce matin une plateforme qui affichera des fiches d'employés avec : 

* Leur photo
* Leur nom
* Leur prénom
* Leur fonction
* Leur affectation
* Leur niveau d'accréditation

Et ceci avec les outils de ACF mais aussi en manipulant le php de votre WordPress.

Faites un thème enfant de la manière de votre choix.

Vous aller créer deux rôle utilisateur `Avec ultimate member` le premier sera : 

* Un directeur
* Un employé

Je veux que les employés puissent consulter la liste du personnel mais aussi une fiche en particulier.

Je veux que le directeur puisse consulter la liste du personnel mais aussi une fiche en particulier mais aussi ajouter un nouveau membre du personnel `Mettre en place un back Office`.

## BONUS

Utiliser les outils à votre disposition pour faire du style sur la plateforme.

Bonne chance!

## RESSOURCES

Pour les photos d'identité vous pouvez utiliser ce site : 

[https://this-person-does-not-exist.com/fr](https://this-person-does-not-exist.com/fr)

Une idée de mise en page pour les différents templates `desolé je ne suis pas bon dessinateur :)` : 

* img01.jpg
* img02.jpg


Le code pour le fichier `archive-$posttype.php`.

```php
<?php
get_header();
?>
   <main id="main" class="content-wrapper">
      <div class="...">
         <?php if ( have_posts() ) { ?>
            <div class="...">
               <?php while ( have_posts() ) {
                  the_post(); ?>
                  <div class="...">
                     <?php if ( has_post_thumbnail( get_the_ID() ) ) { ?>
                        <div class="...">
                           <div class="...">
                              <a href="<?php the_permalink(); ?>">
                                 <?php the_post_thumbnail( 'large' ); ?>
                              </a>
                           </div>
                        </div>
                     <?php } ?>
                     <div class="...">
                        <div class="...">
                           <a href="<?php the_permalink(); ?>">
                              <h3><?php the_title(); ?></h3>
                           </a>
                        </div>
                        <?php
                        $excerpt       = get_the_excerpt();
                        $excerpt       = substr( $excerpt, 0, 100 );
                        $short_excerpt = substr( $excerpt, 0, strrpos( $excerpt, ' ' ) );
                        if ( ! empty( $short_excerpt ) ) { ?>
                           <div class="...">
                              <p itemprop="description" class="qodef-e-excerpt">
                                 <?php echo esc_html( $short_excerpt ); ?>&hellip;</p>
                           </div>
                        <?php } ?>
                     </div>
                  </div>
               <?php } ?>
            </div>
            <?php wp_reset_postdata();
         } else { ?>
            <div class="archived-posts"><?php echo esc_html__( 'No posts matching the query were found.', 'your-translate-domain' ); ?></div>
         <?php } ?>
      </div>
   </main>
<?php
get_footer(); ?>
