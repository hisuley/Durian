<?php

class m140418_032056_create_message_channel extends CDbMigration
{
	public function up()
	{
        $channel = new NfyChannels;
        $channel->name = 'OrderStatus';
        $channel->route_class = 'PanelDbRoute';
        $channel->message_template = '订单状态已经修改，从 {old.status} to {new.status}，查看订单';
        $channel->save();
        /*
        $subscription = new NfySubscriptions;
        $subscription->user_id = Yii::app()->user->getId();
        $subscription->channel_id = $channel->id;
        $subscription->save();
        */
	}

	public function down()
	{
		echo "m140418_032056_create_message_channel does not support migration down.\n";
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