<?php

class m140418_034329_assign_user_to_channel_1 extends CDbMigration
{
	public function up()
	{
        $subscription = new NfySubscriptions;
        $subscription->user_id = 2;
        $subscription->channel_id = 1;
        $subscription->save();
	}

	public function down()
	{
		echo "m140418_034329_assign_user_to_channel_1 does not support migration down.\n";
		return false;
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