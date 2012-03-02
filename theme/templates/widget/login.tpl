{include file="microheader.tpl"}


<div>

    <div class="sideblock-content" style="margin:5px; border-style: solid; border-width: 1px; padding: 5px; border-color: #CCCCCC; float:left; width:300px;">

        <?php
        const SHIBB_TARGET = 'shibboleth_target';
        ?>

        <script type="text/javascript">
            function shibboleth_onsubmit_login()
            {
                var target = document.getElementById('shibboleth_target').value;
                if(target)
                {
                    window.location.href = target;
                    return false;
                }
                return false;
            }
        </script>
	{include(file="sideblocks/login_switch_header.tpl")}
        <br />
        <div style="padding-left:0px; display:block;padding-top:10px;">
            <form name="shibboleth_login" method="post" onsubmit="return shibboleth_onsubmit_login();" action=".">
                {include(file="sideblocks/login_switch_links_unige.tpl")}
                <br/>
                <input type="submit" value="{str tag='connect' section='auth.shibboleth'}">
            </form>
        </div>
    </div>
    <div style="clear:both;" > </div>

    <div style=" margin:5px; border-style: solid; border-width: 1px; padding: 5px; border-color: #CCCCCC; float:left;width:300px;" >
         <h3 style="margin-top:5px;margin-bottom:5px;"  >{str tag="internal_login" section="auth.shibboleth"}</h3>
        <div id="loginform_container" >
            <noscript><p>{str tag="javascriptnotenabled"}</p></noscript>
		    {$login_form|safe}
        </div>
    </div>
</div>
				
{include file="microfooter.tpl"}