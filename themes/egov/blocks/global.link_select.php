<?php
/**
 * @Project NUKEVIET
 * @Author Thaotrinh member forum nukeviet (trinhthao@bendoi.vn)
 */

if ( ! defined( 'NV_MAINFILE' ) ) die( 'Stop!!!' );
if ( ! nv_function_exists( 'link_select' ) )
{

    function nv_link_select_config ( $module, $data_block, $lang_block )
    {
        $html = '';
		$html .= '<tr><td colspan="2" style="text-align:center;font-weight:bold;background: #B6C8FF; text-shadow: 1px 2px 3px #FFF;"> Liên kết web
<style>.table>tbody>tr>td,table>tr td{vertical-align: baseline;}.form_control{display: inline-block;border-radius: 0px;padding:5px;} .w5{width:5%} .w10{width:10%} .w15{width:15%} .w20{width:20%} .w30{width:30%} .w40{width:40%} .w45{width:45%} .w95{width:95%} .w50x{width:50px} .w80x{width:80px} .w150x{width:150px}
	</style>
	</td></tr>';
		
		for( $i = 1; $i < 51; $i++ )
		{
	        $html .= '<tr><td> Liên kết '.$i.'</td><td>
			<input type="text" name="config_atitle' . $i . '" value="' . $data_block['atitle' . $i] . '"  placeholder="Title ..." class="form_control form-control w45"/>
			<input type="text" name="config_aurl' . $i . '" value="' . $data_block['aurl' . $i] . '"  placeholder="http://..." class="form_control form-control w45"/>
			</td></tr>';
	
		}
      
        return $html;
    }

    function nv_link_select_submit ( $module, $lang_block )
    {
        global $nv_Request;
        $return = array();
        $return['error'] = array();
        $return['config'] = array();
					for( $i = 1; $i < 51; $i++ )
		{
			$return['config']['atitle' . $i] 	= $nv_Request->get_string( 'config_atitle' . $i, 'post', 0 );
			$return['config']['aurl' . $i] 		= $nv_Request->get_string( 'config_aurl' . $i, 'post', 0 );
		}		

        return $return;
    } 
    function link_select ( $block_config )
    {
		global $module_info, $global_config;

		if( file_exists( NV_ROOTDIR . "/themes/" . $global_config['site_theme'] . "/blocks/global.link_select.tpl" ) )
		{
			$block_theme = $global_config['site_theme'];
		}
		elseif( file_exists( NV_ROOTDIR . "/themes/" . $module_info['template'] . "/blocks/global.link_select.tpl" ) )
		{
			$block_theme = $module_info['template'];
		}
		else
		{
			$block_theme = "default";
		}
		
		$xtpl = new XTemplate( 'global.link_select.tpl', NV_ROOTDIR . '/themes/' . $block_theme . '/blocks' );
		$xtpl->assign( 'TEMPLATE', $block_theme );
		$xtpl->assign( 'NV_BASE_SITEURL', NV_BASE_SITEURL );
		
		for( $i = 1; $i < 51; $i++ )
		{
			if( ! empty( $block_config['atitle' . $i] ) ) 
			{ 
			$xtpl->assign( 'AURL',$block_config['aurl' . $i]);
			$xtpl->assign( 'ATITLE', $block_config['atitle' . $i] ); 
			
			$xtpl->parse( 'main.loop' );
			}
		}
		$xtpl->parse( 'main' );
		return $xtpl->text( 'main' );
	} 
}

if ( defined( 'NV_SYSTEM' ) )
{
    $content = link_select( $block_config );
}
?>