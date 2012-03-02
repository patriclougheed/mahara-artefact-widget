<?xml version="1.0" encoding="UTF-8" ?>
<Module>
    <ModulePrefs 
        title="{$title}"   
        title_url="{$title_url}" 
        author="{$author}" 
        author_email="{$email}"
        height="{if $height}{$height}{else}250{/if}" 
        {if $description}
        description="{$description}"
        {/if}
        {if $thumbnail}
        thumbnail="{$thumbnail}"
        {/if}
        {if $screenshot}
        screenshot="{$screenshot}"
        {/if}   
        {if $scrolling}
        scrolling="true"
        {/if}   
        > 
        <Require feature="dynamic-height"/>    
        <Require feature="settitle"/>
    </ModulePrefs>

    <UserPref name="blockid" display_name="block" default_value="{$default_block}" datatype="enum" urlparam="block_id">        
        {foreach from=$blocks item=item key=artefact_id}
        <EnumValue value="{$item->id}" display_value="{$item->title}" />
        {/foreach}
    </UserPref> 
    <Content view="home,canvas,profile" type="html"  >
        <![CDATA[
        <script type="text/javascript">
            var blocks = new Array();     
            {foreach from=$blocks item=item key=artefact_id}
                blocks[{$item->id}] = "{$title} - {$item->title}";                
            {/foreach}
            
            var prefs = new gadgets.Prefs();
            var id = prefs.getString("blockid");
            var title = blocks[id];
            p = unescape( "&#039;" );
            title = title.replace(p, "'");
            gadgets.window.setTitle(title);	
        </script>
        <iframe src="{$url}" width="100%" height="100%" frameborder="0"></iframe>
        ]]>
    </Content>
</Module>