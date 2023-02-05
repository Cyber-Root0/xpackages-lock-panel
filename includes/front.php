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
    if (metadata_exists('term', 1, 'bring_key') == false ){
        add_term_meta(1,'bring_key','chaveteste'); //string KEY
    }
    if (metadata_exists('term', 1, 'bring_status') == false){
		add_term_meta(1,'bring_status','false'); // Key Status Lock
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
        'Configurações da Chave de Bloqueio',
        'bring_lock_secao_detalhes',
        'bring-lock' // SLUG NAME PAGE
        
    );
    // CAMPO CHAVE
    add_settings_field(
        'bring_lock_key',
        'Chave',
        'bring_lock_key', // CALLBACK FIELD KEY
        'bring-lock', // SLUG PAGE
        'bring_lock_secao', // SESSION NAME
    );

    register_setting(
        'bring_lock_settings',
        'bring_lock_key',
        'bring_lock_termmeta_key',
    );
}
// FUNÇÂO CALLBACK SEÇÃO
function bring_lock_secao_detalhes(){
    ?>
    <p>Insira a Chave de Bloqueio do Painel Bring</P>
    <?php
}

// FUNÇÂO CALLBACK CHAVE
function bring_lock_key(){
    ?>
    <input type="text" id="bring_lock_key" name="bring_lock_key" value="<?php echo esc_html(get_term_meta(1,'bring_key',true)); ?>" required>

    <?php
}

function bring_lock_termmeta_key($chave){
    update_term_meta( 1, 'bring_key',$chave);
}
?>