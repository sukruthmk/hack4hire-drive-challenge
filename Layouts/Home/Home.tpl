{include file="Layouts/Base/Header.tpl"}
<div class="container-fluid">
    <nav id="primary-navigation" class="row-fluid">
        <div class="span12 contents tabbable">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#" data-toggle="tab">All</a></li>
                <li><a href="#" data-toggle="tab">DropBox</a></li>
            </ul>
        </div>
    </nav>
</div>

<div id="my-tab-content" class="tab-content" style="margin-left: 15px;margin-right: 15px;">
    <table class="table table-striped table-bordered">
        <thead>
            <th class="tableHeading"> Source </th>
            <th class="tableHeading"> Name </th>
            <th class="tableHeading"> Path </th>
            <th class="tableHeading"> Type </th>
            <th class="tableHeading"> Size </th>
            <th class="tableHeading"> Modified Time</th>
        </thead>
        <tbody>
            <tr>
                <td>{*<input name='source' type="text" height="10%" class="input-large listviewSearch" {if $SEARCH_KEY eq 'source'} value='{$SEARCH_VALUE}' {/if} />*}</td>
                <td><input name='name' type="text" height="10%" class="input-large listviewSearch" {if $SEARCH_KEY eq 'name'} value='{$SEARCH_VALUE}' {/if} /></td>
                <td><input name='path' type="text" height="10%" class="input-large listviewSearch" {if $SEARCH_KEY eq 'path'} value='{$SEARCH_VALUE}' {/if} /></td>
                <td><input name='type' type="text" height="10%" class="input-large listviewSearch" {if $SEARCH_KEY eq 'type'} value='{$SEARCH_VALUE}' {/if} /></td>
                <td><input name='size' type="text" height="10%" class="input-large listviewSearch" {if $SEARCH_KEY eq 'size'} value='{$SEARCH_VALUE}' {/if} /></td>
                <td><input name='modifiedtime' type="text" height="10%" class="input-large listviewSearch" {if $SEARCH_KEY eq 'modifiedtime'} value='{$SEARCH_VALUE}' {/if} /></td>
            </tr>
            {foreach from=$RECORD item=RECORD_MODEL}
                <tr>
                    <td align="center" class="smallFont"> {if $RECORD_MODEL->get('source') eq 'dropbox'} <img height="32px" width="32px" src='Layouts/img/DropBox-icon.png' /> {/if} </td>
                    <td align="center" class="smallFont"> {$RECORD_MODEL->get('name')} </td>
                    <td align="center" class="smallFont"> {$RECORD_MODEL->get('path')} </td>
                    <td align="center" class="smallFont"> {$RECORD_MODEL->get('type')} </td>
                    <td align="center" class="smallFont"> {$RECORD_MODEL->get('size')} </td>
                    <td align="center" class="smallFont"> {$RECORD_MODEL->get('modifiedtime')} </td>
                </tr>
            {/foreach}
        </tbody>
    </table>
</div>
            
<script>
    {literal}
        jQuery(document).ready(function() {
            jQuery('body').on('keypress', '.listviewSearch', function(e) {
                var code = (e.keyCode ? e.keyCode : e.which);
                if(code == 13) { 
                    var element = jQuery(e.currentTarget);
                    window.location.href = 'index.php?action=Home&searchkey='+element.attr('name')+'&searchvalue='+element.val();
                }
            });
        });
    {/literal}
</script>