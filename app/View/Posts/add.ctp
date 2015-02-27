<h1>Add Post</h1>
<?php
echo $this->Form->create();
echo $this->Form->input('title');
echo $this->Form->input('body', array('rows' => '3'));
echo $this->Form->end('Save Post');
/*
echo $this->Form->create('Get');
echo $this->Form->input('title');
echo $this->Form->input('body', array('rows' => '3'));
echo $this->Form->end('Save Get');
*/
?>
