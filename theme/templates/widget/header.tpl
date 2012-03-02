<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html{if $LANGDIRECTION == 'rtl'} dir="rtl"{/if}>
    {include file="header/head.tpl"}
    <body id="micro">
        {if $SITECLOSED}<div class="sitemessage center">{if $SITECLOSED == 'logindisabled'}{str tag=siteclosedlogindisabled section=mahara arg1="`$WWWROOT`admin/upgrade.php"}{else}{str tag=siteclosed}{/if}</div>{/if}        
        <div id="containerX">
            <div id="loading-box"></div>
            <div id="main-wrapper">
                <div class="main-column">
                    <div id="main-column-container">
