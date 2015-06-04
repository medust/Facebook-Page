<?php
/**
 * @author Medust.com
 * Plugin: Facebook Page
 */
?>

    <div class="wrap">

        <form method="post" action="<?php echo $_SERVER["REQUEST_URI"]; ?>">
            <input type="hidden" name="info_update" id="info_update" value="true"/>

            <?php wp_nonce_field('fmz-update-setting','fmz-update-setting'); ?>

            <u><h2>Facebook Page Plugin by Medust.com</h2></u>

            <div align="left">
                <br>

                <a href="https://twitter.com/Medusts" class="twitter-follow-button" data-show-count="false"
                   data-size="large">Follow @Medusts</a>
                <script>!function (d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (!d.getElementById(id)) {
                        js = d.createElement(s);
                        js.id = id;
                        js.src = "//platform.twitter.com/widgets.js";
                        fjs.parentNode.insertBefore(js, fjs);
                    }
                }(document, "script", "twitter-wjs");</script>

                <iframe src="//www.facebook.com/plugins/likebox.php?href=http%3A%2F%2Fwww.facebook.com%2Fmedustdotcom&amp;width=292&amp;height=62&amp;show_faces=false&amp;colorscheme=light&amp;stream=false&amp;border_color&amp;header=false&amp;appId=390019957675094"
                        scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:292px; height:62px;"
                        allowTransparency="true"></iframe>

            </div>
            <div id="poststuff" class="metabox-holder has-right-sidebar">


                <div style="float:left;width:70%;">

                    <br>

                    <?php
                    require_once 'setting-page/medust-left-column.php';
                    require_once 'setting-page/medust-right-column.php';
                    require_once 'setting-page/medust-footer.php';

                    ?>
