<?php

// Ici vous trouverez la fonction qui permet d’appeler le header du projet WordPress
get_header();
?>
   <main id="main" class="content-wrapper">
<!-- Ici vous pouvez placer le titre de votre archive juste en dessous de la balise "main" -->
	<div class="..."><h1>Liste des employés</h1></div>
      <div class="...">
<!-- Ici vous avez une condition qui fait que si des custom-posts sont présent on continue le traitement -->
         <?php if ( have_posts() ) { ?>
            <div class="...">
<!-- Ici commence la boucle qui permet d'afficher la liste des posts -->
               <?php while ( have_posts() ) {
                  the_post(); ?>
                  <div class="...">
<!-- Ici se trouve une condition qui fait en sorte que si l'image de mise en avant d'un post est trouvée alors on l'affiche sous forme d'un lien cliquable. (Dans le cas de notre excercice, nous n'utilisons pas d'image de mise en avant ) -->
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
<!-- Ici se trouve la zone ou nous allons implémenter les élements que nous vouons afficher dans notre archive  -->
<!-- Nous avons un lien symboliser par la balise "a" et dedans se trouve le permalien qui permet d'afficher une fiche employé en particulier -->
                           <a href="<?php the_permalink(); ?>">
<!-- Nous avons le titre de notre publication représenté par la fonction "the_title()" -->
                              <h3><?php the_title(); ?></h3>
<!-- Dans cette zone vous pouvez ajouter les informations que vous voulez (Photo, nom, prénom ou autre) -->
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
// Ici nous terminons la condition de la ligne 11 avec un "else" qui nous dit que sinon on affiche un résultat négatif en précisant qu'il n'y a pas de posts trouvés.
         } else { ?>
            <div class="archived-posts"><?php echo esc_html__( 'No posts matching the query were found.', 'your-translate-domain' ); ?></div>
         <?php } ?>
      </div>
   </main>
<?php
// Ici vous trouver la fonction qui permet d'afficher le footer de votre projet WordPress
get_footer(); ?>