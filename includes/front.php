<?php

add_action('admin_menu','bring_lock_menu');

function bring_lock_menu(){
    add_menu_page(
        "Bring Lock",
        "Bring Lock",
        "manage_options",
        "bring-lock", // SLUG NAME PAGE
        "bring_menu_pagina", // FUNCTION RENDERIZAR PAGINA
        "dashicons-lock",
        3
    );

    // VERIFICAÇÂO SE NAO EXISTE AS METAS NO BANCO, adiciona elas:
        //var chave de bloqueio
    if (metadata_exists('term', 1, 'bring_key') == false ){
        add_term_meta(1,'bring_key','chaveteste'); //string KEY
    }
    // VARIAVEL STATUS DE VERIFICAÇÂO BLOQUEIO
    if (metadata_exists('term', 1, 'bring_status') == false){
		add_term_meta(1,'bring_status','false'); // Key Status Lock
    }

    // Chave do APP ID
    if (metadata_exists('term', 1, 'bringpay_appid') == false ){
        add_term_meta(1,'bringpay_appid','APP-ID-TESTE'); //APP ID MERCADO PAGO
    }
    
}

function bring_menu_pagina(){
    // Renderização do codigo HTML
    ?>
    <h1>Bring Lock</h1>
    <form method="POST" action="options.php">
    <?php
        settings_errors();
        do_settings_sections('bring-lock');
        settings_fields('bring_lock_settings');
        submit_button();
    ?>
    </form>
    <?php
}

add_action('admin_menu','bring_lock_secao');

function bring_lock_secao(){
    //SEÇÃO
    add_settings_section(
        'bring_lock_secao',
        'Bring Config - Variaveis Globais',
        'bring_lock_secao_detalhes',
        'bring-lock' // SLUG NAME PAGE
        
    );
    // CAMPO CHAVE DE BLOQUEIO
    add_settings_field(
        'bring_lock_key',
        'Chave',
        'bring_lock_key', // CALLBACK FIELD KEY
        'bring-lock', // SLUG PAGE
        'bring_lock_secao' // SESSION NAME
    );


     // CAMPO APP_ID MERCADO PAGO
     add_settings_field(
        'bringpay_appid',
        'APP_ID (Mercado Pago)',
        'bringpay_appid', // CALLBACK FIELD KEY
        'bring-lock', // SLUG PAGE
        'bring_lock_secao' // SESSION NAME
    );


    //registro bring_lock
    register_setting(
        'bring_lock_settings',
        'bring_lock_key',
        'bring_lock_termmeta_key',
    );

    //registro bringpay
    register_setting(
        'bring_lock_settings',
        'bringpay_appid',
        'bringpay_appid_update',
    );
}
// FUNÇÂO CALLBACK SEÇÃO
function bring_lock_secao_detalhes(){
    ?>
    <p>Página de Variavéis Globais, usadas pela Bring E-commerce</P>
    <?php
}

// FUNÇÂO CALLBACK CHAVE DO BLOQUEIO
function bring_lock_key(){
    ?>
    <input type="text" id="bring_lock_key" name="bring_lock_key" value="<?php echo esc_html(get_term_meta(1,'bring_key',true)); ?>" required>

    <?php
}

function bring_lock_termmeta_key($chave){
    update_term_meta( 1, 'bring_key',$chave);
}

// FUNÇÂO CALLBACK APP_ID Mercado Pago
function bringpay_appid(){
    
    ?>

    <input type="text" id="bringpay_appid" name="bringpay_appid" value="<?php echo esc_html(get_term_meta(1,'bringpay_appid',true)); ?>" required>

    <?php
}

function bringpay_appid_update($chave){
    update_term_meta( 1, 'bringpay_appid',$chave);
}

?>