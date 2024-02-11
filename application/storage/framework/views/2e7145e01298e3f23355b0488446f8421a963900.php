<html>
    <head>
        <meta charset="UTF-8">
        <meta name="description" content="Get the latest leads for Hospital beds, Oxygen, Plasma, Medicines, Doctors, etc.">
        <meta name="keywords" content="Covid 19, Covid19, Leads">
        <meta name="author" content="Nakul Gupta">
        <meta property="og:title" content="Covid Leads">
        <meta property="og:description" content="Get the latest leads for Hospital beds, Oxygen, Plasma, Medicines, Doctors, etc.">
        <meta property="og:image" content="https://covid-leads.guptanakul.com/img/covid_leads.png">
        <meta property="og:url" content="https://covid-leads.guptanakul.com/">
        <meta name="twitter:card" content="summary_large_image">
        <meta property="og:type" content="website" />
        <meta property="fb:app_id" content="363425611781831" />
        <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
        <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/datetimepicker@latest/dist/DateTimePicker.min.css" />
        <link rel="stylesheet" href="<?php echo e(asset('css/index.css')); ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Covid Leads</title>
        <link rel="icon" href="/favicon.ico" type="image/x-icon" />
    </head>
    <body class="purpose_select_mode">
        <div class="purpose_outer_box noselect">
            <div class="purpose_box">
                <div class="purpose_button" button_type="requirer">Requirer</div>
                <div class="purpose_button" button_type="submitter">Submitter</div>
            </div>
        </div>
        <div class="state_select"></div>
        <div class="mdl-layout mdl-js-layout mdl-layout--fixed-header">
            <header class="mdl-layout__header">
                <div class="menu_bar_button"><i class="material-icons">keyboard_backspace</i></div>
                <div class="mdl-layout__header-row">
                    <span class="mdl-layout-title">Covid Leads</span>
                </div>
                <div class="mdl-layout__tab-bar menu_bar">
                    <a href="#beds_tab" class="menu_bar_tab is-active">Beds</a>
                    <a href="#oxygen_tab" class="menu_bar_tab">Oxygen</a>
                    <a href="#plasma_tab" class="menu_bar_tab">Plasma</a>
                    <a href="#ambulance_tab" class="menu_bar_tab">Ambulance</a>
                    <a href="#meds_tab" class="menu_bar_tab">Meds</a>
                    <a href="#tiffin_tab" class="menu_bar_tab">Tiffin</a>
                    <a href="#helpdesk_tab" class="menu_bar_tab">Helpdesk</a>
                    <a href="#tele_consultation_tab" class="menu_bar_tab">Tele Consultation</a>
                </div>
            </header>
            <main class="mdl-layout__content">
                <div class="page-content"></div>
            </main>
            <p style="display: none;" id="app_url"><?php echo e(env("APP_URL")); ?></p>
            <script src="https://code.getmdl.io/1.3.0/material.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/datetimepicker@latest/dist/DateTimePicker.min.js"></script>
            <script src="<?php echo e(asset('js/index.js?' . time())); ?>"></script>
        </div>
    </body>
</html>
<?php /**PATH /var/www/projects/covid-leads/application/resources/views/index.blade.php ENDPATH**/ ?>