{include file="widget/header.tpl"}

<!--{if $maintitle}<h1>{$maintitle|safe}</h1>{/if}-->
<!--<div id="view-description">{$viewdescription|clean_html|safe}</div>-->

<div id="view" class="cb">
    <div id="bottom-pane">
        <div id="column-container">
            {$viewcontent|safe}
            <div class="cb">
            </div>
        </div>
    </div>
</div>
{if $visitstring}<div class="ctime center s">{$visitstring}</div>{/if}

{include file="widget/footer.tpl"}