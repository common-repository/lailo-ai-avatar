<div style="padding: 2rem;">
    <h1 style="color: red;"><?php echo esc_html("Lailo - AI Avatar Error Page"); ?></h1>
    <h3><?php echo esc_html("An error has occured while saving your new Avatar. Potential solutions:"); ?> </h3>
    <ul>
        <li><?php echo esc_html("Please make sure that you entered a name for your avatar"); ?></li>
        <li><?php echo esc_html("Please make sure that you entered a bot secret for your avatar"); ?></li>
        <li><?php echo esc_html("Please make sure that you entered your bot secret correctly"); ?></li>
    </ul>
    <a class="button button-primary" href=<?php echo esc_url(admin_url('admin.php')."?page=lailo_template_table"); ?>><?php echo esc_html("Back to admin page"); ?></a>
</div>