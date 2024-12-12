<?php

$config_path = realpath(dirname(__FILE__) . '/../config.ini');

if (!file_exists($config_path)) {
	die("Error: Configuration file not found at $config_path");
}

// Parse the configuration file
$config = parse_ini_file($config_path, true);

// Extract backend configuration values
$backendIP = $config['backend']['ip'];
if(isset($_GET['kb_delete']))
{

	$id = intval($_GET['kb_delete']);
	$getname = "SELECT kb_file from knowledge_base where kb_id = $id ";
	$res = pg_query($con,$getname);
	$filePath = pg_fetch_assoc($res);
	// Remove the extension
	$file_name = pathinfo($filePath['kb_file'], PATHINFO_FILENAME).".pdf";
	// $collection_id_query = "'7d46b394-4744-45e9-a612-1ac895c74827'";

	// SQL query to get the collection_id
	//$getEmbedID = "SELECT collection_id FROM public.langchain_pg_embedding WHERE collection_id = \'7d46b394-4744-45e9-a612-1ac895c74827\'";
	//$file_name = "35951a952dfc99c42ddde07d12256e9c.pdf";
	$getEmbedID = "select uuid FROM public.langchain_pg_embedding where cmetadata->>'source' LIKE '%" . ($file_name) . "%' OR cmetadata->>'file_path' LIKE '%" . ($file_name) . "%'";
	//$getEmbedID = "SELECT * FROM public.langchain_pg_embedding";// WHERE cmetadata->>'source' LIKE '%35951a952dfc99c42ddde07d12256e9c.pdf%' OR cmetadata->>'file_path' LIKE '%35951a952dfc99c42ddde07d12256e9c.pdf%';";
	//$getEmbedID = "delete  FROM langchain_pg_embedding where uuid ='a7bb4eb3-85ec-4769-be3a-e781e6ee396b';";//"SELECT * FROM pg_catalog.pg_tables;";

	$resEmbed = pg_query($con,$getEmbedID);
	while($embedID = pg_fetch_assoc($resEmbed))
	{
		$uuid = $embedID['uuid'];
		$delEmbed = "DELETE FROM public.langchain_pg_embedding WHERE uuid='$uuid'";
		if(!pg_query($con,$delEmbed))
		{
			continue;
		}
	}
	$delID = "DELETE FROM knowledge_base WHERE kb_id = $id";
		if(pg_query($con,$delID))
		{	
			//Reset cache by sending a post request to the python backend
			$resetCacheUrl = "http://$backendIP:8080/reset-cache";
			$data = http_build_query(array('knowledge_id' => $id));
			//Using file_get_contents to make a POST request to reset cache
			$options = [
				'http'=> [
					'header' => "Content-type: application/x-www-form-urlencoded\r\n",
					'method' => 'POST',
					'content' => $data
				]

				];
			$context = stream_context_create($options);
			$result = file_get_contents($resetCacheUrl, false, $context);

			if($result == FALSE){
				//Handle error if the reset cache request fails
				echo "<script>alert('Error: Unable to reset cache.');</script>";
			}
			else{
				echo "<script>alert('Knowledge Base updated Successfully (Deleted) and Cache Reset Successfully');</script>";
			}

		}

    echo "<script>window.open('index.php?knowledge_base','_self')</script>";	

}

?>