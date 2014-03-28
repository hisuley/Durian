<?php

class m140306_100815_add_delete_columns_to_visa_order extends CDbMigration
{
	public function up()
	{
        $this->addColumn('visa_order', 'delete_time', 'int');
        $this->addColumn('visa_order', 'delete_id', 'int');
        $this->addColumn('visa_order', 'delete_comment', 'varchar(255)');
	}

	public function down()
	{
        $this->dropColumn('visa_order', 'delete_time');
        $this->dropColumn('visa_order', 'delete_id');
        $this->dropColumn('visa_order', 'delete_comment');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}