<?php
  //添加留言到数据库中
  require_once('../init.php');
  header('Content-Type: application/json;charset=UTF-8');
  $output=[
		"rankList"=>null,
		"recommendList"=>null
	];
  //添加SQL
  $sql = "SELECT 	art.art_id
								, art.art_title
								, art.art_author
								, art.art_type1
								, par1.param_name art_type1Desc
								, par2.param_name art_type2Desc
								, art.art_type2
								, art.art_hits
								, art.art_pubtime
								, art.art_des
								, art.art_content 
					FROM article art 
						LEFT JOIN blog_parameter par1 ON art.art_type1 = par1.param_code AND par1.param_type = 'ART_TYPE_LV1'
				 		LEFT JOIN blog_parameter par2 ON art.art_type2 = par2.param_code AND par2.param_type = 'ART_TYPE_LV2'
						 	AND par2.pre_type = 'ART_TYPE_LV1' AND art.art_type1 = par2.pre_type_code
					ORDER BY art.art_hits DESC LIMIT 7";
  //查询结果
  $result = mysqli_query($conn,$sql);
	$output['rankList'] = mysqli_fetch_all($result, 1);
	$sql_recommend_TEC = "SELECT art.art_id 
														 , art.art_title 
														 , art.art_author 
														 , art.art_type1 
														 , par1.param_name art_type1Desc 
														 , par2.param_name art_type2Desc 
														 , art.art_type2 
														 , art.art_hits 
														 , art.art_pubtime 
														 , art.art_des 
														 , art.art_content 
												FROM article art 
													LEFT JOIN blog_parameter par1 ON art.art_type1 = par1.param_code AND par1.param_type = 'ART_TYPE_LV1' 
													LEFT JOIN blog_parameter par2 ON art.art_type2 = par2.param_code AND par2.param_type = 'ART_TYPE_LV2' 
														AND par2.pre_type = 'ART_TYPE_LV1' AND art.art_type1 = par2.pre_type_code 
												WHERE art.art_type1='TEC' 
												ORDER BY art.art_hits DESC 
												LIMIT 1 ";
	$result = mysqli_query($conn,$sql_recommend_TEC);
	$output['recommendList'][0] = mysqli_fetch_all($result, 1);
	$sql_recommend_NOTE = "SELECT  art.art_id 
															, art.art_title 
															, art.art_author 
															, art.art_type1 
															, par1.param_name art_type1Desc 
															, par2.param_name art_type2Desc 
															, art.art_type2 
															, art.art_hits 
															, art.art_pubtime 
															, art.art_des 
															, art.art_content 
												FROM article art 
													LEFT JOIN blog_parameter par1 ON art.art_type1 = par1.param_code AND par1.param_type = 'ART_TYPE_LV1' 
													LEFT JOIN blog_parameter par2 ON art.art_type2 = par2.param_code AND par2.param_type = 'ART_TYPE_LV2' 
													AND par2.pre_type = 'ART_TYPE_LV1' AND art.art_type1 = par2.pre_type_code 
												WHERE art.art_type1='NOTE' 
												ORDER BY art.art_hits DESC 
												LIMIT 1 ";
$result = mysqli_query($conn,$sql_recommend_NOTE);
$output['recommendList'][1] = mysqli_fetch_all($result, 1);
	// var_dump(json_encode($output['recommendList']));
  echo json_encode($output);
?>