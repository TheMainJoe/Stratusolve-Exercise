<?php
/**
 * This script is to be used to receive a POST with the object information and then either updates, creates or deletes the task object
 */
require('Task.class.php');
// Assignment: Implement this script

if( isset( $_POST ) )
{
	$action = isset($_POST['action']);
	

	if( $action == "create" )
	{
		$task = new Task;
		$test = $task;
		$save = $task->save($test);
		//print_r($test);
		//echo json_encode($test);
	}

	if( $action == "update" )
	{
		echo "mama I changed it.";
	}

	if( $action == "delete" )
	{
		$task = new Task($id);
		$task->Delete($_POST['id']);
	}
}

if( isset( $_GET['tasks'] ) )
{
	$content = json_decode(file_get_contents('Task_Data.txt'), true);
	echo json_encode($content);
}

if( isset( $_GET['task'] ) )
{
	$id = $_GET['task'];
	$task = new Task($id);
	echo json_encode($task);
	print_r($task); 
}

?>