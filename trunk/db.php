<?php

class MUsers extends phpDataMapper_Base
{
	// Specify the data source (table for SQL adapters)
	protected $_datasource = "users";

	// Define your fields as public class properties
	public $id = array('type' => 'int', 'primary' => true);
	public $name = array('type' => 'string', 'required' => true);
	public $sex = array('type' => 'string');
	public $bdate = array('type' => 'datetime');
	public $about_me = array('type' => 'text', 'required' => true);

	public $address = array('type' => 'string');
	public $email = array('type' => 'string', 'required' => true);
	public $website = array('type' => 'string');
	public $adv_code = array('type' => 'string');

	public $created_date = array('type' => 'datetime');

	// Realtions
	public $notes = array(
        'type' => 'relation',
        'relation' => 'HasMany',
        'mapper' => 'MNotes',
        'where' => array('from' => 'entity.id')
	// Means MNotes.post_id = currently loaded User entity id
	);

	public $comments = array(
        'type' => 'relation',
        'relation' => 'HasMany',
        'mapper' => 'MComments',
        'where' => array('from' => 'entity.id')
	// Means MNotes.post_id = currently loaded User entity id
	);

	public $likes = array(
        'type' => 'relation',
        'relation' => 'HasMany',
        'mapper' => 'MLikes',
        'where' => array('from' => 'entity.id')
	// Means MNotes.post_id = currently loaded User entity id
	);

	public $follows = array(
        'type' => 'relation',
        'relation' => 'HasMany',
        'mapper' => 'MSubscribes',
        'where' => array('subscriber_id' => 'entity.id')
	// Means MNotes.post_id = currently loaded User entity id
	);

	public $followers = array(
        'type' => 'relation',
        'relation' => 'HasMany',
        'mapper' => 'MSubscribes',
        'where' => array('user_id' => 'entity.id')
	// Means MNotes.post_id = currently loaded User entity id
	);
}

class MComments extends phpDataMapper_Base
{
	// Specify the data source (table for SQL adapters)
	protected $_datasource = "comments";

	// Define your fields as public class properties
	public $id = array('type' => 'int', 'primary' => true);
	public $replay_to_id = array('type' => 'int');
	public $note_id = array('type' => 'int');
	public $from = array('type' => 'int', 'required' => true);
	public $message = array('type' => 'text', 'required' => true);
	public $created_date = array('type' => 'datetime');

	// Realtions
	public $comments = array(
        'type' => 'relation',
        'relation' => 'HasMany',
        'mapper' => 'MComments',
        'where' => array('replay_to_id' => 'entity.id')
	// Means MNotes.post_id = currently loaded User entity id
	);

	public $likes = array(
        'type' => 'relation',
        'relation' => 'HasMany',
        'mapper' => 'MLikes',
        'where' => array('comment_id' => 'entity.id')
	// Means MNotes.post_id = currently loaded User entity id
	);

}

class MNotes extends phpDataMapper_Base
{
	// Specify the data source (table for SQL adapters)
	protected $_datasource = "notes";

	// Define your fields as public class properties
	public $id = array('type' => 'int', 'primary' => true);
	public $from = array('type' => 'int', 'required' => true);
	public $subject = array('type' => 'string', 'required' => true);
	public $message = array('type' => 'text', 'required' => true);
	public $created_date = array('type' => 'datetime');
	public $updated_date = array('type' => 'datetime');
	public $visits = array('type' => 'int');

	// Realtions
	public $comments = array(
        'type' => 'relation',
        'relation' => 'HasMany',
        'mapper' => 'MComments',
        'where' => array('note_id' => 'entity.id')
	// Means MNotes.post_id = currently loaded User entity id
	);

	public $likes = array(
        'type' => 'relation',
        'relation' => 'HasMany',
        'mapper' => 'MLikes',
        'where' => array('note_id' => 'entity.id')
	// Means MNotes.post_id = currently loaded User entity id
	);

	// Realtions
	public $keywords = array(
        'type' => 'relation',
        'relation' => 'HasMany',
        'mapper' => 'MNotes_Keywords',
        'where' => array('note_id' => 'entity.id')
	// Means MNotes.post_id = currently loaded User entity id
	);
}

class MNotes_Keywords extends phpDataMapper_Base
{
	// Specify the data source (table for SQL adapters)
	protected $_datasource = "notes_keywords";

	// Define your fields as public class properties
	public $note_id = array('type' => 'int');
	public $keyword_id = array('type' => 'int');

}

class MKeywords extends phpDataMapper_Base
{
	// Specify the data source (table for SQL adapters)
	protected $_datasource = "keywords";

	// Define your fields as public class properties
	public $id = array('type' => 'int', 'primary' => true);
	public $parent_id = array('type' => 'int');
	public $subject = array('type' => 'string', 'required' => true);
	public $count = array('type' => 'int');

	// Realtions
	public $notes = array(
        'type' => 'relation',
        'relation' => 'HasMany',
        'mapper' => 'MNotes_Keywords',
        'where' => array('keyword_id' => 'entity.id')
	// Means MNotes.post_id = currently loaded User entity id
	);

	public $subscribers = array(
        'type' => 'relation',
        'relation' => 'HasMany',
        'mapper' => 'MSubscribes',
        'where' => array('keyword_id' => 'entity.id')
	// Means MNotes.post_id = currently loaded User entity id
	);
}

class MLikes extends phpDataMapper_Base
{
	// Specify the data source (table for SQL adapters)
	protected $_datasource = "likes";

	// Define your fields as public class properties
	public $from = array('type' => 'int');
	public $note_id = array('type' => 'int');
	public $comment_id = array('type' => 'int');
}

class MSubscribes extends phpDataMapper_Base
{
	// Specify the data source (table for SQL adapters)
	protected $_datasource = "subscribes";

	// Define your fields as public class properties
	public $id = array('type' => 'int', 'primary' => true,'serial' => true);
	public $subscriber_id = array('type' => 'int');
	public $user_id = array('type' => 'int');
	public $keyword_id = array('type' => 'int');
	public $date = array('type' => 'datetime');
}

