<form name="vincentzimportcsform" method="post" action={"/vincentzimport/showdatacs/"|ezurl}>

{* Title. *}
<div class="context-block">
{* DESIGN: Header START *}<div class="box-header"><div class="box-tc"><div class="box-ml"><div class="box-mr"><div class="box-tl"><div class="box-tr">
<h1 class="context-title">CenShare objects</h1>
{* DESIGN: Mainline *}<div class="header-mainline"></div>
{* DESIGN: Header END *}</div></div></div></div></div></div>
{* DESIGN: Content START *}<div class="box-bc"><div class="box-ml"><div class="box-mr"><div class="box-bl"><div class="box-br"><div class="box-content" style="padding-top: 2px;">
   {* 
    Feedbacks. 
   *}
  
   {if is_set( $feedback.missing_language )}
       <div class="message-warning">
       <h2><span class="time">[{currentdate()|l10n( shortdatetime )}]</span>
           {'Missing language information.'|i18n( 'extension/ezfind/elevate' )}
       </h2>
       </div>
   {/if}

{def $classes=array('archive_article')
	 $page_limit=20
	 $section_object=array()
	 $censhare_list=fetch( 'content', 'tree', hash( 'parent_node_id', 2,
                                                          'class_filter_type', 'include',
                                                          'class_filter_array', $classes,
                                                          'limit', $page_limit,
                                                          'offset', $view_parameters.offset,
                                                          'sort_by', array('published', false())
                                                           ) )
	 $censhare_list_count=fetch( 'content', 'tree_count', hash( 'parent_node_id', 2,
                                                          'class_filter_type', 'include',
                                                          'class_filter_array', $classes ) )
}
<h3>Importierte Objekte</h3>
<table class="list" cellspacing="0">
	<tr>
	    <th>{'Name'|i18n( 'design/admin/content/trash')}</th>
	    <th>Veröffentlichungsdatum</th>
	    <th>{'Section'|i18n( 'design/admin/content/trash')}</th>
	    <th>Placement</th>
	    <th class="tight">&nbsp;</th>
	</tr>

	{foreach $censhare_list as $item sequence array('bglight', 'bgdark' ) as $sequence}
		<tr class="{$sequence}">
		    <td>
		    	{$item.class_identifier|class_icon( small, $item.class_name|wash )}&nbsp;<a href={$item.url_alias|ezurl()}>{$item.name|wash}</a>
		    </td>
		    <td>
		    	{$item.object.published|datetime( 'custom', '%d.%m.%Y %H:%i' )}
		    </td>
	
		    <td>
		    	{set $section_object=fetch( 'section', 'object', hash( section_id, $item.object.section_id ) )}{if $section_object}{$section_object.name|wash()}{else}<i>{'Unknown'|i18n( 'design/admin/content/trash' )}</i>{/if}
		    </td>
		    <td>
		    	<a href={$item.parent.url_alias|ezurl()}>{$item.parent.url_alias|ezurl(no)}</a>
		    </td>
		    <td>
		    <a href={concat( '/content/edit/', $item.object.id, '/' )|ezurl}><img src={'edit.gif'|ezimage} border="0" alt="{'Restore'|i18n( 'design/admin/content/trash' )}" /></a>
		    </td>
		</tr>
	{/foreach}
	
</table>	

<div class="context-toolbar">
{include name=navigator
         uri='design:navigator/alphabetical.tpl'
         page_uri='/vincentzimport/showdatacs'
         item_count=$censhare_list_count
         view_parameters=$view_parameters
         item_limit=$limit}
</div>
  
{* DESIGN: Content END *}</div></div></div></div></div></div>
</div>

    
   <div class="context-toolbar">
   {include name=navigator
            uri='design:navigator/alphabetical.tpl'
            page_uri='/ezfind/elevate'
            item_count=$configurations_count
            view_parameters=$view_parameters
            item_limit=$page_limit}
   </div>


{* DESIGN: Content END *}</div></div></div></div></div></div>
</div>
</form>