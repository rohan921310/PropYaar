<?php

class Csv_import_model extends CI_Model

{
	function insert($data)
	{
		$this->db->insert_batch('bs_items', $data);
	}
	function insert_org( $org_data)
	{
		$this->db->insert_batch('bs_organisation', $org_data);
	}
	function insert_img($data1){
		// echo "<pre>",print_r($data1);die;
		$this->db->insert_batch('core_images', $data1);
		// echo $this->db->last_query();die;
	}

	function insert_blogs($data)
	{
		$this->db->insert_batch('bs_feeds', $data);
	}

	function insert_images($image_data)
	{
		$query=$this->db->insert_batch('core_images',$image_data);
	}

	function insert_video($data)
	{
		$this->db->insert_batch('bs_videos', $data);
	}

	function insert_project( $project_data)
	{
		$this->db->insert_batch('bs_project_details', $project_data);
	}

	function insert_locations($data)
	{
		$this->db->insert_batch('bs_items_location', $data);
	}

	//function insert_video_path($video_data)
	//{
	//	$this->db->insert_batch('core_videos', $video_data);
	//}

}

