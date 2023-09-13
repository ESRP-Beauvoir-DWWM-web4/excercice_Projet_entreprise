<?php
/**
 * The template for displaying singular post-types: posts, pages and user-defined custom post types.
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

while ( have_posts() ) :
	the_post();
// Ici j'appelle le header de mon projet
	get_header();
	?>

<main id="content" <?php post_class( 'site-main' ); ?>>

	<?php if ( apply_filters( 'hello_elementor_page_title', true ) ) : ?>
		<header class="page-header">
			<?php the_title( '<h1 class="entry-title personnel_title">', '</h1>' ); ?>
		</header>
	<?php endif; ?>

	<div class="page-content">
		<?php the_content(); ?>

<!-- Ici nous commençons le traitement qui affichera les données de notre publication. si vous ne faites pas ce traitement, la publication créée n'affichera que le titre -->

		<?php

// Ci dessous, nous faisons le traitement pour afficher une photo

// Je créer une variable "$photo_id" qui contiendra la fonction qui sert à appeler ma photo dans la base de données
// "get_post_meta()" est la fonction qui prends 2 paramètres : "$post->ID" qui appel la publication par son identifiant et "photo_identite" qui est le slug du champs ACF correspondant à la photo.
		$id_photo = get_post_meta($post->ID, 'photo_identite', true);
// Le fait d'appeler la photo ne suffit pas car en l'état nous ne récupérons que son identifiant, il faut mettre en place une fonction qui appellera l'url de la photo : "wp_get_attachment_image_url() ou par l'endroit où elle se trouve dans le dossier WordPress : wp_get_attachment_image_src()"
		$photo = wp_get_attachment_image_src($id_photo);
// Ensuite pour finir nous mettons en place une variable "$photo_src" qui appellera la fonction au-dessus qui est un tableau donc on lui met en plus une accolade avec le "0" afin d'appeler le premier index ce tableau.
		$photo_src = $photo[0];
// Nous faisons le même traitement pour toute les informations de notre publication
		$nom = get_post_meta($post->ID, 'nom', true);
		$prenom = get_post_meta($post->ID, 'prenom', true);
		$adresse = get_post_meta($post->ID, 'adresse', true);
		$codePostal = get_post_meta($post->ID, 'code_postal', true);
		$ville = get_post_meta($post->ID, 'ville', true);
// Ici se trouve nos taxonomies que nous souhaitons aussi afficher, pour cela il faut faire un traitement spécial
		$fonction = get_field('fonction_entreprise');
		$affectation = get_post_meta($post->ID, 'affectation', true);
		$niveauAccreditation = get_post_meta($post->ID, 'niveau_accreditation', true);

// Nous mettons en place une variable "$fonction_data" dans laquelle nous placon une fonction qui permettra d'appeller notre taxonomie
		$fonction_data = get_term($fonction);
// Suite à ce traitement, nous obtenons un tableau associatif qui contient les informations dont son nom : "name". Je mets en place une dernière variable qui appellera la variable qui contient le tableau mais en ne récupérant l'objet "name". Nous faisons le même traitement pour les autres taxonomies
		$taxonomy_fonction = $fonction_data->name;
		$affectation_data = get_term($affectation);
		$taxonomy_affectation = $affectation_data->name;
		$niveauAccreditation_data = get_term($niveauAccreditation);
		$taxonomy_niveauAccreditation = $niveauAccreditation_data->name;  

		?>



		<!-- Présentation -->

		<div class="personnel_container">
			<img src="<?= $photo_src ?>" alt="Photo d'identité">
			<table>
				<thead>
					<tr>
						<th>Nom</th>
						<th>Prénom</th>
						<th>Adresse</th>
						<th>Code postal</th>
						<th>Ville</th>
						<th>Fonction</th>
						<th>Affectation</th>
						<th>Niveau d'accréditation</th>
					</tr>
				</thead>
				<tbody>
					<tr>
<!-- Ici pour afficher mes données j'ai choisi un tableau donc plus haut je crée les intitulés de mon tableau et ci-dessous je mets en place mes variables qui servirons à afficher mes données -->
						<td><?= $nom ?></td>
						<td><?= $prenom ?></td>
						<td><?= $adresse ?></td>
						<td><?= $codePostal ?></td>
						<td><?= $ville ?></td>
						<td><?= $taxonomy_fonction ?></td>
						<td><?= $taxonomy_affectation ?></td>
						<td><?= $taxonomy_niveauAccreditation ?></td>
					</tr>
				</tbody>
			</table>
			<div class="personnel_delete"><?= do_shortcode('[frontend_admin form=50]') ?></div>
		</div>

		<!-- ------------ -->
		<div class="post-tags">
			<?php the_tags( '<span class="tag-links">' . esc_html__( 'Tagged ', 'hello-elementor' ), null, '</span>' ); ?>
		</div>
		<?php wp_link_pages(); ?>
	</div>

	<?php comments_template(); ?>

</main>

	<?php
// Ici j'appelle le footer de mon projet
	get_footer();
endwhile;
