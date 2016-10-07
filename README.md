# Hitable behavior for Yii2

### Version
v0.0.5

### Installation
Run command

```
composer require axgle/yii2-hitable-behavior
```

or add

```
"axgle/yii2-hitable-behavior": "*"
```

to the require section of your `composer.json` file.

### Main migration

```
yii migrate  --migrationPath=@axgle/yii2/behavior/migrations
```
or add

```php
$this->createTable('{{%hits}}', [
    'hit_id' => $this->primaryKey(),
    'user_agent' => $this->string()->notNull(),
    'ip' => $this->string()->notNull(),
    'target_group' => $this->string()->notNull(),
    'target_pk' => $this->string()->notNull(),
    'created_at' => $this->integer()->notNull(),
]);
```

### Configuring

```php
<?php

class Post extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            'hit' => [
                'class' => \axgle\yii2\behavior\HitableBehavior::className(),
                'attribute' => 'hits_count',    //attribute which should contain uniquie hits value
                'group' => false,               //group name of the model (class name by default)
                'delay' => 60 * 60,             //register the same visitor every hour
                'table_name' => '{{%hits}}'     //table with hits data
            ]
        ];
    }
}
```

### Basic usage

```php
$post = Post::findOne(1);

//increase counter
$post->getBehavior('hit')->touch();


//get hits count
echo $post->getBehavior('hit')->getHitsCount();
```