<?php

 /*
    Plugin Name: Corrigir Links do Whatsapp Web
    Text Domain: corrigir-links-do-whatsapp-web
    Description: corrige os links do whatsapp web (somente desktop), removendo o 9 digito do href
    Author: Paulo Roberto Bespalhok Junior
    Author URI: bespalhok.dev
    Version: 1.0
*/

// checamos se foi uma requisição do wordpress, para evitar acesso externo
if( !( defined('ABSPATH') ) ){ die; }

function corrigir_links_whatsapp_web() {
    ?>
        <script>
            (function() {
                setTimeout(() => {
                    // somente para desktop
                    if(jQuery(document).width() > 980){

                    jQuery('a[href^="https://api.whatsapp.com"]').each(function(){
                        let link = jQuery(this);
                        let novo_numero = link.attr('href').split('=')[1].split('')
                        
                        // pulamos se for ddd 11
                        if( novo_numero[2] !== '1' && novo_numero[3] !== '1'){
                            novo_numero.forEach((item)=>{
                                if(item == '-'){
                                    novo_numero.splice(novo_numero.indexOf(item),1);
                                }
                            });

                            if(novo_numero.length > 12){
                                novo_numero.splice(4,1);

                                novo_numero = novo_numero.join('');

                                novo_link = 'https://web.whatsapp.com/send?phone=' + novo_numero;
                                
                                // setamos o novo link
                                link.attr('href', novo_link)
                            }   
                        }
                    });

                    jQuery('a[href^="https://web.whatsapp.com"]').each(function(){
                        let link = jQuery(this);
                        let novo_numero = link.attr('href').split('=')[1].split('')
                        
                        // pulamos se for ddd 11
                        if( novo_numero[2] !== '1' && novo_numero[3] !== '1'){
                            novo_numero.forEach((item)=>{
                                if(item == '-'){
                                    novo_numero.splice(novo_numero.indexOf(item),1);
                                }
                            });

                            if(novo_numero.length > 12){
                                novo_numero.splice(4,1);

                                novo_numero = novo_numero.join('');

                                novo_link = 'https://web.whatsapp.com/send?phone=' + novo_numero;
                                
                                // setamos o novo link
                                link.attr('href', novo_link)
                            }   
                        }
                    });

                    jQuery('a[href^="https://wa.me"]').each(function(){

                        let link = jQuery(this);
                        let novo_numero = link.attr('href').split('.me/')[1].split('')
                        
                        // pulamos se for ddd 11
                        if( novo_numero[2] !== '1' && novo_numero[3] !== '1'){

                            novo_numero.forEach((item)=>{
                                if(item == '-'){
                                    novo_numero.splice(novo_numero.indexOf(item),1);
                                }
                            });

                            if(novo_numero.length > 12){
                                
                                novo_numero.splice(4,1);
                                novo_numero = novo_numero.join('');

                                let novo_link = 'https://web.whatsapp.com/send?phone=' + novo_numero;
                                
                                link.attr('href', novo_link)

                            }else{
                                // se não houver o 9 digito
                                // apenas trocamos o link no desktop para abrir a tela diretamente
                                novo_numero = novo_numero.join('');
                                let novo_link = 'https://web.whatsapp.com/send?phone=' + novo_numero;
                                link.attr('href', novo_link)
                            }
                        }else{
                            // se for ddd 11
                            // apenas trocamos o link no desktop para abrir a tela diretamente
                            novo_numero = novo_numero.join('');
                            let novo_link = 'https://web.whatsapp.com/send?phone=' + novo_numero;
                            link.attr('href', novo_link)
                        }
                    });
                    }
                }, 200);
            })();
        </script>
    <?php
}
add_action('wp_footer', 'corrigir_links_whatsapp_web');