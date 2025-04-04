<?php
/*
Template Name: Home Page
*/
get_header(); // Include the header
?>

<section class="hero" style="background-image: url('<?php echo esc_url(get_theme_mod('mmoglife_hero_bg')); ?>');">
    <div class="hero-content">
        <h1><?php echo esc_html(get_theme_mod('mmoglife_hero_title', 'MMOGLIFE')); ?></h1>
        <p><?php echo esc_html(get_theme_mod('mmoglife_hero_desc', 'Your best gaming experience starts here!')); ?></p>
        <div class="hero-buttons">
            <a href="<?php echo esc_url(get_theme_mod('mmoglife_hero_btn1_link', '#')); ?>">
                <?php echo esc_html(get_theme_mod('mmoglife_hero_btn1_text', 'Browse Games')); ?>
            </a>
            <a href="<?php echo esc_url(get_theme_mod('mmoglife_hero_btn2_link', '#')); ?>">
                <?php echo esc_html(get_theme_mod('mmoglife_hero_btn2_text', 'About Us')); ?>
            </a>
        </div>
    </div>
</section>

<?php get_footer(); // Include the footer ?>
