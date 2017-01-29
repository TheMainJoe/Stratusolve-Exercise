<?php
/**
 * This class handles the modification of a task object
 */
class Task {
    public $TaskId;
    public $TaskName;
    public $TaskDescription;
    public function __construct($Id = null) {
        if ($Id) {
            // This is an existing task
            $this->LoadFromId($Id);
        } else {
            // This is a new task
            $this->Create();
        }
    }
    protected function Create() {
        // This function needs to generate a new unique ID for the task
        // Assignment: Generate unique id for the new task
        $this->TaskId = uniqid();
        $this->TaskName = isset($_POST['TaskName']) ? $_POST['TaskName'] : "";
        $this->TaskDescription = isset($_POST['TaskDescription']) ? $_POST['TaskDescription'] : "";        
    }
    protected function LoadFromId($Id = null) {
        if ($Id) {
            // Assignment: Code to load details here...
            $content = json_decode(file_get_contents('Task_Data.txt'), true);
            foreach( $content as $task )
            {
                if( $task['TaskId'] == $Id )
                {
                    return json_encode($task);
                }
            }
        } else
            return null;
    }

    public function Save($data) {
        //Assignment: Code to save task here        
        $content = json_decode(file_get_contents('Task_Data.txt'), true);
        $content[] = $data;
        file_put_contents('Task_Data.txt', json_encode($content, true) );
    }
    public function Delete($id) {
        //Assignment: Code to delete task here
        $content = json_decode(file_get_contents('Task_Data.txt'), true);
        $new = array();
        $x=0;
        foreach( $content as $task )
        {
            if( $task['TaskId'] == $id )
            {
                unset($content[$x]);
                continue;
            }
            $new[] = $task;
            $x++;
        }
        file_put_contents('Task_Data.txt', json_encode($new, true) );
    }
}
?>