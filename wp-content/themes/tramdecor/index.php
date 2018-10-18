<?php
    $logo = get_theme_option('logoHome');
?>
<?php wp_head(); ?>
<div class="row">
    <div class="col align-self-center">
        <div class="container-home">
            <div class="img-on-home">
                <img
                    src="https://static1.squarespace.com/static/5b8bf301e2ccd13e972a0ab4/5b9208bd6d2a731b3d45792c/5b99e67c21c67caa9623ac1d/1536812818661/thiet-ke-noi-that+%2804%29.jpg?format=750w">
            </div>
            <div class="log-on-home">
                <img src="<?php echo $logo ?>">
            </div>
            <div class="link-to-index">
                <a href="/thiet-ke-noi-that/">Welcome</a>
            </div>
        </div>

    </div>
</div>