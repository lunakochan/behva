<?php
/**
 * Template Name: Home
 * Description: Template home
 * Template Post Type: page
 *
 * @package behva
 */

$sec_banner  = get_field( 'section_banner' );
$sec_tab     = get_field( 'section_tab' );
$sec_contact = get_field( 'section_contact' );

get_header();
?>
<div class="template-home">
    <section class="sec_banner">
        <div class="container">
            <div class="banner-container">
                <?php
                echo wp_get_attachment_image( $sec_banner['banner'], 'banner-background', false, array( 'class' => 'banner-image' ) );
                ?>
                <div class="content">
                    <?php
                    if ( $sec_banner['heading'] ) {
                        ?>
                        <h1 class="heading">
                            <?php echo esc_html( $sec_banner['heading'] ); ?>
                        </h1>
                        <?php
                    }
                    if ( $sec_banner['description'] ) {
                        ?>
                        <div class="description">
                            <?php echo esc_html( $sec_banner['description'] ); ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <?php
                if ( ! empty( $sec_banner['button']['title'] ) ) {
                    ?>
                    <a href="<?php echo esc_url( $sec_banner['button']['link'] ?? '#' ); ?>" class="button-banner button-primary">
                        <?php echo esc_html( $sec_banner['button']['title'] ); ?>
                    </a>
                    <?php
                }
                ?>
            </div>
        </div>
    </section>

    <section class="sec_tab">
        <div class="container">
            <div class="tab-container">
                <div class="content-head">
                    <?php
                    if ( ! empty( $sec_tab['sub_title'] ) ) {
                        ?>
                        <span class="sub-title">
                            <?php echo esc_html( $sec_tab['sub_title'] ); ?>
                        </span>
                        <?php
                    }
                    if ( ! empty( $sec_tab['heading'] ) ) {
                        ?>
                        <h2 class="heading">
                            <?php echo esc_html( $sec_tab['heading'] ); ?>
                        </h2>
                        <?php
                    }
                    ?>
                </div>
                <div class="custom-pagination"></div>
                <div class="splide tab-splide">
                    <div class="splide__track">
                        <ul class="splide__list">
                            <?php
                            foreach ( $sec_tab['tabs'] as $tab ) {
                                ?>
                                <li class="splide__slide" data-title="<?php echo esc_attr( $tab['title'] );  ?>" style="--tab-bg: <?php echo esc_attr( $tab['background_color'] ); ?>" data-color="<?php echo esc_attr( $tab['background_color'] ); ?>">
                                    <div class="card-tab">
                                        <?php echo wp_get_attachment_image( $tab['image'], 'square', '', array( 'class' => 'image-card-tab' ) );
                                        ?>
                                        <div class="content">
                                            <?php
                                            if ( ! empty( $tab['title'] ) ) {
                                                ?>
                                                <div class="title">
                                                    <?php echo esc_html( $tab['title'] ); ?>
                                                </div>
                                                <?php
                                            }
                                            if ( ! empty( $tab['description'] ) ) {
                                                ?>
                                                <div class="description">
                                                    <?php echo esc_html( $tab['description'] ); ?>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="sec_contact">
        <div class="container">
            <div class="contact-container">
                <?php
                if ( ! empty( $sec_contact['background'] ) ) {
                    echo wp_get_attachment_image( $sec_contact['background'], 'banner-background', '', array( 'class' => 'background' ) );
                }
                ?>
                <div class="contact-head">
                    <?php
                    if ( ! empty( $sec_contact['heading'] ) ) {
                        ?>
                        <h2 class="heading">
                            <?php echo esc_html( $sec_contact['heading'] ); ?>
                        </h2>
                        <?php
                    }
                    ?>
                    <div class="group-description">
                        <?php
                        if ( ! empty( $sec_contact['form_description'] ) ) {
                            ?>
                            <div class="sub-title">
                                <?php echo esc_html( $sec_contact['form_description'] ); ?>
                            </div>
                            <?php
                        }
                        if ( ! empty( $sec_contact['button']['title'] ) ) {
                            ?>
                            <a href="<?php echo esc_url( $sec_contact['button']['link'] ); ?>" class="button-contact button-primary">
                                <?php echo esc_html( $sec_contact['button']['title'] ); ?>
                            </a>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="contact-form">
                    <?php
                    if ( ! empty( $sec_contact['form_title'] ) ) {
                        ?>
                        <div class="contact-title">
                            <?php echo esc_html( $sec_contact['form_title'] ); ?>
                        </div>
                        <?php
                    }
                    if ( ! empty( $sec_contact['form_description'] ) ) {
                        ?>
                        <div class="contact-description">
                            <?php echo esc_html( $sec_contact['form_description'] ); ?>
                        </div>
                        <?php
                    }
                    
                    if ( ! empty( $sec_contact['form'] ) ) {  
                        ?>
                        <div class="contact-form-container">
                            <?php
                            echo do_shortcode( $sec_contact['form'] );
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
</div>
<?php
get_footer();